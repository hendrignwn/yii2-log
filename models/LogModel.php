<?php

namespace hendrignwn\log\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "log_model".
 *
 * @property integer $id
 * @property string $model_name
 * @property integer $loggable
 */
class LogModel extends \yii\db\ActiveRecord
{
	const LOGGABLE_TRUE = 1;
	const LOGGABLE_FALSE = 0;
	
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'log_model';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['model_name', 'loggable'], 'required'],
			[['loggable'], 'integer'],
			[['model_name'], 'string', 'max' => 100],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'model_name' => 'Model Name',
			'loggable' => 'Loggable',
		];
	}
	
	public static function findByModelName($modelName)
	{
		$model = self::find()->where(['model_name'=>$modelName])->one();
		if($model)
			return $model;
		
		return false;
	}
	
	public function isLoggable()
	{
		if($this->loggable == self::LOGGABLE_TRUE)
			return true;
		
		return false;
	}
	
	public function getLoggableWithStyle()
	{
		switch($this->loggable){
			case self::LOGGABLE_TRUE:
				$button = Html::label('Yes', '', ['class'=>'label label-success']);
				break;
			case self::LOGGABLE_FALSE:
				$button = Html::label('No', '', ['class'=>'label label-danger']);
				break;
			default : $button = Html::label(' - ', '', ['class'=>'label label-default']);
		}
		
		return $button;
	}
	
	public function getMessage()
	{
		return Html::label("eq. app\models\ModelName", '', ['class'=>'label label-warning']);
	}
	
}
