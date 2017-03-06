<?php

namespace app\models;

use dektrium\user\models\Profile;
use dektrium\user\models\User as BaseUser;
use mdm\admin\models\Assignment;
use Yii;

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
	
	public function init() 
	{
		parent::init();
		
		$this->on(self::AFTER_CREATE, [$this, 'afterCreate']);
		$this->on(self::AFTER_REGISTER, [$this, 'afterRegister']);
	}
	
	/**
	 * returns boolean that is super admin or not
	 * 
	 * @return boolean
	 */
	public static function isRoleSuperAdmin()
	{
		return (Yii::$app->user->can(User::ROLE_SUPERADMIN));
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
}