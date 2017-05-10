<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "visitor".
 *
 * @property integer $id
 * @property string $quantity
 * @property string $date
 * @property integer $is_real
 */
class Visitor extends BaseActiveRecord
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
        return 'visitor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quantity', 'date'], 'required'],
            [['quantity', 'is_real'], 'integer'],
            [['date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.label', 'ID'),
            'quantity' => Yii::t('app.label', 'Quantity'),
            'date' => Yii::t('app.label', 'Date'),
            'is_real' => Yii::t('app.label', 'Is Real'),
        ];
    }
	
	/**
	 * return boolean
	 * 
	 * @return type
	 */
	public function getIsReal()
	{
		return $this->is_real == true;
	}
}
