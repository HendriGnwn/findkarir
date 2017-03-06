<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * This is the model class for table "partner".
 *
 * @property string $id
 * @property string $code
 * @property string $name
 * @property integer $legal
 * @property string $photo
 * @property string $phone
 * @property string $address
 * @property integer $city_id
 * @property integer $province_id
 * @property string $description
 * @property string $public_email
 * @property integer $status
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 *
 * @property PartnerBranch[] $partnerBranches
 * @property PartnerHasUser[] $partnerHasUsers
 */
class Partner extends BaseActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $photoFile;
    
    public function init()
    {
        parent::init();
        
        $this->on(self::EVENT_BEFORE_INSERT, [$this, 'beforeInsert']);
        
        $this->path = 'web/uploads/partner/';
        if (!is_dir(Yii::getAlias('@app/' . $this->path))) {
            mkdir(Yii::getAlias('@app/' . $this->path));
        }

        return true;
    }
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'address', 'city_id', 'description'], 'required'],
            [['legal', 'city_id', 'province_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['description'], 'string'],
            [['code', 'legal', 'photo', 'created_at', 'updated_at'], 'safe'],
            [['code', 'address'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 200],
            [['photo', 'public_email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 15],
            [['code'], 'unique'],
            [['status'], 'default', 'value' => self::STATUS_ACTIVE],
            [['photoFile'], 'file', 'skipOnEmpty' => true, 'checkExtensionByMimeType' => false,
                'extensions' => ['jpg', 'jpeg', 'png'],
                'maxSize' => 1024 * 1024 * 1],
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
            'legal' => Yii::t('app.label', 'Legal'),
            'photo' => Yii::t('app.label', 'Photo'),
            'photoFile' => Yii::t('app.label', 'Photo - Logo'),
            'phone' => Yii::t('app.label', 'Phone'),
            'address' => Yii::t('app.label', 'Address'),
            'city_id' => Yii::t('app.label', 'City ID'),
            'province_id' => Yii::t('app.label', 'Province ID'),
            'description' => Yii::t('app.label', 'Description'),
            'public_email' => Yii::t('app.label', 'Public Email'),
            'status' => Yii::t('app.label', 'Status'),
            'created_at' => Yii::t('app.label', 'Created At'),
            'created_by' => Yii::t('app.label', 'Created By'),
            'updated_at' => Yii::t('app.label', 'Updated At'),
            'updated_by' => Yii::t('app.label', 'Updated By'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getPartnerBranches()
    {
        return $this->hasMany(PartnerBranch::className(), ['partner_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getPartnerHasUsers()
    {
        return $this->hasMany(PartnerHasUser::className(), ['partner_id' => 'id']);
    }
    
    /**
     * @param type $insert
     * @return type
     */
    public function beforeSave($insert) 
    {
        if ($this->city_id) {
            $city = City::findOne($this->city_id);
            $this->province_id = $city->province_id;
        }
        
        $this->processUploadFile();
        
        return parent::beforeSave($insert);
    }
    
    /**
     * @return boolean
     */
    public function beforeInsert()
    {
        $this->code = self::generateCode();
        
        return true;
    }
    
    /**
     * @return ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }
    
    /**
     * @return ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Province::className(), ['id' => 'province_id']);
    }
    
    /**
	 * generate code with format `[prefix][Ym]-[xxxxxx]` where:
	 * [prefix] PARTNER
	 * [Y] is current year in php date format.
	 * [m] is current month in php date format.
	 * [xxxxxx] is incremental number of order each day pad by certain length.
	 * 
	 * eg:
	 * - GEN201612-000001
	 * - GEN201612-000002
	 * - MEM201612-000001
	 * - MEM201612-000002
	 * - MEM201701-000001
	 * 
	 * @param type $prefix
	 * @param type $padLength increment pad length
	 * @param type $separator
	 * @return string
	 */
	public static function generateCode($prefix = 'PTR', $padLength = 6, $separator = '-')
	{
		$left = strtoupper($prefix) . date('Ym');
        $leftLen = strlen($left);
        $increment = 1;

        $last = self::find()
            ->select('code')
            ->where(['LIKE', 'code', $left])
            ->orderBy(['id' => SORT_DESC])
            ->limit(1)
            ->scalar();

        if ($last) {
            $increment = (int) substr($last, $leftLen, $padLength);
            $increment++;
        }

        $number = str_pad($increment, $padLength, '0', STR_PAD_LEFT);

        return $left . $separator . $number;
	}
    
    /**
     * - delete photoFile
     * 
     * @return type
     */
    public function beforeDelete()
    {
        /* todo: delete the corresponding file in storage */
        $this->deleteFile();
        
        return parent::beforeDelete();
    }
    
    protected function deleteFile()
    {
        @unlink(Yii::getAlias('@app/' . $this->path) . $this->photo);
    }
        
    /**
     * process uploaded file
     * 
     * @return boolean
     */
    public function processUploadFile()
    {
        if (!empty($this->photoFile)) {
            $this->deleteFile();

            $path = str_replace('web/', '', $this->path);
            
            // generate filename
            $filename = Inflector::slug($this->name . '-' . Yii::$app->security->generateRandomString(20));
            $filename = $filename . '.' . $this->photoFile->extension;
            
            $this->photoFile->saveAs($path . $filename);
            $this->photo = $filename;
        }

        return true;
    }
    
    /**
     * get url file
     * 
     * @return type
     */
    public function getPhotoUrl() 
    {
        if (empty($this->photo)) {
            return null;
        }

        $path = $this->path . $this->photo;

        if (!file_exists(Yii::getAlias('@app/' . $path))) {
            return null;
        }

        return Url::to('@' . $path, true);
    }

    public function getPhotoUrlHtml($name = null, $options = ['target' => '_blank']) 
    {
        $name = $name ? $name : $this->name;

        if (!$this->getPhotoUrl()) {
            return $name;
        }

        return Html::a($name, $this->getPhotoUrl(), $options);
    }
}
