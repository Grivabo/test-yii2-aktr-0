<?php
declare(strict_types = 1);

namespace app\widgets\TripsIndexPageWidget;

use app\components\select2Helper\Select2Helper;
use app\components\select2Helper\Select2ParamDto;
use app\models\trip\TripSearch;
use kartik\select2\Select2;
use yii\base\Widget;
use yii\data\DataProviderInterface;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;

/**
 * @class TripsIndexPageWidget
 */
class TripsIndexPageWidget extends Widget
{
    public const EXT_FILTER_CSS_CLASS = 'trips-index-page-filter';
    public TripSearch $searchModel;
    public DataProviderInterface $dataProvider;

    /**
     * @inheritDoc
     */
    public function run(): string
    {
        return $this->render('index', [
            'searchModel' => $this->searchModel,
            'dataProvider' => $this->dataProvider,
        ]);
    }

    /**
     * For AJAX search Select2 params.
     *
     * @param Select2ParamDto $dto
     * @param string|int|null $id
     * @param string $ajaxUrl
     * @return array
     *
     * @see Select2
     */
    public static function select2Params(
        Select2ParamDto $dto,
        string|int|null $id,
        string $ajaxUrl,
    ): array
    {
        /**
         * @see https://demos.krajee.com/widget-details/select2#usage-ajax $defaultSelectParams
         */
        $defaultSelectParams = [
            'data' => [],
            'options' => ['multiple' => false, 'placeholder' => '...'],
            'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 0,
                'language' => [
                    'errorLoading' => new JsExpression(
                        "function () { return 'Waiting for results...'; }"
                    ),
                ],
                'ajax' => [
                    'url' => 'not_set',
                    'dataType' => 'json',
                    'data' => new JsExpression(
                        'function(params) { return {q:params.term}; }'
                    ),
                    'delay' => 250
                ],
                'escapeMarkup' => new JsExpression(
                    'function (markup) { return markup; }'
                ),
                'templateResult' => new JsExpression(
                    'function(item) { return item.text; }'
                ),
                'templateSelection' => new JsExpression(
                    'function (item) { return item.text; }'
                ),
            ],
        ];

        return ArrayHelper::merge(
            $defaultSelectParams,
            [
                'data' => Select2Helper::forWidget($dto, $id),
                'pluginOptions' => ['ajax' => ['url' => $ajaxUrl]],
            ]
        );
    }
}