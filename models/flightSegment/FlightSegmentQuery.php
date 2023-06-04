<?php
declare(strict_types = 1);

namespace app\models\flightSegment;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[FlightSegment]].
 *
 * @see FlightSegment
 */
class FlightSegmentQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return FlightSegment[]|array
     */
    public function all($db = null): array
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return FlightSegment|array|null
     */
    public function one($db = null): FlightSegment|array|null
    {
        return parent::one($db);
    }
}