<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "view_job".
 *
 * @property string $id
 * @property string $code
 * @property string $company_id
 * @property string $job_type_id
 * @property string $name
 * @property string $description
 * @property string $requirement
 * @property integer $city_id
 * @property integer $province_id
 * @property integer $salary_currency_id
 * @property string $start_salary
 * @property string $end_salary
 * @property string $open_job_date
 * @property string $close_job_date
 * @property integer $status
 * @property string $status_updated_at
 * @property string $status_payment_updated_at
 * @property integer $status_payment
 * @property string $created_by
 * @property string $updated_by
 * @property string $updated_at
 * @property string $created_at
 * @property string $user_id
 * @property integer $offer_id
 * @property string $partner_id
 * @property string $order_id
 * @property integer $offer_order
 * @property integer $order_status
 * 
 * @property Company $company
 * @property Job $job
 * @property JobType $jobType
 * @property City $city
 * @property Province $province
 * @property Currency $salaryCurrency
 * @property Order $order
 * @property User $user
 * @property Partner $partner
 * @property Offer $offer
 */
class ViewJob extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_job';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'company_id', 'job_type_id', 'name', 'description', 'requirement', 'city_id', 'province_id', 'salary_currency_id', 'start_salary', 'end_salary', 'open_job_date', 'close_job_date', 'status', 'status_payment', 'offer_id', 'order_id'], 'required'],
            [['company_id', 'job_type_id', 'city_id', 'province_id', 'salary_currency_id', 'status', 'status_payment', 'created_by', 'updated_by', 'user_id', 'offer_id', 'partner_id', 'order_id', 'offer_order'], 'integer'],
            [['description', 'requirement'], 'string'],
            [['start_salary', 'end_salary'], 'number'],
            [['open_job_date', 'close_job_date', 'status_updated_at', 'status_payment_updated_at', 'updated_at', 'created_at', 'order_status'], 'safe'],
            [['code'], 'string', 'max' => 100],
            [['name'], 'string', 'max' => 200],
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
            'company_id' => Yii::t('app.label', 'Company ID'),
            'job_type_id' => Yii::t('app.label', 'Job Type ID'),
            'name' => Yii::t('app.label', 'Name'),
            'description' => Yii::t('app.label', 'Description'),
            'requirement' => Yii::t('app.label', 'Requirement'),
            'city_id' => Yii::t('app.label', 'City ID'),
            'province_id' => Yii::t('app.label', 'Province ID'),
            'salary_currency_id' => Yii::t('app.label', 'Salary Currency ID'),
            'start_salary' => Yii::t('app.label', 'Start Salary'),
            'end_salary' => Yii::t('app.label', 'End Salary'),
            'open_job_date' => Yii::t('app.label', 'Open Job Date'),
            'close_job_date' => Yii::t('app.label', 'Close Job Date'),
            'status' => Yii::t('app.label', 'Status'),
            'status_updated_at' => Yii::t('app.label', 'Status Updated At'),
            'status_payment_updated_at' => Yii::t('app.label', 'Status Payment Updated At'),
            'status_payment' => Yii::t('app.label', 'Status Payment'),
            'created_by' => Yii::t('app.label', 'Created By'),
            'updated_by' => Yii::t('app.label', 'Updated By'),
            'updated_at' => Yii::t('app.label', 'Updated At'),
            'created_at' => Yii::t('app.label', 'Created At'),
            'user_id' => Yii::t('app.label', 'User ID'),
            'offer_id' => Yii::t('app.label', 'Offer ID'),
            'partner_id' => Yii::t('app.label', 'Partner ID'),
            'order_id' => Yii::t('app.label', 'Order ID'),
            'offer_order' => Yii::t('app.label', 'Offer Order'),
            'order_status' => Yii::t('app.label', 'Order Status'),
        ];
    }
    
    /**
     * @inheritdoc
     * @return \app\models\queries\ViewJobQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\ViewJobQuery(get_called_class());
    }
    
    /**
     * @return ActiveQuery
     */
    public function getJob()
    {
        return $this->hasOne(Job::className(), ['id' => 'id']);
    }
    
    /**
     * @return ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
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
     * @return ActiveQuery
     */
    public function getSalaryCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'salary_currency_id']);
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
    public function getPartner()
    {
        return $this->hasOne(Partner::className(), ['id' => 'partner_id']);
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
    public function getOffer()
    {
        return $this->hasOne(Offer::className(), ['id' => 'offer_id']);
    }
    
    /**
     * @return ActiveQuery
     */
    public function getJobApplies()
    {
        return $this->hasMany(JobApply::className(), ['job_id' => 'id']);
    }
    
    /**
     * insert into view_job
     * runs with console command / cron job
     * 
     * @return boolean
     */
    public static function consoleRefreshCache()
    {
        $query = 'TRUNCATE `view_job`;';
        $query.= 'INSERT INTO `view_job` SELECT * FROM `raw_view_job` ORDER BY `offer_order` ASC;';
        $command = Yii::$app->db->createCommand($query);
        $result = $command->execute();
        
        return $result;
    }
    
	public function getStatusPaymentLabel()
	{
		$list = Job::statusPaymentLabels();
		return $list[$this->status_payment] ? $list[$this->status_payment] : $this->status_payment;
	}
	
	public function getStatusPaymentWithStyle()
	{
		switch ($this->status_payment) {
			case Job::STATUS_PAYMENT_WAITING :
				return Html::label($this->getStatusPaymentLabel(), null, ['class'=>'label label-warning label-sm']);
			case Job::STATUS_PAYMENT_PAID :
				return Html::label($this->getStatusPaymentLabel(), null, ['class'=>'label label-success label-sm']);
            case Job::STATUS_PAYMENT_FREE :
				return Html::label($this->getStatusPaymentLabel(), null, ['class'=>'label label-primary label-sm']);
			default :
				return Html::label($this->getStatusPaymentLabel(), null, ['class'=>'label label-default label-sm']);
		}
	}
}
