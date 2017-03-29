<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

$title = $this->title .' | ' . Yii::$app->name;

//if (class_exists('backend\assets\AppAsset')) {
//	backend\assets\AppAsset::register($this);
//} else {
//	app\assets\AppAsset::register($this);
//}

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($title) ?></title>
	<?php $this->head() ?>
</head>
<body class="hold-transition <?= \dmstr\helpers\AdminLteHelper::skinClass() ?> ">
<?php $this->beginBody() ?>
<div class="wrapper homepage">
	
	<?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

	<br/><br/>
	<?= $content ?>

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>