<?php

use yii\bootstrap\Nav;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


?>
<?= Nav::widget([
    'options' => ['class' => ''],
    'items' => [
        ['label'=>Yii::t('app.menu', 'Dashboard'), 'url'=>['/user-dashboard/index']],
        ['label'=>Yii::t('app.menu', 'Profile'), 'url'=>['/user/profile']],
        ['label'=>Yii::t('app.menu', 'Skills'), 'url'=>['/skill/index']],
        ['label'=>Yii::t('app.menu', 'Passions'), 'url'=>['/passion/index']],
        ['label'=>Yii::t('app.menu', 'Educations'), 'url'=>['/education/index']],
        ['label'=>Yii::t('app.menu', 'Job Applies'), 'url'=>['/user-dashboard/job-apply']],
        ['label'=>Yii::t('app.menu', 'Walk in Interviews'), 'url'=>['/user-dashboard/walk-interview']],
    ],
]) ?>