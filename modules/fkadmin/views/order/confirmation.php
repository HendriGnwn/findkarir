<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
?>
<div class="order-confirmation">

    <?= $this->render('_confirmation', [
        'model' => $model,
    ]) ?>

</div>
