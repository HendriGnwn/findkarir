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
            'label'   => Yii::t('user', 'Jobs Actives [All]'),
            'url'     => ['/fkadmin/job/actives'],
        ],
        [
            'label'   => Yii::t('user', 'Jobs [Free]'),
            'url'     => ['/fkadmin/job/index'],
        ],
        
        [
            'label' => Yii::t('user', 'Jobs [Premium]'),
            'url'   => ['/fkadmin/job/premium'],
        ],
    ],
]) ?>
