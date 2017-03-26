<?php

/* @var $model app\models\User */

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$profile = $model->profile;

?>

<?= \yii\widgets\DetailView::widget([
    'model' => $model,
    'attributes' => [
        'email',
    ],
]) ?>

<?= \yii\widgets\DetailView::widget([
    'model' => $profile,
    'attributes' => [
        'name',
        'photo',
        'phone',
        'gender',
        'married_status',
        'bio',
        'timezone',
        'salary',
        'cv',
    ],
]) ?>