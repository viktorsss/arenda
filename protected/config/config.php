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
	),

	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'111',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('95.133.133.163','95.133.47.51'),
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'urlManager'=>array( 
			'urlFormat'=>'path',
			'rules'=>array(
				array(
				    'class' => 'application.components.ContentUrlRule', 
				    'connectionID' => 'db',
				),/*
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',*/
			),
			'showScriptName' => false,
			'urlSuffix' => '.html',
		),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=ysbmcom_arenda2',
			'emulatePrepare' => true,
			'username' => 'dmitrywp',
			'password' => 'ZxMTAwcx', 
			'charset' => 'utf8',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
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
	'params'=>array(
            // this is used in contact page
            'adminEmail'=>'webmaster@example.com',
            'auth' => array(
                'vk' => array(
                    'client_id' => 4504656,
                    'scope' => 'notify,email',
                    'redirect_uri' => "http://arenda2.test-y-sbm.com/auth/vk",
                    'response_type' => 'code',
                    'v' => '5.24',
                ),
                'vk_sec' => array(
                    'client_secret' => 'gJuyNvYIvZinq4Vjenjm',
                ),
                'fb' => array(),
            ),
	),
);