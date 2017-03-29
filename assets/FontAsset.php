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
class FontAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'https://fonts.googleapis.com/css?family=Raleway:400,300,500,700,900',
        'http://fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin',
    ];
    public $js = [
    ];
    public $depends = [
    ];
}
