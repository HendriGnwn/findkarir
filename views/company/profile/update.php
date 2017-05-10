<?php

use app\models\City;
use app\models\Company;
use app\models\Partner;
use app\models\User;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Company */
/* @var $form ActiveForm */

$this->title = $profile->user->getName();
$this->params['breadcrumbs'][] = ['url' => ['/company-dashboard/index'], 'label' => 'User'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?= Yii::t('app.label', 'Update Profile Details') ?></h3>
    </div>
    <div class="panel-body">

        <?php $form = ActiveForm::begin([
            'options' => [
                'enctype' => 'multipart/form-data'
            ]
        ]); ?>

        <?= $form->errorSummary($model) ?>

        <?php if ($model->getIsPartner()) : ?>
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
        <?php else: ?>
        <?= $form->field($model, 'user_id')->widget(Select2::className(), [
            'theme' => Select2::THEME_DEFAULT,
            'data' => ArrayHelper::map(User::find()->where(['category'=>User::ROLE_GENERAL_COMPANY])->all(), 'id', 'name'),
            'pluginOptions' => [
                'allowClear'=>true,
            ],
        ]) ?>
        <?php endif; ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'address')->textarea(['maxlength' => true]) ?>

        <?= $form->field($model, 'city_id')->widget(Select2::className(), [
            'theme' => Select2::THEME_DEFAULT,
            'data' => ArrayHelper::map(City::find()->actived()->all(), 'id', 'name'),
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]) ?>

        <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'sector_area')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'employee_quantity')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'photoFile')->fileInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
