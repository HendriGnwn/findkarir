<?php

use app\models\Payment;
use app\models\PaymentType;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
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
        'attribute'=>'payment_type_id',
        'filterType'=> GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(PaymentType::find()->actived()->ordered()->all(), 'id', 'name'),
        'filterWidgetOptions' => [
            'theme' => Select2::THEME_DEFAULT,
            'pluginOptions' => ['allowClear' => true],
        ],
        'width'=>'10%',
        'filterInputOptions' => ['placeholder' => '-- Select --'],
		'value'=>function($data){
			return $data->paymentType->name;
		},
        'format'=>'raw',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'behalf_of',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'bill_no',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'branch_name',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'logo',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'status',
        'filterType'=> GridView::FILTER_SELECT2,
        'filter' => Payment::statusLabels(),
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
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'order',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'created_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'created_by',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'updated_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'updated_by',
    // ],
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