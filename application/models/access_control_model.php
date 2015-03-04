<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Access_control_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

public function getbykey($key){
		$qry="select controller from access_controller where group_id=?";
		$qry=$this->db->query($qry,$key);
		if ($qry->num_rows() > 0) {
			foreach ($qry->result() as $row) {
				$record[]=$row;
			}
			return $record;
		}
		return $qry->result();
	}

	public function validate($data, $userId=NULL){

		$CI =& get_instance();

		$userId = ($userId)?$userId:$CI->session->userdata['user_id'];
		$controller = $data['controller'];
		$method = $data['method'];
		
		$group_array = $CI->db->select('group_id')->where('user_id', $userId)->get('users_groups')->result_array();
		
		foreach($group_array as $val):

			$checkster = $CI->db->where('group_id',$val['group_id'])->where('controller', $controller)->where('method','*')->get('access_control');
			if($checkster->num_rows() > 0) continue;

			$checkRight = $CI->db->where('group_id',$val['group_id'])->where('controller', $controller)->where('method',$method)->get('access_control'); 
			if($checkRight->num_rows() > 0) continue;

			return true;

		endforeach;

		return false; 


	}

}