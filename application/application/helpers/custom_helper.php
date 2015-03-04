<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('dateformat')) {
    function dateformat($var = '')
    {
        $newDate = date("M d, Y", strtotime($var));
        return $newDate;
    }
}
    if(!function_exists('pr')){
	function pr($arr=array(), $ret = FALSE){
        echo "<pre>";
        print_r($arr);
        if (!$ret) die;
			echo "</pre>";
		}
	}
	if(!function_exists('ec')){
	function ec($var, $ret = FALSE){
        echo $var;
        if (!$ret) die;
		}
	}
	if(!function_exists('get_domain')){
	function get_domain(){
		 $CI =& get_instance();
		 return preg_replace("/^[\w]{2,6}:\/\/([\w\d\.\-]+).*$/","$1", $CI->config->slash_item('base_url'));
		}
	}
    if(!function_exists('get_cur_dec')){
	function get_cur_dec(){
		 $CI =& get_instance();
        $CI->load->model('currency_model');
        $dec_point=$CI->currency_model->getDefaultCurrency('decimal_place');
        round($dec_point);
        return $dec_point;
    }
	}
	if(!function_exists('floatFormat')){
	function floatFormat($val,$dec=NULL){
        $dec =(!$dec)?get_cur_dec():$dec;
		return number_format((float)$val,$dec,'.',',');
	}
    }
if (!function_exists('clean_dir')) {
    function clean_dir($path)
    {
        $files = glob($path); // get all file names
        foreach ($files as $file) { // iterate files
            if (is_file($file))
                unlink($file); // delete file
        }
    }
}
if(!function_exists('toArray')){
    function toArray($obj)
    {
        if (is_object($obj)) $obj = (array)$obj;
        if (is_array($obj)) {
            $new = array();
            foreach ($obj as $key => $val) {
                $new[$key] = toArray($val);
            }
        } else {
            $new = $obj;
        }

        return $new;
    }
}