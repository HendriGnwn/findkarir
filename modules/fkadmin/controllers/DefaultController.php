<?php

namespace app\modules\fkadmin\controllers;

use app\models\Job;
use app\models\LoginForm;
use app\models\Order;
use app\models\User;
use app\modules\fkadmin\models\OrderSearch;
use app\modules\fkadmin\models\ViewJobSearch;
use dektrium\user\controllers\SecurityController;
use dektrium\user\traits\AjaxValidationTrait;
use dektrium\user\traits\EventTrait;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Default controller for the `fkadmin` module
 */
class DefaultController extends Controller
{
	use AjaxValidationTrait;
    use EventTrait;
	
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
	
	/**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
	
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $jobsFree = new ViewJobSearch();
        $dataProviderJobsFree = $jobsFree->search(\Yii::$app->request->queryParams);
        $dataProviderJobsFree->query->andWhere([
            'status_payment' => Job::STATUS_PAYMENT_FREE,
        ]);
        
        $jobsPremium = new ViewJobSearch();
        $dataProviderJobsPremium = $jobsPremium->search(\Yii::$app->request->queryParams);
        $dataProviderJobsPremium->query->andWhere([
            'status_payment' => Job::STATUS_PAYMENT_PAID,
        ]);
        
        $ordersActives = new OrderSearch();
        $dataProviderOrdersActives = $ordersActives->search(\Yii::$app->request->queryParams);
        $dataProviderOrdersActives->query->andWhere([
            'status' => Order::STATUS_PAID,
        ]);
        
        return $this->render('index', [
            'searchJobsFree' => $jobsFree,
            'dataProviderJobsFree' => $dataProviderJobsFree,
            'searchJobsPremium' => $jobsPremium,
            'dataProviderJobsPremium' => $dataProviderJobsPremium,
            'searchOrdersActives' => $ordersActives,
            'dataProviderOrdersActives' => $dataProviderOrdersActives,
        ]);
    }
	
	/**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            $this->goHome();
        }
        
        $this->layout = '@app/themes/'.Yii::$app->params['activeAdminTheme'].'/views/layouts/main-login';

        /** @var LoginForm $model */
        $model = \Yii::createObject(LoginForm::className());
        $event = $this->getFormEvent($model);

        $this->performAjaxValidation($model);

        $this->trigger(SecurityController::EVENT_BEFORE_LOGIN, $event);
        $model->category = User::ROLE_SUPERADMIN;

        if ($model->load(\Yii::$app->getRequest()->post()) && $model->login()) {
            $this->trigger(SecurityController::EVENT_AFTER_LOGIN, $event);
            return $this->goBack(['fkadmin']);
        }

        return $this->render('login', [
            'model'  => $model,
            'module' => $this->module,
        ]);
    }
	
	/**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        $event = $this->getUserEvent(\Yii::$app->user->identity);

        $this->trigger(SecurityController::EVENT_BEFORE_LOGOUT, $event);

        \Yii::$app->getUser()->logout();

        $this->trigger(SecurityController::EVENT_AFTER_LOGOUT, $event);

        return $this->goHome();
    }
}
