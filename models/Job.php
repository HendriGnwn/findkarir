<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use app\helpers\FormatConverter;
use yii\helpers\Html;

/**
 * This is the model class for table "job".
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
 * @property integer $status_payment
 * @property string $status_payment_updated_at
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 *
 * @property Company $company
 * @property JobType $jobType
 * @property JobApply[] $jobApplies
 */
class Job extends BaseActiveRecord
{
    const STATUS_PAYMENT_WAITING = 0;
    const STATUS_PAYMENT_PAID = 1;
    const STATUS_PAYMENT_FREE = 5;
    
    const EVENT_AFTER_CHANGE_STATUS = 'afterChangeStatus';
    const EVENT_AFTER_CHANGE_STATUS_PAYMENT = 'afterChangeStatusPayment';
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        
        $this->on(self::EVENT_BEFORE_INSERT, [$this, 'beforeInsert']);
        $this->on(self::EVENT_AFTER_CHANGE_STATUS, [$this, 'afterChangeStatus']);
        $this->on(self::EVENT_AFTER_CHANGE_STATUS_PAYMENT, [$this, 'afterChangeStatusPayment']);
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'job_type_id', 'name', 'description', 'requirement', 'city_id',  'salary_currency_id', 'start_salary', 'end_salary', 'open_job_date', 'close_job_date'], 'required'],
            [['company_id', 'job_type_id', 'city_id', 'province_id', 'salary_currency_id', 'province_id', 'status', 'status_payment', 'created_by', 'updated_by', 'status_payment'], 'integer'],
            [['description', 'requirement'], 'string'],
            [['start_salary', 'end_salary'], 'number'],
            [['code', 'open_job_date', 'close_job_date', 'status_updated_at', 'status_payment_updated_at', 'created_at', 'updated_at'], 'safe'],
            [['code'], 'string', 'max' => 100],
            [['name'], 'string', 'max' => 200],
            [['code'], 'unique'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
            [['job_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => JobType::className(), 'targetAttribute' => ['job_type_id' => 'id']],
            [['status'], 'default', 'value' => self::STATUS_INACTIVE],
            [['status_payment'], 'default', 'value' => self::STATUS_PAYMENT_WAITING],
            [['company_id'], 'validateCompanyPartner'],
        ];
    }
    
    /**
     * @param type $attribute
     * @param type $params
     * @return boolean
     */
    public function validateCompanyPartner($attribute, $params)
    {
        $company = new Company();//Company::find()->where(['id'=>$this->company_id])->actived()->one();
        if (!$company->getIsPartner()) {
            return true;
        }
        
        if (!isset($company->partner->orderStillActive)) {
            $this->addError($attribute, Yii::t('app.message', 'This partner is not order actived.'));
            return false;
        }
        $orderActive = $company->partner->orderStillActive;
        $offerLimit = $orderActive->offer_limit;
        
        $jobHistory = self::find()
                ->andWhere(['company_id' => $this->company_id])
                ->andWhere(['between', 'open_job_date', $orderActive->offer_at, $orderActive->offer_expired_at])
                ->count();
        
        if ($jobHistory > $offerLimit) {
            $this->addError($attribute, Yii::t('app.message', 'This partner is no limit.'));
            return false;
        }
        
        return true;
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
            'status_payment' => Yii::t('app.label', 'Status Payment'),
            'status_payment_updated_at' => Yii::t('app.label', 'Status Payment Updated At'),
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
        $this->code = self::generateCode($this->company_id);
        
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
        
        if (
            $this->job_type_id != null ||
            $this->name != null ||
            $this->description != null ||
            $this->requirement != null ||
            $this->open_job_date != null ||
            $this->close_job_date != null
        ) {
            $this->status = self::STATUS_ACTIVE;
        } else {
            $this->status = self::STATUS_INACTIVE;
        }
        $this->status_updated_at = date('Y-m-d H:i:s');
        
        $company = Company::find()->where(['id'=>$this->company_id])->actived()->one();
        if ($company->getIsUser()) {
            if (isset($company->user->orderStillActive)) {
                $this->status_payment = self::STATUS_PAYMENT_PAID;
                return true;
            }
        } else if ($company->getIsPartner()) {
            if (isset($company->partner->orderStillActive)) {
                $this->status_payment = self::STATUS_PAYMENT_PAID;
                return true;
            }
        }
        $this->status_payment = self::STATUS_PAYMENT_FREE;
        $this->status_payment_updated_at = $this->status_updated_at;
        
        return parent::beforeSave($insert);
    }
    
    public static function consoleManageJobStatusPayments()
    {
        $jobs = self::find()->all();
        foreach ($jobs as $job) {
            $company = $job->company;
            if ($company->getIsUser()) {
                if (isset($company->user->orderStillActive)) {
                    $job->status_payment = self::STATUS_PAYMENT_PAID;
                    $job->status_payment_updated_at = date('Y-m-d H:i:s');
                    
                    $job->save();
                    continue;
                }
            } else if ($company->getIsPartner()) {
                if (isset($company->partner->orderStillActive)) {
                    $job->status_payment = self::STATUS_PAYMENT_PAID;
                    $job->status_payment_updated_at = date('Y-m-d H:i:s');
                    
                    $job->save();
                    continue;
                }
            }
            $job->status_payment = self::STATUS_PAYMENT_FREE;
            
            $job->save();
        }
    }
    
    /**
     * @return boolean
     */
    public function afterChangeStatus()
    {
        $this->updateAttributes(['status' => date('Y-m-d H:i:s')]);
        
        return true;
    }
    
    /**
     * @return boolean
     */
    public function afterChangeStatusPayment()
    {
        $this->updateAttributes(['status_payment' => date('Y-m-d H:i:s')]);
        
        return true;
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
    public function getJobApplies()
    {
        return $this->hasMany(JobApply::className(), ['job_id' => 'id']);
    }
    
    /**
     * @return array
     */
    public static function statusPaymentLabels()
	{
		return [
			self::STATUS_PAYMENT_WAITING => Yii::t('app.label', 'Waiting'),
			self::STATUS_PAYMENT_PAID => Yii::t('app.label', 'Paid'),
			self::STATUS_PAYMENT_FREE => Yii::t('app.label', 'Free'),
		];
	}
    
	public function getStatusPaymentLabel()
	{
		$list = self::statusPaymentLabels();
		return $list[$this->status_payment] ? $list[$this->status_payment] : $this->status_payment;
	}
	
	public function getStatusPaymentWithStyle()
	{
		switch ($this->status_payment) {
			case self::STATUS_PAYMENT_WAITING :
				return Html::label($this->getStatusPaymentLabel(), null, ['class'=>'label label-warning label-sm']);
			case self::STATUS_PAYMENT_PAID :
				return Html::label($this->getStatusPaymentLabel(), null, ['class'=>'label label-success label-sm']);
            case self::STATUS_PAYMENT_FREE :
				return Html::label($this->getStatusPaymentLabel(), null, ['class'=>'label label-primary label-sm']);
			default :
				return Html::label($this->getStatusPaymentLabel(), null, ['class'=>'label label-default label-sm']);
		}
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
		$left = strtoupper($type) .$separator. date('ymd');
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
     * returns formatted start salary
     * 
     * @param type $withCurrency
     * @return type
     */
    public function getFormattedStartSalary($withCurrency = true)
    {
        switch ($this->salary_currency_id) {
            case Currency::RUPIAH : $amount = FormatConverter::rupiahFormat($this->start_salary, 0); break;
            case Currency::DOLLAR : $amount = FormatConverter::dollarFormat($this->start_salary, 0); break;
            default : $amount = $this->start_salary;
        }
        $currency = $withCurrency ? $this->salaryCurrency->code .' ' : '';
        
        return $currency . $amount;
    }
    
    /**
     * returns formatted end salary
     * 
     * @param type $withCurrency
     * @return type
     */
    public function getFormattedEndSalary($withCurrency = true)
    {
        switch ($this->salary_currency_id) {
            case Currency::RUPIAH : $amount = FormatConverter::rupiahFormat($this->end_salary, 0); break;
            case Currency::DOLLAR : $amount = FormatConverter::dollarFormat($this->end_salary, 0); break;
            default : $amount = $this->end_salary;
        }
        $currency = $withCurrency ? $this->salaryCurrency->code .' ' : '';
        
        return $currency . $amount;
    }
    
    /**
     * returns formatted end salary
     * 
     * @param type $withCurrency
     * @return type
     */
    public function getCombineSalary($withCurrency = true, $separator = ' - ')
    {
        return $this->getFormattedStartSalary($withCurrency) . $separator . $this->getFormattedEndSalary($withCurrency);
    }
    
    /**
     * @return string
     */
    public function getDetailUrl($scheme = true)
    {
        return \yii\helpers\Url::to(['/job/detail', 'code' => $this->code], $scheme);
    }
}
