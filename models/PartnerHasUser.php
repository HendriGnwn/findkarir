<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "partner_has_user".
 *
 * @property string $id
 * @property string $partner_id
 * @property string $user_id
 * @property integer $partner_branch_id
 * @property integer $status
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 *
 * @property Partner $partner
 * @property User $user
 */
class PartnerHasUser extends \app\models\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partner_has_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['partner_id', 'user_id'], 'required'],
            [['partner_id', 'user_id', 'partner_branch_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at', 'partner_branch_id'], 'safe'],
            [['status'], 'default', 'value' => self::STATUS_ACTIVE],
            [['partner_id'], 'exist', 'skipOnError' => true, 'targetClass' => Partner::className(), 'targetAttribute' => ['partner_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['partner_branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => PartnerBranch::className(), 'targetAttribute' => ['partner_branch_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.label', 'ID'),
            'partner_id' => Yii::t('app.label', 'Partner ID'),
            'user_id' => Yii::t('app.label', 'User ID'),
            'partner_branch_id' => Yii::t('app.label', 'Partner Branch ID'),
            'status' => Yii::t('app.label', 'Status'),
            'created_at' => Yii::t('app.label', 'Created At'),
            'created_by' => Yii::t('app.label', 'Created By'),
            'updated_at' => Yii::t('app.label', 'Updated At'),
            'updated_by' => Yii::t('app.label', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartner()
    {
        return $this->hasOne(Partner::className(), ['id' => 'partner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartnerBranch()
    {
        return $this->hasOne(PartnerBranch::className(), ['id' => 'partner_branch_id']);
    }
}
