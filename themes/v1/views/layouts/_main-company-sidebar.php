<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <?= yii\bootstrap\Nav::widget([
            'options' => [
                'class' => 'page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu',
                'data-keep-expanded' => false,
                'data-auto-scroll' => true,
                'data-slide-speed' => 200,
            ],
            'items' => [
                [
                    'label' => '<i class="icon-home"></i><span class="title">'.Yii::t('app.menu', 'Dashboard').'</span><span class="arrow"></span>', 
                    'url' => ['/company-dashboard/index'],
                    'options' => [
                        'class' => 'nav-item start',
                    ],
                    'linkOptions' => [
                        'class' => 'nav-link nav-toggle',
                    ],
                ],
                [
                    'label' => '<i class="icon-list"></i><span class="title">'.Yii::t('app.menu', 'Jobs').'</span><span class="arrow"></span>', 
                    'url' => ['/company-dashboard/job'],
                    'options' => [
                        'class' => 'nav-item',
                    ],
                    'linkOptions' => [
                        'class' => 'nav-link',
                    ],
                ],
                [
                    'label' => '<i class="icon-wallet"></i><span class="title">'.Yii::t('app.menu', 'Orders').'</span><span class="arrow"></span>', 
                    'url' => ['/company-dashboard/order'],
                    'options' => [
                        'class' => 'nav-item',
                    ],
                    'linkOptions' => [
                        'class' => 'nav-link',
                    ],
                ],
            ],
            'encodeLabels' => false,
        ]) ?>
    </div>
</div>