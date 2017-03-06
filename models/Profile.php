<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use dektrium\user\models\Profile as BaseProfile;
use yii\helpers\ArrayHelper;

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
 * 
 * @author Hendri
 */
class Profile extends BaseProfile
{
	const IS_COMPLETE_TRUE = 1;
	const IS_COMPLETE_FALSE = 0;
	
	public function init() 
	{
		parent::init();
	}
}
