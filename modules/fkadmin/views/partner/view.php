<?php

use app\helpers\DetailViewHelper;
use app\models\Partner;
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
    
    <div class="row">
    
        <div class="col-xs-12 col-md-6">
            <?= $this->render('_list-user', ['users' => $model->getPartnerHasUsers()]) ?>
        </div>

        <div class="col-xs-12 col-md-6">
            <?= $this->render('_list-branch', ['branches' => $model->getPartnerBranches()]) ?>
        </div>
    </div>
    
    
    
    <div class="row">
    
        <div class="col-xs-12 col-md-6">
            <?= $this->render('_list-company', ['companies' => app\models\Company::find()]) ?>
        </div>

        <div class="col-xs-12 col-md-6">
            <?= $this->render('_list-job', ['jobs' => app\models\Company::find()]) ?>
        </div>
    </div>
    
</div>
