<?php

/* @var $this View */
/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Breadcrumbs;

\app\assets\DashboardCompanyAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">
<?php $this->beginBody() ?>
    
    <?= $this->render('_main-company-header') ?>
    <div class="clearfix"> </div>
    <div class="page-container">
        <?= $this->render('_main-company-sidebar') ?>
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <!-- BEGIN PAGE HEADER-->                    
                <h1 class="page-title"><?= $this->title ?></h1>
                <div class="page-bar">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'options' => [
                            'class' => 'page-breadcrumb'
                        ],
                        'homeLink' => [
                            'label' => '<i class=\'fa fa-home\'></i> Home',
                            'url' => ['/company-dashboard/index'],
                        ],
                        'encodeLabels' => false,
                    ]) ?>
                </div>
                <?= $this->render('@app/views/_alert') ?>
                <?= $content ?>
            </div>
        </div>
    </div>
    
    <?= $this->render('_main-company-footer') ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
