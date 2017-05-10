<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* @var $user app\models\User */

$user = Yii::$app->user->identity;

?>
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <?= Html::a(
                Html::img(Url::to(['@web/data/img/logo.png']), ['width' => 100]),
                Url::home(),
                [
                    'class' => 'logo-default',
                ]
            ) ?>
            <div class="menu-toggler sidebar-toggler">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN PAGE ACTIONS -->
        <!-- DOC: Remove "hide" class to enable the page header actions -->
        <!-- <div class="page-actions">
            <div class="btn-group">
                <button type="button" class="btn btn-circle btn red">
                    <span class="hidden-sm hidden-xs">Beli Paket&nbsp;</span>&nbsp;
                </button>                                               
            </div>
            <div class="btn-group">                        
                <button type="button" class="btn btn-circle btn blue">
                    <span class="hidden-sm hidden-xs">Pasang Lowongan&nbsp;</span>&nbsp;
                </button>                        
            </div>
        </div> -->
        <!-- END PAGE ACTIONS -->
        <!-- BEGIN PAGE TOP -->
        <div class="page-top">                    
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <!-- BEGIN INBOX DROPDOWN -->
                    <!-- END INBOX DROPDOWN -->  
                    <!-- BEGIN NOTIFICATION DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class below "dropdown-extended" to change the dropdown styte -->
                    <!-- DOC: Apply "dropdown-hoverable" class after below "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                    <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
                    <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-bell"></i>
                            <span class="badge badge-default"> 7 </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time">just now</span>
                                            <span class="details">
                                                <span class="label label-sm label-icon label-success">
                                                    <i class="fa fa-plus"></i>
                                                </span> New user registered. </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- END NOTIFICATION DROPDOWN -->

                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <?= $user->profile->getPhotoImg(['class' => 'img-circle']) ?>
                            <span class="username username-hide-on-mobile"><?= $user->getName() ?></span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <?= Html::a(
                                    '<i class=\'icon-home\'></i>&nbsp;' . Yii::t('app.button', 'Update Profile'),
                                    ['/company-dashboard/profile']
                                ) ?>
                            </li>
                            <li>
                                <?= Html::a(
                                    '<i class=\'icon-lock\'></i>&nbsp;' . Yii::t('app.button', 'Change Password'),
                                    ['/company-dashboard/account']
                                ) ?>
                            </li>                                    
                            <li>
                                <?= Html::beginForm(['/user/logout'], 'post') ?>
                                <?= Html::submitButton(
                                    '<i class="icon-key"></i>'.Yii::t('app.button', 'Logout'),
                                    ['class' => 'btn btn-block text-left']
                                ) ?>
                                <?= Html::endForm() ?>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                    <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-extended quick-sidebar-toggler">
                        <span class="sr-only">Toggle Quick Sidebar</span>
                        <i class="icon-logout"></i>
                    </li>
                    <!-- END QUICK SIDEBAR TOGGLER -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END PAGE TOP -->
    </div>
    <!-- END HEADER INNER -->
</div>