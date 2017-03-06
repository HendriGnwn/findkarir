<?php

namespace app\modules\fkadmin;

use app\models\Config;
use Yii;
use yii\base\Module as BaseModule;
use yii\helpers\ArrayHelper;

/**
 * fkadmin module definition class
 */
class Module extends BaseModule
{
    public $layout = '@app/modules/fkadmin/views/layouts/main';
    
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\fkadmin\controllers';

    /**
	 * url without validation isGuest
	 * 
	 * @var $publicRoute
	 */
	protected $publicRoute;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
		
		$this->publicRoute = Config::getAdministratorPublicUrl();
		
		/** error handler for module administrator */
		Yii::$app->errorHandler->errorAction = 'fkadmin/default/error';
        
        /** set login url for administrator login */
        Yii::$app->setComponents(ArrayHelper::merge(Yii::$app->getComponents(), [
            'user' => [
                'loginUrl' => ['fkadmin/default/login']
            ]
        ]));
        
        $this->setModule('admin', [
            'class' => 'mdm\admin\Module',
			'layout' => '@app/themes/admin-lte/views/layouts/main',
        ]);
        
        $this->setModule('user', [
			'class' => 'dektrium\user\Module',
			'admins' => ['admin'],
			'controllerMap' => [
				'admin' => [
					'class' => '\app\modules\fkadmin\controllers\user\AdminController',
					'layout' => '@app/themes/admin-lte/views/layouts/main',
                ],
                'recovery' => [
					'class' => \dektrium\user\controllers\RecoveryController::className(),
					'layout' => '@app/themes/admin-lte/views/layouts/plain',
                ],
                'security' => [
					'class' => '\app\modules\fkadmin\controllers\user\SecurityController',
					'layout' => '@app/themes/admin-lte/views/layouts/main-login',
                ],
			],
			'modelMap' => [
				'UserSearch' => 'app\modules\fkadmin\models\UserSearch',
			],
		]);
		
		/** checkIsLogin */
		$this->checkIsLogin();
    }
	
	/**
	 * check is login, if identity is null, then login required
	 */
	protected function checkIsLogin()
	{
		$route = Yii::$app->getRequest()->getUrl();
		if (
			(Yii::$app->user->getIsGuest()) && 
			(!in_array($route, $this->publicRoute))
		) {
			Yii::$app->requestedRoute = 'fkadmin';
            Yii::$app->user->loginRequired();
        }
	}
}
