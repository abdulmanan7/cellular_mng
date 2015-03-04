<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Common_lib
{

/**
	 * Common Function 
	 *
	 * @var array
**/
	public $ci;

public function __construct()
	{
		// parent::__construct();
		$this->ci =& get_instance();
	}
		function pagination($pagination_url, $total, $limit){
			$this->ci->load->library('pagination');
			$config['base_url'] = base_url().$pagination_url;
			$config['total_rows'] = $total;
			$config['per_page'] = $limit;
			 // $config["uri_segment"] = 3;
			$config['query_string_segment'] = 'page';
			//formating
			$config['full_tag_open'] = '<ul class="pagination pagination-sm pull-right">';
			$config['full_tag_close'] = '</ul>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a>';
			$config['cur_tag_close'] = '</a></li>';
			$config['next_link'] = '&gt;';
			$config['first_tag_open'] = '<li>';
			$config['first_link'] = '&lt;&lt;';
			$config['first_tag_open'] = '<li>';
			$config['last_tag_open'] = '<li>';
			$config['last_link'] = '&gt;&gt;';
			$config['last_tag_open'] = '<li>';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['prev_link'] = '&lt;';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			//end formating
			$config['use_page_numbers'] = TRUE;
			$config['page_query_string'] = TRUE;
			$this->ci->pagination->initialize($config);
			return $pagination = $this->ci->pagination->create_links();
		}
}