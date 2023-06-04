<?php
declare(strict_types = 1);

namespace app\models\tripService;

use app\models\flightSegment\FlightSegment;
use app\models\flightSegment\FlightSegmentQuery;
use app\models\trip\Trip;
use app\models\trip\TripQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "trip_service".
 *
 * @property int $id
 * @property int $trip_id
 * @property int $service_id
 * @property int|null $status
 * @property int $type_booking Тип заказа
 * @property int $variants Варианты
 * @property float|null $price
 * @property string|null $currency
 * @property string|null $confirmation_number
 * @property int|null $deadline
 * @property int|null $date_start
 * @property int|null $date_end
 * @property int|null $start_city_id
 * @property int|null $start_point_id
 * @property int|null $end_point_id
 * @property int|null $end_city_id
 * @property string $description
 *
 * @property FlightSegment[] $flightSegments
 * @property Trip $trip
 */
abstract class TripServiceAR extends ActiveRecord
{
    /**
     * @inheritDoc
     */
    public static function tableName(): string
    {
        return 'trip_service';
    }

    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            [['trip_id', 'service_id', 'type_booking', 'variants', 'description'], 'required'],
            [['trip_id', 'service_id', 'status', 'type_booking', 'variants', 'deadline', 'date_start', 'date_end', 'start_city_id', 'start_point_id', 'end_point_id', 'end_city_id'], 'integer'],
            [['price'], 'number'],
            [['description'], 'string'],
            [['currency'], 'string', 'max' => 3],
            [['confirmation_number'], 'string', 'max' => 16],
            [['trip_id'], 'exist', 'skipOnError' => true, 'targetClass' => Trip::class, 'targetAttribute' => ['trip_id' => 'id']],
        ];
    }

    /**
     * @inheritDoc
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'trip_id' => 'Trip ID',
            'service_id' => 'Service ID',
            'status' => 'Status',
            'type_booking' => 'Type Booking',
            'variants' => 'Variants',
            'price' => 'Price',
            'currency' => 'Currency',
            'confirmation_number' => 'Confirmation Number',
            'deadline' => 'Deadline',
            'date_start' => 'Date Start',
            'date_end' => 'Date End',
            'start_city_id' => 'Start City ID',
            'start_point_id' => 'Start Point ID',
            'end_point_id' => 'End Point ID',
            'end_city_id' => 'End City ID',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[FlightSegments]].
     *
     * @return FlightSegmentQuery
     */
    public function getFlightSegments(): FlightSegmentQuery
    {
        return $this->hasMany(FlightSegment::class, ['flight_id' => 'id']);
    }

    /**
     * Gets query for [[Trip]].
     *
     * @return TripQuery
     */
    public function getTrip(): TripQuery
    {
        return $this->hasOne(Trip::class, ['id' => 'trip_id']);
    }

    /**
     * @inheritDoc
     * @return TripServiceQuery the active query used by this AR class.
     */
    public static function find(): TripServiceQuery
    {
        return new TripServiceQuery(static::class);
    }
}