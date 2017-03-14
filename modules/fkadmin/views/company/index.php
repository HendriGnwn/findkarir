<?php

use app\modules\fkadmin\models\CompanySearch;
use app\models\Company;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;
/* @var $this View */
/* @var $searchModel CompanySearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = Yii::t('app', 'Companies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //= Html::a(Yii::t('app', 'Create Company'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'user_id',
                'content' => function ($model) {
                    return isset($model->user) ? $model->user->username : $model->user_id;
                }
            ],
            [
                'attribute' => 'partner_id',
                'content' => function ($model) {
                    return isset($model->partner) ? $model->partner->name : $model->partner_id;
                }
            ],
            'code',
            'name',
            // 'address',
            // 'city_id',
            // 'province_id',
            // 'latitude',
            // 'longitude',
            'phone',
            // 'sector_area',
            // 'employee_quantity',
            // 'website',
            // 'photo',
            // 'description:ntext',
            [
                'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'status',
                'filterType'=> GridView::FILTER_SELECT2,
                'filter' => Company::statusLabels(),
                'filterWidgetOptions' => [
                    'theme' => Select2::THEME_DEFAULT,
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => '-- Select --'],
                'value'=>function($data){
                    return $data->getStatusWithStyle();
                },
                'format'=>'raw',
            ],
            'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

            [
                'class' => 'yii\grid\ActionColumn'
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
