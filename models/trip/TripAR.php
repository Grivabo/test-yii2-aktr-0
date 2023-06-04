<?php
declare(strict_types = 1);

namespace app\models\trip;

use app\models\tripService\TripService;
use app\models\tripService\TripServiceQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "trip".
 *
 * @property int $id
 * @property int $corporate_id
 * @property int $number
 * @property int $user_id
 * @property int $created_at Дата и время создания
 * @property int $updated_at Дата и время последнего обновления
 * @property int $coordination_at Дата и время согласования
 * @property int $saved_at Дата и время сохранения
 * @property int $tag_le_id
 * @property int $trip_purpose_id
 * @property int $trip_purpose_parent_id
 * @property string $trip_purpose_desc Цель командировки
 * @property int $status Статус
 *
 * @property TripService[] $tripServices
 */
abstract class TripAR extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'trip';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['corporate_id', 'number', 'user_id', 'created_at', 'updated_at', 'coordination_at', 'saved_at', 'tag_le_id', 'trip_purpose_id', 'trip_purpose_parent_id', 'trip_purpose_desc', 'status'], 'required'],
            [['corporate_id', 'number', 'user_id', 'created_at', 'updated_at', 'coordination_at', 'saved_at', 'tag_le_id', 'trip_purpose_id', 'trip_purpose_parent_id', 'status'], 'integer'],
            [['trip_purpose_desc'], 'string'],
            [['corporate_id', 'number'], 'unique', 'targetAttribute' => ['corporate_id', 'number']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'corporate_id' => 'Corporate ID',
            'number' => 'Number',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'coordination_at' => 'Coordination At',
            'saved_at' => 'Saved At',
            'tag_le_id' => 'Tag Le ID',
            'trip_purpose_id' => 'Trip Purpose ID',
            'trip_purpose_parent_id' => 'Trip Purpose Parent ID',
            'trip_purpose_desc' => 'Trip Purpose Desc',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[TripServices]].
     *
     * @return TripServiceQuery
     */
    public function getTripServices(): TripServiceQuery
    {
        return $this->hasMany(TripService::class, ['trip_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return TripQuery the active query used by this AR class.
     */
    public static function find(): TripQuery
    {
        return new TripQuery(static::class);
    }
}