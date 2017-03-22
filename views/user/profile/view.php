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
        <?= Html::a(Yii::t('app.button', 'Update'), ['/user/profile/update'], ['class' => 'btn btn-primary']) ?>
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <?= \yii\widgets\DetailView::widget([
                    'model' => $profile,
                    'attributes' => [
                        [
                            'attribute' => 'avatar_id',
                            'value' => Html::img($profile->getAvatarUrl(20), [
                                'class' => 'img-rounded img-responsive',
                                'alt' => $profile->user->username,
                            ]),
                            'format' => 'raw',
                        ],
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