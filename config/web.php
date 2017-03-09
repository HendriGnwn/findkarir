<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'findkarir-web',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
	
	// default language to use for i18n purpose
    // source translation is located in @app/messages directory
    //'language' => 'id-ID',
    
    //'catchAll' => ['site/maintenance'],
	
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'PMhCjqJMaxttXQNLaLfAKNYJ8PaF_2uR',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            //'enableAutoLogin' => true,
            'enableSession' => true,
            'authTimeout' => 60 * 60, /* 1 hour */
        ],
		'i18n' => [
            'translations' => [
				'*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                ],
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en-US',
                    'basePath' => '@app/messages',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app.menu' => 'app.menu.php',
						'app.label' => 'app.label.php',
                        'app.message' => 'app.message.php',
                        'app.button' => 'app.button.php',
                        'app.static' => 'app.static.php',
                    ],
                ],
            ],
		],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => require(__DIR__ . '/mailer.php'),
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => require(__DIR__ . '/url-manager.php'),
		'view' => [
            'class' => 'app\components\View',
			'theme' => [
				'pathMap' => [
                    '@app/views' => '@app/themes/'.$params['activeFrontTheme'].'/views',
					/** for administrator module */
                    '@app/modules/fkadmin/views' => '@app/themes/'.$params['activeAdminTheme'].'/views',
                    '@dektrium/user/views' => '@app/themes/'.$params['activeAdminTheme'].'/views'
				],
			],
		],
		'assetManager' => [
			'bundles' => [
				'dmstr\web\AdminLteAsset' => [
					'skin' => 'skin-blue-light',
				],
			],
		],
		'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
        ]
    ],
    'modules' => [
        'gridview' => [
			'class' => '\kartik\grid\Module'
		],
		'fkadmin' => [
			'class' => 'app\modules\fkadmin\Module',
		],
		'user' => [
			'class' => 'dektrium\user\Module',
			'admins' => ['admin'],
//			'controllerMap' => [
//                'security' => [
//					'class' => dektrium\user\controllers\SecurityController::className(),
//					'layout' => '@app/themes/admin-lte/views/layouts/plain',
//                ],
//                'settings' => [
//					'class' => 'app\controllers\user\SettingsController',
//					'layout' => '@app/themes/admin-lte/views/layouts/main',
//                ],
//                'registration' => [
//					'class' => dektrium\user\controllers\RegistrationController::className(),
//					'layout' => '@app/themes/admin-lte/views/layouts/plain',
//                ],
//                'recovery' => [
//					'class' => dektrium\user\controllers\RecoveryController::className(),
//					'layout' => '@app/themes/admin-lte/views/layouts/plain',
//                ],
//			],
			'modelMap' => [
				'UserSearch' => 'app\modules\fkadmin\models\UserSearch',
				'User' => 'app\models\User',
				'Profile' => 'app\models\Profile',
			],
		],
	],
	'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
