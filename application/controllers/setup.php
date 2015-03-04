<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	// header("Location: details.php");
$base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$base_url .= "://".$_SERVER['HTTP_HOST'];
$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']); 
$base_url = str_replace('/install', '', $base_url);
define('BASEURL', $base_url);
	header("Location: ".BASEURL.'install/', TRUE, 302);
    exit();