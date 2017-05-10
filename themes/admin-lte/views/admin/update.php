<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use app\models\User;
use yii\bootstrap\Nav;
use yii\web\View;

/**
 * @var View    $this
 * @var User    $user
 * @var string  $content
 */

$this->title = Yii::t('user', 'Update user account');
$this->params['breadcrumbs'][] = ['label' => Yii::t('user', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render('_menu') ?>

<div class="row">
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <?= Nav::widget([
                    'options' => [
                        'class' => 'nav-pills nav-stacked',
                    ],
                    'items' => [
                        [
                            'label' => Yii::t('user', 'Account details'),
                            'url' => ['/fkadmin/user/admin/update', 'id' => $user->id],
                        ],
                        [
                            'label' => Yii::t('user', 'Profile details'),
                            'url' => ['/fkadmin/user/admin/update-profile', 'id' => $user->id],
                            'visible' => !$user->getIsCategoryGeneralCompany(),
                        ],
						[
                            'label' => Yii::t('user', 'Company details'), 
                            'url' => ['/fkadmin/user/admin/company', 'id' => $user->id],
                            'visible' => $user->getIsCategoryGeneralCompany(),
                        ],
                        [
                            'label' => Yii::t('user', 'Education details'), 
                            'url' => ['/fkadmin/education/index', 'id' => $user->id],
                            'visible' => $user->getIsCategoryApplicant(),
                        ],
                        [
                            'label' => Yii::t('user', 'Passion details'), 
                            'url' => ['/fkadmin/passion/index', 'id' => $user->id],
                            'visible' => $user->getIsCategoryApplicant(),
                        ],
                        [
                            'label' => Yii::t('user', 'Skill details'), 
                            'url' => ['/fkadmin/skill/index', 'id' => $user->id],
                            'visible' => $user->getIsCategoryApplicant(),
                        ],
                        ['label' => Yii::t('user', 'Information'), 'url' => ['/fkadmin/user/admin/info', 'id' => $user->id]],
                        [
                            'label' => Yii::t('user', 'Assignments'),
                            'url' => ['/fkadmin/user/admin/assignments', 'id' => $user->id],
                            'visible' => isset(Yii::$app->extensions['dektrium/yii2-rbac']),
                        ],
                        '<hr>',
                        [
                            'label' => Yii::t('user', 'Confirm'),
                            'url'   => ['/fkadmin/user/admin/confirm', 'id' => $user->id],
                            'visible' => !$user->isConfirmed,
                            'linkOptions' => [
                                'class' => 'text-success',
                                'data-method' => 'post',
                                'data-confirm' => Yii::t('user', 'Are you sure you want to confirm this user?'),
                            ],
                        ],
                        [
                            'label' => Yii::t('user', 'Block'),
                            'url'   => ['/fkadmin/user/admin/block', 'id' => $user->id],
                            'visible' => !$user->isBlocked,
                            'linkOptions' => [
                                'class' => 'text-danger',
                                'data-method' => 'post',
                                'data-confirm' => Yii::t('user', 'Are you sure you want to block this user?'),
                            ],
                        ],
                        [
                            'label' => Yii::t('user', 'Unblock'),
                            'url'   => ['/fkadmin/user/admin/block', 'id' => $user->id],
                            'visible' => $user->isBlocked,
                            'linkOptions' => [
                                'class' => 'text-success',
                                'data-method' => 'post',
                                'data-confirm' => Yii::t('user', 'Are you sure you want to unblock this user?'),
                            ],
                        ],
//                        [
//                            'label' => Yii::t('user', 'Delete'),
//                            'url'   => ['/fkadmin/user/admin/delete', 'id' => $user->id],
//                            'linkOptions' => [
//                                'class' => 'text-danger',
//                                'data-method' => 'post',
//                                'data-confirm' => Yii::t('user', 'Are you sure you want to delete this user?'),
//                            ],
//                        ],
                    ],
                ]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-body">
                <?= $content ?>
            </div>
        </div>
    </div>
</div>
