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
        <?= DetailView::widget([
            'model' => $order ? $order : [],
            'attributes' => [
                'code',
                'description',
                'offer_id',
                'offer_expired_at',
                'status',
                'status_updated_at',
                'amount',
            ],
        ]) ?>
    </div>
    <div class="box-footer">

    </div>
</div>
