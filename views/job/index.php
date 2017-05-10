<?php
/* @var $this yii\web\View */
$this->title = 'Jobs Listing';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'options' => [
        'tag' => 'div',
        'class' => 'list-wrapper',
        'id' => 'list-wrapper',
    ],
    'layout' => "{pager}\n{items}\n{summary}",
    'itemView' => '_list',
]) ?>
