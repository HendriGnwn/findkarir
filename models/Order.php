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
 * @property integer $company_limit
 * @property integer $offer_limit
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
 * @property OrderConfirmation $orderConfirmation
 * @property Partner $partner
 */
class Order extends BaseActiveRecord
{
    const STATUS_WAITING_PAYMENT = 0;
    const STATUS_CONFIRMED_BY_USER = 1;
    const STATUS_EXPIRED = 5;
    const STATUS_PAID = 10;
    const STATUS_FREE_FOR_PARTNER = 15;
    const STATUS_BLOCKED = 99;
    
    const EVENT_AFTER_STATUS_PAID = 'afterStatusPaid';
    const EVENT_AFTER_STATUS_EXPIRED = 'afterStatusExpired';
    const EVENT_AFTER_STATUS_CONFIRMED_BY_USER = 'afterStatusConfirmedByUser';
    
    const SCENARIO_PARTNER = 'partner';
    const SCENARIO_USER = 'user';
    const SCENARIO_UPDATE_STATUS = 'updateStatus';
    
    public function init() 
    {
        parent::init();
        
        $this->on(self::EVENT_AFTER_STATUS_PAID, [$this, 'afterStatusPaid']);
        $this->on(self::EVENT_AFTER_STATUS_EXPIRED, [$this, 'afterStatusExpired']);
        $this->on(self::EVENT_AFTER_STATUS_CONFIRMED_BY_USER, [$this, 'afterStatusConfirmedByUser']);
        $this->on(self::EVENT_AFTER_INSERT, [$this, 'afterInsert']);
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
            [['description', 'offer_id', 'amount', 'admin_fee', 'final_amount'], 'required'],
            [['user_id'], 'required', 'on' => self::SCENARIO_USER],
            [['partner_id'], 'required', 'on' => self::SCENARIO_PARTNER],
            [['user_id', 'offer_id', 'status', 'currency_id', 'created_by', 'updated_by', 'partner_id', 'offer_limit', 'company_limit'], 'integer'],
            [['description'], 'string'],
            [['partner_id', 'currency_id', 'partner_id', 'code', 'offer_at', 'offer_expired_at', 'status_updated_at', 'status_paid_at', 'status_expired_at', 'created_at', 'updated_at'], 'safe'],
            [['amount', 'admin_fee', 'final_amount'], 'number'],
            [['code'], 'string', 'max' => 100],
            [['code'], 'unique'],
            [['offer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Offer::className(), 'targetAttribute' => ['offer_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['status'], 'default', 'value' => self::STATUS_WAITING_PAYMENT],
            [['offer_limit', 'user_id', 'partner_id'], 'default', 'value' => null],
            [['currency_id'], 'default', 'value' => Currency::RUPIAH],
            [['user_id'], 'validateUser', 'on' => self::SCENARIO_USER],
            [['partner_id'], 'validatePartner', 'on' => self::SCENARIO_PARTNER],
            [['status'], 'validateUpdateStatus', 'on' => self::SCENARIO_UPDATE_STATUS],
        ];
    }
    
    /**
     * @param type $attribute
     * @param type $params
     * @return boolean
     */
    public function validateUser($attribute, $params)
    {
        $activedOrder = self::find()
                ->andWhere([
                    'user_id' => $this->$attribute,
                    'status' => self::STATUS_PAID,
                ])
                ->andWhere(['>=', 'offer_expired_at', date('Y-m-d')])
                ->one();
        if ($activedOrder) {
            $this->addError($attribute, Yii::t('app.message', 'This User cannot be create order again, because already order still actived.'));
            return false;
        }
        
        return true;
    }
        
    /**
     * @param type $attribute
     * @param type $params
     * @return boolean
     */
    public function validatePartner($attribute, $params)
    {
        $activedOrder = self::find()
                ->andWhere([
                    'partner_id' => $this->$attribute,
                    'status' => self::STATUS_FREE_FOR_PARTNER,
                ])
                ->andWhere(['>=', 'offer_expired_at', date('Y-m-d')])
                ->one();
        if ($activedOrder) {
            $this->addError($attribute, Yii::t('app.message', 'This Partner cannot be create order again, because already order still actived.'));
            return false;
        }
        
        return true;
    }
    
