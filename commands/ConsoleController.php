<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\ScheduledEmail;
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
    
    public function actionChangeOrderStatusToExpired()
    {
        echo "   > change order status to expired \n";
        $order = \app\models\Order::consoleChangeOrderStatusToExpired();
        
        $response = $order ? 'Success' : 'Failure';
        
        echo "   > ".$response;
    }
    
    public function actionViewJobRefreshCache()
    {
        echo "   > truncate `view_job`; \n";
        echo "   > insert into `view_job` select * from `raw_view_job`; \n";
        
        \app\models\ViewJob::consoleRefreshCache();
        
        echo "   > Success";
    }
}
