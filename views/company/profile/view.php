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
 * @var \dektrium\user\models\Profile $profile
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
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <?= Html::img($profile->getAvatarUrl(230), [
                    'class' => 'img-rounded img-responsive',
                    'alt' => $profile->user->username,
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <?= \yii\widgets\DetailView::widget([
                    'model' => $profile,
                    'attributes' => [
                        'name',
                        'photo',
                        'public_email',
                        'phone',
                        'gender',
                        'gravatar_email',
                        'gravatar_id',
                        'location',
                        'website',
                        'hobby',
                        'married_status',
                        'bio',
                        'timezone',
                        'salary',
                        'cv',
                        'cv_updated_at',
                        'status',
                    ]
                ]) ?>
            </div>
        </div>
    </div>
</div>