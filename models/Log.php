<?php

namespace hendrignwn\log\models;

use Yii;
use hendrignwn\log\models\LogDetail;

/**
 * This is the model class for table "log".
 *
 * @property integer $id
 * @property string $current_url
 * @property string $ip_address
 * @property string $model
 * @property string $model_id
 * @property string $old_attributes
 * @property string $new_attributes
 * @property string $scenario
 * @property string $created_at
 * @property string $created_by
 * 
 * @property $logDetails LogDetail[]
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['current_url', 'ip_address', 'model', 'model_id', 'scenario', 'created_at', 'created_by'], 'required'],
            [['old_attributes', 'new_attributes'], 'string'],
            [['created_at'], 'safe'],
            [['current_url'], 'string', 'max' => 100],
            [['ip_address', 'model_id', 'created_by'], 'string', 'max' => 20],
            [['model'], 'string', 'max' => 50],
            [['scenario'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'current_url' => 'Current Url',
            'ip_address' => 'Ip Address',
            'model' => 'Model',
            'model_id' => 'Model ID',
            'old_attributes' => 'Old Attributes',
            'new_attributes' => 'New Attributes',
            'scenario' => 'Scenario',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }
	
	public function getLogDetails() {
		return $this->hasMany(LogDetail::className(), ['log_id'=>'id']);
	}
}
