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
            'label'   => Yii::t('app.menu', 'Listing User Orders'),
            'url'     => ['/fkadmin/order/index'],
        ],
        
        [
            'label' => Yii::t('app.menu', 'Listing Partner Orders'),
            'url'   => ['/fkadmin/order/index-partner'],
        ],
        
        [
            'label' => Yii::t('app.menu', 'Listing Orders Confirmation'),
            'url'   => ['/fkadmin/order/index-confirmation'],
        ],
        
        [
            'label' => Yii::t('app.menu', 'Orders History'),
            'url'   => ['/fkadmin/order/index-history'],
        ],
    ],
]) ?>
