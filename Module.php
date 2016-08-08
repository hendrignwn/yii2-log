<?php

namespace hendrignwn\log;

/**
 * log-module module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'hendrignwn\log\controllers';
	
    public $defaultRoute = 'log/index';
    
    public $layout = 'main';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        
        if(\Yii::$app->user->isGuest) {
            throw new \yii\web\HttpException(404, 'Page not found..');
		}
		
        // custom initialization code goes here
    }
}
