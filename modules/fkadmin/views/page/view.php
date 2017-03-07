<?php

use app\helpers\DetailViewHelper;
use app\models\Page;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Page */
?>
<div class="page-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'category',
                'value' => $model->getCategoryLabel(),
                'format' => 'raw',
            ],
            'name',
            'slug',
            [
                'attribute' => 'photo',
                'value' => $model->getPhotoUrlHtml(),
                'format' => 'html',
            ],
            'description:ntext',
            'date_post',
            'meta_description',
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
