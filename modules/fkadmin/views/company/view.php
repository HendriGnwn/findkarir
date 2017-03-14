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
    
    <div class="box box-primary">
        <div class="box-header  with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <div class="box-tools">
                <?php if ($model->getIsPartner()) : ?>
                    <?= Html::a(Yii::t('app', 'Goto Partner'), ['partner/view', 'id' => $model->partner_id], ['class' => 'btn btn-success btn-sm']) ?>
                <?php endif; ?>
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
                <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger btn-sm',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>
        <div class="box-body">
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
        <div class="box-footer">
            
        </div>
    </div>
    
    <?= $this->render('_list-job', ['model' => $model, 'jobs' => $model->getJobs()]) ?>
    
    <?php if ($model->getIsUser()) : ?>
        <?= $this->render('_view-order-active', ['model' => $model, 'order' => $model->user->orderStillActive]) ?>
        <?= $this->render('_list-order-history', ['model' => $model, 'orders' => $model->user->getOrders()]) ?>
    <?php endif; ?>
    
</div>
