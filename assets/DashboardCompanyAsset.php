<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Hendri <hendri.gnw@gmail.com>
 */
class DashboardCompanyAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'app\assets\FontAsset',
        'app\assets\FontAwesomeAsset',
    ];
    
    public function init() 
    {
        parent::init();
        
        $theme = \Yii::$app->params['activeFrontTheme'];
        
        $this->css = [
            'themes/'.$theme.'/plugins/simple-line-icons/simple-line-icons.min.css',
            'themes/'.$theme.'/plugins/bootstrap-switch/css/bootstrap-switch.min.css',
            'themes/'.$theme.'/plugins/morris/morris.css',
            'themes/'.$theme.'/plugins/jqvmap/jqvmap/jqvmap.css',
            'themes/'.$theme.'/css/css/components.min.css',
            'themes/'.$theme.'/css/css/plugins.min.css',
            'themes/'.$theme.'/layout2/css/layout.min.css',
            'themes/'.$theme.'/layout2/css/themes/blue.min.css',
            'themes/'.$theme.'/layout2/css/custom.min.css',
            'css/site.css',
        ];
        
        $this->js = [
            'themes/'.$theme.'/plugins/jquery.min.js',
            'themes/'.$theme.'/plugins/bootstrap/js/bootstrap.min.js',
            'themes/'.$theme.'/plugins/js.cookie.min.js',
            'themes/'.$theme.'/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
            'themes/'.$theme.'/plugins/jquery.blockui.min.js',
            'themes/'.$theme.'/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
            'themes/'.$theme.'/plugins/moment.min.js',
            'themes/'.$theme.'/plugins/morris/morris.min.js',
            'themes/'.$theme.'/plugins/morris/raphael-min.js',
            'themes/'.$theme.'/plugins/counterup/jquery.waypoints.min.js',
            'themes/'.$theme.'/plugins/counterup/jquery.counterup.min.js',
            'themes/'.$theme.'/plugins/amcharts/amcharts/amcharts.js',
            'themes/'.$theme.'/plugins/amcharts/amcharts/serial.js',
            'themes/'.$theme.'/plugins/amcharts/amcharts/pie.js',
            'themes/'.$theme.'/plugins/amcharts/amcharts/radar.js',
            'themes/'.$theme.'/plugins/amcharts/amcharts/themes/light.js',
            'themes/'.$theme.'/plugins/amcharts/amcharts/themes/patterns.js',
            'themes/'.$theme.'/plugins/amcharts/amcharts/themes/chalk.js',
            'themes/'.$theme.'/plugins/amcharts/ammap/ammap.js',
            'themes/'.$theme.'/plugins/amcharts/ammap/maps/js/worldLow.js',
            'themes/'.$theme.'/plugins/amcharts/amstockcharts/amstock.js',
            'themes/'.$theme.'/plugins/horizontal-timeline/horizontal-timeline.js',
            'themes/'.$theme.'/plugins/flot/jquery.flot.min.js',
            'themes/'.$theme.'/plugins/flot/jquery.flot.resize.min.js',
            'themes/'.$theme.'/plugins/flot/jquery.flot.categories.min.js',
            'themes/'.$theme.'/plugins/jquery-easypiechart/jquery.easypiechart.min.js',
            'themes/'.$theme.'/plugins/jquery.sparkline.min.js',
            'themes/'.$theme.'/plugins/jqvmap/jqvmap/jquery.vmap.js',
            'themes/'.$theme.'/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js',
            'themes/'.$theme.'/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js',
            'themes/'.$theme.'/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js',
            'themes/'.$theme.'/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js',
            'themes/'.$theme.'/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js',
            'themes/'.$theme.'/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js',
            'themes/'.$theme.'/scripts/app.min.js',
            'themes/'.$theme.'/scripts/dashboard.min.js',
            'themes/'.$theme.'/layout2/scripts/layout.min.js',
            'themes/'.$theme.'/layout2/scripts/demo.min.js',
            'themes/'.$theme.'/ajax/scripts/quick-sidebar.min.js',
            'themes/'.$theme.'/ajax/scripts/quick-nav.min.js',
        ];
    }
}