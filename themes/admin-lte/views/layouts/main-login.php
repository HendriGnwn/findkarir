<?php

use app\assets\LoginAsset;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $content string */

$title = $this->title .' | ' . Yii::$app->name;

LoginAsset::register($this);
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
<body class="login-page">

<?php $this->beginBody() ?>
	
	<div class="login-box">
		
	</div>
	<div class="login-logo text-center">
		<h1><?= Yii::$app->name ?></h1>
	</div>
	<?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
