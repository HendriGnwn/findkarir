<?php

use app\models\City;
use app\models\Province;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model City */
/* @var $form ActiveForm */
?>

<div class="city-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'province_id')->widget(Select2::className(), [
        'theme' => Select2::THEME_DEFAULT,
        'data' => ArrayHelper::map(Province::find()->actived()->ordered()->all(), 'id', 'name'),
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->widget(Select2::className(), [
        'theme' => Select2::THEME_DEFAULT,
        'data' => City::statusLabels(),
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
