<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Visitor */
?>
<div class="visitor-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'quantity',
            'date',
            'is_real',
        ],
    ]) ?>

</div>
