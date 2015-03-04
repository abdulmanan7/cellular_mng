<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Company Model
*
* Author:  Abdul Manan
*
*/

class Reports_model extends CI_Model
{
	public $comp_id;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
		$this->comp_id=$this->session->userdata('company_id');
	}


	//CRUD Start
	private function tax_details($tax_id,$company_id=NULL){
		$company_id = ($company_id)?$company_id: $this->comp_id;
		return $this->db->select('*')->where(array('id'=>$tax_id,'company_id'=>$company_id))->get('tbltaxtype')->row_array();
	}
	private function get_customer($cus_id){
		return $this->db->select('id ,name')->where('id',$cus_id)->get('tblcustomer')->row_array();
	}
	private function currency_symbol($id,$company_id=NULL){
		$company_id = ($company_id)?$company_id: $this->comp_id;
		return $this->db->select('*')->where(array('id'=>$id,'company_id'=>$company_id))->get('tblcurrency')->row_array();
	}
    public function get($curr_id=NULL, $data=array(),$company_id=NULL,$cus_id=NULL){
			$company_id = ($company_id)?$company_id: $this->comp_id;
			$qry="id,customer_id,customer_name,currency_symbol_left,currency_symbol_right,total,subtotal,totaltax";
			$this->db->select($qry)->where('company_id',$company_id);
			$this->db->select($qry)->where('currency_id',$curr_id);
		if ($cus_id) {
			$result=$this->db->where('customer_id',$cus_id)->get('tblinvoice')->result_array();
			foreach ($result as $key => $value) {
				$result[$key]['invoice_statuses_id']=$this->db->select()->from('tblinvoice_status')->where('invoice_id',$result[$key]['id'])->order_by('time_stamp','desc')->get()->row('invoice_statuses_id');
				$invoice_statuses_id=$this->db->select()->from('tblinvoice_status')->where('invoice_id',$result[$key]['id'])->order_by('time_stamp','desc')->get()->row('invoice_statuses_id');
				// foreach ($result as $k => $val) {
					$result[$key]['invoice_status']=$this->db->select()->from('tblinvoice_statuses')->where('id',$invoice_statuses_id)->get()->row('name');
				// }
				$result[$key]['comment']=$this->db->select()->from('tblinvoice_status')->where('invoice_id',$result[$key]['id'])->order_by('time_stamp','desc')->limit(1)->get()->row('comment');

			}
			$result['sum']=$this->get_total($cus_id,$company_id);
		}
		else{
			$result=$this->db->get('tblinvoice')->result_array();
			foreach ($result as $key => $value) {
				$result[$key]['invoice_statuses_id']=$this->db->select()->from('tblinvoice_status')->where('invoice_id',$result[$key]['id'])->order_by('time_stamp','desc')->get()->row('invoice_statuses_id');
				$invoice_statuses_id=$this->db->select()->from('tblinvoice_status')->where('invoice_id',$result[$key]['id'])->order_by('time_stamp','desc')->get()->row('invoice_statuses_id');
				// foreach ($result as $k => $val) {
					$result[$key]['invoice_status']=$this->db->select()->from('tblinvoice_statuses')->where('id',$invoice_statuses_id)->get()->row('name');
				// }
				$result[$key]['comment']=$this->db->select()->from('tblinvoice_status')->where('invoice_id',$result[$key]['id'])->order_by('time_stamp','desc')->limit(1)->get()->row('comment');

			}
			$result['sum']=$this->get_total();
		}
		return $result;



	}
	public function get_total($cus_id=NULL,$company_id=NULL,$st_date=Null,$end_date=Null){
		$company_id = ($company_id)?$company_id: $this->comp_id;
		$qry="count(*) as Orders, sum(total) as total,sum(totaltax) as totaltax,sum(subtotal) as subtotal";
		// $qry='id,currency_symbol_left,currency_symbol_right,customer_name,current_time_stamp,total,customer_email,';
		$this->db->select($qry)->where('company_id',$company_id);
		if($st_date && $end_date){
		 $this->db->where('last_modified_ts >=', $st_date);
		 $this->db->where('last_modified_ts <=', $end_date);
		}
		if ($cus_id) {
			$qryResult=$this->db->where('customer_id', $cus_id)->get('tblinvoice')->row_array();
		}
		else{
			$qryResult=$this->db->get('tblinvoice')->row_array();
		}

		return $qryResult;
	}
	private function recordExist($id){
		$company_id = ($company_id)?$company_id: $this->comp_id;
		$this->db->select('*')->from('tblinvoice_details')->where('id',$id);
		$result=$this->db->get();
		if ($result->num_rows() > 0)return true;
	    else return false;
	}
	public function search($cur_id,$start_date,$end_date,$customer_id=Null){
			$company_id = $this->comp_id;
			$qry="id,customer_id,customer_name,currency_symbol_left,currency_symbol_right,total,subtotal,totaltax";

			$this->db->select($qry)->where('company_id',$company_id);
			if($cur_id)$this->db->where('currency_id',$cur_id);
			$this->db->where("current_time_stamp BETWEEN '$start_date' AND '$end_date'");

		if ($customer_id) {
			$result=$this->db->where('customer_id',$customer_id)->get('tblinvoice')->result_array();
			foreach ($result as $key => $value) {
				$result[$key]['invoice_statuses_id']=$this->db->select()->from('tblinvoice_status')->where('invoice_id',$result[$key]['id'])->order_by('time_stamp','desc')->get()->row('invoice_statuses_id');
				$invoice_statuses_id=$this->db->select()->from('tblinvoice_status')->where('invoice_id',$result[$key]['id'])->order_by('time_stamp','desc')->get()->row('invoice_statuses_id');
				// foreach ($result as $k => $val) {
					$result[$key]['invoice_status']=$this->db->select()->from('tblinvoice_statuses')->where('id',$invoice_statuses_id)->get()->row('name');
				// }
				$result[$key]['comment']=$this->db->select()->from('tblinvoice_status')->where('invoice_id',$result[$key]['id'])->order_by('time_stamp','desc')->limit(1)->get()->row('comment');

                $result['sum']=$this->get_total($customer_id,$company_id,$start_date,$end_date);
            }
		}
		else{
			$result=$this->db->get('tblinvoice')->result_array();
				foreach ($result as $key => $value) {
				$result[$key]['invoice_statuses_id']=$this->db->select()->from('tblinvoice_status')->where('invoice_id',$result[$key]['id'])->order_by('time_stamp','desc')->get()->row('invoice_statuses_id');
				$invoice_statuses_id=$this->db->select()->from('tblinvoice_status')->where('invoice_id',$result[$key]['id'])->order_by('time_stamp','desc')->get()->row('invoice_statuses_id');
				// foreach ($result as $k => $val) {
					$result[$key]['invoice_status']=$this->db->select()->from('tblinvoice_statuses')->where('id',$invoice_statuses_id)->get()->row('name');
				// }
				$result[$key]['comment']=$this->db->select()->from('tblinvoice_status')->where('invoice_id',$result[$key]['id'])->order_by('time_stamp','desc')->limit(1)->get()->row('comment');

                    $result['sum']=$this->get_total(NULL,Null,$start_date,$end_date);
                }
		}
        return $result;
	}
	 public function rec_count($company_id=NULL) {
		$company_id = ($company_id)?$company_id: $this->comp_id;
		$this->db->where('company_id',$company_id);
         return $this->db->count_all_results("tblinvoice");
    }
}