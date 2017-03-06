<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\helpers;

/**
 * Description of StringHelper
 *
 * @author Carbon
 */
class StringHelper extends \yii\helpers\StringHelper
{
	/**
	 * encrypt
	 * 
	 * @param type $string
	 * @return string
	 */
	public static function encrypt($string)
	{
		return base64_encode($string);
	}
	
	/**
	 * decrypt
	 * 
	 * @param type $string
	 * @return string
	 */
	public static function decrypt($string)
	{
		return base64_decode($string);
	}
}
