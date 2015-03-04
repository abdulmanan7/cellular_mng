<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Company Model
*
* Author:  Abdul Manan
*
*/

class Company_model extends CI_Model
{
	public $comp_id;
	public function __construct()
	{
		parent::__construct();
		$this->comp_id=$this->session->userdata('company_id');
	}


	//Coomon Database Functions
	public function update($data,$company_id=Null){
		$company_id = ($company_id)?$company_id: $this->comp_id;
		$this->db->where('id',$company_id)->update('tblcompany',$data);
		return ($this->db->affected_rows() > 0) ? $this->db->_error_message() : 'Record Updated Successfully';
	}
	public function updateLogo($data,$company_id=Null){
		$company_id = ($company_id)?$company_id: $this->comp_id;
		$this->db->where('id',$company_id)->set('logo',$data['logo'])->update('tblcompany',$data);
		return ($this->db->affected_rows() > 0) ? $this->db->_error_message() : 'Logo has been successfully change';
	}

	public function getCompany($company_id=Null){
		$company_id = ($company_id)?$company_id: $this->comp_id;
		$this->db->select('*')->from('tblcompany');

		//single record
		if($company_id) $this->db->where('id', $company_id);

		//multiple list
		return $this->db->get()->row_array();
	}
	public function getField($field,$companyId=Null){
		$comp_id =($companyId)? $companyId : $this->comp_id;
		$this->db->select($field)->from('tblcompany')->where('id',$comp_id);
		return $this->db->get()->row($field);
	}
	public function getCompanyBySql($qry=Null,$company_id=NULL){
		$company_id = ($company_id)?$company_id: $this->comp_id;

		$qry=($qry) ? $qry : 'id as "company_id",name as "company_name",attn_name as "company_attn_name",address1 as "company_address1",address2 as "company_address2",postcode as "company_postcode",email as "company_email",phone as "company_phone",fax as "company_fax",registration_no as "company_registration_no",VAT_no as "company_VAT_no"' ;

        $this->db->select($qry);

		$this->db->where('id', $company_id);

        return $this->db->get("tblcompany")->row_array();
	}
	public function add($data){

	   $this->db->trans_start();

	   $this->db->insert('tblcompany',$data);
	   $insert_id = $this->db->insert_id();

	   $this->db->trans_complete();
	   return  $insert_id;
	}
	public function get_field($field,$company_id=Null){
        $company_id = ($company_id)?$company_id: $this->comp_id;
        $this->db->select($field)->from('tblcompany');

        //single record
        if($company_id) $this->db->where('id', $company_id);

        //multiple list
        return $this->db->get()->row($field);
	}

}