<?php

namespace app\models;

use app\helpers\MailHelper;
use dektrium\user\helpers\Password;
use dektrium\user\models\Profile;
use dektrium\user\models\Token;
use dektrium\user\models\User as BaseUser;
use Exception;
use mdm\admin\models\Assignment;
use RuntimeException;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * @property integer $category {1:admin,2:applicant,3:member,4:general company}
 * @property Profile $profile
 */
class User extends BaseUser
{
	const ROLE_SUPERADMIN = 'superadmin';
	const ROLE_MEMBER = 'member';
	const ROLE_APPLICANT = 'applicant';
	const ROLE_GENERAL_COMPANY = 'general-company';
	const ROLE_USER = 'user';
    
    const BEFORE_CREATE_MEMBER = 'beforeCreateMember';
    const AFTER_CREATE_MEMBER = 'afterCreateMember';
	
	public function init() 
	{
		parent::init();
		
		$this->on(self::AFTER_CREATE, [$this, 'afterCreate']);
		$this->on(self::BEFORE_CREATE_MEMBER, [$this, 'beforeCreateMember']);
		$this->on(self::AFTER_CREATE_MEMBER, [$this, 'afterCreateMember']);
		$this->on(self::AFTER_REGISTER, [$this, 'afterRegister']);
	}
    
