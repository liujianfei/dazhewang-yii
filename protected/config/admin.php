<?php
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'../admin',
	'name'=>'嘉兴12580打折网管理后台',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.models.Admin',
		'application.components.*',
		'application.extensions.debugtoolbar.*',
	),

	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'dazhewang',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
	),

	'aliases'=>array('widget'=>'application.widget'),

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
				'admin/login'=>'site/login',
			),
		),*/
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=dazhewang-yii',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'root',
			'charset' => 'utf8',
			'tablePrefix' => 'dazhewang_',
			'enableProfiling'=>true,
            'schemaCachingDuration'=>0,
            'enableParamLogging'=>true,
		),
		'authManager'=>array(
            'class'=>'AuthManager',
        ),
		'errorHandler'=>array(
            //'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				// debug toolbar configuration
				/*array(
				    'class'=>'XWebDebugRouter',
				    'config'=>'alignRight, opaque, runInDebug, fixedPos, collapsed, yamlStyle',
				    'levels'=>'error, warning, trace, profile, info',
				    'allowedIPs'=>array('127.0.0.1'),
				),
				array(
				    'class' => 'YiiDebugToolbarRoute',
				),
				/*array(
				    'class'=>'CFileLogRoute',
				    'levels'=>'error',
				),*/
			),
		),
		'cache'=>array(
		    'class'=>'CFileCache',
		    'cachePath'=>'protected/runtime/cache',
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@12580gogo.com',
	    'timestamp'=>time(),
	    'upload_path'=>dirname(__FILE__).'/../../uploads/ad/',
	    'upload_url'=>'uploads/' . date('Ymd') . '/',
	),
);
?>