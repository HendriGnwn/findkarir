<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\web\UploadedFile;

/**
 * This is the model class for table "payment".
 *
 * @property integer $id
 * @property integer $payment_type_id
 * @property string $name
 * @property string $behalf_of
 * @property string $bill_no
 * @property string $branch_name
 * @property string $logo
 * @property integer $status
 * @property integer $order
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 *
 * @property OrderConfirmation[] $orderConfirmations
 * @property PaymentType $paymentType
 */
class Payment extends BaseActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $logoFile;
    
    public function init()
    {
        parent::init();
        
        $this->path = 'web/uploads/payment/';
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
        return 'payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payment_type_id', 'name', 'behalf_of', 'bill_no', 'branch_name', 'logo', 'order'], 'required'],
            [['payment_type_id', 'status', 'order', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'behalf_of', 'branch_name', 'logo'], 'string', 'max' => 100],
            [['bill_no'], 'string', 'max' => 50],
            [['payment_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentType::className(), 'targetAttribute' => ['payment_type_id' => 'id']],
            [['status'], 'default', 'value' => self::STATUS_ACTIVE],
            [['logoFile'], 'file', 'skipOnEmpty' => true, 'checkExtensionByMimeType' => false,
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
            'payment_type_id' => Yii::t('app.label', 'Payment Type ID'),
            'name' => Yii::t('app.label', 'Name'),
            'behalf_of' => Yii::t('app.label', 'Behalf Of'),
            'bill_no' => Yii::t('app.label', 'Bill No'),
            'branch_name' => Yii::t('app.label', 'Branch Name'),
            'logo' => Yii::t('app.label', 'Logo'),
            'status' => Yii::t('app.label', 'Status'),
            'order' => Yii::t('app.label', 'Order'),
            'created_at' => Yii::t('app.label', 'Created At'),
            'created_by' => Yii::t('app.label', 'Created By'),
            'updated_at' => Yii::t('app.label', 'Updated At'),
            'updated_by' => Yii::t('app.label', 'Updated By'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getOrderConfirmations()
    {
        return $this->hasMany(OrderConfirmation::className(), ['payment_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getPaymentType()
    {
        return $this->hasOne(PaymentType::className(), ['id' => 'payment_type_id']);
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
        @unlink(Yii::getAlias('@app/' . $this->path) . $this->logo);
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
        if (!empty($this->logoFile)) {
            $this->deleteFile();

            $path = str_replace('web/', '', $this->path);
            
            // generate filename
            $filename = Inflector::slug($this->name . '-' . Yii::$app->security->generateRandomString(20));
            $filename = $filename . '.' . $this->logoFile->extension;
            
            $this->logoFile->saveAs($path . $filename);
            $this->logo = $filename;
        }

        return true;
    }
    
    /**
     * get url file
     * 
     * @return type
     */
    public function getLogoUrl() 
    {
        if (empty($this->logo)) {
            return null;
        }

        $path = $this->path . $this->logo;

        if (!file_exists(Yii::getAlias('@app/' . $path))) {
            return null;
        }

        return Url::to('@' . $path, true);
    }

    public function getLogoUrlHtml($name = null, $options = ['target' => '_blank']) 
    {
        $name = $name ? $name : $this->name;

        if (!$this->getLogoUrl()) {
            return $name;
        }

        return Html::a($name, $this->getLogoUrl(), $options);
    }
}
