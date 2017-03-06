<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View              $this
 * @var dektrium\user\models\User $user
 * @var dektrium\user\Module      $module
 */

$this->title = Yii::t('user', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];
$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];
$fieldOptions3 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>
<div class="row">
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'id'                     => 'registration-form',
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                ]); ?>
				
				<?= $form->field($model, 'name', $fieldOptions1)->textInput(['placeholder' => $model->getAttributeLabel('name')]) ?>

                <?= $form->field($model, 'email', $fieldOptions1)->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>

                <?= $form->field($model, 'username', $fieldOptions2)->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

                <?php if ($module->enableGeneratingPassword == false): ?>
                    <?= $form->field($model, 'password', $fieldOptions3)->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
                <?php endif ?>

                <?= Html::submitButton(Yii::t('user', 'Sign up'), ['class' => 'btn btn-skin btn-block']) ?>

                <?php ActiveForm::end(); ?>
            </div>
			<div class="box-footer">
				<p class="text-right">
					<?= Html::a(Yii::t('user', 'Already registered? Sign in!'), ['/user/security/login']) ?>
				</p>
			</div>
        </div>
    </div>
</div>
