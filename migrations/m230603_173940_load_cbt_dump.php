<?php
declare(strict_types = 1);

use yii\db\Migration;

/**
 * Load sbt dump.
 */
class m230603_173940_load_cbt_dump extends Migration
{
    /**
     * @inheritDoc
     */
    public function safeUp(): void
    {
        $sql = file_get_contents(__DIR__ . '/sql/cbt.sql');
        $this->execute($sql);
    }

    /**
     * @inheritDoc
     */
    public function safeDown(): void
    {
        $this->dropTable('flight_segment');
        $this->dropTable('trip_service');
        $this->dropTable('trip');
    }
}