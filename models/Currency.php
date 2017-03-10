<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $symbol
 * @property string $rate
 * @property integer $order
 *
 * @property Profile[] $profiles
 */
class Currency extends BaseActiveRecord
{
    const RUPIAH = 1;
    const DOLLAR = 2;
    
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
        return 'currency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name', 'symbol', 'rate', 'order'], 'required'],
            [['rate'], 'number'],
            [['order'], 'integer'],
            [['code', 'symbol'], 'string', 'max' => 10],
            [['name'], 'string', 'max' => 50],
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
            'name' => Yii::t('app.label', 'Name'),
            'symbol' => Yii::t('app.label', 'Symbol'),
            'rate' => Yii::t('app.label', 'Rate'),
            'order' => Yii::t('app.label', 'Order'),
        ];
    }
    
    /**
     * Convert currency to IDR
     * @param float $value value
     * @param int $currencyId id of currency
     * @param boolean $roundThousand kalau true pakai pembulatan 3 angka
     * @return float
     */
    public static function convertToRupiah($value, $currencyId, $roundThousand = true) 
    {
        if ($currencyId != self::RUPIAH) {
            $currency = Currency::findOne($currencyId);
            $rate = $currency->rate;
            $value = ($roundThousand) ? Number::roundThousand($value * $rate) : ($value * $rate);
        }

        return $value;
    }

    /**
     * Convert currency to dollar
     *
     * @param float $value value
     * @param int $currencyId id of currency
     * @return float
     */
    public static function convertToDollar($value, $currencyId) 
    {
        if ($currencyId != self::DOLLAR) {
            $currency = Currency::findOne($currencyId);
            $rate = $currency->rate;
            $value = $value * $rate;
        }

        return $value;
    }

    public function getCodeSymbol() 
    {
        return $this->code . ' (' . $this->symbol . ')';
    }

}
