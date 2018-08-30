<?php

use yii\db\Migration;

/**
 * Handles the creation of table `relations`.
 */
class m180828_070819_create_relations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('relations', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer(),
            'journal_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('relations');
    }
}
