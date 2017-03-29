<?php

use app\models\Config;
use yii\helpers\Html;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div class="page-footer">
    <div class="page-footer-inner">&copy; <?= Config::getAppNameUrl() ?> 2017 By
        <?= Html::a(Config::getAppCopyright(), 'http://www.atc.co.id', ['target'=>'_blank']) ?>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
</div>