<?php

use app\models\JobType;
use app\models\Passion;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Passion */
/* @var $form ActiveForm */
?>

<div class="passion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'job_type_id')->widget(Select2::className(), [
        'data' => ArrayHelper::map(JobType::find()->actived()->orderBy('name')->all(), 'id', 'name'),
        'theme' => Select2::THEME_DEFAULT,
        'options' => [
            'prompt' => '- Choose One -',
        ],
    ]) ?>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
