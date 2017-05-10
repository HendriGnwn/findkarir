<?php

use yii\web\View;
/* @var $this View */

$this->title = Yii::t('app.label', 'Jobs Listing');
$this->params['breadcrumbs'][] = ['url' => ['/company-dashboard/index'], 'label' => '<i class=\'fa fa-user\'></i>User', 'encode'=>false];
$this->params['breadcrumbs'][] = $this->title;

?>