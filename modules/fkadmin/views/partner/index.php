<?php

use yii\helpers\Html;
use kartik\grid\GridView;
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
        <div class="box-body table-responsive">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            
            <?php Pjax::begin(); ?>   
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'header' => 'Have a Users',
                        'content' => function ($model) {
                            return $model->getCountPartnerHasUsers();
                        }
                    ],
                    'code',
                    'name',
                    //'legal',
                    //'photo',
                    // 'phone',
                    // 'address',
                    [
                        'attribute' => 'city_id',
                        'content' => function ($model) {
                            return $model->city->name;
                        }
                    ],
                    // 'province_id',
                    // 'description:ntext',
                    // 'public_email:email',
                    [
                        'attribute' => 'status',
                        'content' => function ($model) {
                            return $model->getStatusWithStyle();
                        }
                    ],
                    'created_at:datetime',
                    // 'created_by',
                    // 'updated_at',
                    // 'updated_by',

                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'width' => '9%',
                        'template' => '{addMember}&nbsp;&nbsp;{view} {update} {delete}',
                        'buttons' => [
                            'addMember' => function ($url, $model, $key) {
                                return \yii\bootstrap\Html::a(
                                        '<i class=\'fa fa-plus-square\'></i>',
                                        ['partner-has-user/create', 'id'=>$model->id],
                                        [
                                            'title' => 'Add new Member',
                                        ]
                                );
                            },
                        ],
                    ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
        <div class="box-footer">
            
        </div>
    </div>
</div>
