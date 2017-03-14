<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "education".
 *
 * @property string $id
 * @property string $user_id
 * @property string $category
 * @property string $name
 * @property string $department
 * @property string $started_at
 * @property string $graduated_at
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 */
class Education extends \app\models\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'education';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'category', 'name', 'started_at'], 'required'],
            [['user_id', 'created_by', 'updated_by'], 'integer'],
            [['category', 'user_id'], 'unique', 'targetAttribute' => ['category','user_id']],
            [['department', 'started_at', 'graduated_at', 'created_at', 'updated_at'], 'safe'],
            [['category'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 100],
            [['department'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.label', 'ID'),
            'user_id' => Yii::t('app.label', 'User ID'),
            'category' => Yii::t('app.label', 'Category'),
            'name' => Yii::t('app.label', 'Name'),
            'department' => Yii::t('app.label', 'Department'),
            'started_at' => Yii::t('app.label', 'Year Started At'),
            'graduated_at' => Yii::t('app.label', 'Year Graduated At'),
            'created_at' => Yii::t('app.label', 'Created At'),
            'created_by' => Yii::t('app.label', 'Created By'),
            'updated_at' => Yii::t('app.label', 'Updated At'),
            'updated_by' => Yii::t('app.label', 'Updated By'),
        ];
    }
    
    /**
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    /**
     * @return string
     */
    public function getCategoryLabel()
    {
        $lists = Config::getEducationCategories();
        
        return isset($lists[$this->category]) ? $lists[$this->category] : $this->category;
    }
}
