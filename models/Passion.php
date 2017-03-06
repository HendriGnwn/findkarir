<?php

namespace app\models;

use Yii;

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
class Passion extends \app\models\BaseActiveRecord
{
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
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.label', 'ID'),
            'job_type_id' => Yii::t('app.label', 'Job Type ID'),
            'user_id' => Yii::t('app.label', 'User ID'),
            'created_at' => Yii::t('app.label', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobType()
    {
        return $this->hasOne(JobType::className(), ['id' => 'job_type_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
