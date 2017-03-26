<?php

use johnitvn\ajaxcrud\CrudAsset;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

CrudAsset::register($this);
?>

<div class="box box-primary">
    <div class="box-header  with-border">
        <h3 class="box-title"><?= Yii::t('app.label', 'List Applicants') ?></h3>
    </div>
    <div class="box-body">
        <div id="ajaxCrudDatatable">
            <?= GridView::widget([
                'id'=>'crud-datatable',
                'pjax'=>true,
                'dataProvider' => new ActiveDataProvider([
                    'query' => $model->getJobApplies()->orderBy(['created_at' => SORT_DESC]),
                ]),
                'columns' => [
                    [
                        'attribute' => 'user_id',
                        'content' => function ($model) {
                            return isset($model->user) ? $model->user->getName() : $model->user_id;
                        },
                        'width'=>'20%',
                    ],
                    'description',
                    [
                        'class'=>'\kartik\grid\DataColumn',
                        'attribute'=>'created_at',
                        'width'=>'15%',
                    ],
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'dropdown' => false,
                        'vAlign'=>'middle',
                        'template'=>'{view} {update}',
                        'urlCreator' => function($action, $model, $key, $index) { 
                                return Url::to(['job-apply/'.$action,'id'=>$key]);
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
                ]
            ]) ?>
        </div>
    </div>
    <div class="box-footer">

    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
