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
    ];
    
    public function init() 
    {
        parent::init();
        
        $theme = \Yii::$app->params['activeFrontTheme'];
        
        $this->css = [
            'themes/'.$theme.'/css/style.css',
            'themes/'.$theme.'/css/headers/header-default.css',
            'themes/'.$theme.'/css/footers/footer-v3.css',
            'themes/'.$theme.'/plugins/animate.css',
            'themes/'.$theme.'/plugins/line-icons/line-icons.css',
            'themes/'.$theme.'/plugins/owl-carousel/owl-carousel/owl.carousel.css',
            'themes/'.$theme.'/plugins/layer-slider/layerslider/css/layerslider.css',
            'themes/'.$theme.'/plugins/image-hover/css/img-hover.css',
            'themes/'.$theme.'/css/pages/page_job.css',
            'themes/'.$theme.'/css/theme-colors/blue.css',
            'themes/'.$theme.'/css/theme-skins/dark.css',
            'themes/'.$theme.'/css/custom.css',
            'css/site.css',
        ];
        
        $this->js = [
            'themes/'.$theme.'/plugins/jquery/jquery.min.js',
            'themes/'.$theme.'/plugins/jquery/jquery-migrate.min.js',
            'themes/'.$theme.'/plugins/bootstrap/js/bootstrap.min.js',
            'themes/'.$theme.'/plugins/back-to-top.js',
            'themes/'.$theme.'/plugins/smoothScroll.js',
            'themes/'.$theme.'/plugins/jquery.parallax.js',
            'themes/'.$theme.'/plugins/image-hover/js/modernizr.js',
            'themes/'.$theme.'/js/custom.js',
            'themes/'.$theme.'/js/imagesloaded.min.js',
            'themes/'.$theme.'/js/app.js',
            'themes/'.$theme.'/plugins/style-switcher.js',
            'themes/'.$theme.'/js/init-parallax.js',
        ];
    }
}