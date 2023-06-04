<?php
declare(strict_types = 1);

namespace app\models\trip;

use app\components\BigActiveDataProvider;
use Throwable;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\data\DataProviderInterface;

/**
 * @property bool $isLightPagination without sql call 'COUNT(*)'
 */
class TripSearch extends Model
{
    public ?string $corporateId = null;
    public ?string $serviceId = null;
    public ?string $depAirportId = null;
    /**
     * @var bool
     * @see BigActiveDataProvider
     */
    public bool $_isLightPagination = false;

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            /**
             * TODO №346507 Уточнить требования поиска с не заполненными полям.
             *  Если это не нужно, то добавить проверки наличия и актуальности
             *  параметров. Это сократит количество элементов для выдачи и
             *  сократит нагрузку.
             */
            [['corporateId', 'serviceId', 'depAirportId'], 'string', 'max' => 100],
            ['isLightPagination', 'boolean'],
        ];
    }

    /**
     * @inheritDoc
     */
    public function attributeLabels(): array
    {
        return [
            'isLightPagination' => 'Light pagination',
        ];
    }

    /**
     * @param array $params
     * @return DataProviderInterface
     * @throws Throwable
     */
    public function search(array $params): DataProviderInterface
    {
        $this->load($params);
        if (false === $this->validate()) {
            return new ArrayDataProvider([]);
        }

        $query = Trip::find()
            ->joinWith(
                'tripServices',
                false,
                'INNER JOIN'
            )
            ->joinWith(
                'tripServices.flightSegments',
                false,
                'INNER JOIN'
            )->andFilterWhere([
                'corporate_id' => $this->corporateId,
                'service_id' => $this->serviceId,
                'depAirportId' => $this->depAirportId,
            ])
            ->distinct();

        $dataProviderClass = $this->_isLightPagination
            ? BigActiveDataProvider::class
            : ActiveDataProvider::class;

        return new $dataProviderClass(
            [
                'query' => $query,
                'sort' => [
                    'attributes' => [ // Для остальных нет индексов
                        'id',
                        'corporate_id',
                    ]
                ],
            ]
        );
    }

    /**
     * @return bool
     */
    public function getIsLightPagination(): bool
    {
        return $this->_isLightPagination;
    }

    /**
     * @param bool $isLightPagination
     */
    public function setIsLightPagination(string|bool $isLightPagination): void
    {
        $this->_isLightPagination = (bool)$isLightPagination;
    }
}