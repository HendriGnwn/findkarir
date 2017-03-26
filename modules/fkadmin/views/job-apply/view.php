<?php

use app\helpers\DetailViewHelper;
use app\models\JobApply;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model JobApply */

$user = $model->user;
$skills = $passions = [];
foreach ($user->skills as $skill) {
    $skills[] = Html::label($skill->name, null, ['class'=>'label label-primary']);
}
foreach ($user->passions as $passion) {
    $passions[] = Html::label($passion->jobType->name, null, ['class'=>'label label-primary']);
}

?>
<div class="job-apply-view">
 
    <div class="box box-primary">
        <div class="box-header  with-border">
            <h3 class="box-title"><?= Yii::t('app.message', 'User Details') ?></h3>
        </div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $user,
                'attributes' => [
                    'email',
                    'profile.name',
                    [
                        'attribute' => 'photo',
                        'value' => $user->profile->getPhotoImg(),
                    ],
                    [
                        'attribute' => 'gender',
                        'value' => $user->profile->getGenderLabel(),
                    ],
                    'profile.hobby',
                    [
                        'attribute' => 'married_status',
                        'value' => $user->profile->getMarriedStatusLabel(),
                    ],
                    'profile.bio',
                    [
                        'attribute' => 'profile.salary',
                        'value' => $user->profile->getFormattedExpectedSalary(),
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'cv',
                        'value' => $user->profile->getCvUrlHtml(),
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'skills',
                        'value' => implode(' ', $skills),
                        'format' => 'raw',
                    ],
                    
                    [
                        'attribute' => 'passions',
                        'value' => implode(' ', $passions),
                        'format' => 'raw',
                    ],
                    
                ],
            ]) ?>
        </div>
        <div class="box-footer">
            
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header  with-border">
            <h3 class="box-title"><?= Yii::t('app.message', 'Apply Details') ?></h3>
        </div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'job_id',
                        'value' => isset($model->job) ? $model->job->name : $model->job_id,
                    ],
                    'description',
                    [
                        'attribute' => 'review_by',
                        'value' => isset($model->reviewBy) ? $model->reviewBy->getName() : $model->review_by,
                        'format' => 'raw',
                    ],
                    'review_counter',
                    [
                        'attribute' => 'status',
                        'value' => $model->getStatusWithStyle(),
                        'format' => 'raw',
                    ],
                    'status_interview_at',
                    'status_updated_at',
                    'interview_at',
                    'venue',
                    'contact_person',
                    'contact_person_phone',
                    'created_at',
                    'updated_at',
                    DetailViewHelper::author($model, 'created_by'),
                    DetailViewHelper::author($model, 'updated_by'),
                ],
            ]) ?>
        </div>
        <div class="box-footer">
            
        </div>
    </div>

</div>
