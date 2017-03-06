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
class HomeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'app\assets\FontAsset',
        'app\assets\FontAwesomeAsset',
        'app\assets\SliderAsset',
    ];
    
    public function init() 
    {
        parent::init();
        
        $theme = \Yii::$app->params['activeFrontTheme'];
        
        $this->css = [
            'themes/'.$theme.'/magnific-popup/magnific-popup.min.css',
            'themes/'.$theme.'/materialize/css/materialize.min.css',
            'themes/'.$theme.'/bootstrap/css/bootstrap.min.css',
            'themes/'.$theme.'/css/shortcodes/shortcodesae52.css?v=5',
            'themes/'.$theme.'/css/skins/creative.css',
            'themes/'.$theme.'/styleae52.css?v=5',
            'css/site.css',
        ];
        
        $this->js = [
            'themes/'.$theme.'/bootstrap/js/bootstrap.min.js',
            'themes/'.$theme.'/materialize/js/materialize.min.js',
            'themes/'.$theme.'/js/menuzord.min.js',
            'themes/'.$theme.'/js/bootstrap-tabcollapse.min.js',
            'themes/'.$theme.'/js/jquery.easing.min.js',
            'themes/'.$theme.'/js/jquery.sticky.min.js',
            'themes/'.$theme.'/js/smoothscroll.min.js',
            'themes/'.$theme.'/js/imagesloaded.min.js',
            'themes/'.$theme.'/js/jquery.stellar.min.js',
            'themes/'.$theme.'/js/jquery.inview.min.js',
            'themes/'.$theme.'/js/jquery.shuffle.min.js',
            'themes/'.$theme.'/magnific-popup/jquery.magnific-popup.min.js',
            'themes/'.$theme.'/js/twitterFetcher.min.js',
            'themes/'.$theme.'/js/scriptsae52.js?v=5',
        ];
    }
}