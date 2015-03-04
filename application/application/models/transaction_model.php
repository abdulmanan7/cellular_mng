<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Company Model
*
* Author:  Abdul Manan
*
*/

class transaction_model extends CI_Model
{
    public $comp_id;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
        $this->comp_id=$this->session->userdata('company_id');

	}


	//CRUD Start
	public function add($data){
		$this->db->insert('tbltransaction', $data);
		return ($this->db->_error_message()) ? $this->db->_error_message() : 'Record Added Successfully';
	}

	public function processPayment($data,$companyId=NULL){
		$comp_id=($companyId)? $companyId : $this->comp_id;
		$data['company_id']=$comp_id;
		$data['account']=ACCOUNT_ID;
		$payment_status=$data['payment_status'];
		$inv_id=$data['invoice_id'];
		unset($data['invoice_id']);
		unset($data['payment_status']);

		$this->db->trans_start();
			$this->db->insert('tbltransaction', $data);
			// $tran_id=$this->db->insert_id();
			$pp_data=array('invoice_id'=>$inv_id,'company_id'=>$this->comp_id,'transaction_id'=>$this->db->insert_id());
			$this->payment_invoice($pp_data);

			//get current balance... (query copy... ) invoice_id, CALCULATE BALANCE...
			$sdata=array('invoice_id'=>$inv_id,'invoice_statuses_id'=>$payment_status);
			$this->add_status($sdata);

		$this->db->trans_complete();

		return ($this->db->_error_message()) ? $this->db->_error_message() : 'Record Added Successfully';
	}

	public function invoiceBalance($inv_id = NULL, $companyId = NULL){

		$comp_id=($companyId)? $companyId : $this->comp_id;

		$balQuery = "select IFNULL(sum(amount*type), 0) as paid from (
					SELECT tblpayment_invoice.transaction_id, tbltransaction.amount, tbltransaction.type  FROM `tblpayment_invoice`, tbltransaction
					where tblpayment_invoice.invoice_id = ".$inv_id."
					and tbltransaction.id = tblpayment_invoice.transaction_id
					and tbltransaction.company_id = '".$comp_id."'

				) as temp_transaction
				";

		$bal = $this->db->query($balQuery)->row_array();

		return $bal['paid'];

	}

	public function payment_invoice($data){
		$this->db->insert('tblpayment_invoice', $data);
		// return ($this->db->_error_message()) ? $this->db->_error_message() : $this->db->insert_id();
	}
	public function update($data){

		$this->db->where('id', $data['id']);
		$this->db->update('tbltransaction',$data);
		if ($data['default']=='1') {
			$this->db->where('id !=', $data['id']);
			$this->db->set('default','0');
			$this->db->update('tbltransaction');
		}
		return ($this->db->_error_message()) ? $this->db->_error_message() : 'Record Updated Successfully';
	}

	public function delete($id){
		if ($id > 0) {
			$this->db->where('id', $id);
			$this->db->limit(1,0);
			$this->db->delete('tbltransaction');
			return ($this->db->affected_rows() > 0) ? 'Record Deleted Successfully' : 'Error Deleting Record';
		}
		else {
			return "Select A Record to Delete";
		}
	}

	public function gettransaction($cus_id=NULL,$transactionId=NULL){

		$this->db->select('*')->from('tbltransaction');

		//single record
		if($transactionId){ 
			$this->db->where('id', $transactionId);
			return $this->db->get()->row_array();
			}
		if($cus_id) {
			$this->db->where('customer_id', $cus_id);
		}

		//multiple list
		return $this->db->get()->result_array();

	}
	public function gettransactionBySql($transactionId=NULL){


		$this->db->select('id as "transaction_id",title as "transaction_name",symbol_left as "transaction_symbol_left", symbol_right as "transaction_symbol_right"')->from('tbltransaction');

		//single record
		if($transactionId) $this->db->where('id', $transactionId);
		if($transactionId) return $this->db->get()->row_array();

		//multiple list
		else return $this->db->get()->result_array();

	}
	public function getDefaulttransaction(){
		$this->db->select('*')->from('tbltransaction');
		//single record
		$this->db->where('default','1');
		return $this->db->get()->row_array();
	}
	public function add_status($data){
		$this->db->insert('tblinvoice_status', $data);
	}

}