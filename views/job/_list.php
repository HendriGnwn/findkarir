<?php

use yii\helpers\Html;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<article class="item" data-key="<?= $model->id; ?>">
    <h2 class="title">
    <?= Html::a(Html::encode($model->name), $model->job->getDetailUrl(true)) ?>
    </h2>

    <div class="item-excerpt">
    <?= Html::encode($model->description); ?>
    </div>
</article>