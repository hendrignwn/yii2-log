<?php

namespace hendrignwn\log\behaviors;

use yii\base\Behavior;
use yii\db\ActiveRecord;
use hendrignwn\log\models\LogModel;
use hendrignwn\log\behaviors\LogBehavior;

/**
 * Class ini menangani Jalan atau tidaknya class hendrignwn\log\behaviors\LogBehavior::className()
 * Log ini akan mengecek kedalam table log_model apakah model yang saat ini (bersangkutan)
 * bisa di log / direkam atau tidak, jika ya (log_model.loggable=1) maka 
 * jalankan behavior hendrignwn\log\behaviors\LogBehavior::className()
 * 
 * ==============
 * Untuk menjalankan class ini sangat mudah, cukup taruh coding 'hendrignwn\log\behaviors\LoggableBehavior' 
 * dibagian function behaviors() model 
 * 
 * public function behaviors() {
 *		return [
 *			'hendrignwn\log\behaviors\LoggableBehavior',
 *			//'hendrignwn\log\behaviors\LogBehavior', (**)
 *			....
 *		];
 *	}
 * 
 *  (**) -> jika terdapat baris code LogBehavior didalam function behaviors() maka hapus saja
 *          karena di class LoggableBehavior ini sudah ada coding untuk memanggil LogBehavior
 *		 -> alasan lain karena kita akan memanage rekam atau tidaknya table/model yang bersangkutan
 * ==============
 */

class LoggableBehavior extends Behavior
{
	public function events() {
		parent::events();
			
		return [
			ActiveRecord::EVENT_INIT => 'process',
		];
	}
	
	public function process()
	{
		if($this->isModelLoggable()) {
			
			$this->owner->attachBehavior('LogBehavior', [
				'class' => LogBehavior::className(),
			]);
			
		}
		
		return true;
	}
	
	private function isModelLoggable()
	{
		$model = LogModel::findByModelName($this->owner->className());

		if($model) {
			
			if($model->isLoggable())
				return true;
			
		}
		
		return false;
	}
	
}