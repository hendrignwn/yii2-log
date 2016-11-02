<?php

namespace hendrignwn\log\models;

use Yii;

/**
 * This is the model class for table "log_detail".
 *
 * @property integer $id
 * @property integer $log_id
 * @property string $field
 * @property string $old_value
 * @property string $new_value
 */
class LogDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['log_id', 'field', 'old_value', 'new_value'], 'safe'],
            [['log_id'], 'integer'],
            [['old_value', 'new_value'], 'string'],
            [['field'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'log_id' => 'Log ID',
            'field' => 'Field',
            'old_value' => 'Old Value',
            'new_value' => 'New Value',
        ];
    }
}
