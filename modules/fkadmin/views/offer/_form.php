<?php

use app\models\Currency;
use app\models\Offer;
use app\models\OfferType;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Offer */
/* @var $form ActiveForm */
?>

<div class="offer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model) ?>

    <?= $form->field($model, 'offer_type_id')->widget(Select2::className(), [
        'theme' => Select2::THEME_DEFAULT,
        'data' => ArrayHelper::map(OfferType::find()->all(), 'id', 'name'),
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'day_limit')->textInput() ?>

    <?= $form->field($model, 'currency_id')->widget(Select2::className(), [
        'theme' => Select2::THEME_DEFAULT,
        'data' => ArrayHelper::map(Currency::find()->all(), 'id', 'name'),
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'admin_fee')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->widget(Select2::className(), [
        'theme' => Select2::THEME_DEFAULT,
        'data' => Offer::statusLabels(),
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>
    
    <?= $form->field($model, 'order')->textInput(['maxlength' => true]) ?>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
