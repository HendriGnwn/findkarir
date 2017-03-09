<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\City */
?>
<div class="city-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'province_id',
                'value' => $model->province->name,
                'format' => 'raw',
            ],
            'name',
            [
                'attribute' => 'status',
                'value' => $model->getStatusWithStyle(),
                'format' => 'raw',
            ],
        ],
    ]) ?>

</div>
