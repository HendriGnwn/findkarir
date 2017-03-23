<?php

use app\models\Offer;
use app\models\Order;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\JsExpression;

return [
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'code',
        'width'=>'12%',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute' => 'user_id',
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions'=>[
            'theme'=>Select2::THEME_DEFAULT,
            'pluginOptions'=>[
                'allowClear'=>true,
                'minimumInputLength' => 3,
                'language' => [
                    'errorLoading' => new JsExpression("function () { return 'Waiting for results...';}"),
                ],
                'ajax' => [
                    'url' => Url::to(['ajax/list-user'], true),
                    'dataType' => 'json',
                    'data' => new JsExpression("function (params) { return {username:params.term};}")
                ],
                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                'templateResult' => new JsExpression('function(user) { return user.text; }'),
                'templateSelection' => new JsExpression('function (user) { return user.text; }'),
            ],
        ],
        'filterInputOptions'=>['placeholder'=>'Select'],
        'format'=>'raw',
        'content' => function ($model) {
            return isset($model->user) ? $model->user->getName() : $model->user_id;
        },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'width'=>'18%',
        'attribute'=>'offer_id',
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ArrayHelper::map(Offer::find()->actived()->all(), 'id', 'name'),
        'filterWidgetOptions'=>[
            'theme'=>Select2::THEME_DEFAULT,
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Select'],
        'format'=>'raw',
        'width'=>'10%',
        'content' => function ($model) {
            return isset($model->offer) ? $model->offer->name : $model->offer_id;
        }
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'offer_at',
        'width'=>'10%',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'offer_expired_at',
        'width'=>'10%',
    ],
    [
        'attribute' => 'status',
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => Order::statusLabels(),
        'filterWidgetOptions'=>[
            'theme'=>Select2::THEME_DEFAULT,
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Select'],
        'format'=>'raw',
        'width'=>'10%',
        'content' => function ($model) {
            return $model->getStatusWithStyle();
        }
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'status_updated_at',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'status_paid_at',
        'width'=>'15%',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'status_expired_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'currency_id',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'amount',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'admin_fee',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'final_amount',
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