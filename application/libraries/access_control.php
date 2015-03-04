<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Access_control
{

/**
	 * caching of users and their groups
	 *
	 * @var array
**/
	public $user_group;

	public $controller;
	
	public $groupId;

public function __construct()
	{
		// parent::__construct();
		$CI =& get_instance();
		$CI->load->helper('url','language','cookie','array');
		$CI->load->model('access_control_model');
		$CI->load->library('session');
		$this->validate();

		//enabled for debugging...
		// $CI->output->enable_profiler(TRUE);
	}
	public function validate(){
		$CI =& get_instance();

		//get Current Controller User Want to Access.
		$data['controller'] = $CI->router->fetch_class();
		$data['method'] = $CI->router->fetch_method();
		
		$validate = $CI->access_control_model->validate($data);
		
		if(!$validate){
			
			//display the message of error FROM LANGUAGE FILE
			$message=$CI->lang->line('admin_message');
			redirect('auth/login','refresh');
			//die;

		}
	}
	

}