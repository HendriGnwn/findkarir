<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

$request = Yii::$app->request;
		
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">JO</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
		
        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
				
				<?php //= $this->render('_messages', ['directoryAsset' => $directoryAsset]) ?>
                
				<?php //= $this->render('_notifications', ['directoryAsset' => $directoryAsset]) ?>
                
                <?php //= $this->render('_tasks', ['directoryAsset' => $directoryAsset]) ?>
				
				<?php if(Yii::$app->user->isGuest): ?>
					<li class="<?= $request->url == '/user/register' ? 'active' : '' ?>">
						<?= Html::a('<i class="fa fa-user-plus"></i>&nbsp;&nbsp; Register',['/user/register']); ?>
					</li>
					<li class="<?= $request->url == '/user/login' ? 'active' : '' ?>">
						<?= Html::a('<i class="fa fa-sign-in"></i>&nbsp;&nbsp; Sign In',['/user/login']); ?>
					</li>
				<?php else: ?>
					<li class="dropdown user user-menu">
						<div class="container-fluid">
							<div class="navbar-custom-menu" id="navbar-collapse">
								<ul class="nav navbar-nav navbar-right">
									<li class="dropdown">
									  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=(!Yii::$app->user->isGuest) ? Yii::$app->user->identity->getName():'&nbsp;';?> <span class="caret"></span></a>
									  <ul class="dropdown-menu" role="menu">
										<li><?=Html::a('Profile',['/fkadmin/user/settings/account']);?></li>
										<li><?= Html::a(
													'Sign out',
													['/fkadmin/user/security/logout'],
													['data-method' => 'post']
												) ?></li>
									  </ul>
									</li>
								</ul>
							</div>
						</div>
					</li>
				<?php endif; ?>

                <!-- User Account: style can be found in dropdown.less -->
<!--                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>-->
            </ul>
        </div>
    </nav>
</header>