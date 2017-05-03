<?php

/* @var $this View */
/* @var $content string */

use app\assets\HomeAsset;
use app\models\City;
use app\models\Config;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
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
    <title><?= Html::encode($this->title) ?> - <?= Config::getAppNameUrl() ?></title>
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
            <?= Html::beginForm(['job/search'], 'GET') ?>
            <div class="job-img-inputs">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 md-margin-bottom-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <?= Html::textInput('search', null, [
                                    'placeholder' => Yii::t('app.label', 'Position and Company'),
                                    'class' => 'form-control',
                                ]) ?>
                            </div>
                        </div>
                        <div class="col-sm-4 md-margin-bottom-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <?php
                                $cities = ArrayHelper::map(City::find()->actived()->all(), 'slug', 'name');
                                echo Select2::widget([
                                    'data' => $cities,
                                    'name' => 'city',
                                    'options' => [
                                        'prompt' => Yii::t('app.label', 'All in the City'),
                                    ],
                                    'theme' => Select2::THEME_BOOTSTRAP,
                                ]);
                                ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <?= Html::submitInput(Yii::t('app.button', 'Search'), [
                                'class' => 'btn-u btn-block btn-u-blue btn-flat',
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
            <?= Html::endForm() ?>
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
