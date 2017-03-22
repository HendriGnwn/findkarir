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
        'url' => ['/user-dashboard/index'],
        'badge' => '14',
        //'active' => true
    ],
    [
        'content' => Yii::t('app.menu', 'Profile'),
        'url' => ['/user/profile/index'],
    ],
        [
        'content' => Yii::t('app.menu', 'Skills'),
        'url' => ['/skill/index'],
    ],
        [
        'content' => Yii::t('app.menu', 'Passions'),
        'url' => ['/passion/index'],
    ],
        [
        'content' => Yii::t('app.menu', 'Educations'),
        'url' => ['/education/index'],
    ],
        [
        'content' => Yii::t('app.menu', 'Job Applies'),
        'url' => ['/user-dashboard/job-apply'],
    ],
    [
        'content' => Yii::t('app.menu', 'Walk in Interviews'),
        'url' => ['/user-dashboard/walk-interview'],
    ],
    [
        'content' => Yii::t('app.menu', 'Account Details'),
        'url' => ['/user/settings/account'],
    ],
]) ?>