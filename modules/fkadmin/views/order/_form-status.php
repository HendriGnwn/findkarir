<?php

use app\models\Currency;
use app\models\Offer;
use app\models\Order;
use app\models\User;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Order */
/* @var $form ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary($model) ?>
    
    <?php
    $status = Order::statusLabels();
    ?>

    <?= $form->field($model, 'status')->dropDownList($status) ?>
    <?= Html::label(Yii::t('app.message', 'Order status cannot be change to {status}', ['status' => 'Paid, Waiting Payment, Confirmed by User']), '#order-status', ['class'=>'label label-warning']) ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

<?php
$this->registerJs("
 
    var offerExpiredAt = $('#order-offer_expired_at'),
        currencyId = $('#order-currency_id'),
        amount = $('#order-amount'),
        adminFee = $('#order-admin_fee'),
        finalAmount = $('#order-final_amount');
        
    $('#order-offer_id').change(function() {
        $.ajax({
			dataType: 'json',
			url: '".Url::to(['ajax/get-offer'], true)."',
			data: {
				id: $(this).val()
			},
			success: function(result) {
                if (result) {
                    //offerExpiredAt.val(result.offer_expired_at);
                    offerExpiredAt.val('2017-04-02').trigger('change');
                    currencyId.val(result.currency_id).trigger('change');
                    amount.val(result.amount);
                    adminFee.val(result.admin_fee);
                    var final = Number(result.amount) + Number(result.admin_fee);
                    finalAmount.val(final);
                } else {
                    offerExpiredAt.val('');
                    currencyId.val('').trigger('change');
                    amount.val('');
                    adminFee.val('');
                    finalAmount.val('');
                }
			},
		});
    });
    
    adminFee.keyup(function() {
        finalAmount.val(Number(amount.val()) + Number($(this).val()));
    });
    
    amount.keyup(function() {
        finalAmount.val(Number(adminFee.val()) + Number($(this).val()));
    });

", View::POS_END, 'order');