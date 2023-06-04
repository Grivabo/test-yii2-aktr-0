<?php
declare(strict_types = 1);

namespace app\models\airportName;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[AirportName]].
 *
 * @see AirportName
 */
class AirportNameQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return AirportName[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AirportName|array|null
     */
    public function one($db = null): AirportName|array|null
    {
        return parent::one($db);
    }
}