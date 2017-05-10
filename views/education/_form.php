<?php

use app\models\Config;
use app\models\Education;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Education */
/* @var $form ActiveForm */
?>

<div class="education-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category')->dropDownList(Config::getEducationCategories()) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'department')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'started_at')->widget(DatePicker::className(), [
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy',
            'viewMode' => 'years', 
            'minViewMode' => 'years'
        ],
    ]) ?>

    <?= $form->field($model, 'graduated_at')->widget(DatePicker::className(), [
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy',
            'viewMode' => 'years', 
            'minViewMode' => 'years'
        ],
    ]) ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
