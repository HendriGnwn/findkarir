<?php

use app\models\City;
use app\models\Company;
use app\models\Currency;
use app\models\Job;
use app\models\JobType;
use dosamigos\ckeditor\CKEditor;
use kartik\field\FieldRange;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\web\View;

/* @var $this View */
/* @var $model Job */
/* @var $form ActiveForm */
?>

<div class="job-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_id')->widget(Select2::className(), [
        'theme'=>Select2::THEME_DEFAULT,
        'initValueText' => isset($model->company_id) ? Company::findOne($model->company_id)->name : '',
        'pluginOptions'=>[
            'allowClear'=>true,
            'minimumInputLength' => 3,
            'language' => [
                'errorLoading' => new JsExpression("function () { return 'Waiting for results...';}"),
            ],
            'ajax' => [
                'url' => Url::to(['ajax/list-company'], true),
                'dataType' => 'json',
                'data' => new JsExpression("function (params) { return {name:params.term};}")
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(user) { return user.text; }'),
            'templateSelection' => new JsExpression('function (user) { return user.text; }'),
        ],
    ]) ?>

    <?= $form->field($model, 'job_type_id')->widget(Select2::className(), [
        'theme' => Select2::THEME_DEFAULT,
        'data' => ArrayHelper::map(JobType::find()->actived()->orderBy('name')->all(), 'id', 'name'),
        'options' => [
            'prompt' => 'Choose one',
        ]
    ]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => [
            'row' => 6,
            'preset' => 'basic',
        ],
    ]) ?>

    <?= $form->field($model, 'requirement')->widget(CKEditor::className(), [
        'options' => [
            'row' => 6,
            'preset' => 'basic',
        ],
    ]) ?>
    
    <?= $form->field($model, 'city_id')->widget(Select2::className(), [
        'theme' => Select2::THEME_DEFAULT,
        'data' => ArrayHelper::map(City::find()->actived()->all(), 'id', 'name'),
        'options' => [
            'prompt' => 'Choose one',
        ]
    ]) ?>
    
    <?= $form->field($model, 'salary_currency_id')->widget(Select2::className(), [
        'theme' => Select2::THEME_DEFAULT,
        'data' => ArrayHelper::map(Currency::find()->actived()->ordered()->all(), 'id', 'name'),
        'options' => [
            'prompt' => 'Choose one',
        ]
    ]) ?>
    
    <?= FieldRange::widget([
        'form' => $form,
        'model' => $model,
        'label' => 'Salary',
        'attribute1' => 'start_salary',
        'attribute2' => 'end_salary',
        'type' => FieldRange::INPUT_SPIN,
        'widgetOptions1' => [
            'pluginOptions' => [
                'min' => 800000,
                'max' => 30000000,
            ],
        ],
        'widgetOptions2' => [
            'pluginOptions' => [
                'min' => 1000000,
                'max' => 60000000,
            ],
        ]
    ]) ?>
    
    <?= FieldRange::widget([
        'form' => $form,
        'model' => $model,
        'label' => 'Job Publish Date',
        'attribute1' => 'open_job_date',
        'attribute2' => 'close_job_date',
        'type' => FieldRange::INPUT_DATE,
        'widgetOptions1' => [
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true,
            ]
        ],
        'widgetOptions2' => [
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd'
            ]
        ],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
