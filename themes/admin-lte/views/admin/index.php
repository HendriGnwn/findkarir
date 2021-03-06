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
use dektrium\user\models\UserSearch;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 * @var UserSearch $searchModel
 */

$this->title = Yii::t('user', 'Manage users');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/admin/_menu') ?>

<div class="box box-primary">
	<div class="box-body">

		<?php Pjax::begin() ?>

		<?= GridView::widget([
			'dataProvider'  =>  $dataProvider,
			'filterModel'   =>  $searchModel,
			'layout'        =>  "{items}\n{pager}",
			'responsive' => true,
			'columns' => [
                [
					'attribute' => 'category',
                    'filter' => User::categoryLabels(),
					'value' => function ($model) {
						return $model->category;
					},
					'format' => 'html',
				],
				'username',
				'email:email',
				[
					'attribute' => 'registration_ip',
					'value' => function ($model) {
						return $model->registration_ip == null
							? '<span class="not-set">' . Yii::t('user', '(not set)') . '</span>'
							: $model->registration_ip;
					},
					'format' => 'html',
				],
				[
					'attribute' => 'created_at',
					'value' => function ($model) {
						if (extension_loaded('intl')) {
							return Yii::t('user', '{0, date, MMMM dd, YYYY HH:mm}', [$model->created_at]);
						} else {
							return date('Y-m-d G:i:s', $model->created_at);
						}
					},
				],
				[
					'header' => Yii::t('user', 'Confirmation'),
					'value' => function ($model) {
						if ($model->isConfirmed) {
							return '<div class="text-center">
										<span class="text-success">' . Yii::t('user', 'Confirmed') . '</span>
									</div>';
						} else {
							return Html::a(Yii::t('user', 'Confirm'), ['confirm', 'id' => $model->id], [
								'class' => 'btn btn-xs btn-success btn-block',
								'data-method' => 'post',
								'data-confirm' => Yii::t('user', 'Are you sure you want to confirm this user?'),
							]);
						}
					},
					'format' => 'raw',
					'visible' => Yii::$app->getModule('user')->enableConfirmation,
				],
				[
					'header' => Yii::t('user', 'Block status'),
					'value' => function ($model) {
						if ($model->isBlocked) {
							return Html::a(Yii::t('user', 'Unblock'), ['block', 'id' => $model->id], [
								'class' => 'btn btn-xs btn-success btn-block',
								'data-method' => 'post',
								'data-confirm' => Yii::t('user', 'Are you sure you want to unblock this user?'),
							]);
						} else {
							return Html::a(Yii::t('user', 'Block'), ['block', 'id' => $model->id], [
								'class' => 'btn btn-xs btn-danger btn-block',
								'data-method' => 'post',
								'data-confirm' => Yii::t('user', 'Are you sure you want to block this user?'),
							]);
						}
					},
					'format' => 'raw',
				],
				[
                    'class' => 'kartik\grid\ActionColumn',
                    'width' => '8%',
                    //'template' => '{switch} {resend_password} {update} {delete}',
                    'template' => '{switch} {resend_password} {update}',
                    'buttons' => [
                        'resend_password' => function ($url, $model, $key) {
                            if (!$model->isAdmin) {
                                return '
                            <a data-method="POST" data-confirm="' . Yii::t('user', 'Are you sure?') . '" href="' . Url::to(['resend-password', 'id' => $model->id]) . '">
                            <span title="' . Yii::t('user', 'Generate and send new password to user') . '" class="glyphicon glyphicon-envelope">
                            </span> </a>';
                            }
                        },
                        'switch' => function ($url, $model) {
                            if($model->id != Yii::$app->user->id && Yii::$app->getModule('user')->enableImpersonateUser) {
                                return Html::a('<span class="glyphicon glyphicon-user"></span>', ['/user/admin/switch', 'id' => $model->id], [
                                    'title' => Yii::t('user', 'Become this user'),
                                    'data-confirm' => Yii::t('user', 'Are you sure you want to switch to this user for the rest of this Session?'),
                                    'data-method' => 'POST',
                                ]);
                            }
                        }
                    ]
                ],
			],
		]); ?>

		<?php Pjax::end() ?>
	</div>
</div>