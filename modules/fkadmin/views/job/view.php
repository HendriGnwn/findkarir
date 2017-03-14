<?php

use app\helpers\DetailViewHelper;
use app\models\Job;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Job */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Jobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-view">
    
    <div class="box box-primary">
        <div class="box-header  with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <div class="box-tools">
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
                    'code',
                    [
                        'attribute' => 'company_id',
                        'value' => $model->company->name,
                    ],
                    [
                        'attribute' => 'job_type_id',
                        'value' => $model->jobType->name,
                    ],
                    'name',
                    'description:ntext',
                    'requirement:ntext',
                    [
                        'attribute' => 'city_id',
                        'value' => $model->city->name,
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'province_id',
                        'value' => $model->province->name,
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'start_salary',
                        'value' => $model->getFormattedStartSalary(),
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'end_salary',
                        'value' => $model->getFormattedEndSalary(),
                        'format' => 'raw',
                    ],
                    'open_job_date',
                    'close_job_date',
                    [
                        'attribute' => 'status',
                        'value' => $model->getStatusWithStyle(),
                        'format' => 'raw',
                    ],
                    'status_updated_at',
                    [
                        'attribute' => 'status_payment',
                        'value' => $model->getStatusPaymentWithStyle(),
                        'format' => 'raw',
                    ],
                    'status_payment_updated_at',
                    'created_at',
                    'updated_at',
                    DetailViewHelper::author($model, 'created_by'),
                    DetailViewHelper::author($model, 'updated_by'),
                ],
            ]) ?>
        </div>
    </div>
    
    <?= $this->render('_list-apply', []) ?>
</div>
