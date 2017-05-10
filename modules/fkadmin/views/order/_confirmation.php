<?php

use app\models\Currency;
use app\models\OrderConfirmation;
use app\models\Payment;
use app\models\User;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model OrderConfirmation */
/* @var $form ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary($model) ?>

    <?= $form->field($model, 'user_id')->widget(Select2::className(), [
        'theme'=>Select2::THEME_DEFAULT,
        'initValueText' => isset($model->user) ? $model->user->getName() : User::findOne($model->order->user_id)->getName(),
        'pluginOptions'=>[
            'allowClear'=>true,
            'minimumInputLength' => 3,
            'language' => [
                'errorLoading' => new JsExpression("function () { return 'Waiting for results...';}"),
            ],
            'ajax' => [
                'url' => Url::to(['ajax/list-user'], true),
                'dataType' => 'json',
                'data' => new JsExpression("function (params) { return {username:params.term};}")
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(user) { return user.text; }'),
            'templateSelection' => new JsExpression('function (user) { return user.text; }'),
        ],
    ]) ?>
    
    <?= $form->field($model, 'payment_id')->widget(Select2::className(), [
        'theme'=>Select2::THEME_DEFAULT,
        'data' => ArrayHelper::map(Payment::find()->actived()->all(), 'id', 'name'),
        'pluginOptions'=>[
            'allowClear'=>true,
        ],
        'options' => [
            'prompt' => 'Choose One',
        ]
    ]) ?>
    
    <?= $form->field($model, 'from_bank_name')->textInput() ?>
    <?= $form->field($model, 'from_behalf_of')->textInput() ?>
    <?= $form->field($model, 'from_bill_no')->textInput() ?>
    <?= $form->field($model, 'currency_id')->widget(Select2::className(), [
        'theme' => Select2::THEME_DEFAULT,
        'data' => ArrayHelper::map(Currency::find()->ordered()->all(), 'id', 'name'),
        'options' => [
            'prompt' => 'Choose one',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]) ?>
    <?= $form->field($model, 'nominal')->textInput() ?>
    
    <?= $form->field($model, 'photoFile')->fileInput() ?>
    
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>