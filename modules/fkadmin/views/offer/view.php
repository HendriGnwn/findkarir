<?php

use app\helpers\DetailViewHelper;
use app\models\Offer;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Offer */
?>
<div class="offer-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'offer_type_id',
                'value' => $model->offerType->name,
            ],
            'name',
            'description:ntext',
            'day_limit',
            [
                'attribute' => 'amount',
                'value' => $model->getFormattedAmount(),
            ],
            [
                'attribute' => 'admin_fee',
                'value' => $model->getFormattedAdminFee(),
            ],
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
