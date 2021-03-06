<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use dektrium\user\models\Profile;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/**
 * @var View $this
 * @var Profile $profile
 */

$this->title = $profile->user->getName();
$this->params['breadcrumbs'][] = ['url' => ['/user-dashboard/index'], 'label' => 'User'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?= Yii::t('app.label', 'Profile Details') ?></h3>
    </div>
    <div class="panel-body">
        <?= Html::a(Yii::t('app.button', 'Update'), ['/company-dashboard/update-profile'], ['class' => 'btn btn-primary']) ?>
        <br/><br/>
        <?= DetailView::widget([
            'model' => $profile,
            'attributes' => [
                'code',
                'name',
                'address',
                [
                    'attribute' => 'city_id',
                    'value' => isset($profile->city) ? $profile->city->name : $profile->city_id,
                ],
                'phone',
                'sector_area',
                'employee_quantity',
                'website',
                [
                    'attribute' => 'photo',
                    'value' => $profile->getPhotoImg(['width' => 200]),
                    'format' => 'raw',
                ],
                'description',
                'status:boolean',
            ]
        ]) ?>
    </div>
</div>