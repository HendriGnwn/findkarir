<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Currency */
?>
<div class="currency-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'code',
            'name',
            'symbol',
            'rate',
            'order',
        ],
    ]) ?>

</div>
