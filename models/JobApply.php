<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\helpers\Html;

/**
 * This is the model class for table "job_apply".
 *
 * @property string $id
 * @property string $job_id
 * @property string $user_id
 * @property string $description
 * @property string $review_by
 * @property integer $review_counter
 * @property integer $status
 * @property string $status_interview_at
 * @property string $status_updated_at
 * @property string $interview_at
 * @property string $venue
 * @property string $contact_person
 * @property string $contact_person_phone
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 *
 * @property Job $job
 * @property User $user
 */
class JobApply extends BaseActiveRecord
{
	const STATUS_INTERVIEW = 2;
    
    const EVENT_AFTER_SAVE_STATUS_TO_INTERVIEW = 'afterSaveStatusToInterview';
    
    public function init() 
    {
        parent::init();
        
        $this->on(self::EVENT_AFTER_SAVE_STATUS_TO_INTERVIEW, [$this, 'afterSaveStatusToInterview']);
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job_apply';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['job_id', 'user_id', 'description'], 'required'],
            [['job_id', 'user_id', 'review_by', 'review_counter', 'status', 'created_by', 'updated_by'], 'integer'],
            [['status_interview_at', 'status_updated_at', 'interview_at', 'created_at', 'updated_at'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['venue'], 'string', 'max' => 300],
            [['contact_person'], 'string', 'max' => 50],
            [['contact_person_phone'], 'string', 'max' => 15],
            [['job_id'], 'exist', 'skipOnError' => true, 'targetClass' => Job::className(), 'targetAttribute' => ['job_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.label', 'ID'),
            'job_id' => Yii::t('app.label', 'Job ID'),
            'user_id' => Yii::t('app.label', 'User ID'),
            'description' => Yii::t('app.label', 'Description'),
            'review_by' => Yii::t('app.label', 'Review By'),
            'review_counter' => Yii::t('app.label', 'Review Counter'),
            'status' => Yii::t('app.label', 'Status'),
            'status_interview_at' => Yii::t('app.label', 'Status Interview At'),
            'status_updated_at' => Yii::t('app.label', 'Status Updated At'),
            'interview_at' => Yii::t('app.label', 'Interview At'),
            'venue' => Yii::t('app.label', 'Venue'),
            'contact_person' => Yii::t('app.label', 'Contact Person'),
            'contact_person_phone' => Yii::t('app.label', 'Contact Person Phone'),
            'created_at' => Yii::t('app.label', 'Created At'),
            'created_by' => Yii::t('app.label', 'Created By'),
            'updated_at' => Yii::t('app.label', 'Updated At'),
            'updated_by' => Yii::t('app.label', 'Updated By'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getJob()
    {
        return $this->hasOne(Job::className(), ['id' => 'job_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    public static function statusLabels()
	{
		return [
			self::STATUS_ACTIVE => Yii::t('app.label', 'Active'),
			self::STATUS_INTERVIEW => Yii::t('app.label', 'Interview'),
		];
	}
    
    /**
     * @return boolean
     */
    public function saveStatusToInterview()
    {
        $this->status = self::STATUS_INTERVIEW;
        $this->status_interview_at = date('Y-m-d H:i:s');
        $this->status_updated_at = $this->status_interview_at;
        
        $save = $this->update();
        
        $this->trigger(self::EVENT_AFTER_SAVE_STATUS_TO_INTERVIEW);
        
        return $save;
    }
    
    /**
     * - send to applicant email
     * 
     * @return boolean
     */
    public function afterSaveStatusToInterview()
    {
        
        return true;
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
}
