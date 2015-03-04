<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  customer Model
*
* Author:  Abdul Manan
*
*/

class Customer_model extends CI_Model
{
	public $comp_id;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
		$this->comp_id=$this->session->userdata('company_id');
	}


	//CRUD Start
	public function add($data,$company_id=NULL){
		$company_id = ($company_id)?$company_id: $this->comp_id;
		$data['company_id']=$company_id;
		$this->db->insert('tblcustomer', $data);

		return ($this->db->_error_message())? $this->db->_error_message() : "Customer Added Successfully ";
	}

	public function update($data,$company_id=NULL){
		$company_id = ($company_id)?$company_id: $this->comp_id;
		$this->db->where('id', $data['id']);
		$this->db->where('company_id', $company_id);
		$this->db->update('tblcustomer',$data);

		return ($this->db->_error_message()) ? $this->db->_error_message() : 'Record Updated Successfully';
	}

	public function delete($id,$company_id=NULL){
		$company_id = ($company_id)?$company_id: $this->comp_id;
		if ($id > 0) {
			$this->db->where('id', $id);
			$this->db->where('company_id', $company_id);
			$this->db->limit(1,0);
			$this->db->delete('tblcustomer');
			return ($this->db->affected_rows() > 0) ? 'Record Deleted Successfully' : 'Error Deleting Record';
		}
		else {
			return "Select A Record to Delete";
		}
	}

	public function getCustomer($customerId=NULL,$company_id=NULL,$data=array()){
		if (!empty($data)) {
			$this->db->limit($data['limit'], $data['offset']);
		}
		$company_id = ($company_id)?$company_id: $this->comp_id;
		$this->db->select('*')->from('tblcustomer');
		$this->db->where('company_id', $company_id);
		//single record
		if($customerId) $this->db->where('id', $customerId);
		if($customerId) return $this->db->get()->row_array();

        //multiple list
		else return $this->db->get()->result_array();
		
	}
	public function getcustomerBySql($customerId=NULL,$company_id=NULL){
		$company_id = ($company_id)?$company_id: $this->comp_id;
		
		$this->db->select('id as "customer_id",name as "customer_name",attn_name as "customer_attn_name",address1 as "customer_address",company_name as "customer_company_name",email as "customer_email",phone as "customer_phone"')->from('tblcustomer');
		$this->db->where('company_id', $company_id);
		
		//single record
		if($customerId) $this->db->where('id', $customerId);
		if($customerId) $result = $this->db->get()->row_array();
		
		
		
		//multiple list
		else $result = $this->db->get()->result_array();
		
		return $result; 
	}
	 public function rec_count($company_id=NULL) {
		$company_id = ($company_id)?$company_id: $this->comp_id;
		$this->db->where('company_id',$company_id);
         return $this->db->count_all_results("tblcustomer");
    }
	
}