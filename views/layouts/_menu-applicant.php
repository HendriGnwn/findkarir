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

$url = '';
if (isset(Yii::$app->controller->id) && isset(Yii::$app->controller->action->id)) {
    $url = Yii::$app->controller->id .'/'. Yii::$app->controller->action->id;
}
echo $url;
?>

<?= Html::listGroup([
    'options' => [
        'class' => 'list-group sidebar-nav-v1 margin-bottom-40'
    ],
    [
        'content' => Yii::t('app.menu', 'Dashboard'), 
        'url' => ['/user-dashboard/index'],
        'badge' => '14',
        'active' => $url == 'user-dashboard/index' ? true : false,
    ],
    [
        'content' => Yii::t('app.menu', 'Profile'),
        'url' => ['/user/profile/index'],
        'active' => $url == 'profile/index' ? true : false,
    ],
    [
        'content' => Yii::t('app.menu', 'Skills'),
        'url' => ['/skill/index'],
        'active' => $url == 'skill/index' ? true : false,
    ],
    [
        'content' => Yii::t('app.menu', 'Passions'),
        'url' => ['/passion/index'],
        'active' => $url == 'passion/index' ? true : false,
    ],
    [
        'content' => Yii::t('app.menu', 'Educations'),
        'url' => ['/education/index'],
        'active' => $url == 'education/index' ? true : false,
    ],
    [
        'content' => Yii::t('app.menu', 'Job Applies'),
        'url' => ['/user-dashboard/job-apply'],
        'badge' => $badgeJobApply,
        'active' => $url == 'user-dashboard/job-apply' ? true : false,
    ],
    [
        'content' => Yii::t('app.menu', 'Walk in Interviews'),
        'url' => ['/user-dashboard/walk-interview'],
        'badge' => $badgeInterview,
        'active' => $url == 'user-dashboard/walk-interview' ? true : false,
    ],
    [
        'content' => Yii::t('app.menu', 'Account Details'),
        'url' => ['/user/settings/account'],
        'active' => $url == 'settings/account' ? true : false,
    ],
]) ?>