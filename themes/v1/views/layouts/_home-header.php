<?php

use app\helpers\Url;
use yii\bootstrap\Nav;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$user = Yii::$app->user->identity;

?>
<!--=== Header ===-->
<div class="header header-sticky">
    <div class="container">
        <!-- Logo -->
        <?= Html::a(
            Html::img(Url::to(['@web/data/img/logo.png']), ['width' => 200]),
            Url::home(),
            [
                'class' => 'logo',
            ]
        ) ?>
        <!-- End Logo -->

        <!-- Topbar -->
        <div class="topbar">
            <ul class="loginbar pull-right">
                <li class="hoverSelector">
                    <i class="fa fa-globe"></i>
                    <a>Bahasa</a>
                    <ul class="languages hoverSelectorBlock">
                        <li class="active">
                            <a href="#">Indonesia <i class="fa fa-check"></i></a>
                        </li>
                        <li><a href="#">English</a>
                        </li>
                    </ul>
                </li>
                <li class="topbar-devider"></li>
                <li>
                    <?= Html::a(Yii::t('app.button', 'Help'), ['/site/help']) ?>
                </li>
                <?php
                if (Yii::$app->user->isGuest) :
                ?>
                    <li class="topbar-devider"></li>
                    <li>
                        <?= Html::a(Yii::t('app.button', 'Applicants'), ['/user/security/login']) ?>
                    </li>
                    <li class="topbar-devider"></li>
                    <li>
                        <?= Html::a(Yii::t('app.button', 'Companies'), ['/company/login']) ?>
                    </li>
                <?php else: ?>
                    <?php
                    $url = ['/'];
                    if ($user->getIsCategoryApplicant()) {
                        $url = ['/user-dashboard/index'];
                    } else if ($user->getIsCategoryGeneralCompany()) {
                        $url = ['/company-dashboard/index'];
                    } else if ($user->getIsCategoryMember()) {
                        $url = ['/member-dashboard/index'];
                    }
                    ?>
                    <li class="topbar-devider"></li>
                    <li>
                        <?= Html::a(Yii::t('app.button', 'Hi').' '.Yii::$app->user->identity->getName(), $url) ?>
                        <ul class="languages hoverSelectorBlock">
                            <li>
                                <?= Html::beginForm(['/user/logout'], 'post') ?>
                                <?= Html::submitButton(
                                    Yii::t('app.button', 'Logout'),
                                    ['class' => 'btn btn-default btn-block logout']
                                ) ?>
                                <?= Html::endForm() ?>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <!-- End Topbar -->

        <!-- Toggle get grouped for better mobile display -->
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="fa fa-bars"></span>
        </button>
        <!-- End Toggle -->
    </div>
    <!--/end container-->

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse mega-menu navbar-responsive-collapse">
        <div class="container"><!--
                         End Company Pages 
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle icon-user" data-toggle="dropdown" title="SANDI WINATA">                         
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#">Profil</a>
                                    
                                </li>
                                <li>
                                    <a href="#">Pengaturan</a>
                                    
                                </li>
                                <li>
                                    <a href="#">Keluar</a>
                                    
                                </li>                               
                            </ul>
                        </li>                        
                    </ul>
                </div>-->
                <!--/end container-->                
<!--            </div>-->
            <?php
            $guest = Yii::$app->user->isGuest ? 
                [
                    ['label' => Yii::t('app.menu', 'Sign In'), 'url' => ['/user/security/login']],
                    ['label' => Yii::t('app.menu', 'Sign Up'), 'url' => ['/user/registration/register']],
                ]
             : 
                [
                    [
                        'label' => Yii::t('app.menu', 'Hi').' '.$user->getName(),
                        'url' => $url,
                        'items' => [
                            [
                                'label' => Yii::t('app.menu', 'Profile'),
                                'url' => $url,
                            ],
                            '<li>'
                            . Html::beginForm(['/user/logout'], 'post')
                            . Html::submitButton(
                                Yii::t('app.button', 'Logout'),
                                [
                                    'class' => 'btn btn-default btn-xs btn-block logout',
                                    'style' => 'padding:5px 15px !important; text-align:left;'
                                ]
                            )
                            . Html::endForm()
                            . '</li>'
                        ],
                    ]
                    
                ];
            
            $items = ArrayHelper::merge([
                ['label' => Yii::t('app.menu', 'Search Jobs'), 'url' => ['/job/search']],
                ['label' => Yii::t('app.menu', 'Company'), 'url' => ['/company/login']],
            ], $guest);
            $search = ['<li>
                        <i class="search fa fa-search search-btn"></i>
                        <div class="search-open">
                            <div class="input-group animated fadeInDown">
                                <input type="text" class="form-control" placeholder="'.Yii::t('app.message', 'Position or Company').'">
                                <span class="input-group-btn">
                                    <button class="btn-u" type="button">'.Yii::t('app.button', 'Search').'</button>
                                </span>
                            </div>
                        </div>
                    </li>'];
            $items = ArrayHelper::merge($items, $search);
            ?>
            <?= Nav::widget([
                'options' => ['class' => 'navbar-nav'],
                'items' => $items,
            ]) ?>
        </div>
        <!--/end container-->
    </div>
    <!--/navbar-collapse-->
</div>
<!--=== End Header ===-->
<br/><br/>
<br/><br/>