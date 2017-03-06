<?php

namespace app\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * This is the model class for table "page".
 *
 * @property string $id
 * @property integer $category
 * @property string $name
 * @property string $slug
 * @property string $photo
 * @property string $description
 * @property string $date_post
 * @property integer $status
 * @property string $meta_description
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 */
class Page extends BaseActiveRecord
{
    const CATEGORY_FULL = 1;
	const CATEGORY_PARTIAL = 2;
    
    /**
     * @var UploadedFile
     */
    public $photoFile;
    
    public function init()
    {
        parent::init();
        
        $this->path = 'web/uploads/page/';
        if (!is_dir(Yii::getAlias('@app/' . $this->path))) {
            mkdir(Yii::getAlias('@app/' . $this->path));
        }

        return true;
    }
    
	/**
	 * @inheritdoc
	 */
    public function behaviors() 
    {
        return ArrayHelper::merge([
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                'slugAttribute' => 'slug',
                'ensureUnique' => true,
            ]
        ], parent::behaviors());
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category', 'name', 'slug', 'photo', 'description', 'date_post'], 'required'],
            [['category', 'status', 'created_by', 'updated_by'], 'integer'],
            [['post_date'],'datetime', 'format' => 'php: Y-m-d H:i:s', 'message' => Yii::t('app.message', 'Datetime format must be `Y-m-d H:i:s` eg: 2017-01-30 19:00:50')],
            [['description', 'meta_description'], 'string'],
            [['date_post', 'created_at', 'updated_at'], 'safe'],
            [['name', 'photo'], 'string', 'max' => 100],
            [['slug'], 'string', 'max' => 200],
            [['slug'], 'unique'],
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
            'category' => Yii::t('app.label', 'Category'),
            'name' => Yii::t('app.label', 'Name'),
            'slug' => Yii::t('app.label', 'Slug'),
            'photo' => Yii::t('app.label', 'Photo'),
            'description' => Yii::t('app.label', 'Description'),
            'date_post' => Yii::t('app.label', 'Date Post'),
            'status' => Yii::t('app.label', 'Status'),
            'created_at' => Yii::t('app.label', 'Created At'),
            'created_by' => Yii::t('app.label', 'Created By'),
            'updated_at' => Yii::t('app.label', 'Updated At'),
            'updated_by' => Yii::t('app.label', 'Updated By'),
        ];
    }
    
    public static function categoryLabels() 
    {
        return [
            self::CATEGORY_FULL => Yii::t('app.label', 'Full'),
            self::CATEGORY_PARTIAL => Yii::t('app.label', 'Partial'),
        ];
    }

    public function getCategoryLabel() 
    {
        return self::categoryLabels()[$this->category] ? self::categoryLabels()[$this->category] : $this->category;
    }
    
    /**
     * returns page detail url
     * 
     * @param type $absolute
     * @return type
     */
    public function getDetailUrl($absolute = false)
    {
        return Url::to(['page/'.$this->slug], $absolute);
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
     * - process upload file
     * 
     * @param type $insert
     * @return type
     */
    public function beforeSave($insert) 
    {
        $this->processUploadFile();
        
        return parent::beforeSave($insert);
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
            $filename = Inflector::slug($this->slug . '-' . Yii::$app->security->generateRandomString(20));
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
