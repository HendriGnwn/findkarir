<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property string $id
 * @property string $code
 * @property string $user_id
 * @property string $description
 * @property integer $offer_id
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
class Order extends \app\models\BaseActiveRecord
{
    const STATUS_WAITING_PAYMENT = 0;
    const STATUS_CONFIRMED_BY_USER = 1;
    const STATUS_EXPIRED = 5;
    const STATUS_PAID = 10;
    
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
            [['user_id', 'description', 'offer_id', 'currency_id', 'amount', 'admin_fee', 'final_amount'], 'required'],
            [['user_id', 'offer_id', 'status', 'currency_id', 'created_by', 'updated_by'], 'integer'],
            [['description'], 'string'],
            [['code', 'offer_expired_at', 'status_updated_at', 'status_paid_at', 'status_expired_at', 'created_at', 'updated_at'], 'safe'],
            [['amount', 'admin_fee', 'final_amount'], 'number'],
            [['code'], 'string', 'max' => 100],
            [['offer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Offer::className(), 'targetAttribute' => ['offer_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['status'], 'default', 'value' => self::STATUS_WAITING_PAYMENT],
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
            'user_id' => Yii::t('app.label', 'User ID'),
            'description' => Yii::t('app.label', 'Description'),
            'offer_id' => Yii::t('app.label', 'Offer ID'),
            'offer_expired_at' => Yii::t('app.label', 'Offer Expired At'),
            'status' => Yii::t('app.label', 'Status'),
            'status_updated_at' => Yii::t('app.label', 'Status Updated At'),
            'status_paid_at' => Yii::t('app.label', 'Status Paid At'),
            'status_expired_at' => Yii::t('app.label', 'Status Expired At'),
            'currency_id' => Yii::t('app.label', 'Currency ID'),
            'amount' => Yii::t('app.label', 'Amount'),
            'admin_fee' => Yii::t('app.label', 'Admin Fee'),
            'final_amount' => Yii::t('app.label', 'Final Amount'),
            'created_at' => Yii::t('app.label', 'Created At'),
            'created_by' => Yii::t('app.label', 'Created By'),
            'updated_at' => Yii::t('app.label', 'Updated At'),
            'updated_by' => Yii::t('app.label', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffer()
    {
        return $this->hasOne(Offer::className(), ['id' => 'offer_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderConfirmations()
    {
        return $this->hasMany(OrderConfirmation::className(), ['order_id' => 'id']);
    }
}
