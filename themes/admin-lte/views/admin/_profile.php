<?php

/*
 * This file is part of the Dektrium project
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use app\models\Config;
use app\models\Currency;
use app\models\Profile;
use app\models\User;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

/* @var View $this */
/* @var User $user */
/* @var Profile $profile */

?>

<?php $this->beginContent('@dektrium/user/views/admin/update.php', ['user' => $user]) ?>

<?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'enableAjaxValidation' => true,
    'enableClientValidation' => false,
    'fieldConfig' => [
        'horizontalCssClasses' => [
            'wrapper' => 'col-sm-9',
        ],
    ],
    'options' => [
        'enctype' => 'multipart/form-data'
    ],
]); ?>

<?php if ($user->getIsCategoryApplicant()) : ?>

<?= $form->field($profile, 'name') ?>
<?= $form->field($profile, 'photoFile')->fileInput(['maxlength' => true]) ?>
<div class="col-sm-9 col-sm-offset-3">
    <?= $profile->getPhotoImg(['width'=>'40']) ?>
    <br/><br/>
</div>
<?= $form->field($profile, 'cvFile')->fileInput(['maxlength' => true]) ?>
<div class="col-sm-9 col-sm-offset-3">
    <?= $profile->getCvUrlHtml() ?>
    <br/>
    <?= Yii::t('app.label', 'Updated CV At') .': '.app\helpers\FormatConverter::dateFormat($profile->cv_updated_at, 'd M Y H:i:s') ?>
    <br/><br/>
</div>
<?= $form->field($profile, 'gender')->dropDownList(Config::getGenders(), ['prompt'=>'-- Choose One --']) ?>
<?= $form->field($profile, 'phone') ?>
<?= $form->field($profile, 'hobby')->textarea() ?>
<?= $form->field($profile, 'married_status')->dropDownList(Config::getMarriedStatus(), ['prompt'=>'-- Choose One --']) ?>
<?= $form->field($profile, 'bio')->textarea() ?>
<?= $form->field($profile, 'currency_id')->dropDownList(ArrayHelper::map(Currency::find()->actived()->ordered()->all(), 'id', 'name'), ['prompt'=>'-- Choose One --']) ?>
<?= $form->field($profile, 'salary')->textInput() ?>

<?php else: ?>

<?= $form->field($profile, 'name') ?>
<?= $form->field($profile, 'public_email') ?>
<?= $form->field($profile, 'phone') ?>
<?= $form->field($profile, 'website') ?>
<?= $form->field($profile, 'location') ?>
<?= $form->field($profile, 'gravatar_email') ?>
<?= $form->field($profile, 'bio')->textarea() ?>

<?php endif; ?>

<div class="form-group">
    <div class="col-lg-offset-3 col-lg-9">
        <?= Html::submitButton(Yii::t('user', 'Update'), ['class' => 'btn btn-block btn-success']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php $this->endContent() ?>
