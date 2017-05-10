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
    
    <?= $this->render('_menu') ?>
    
    <div class="box box-primary">
        <div class="box-header  with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="box-body">
            <?php Pjax::begin(); ?>    
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'code',
                        'options' => [
                            'width' => '15%',
                        ],
                    ],
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
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update}'
                    ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
        <div class="box-footer">
            
        </div>
    </div>

</div>
