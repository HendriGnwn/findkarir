<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var \app\models\Profile $profile
 */

$this->title = $profile->user->getName();
$this->params['breadcrumbs'][] = ['url' => ['/user-dashboard/index'], 'label' => 'User'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12 col-md-2">
        <?= $this->render('@app/views/layouts/_menu-applicant') ?>
    </div>
    <div class="col-xs-12 col-md-10">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="pull-right">
                    <?= Html::a(Yii::t('app.button', 'Update'), ['/user/profile/update'], ['class' => 'btn btn-primary btn-sm']) ?>
                </div>
                <h3 class="panel-title"><?= Yii::t('app.label', 'Profile Details') ?></h3>
            </div>
            <div class="panel-body">
                <?= \yii\widgets\DetailView::widget([
                    'model' => $profile,
                    'attributes' => [
                        'name',
                        [
                            'attribute' => 'photo',
                            'value' => $profile->getPhotoImg(['width' => '80px']),
                            'format' => 'raw',
                        ],
                        'phone',
                        [
                            'attribute' => 'gender',
                            'value' => $profile->getGenderLabel(),
                            'format' => 'raw',
                        ],
                        'hobby',
                        [
                            'attribute' => 'married_status',
                            'value' => $profile->getMarriedStatusLabel(),
                            'format' => 'raw',
                        ],
                        'bio',
                        [
                            'attribute' => 'salary',
                            'value' => $profile->getFormattedExpectedSalary(),
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'cv',
                            'value' => $profile->getCvUrlHtml(),
                            'format' => 'raw',
                        ],
                        'cv_updated_at:datetime',
                        'status:boolean',
                    ]
                ]) ?>
            </div>
        </div>
    </div>
</div>