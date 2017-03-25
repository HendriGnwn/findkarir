<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * This is the model class for table "order_confirmation".
 *
 * @property string $order_id
 * @property string $user_id
 * @property string $photo
 * @property string $description
 * @property integer $payment_id
 * @property string $from_bank_name
 * @property string $from_behalf_of
 * @property string $form_bill_no
 * @property string $payment_updated_at
 * @property string $status
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 *
 * @property Order $order
 * @property Payment $payment
 */
class OrderConfirmation extends BaseActiveRecord
{
    const STATUS_COMPLETE = 1;
    const STATUS_NOT_COMPLETE = 0;
    
    /**
     * @var UploadedFile
     */
    public $photoFile;
    
    public function init()
    {
        parent::init();
        
        $this->path = 'web/uploads/order-confirmation/';
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
        return 'order_confirmation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'user_id', 'description', 'payment_id', 'from_bank_name', 'from_behalf_of', 'from_bill_no'], 'required'],
            [['order_id', 'user_id', 'payment_id', 'created_by', 'updated_by'], 'integer'],
            [['from_bill_no'], 'number'],
            [['description'], 'string'],
            [['status', 'photo', 'payment_updated_at', 'created_at', 'updated_at'], 'safe'],
            [['photo'], 'string', 'max' => 100],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
            [['photoFile'], 'file', 'skipOnEmpty' => true, 'checkExtensionByMimeType' => false,
                'extensions' => ['jpg', 'jpeg', 'png'],
                'maxSize' => 1024 * 1024 * 1],
            [['status'], 'default', 'value' => self::STATUS_NOT_COMPLETE],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => Yii::t('app.label', 'Order ID'),
            'user_id' => Yii::t('app.label', 'User'),
            'photo' => Yii::t('app.label', 'Photo'),
            'description' => Yii::t('app.label', 'Description'),
            'payment_id' => Yii::t('app.label', 'Payment To'),
            'from_bank_name' => Yii::t('app.label', 'From Bank Name'),
            'from_behalf_of' => Yii::t('app.label', 'From Behalf of'),
            'from_bill_no' => Yii::t('app.label', 'From Bill No'),
            'payment_updated_at' => Yii::t('app.label', 'Payment Updated At'),
            'created_at' => Yii::t('app.label', 'Created At'),
            'created_by' => Yii::t('app.label', 'Created By'),
            'updated_at' => Yii::t('app.label', 'Updated At'),
            'updated_by' => Yii::t('app.label', 'Updated By'),
        ];
    }
    
    /**
     * - check whether order status is expired or not
     * 
     * @return boolean
     */
    public function beforeValidate() 
    {
        $order = $this->order;
        if (!isset($order)) {
            $this->addError('order_id', Yii::t('app.message', 'Order is not found.'));
            return false;
        }
        
        /** check order status */
        if(!$order->getIsStatusWaitingPayment()) {
            $this->addError('order_id', Yii::t('app.message', 'Confirmation is failed, because Order already {status}', ['status' => $order->getStatusLabel()]));
            return false;
        }
        
        return parent::beforeValidate();
    }
    
    /**
     * @param type $insert
     * @return type
     */
    public function beforeSave($insert) 
    {
        $this->processUploadFile();
        
        if (
            $this->photo != null ||
            $this->from_bank_name != null ||
            $this->from_behalf_of != null ||
            $this->payment_id != null
        ) {
            $this->status = self::STATUS_COMPLETE;
        } else {
            $this->status = self::STATUS_NOT_COMPLETE;
        }
        
        return parent::beforeSave($insert);
    }

    /**
     * @return ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getPayment()
    {
        return $this->hasOne(Payment::className(), ['id' => 'payment_id']);
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
            $filename = Inflector::slug($this->from_behalf_of . '-' . Yii::$app->security->generateRandomString(20));
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
        $name = $name ? $name : null;

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
}
