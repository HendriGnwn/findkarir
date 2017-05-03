<?php

/* @var $this View */
/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> - <?= \app\models\Config::getAppNameUrl() ?></title>
    <?php $this->head() ?>
</head>
<body class="header-fixed">
<?php $this->beginBody() ?>

    <div class="wrapper">
        <?= $this->render('_home-header') ?>
        <div class="breadcrumbs">
            <div class="container">
                <h1 class="pull-left"><?= Html::encode($this->title) ?></h1>
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'options' => [
                        'class' => 'pull-right breadcrumb',
                    ]
                ]) ?>
            </div>
        </div>
        <div class="container content">
            <?= $this->render('@app/views/_alert') ?>
            <?= $content ?>
        </div>
        
        
    </div>
    <?= $this->render('_footer') ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
