<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "offer_type".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Offer[] $offers
 */
class OfferType extends \app\models\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public function behaviors() 
    {
        return [];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'offer_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffers()
    {
        return $this->hasMany(Offer::className(), ['offer_type_id' => 'id']);
    }
}
