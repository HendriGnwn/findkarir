<?php

/*
 * This file is part of the Dektrium project
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use app\models\Company;
use app\models\Profile;
use app\models\User;
use johnitvn\ajaxcrud\CrudAsset;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\web\View;
use yii\widgets\Pjax;

/**
 * @var View       $this
 * @var User       $user
 * @var Profile    $profile
 */

CrudAsset::register($this);

Pjax::begin(['id'=>'crud-datatable-pjax']);

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
]); ?>

<?php
	$companyText = $model->company_id ? Company::findOne($model->company_id)->name : '';
?>
<?= $form->field($model, 'company_id')->widget(Select2::className(), [
	'initValueText' => $companyText,
	'theme' => Select2::THEME_DEFAULT,
	'options' => ['placeholder'=>'Select your Company'],
	'pluginOptions' => [
		'allowClear' => true,
		'minimumInputLength' => 3,
		'language' => [
			'errorLoading' => new JsExpression("function () { return 'Waiting for results...';}"),
		],
		'ajax' => [
			'url' => Url::to(['/ajax/list-company'], true),
			'dataType' => 'json',
			'data' => new JsExpression("function (params) { return {name:params.term};}")
		],
		'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
		'templateResult' => new JsExpression('function(company) { return company.text; }'),
		'templateSelection' => new JsExpression('function (company) { return company.text; }'),
	],
]) ?>

<div class="form-group">
	<label class="col-lg-3 control-label"></label>
	<div class="col-lg-9">
		<?php if ($companyText == '') { ?>
			<?= Html::checkbox('company-not-registered', false, [
				'id'=>'company-not-registered',
			]) ?>
			<?= Html::label(Yii::t('app', "Click if your company isn't registered"), 'company-not-registered', [
				'style'=>'margin-left:10px;'
			]) ?>
		<?php } else { ?>
			<?= Html::a(
				Yii::t('user', 'View Your Company'),
				Url::to(['/company/view','id'=>$model->company_id]),
				['class' => 'btn btn-primary', 'role'=>'modal-remote']
			) ?>
		<?php } ?>
	</div>
</div>

<div class="form-group">
	<div class="col-lg-offset-3 col-lg-9">
		<div class="submit-button">
			<?= Html::submitButton(
				Yii::t('user', 'Save'),
				['class' => 'btn btn-block btn-success']
			) ?><br>
		</div>
		<div class="create-company">
			<?= Html::a(
				Yii::t('user', 'Create Company'),
				Url::to(['/company/create'], true),
				['class' => 'btn btn-block btn-primary', 'role'=>'modal-remote']
			) ?><br>
		</div>
	</div>
</div>

<?php ActiveForm::end(); ?>

<?php
$this->registerJs("
	
	$('.create-company').hide();
	$('#company-not-registered').click(function(){
		if (this.checked) {
			$('.submit-button').hide();
			$('.create-company').show();
		} else {
			$('.submit-button').show();
			$('.create-company').hide();
		}
	});
	
", View::POS_END, 'chcekbox');

Modal::begin([
    "id"=>"ajaxCrudModal",
	'size'=> Modal::SIZE_LARGE,
    "footer"=>"",
	'clientOptions' => [
		'keyboard'=>false,
		'backdrop'=> 'static',
	],
]);
Modal::end();
?>

<?php $this->endContent() ?>

<?php Pjax::end(); ?>