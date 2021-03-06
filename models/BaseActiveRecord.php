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
 * @property string $path
 * 
 * @author Hendri
 */
abstract class BaseActiveRecord extends ActiveRecord
{
	const SCENARIO_INSERT = 'insert';
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_REGISTER = 'register';
    
    const EVENT_BEFORE_SOFT_DELETE = 'beforeSoftDelete';
    const EVENT_AFTER_SOFT_DELETE = 'afterSoftDelete';
	
	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 0;
    
    const STATUS_SOFT_DELETE = 99;
	
	const OTHER_VALUE = 0;
	
	public $start_date;
	public $end_date;
    
    private $_path;

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
    
    /**
     * soft delete
     * 
     * @return boolean
     */
    public function softDelete()
    {
        $this->trigger(self::EVENT_BEFORE_SOFT_DELETE);
        $soft = $this->updateAttributes(['status' => self::STATUS_SOFT_DELETE]);
        $this->trigger(self::EVENT_AFTER_SOFT_DELETE);
        
        return $soft;
    }
	
	public static function statusLabels()
	{
		return [
			self::STATUS_ACTIVE => Yii::t('app.label', 'Active'),
			self::STATUS_INACTIVE => Yii::t('app.label', 'Inactive'),
		];
	}
    
    /**
     * @return boolean
     */
    public function getIsStatusActive()
    {
        return $this->status == self::STATUS_ACTIVE;
    }
	
	public function getStatusLabel()
	{
		$list = self::statusLabels();
		return isset($list[$this->status]) ? $list[$this->status] : $this->status;
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
//        $model = new static();
//        
//        if ($model->hasAttribute('status')) {
//            return (new BaseActiveRecordQuery(get_called_class()))->where(['!=', 'status', self::STATUS_SOFT_DELETE]);
//        }
        return new BaseActiveRecordQuery(get_called_class());
    }
    
    /**
     * @return boolean
     */
    public function delete() 
    {
        $model = new static();
        
        if ($model->hasAttribute('status')) {
            $this->softDelete();
            return true;
        }
        return parent::delete();
    }
    
    /**
     * set path
     * 
     * @param type $value
     */
    public function setPath($value)
    {
        $this->_path = $value;
    }
    
    /**
     * @return string
     */
    public function getPath()
    {
        return $this->_path;
    }
}
