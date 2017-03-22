<?php

use app\models\JobType;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

return [
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'job_type_id',
        'filterType'=> GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(JobType::find()->actived()->orderBy('name')->all(), 'id', 'name'),
        'filterWidgetOptions' => [
            //'theme' => Select2::THEME_DEFAULT,
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => '-- Select --'],
        //'header' => 'Passion',
		'value'=>function($data){
			return $data->jobType->name;
		},
        'format'=>'raw',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'template' => '{delete}',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   