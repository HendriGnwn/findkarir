<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "passion".
 *
 * @property string $id
 * @property string $job_type_id
 * @property string $user_id
 * @property string $created_at
 *
 * @property JobType $jobType
 */
class Passion extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value' => date('Y-m-d H:i:s'),
            ],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'passion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['job_type_id', 'user_id'], 'required'],
            [['job_type_id', 'user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['job_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => JobType::className(), 'targetAttribute' => ['job_type_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['job_type_id', 'user_id'], 'unique', 'targetAttribute' => ['job_type_id','user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.label', 'ID'),
            'job_type_id' => Yii::t('app.label', 'Passion'),
            'user_id' => Yii::t('app.label', 'User'),
            'created_at' => Yii::t('app.label', 'Created At'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getJobType()
    {
        return $this->hasOne(JobType::className(), ['id' => 'job_type_id']);
    }
    
    /**
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