    /**
     * @param type $attribute
     * @param type $params
     * @return boolean
     */
    public function validateUpdateStatus($attribute, $params)
    {
        if (
            $this->getIsStatusPaid() ||
            $this->getIsStatusWaitingPayment() ||
            $this->getIsStatusConfirmed()
        ) {
            $this->addError('status', Yii::t('app.message', 'Order status cannot change to '. $this->getStatusLabel()));
            return false;
        }
        
        return true;
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
            'offer_limit' => Yii::t('app.label', 'Offer Limit'),
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
            $this->offer_at = date('Y-m-d H:i:s');
            
            if ($this->partner_id != null) {
                $this->status = self::STATUS_FREE_FOR_PARTNER;
            }
        }
        
        return parent::beforeSave($insert);
    }
    
    /**
     * @return boolean
     */
    public function afterInsert()
    {
        $orderConfirmation = new OrderConfirmation();
        $orderConfirmation->link('order', $this);
        
        return true;
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
        $this->save();
        
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
    public function getOrderConfirmation()
    {
        return $this->hasOne(OrderConfirmation::className(), ['order_id' => 'id']);
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
			self::STATUS_FREE_FOR_PARTNER => Yii::t('app.label', 'Free for Partner'),
			self::STATUS_BLOCKED => Yii::t('app.label', 'Blocked'),
		];
	}
    
    /**
     * @return boolean
     */
    public function getIsStatusPaid()
    {
        return $this->status == self::STATUS_PAID;
    }
    
    /**
     * @return boolean
     */
    public function getIsStatusExpired()
    {
        return ($this->status == self::STATUS_EXPIRED);
    }
    
    /**
     * @return boolean
     */
    public function getIsStatusConfirmed()
    {
        return ($this->status == self::STATUS_CONFIRMED_BY_USER);
    }
    
    /**
     * @return boolean
     */
    public function getIsStatusWaitingPayment()
    {
        return ($this->status == self::STATUS_WAITING_PAYMENT);
    }
	
	public function getStatusLabel()
	{
		$list = self::statusLabels();
		return $list[$this->status] ? $list[$this->status] : $this->status;
	}
	
	public function getStatusWithStyle()
	{
		switch ($this->status) {
            case self::STATUS_FREE_FOR_PARTNER :
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
	public static function generateCode($prefix = 'INV', $padLength = 6, $separator = '-')
	{
		$left = strtoupper($prefix) . $separator . date('ymd') . $separator;
        $leftLen = strlen($left);
        $increment = rand(1000, 5000);

        $last = self::find()
            ->select('code')
            ->where(['LIKE', 'code', $left])
            ->orderBy(['id' => SORT_DESC])
            ->limit(1)
            ->scalar();

        if ($last) {
            $increment = (int) substr($last, $leftLen, $padLength);
            $increment += rand(1, 3);
        }

        $number = str_pad($increment, $padLength, '0', STR_PAD_LEFT);

        return $left . $number;
	}
    
    /**
     * this function is running on cron job
     * - change order status to expired when offer_expired_at has been expired.
     * 
     * @return boolean
     */
    public static function consoleChangeOrderStatusToExpired()
    {
        $models = self::find()
                ->andWhere(['<=', 'offer_expired_at', date('Y-m-d')])
                ->andWhere(['!=', 'status', self::STATUS_EXPIRED])
                ->all();
        
        foreach ($models as $model) {
            Yii::info('change Order status to expired . ' . json_encode($model->attributes), 'order');
            $model->status = self::STATUS_EXPIRED;
            $model->save();
            $model->trigger(self::EVENT_AFTER_STATUS_EXPIRED);
        }
        
        Yii::info('change Order status to expired has been successful.', 'order');
        
        return true;
    }
}
