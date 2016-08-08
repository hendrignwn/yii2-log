<?php

	use yii\bootstrap\Nav;

    $menuItems = [
		['label' => 'Home', 'url' => \yii\helpers\Url::home()],
		['label' => 'Log', 'url' => ['/log-module/log/index']],
		['label' => 'Log Model', 'url' => ['/log-module/log-model/index']],
    ];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);