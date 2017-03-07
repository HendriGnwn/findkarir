<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PartnerHasUser */

$this->title = Yii::t('app', 'Create Partner Has User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Partner Has Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partner-has-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
