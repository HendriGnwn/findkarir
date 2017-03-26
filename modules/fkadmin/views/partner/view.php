<?php

use app\helpers\DetailViewHelper;
use app\models\Company;
use app\models\Partner;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Partner */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Partners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partner-view">
    
    <div class="box box-primary">
        <div class="box-header  with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <div class="box-tools">
                <?= Html::a(Yii::t('app.button', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
                <?= Html::a(Yii::t('app.button', 'Delete'), ['delete', 'id' => $model->id], [
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
                    'name',
                    //'legal',
                    [
                        'attribute' => 'photo',
                        'value' => $model->getPhotoUrlHtml(),
                        'format' => 'html',
                    ],
                    'phone',
                    'address',
                    [
                        'attribute' => 'city_id',
                        'value' => $model->city ? $model->city->name : $model->city_id,
                    ],
                    [
                        'attribute' => 'province_id',
                        'value' => $model->province ? $model->province->name : $model->province_id,
                    ],
                    'description:ntext',
                    'public_email:email',
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
    
    <div class="box box-primary">
        <div class="box-header  with-border">
            <h3 class="box-title"><?= Yii::t('app', 'Order still Active') ?></h3>
            <div class="box-tools">
                
            </div>
        </div>
        <div class="box-body">
            <?php
            $order = $model->orderStillActive;
            if (is_null($order)) {
                echo Alert::widget(['options'=>['class'=>'alert-info'], 'body'=>Yii::t('app.message', 'Now, Order is not actived.')]);
            } else {
                echo DetailView::widget([
                    'model' => $order,
                    'attributes' => [
                        'code',
                        [
                            'attribute' => 'offer_id',
                            'value' => isset($order->offer) ? $order->offer->name : $order->offer_id,
                        ],
                        'offer_limit',
                        'offer_at',
                        'offer_expired_at',
                        [
                            'attribute' => 'status',
                            'value' => $order->getStatusWithStyle(),
                            'format' => 'raw',
                        ],
                        'description:ntext',
                        'created_at',
                        'updated_at',
                    ],
                ]);
            }
            ?>
        </div>
        <div class="box-footer">
            
        </div>
    </div>
    
    <div class="row">
    
        <div class="col-xs-12 col-md-6">
            <?= $this->render('_list-user', ['users' => $model->getPartnerHasUsers(), 'model' => $model]) ?>
        </div>

        <div class="col-xs-12 col-md-6">
            <?= $this->render('_list-branch', ['branches' => $model->getPartnerBranches(), 'model' => $model]) ?>
        </div>
    </div>
    
    
    
    <div class="row">
    
        <div class="col-xs-12 col-md-6">
            <?= $this->render('_list-company', ['companies' => $model->getCompanies(), 'model' => $model]) ?>
        </div>

        <div class="col-xs-12 col-md-6">
            <?= $this->render('_list-job', ['jobs' => Company::find()->where(['id'=>1]), 'model' => $model]) ?>
        </div>
    </div>
    
</div>