    /** @inheritdoc */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['category'], 'safe'],
        ]);
    }
    
    public function attributeHints() 
    {
        return [
            'category' => Yii::t('app.label', 'After Create, Category cannot be updated.'),
        ];
    }
	
	/**
	 * returns boolean that is super admin or not
	 * 
	 * @return boolean
	 */
	public static function getIsRoleSuperAdmin()
	{
		return Yii::$app->user->can(User::ROLE_SUPERADMIN) == true;
	}
    
    /**
     * @return boolean
     */
    public function getIsCategoryMember()
    {
        return $this->category == self::ROLE_MEMBER;
    }
    
    /**
     * @return boolean
     */
    public function getIsCategoryApplicant()
    {
        return $this->category == self::ROLE_APPLICANT;
    }
    
    /**
     * @return boolean
     */
    public function getIsCategoryGeneralCompany()
    {
        return $this->category == self::ROLE_GENERAL_COMPANY;
    }
    
    /**
     * @return boolean
     */
    public function getIsCategorySuperadmin()
    {
        return $this->category == self::ROLE_SUPERADMIN;
    }
    
    /**
     * @return boolean
     */
    public function getIsCategoryUser()
    {
        return $this->category == self::ROLE_USER;
    }
    
    /**
     * @return boolean
     */
    public static function getIsRoleToAccessFkadmin()
    {
        $user = Yii::$app->user;
        return ($user->can(self::ROLE_SUPERADMIN) == true) || 
            //($user->can(self::ROLE_MEMBER) == true) || 
            ($user->can(self::ROLE_USER) == true);
    }
    
    /**
     * @return array
     */
    public static function categoryLabels()
    {
        return [
            self::ROLE_SUPERADMIN => self::ROLE_SUPERADMIN,
            self::ROLE_USER => self::ROLE_USER,
            self::ROLE_MEMBER => self::ROLE_MEMBER,
            self::ROLE_APPLICANT => self::ROLE_APPLICANT,
            self::ROLE_GENERAL_COMPANY => self::ROLE_GENERAL_COMPANY,
        ];
    }
	
	/**
	 * returns name, return username if profile name is null
	 * 
	 * @return string
	 */
	public function getName()
	{
        switch ($this->category) {
            case self::ROLE_GENERAL_COMPANY :
                if(isset($this->company) && ($this->company->name != '')) {
                    return $this->company->name;
                }
                return $this->username;
        }
        
        if(isset($this->profile) && ($this->profile->name != '')) {
            return $this->profile->name;
        }
        return $this->username;
	}
    
    /**
	 * returns name, return username if profile name is null
	 * 
	 * @return string
	 */
	public function getNameWithUsername()
	{
        switch ($this->category) {
            case self::ROLE_GENERAL_COMPANY :
                if(isset($this->company) && ($this->company->name != '')) {
                    return $this->company->name . ' ('.$this->username.')';
                }
                return $this->username;
        }
        
        if(isset($this->profile) && ($this->profile->name != '')) {
            return $this->profile->name  . ' ('.$this->username.')';
        }
        return $this->username;
	}
	
	/**
	 * combine relation data
	 * 
	 * @return array
	 */
	public function getRelationData()
	{
		$relations = [
			'profile' => $this->profile->attributes,
			/* todo: add some relations */
		];
		
		return $relations;
	}
    
    /**
     * @return ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['user_id' => 'id']);
    }
    
    /**
     * @return ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['user_id' => 'id']);
    }
    
    /**
     * @return ActiveQuery
     */
    public function getSkills()
    {
        return $this->hasMany(Skill::className(), ['user_id' => 'id']);
    }
    
    /**
     * @return ActiveQuery
     */
    public function getPassions()
    {
        return $this->hasMany(Passion::className(), ['user_id' => 'id']);
    }
    
    /**
     * @return ActiveQuery
     */
    public function getOrderStillActive()
    {
        return $this->hasOne(Order::className(), ['user_id' => 'id'])
                ->andWhere(['>=', 'offer_expired_at', date('Y-m-d')])
                ->andWhere(['status' => Order::STATUS_PAID])
                ->orderBy(['created_at' => SORT_DESC]);
    }
	
	/**
	 * event after Create User
	 * - assign this user to be user access
	 */
	public function afterCreate()
	{
		$this->assignAccess([$this->category]);
        $this->createForIdentityByCategory();
		
		return true;
	}
    
    protected function createForIdentityByCategory()
    {
        switch ($this->category) {
            case self::ROLE_GENERAL_COMPANY :
                $company = new Company();
                $company->user_id = $this->id;
                $company->status = Company::STATUS_INACTIVE;
                $company->save(false);
                break;
        }
        
        return true;
    }
	
	/**
	 * event after register
	 * - assign this user to be user access
	 */
	public function afterRegister()
	{
		$this->assignAccess([$this->category]);
		
		return true;
	}
    
    /**
     * @return boolean
     */
    public function beforeCreateMember()
    {
        return true;
    }
    
    /**
     * @return boolean
     */
    public function afterCreateMember()
    {
        $this->assignAccess([self::ROLE_MEMBER]);
        
        return true;
    }
    
    /**
     * @return boolean
     */
    public function beforeDelete() 
    {
        Yii::$app->authManager->revokeAll($this->id);
        
        return parent::beforeDelete();
    }
    
	/**
	 * assign role to access user
	 * 
	 * @param array $roles
	 * @return boolean
	 */
	private function assignAccess($roles = [self::ROLE_USER])
	{
		$items = [$roles];
		$model = new Assignment($this->id);
		$model->assign($items);
		
		return true;
	}
    
    /**
     * Creates new user account for member. It generates password if it is not provided by user.
     *
     * @return bool
     */
    public function createMember()
    {
        if ($this->getIsNewRecord() == false) {
            throw new RuntimeException('Calling "' . __CLASS__ . '::' . __METHOD__ . '" on existing user');
        }

        $transaction = $this->getDb()->beginTransaction();

        try {
            $this->category = self::ROLE_MEMBER;
            $this->password = $this->password == null ? Password::generate(8) : $this->password;

            $this->trigger(self::BEFORE_CREATE_MEMBER);

            if (!$this->save()) {
                $transaction->rollBack();
                return false;
            }

            $this->confirm();

            $this->sendEmailNewMember();
            $this->trigger(self::AFTER_CREATE_MEMBER);

            $transaction->commit();

            return true;
        } catch (Exception $e) {
            $transaction->rollBack();
            \Yii::warning($e->getMessage());
            throw $e;
        }
    }
    
    /**
     * send email new member
     */
    public function sendEmailNewMember()
    {
        $mail = MailHelper::sendMail([
            'to' => $this->email,
            'subject' => Yii::t('app.message', 'Welcome to {name}', ['name' => Yii::$app->name]),
            'view' => ['html' => 'user/new-member'],
            'viewParams' => [
                'user' => $this, 
                'token' => null, 
                'module' => $this->module,
                'showPassword' => true,
            ],
        ]);
        
        return $mail;
    }
    
    /**
     * This method is used to register new user account. If Module::enableConfirmation is set true, this method
     * will generate new confirmation token and use mailer to send it to the user.
     *
     * @return bool
     */
    public function registerApplicant()
    {
        if ($this->getIsNewRecord() == false) {
            throw new \RuntimeException('Calling "' . __CLASS__ . '::' . __METHOD__ . '" on existing user');
        }

        $transaction = $this->getDb()->beginTransaction();

        try {
            $this->category = self::ROLE_APPLICANT;
            $this->confirmed_at = $this->module->enableConfirmation ? null : time();
            $this->password     = $this->module->enableGeneratingPassword ? Password::generate(8) : $this->password;

            $this->trigger(self::BEFORE_REGISTER);

            if (!$this->save()) {
                $transaction->rollBack();
                return false;
            }

            if ($this->module->enableConfirmation) {
                /** @var Token $token */
                $token = \Yii::createObject(['class' => Token::className(), 'type' => Token::TYPE_CONFIRMATION]);
                $token->link('user', $this);
            }

            $this->mailer->sendWelcomeMessage($this, isset($token) ? $token : null);
            $this->trigger(self::AFTER_REGISTER);

            $transaction->commit();

            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            \Yii::warning($e->getMessage());
            throw $e;
        }
    }
}