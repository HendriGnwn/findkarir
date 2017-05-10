<?php

use app\helpers\DetailViewHelper;
use app\models\Skill;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Skill */
?>
<div class="skill-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' =>'user_id',
                'value' => $model->user->getName(),
            ],
            'name',
            'created_at',
            'updated_at',
            DetailViewHelper::author($model, 'created_by'),
            DetailViewHelper::author($model, 'updated_by'),
        ],
    ]) ?>

</div>
