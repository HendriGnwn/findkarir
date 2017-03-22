<?php

use yii\helpers\Html;
use yii\web\View;
/* @var $this View */

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = ['url' => ['/user-dashboard/index'], 'label' => 'User'];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
    <div class="col-xs-12 col-md-2">
        <?= $this->render('@app/views/layouts/_menu-applicant') ?>
    </div>
    <div class="col-xs-12 col-md-10">
        <h1>user-dashboard/index</h1>

        <p>
            You may change the content of this page by modifying
            the file <code><?= __FILE__; ?></code>.
        </p>
    </div>
</div>