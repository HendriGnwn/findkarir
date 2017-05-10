<?php

use app\models\User;
use yii\widgets\ActiveForm;

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

/**
 * @var ActiveForm      $form
 * @var User   $user
 */
$categories = User::categoryLabels();
unset($categories[User::ROLE_MEMBER]);
?>

<?php if ($user->isNewRecord) : ?>
    <?= $form->field($user, 'category', [
        'template'=>'{label}<div class=\'col-sm-9\'>{input}{hint}</div>{error}',
        'hintOptions' => [
            'class' => 'col-sm-12 label label-warning'
        ],
    ])->dropdownList($categories) ?>
<?php endif; ?>
<?= $form->field($user, 'email')->textInput(['maxlength' => 255]) ?>
<?= $form->field($user, 'username')->textInput(['maxlength' => 255]) ?>
<?= $form->field($user, 'password')->passwordInput() ?>
