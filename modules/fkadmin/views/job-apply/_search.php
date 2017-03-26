<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\fkadmin\models\JobApplySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="job-apply-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'job_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'review_by') ?>

    <?php // echo $form->field($model, 'review_counter') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'status_interview_at') ?>

    <?php // echo $form->field($model, 'status_updated_at') ?>

    <?php // echo $form->field($model, 'interview_at') ?>

    <?php // echo $form->field($model, 'venue') ?>

    <?php // echo $form->field($model, 'contact_person') ?>

    <?php // echo $form->field($model, 'contact_person_phone') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
