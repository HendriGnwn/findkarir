<?php
use yii\bootstrap\Nav;

?>

<?= Nav::widget([
    'options' => [
        'class' => 'nav-tabs',
        'style' => 'margin-bottom: 15px',
    ],
    'items' => [
        [
            'label'   => '<i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;' . Yii::t('app', 'User Companies'),
            'url'     => ['company/index'],
			'encode' => false,
        ],
        [
			'label' => '<i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;' . Yii::t('app', 'Partner Companies'),
            'url'   => ['company/index-partner'],
			'encode' => false,
        ],
    ],
]) ?>