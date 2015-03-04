<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Company Model
*
* Author:  Abdul Manan
*
*/

class Products_model extends CI_Model
{
	public $comp_id;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
		$this->comp_id =$this->session->userdata('company_id');
	}


	//CRUD Start
	public function add($data,$company_id=NULL){

		$company_id = ($company_id)?$company_id: $this->comp_id;
		$data['company_id']=$company_id;

		$this->db->insert('tblproducts', $data);
		return ($this->db->_error_message()) ? $this->db->_error_message() : 'Record Added Successfully';
	}

	public function update($data,$company_id=NULL){
		$company_id = ($company_id)?$company_id: $this->comp_id;
		$data['company_id']=$company_id;
		$this->db->where('id', $data['id']);
		$this->db->where('company_id', $company_id);
		$this->db->update('tblproducts',$data);
		return ($this->db->affected_rows() > 0) ? $this->db->_error_message() : 'Record Updated Successfully';

	}
	public function delete($id,$company_id=NULL){
		$company_id = ($company_id)?$company_id: $this->comp_id;
		if ($id > 0) {
			$this->db->where('id', $id);
			$this->db->where('company_id', $company_id);
			$this->db->limit(1,0);
			$this->db->delete('tblproducts');
		return ($this->db->affected_rows() > 0) ? 'Record Deleted Successfully' : 'Error Deleting Record';
	}
}

	public function getProduct($productId=NULL,$company_id=NULL,$data=array()){
		if (!empty($data)) {
		   $this->db->limit($data['limit'], $data['offset']);
		}
		$company_id = ($company_id)?$company_id: $this->comp_id;
		$this->db->select('*')->from('tblproducts')->where('company_id',$company_id);

		//single record
		if($productId) $this->db->where('id', $productId);
		if($productId) return $this->db->get()->row_array();

		//multiple list
		else return $this->db->get()->result_array();

	}
	//This function is used for populating dropdown list.
     function get_products($q,$company_id=NULL){
     	$company_id = ($company_id)?$company_id: $this->comp_id;
	    $this->db->select('*');
		$this->db->where('company_id', $company_id);
	    $this->db->like('name', $q);
	    $query = $this->db->get('tblproducts');
	    if($query->num_rows > 0){
	      foreach ($query->result_array() as $row){
	        $new_row['id']=htmlentities(stripslashes($row['id']));
	        $new_row['label']=htmlentities(stripslashes($row['name']));
	        $new_row['price']=htmlentities(stripslashes($row['price']));
	        $row_set[] = $new_row; //build an array
	      }
	      echo json_encode($row_set); //format the array into json data
	    }
  }
   public function rec_count($company_id=NULL) {
		$company_id = ($company_id)?$company_id: $this->comp_id;
		$this->db->where('company_id',$company_id);
       return $this->db->count_all_results("tblproducts");
    }
}