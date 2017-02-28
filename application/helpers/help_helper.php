<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('generateUrl')) 
{
	function generateUrl($string, $separator = '-', $lowercase = true) {
		$trans = array(
			'&\#\d+?;' => '',
			'&\S+?;' => '',
			'\s+' => $separator,
			'[^a-z0-9\-\._]' => '',
			'[.]' => '',
			$separator . '+' => $separator,
			$separator . '$' => $separator,
			'^' . $separator => $separator,
			'\.+$' => ''
		);

		$string = strip_tags(stripslashes(trim($string)));

		foreach ($trans as $key => $val) {
			$string = preg_replace("#" . $key . "#i", $val, $string);
		}

		if ($lowercase === TRUE) {
			$string = strtolower($string);
		}
		return $string;
	}
}
