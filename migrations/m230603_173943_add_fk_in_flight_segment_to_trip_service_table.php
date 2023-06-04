<?php
declare(strict_types = 1);

use yii\db\Migration;

/**
 * Handles the creation of FK for `flight_segment`.
 */
class m230603_173943_add_fk_in_flight_segment_to_trip_service_table extends Migration
{
    public const TABLE_NAME = 'flight_segment';
    public const INDEX_NAME = "fk-" . self::TABLE_NAME . "-trip_service";

    /**
     * @inheritDoc
     */
    public function safeUp(): void
    {
        $this->addForeignKey(
            self::INDEX_NAME,
            self::TABLE_NAME,
            'flight_id',
            'trip_service',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * @inheritDoc
     */
    public function safeDown(): void
    {
        $this->dropForeignKey(self::INDEX_NAME, self::TABLE_NAME);
    }
}