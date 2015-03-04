<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Account Model
*
* Author:  Abdul Manan
*
*/

class Account_model extends CI_Model
{
	public $comp_id;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
		$this->comp_id=$this->session->userdata('company_id');

	}


	//CRUD Start
	public function add($data, $company_id = NULL){
		$company_id = ($company_id)?$company_id: $this->comp_id;
		$data['company_id']=$company_id;
		$this->db->insert('tblaccount', $data);
		return ($this->db->_error_message()) ? $this->db->_error_message() : 'Record Added Successfully';

	}

	public function update($data,$company_id = NULL){
		$company_id = ($company_id)?$company_id: $this->comp_id;
		$data['company_id']=$company_id;
		$this->db->where('id', $data['id']);
		$this->db->where('company_id', $company_id);
		$this->db->update('tblaccount',$data);

		return ($this->db->_error_message()) ? $this->db->_error_message() : 'Record Updated Successfully';
	}
	
	public function delete($id,$company_id = NULL){
		$company_id = ($company_id)?$company_id: $this->comp_id;
		if ($id > 0) {
			$this->db->where('id', $id);
			$this->db->where('company_id', $company_id);
			$this->db->limit(1,0);
			$this->db->delete('tblaccount');
			return ($this->db->affected_rows() > 0) ? 'Record Deleted Successfully' : 'Error Deleting Record';
		}
		else {
			return "Select A Record to Delete";
		}
	}

	public function getaccount($accountId=NULL,$company_id = NULL,$data=array()){
		if (!empty($data)) {
			$this->db->limit($data['limit'], $data['offset']);
		}
		$company_id = ($company_id)?$company_id: $this->comp_id;
		$this->db->select('*')->from('tblaccount');
		$this->db->where('company_id',$company_id);
		//single record
		if($accountId) $this->db->where('id', $accountId);
		if($accountId) return $this->db->get()->row_array();
		
		//multiple list
		else return $this->db->get()->result_array();
		
	}
	 public function rec_count($company_id=NULL) {
		$company_id = ($company_id)?$company_id: $this->comp_id;
		$this->db->where('company_id',$company_id);
         return $this->db->count_all_results("tblaccount");
    }
}