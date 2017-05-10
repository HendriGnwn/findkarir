<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PartnerBranch */

$this->title = Yii::t('app', 'Create Partner Branch');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Partner Branches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partner-branch-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
