<?php
declare(strict_types = 1);

namespace app\models\trip;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Trip]].
 *
 * @see Trip
 */
class TripQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return Trip[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Trip|array|null
     */
    public function one($db = null): Trip|array|null
    {
        return parent::one($db);
    }
}