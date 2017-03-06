<?php

use app\models\City;
use app\models\Partner;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Partner */
/* @var $form ActiveForm */
?>

<div class="partner-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data'
        ]
    ]); ?>
    
    <?= $form->errorSummary($model) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php // echo $form->field($model, 'legal')->textInput() ?>

    <?= $form->field($model, 'photoFile')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textarea(['maxlength' => true, 'rows' => 6]) ?>

    <?= $form->field($model, 'city_id')->widget(Select2::className(), [
        'theme' => Select2::THEME_DEFAULT,
        'data' => ArrayHelper::map(City::find()->all(), 'id', 'name'),
        'pluginOptions' => [
            'allowClear' => true
        ],
        'options' => [
            'prompt' => 'Choose One',
        ]
    ]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'public_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->widget(Select2::className(), [
        'theme' => Select2::THEME_DEFAULT,
        'data' => Partner::statusLabels(),
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app.button', 'Create') : Yii::t('app.button', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
