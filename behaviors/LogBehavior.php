<?php

namespace hendrignwn\log\behaviors;

use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use hendrignwn\log\models\Log;
use hendrignwn\log\models\LogDetail;

/**
 * Class yang menangani proses merekam (log aktivitas) yang dilakukan user
 * Log ini akan merekam apabila ada proses Insert Update Delete
 * dan di simpan dalam database table log dan log_detail
 * Untuk log_detail hanya terisi jika pada proses Update saja + ada nilai yang di ubah pada field tertentu
 * =================
 * jika ingin menggunakan Log ini maka tinggal tempel coding dibawah ini di masing-masing model 
 * yang ingin di rekam
 * =================
 * public function behaviors() {
 *		return [
 *			'hendrignwn\log\behaviors\LogBehavior',
 *			...
 *		];
 *	}
 */

class LogBehavior extends Behavior
{
	const SCENARIO_INSERT = 'insert';
	const SCENARIO_UPDATE = 'update';
	const SCENARIO_DELETE = 'delete';
	
	private $_oldAttributes = [];
	private $_attributes = [];
	private $_owner = [];
	
	public function events() {
		parent::events();
		
		return [
			ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
			ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
			ActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdate',
			ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
		];
	}
	
	public function beforeValidate($event)
	{
		$this->setOwner($this->owner);
		$this->setOldAttributes($this->owner->getOldAttributes());
	}
	
	public function afterInsert($event)
	{
		$this->processLogging(self::SCENARIO_INSERT);
	}
	
	public function afterUpdate($event)
	{
		$this->processLogging(self::SCENARIO_UPDATE);
	}
	
	public function afterDelete($event)
	{
		$this->beforeValidate($event);
		$this->processLogging(self::SCENARIO_DELETE);
	}
	
	public function processLogging($scenario)
	{
		if($scenario==self::SCENARIO_DELETE) {
			$newAttributes = [];
			$oldAttributes = $this->getOwner()->getAttributes();
		} else {
			$newAttributes = $this->getOwner()->getAttributes();
			$oldAttributes = $this->getOldAttributes();
		}
		
		$this->saveLog($scenario, $newAttributes, $oldAttributes);
	}
	
	public function saveLog($scenario, $newAttributes, $oldAttributes=[])
	{
		$getScenarioModel = ' | $this->getScenario() = ' . $this->getOwner()->getScenario();
        
		$model = new Log();
		$model->current_url = $this->getCurrentUrl();
		$model->ip_address = $this->getIpAddress();
		$model->model = $this->getOwner()->className();
		$model->model_id = $this->getNormalizePk();
		$model->old_attributes = json_encode($oldAttributes);
		$model->new_attributes = json_encode($newAttributes);
		$model->scenario = $scenario . $getScenarioModel;
		$model->created_at = date('Y-m-d H:i:s');
		$model->created_by = $this->getUserId();
		
		$model->save(false);
		
		if($scenario==self::SCENARIO_UPDATE)
		{
			$this->loggingDetailAttributes($model->id, $newAttributes, $oldAttributes);
		}
	}
	
	public function loggingDetailAttributes($id, $newAttributes, $oldAttributes=[])
	{
		foreach($newAttributes as $name => $value)
		{
			$old = isset($oldAttributes[$name]) ? $oldAttributes[$name] : '';
			
			if($value != $old) {
				$this->saveLogDetail($id, $name, $value, $old);
			}
		}
		return true;
	}
	
	public function saveLogDetail($id, $field, $new, $old=null)
	{
		$model = new LogDetail();
		$model->log_id = $id;
		$model->field = $field;
		$model->new_value = $new;
		$model->old_value = $old;
		$model->save(false);
		return true;
	}
	
	public function setOldAttributes($value)
	{
		$this->_oldAttributes = $value;
	}
	
	public function getOldAttributes()
	{
		return $this->_oldAttributes;
	}
	
	public function setAttributes($value)
	{
		$this->_attributes = $value;
	}
	
	public function getAttributes()
	{
		return $this->_attributes;
	}
	
	public function setOwner($value)
	{
		$this->_owner = $value;
	}
	
	public function getOwner()
	{
		return $this->_owner;
	}
	
	public function getUserId()
	{
		$userId = \Yii::$app->user->id;
		if(!empty($userId))
			return $userId;
		
		return null;
	}
	
	public function getNormalizePk()
	{
		$pk = $this->getOwner()->getPrimaryKey();
		return is_array($pk) ? json_encode($pk) : $pk;
	}
	
	public function getIpAddress()
	{
		$ip = \Yii::$app->request->userIP;
		return $ip;
	}
	
	public function getCurrentUrl()
	{
		return \Yii::$app->request->getAbsoluteUrl();
	}
}