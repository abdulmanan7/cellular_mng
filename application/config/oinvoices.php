<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Oinvoices Version
|--------------------------------------------------------------------------
|
*/
$config['version'] = '1.0';
$config['version_date'] = '2015.2.1';


/*
|--------------------------------------------------------------------------
| Oinvoices URLs
|--------------------------------------------------------------------------
| For compatibility reason.
| If your website uses Oinvoices < 0.9.8 and your pages are well referenced
| keep 'short' URLs
| Else, put 'long' URLs, which will be the future default way of URLs display
|
| 'full' : 	Full URL. Example : http://yourdomain/page/subpage
| 'short' : Small URL. Example : http://yourdomain/subpage
|
*/
$config['url_mode'] = 'full';
$config['system_email'] = 'admin@admin.com';//Use by sending invoices Note:by default email used define in config/ion_auth.php
$config['site_title'] = 'Example.com';//Optional Use by sending invoices Note:by default Site Name used define in config/ion_auth.php

/*
|--------------------------------------------------------------------------
| Available filemanagers
|--------------------------------------------------------------------------
| Javascript filemanagers.
| Must be useable with tinyMCE and idealy in standalone mode.
| In standalone mode, the filemanager is used by /javascript/OinvoicesMediaManager.js (addMedia method).
| 2 filemanagers are currently supported :
| - filemanager :		Moxiecode MceFilemanager / ImageManager (licensed module, not provided with Oinvoices)
| - tinyBrowser :		http://www.lunarvis.com/
|
| All the filemanagers must be put in the directory :
| /javascript/tinymce/jscripts/tiny_mce/plugins
|
| If you wish to add another one, look at /javascript/OinvoicesMediaManager.js to the methods :
| - toggleFileManager()
| - toggleImageManager
*/
$config['filemanagers'] = array('mootools-filemanager');


/*
|--------------------------------------------------------------------------
| Available texteditors
|--------------------------------------------------------------------------
|
| Defines the installed text editors. Default is TinyMCE.
| CKEditor is still experimental and works best with kcfinder.
|
*/
$config['texteditors'] = array('tinymce');


/*
|--------------------------------------------------------------------------
| Oinvoices Special URI definition
|--------------------------------------------------------------------------
|
| Special URI setup
| Usee this array to define which URI segment to use for special URIs
| These URI are used for dedicated function like
| - getting articles by category,
| - limit the number of displayed articles on one page (pagination)
| _ Getting articles by time period (acrhives)
|
| Array ( 'user_chosen_uri' => 'internal_uri' );
|
| Notice : Don't change the 'internal_uri' on standard functionnalities without knowing what you do !
*/
$config['special_uri'] = array(	'category' => 'category',
								'page' => 'pagination',
								'archive' => 'archives',
								'tag' => 'tag',
							  );


/**
|--------------------------------------------------------------------------
| Antispam key
| Wil be written by JS in one hidden field of the form
| If not present when form post : spam
|--------------------------------------------------------------------------
|
*/
$config['form_antispam_key'] = "yourAntiSpamKey_ShouldContainsNumbersAndChars";


/**
|--------------------------------------------------------------------------
| Medias base folder
|--------------------------------------------------------------------------
|
| This value is set here so external libraries can access to this data
| Oinvoices uses the file_path stored in database.
| Take care : Changing manually this value will not change the media folder.
| Changing the medias folder from Oinvoices UI will change this value
|
*/
$config['files_path'] = 'files/';


/*
|--------------------------------------------------------------------------
| Cache Expiration
|--------------------------------------------------------------------------
|
| Number of minutes you wish the page to remain cached between refreshes.
| 0 / false : disables the cache system.
| The cache folder set in config.php in the setting "cache_path" must exists
| and be writable.
|
*/
$config['cache_expiration'] = '0';


/*
|--------------------------------------------------------------------------
| Maintenance allowed IPs
|--------------------------------------------------------------------------
|
| These IPs are allowed to see the front-end website when the website
| is in maintenance mode.
| Values here are automatically set by the Settings Advanced panel
|
*/
$config['maintenance'] = false;

$config['maintenance_ips'] = array (
);


/*
|--------------------------------------------------------------------------
| Compress HTML output
|--------------------------------------------------------------------------
|
| To remove useless whitespace from generated HTML
|
*/
$config['compress_html_output'] = '0';


/* End of file Oinvoices.php */
/* Location: ./application/config/Oinvoices.php */