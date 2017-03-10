<?php

use app\models\City;
use app\models\Partner;
use app\models\PartnerBranch;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model PartnerBranch */
/* @var $form ActiveForm */
?>

<div class="partner-branch-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'partner_id')->widget(Select2::className(), [
        'initValueText' => $model->partner_id ? Partner::findOne($model->partner_id)->name : '',
        'theme' => Select2::THEME_DEFAULT,
        'pluginOptions' => [
            'allowClear'=>true,
            'minimumInputLength' => 3,
            'language' => [
                'errorLoading' => new JsExpression("function () { return 'Waiting for results...';}"),
            ],
            'ajax' => [
                'url' => Url::to(['ajax/list-partner'], true),
                'dataType' => 'json',
                'data' => new JsExpression("function (params) { return {name:params.term};}")
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(user) { return user.text; }'),
            'templateSelection' => new JsExpression('function (user) { return user.text; }'),
        ],
    ]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

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

    <?= $form->field($model, 'status')->widget(Select2::className(), [
        'theme' => Select2::THEME_DEFAULT,
        'data' => Partner::statusLabels(),
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
