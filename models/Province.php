<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "province".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property integer $order
 *
 * @property City[] $cities
 * @property Company[] $companies
 */
class Province extends BaseActiveRecord
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
        return 'province';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'order'], 'required'],
            [['status', 'order'], 'integer'],
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
            'status' => Yii::t('app.label', 'Status'),
            'order' => Yii::t('app.label', 'Order'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::className(), ['province_id' => 'id']);
    }
}
