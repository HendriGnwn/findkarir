<?php

use app\models\JobApply;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model JobApply */
/* @var $form ActiveForm */
?>

<div class="job-apply-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->widget(Select2::className(), [
        'data' => JobApply::statusLabels(),
        'theme' => Select2::THEME_DEFAULT,
        'pluginOptions' => [
            'allowClear' => true,
        ],
        'options' => [
            'prompt' => 'Choose One',
        ],
    ]) ?>

    <?php
    $interviewAt = $model->interview_at == null ? date('Y-m-d H:i:s') : $model->interview_at;
    ?>
    <?= $form->field($model, 'interview_at')->textInput(['value' => $interviewAt]) ?>

    <?= $form->field($model, 'venue')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_person')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_person_phone')->textInput(['maxlength' => true]) ?>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
