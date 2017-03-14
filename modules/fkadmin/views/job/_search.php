<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\fkadmin\models\JobSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="job-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'company_id') ?>

    <?= $form->field($model, 'job_type_id') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'requirement') ?>

    <?php // echo $form->field($model, 'city_id') ?>

    <?php // echo $form->field($model, 'province_id') ?>

    <?php // echo $form->field($model, 'salary_currency_id') ?>

    <?php // echo $form->field($model, 'start_salary') ?>

    <?php // echo $form->field($model, 'end_salary') ?>

    <?php // echo $form->field($model, 'open_job_date') ?>

    <?php // echo $form->field($model, 'close_job_date') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'status_updated_at') ?>

    <?php // echo $form->field($model, 'status_payment') ?>

    <?php // echo $form->field($model, 'status_payment_updated_at') ?>

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
