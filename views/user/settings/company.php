<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use app\helpers\Url;
use app\models\Company;
use app\models\Profile;
use johnitvn\ajaxcrud\CrudAsset;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/**
 * @var View $this
 * @var ActiveForm $form
 * @var Profile $profile
 * @var $model Profile
 */

$this->title = Yii::t('user', 'Company settings');
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
Pjax::begin(['id'=>'crud-datatable-pjax']);
?>

<div class="row">
    <div class="col-md-3">
        <?= $this->render('_menu') ?>
    </div>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Html::encode($this->title) ?>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'profile-form',
                    'options' => ['class' => 'form-horizontal'],
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-9\">{input}</div>\n<div class=\"col-sm-offset-3 col-lg-9\">{error}\n{hint}</div>",
                        'labelOptions' => ['class' => 'col-lg-3 control-label'],
                    ],
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                    'validateOnBlur'         => false,
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
						<?php
							$viewCompanyOptions = $model->getIsComplete() ?
								['class' => 'btn btn-primary', 'role'=>'modal-remote',
									'data-toggle'=>'tooltip', 'title'=>Yii::t('app', 'View your company')] 
								:
								['class' => 'btn btn-primary', 'disabled'=>true, 'onclick'=>'return false;', 
									'data-toggle'=>'tooltip', 'title'=>Yii::t('app', 'Button is disabled because your data is not completed.')];
						?>
						<?= Html::a(
								Yii::t('user', 'View Your Company'),
								Url::to(['/company/view', 'id'=>$model->company_id]),
								$viewCompanyOptions
							) ?>
						
						<br/><br/>
						
						<?php if ($companyText == '') { ?>
							<?= Html::checkbox('company-not-registered', false, [
								'id'=>'company-not-registered',
							]) ?>
							<?= Html::label(Yii::t('app', "Click if your company isn't registered"), 'company-not-registered', [
								'style'=>'margin-left:10px;'
							]) ?>
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
            </div>
        </div>
    </div>
</div>

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

Pjax::end();

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
