<?php

/*
 * This file is part of the Dektrium project
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\bootstrap\Nav;

?>

<?= Nav::widget([
    'options' => [
        'class' => 'nav-tabs',
        'style' => 'margin-bottom: 15px',
    ],
    'items' => [
        [
            'label'   => Yii::t('user', 'Users'),
            'url'     => ['/fkadmin/user/admin/index'],
        ],
        [
            'label'   => Yii::t('user', 'Roles'),
            'url'     => ['/fkadmin/rbac/role/index'],
            'visible' => isset(Yii::$app->extensions['dektrium/yii2-rbac']),
        ],
        [
            'label' => Yii::t('user', 'Permissions'),
            'url'   => ['/rbac/permission/index'],
            'visible' => isset(Yii::$app->extensions['dektrium/yii2-rbac']),
        ],
        [
            'label' => Yii::t('user', 'Create'),
            'items' => [
                [
                    'label'   => Yii::t('user', 'New user'),
                    'url'     => ['/fkadmin/user/admin/create'],
                ],
                [
                    'label' => Yii::t('user', 'New role'),
                    'url'   => ['/fkadmin/rbac/role/create'],
                    'visible' => isset(Yii::$app->extensions['dektrium/yii2-rbac']),
                ],
                [
                    'label' => Yii::t('user', 'New permission'),
                    'url'   => ['/fkadmin/rbac/permission/create'],
                    'visible' => isset(Yii::$app->extensions['dektrium/yii2-rbac']),
                ],
            ],
        ],
    ],
]) ?>
