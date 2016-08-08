<?php

use yii\db\Migration;

/**
 * Handles the creation for table `log_detail`.
 */
class m160606_051512_create_log_detail extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('log_detail', [
            'id' => $this->primaryKey(),
            'log_id' => $this->integer()->notNull(),
            'field' => $this->string(30)->notNull(),
            'old_value' => $this->text()->notNull(),
            'new_value' => $this->text()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('log_detail');
    }
}
