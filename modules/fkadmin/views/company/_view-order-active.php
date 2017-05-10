<?php

use yii\widgets\DetailView;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div class="box box-primary">
    <div class="box-header  with-border">
        <h3 class="box-title">List Order Active</h3>
    </div>
    <div class="box-body">
        <?php
        if (is_null($order)) {
            echo yii\bootstrap\Alert::widget([
                'options' => [
                    'class' => 'alert-info',
                ],
                'body' => Yii::t('app.message', 'Order active is not found.'),
            ]);
        } else {
        ?>
        
        <?= DetailView::widget([
            'model' => $order ? $order : [],
            'attributes' => [
                'code',
                [
                    'attribute' => 'offer_id',
                    'value' => $order ? $order->offer->name : null,
                ],
                'offer_expired_at',
                [
                    'attribute' => 'status',
                    'value' => $order ? $order->getStatusWithStyle() : null,
                    'format' => 'raw',
                ],
                'status_updated_at',
                [
                    'attribute' => 'final_amount',
                    'value' => $order ? $order->getFormattedFinalAmount() : null,
                ],
                
                'description',
            ],
        ]) ?>
        
        <?php } ?>
    </div>
    <div class="box-footer">

    </div>
</div>
