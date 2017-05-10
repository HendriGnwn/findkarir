<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\Job;
use app\models\Order;
use app\models\ViewJob;
use yii\console\Controller;

/**
 * @author Hendri <hendri.gnw@gmail.com>
 */
class ConsoleController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($message = 'welcome to console app in atc')
    {
        echo $message . "\n";
    }
    
    /**
     * change order status to expired
     */
    public function actionChangeOrderStatusToExpired()
    {
        echo "   > change order status to expired \n";
        $order = Order::consoleChangeOrderStatusToExpired();
        
        $response = $order ? 'Success' : 'Failure';
        
        echo "   > ".$response;
    }
    
    /**
     * view job refresh
     */
    public function actionViewJobRefreshCache()
    {
        echo "   > truncate `view_job`; \n";
        echo "   > insert into `view_job` select * from `raw_view_job`; \n";
        
        ViewJob::consoleRefreshCache();
        
        echo "   > Success";
    }
    
    /**
     * jobs status payments managements
     */
    public function actionManageJobStatusPayments()
    {
        Job::consoleManageJobStatusPayments();
        
        echo "   > Success";
    }
}
