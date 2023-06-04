<?php
declare(strict_types = 1);

namespace app\components\select2Helper;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\Response;

/**
 * AJAX search for Select2
 * @see Select2
 */
class Select2Helper
{
    public const AJAX_SEARCH_ITEMS_COUNT = 20;
    public const AJAX_QUERY_SEARCH_STRING_MAX_LENGTH = 50;

    /**
     * @param Select2ParamDto $helperDto
     * @param string|int|null $id
     * @param string|null $q finds any values that start with it
     * @return ActiveRecord[]
     *
     * @see https://demos.krajee.com/widget-details/select2#usage-ajax
     */
    protected static function data(
        Select2ParamDto $helperDto,
        string|int|null $id = null,
        string $q = null,
    ): array
    {
        /** @var class-string<ActiveRecord> $class */
        $class = $helperDto->class;
        $query = $class::find()
            ->select([$helperDto->idFieldName, $helperDto->textFieldName]);

        $query->andFilterWhere([$helperDto->idFieldName => $id]);

        if ($q) {
            $_q = trim($q);
            $_q = strtr($_q, ['%' => '\%', '_' => '\_', '\\' => '\\\\']);
            $_q = substr($_q, 0, self::AJAX_QUERY_SEARCH_STRING_MAX_LENGTH);
            $query->andWhere(
                ['LIKE', $helperDto->textFieldName, $_q . '%', false]
            );
        }

        return $query
            ->limit(self::AJAX_SEARCH_ITEMS_COUNT)
            ->distinct()
            ->all();
    }

    /**
     * @param Select2ParamDto $helperDto
     * @param string|int|null $id
     * @param string|null $q
     * @return array
     */
    public static function forController(
        Select2ParamDto $helperDto,
        string|int|null $id = null,
        string $q = null,
    ): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $items = static::data($helperDto, $id, $q);
        return [
            'results' => array_map(
                static fn(ActiveRecord $ar) => [
                    'id' => $ar->{$helperDto->idFieldName},
                    'text' => $ar->{$helperDto->textFieldName}
                ],
                $items)
        ];
    }

    /**
     * @param Select2ParamDto $helperDto
     * @param string|int|null $id
     * @return array
     */
    public static function forWidget(
        Select2ParamDto $helperDto,
        string|int|null $id = null,
    ): array
    {
        return ArrayHelper::map(
            static::data($helperDto, $id),
            $helperDto->idFieldName,
            $helperDto->textFieldName
        );
    }
}