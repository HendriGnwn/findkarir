<?php

namespace app\models;

use app\helpers\MailHelper;
use dektrium\user\helpers\Password;
use dektrium\user\models\Profile;
use dektrium\user\models\User as BaseUser;
use Exception;
use mdm\admin\models\Assignment;
use RuntimeException;
use Yii;
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
		$this->on(self::AFTER_CREATE, [$this, 'afterCreateMember']);
		$this->on(self::AFTER_REGISTER, [$this, 'afterRegister']);
	}
    
    /** @inheritdoc */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['category'], 'safe'],
        ]);
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
    public static function getIsRoleToAccessFkadmin()
    {
        $user = Yii::$app->user;
        return ($user->can(self::ROLE_SUPERADMIN) == true) || 
            ($user->can(self::ROLE_MEMBER) == true) || 
            ($user->can(self::ROLE_USER) == true);
    }
	
	/**
	 * returns name, return username if profile name is null
	 * 
	 * @return string
	 */
	public function getName()
	{
		if(isset($this->profile) && ($this->profile->name != '')) {
			return $this->profile->name;
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
	 * event after Create User
	 * - assign this user to be user access
	 */
	public function afterCreate()
	{
		$this->assignAccess();
		
		return true;
	}
	
	/**
	 * event after register
	 * - assign this user to be user access
	 */
	public function afterRegister()
	{
		$this->assignAccess();
		
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
            $this->password = $this->password == null ? Password::generate(8) : $this->password;

            $this->trigger(self::BEFORE_CREATE_MEMBER);

            if (!$this->save()) {
                $transaction->rollBack();
                return false;
            }

            $this->confirm();

            $this->sendEmailNewMember();
            $this->trigger(self::BEFORE_CREATE_MEMBER);

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
}