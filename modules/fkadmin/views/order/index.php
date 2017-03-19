<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\fkadmin\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">
    
    <div class="box box-primary">
        <div class="box-header  with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <div class="box-tools">
            </div>
        </div>
        <div class="box-body table-responsive">
            <?php Pjax::begin(); ?>    
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'code',
                    [
                        'attribute' => 'user_id',
                        'content' => function ($model) {
                            return $model->user->getName();
                        }
                    ],
                    //'description:ntext',
                    //'offer_id',
                    [
                        'attribute' => 'offer_id',
                        'content' => function ($model) {
                            return $model->offer->name;
                        }
                    ],
                    'offer_expired_at',
                    [
                        'attribute' => 'status',
                        'content' => function ($model) {
                            return $model->getStatusWithStyle();
                        }
                    ],
                    // 'status_updated_at',
                    // 'status_paid_at',
                    // 'status_expired_at',
                    // 'currency_id',
                    // 'amount',
                    // 'admin_fee',
                    [
                        'attribute' => 'final_amount',
                        'content' => function ($model) {
                            return $model->getFormattedFinalAmount();
                        }
                    ],
                    // 'created_at',
                    // 'created_by',
                    // 'updated_at',
                    // 'updated_by',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
        <div class="box-footer">
            
        </div>
    </div>
</div>
