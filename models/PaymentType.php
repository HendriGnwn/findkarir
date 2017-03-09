<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payment_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $class
 * @property integer $status
 * @property string $order
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 *
 * @property Payment[] $payments
 */
class PaymentType extends \app\models\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'order'], 'required'],
            [['status', 'order', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'class'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.label', 'ID'),
            'name' => Yii::t('app.label', 'Name'),
            'class' => Yii::t('app.label', 'Class'),
            'status' => Yii::t('app.label', 'Status'),
            'order' => Yii::t('app.label', 'Order'),
            'created_at' => Yii::t('app.label', 'Created At'),
            'created_by' => Yii::t('app.label', 'Created By'),
            'updated_at' => Yii::t('app.label', 'Updated At'),
            'updated_by' => Yii::t('app.label', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['payment_type_id' => 'id']);
    }
}
