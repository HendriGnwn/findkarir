<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
?>
<div class="order-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'code',
            'user_id',
            'description:ntext',
            'offer_id',
            'offer_expired_at',
            'status',
            'status_updated_at',
            'status_paid_at',
            'status_expired_at',
            'currency_id',
            'amount',
            'admin_fee',
            'final_amount',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
        ],
    ]) ?>

</div>
