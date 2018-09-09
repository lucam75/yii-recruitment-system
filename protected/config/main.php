<?php
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../modules/bootstrap');
Yii::setPathOfAlias('chartjs', dirname(__FILE__).'/../modules/bootstrap/extensions/yii-chartjs-master');
Yii::setPathOfAlias('ckeditor', dirname(__FILE__).'/../extensions/TheCKEditor');

$databaseName = "candidates"; //Database name
$user = "root"; // set the database user. Default: root
$password = ""; //set the user's password
$host = "localhost"; // Path to your webserver. Default: localhost

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Recruiment System',
	'language'=>'en',
	'sourceLanguage'=>'en',
	// preloading 'log' component
	'preload'=>array('log','chartjs'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	  	'bootstrap.*',
        'bootstrap.components.*',
        'bootstrap.models.*',
        'bootstrap.controllers.*',
        'bootstrap.helpers.*',
        'bootstrap.widgets.*',
        'bootstrap.extensions.*',
        'chartjs.*',
        'chartjs.widgets.*',
        'chartjs.components.*',
	),
	'aliases' => array(
        // 'bootstrap' => 'application.modules.bootstrap',
        // 'chartjs' => 'application.modules.bootstrap.extensions.yii-chartjs-master'
    ),
	'modules'=>array(
		'bootstrap' => array(
            'class' => 'bootstrap.BootStrapModule'
        ),
		// uncomment the following to enable the Gii tool

		// 'gii'=>array(
		// 	'class'=>'system.gii.GiiModule',
		// 	'password'=>'lk8',
		// 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
		// 	'ipFilters'=>array('127.0.0.1','::1'),
		// ),

	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'bsHtml' => array('class' => 'bootstrap.components.BSHtml'),
        'chartjs'=>array('class' => 'chartjs.components.ChartJs'),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			//'urlSuffix'=>'',
			'rules'=>array(
						'<controller:\w+>/<id:\d+>'=>'<controller>/view',
						'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
						'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		// 'db'=>array(
		// 	'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		// ),
		// uncomment the following to use a MySQL database

		'db'=>array(
			'connectionString' => 'mysql:host='.$host.';dbname='.$databaseName,
			'emulatePrepare' => true,
			'username' => $user,
			'password' => $password,
			'charset' => 'utf8',
		),
		'messages'=>array(
			'onMissingTranslation'=>array('EventTranslation','missingTranslation'),
			'cachingDuration' => 0,

		),
		'coreMessages'=>array(
			'basePath'=>'protected/messages',
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
		'bootstrap'=>array(
	        'class'=>'bootstrap.components.Bootstrap',
	    ),
		'ePdf' => array(
	        'class'         => 'ext.yii-pdf.EYiiPdf',
	        'params'        => array(
	            'mpdf'     => array(
	                'librarySourcePath' => 'application.vendors.mpdf.*',
	                'constants'         => array(
	                    '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
	                ),
	                'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
	                'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
	                    'mode'              => '', //  This parameter specifies the mode of the new document.
	                    'format'            => 'A4', // format A4, A5, ...
	                    'default_font_size' => 12, // Sets the default document font size in points (pt)
	                    'default_font'      => 'Arial', // Sets the default font-family for the new document.
	                    'mgl'               => 50, // margin_left. Sets the page margins for the new document.
	                    'mgr'               => 80, // margin_right
	                    'mgt'               => 60, // margin_top
	                    'mgb'               => 32, // margin_bottom
	                    'mgh'               => 10, // margin_header
	                    'mgf'               => 10, // margin_footer
	                    'orientation'       => 'P', // landscape or portrait orientation
	                )
	            ),
	        ),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'languages'=>array('en'=>'en', 'es'=>'es'),
	),
	'theme'=>'cosmo', // requires you to copy the theme under your themes directory
);