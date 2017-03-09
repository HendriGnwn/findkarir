<?php

use app\helpers\DetailViewHelper;
use app\models\Payment;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Payment */
?>
<div class="payment-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'payment_type_id',
                'value' => $model->paymentType->name,
                'format' => 'raw',
            ],
            'name',
            'behalf_of',
            'bill_no',
            'branch_name',
            [
                'attribute' => 'logo',
                'value' => $model->getLogoUrlHtml(),
                'format' => 'raw',
            ],
            'order',
            [
                'attribute' => 'status',
                'value' => $model->getStatusWithStyle(),
                'format' => 'raw',
            ],
            'created_at',
            'updated_at',
            DetailViewHelper::author($model, 'created_by'),
            DetailViewHelper::author($model, 'updated_by'),
        ],
    ]) ?>

</div>
