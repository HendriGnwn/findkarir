<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use dektrium\user\models\Profile as BaseProfile;
use Yii;
use yii\helpers\ArrayHelper;
use app\helpers\FormatConverter;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * Description of Profile
 * 
 * @property string $photo
 * @property string $phone
 * @property integer $gender {1:Male;2:Female}
 * @property string $hobby
 * @property integer $married_status {1:single,2:married}
 * @property integer $currency_id
 * @property integer $salary
 * @property string $cv
 * @property string $cv_updated_at
 * @property string $status
 * 
 * @property Profile $profile
 * 
 * @author Hendri
 */
class Profile extends BaseProfile
{
	const IS_COMPLETE_TRUE = 1;
	const IS_COMPLETE_FALSE = 0;
    
    const SCENARIO_UPDATE_APPLICANT = 'updateApplicant';
    
    /**
     * @var UploadedFile
     */
    public $photoFile;
    
    public $cvFile;
    
    private $_path;
	
	public function init() 
	{
		parent::init();
        
        $this->path = 'web/uploads/profile/';
        if (!is_dir(Yii::getAlias('@app/' . $this->path))) {
            mkdir(Yii::getAlias('@app/' . $this->path));
        }
	}
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['photoFile'], 'file', 'skipOnEmpty' => true, 'checkExtensionByMimeType' => false,
                'extensions' => ['jpg', 'jpeg', 'png'],
                'maxSize' => 1024 * 1024 * 1],
            [['cvFile'], 'file', 'skipOnEmpty' => true, 'checkExtensionByMimeType' => false,
                'extensions' => ['doc', 'pdf'],
                'maxSize' => 1024 * 1024 * 2.5],
            [['status'], 'default', 'value' => BaseActiveRecord::STATUS_INACTIVE],
            [['phone', 'salary'], 'number'],
            [['currency_id', 'hobby'], 'safe'],
            [['name', 'currency_id', 'gender', 'phone', 'hobby', 
                'married_status', 'bio', 'currency_id', 'salary'], 'required', 'on' => self::SCENARIO_UPDATE_APPLICANT],
        ]);
    }
    
    public function attributeLabels() {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'currency_id' => Yii::t('app.label', 'Currency'),
            'salary' => Yii::t('app.label', 'Expected Salary'),
            'cvFile' => Yii::t('app.label', 'CV File'),
        ]);
    }
    
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
    }
    
    /**
     * @param type $insert
     * @return type
     */
    public function beforeSave($insert) 
    {        
        $this->processUploadFile();
        
        if (
            $this->name != null &&
            $this->phone != null &&
            $this->gender != null &&
            $this->salary != null &&
            $this->photo != null &&
            $this->cv != null
        ) {
            $this->status = BaseActiveRecord::STATUS_ACTIVE;
        } else {
            $this->status = BaseActiveRecord::STATUS_INACTIVE;
        }
        
        return parent::beforeSave($insert);
    }
    
    /**
     * - delete photoFile
     * 
     * @return type
     */
    public function beforeDelete()
    {
        /* todo: delete the corresponding file in storage */
        $this->deleteFilePhoto();
        $this->deleteFileCv();
        
        return parent::beforeDelete();
    }
    
    protected function deleteFilePhoto()
    {
        @unlink(Yii::getAlias('@app/' . $this->path) . $this->photo);
        
    }
    
    protected function deleteFileCv()
    {
        @unlink(Yii::getAlias('@app/' . $this->path) . $this->cv);
    }
        
    /**
     * process uploaded file
     * 
     * @return boolean
     */
    public function processUploadFile()
    {
        if (!empty($this->photoFile)) {
            $this->deleteFilePhoto();

            $path = str_replace('web/', '', $this->path);
            
            // generate filename
            $filename = Inflector::slug($this->name . '-' . Yii::$app->security->generateRandomString(20));
            $filename = $filename . '.' . $this->photoFile->extension;
            
            $this->photoFile->saveAs($path . $filename);
            $this->photo = $filename;
        }
        
        if (!empty($this->cvFile)) {
            $this->deleteFileCv();

            $path = str_replace('web/', '', $this->path);
            
            // generate filename
            $filename = Inflector::slug($this->name . '-' . Yii::$app->security->generateRandomString(20));
            $filename = $filename . '.' . $this->cvFile->extension;
            
            $this->cvFile->saveAs($path . $filename);
            $this->cv = $filename;
            $this->cv_updated_at = date('Y-m-d H:i:s');
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
     * get url file
     * 
     * @return type
     */
    public function getCvUrl() 
    {
        if (empty($this->cv)) {
            return null;
        }

        $path = $this->path . $this->cv;

        if (!file_exists(Yii::getAlias('@app/' . $path))) {
            return null;
        }

        return Url::to('@' . $path, true);
    }

    public function getCvUrlHtml($name = null, $options = ['target' => '_blank', 'class' => 'btn btn-primary btn-sm']) 
    {
        $name = $name ? $name : '<i class=\'fa fa-file-pdf-o\'></i>&nbsp;&nbsp;'.FormatConverter::dateFormat($this->cv_updated_at, 'd M Y H:i');

        if (!$this->getCvUrl()) {
            return $name;
        }

        return Html::a($name, $this->getCvUrl(), $options);
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
    
    /**
     * returns formatted amount
     * 
     * @param type $withCurrency
     * @return type
     */
    public function getFormattedExpectedSalary($withCurrency = true)
    {
        $currency = '';
        switch ($this->currency_id) {
            case Currency::RUPIAH : $amount = FormatConverter::rupiahFormat($this->salary, 2); break;
            case Currency::DOLLAR : $amount = FormatConverter::dollarFormat($this->salary, 2); break;
            default : $amount = $this->salary;
        }
        if ($this->currency_id && $withCurrency) {
            $currency = $this->currency->code .' ';
        }
        
        
        return $currency . $amount;
    }
    
    /**
     * @return string
     */
    public function getGenderLabel()
    {
        $list = Config::getGenders();
        
        return $list[$this->gender] ? $list[$this->gender] : $this->gender;
    }
    
    /**
     * @return string
     */
    public function getMarriedStatusLabel()
    {
        $list = Config::getMarriedStatus();
        
        return $list[$this->married_status] ? $list[$this->married_status] : $this->married_status;
    }
}
