<?php

use app\models\Partner;
use app\models\PartnerBranch;
use app\models\PartnerHasUser;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model PartnerHasUser */
/* @var $form ActiveForm */
?>

<div class="partner-has-user-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary([$model, $user]) ?>
    
    <?= $form->field($model, 'partner_id')->widget(Select2::className(), [
        'theme' => Select2::THEME_DEFAULT,
        'data' => ArrayHelper::map(Partner::find()->actived()->all(), 'id', 'name'),
        'pluginOptions' => [
            'allowClear' => true
        ],
        'options' => [
            'prompt' => 'Choose One',
            'disabled' => $model->isNewRecord ? true : false,
        ]
    ]) ?>
    
    <?= $form->field($model, 'partner_branch_id')->widget(Select2::className(), [
        'theme' => Select2::THEME_DEFAULT,
        'data' => ArrayHelper::map(PartnerBranch::find()->where(['partner_id' => $model->partner_id])->actived()->all(), 'id', 'name'),
        'pluginOptions' => [
            'allowClear' => true
        ],
        'options' => [
            'prompt' => 'Choose One',
        ]
    ]) ?>
    
    <h3>User Details</h3>
    
    <?= $form->field($user, 'username')->textInput(['maxlength' => true]) ?>
    <?= $form->field($user, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($user, 'password')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
