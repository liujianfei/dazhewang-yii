<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'嘉兴12580打折网',

	// preloading 'log' component
	'preload'=>array('log'),

    'aliases'=>array(
    	'widget'=>'application.widget',
        'weibo'=>'application.components.Weibo'
    ),

	// autoloading model and component classes
	'import'=>array(
		'application.admin.models.*',
		'application.components.*',
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		'db'=>array(
			'connectionString' => 'mysql:host=192.168.1.252;dbname=dazhewang-yii',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'ubuntumysql',
			'charset' => 'utf8',
			'tablePrefix' => 'dazhewang_',
		),
		'session'=>array(
		    'class'=>'CDbHttpSession',
		    'autoCreateSessionTable'=>false,
		    'connectionID'=>'db',
		),
		'errorHandler'=>array(
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
		'adminEmail'=>'webmaster@12580gogo.com',
	    'weibo'=>array(
	    	'AppKey'=>'116380272',
	        'AppSecret'=>'8a56db419637284908719de9357f9a3e',
    	),
	),
);