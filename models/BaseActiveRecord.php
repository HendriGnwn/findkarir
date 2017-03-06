<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use app\helpers\FormatConverter;
use app\models\queries\BaseActiveRecordQuery;
use app\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Html;

/**
 * Description of BaseActiveRecord
 *
 * @author Hendri
 */
abstract class BaseActiveRecord extends ActiveRecord
{
	const SCENARIO_INSERT = 'insert';
    const SCENARIO_UPDATE = 'update';
	
	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 0;
	
	const OTHER_VALUE = 0;
	
	public $start_date;
	public $end_date;
	
	public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => date('Y-m-d H:i:s'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    public function getCreatedBy() {
        return $this->hasOne(User::className(), ['id'=>'created_by']);
    }

    public function getUpdatedBy() {
        return $this->hasOne(User::className(), ['id'=>'updated_by']);
    }
	
	public function getCombineCreated($separator = ' - ')
	{
		$user = $this->createdBy->getName();
		$datetime = FormatConverter::dateFormat($this->created_at, 'd M Y H:i:s');
		
		return $user . $separator . $datetime;
	}
	
	public function getCombineUpdated($separator = ' - ')
	{
		$user = $this->updatedBy->getName();
		$datetime = $this->updated_at ? FormatConverter::dateFormat($this->updated_at, 'd M Y H:i:s') : '-';
		
		return $user . $separator . $datetime;
	}
	
	public static function statusLabels()
	{
		return [
			self::STATUS_ACTIVE => Yii::t('app', 'Active'),
			self::STATUS_INACTIVE => Yii::t('app', 'Inactive'),
		];
	}
	
	public function getStatusLabel()
	{
		$list = self::statusLabels();
		return $list[$this->status] ? $list[$this->status] : $this->status;
	}
	
	public function getStatusWithStyle()
	{
		switch ($this->status) {
			case self::STATUS_ACTIVE :
				return Html::label($this->getStatusLabel(), null, ['class'=>'label label-success label-sm']);
			case self::STATUS_INACTIVE :
				return Html::label($this->getStatusLabel(), null, ['class'=>'label label-danger label-sm']);
			default :
				return Html::label($this->getStatusLabel(), null, ['class'=>'label label-default label-sm']);
		}
	}
	
	/**
     * @inheritdoc
     * @return BaseActiveRecordQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BaseActiveRecordQuery(get_called_class());
    }
}
