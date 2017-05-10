<?php

use app\models\Payment;
use app\models\PaymentType;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Payment */
/* @var $form ActiveForm */
?>

<div class="payment-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data'
        ]
    ]); ?>
    
    <?= $form->errorSummary($model) ?>

    <?= $form->field($model, 'payment_type_id')->widget(Select2::className(), [
        'theme' => Select2::THEME_DEFAULT,
        'data' => ArrayHelper::map(PaymentType::find()->actived()->ordered()->all(), 'id', 'name'),
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'behalf_of')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bill_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branch_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'logoFile')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->widget(Select2::className(), [
        'theme' => Select2::THEME_DEFAULT,
        'data' => Payment::statusLabels(),
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'order')->textInput() ?>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
