<?php

use yii\db\Migration;

/**
 * Handles the creation for table `log_model`.
 */
class m160606_050910_create_log_model extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('log_model', [
            'id' => $this->primaryKey(),
            'model_name' => $this->string(100)->notNull()->comment("eq. app\models\<ModelName>"),
            'loggable' => $this->integer()->defaultValue(0)->notNull()->comment("1=true, 0=false"),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('log_model');
    }
}
