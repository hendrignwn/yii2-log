# Testa-Log [![Build Status](https://img.shields.io/travis/dektrium/yii2-user/master.svg?style=flat-square)](https://travis-ci.org/dektrium/yii2-user) [![Packagist Version](https://img.shields.io/packagist/v/dektrium/yii2-user.svg?style=flat-square)](https://packagist.org/packages/dektrium/yii2-user) [![Total Downloads](https://img.shields.io/packagist/dt/dektrium/yii2-user.svg?style=flat-square)](https://packagist.org/packages/dektrium/yii2-user) [![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

The main function is to record the changes in the model.
* There is a feature to allow users see these logs.


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

```
After, either run

```
php composer.phar require --prefer-dist hendrignwn/yii2-log "*"
```

or add

```
"hendrignwn/yii2-log": "*"
```

to the require section of your `composer.json` file.

run migration for database

```
./yii migrate --migrationPath=@hendrignwn/log/migrations
```

add in modules section of main config

```
    'modules' => [
        ...
	   'log-module' => [
            'class' => hendrignwn\log\LogModule::className(),
        ],
        ...
    ]
```

add in the Model that you want to Log in function behavior()

```
    public function behaviors() {
 		return [
            ...
 			'hendrignwn\log\behaviors\LogBehavior',
 			...
 		];
 	}
```
or add in the parent Models if it is to set up the model that you want in the Log
but this code 'hendrignwn\log\behaviors\LogBehavior' not be reused.

```
    public function behaviors() {
 		return [
            ....
 			'hendrignwn\log\behaviors\LoggableBehavior',
 			....
 		];
    }
```

Usage
-----

Once the extension is installed, check the url:
[your application base url]/index.php/log-module

Note: This Log only be accessed if the user has been logged. Otherwise it will be a error 404.


## License
Hendri Gunawan