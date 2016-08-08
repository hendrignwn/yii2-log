<?php

namespace hendrignwn\log\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class LogAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
