<?php

use app\models\JobApply;
use kartik\helpers\Html;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$badgeJobApply = JobApply::find()->where(['status' => JobApply::STATUS_ACTIVE, 'user_id' => Yii::$app->user->id])->count();
if ($badgeJobApply <= 0) {
    $badgeJobApply = null;
}

$badgeInterview = JobApply::find()->where(['status' => JobApply::STATUS_INTERVIEW, 'user_id' => Yii::$app->user->id])->count();
if ($badgeInterview <= 0) {
    $badgeInterview = null;
}

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
        'badge' => $badgeJobApply,
    ],
    [
        'content' => Yii::t('app.menu', 'Walk in Interviews'),
        'url' => ['/user-dashboard/walk-interview'],
        'badge' => $badgeInterview,
    ],
    [
        'content' => Yii::t('app.menu', 'Account Details'),
        'url' => ['/user/settings/account'],
    ],
]) ?>
<?= Html::beginForm(['/user/logout'], 'post') ?>
<?= Html::submitButton(
    'Logout (' . Yii::$app->user->identity->username . ')',
    ['class' => 'btn btn-link logout']
) ?>
<?= Html::endForm() ?>