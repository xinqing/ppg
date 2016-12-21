<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.helpers.*',
		'application.extensions.*',	
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'111',
			'ipFilters'=>array('10.12.50.22'),
		),
		"seller"
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error404',
		),		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'urlSuffix'=>'.php',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
			'showScriptName' => false,
		),
		'curl' => array(
			'class' => 'ext.curl.Curl',
		),
		'thumb'=>array(
		  'class'=>'ext.CThumb',
		 ),			
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
		'db'=>array(
			'connectionString' => 'mysql:host=10.120.50.124;dbname=malls',
			'emulatePrepare' => true,
			'username' => 'mallsuser',
			'password' => 'qwerASDF1',
			'charset' => 'utf8',
		),
		
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params' => array(
		'tokenParams' => array(
			'version' =>'0.0.1',								       //接口参数配置
			'appkey' =>'1035541',                                      //加密版本号
			'time' => date("Y-m-d H:i:s",time()),                      //加密当前时间
			"channel"   =>"30",    
		),
		'route' => include(dirname(__FILE__) . '/routeParams.php'),
		'pay' => include(dirname(__FILE__) . '/payConfig.php'),
		
		//支付宝异步回调地址
		'alipay_notify_url' => '',
	)
);