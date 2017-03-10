<?php

use app\helpers\DetailViewHelper;
use app\models\PartnerHasUser;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model PartnerHasUser */

$this->title = $model->partner->name . ' - ' . $model->user->getName(); 
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Partner Has Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partner-has-user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Goto Partner'), ['partner/view', 'id' => $model->partner_id], ['class' => 'btn btn-success']) ?>
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
                'attribute' => 'partner_id',
                'value' => $model->partner->name,
            ],
            [
                'attribute' => 'partner_branch_id',
                'value' => $model->partnerBranch ? $model->partnerBranch->name : $model->partner_branch_id,
            ],
            [
                'attribute' => 'user_id',
                'value' => $model->user->username,
            ],
            [
                'attribute' => 'user_id',
                'value' => $model->getUserDetailUrlHtml(),
                'format' => 'raw',
            ],
//            [
//                'attribute' => 'status',
//                'value' => $model->getStatusWithStyle(),
//                'format' => 'raw',
//            ],
            'created_at',
            'updated_at',
            DetailViewHelper::author($model, 'created_by'),
            DetailViewHelper::author($model, 'updated_by'),
        ],
    ]) ?>

</div>
