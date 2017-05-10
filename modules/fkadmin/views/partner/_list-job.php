<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<div class="box box-primary">
    <div class="box-header  with-border">
        <h3 class="box-title"><?= Yii::t('app', 'List Jobs') ?></h3>
        <div class="box-tools">
        </div>
    </div>
    <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => new ActiveDataProvider([
                'query' => $jobs
            ]),
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view}',
                    'urlCreator' => function($action, $model, $key, $index) { 
                        return Url::to(['job/'.$action,'id'=>$key]);
                    },
                    'options' => [
                        'width' => '15%',
                    ]
                ],
            ],
        ]); ?>
    </div>
    <div class="box-footer">

    </div>
</div>