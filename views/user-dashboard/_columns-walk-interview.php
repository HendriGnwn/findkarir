<?php
use yii\helpers\Url;

return [
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'job_id',
        'content' => function ($model) {
            $job = $model->job;
            return yii\helpers\Html::a($job->name, $job->getDetailUrl(true), []);
        }
    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'description',
//    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'review_by',
//    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'review_counter',
//    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'status',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'status_interview_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'status_updated_at',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'interview_at',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'venue',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'contact_person',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'contact_person_phone',
    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'created_at',
//    ],
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
        'template' => '{view}',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to(['job-apply-'.$action,'id'=>$key]);
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