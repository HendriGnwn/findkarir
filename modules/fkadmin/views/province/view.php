<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Province */
?>
<div class="province-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'status',
                'value' => $model->getStatusWithStyle(),
                'format' => 'raw',
            ],
            'order',
        ],
    ]) ?>

</div>
