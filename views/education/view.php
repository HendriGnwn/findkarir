<?php

use app\models\Education;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Education */
?>
<div class="education-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'user_id',
                'value' => $model->user->getName(),
            ],
            [
                'attribute' => 'category',
                'value' => $model->getCategoryLabel(),
            ],
            'name',
            'department',
            'started_at',
            'graduated_at',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
