<?php

use app\helpers\DetailViewHelper;
use app\models\Company;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Company */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if ($model->getIsPartner()) : ?>
            <?= Html::a(Yii::t('app', 'Goto Partner'), ['partner/view', 'id' => $model->partner_id], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'user_id',
                'value' => isset($model->user) ? $model->user->getName() : $model->user_id,
            ],
            [
                'attribute' => 'partner_id',
                'value' => isset($model->partner) ? $model->partner->name : $model->partner_id,
            ],
            'code',
            'name',
            'address',
            [
                'attribute' => 'city_id',
                'value' => isset($model->city) ? $model->city->name : $model->city_id,
            ],
            [
                'attribute' => 'province_id',
                'value' => isset($model->province) ? $model->province->name : $model->province_id,
            ],
            'latitude',
            'longitude',
            'phone',
            'sector_area',
            'employee_quantity',
            'website',
            [
                'attribute' => 'photo',
                'value' => $model->getPhotoUrlHtml(),
            ],
            'description:ntext',
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
