<?php

use johnitvn\ajaxcrud\CrudAsset;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\web\View;
/* @var $this View */

$this->title = 'Passions';
$this->params['breadcrumbs'][] = ['url' => ['/user-dashboard/index'], 'label' => 'User'];
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
?>
<div class="row">
    <div class="col-xs-12 col-md-2">
        <?= $this->render('@app/views/layouts/_menu-applicant') ?>
    </div>
    <div class="col-xs-12 col-md-10">
        <div id="ajaxCrudDatatable">
            <?=GridView::widget([
                'id'=>'crud-datatable',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'pjax'=>true,
                'columns' => require(__DIR__.'/_columns.php'),
                'toolbar'=> [
                    ['content'=>
                        Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;'.Yii::t('app.button', 'Create New'), ['create'],
                        ['role'=>'modal-remote','title'=> 'Create new Skills','class'=>'btn btn-default']).
                        Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                        ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                        '{toggleData}'
                    ],
                ],          
                'striped' => true,
                'condensed' => true,
                'responsive' => true,          
                'panel' => [
                    'type' => 'primary', 
                    'heading' => '<i class="glyphicon glyphicon-list"></i> Your Passions',
                ]
            ])?>
        </div>
        <?php 
        Modal::begin([
            "id"=>"ajaxCrudModal",
            "footer"=>"",// always need it for jquery plugin
        ]);
        Modal::end();
        ?>
    </div>
</div>