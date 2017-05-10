<?php

use johnitvn\ajaxcrud\BulkButtonWidget;
use johnitvn\ajaxcrud\CrudAsset;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\web\View;
/* @var $this View */

$this->

$this->title = Yii::t('app', 'Walk in Interview');
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
                'columns' => require(__DIR__.'/_columns-walk-interview.php'),
                'toolbar'=> [
                    ['content'=>
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
                    'heading' => '<i class="glyphicon glyphicon-list"></i> Job Applies listing',
                    'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
                    'after'=>BulkButtonWidget::widget([
                                'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
                                    ["bulk-delete"] ,
                                    [
                                        "class"=>"btn btn-danger btn-xs",
                                        'role'=>'modal-remote-bulk',
                                        'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                        'data-request-method'=>'post',
                                        'data-confirm-title'=>'Are you sure?',
                                        'data-confirm-message'=>'Are you sure want to delete this item'
                                    ]),
                            ]).                        
                            '<div class="clearfix"></div>',
                ]
            ])?>
        </div>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>