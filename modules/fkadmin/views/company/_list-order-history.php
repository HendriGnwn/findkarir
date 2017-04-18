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
        <h3 class="box-title">List Orders History</h3>
    </div>
    <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => new ActiveDataProvider([
                'query' => $orders,
                'sort' => [
                    'defaultOrder' => [
                        'offer_at' => SORT_DESC,
                        'offer_expired_at' => SORT_DESC,
                    ],
                ],
            ]),
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'offer_id',
                    'content' => function ($model) {
                        return isset($model->offer) ? $model->offer->name : $model->offer_id;
                    }
                ],
                'offer_at',
                'offer_expired_at',
                [
                    'attribute' => 'final_amount',
                    'content' => function ($model) {
                        return $model->getFormattedFinalAmount();
                    }
                ],
                
                [
                    'class' => 'yii\grid\ActionColumn',
                    'urlCreator' => function($action, $model, $key, $index) { 
                        return Url::to(['/fkadmin/order/'.$action,'id'=>$key]);
                    },
                    'template' => '{view}',
                ],
            ],
        ]); ?>
    </div>
    <div class="box-footer">

    </div>
</div>
