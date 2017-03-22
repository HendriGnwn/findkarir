<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use app\helpers\FormatConverter;
use yii\helpers\Html;

/**
 * This is the model class for table "order".
 *
 * @property string $id
 * @property string $code
 * @property string $user_id
 * @property string $partner_id
 * @property string $description
 * @property integer $offer_id
 * @property string $offer_at
 * @property string $offer_expired_at
 * @property integer $status
 * @property string $status_updated_at
 * @property string $status_paid_at
 * @property string $status_expired_at
 * @property integer $currency_id
 * @property string $amount
 * @property string $admin_fee
 * @property string $final_amount
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 *
 * @property Offer $offer
 * @property OrderConfirmation[] $orderConfirmations
 */
class Order extends BaseActiveRecord
{
    const STATUS_WAITING_PAYMENT = 0;
    const STATUS_CONFIRMED_BY_USER = 1;
    const STATUS_EXPIRED = 5;
    const STATUS_PAID = 10;
    
    const EVENT_AFTER_STATUS_PAID = 'afterStatusPaid';
    const EVENT_AFTER_STATUS_EXPIRED = 'afterStatusExpired';
    const EVENT_AFTER_STATUS_CONFIRMED_BY_USER = 'afterStatusConfirmedByUser';
    
    public function init() 
    {
        parent::init();
        
        $this->on(self::EVENT_AFTER_STATUS_PAID, [$this, 'afterStatusPaid']);
        $this->on(self::EVENT_AFTER_STATUS_EXPIRED, [$this, 'afterStatusExpired']);
        $this->on(self::EVENT_AFTER_STATUS_CONFIRMED_BY_USER, [$this, 'afterStatusConfirmedByUser']);
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'description', 'offer_id', 'amount', 'admin_fee', 'final_amount'], 'required'],
            [['user_id', 'offer_id', 'status', 'currency_id', 'created_by', 'updated_by', 'partner_id'], 'integer'],
            [['description'], 'string'],
            [['partner_id', 'currency_id', 'partner_id', 'code', 'offer_at', 'offer_expired_at', 'status_updated_at', 'status_paid_at', 'status_expired_at', 'created_at', 'updated_at'], 'safe'],
            [['amount', 'admin_fee', 'final_amount'], 'number'],
            [['code'], 'string', 'max' => 100],
            [['offer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Offer::className(), 'targetAttribute' => ['offer_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['status'], 'default', 'value' => self::STATUS_WAITING_PAYMENT],
            [['currency_id'], 'default', 'value' => Currency::RUPIAH],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.label', 'ID'),
            'code' => Yii::t('app.label', 'Code'),
            'user_id' => Yii::t('app.label', 'User'),
            'partner_id' => Yii::t('app.label', 'Partner'),
            'description' => Yii::t('app.label', 'Description'),
            'offer_id' => Yii::t('app.label', 'Offer'),
            'offer_at' => Yii::t('app.label', 'Offer At'),
            'offer_expired_at' => Yii::t('app.label', 'Offer Expired At'),
            'status' => Yii::t('app.label', 'Status'),
            'status_updated_at' => Yii::t('app.label', 'Status Updated At'),
            'status_paid_at' => Yii::t('app.label', 'Status Paid At'),
            'status_expired_at' => Yii::t('app.label', 'Status Expired At'),
            'currency_id' => Yii::t('app.label', 'Currency'),
            'amount' => Yii::t('app.label', 'Amount'),
            'admin_fee' => Yii::t('app.label', 'Admin Fee'),
            'final_amount' => Yii::t('app.label', 'Final Amount'),
            'created_at' => Yii::t('app.label', 'Created At'),
            'created_by' => Yii::t('app.label', 'Created By'),
            'updated_at' => Yii::t('app.label', 'Updated At'),
            'updated_by' => Yii::t('app.label', 'Updated By'),
        ];
    }
    
    public function beforeSave($insert) 
    {
        if ($insert) {
            $this->code = self::generateCode();
            $this->status = self::STATUS_WAITING_PAYMENT;
            $this->status_updated_at = date('Y-m-d H:i:s');
        }
        
        parent::beforeSave($insert);
    }
    
    /**
     * event after status paid
     * 
     * @return boolean
     */
    public function afterStatusConfirmedByUser()
    {
        $this->status_updated_at = date('Y-m-d H:i:s');
        $this->update();
        
        // send email to admin that there an order has been confirmed
        
        return true;
    }
    
    /**
     * event after status paid
     * 
     * @return boolean
     */
    public function afterStatusPaid()
    {
        $this->status_paid_at = date('Y-m-d H:i:s');
        $this->status_updated_at = date('Y-m-d H:i:s');
        $this->update();
        
        // send email to user that there an order has been paid
        // if there a jobs is waiting payment or free, change this to PAID
        
        return true;
    }
    
    /**
     * event after status expired
     * 
     * @return boolean
     */
    public function afterStatusExpired()
    {
        $this->status_expired_at = date('Y-m-d H:i:s');
        $this->status_updated_at = date('Y-m-d H:i:s');
        $this->update();
        
        // send email to user that there an order has been expired
        // if there a jobs is PAID, change this to FREE
        
        return true;
    }
    

    /**
     * @return ActiveQuery
     */
    public function getOffer()
    {
        return $this->hasOne(Offer::className(), ['id' => 'offer_id']);
    }
    
    /**
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getOrderConfirmations()
    {
        return $this->hasMany(OrderConfirmation::className(), ['order_id' => 'id']);
    }
    
    /**
     * @return ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
    }
    
    /**
     * @return ActiveQuery
     */
    public function getPartner()
    {
        return $this->hasOne(Partner::className(), ['id' => 'partner_id']);
    }
    
    /**
     * @return boolean
     */
    public function getIsUser()
    {
        return ($this->user_id != null) && ($this->partner_id == null);
    }
    
    /**
     * @return boolean
     */
    public function getIsPartner()
    {
        return ($this->user_id == null) && ($this->partner_id != null);
    }
    
    /**
     * returns formatted amount
     * 
     * @param type $withCurrency
     * @return type
     */
    public function getFormattedAmount($withCurrency = true)
    {
        switch ($this->currency_id) {
            case Currency::RUPIAH : $amount = FormatConverter::rupiahFormat($this->amount, 2); break;
            case Currency::DOLLAR : $amount = FormatConverter::dollarFormat($this->amount, 2); break;
            default : $amount = $this->amount;
        }
        $currency = $withCurrency ? $this->currency->code .' ' : '';
        
        return $currency . $amount;
    }
    
    /**
     * returns formatted amount
     * 
     * @param type $withCurrency
     * @return type
     */
    public function getFormattedFinalAmount($withCurrency = true)
    {
        switch ($this->currency_id) {
            case Currency::RUPIAH : $amount = FormatConverter::rupiahFormat($this->final_amount, 2); break;
            case Currency::DOLLAR : $amount = FormatConverter::dollarFormat($this->final_amount, 2); break;
            default : $amount = $this->final_amount;
        }
        $currency = $withCurrency ? $this->currency->code .' ' : '';
        
        return $currency . $amount;
    }
    
    /**
     * returns formatted amount
     * 
     * @param type $withCurrency
     * @return type
     */
    public function getFormattedAdminFee($withCurrency = true)
    {
        switch ($this->currency_id) {
            case Currency::RUPIAH : $amount = FormatConverter::rupiahFormat($this->admin_fee, 2); break;
            case Currency::DOLLAR : $amount = FormatConverter::dollarFormat($this->admin_fee, 2); break;
        }
        $currency = $withCurrency ? $this->currency->code .' ' : '';
        
        return $currency . $amount;
    }
    
    public static function statusLabels()
	{
		return [
			self::STATUS_WAITING_PAYMENT => Yii::t('app.label', 'Waiting Payment'),
			self::STATUS_CONFIRMED_BY_USER => Yii::t('app.label', 'Confirmed By User'),
			self::STATUS_EXPIRED => Yii::t('app.label', 'Expired'),
			self::STATUS_PAID => Yii::t('app.label', 'Paid'),
		];
	}
    
    /**
     * @return boolean
     */
    public function getIsStatusPaid()
    {
        return $this->status == self::STATUS_PAID;
    }
	
	public function getStatusLabel()
	{
		$list = self::statusLabels();
		return $list[$this->status] ? $list[$this->status] : $this->status;
	}
	
	public function getStatusWithStyle()
	{
		switch ($this->status) {
			case self::STATUS_PAID :
				return Html::label($this->getStatusLabel(), null, ['class'=>'label label-success label-sm']);
			case self::STATUS_WAITING_PAYMENT :
				return Html::label($this->getStatusLabel(), null, ['class'=>'label label-warning label-sm']);
            case self::STATUS_CONFIRMED_BY_USER :
				return Html::label($this->getStatusLabel(), null, ['class'=>'label label-primary label-sm']);
			default :
				return Html::label($this->getStatusLabel(), null, ['class'=>'label label-default label-sm']);
		}
	}
    
    /**
	 * generate code with format `[prefix][Ymd]-[xxxxxx]` where:
	 * [prefix] INV
	 * [Y] is current year in php date format.
	 * [m] is current month in php date format.
	 * [d] is current day in php date format.
	 * [xxxxxx] is incremental number of order each day pad by certain length.
	 * 
	 * eg:
	 * - INV-20161201-0001
	 * - INV-20161201-0002
	 * - INV-20161202-0001
	 * - INV-20161202-0002
	 * - INV-20170101-0001
	 * 
	 * @param type $prefix INV
	 * @param type $padLength increment pad length
	 * @param type $separator
	 * @return string
	 */
	public static function generateCode($prefix = 'INV', $padLength = 4, $separator = '-')
	{
		$left = strtoupper($prefix) .$separator. date('ymd');
        $leftLen = strlen($left);
        $increment = 1;

        $last = self::find()
            ->select('code')
            ->where(['LIKE', 'code', $left])
            ->orderBy(['id' => SORT_DESC])
            ->limit(1)
            ->scalar();

        if ($last) {
            $increment = (int) substr($last, $leftLen, $padLength);
            $increment++;
        }

        $number = str_pad($increment, $padLength, '0', STR_PAD_LEFT);

        return $left . $separator . $number;
	}
}
