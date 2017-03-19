<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * This is the model class for table "company".
 *
 * @property string $id
 * @property string $user_id
 * @property string $partner_id
 * @property string $code
 * @property string $name
 * @property string $address
 * @property integer $city_id
 * @property integer $province_id
 * @property string $latitude
 * @property string $longitude
 * @property string $phone
 * @property string $sector_area
 * @property string $employee_quantity
 * @property string $website
 * @property string $photo
 * @property string $description
 * @property integer $status
 * @property string $created_at
 * @property string $created_by
 * @property integer $updated_at
 * @property string $updated_by
 *
 * @property User $user
 * @property Job[] $jobs
 */
class Company extends BaseActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $photoFile;
    
    public function init()
    {
        parent::init();
        
        $this->on(self::EVENT_BEFORE_INSERT, [$this, 'beforeInsert']);
        
        $this->path = 'web/uploads/company/';
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
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'user_id'], 'required', 'on' => self::SCENARIO_REGISTER],
            [['name', 'address', 'city_id', 'latitude', 'longitude', 'phone', 'sector_area', 'employee_quantity', 'website', 'description'], 'required'],
            [['user_id', 'partner_id', 'city_id', 'province_id', 'status', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['description'], 'string'],
            [['photo', 'code', 'created_at', 'province_id'], 'safe'],
            [['code', 'website', 'photo'], 'string', 'max' => 100],
            [['name'], 'string', 'max' => 200],
            [['address'], 'string', 'max' => 500],
            [['latitude', 'longitude', 'employee_quantity'], 'string', 'max' => 20],
            [['phone'], 'string', 'max' => 15],
            [['sector_area'], 'string', 'max' => 50],
            [['website'], 'url'],
            [['code'], 'unique'],
            [['user_id', 'partner_id'], 'default', 'value' => null],
            [['status'], 'default', 'value' => self::STATUS_INACTIVE],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'user_id' => Yii::t('app.label', 'User ID'),
            'partner_id' => Yii::t('app.label', 'Partner ID'),
            'code' => Yii::t('app.label', 'Code'),
            'name' => Yii::t('app.label', 'Name'),
            'address' => Yii::t('app.label', 'Address'),
            'city_id' => Yii::t('app.label', 'City ID'),
            'province_id' => Yii::t('app.label', 'Province ID'),
            'latitude' => Yii::t('app.label', 'Latitude'),
            'longitude' => Yii::t('app.label', 'Longitude'),
            'phone' => Yii::t('app.label', 'Phone'),
            'sector_area' => Yii::t('app.label', 'Sector Area'),
            'employee_quantity' => Yii::t('app.label', 'Employee Quantity'),
            'website' => Yii::t('app.label', 'Website'),
            'photo' => Yii::t('app.label', 'Photo - Logo'),
            'description' => Yii::t('app.label', 'Description'),
            'status' => Yii::t('app.label', 'Status'),
            'created_at' => Yii::t('app.label', 'Created At'),
            'created_by' => Yii::t('app.label', 'Created By'),
            'updated_at' => Yii::t('app.label', 'Updated At'),
            'updated_by' => Yii::t('app.label', 'Updated By'),
        ];
    }
    
    /**
     * @return boolean
     */
    public function beforeInsert()
    {
        if ($this->getIsPartner()) {
            $this->code = self::generateCode('PART');
        } else if ($this->getIsUser()){
            $this->code = self::generateCode();
        }
        
        return true;
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
        
        if (
            $this->name != null &&
            $this->address != null &&
            $this->city_id != null &&
            $this->phone != null &&
            $this->description != null &&
            $this->photo != null
        ) {
            $this->status = self::STATUS_ACTIVE;
        } else {
            $this->status = self::STATUS_INACTIVE;
        }
        
        return parent::beforeSave($insert);
    }

    /**
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getJobs()
    {
        return $this->hasMany(Job::className(), ['company_id' => 'id']);
    }
    
    /**
     * @return ActiveQuery
     */
    public function getPartner()
    {
        return $this->hasOne(Partner::className(), ['id' => 'partner_id']);
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
	 * generate code with format `[Type][Ym]-[xxxxxx]` where:
	 * [Type] User ID or Partner ID
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
	 * @param type $type GEN | MEM | null
	 * @param type $padLength increment pad length
	 * @param type $separator
	 * @return string
	 */
	public static function generateCode($type = 'GEN', $padLength = 6, $separator = '-')
	{
		$left = strtoupper($type) . date('Ym');
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
     * @return boolean
     */
    public function getIsUser()
    {
        return ($this->user_id != null) && ($this->partner_id == null);
    }
    
    /**
     * @return boolean
     */
    public function getIsPartner()
    {
        return ($this->user_id == null) && ($this->partner_id != null);
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
    
    public function getPhotoImg($options = ['class' => 'img-responsive'])
    {
        if (!$this->getPhotoUrl()) {
            return null;
        }
        
        return Html::img($this->getPhotoUrl(), $options);
    }
    
    /**
     * @param type $id
     * @return type
     */
    public static function isOwnPartner($id)
    {
        $query = self::findOne($id);
        
        return $query->getIsPartner();
    }
}