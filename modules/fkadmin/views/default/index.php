<?php

use app\models\Company;
use app\models\Job;
use app\models\User;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Dashboard');
$this->params['breadcrumbs'][] = $this->title;

?>

<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?= Job::find()->count() ?></h3>

                <p><?= Yii::t('app.label', 'Jobs') ?></p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="<?= Url::to(['/fkadmin/job/index']) ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?= Company::find()->count() ?></h3>

                <p><?= Yii::t('app.label', 'General Companies') ?></p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?= Url::to(['/fkadmin/company/index']) ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?= User::find()->where(['category' => User::ROLE_APPLICANT])->count() ?></h3>

                <p><?= Yii::t('app.label', 'Applicants') ?></p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="<?= Url::to(['/fkadmin/applicant/index']) ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3><?= $dataProviderOrdersActives->count ?></h3>

                <p><?= Yii::t('app.label', 'Order Actives') ?></p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?= Url::to(['']) ?>#order-active" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-8 connectedSortable">
        <!-- quick email widget -->
        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-globe"></i>

                <h3 class="box-title"><?= Yii::t('app.label', 'Jobs Free Actives') ?></h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-info btn-sm" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <!-- /. tools -->
            </div>
            <div class="box-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProviderJobsFree,
                    'filterModel' => $searchJobsFree,
                    'responsiveWrap' => false,
                    'columns' => [
                        [
                            'attribute' => 'name',
                            'content' => function ($model) {
                                return Html::a($model->name, ['/fkadmin/job/view', 'id' => $model->id]);
                            }
                        ],
                        [
                            'attribute' => 'company_id',
                            'content' => function ($model) {
                                return isset($model->company) ? $model->company->name : $model->company_id;
                            }
                        ],
                        [
                            'label' => Yii::t('app.label', 'Open'),
                            'attribute' => 'open_job_date',
                            'width' => '10%',
                        ],
                        [
                            'label' => Yii::t('app.label', 'Close'),
                            'attribute' => 'close_job_date',
                            'width' => '10%',
                        ],
                    ],
                ]) ?>
            </div>
            <div class="box-footer clearfix">
            </div>
        </div>

    </section>
    <!-- /.Left col -->
    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-lg-4 connectedSortable">
        <!-- Calendar -->
        <div class="box box-solid bg-green-gradient">
            <div class="box-header">
                <i class="fa fa-calendar"></i>

                <h3 class="box-title">Calendar</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <!-- button with a dropdown -->
<!--                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bars"></i></button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="#">Add new event</a></li>
                            <li><a href="#">Clear events</a></li>
                            <li class="divider"></li>
                            <li><a href="#">View calendar</a></li>
                        </ul>
                    </div>-->
                    <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
                <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-black">
                <div class="row">
                    <div class="col-sm-6">
                        <!-- Progress bars -->
                        <div class="clearfix">
                            <span class="pull-left">Task #1</span>
                            <small class="pull-right">90%</small>
                        </div>
                        <div class="progress xs">
                            <div class="progress-bar progress-bar-green" style="width: 90%;"></div>
                        </div>

                        <div class="clearfix">
                            <span class="pull-left">Task #2</span>
                            <small class="pull-right">70%</small>
                        </div>
                        <div class="progress xs">
                            <div class="progress-bar progress-bar-green" style="width: 70%;"></div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <div class="clearfix">
                            <span class="pull-left">Task #3</span>
                            <small class="pull-right">60%</small>
                        </div>
                        <div class="progress xs">
                            <div class="progress-bar progress-bar-green" style="width: 60%;"></div>
                        </div>

                        <div class="clearfix">
                            <span class="pull-left">Task #4</span>
                            <small class="pull-right">40%</small>
                        </div>
                        <div class="progress xs">
                            <div class="progress-bar progress-bar-green" style="width: 40%;"></div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.box -->

    </section>
    <!-- right col -->
</div>
<!-- /.row (main row) -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <!-- quick email widget -->
        <div class="box box-success">
            <div class="box-header">
                <i class="fa fa-check-square-o"></i>

                <h3 class="box-title"><?= Yii::t('app.label', 'Jobs Premium Actives') ?></h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-success btn-sm" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <!-- /. tools -->
            </div>
            <div class="box-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProviderJobsPremium,
                    'filterModel' => $searchJobsPremium,
                    'responsiveWrap' => false,
                    'columns' => [
                        [
                            'attribute' => 'name',
                            'content' => function ($model) {
                                return Html::a($model->name, ['/fkadmin/job/view', 'id' => $model->id]);
                            }
                        ],
                        [
                            'attribute' => 'company_id',
                            'content' => function ($model) {
                                return isset($model->company) ? $model->company->name : $model->company_id;
                            }
                        ],
                        [
                            'label' => Yii::t('app.label', 'Open'),
                            'attribute' => 'open_job_date',
                            'width' => '10%',
                        ],
                        [
                            'label' => Yii::t('app.label', 'Close'),
                            'attribute' => 'close_job_date',
                            'width' => '10%',
                        ],
                    ],
                ]) ?>
            </div>
            <div class="box-footer clearfix">
            </div>
        </div>

    </section>
</div>
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable" id="order-active">
        <!-- quick email widget -->
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-list"></i>

                <h3 class="box-title"><?= Yii::t('app.label', 'Orders Actives') ?></h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-primary btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <!-- /. tools -->
            </div>
            <div class="box-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProviderOrdersActives,
                    'filterModel' => $searchOrdersActives,
                    'responsiveWrap' => false,
                    'columns' => [
                        [
                            'attribute' => 'code',
                            'width' => '10%',
                            'content' => function ($model) {
                                return Html::a($model->code, ['/fkadmin/order/view', 'id' => $model->id]);
                            }
                        ],
                        [
                            'attribute' => 'user_id',
                            'content' => function ($model) {
                                return isset($model->user) ? $model->user->getNameWithUsername() : $model->user_id;
                            },
                            'width' => '30%',
                        ],
                        [
                            'attribute' => 'partner_id',
                            'content' => function ($model) {
                                return isset($model->partner) ? $model->partner->name : $model->partner_id;
                            },
                            'width' => '30%',
                        ],
                        [
                            'attribute' => 'offer_id',
                            'content' => function ($model) {
                                return isset($model->offer) ? $model->offer->name : $model->offer_id;
                            }
                        ],
                        [
                            'label' => Yii::t('app.label', 'Expire'),
                            'attribute' => 'offer_expired_at',
                            'width' => '10%',
                        ],
                    ],
                ]) ?>
            </div>
            <div class="box-footer clearfix">
            </div>
        </div>

    </section>
</div>