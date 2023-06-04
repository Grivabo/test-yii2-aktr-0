<?php
declare(strict_types = 1);

use yii\db\Migration;

/**
 * Handles the creation of FK for `trip_service`.
 */
class m230603_173942_add_fk_in_trip_service_to_trip_table extends Migration
{
    public const TABLE_NAME = 'trip_service';
    public const INDEX_NAME = "fk-" . self::TABLE_NAME . "-trip";

    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->addForeignKey(
            self::INDEX_NAME,
            self::TABLE_NAME,
            'trip_id',
            'trip',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropForeignKey(self::INDEX_NAME, self::TABLE_NAME);
    }
}