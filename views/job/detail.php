<?php

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;
/* @var $this View */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['url' => ['/job/index'], 'label' => 'Jobs Listing'];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
    <div class="col-xs-12 col-md-12">
        
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
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
                            'value' => $model->job->getFormattedStartSalary(),
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'end_salary',
                            'value' => $model->job->getFormattedEndSalary(),
                            'format' => 'raw',
                        ],
                        'open_job_date',
                        'close_job_date',
                        [
                            'attribute' => 'status',
                            'value' => $model->job->getStatusWithStyle(),
                            'format' => 'raw',
                        ],
                        'status_updated_at',
                        [
                            'attribute' => 'status_payment',
                            'value' => $model->job->getStatusPaymentWithStyle(),
                            'format' => 'raw',
                        ],
                        'status_payment_updated_at',
                        'created_at',
                        'updated_at',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
    