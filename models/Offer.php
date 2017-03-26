<?php

namespace app\models;

use app\helpers\FormatConverter;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "offer".
 *
 * @property integer $id
 * @property integer $offer_type_id
 * @property string $name
 * @property string $description
 * @property integer $day_limit
 * @property integer $currency_id
 * @property string $amount
 * @property string $admin_fee
 * @property integer $status
 * @property integer $order
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 *
 * @property OfferType $offerType
 * @property Order[] $orders
 * @property Currency $currency
 */
class Offer extends BaseActiveRecord
{
    const OFFER_PLATINUM = 4; // primary key
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'offer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['offer_type_id', 'name', 'description', 'day_limit', 'currency_id', 'amount', 'order'], 'required'],
            [['offer_type_id', 'day_limit', 'currency_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['day_limit'], 'integer', 'min' => 0],
            [['description'], 'string'],
            [['amount', 'admin_fee'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['offer_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => OfferType::className(), 'targetAttribute' => ['offer_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.label', 'ID'),
            'offer_type_id' => Yii::t('app.label', 'Offer Type ID'),
            'name' => Yii::t('app.label', 'Name'),
            'description' => Yii::t('app.label', 'Description'),
            'day_limit' => Yii::t('app.label', 'Day Limit'),
            'currency_id' => Yii::t('app.label', 'Currency ID'),
            'amount' => Yii::t('app.label', 'Amount'),
            'admin_fee' => Yii::t('app.label', 'Admin Fee'),
            'status' => Yii::t('app.label', 'Status'),
            'created_at' => Yii::t('app.label', 'Created At'),
            'created_by' => Yii::t('app.label', 'Created By'),
            'updated_at' => Yii::t('app.label', 'Updated At'),
            'updated_by' => Yii::t('app.label', 'Updated By'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getOfferType()
    {
        return $this->hasOne(OfferType::className(), ['id' => 'offer_type_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['offer_id' => 'id']);
    }
    
    /**
     * @return ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
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
    public function getFormattedAdminFee($withCurrency = true)
    {
        switch ($this->currency_id) {
            case Currency::RUPIAH : $amount = FormatConverter::rupiahFormat($this->admin_fee, 2); break;
            case Currency::DOLLAR : $amount = FormatConverter::dollarFormat($this->admin_fee, 2); break;
        }
        $currency = $withCurrency ? $this->currency->code .' ' : '';
        
        return $currency . $amount;
    }
    
    public function getOfferTypeWithNameWithAmount($separator = ' - ')
    {
        return $this->offerType->name . $separator . $this->name. $separator . $this->getFormattedAmount();
    }
}
