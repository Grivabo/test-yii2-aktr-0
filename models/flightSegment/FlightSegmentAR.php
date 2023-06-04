<?php
declare(strict_types = 1);

namespace app\models\flightSegment;

use app\models\airportName\AirportName;
use app\models\airportName\AirportNameQuery;
use app\models\tripService\TripService;
use app\models\tripService\TripServiceQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "flight_segment".
 *
 * @property int $id
 * @property int $flight_id
 * @property int $num
 * @property int $group
 * @property string|null $departureTerminal
 * @property string|null $arrivalTerminal
 * @property string|null $flightNumber
 * @property string|null $departureDate
 * @property string|null $arrivalDate
 * @property int|null $stopNumber
 * @property int|null $flightTime
 * @property int|null $eTicket
 * @property string|null $bookingClass
 * @property string|null $bookingCode
 * @property int|null $baggageValue
 * @property string|null $baggageUnit
 * @property int|null $depAirportId
 * @property int|null $arrAirportId
 * @property int|null $opCompanyId
 * @property int|null $markCompanyId
 * @property int|null $aircraftId
 * @property int|null $depCityId
 * @property int|null $arrCityId
 * @property string|null $supplierRef
 * @property int|null $depTimestamp
 * @property int|null $arrTimestamp
 *
 * @property TripService $flight
 * @property AirportName $depAirport
 * @property AirportName $arrAirport
 */
abstract class FlightSegmentAR extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'flight_segment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['flight_id', 'num', 'group'], 'required'],
            [['flight_id', 'num', 'group', 'stopNumber', 'flightTime', 'eTicket', 'baggageValue', 'depAirportId', 'arrAirportId', 'opCompanyId', 'markCompanyId', 'aircraftId', 'depCityId', 'arrCityId', 'depTimestamp', 'arrTimestamp'], 'integer'],
            [['departureTerminal', 'arrivalTerminal', 'bookingCode'], 'string', 'max' => 1],
            [['flightNumber'], 'string', 'max' => 6],
            [['departureDate', 'arrivalDate'], 'string', 'max' => 20],
            [['bookingClass', 'baggageUnit'], 'string', 'max' => 16],
            [['supplierRef'], 'string', 'max' => 8],
            [['flight_id'], 'exist', 'skipOnError' => true, 'targetClass' => TripService::class, 'targetAttribute' => ['flight_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'flight_id' => 'Flight ID',
            'num' => 'Num',
            'group' => 'Group',
            'departureTerminal' => 'Departure Terminal',
            'arrivalTerminal' => 'Arrival Terminal',
            'flightNumber' => 'Flight Number',
            'departureDate' => 'Departure Date',
            'arrivalDate' => 'Arrival Date',
            'stopNumber' => 'Stop Number',
            'flightTime' => 'Flight Time',
            'eTicket' => 'E Ticket',
            'bookingClass' => 'Booking Class',
            'bookingCode' => 'Booking Code',
            'baggageValue' => 'Baggage Value',
            'baggageUnit' => 'Baggage Unit',
            'depAirportId' => 'Dep Airport ID',
            'arrAirportId' => 'Arr Airport ID',
            'opCompanyId' => 'Op Company ID',
            'markCompanyId' => 'Mark Company ID',
            'aircraftId' => 'Aircraft ID',
            'depCityId' => 'Dep City ID',
            'arrCityId' => 'Arr City ID',
            'supplierRef' => 'Supplier Ref',
            'depTimestamp' => 'Dep Timestamp',
            'arrTimestamp' => 'Arr Timestamp',
        ];
    }

    /**
     * Gets query for [[Flight]].
     *
     * @return TripServiceQuery
     */
    public function getFlight(): TripServiceQuery
    {
        return $this->hasOne(TripService::class, ['id' => 'flight_id']);
    }

    /**
     * Gets query for [[AirportName]].
     *
     * @return AirportNameQuery
     */
    public function getDepAirport(): AirportNameQuery
    {
        return $this->hasOne(AirportName::class, ['airport_id' => 'depAirportId']);
    }

    /**
     * Gets query for [[AirportName]].
     *
     * @return AirportNameQuery
     */
    public function getArrAirport(): AirportNameQuery
    {
        return $this->hasOne(AirportName::class, ['airport_id' => 'arrAirportId']);
    }

    /**
     * {@inheritdoc}
     * @return FlightSegmentQuery the active query used by this AR class.
     */
    public static function find(): FlightSegmentQuery
    {
        return new FlightSegmentQuery(static::class);
    }
}