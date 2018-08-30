<?php

use yii\db\Migration;

/**
 * Handles the creation of table `journals`.
 */
class m180827_075820_create_journals_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('journals', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'desc' => $this->string(),
            'img_file' => $this->string(),
            'production_date' => $this->date(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('journals');
    }
}
