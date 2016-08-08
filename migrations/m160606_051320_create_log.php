<?php

use yii\db\Migration;

/**
 * Handles the creation for table `log`.
 */
class m160606_051320_create_log extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('log', [
            'id' => $this->primaryKey(),
            'current_url' => $this->string(100)->notNull(),
            'ip_address' => $this->string(20)->notNull(),
            'model' => $this->string(50)->notNull(),
            'model_id' => $this->string(20)->notNull(),
            'old_attributes' => $this->text(),
            'new_attributes' => $this->text(),
            'scenario' => $this->string(50)->notNull(),
            'created_at' => $this->datetime()->notNull(),
            'created_by' => $this->string(20)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('log');
    }
}
