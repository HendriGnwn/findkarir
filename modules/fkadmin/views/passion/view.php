<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Passion */
?>
<div class="passion-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'job_type_id',
                'value' => $model->jobType ? $model->jobType->name : $model->job_type_id,
            ],
            [
                'attribute' => 'user_id',
                'value' => $model->user->getName(),
            ],
            'created_at',
        ],
    ]) ?>

</div>
