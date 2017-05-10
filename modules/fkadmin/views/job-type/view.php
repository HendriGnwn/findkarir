<?php

use app\helpers\DetailViewHelper;
use app\models\JobType;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model JobType */
?>
<div class="job-type-view">
 
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
            'created_at',
            'updated_at',
            DetailViewHelper::author($model, 'created_by'),
            DetailViewHelper::author($model, 'updated_by'),
        ],
    ]) ?>

</div>
