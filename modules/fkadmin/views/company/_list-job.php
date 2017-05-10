<?php

use app\helpers\FormatConverter;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Url;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div class="box box-primary">
    <div class="box-header  with-border">
        <h3 class="box-title">List Jobs</h3>
    </div>
    <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => new ActiveDataProvider([
                'query' => $jobs,
            ]),
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                'name',
                [
                    'label' => 'Applicant',
                    'content' => function ($model) {
                        return $model->getJobApplies()->count();
                    }
                ],
                [
                    'attribute' => 'open_job_date',
                    'content' => function ($model) {
                        return FormatConverter::dateFormat($model->open_job_date, 'd M Y');
                    }
                ],
                [
                    'attribute' => 'city_id',
                    'content' => function ($model) {
                        return $model->city->name;
                    }
                ],
                [
                    'attribute'=>'status',
                    'content'=>function($model) {
                        return $model->getStatusWithStyle();
                    },
                    'format'=>'raw',
                ],
                // 'status_updated_at',
                [
                    'attribute'=>'status_payment',
                    'content'=>function($model) {
                        return $model->getStatusPaymentWithStyle();
                    },
                    'format'=>'raw',
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'urlCreator' => function($action, $model, $key, $index) { 
                        return Url::to(['/fkadmin/job/'.$action,'id'=>$key]);
                    },
                    'template' => '{view}',
                ],
            ],
        ]); ?>
    </div>
    <div class="box-footer">

    </div>
</div>
