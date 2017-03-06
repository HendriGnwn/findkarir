<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\fkadmin\models\PartnerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Partners');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partner-index">
    <div class="box box-primary">
        <div class="box-header  with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <div class="box-tools">
                <?= Html::a('<i class=\'fa fa-plus-square\'></i>&nbsp;&nbsp;' . Yii::t('app.button', 'Add New'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
            </div>
        </div>
        <div class="box-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            
            <?php Pjax::begin(); ?>   
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'code',
                    'name',
                    'legal',
                    'photo',
                    // 'phone',
                    // 'address',
                    // 'city_id',
                    // 'province_id',
                    // 'description:ntext',
                    // 'public_email:email',
                    // 'status',
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
