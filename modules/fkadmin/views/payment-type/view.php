<?php

use app\helpers\DetailViewHelper;
use app\models\PaymentType;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model PaymentType */
?>
<div class="payment-type-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'class',
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
