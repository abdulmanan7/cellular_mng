<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('dateformat'))
{
    function dateformat($var = '')
    {
    	$newDate = date("M d, Y", strtotime($var));
        return $newDate;
    }   
}
if(!function_exists('pr')){
	function pr($arr=array(), $ret = FALSE){

		echo "<pre>"; print_r($arr); if(!$ret) die; 
		echo "</pre>";

	}
}
if(!function_exists('floatFormat')){
	function floatFormat($val){
		return number_format((float)$val,2,'.',',');
	}
}
