<?php
declare(strict_types = 1);

namespace app\models\airportName;

use Yii;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;
use yii\db\Connection;

/**
 * This is the model class for table "airport_name".
 *
 * @property int $id
 * @property int $airport_id
 * @property int|null $language_id
 * @property string $value
 */
abstract class AirportNameAR extends ActiveRecord
{
    /**
     * @inheritDoc
     */
    public static function tableName(): string
    {
        return 'airport_name';
    }

    /**
     * @return Connection the database connection used by this AR class.
     * @throws InvalidConfigException
     */
    public static function getDb(): Connection
    {
        return Yii::$app->get('dbNGE');
    }

    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            [['airport_id', 'value'], 'required'],
            [['airport_id', 'language_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['airport_id', 'language_id'], 'unique', 'targetAttribute' => ['airport_id', 'language_id']],
        ];
    }

    /**
     * @inheritDoc
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'airport_id' => 'Airport ID',
            'language_id' => 'Language ID',
            'value' => 'Value',
        ];
    }

    /**
     * @inheritDoc
     * @return AirportNameQuery the active query used by this AR class.
     */
    public static function find(): AirportNameQuery
    {
        return new AirportNameQuery(static::class);
    }
}