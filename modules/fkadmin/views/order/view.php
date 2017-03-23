<?php

use app\helpers\DetailViewHelper;
use app\models\Order;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Order */
$this->title = Yii::t('app', 'Order').' #'.$model->code;
?>
<div class="order-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'code',
            [
                'attribute' => 'user_id',
                'value' => isset($model->user) ? $model->user->getName() : $model->user_id,
            ],
            [
                'attribute' => 'offer_id',
                'value' => isset($model->offer) ? $model->offer->name : $model->offer_id,
            ],
            'offer_at',
            'offer_expired_at',
            [
                'attribute' => 'status',
                'value' => $model->getStatusWithStyle(),
                'format' => 'raw',
            ],
            'status_updated_at',
            'status_paid_at',
            'status_expired_at',
            [
                'attribute' => 'amount',
                'value' => $model->getFormattedAmount(),
                'format' => 'raw',
            ],
            [
                'attribute' => 'admin_fee',
                'value' => $model->getFormattedAdminFee(),
                'format' => 'raw',
            ],
            [
                'attribute' => 'final_amount',
                'value' => $model->getFormattedFinalAmount(),
                'format' => 'raw',
            ],
            'description:ntext',
            'created_at',
            'updated_at',
            DetailViewHelper::author($model, 'created_by'),
            DetailViewHelper::author($model, 'updated_by'),
        ],
    ]) ?>
    
    <div class="box box-primary">
        <div class="box-header  with-border">
            <h3 class="box-title"><?= Yii::t('app', 'Order Confirmation') ?></h3>
        </div>
        <div class="box-body">
            <?php
                $orderConfimation = $model->orderConfirmation;
            ?>
            <?= DetailView::widget([
                'model' => $orderConfimation,
                'attributes' => [
                    [
                        'attribute' => 'user_id',
                        'value' => isset($orderConfimation->user) ? $orderConfimation->user->getName() : $orderConfimation->user_id,
                    ],
                    [
                        'attribute' => 'photo',
                        'value' => $orderConfimation->getPhotoImg(),
                        'format' => 'raw',
                    ],
                    'description',
                    [
                        'attribute' => 'payment_id',
                        'value' => isset($orderConfimation->payment_id) ? $orderConfimation->payment->name : $orderConfimation->payment_id,
                        'format' => 'raw',
                    ],
                    'payment_updated_at',
                    'from_bank_name',
                    'from_behalf_of',
                    'from_bill_no',
                    'status:boolean',
                    'created_at',
                    'updated_at',
                    DetailViewHelper::author($orderConfimation, 'created_by'),
                    DetailViewHelper::author($orderConfimation, 'updated_by'),
                ],
            ]) ?>
        </div>
        <div class="box-footer">
            
        </div>
    </div>
</div>
