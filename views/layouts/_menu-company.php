<?php

use kartik\helpers\Html;
use yii\bootstrap\Nav;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


?>
<?= Html::listGroup([
    [
        'content' => Yii::t('app.menu', 'Dashboard'), 
        'url' => ['/company-dashboard/index'],
        'badge' => '14',
        //'active' => true
    ],
    [
        'content' => Yii::t('app.menu', 'Profile'),
        'url' => ['/company-dashboard/profile'],
    ],
]) ?>