<?php

use app\models\Province;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'status',
        'filterType'=> GridView::FILTER_SELECT2,
        'filter' => Province::statusLabels(),
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
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'order',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
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