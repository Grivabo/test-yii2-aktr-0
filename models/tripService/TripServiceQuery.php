<?php
declare(strict_types = 1);

namespace app\models\tripService;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[TripService]].
 *
 * @see TripService
 */
class TripServiceQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return TripService[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TripService|array|null
     */
    public function one($db = null): TripService|array|null
    {
        return parent::one($db);
    }
}