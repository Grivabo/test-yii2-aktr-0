<?php
declare(strict_types = 1);

use yii\db\Migration;

/**
 * Load nemo_guide_etalon dump.
 */
class m230603_173941_load_nemo_guide_etalon_dump extends Migration
{
    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->db = Yii::$app->dbNGE;
    }

    /**
     * @inheritDoc
     */
    public function safeUp(): void
    {
        $sql = file_get_contents(__DIR__ . '/sql/nemo_guide_etalon.sql');
        $this->execute($sql);
    }

    /**
     * @inheritDoc
     */
    public function safeDown(): void
    {
        $this->dropTable('airport_name');
    }
}