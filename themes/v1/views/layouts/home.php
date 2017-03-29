<?php

/* @var $this View */
/* @var $content string */

use app\assets\HomeAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Breadcrumbs;

HomeAsset::register($this);

/** SEO */
$this->registerMetaTag([
    'http-equiv' => 'Content-Type',
    'content' => 'text/html; charset=utf-8'
]);
$this->registerLinkCanonical();
$this->registerMetaTitle();
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
<body class="header-fixed">
<?php $this->beginBody() ?>
    
    <div class="wrapper">
        <?= $this->render('_home-header') ?>
        
        <!--=== Job Img ===-->
        <div class="job-img margin-bottom-30">
            <!-- <div class="job-banner">
				<h2>Temukan masa depan hebatmu disini bersama FindKarir ...</h2>
			</div> -->
            <div class="job-img-inputs">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 md-margin-bottom-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input type="text" placeholder="Posisi atau Perusahaan" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4 md-margin-bottom-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <?php
                                $cities = \yii\helpers\ArrayHelper::map(app\models\City::find()->actived()->all(), 'id', 'name');
                                echo \kartik\select2\Select2::widget([
                                    'data' => $cities,
                                    'name' => 'es',
                                    'options' => [
                                        'prompt' => 'All in the City',
                                    ],
                                    'theme' => \kartik\select2\Select2::THEME_BOOTSTRAP,
                                ]);
                                ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <button type="button" class="btn-u btn-block btn-u-blue btn-flat"> Cari </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--=== End Job Img ===-->

        <div class="container content">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $this->render('@app/views/_alert') ?>
            <?= $content ?>
        </div>
        
        <?= $this->render('_footer') ?>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
