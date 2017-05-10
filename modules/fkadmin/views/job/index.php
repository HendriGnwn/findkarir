<?php

use app\models\Job;
use app\modules\fkadmin\models\JobSearch;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\web\View;
use yii\widgets\Pjax;
/* @var $this View */
/* @var $searchModel JobSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = Yii::t('app', 'Jobs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-index">
    
    <?= $this->render('_menu') ?>
    
    <div class="box box-primary">
        <div class="box-header  with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <div class="box-tools">
                <?= Html::a(Yii::t('app', 'Create Job'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
            </div>
        </div>
        <div class="box-body table-responsive">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?php Pjax::begin(); ?>    
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    'code',
                    [
                        'class'=>'\kartik\grid\DataColumn',
                        'attribute'=>'company_id',
                        'content'=>function($model) {
                            return isset($model->company) ? $model->company->name : $model->company_id;
                        },
                        'width'=>'15%',
                        'filterType'=>GridView::FILTER_SELECT2,
                        'filterWidgetOptions'=>[
                            'theme'=>Select2::THEME_DEFAULT,
                            'pluginOptions'=>[
                                'allowClear'=>true,
                                'minimumInputLength' => 3,
                                'language' => [
                                    'errorLoading' => new JsExpression("function () { return 'Waiting for results...';}"),
                                ],
                                'ajax' => [
                                    'url' => Url::to(['ajax/list-company'], true),
                                    'dataType' => 'json',
                                    'data' => new JsExpression("function (params) { return {name:params.term};}")
                                ],
                                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                'templateResult' => new JsExpression('function(user) { return user.text; }'),
                                'templateSelection' => new JsExpression('function (user) { return user.text; }'),
                            ],
                        ],
                        'filterInputOptions'=>[
                            'placeholder'=>'Select'
                        ],
                        'format'=>'raw',
                    ],
                    'name',
                    // 'description:ntext',
                    // 'requirement:ntext',
        //            [
        //                'class'=>'\kartik\grid\DataColumn',
        //                'attribute'=>'city_id',
        //                'content'=>function($model) {
        //                    return isset($model->city) ? $model->city->name : $model->city_id;
        //                },
        //                'width'=>'15%',
        //                'filter' => ArrayHelper::map(City::find()->actived()->all(), 'id', 'name'),
        //                'filterType'=>GridView::FILTER_SELECT2,
        //                'filterWidgetOptions'=>[
        //                    'theme'=>Select2::THEME_DEFAULT,
        //                    'pluginOptions'=>[
        //                        'allowClear'=>true,
        //                    ],
        //                ],
        //                'filterInputOptions'=>[
        //                    'placeholder'=>'Select'
        //                ],
        //                'format'=>'raw',
        //            ],
                    // 'province_id',
                    // 'salary_currency_id',
                    // 'start_salary',
                    // 'end_salary',
                    [
                        'label' => 'Applicant',
                        'content' => function ($model) {
                            return $model->getJobApplies()->count();
                        }
                    ],
                    [
                        'class'=>'\kartik\grid\DataColumn',
                        'attribute'=>'status',
                        'content'=>function($model) {
                            return $model->getStatusWithStyle();
                        },
                        'width'=>'8%',
                        'filter' => Job::statusLabels(),
                        'filterType'=>GridView::FILTER_SELECT2,
                        'filterWidgetOptions'=>[
                            'theme'=>Select2::THEME_DEFAULT,
                            'pluginOptions'=>[
                                'allowClear'=>true,
                            ],
                        ],
                        'filterInputOptions'=>[
                            'placeholder'=>'Select'
                        ],
                        'format'=>'raw',
                    ],
                    // 'status_updated_at',
                    [
                        'class'=>'\kartik\grid\DataColumn',
                        'attribute'=>'status_payment',
                        'content'=>function($model) {
                            return $model->getStatusPaymentWithStyle();
                        },
                        'width'=>'8%',
                        'filter' => Job::statusPaymentLabels(),
                        'filterType'=>GridView::FILTER_SELECT2,
                        'filterWidgetOptions'=>[
                            'theme'=>Select2::THEME_DEFAULT,
                            'pluginOptions'=>[
                                'allowClear'=>true,
                            ],
                        ],
                        'filterInputOptions'=>[
                            'placeholder'=>'Select'
                        ],
                        'format'=>'raw',
                    ],
                    // 'status_payment_updated_at',
                    'created_at',
                    // 'created_by',
                    // 'updated_at',
                    // 'updated_by',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
        <div class="box-footer">
            
        </div>
    </div>
    
</div>
