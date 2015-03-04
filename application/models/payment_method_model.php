<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Company Model
*
* Author:  Abdul Manan
*
*/

class Payment_method_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('date');

	}


	//CRUD Start
	public function add($data){
		$this->db->insert('tblpayment_methods', $data);
		return ($this->db->_error_message()) ? $this->db->_error_message() : 'Record Added Successfully';
	}

	public function update($data){
		$this->db->where('id', $data['id']);
		$this->db->update('tblpayment_methods',$data);
		if ($data['default']=='1') {
			$this->db->where('id !=', $data['id']);
			$this->db->set('default','0');
			$this->db->update('tblpayment_methods');
		}
		return ($this->db->_error_message()) ? $this->db->_error_message() : 'Record Updated Successfully';
	}
	
	public function delete($id){
		if ($id > 0) {
			$this->db->where('id', $id);
			$this->db->limit(1,0);
			$this->db->delete('tblpayment_methods');
			return ($this->db->affected_rows() > 0) ? 'Record Deleted Successfully' : 'Error Deleting Record';
		}
		else {
			return "Select A Record to Delete";
		}
	}

	public function get($currencyId=NULL){
		$this->db->select('*')->from('tblpayment_methods');

		//single record
		if($currencyId) $this->db->where('id', $currencyId);
		if($currencyId) return $this->db->get()->row_array();
		
		//multiple list
		else return $this->db->get()->result_array();
		
	}
	public function getBySql($currencyId=NULL){
		

		$this->db->select('id as "currency_id",title as "currency_name",symbol_left as "currency_symbol_left", symbol_right as "currency_symbol_right"')->from('tblpayment_methods');

		//single record
		if($currencyId) $this->db->where('id', $currencyId);
		if($currencyId) return $this->db->get()->row_array();
		
		//multiple list
		else return $this->db->get()->result_array();
		
	}
	public function getJson(){
		$this->db->select('*')->from('tblpayment_methods')->where('is_enable','1');

		//multiple list
		return $this->db->get()->result_array();
	}
	
}