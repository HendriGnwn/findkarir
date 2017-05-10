<?php

use app\models\Page;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Page */
/* @var $form ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data'
        ]
    ]); ?>
    
    <?= $form->errorSummary($model) ?>

    <?= $form->field($model, 'category')->widget(Select2::className(), [
        'theme' => Select2::THEME_DEFAULT,
        'data' => Page::categoryLabels(),
    ]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'photoFile')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date_post')->textInput(['value' => $model->isNewRecord ? date('Y-m-d H:i:s') : $model->date_post]) ?>

    <?= $form->field($model, 'meta_description')->textarea(['maxlength' => true, 'rows' => 6]) ?>

    <?= $form->field($model, 'status')->widget(Select2::className(), [
        'theme' => Select2::THEME_DEFAULT,
        'data' => Page::statusLabels(),
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
