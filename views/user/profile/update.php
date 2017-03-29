<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use app\helpers\FormatConverter;
use app\models\Config;
use app\models\Currency;
use app\models\Profile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 * @var Profile $profile
 */

$this->title = Yii::t('app.label', 'Update Profile').': '.$profile->user->getName();
$this->params['breadcrumbs'][] = ['url' => ['/user-dashboard/index'], 'label' => 'User'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12 col-md-2">
        <?= $this->render('@app/views/layouts/_menu-applicant') ?>
    </div>
    <div class="col-xs-12 col-md-10">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= $this->title ?></h3>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'options' => [
                        'enctype' => 'multipart/form-data'
                    ],
                ]); ?>

                <?= $form->field($profile, 'name') ?>
                <?= $form->field($profile, 'photoFile')->fileInput(['maxlength' => true]) ?>
                <?= $form->field($profile, 'cvFile')->fileInput(['maxlength' => true]) ?>
                <?= $form->field($profile, 'gender')->dropDownList(Config::getGenders(), ['prompt'=>'-- Choose One --']) ?>
                <?= $form->field($profile, 'phone') ?>
                <?= $form->field($profile, 'hobby')->textarea() ?>
                <?= $form->field($profile, 'married_status')->dropDownList(Config::getMarriedStatus(), ['prompt'=>'-- Choose One --']) ?>
                <?= $form->field($profile, 'bio')->textarea() ?>
                <?= $form->field($profile, 'currency_id')->dropDownList(ArrayHelper::map(Currency::find()->ordered()->all(), 'id', 'name'), ['prompt'=>'-- Choose One --']) ?>
                <?= $form->field($profile, 'salary')->textInput() ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('user', 'Update'), ['class' => 'btn btn-block btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>