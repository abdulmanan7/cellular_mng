<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Company Model
*
* Author:  Abdul Manan
*
*/

class Invoice_model extends CI_Model
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
        $data['total']='';
        $data['totaltax']='';
        $data['subtotal']='';

        foreach($data['product']['product_id'] as $key=>$val){
            $tax = $this->tax_details($data['product']['tax_type_id'][$key]);
            $data['subtotal']+=$data['product']['price'][$key]*$data['product']['qty'][$key];
            $data['totaltax']+=$data['product']['qty'][$key]*$data['product']['price'][$key]*$tax['percentage']/100;
            $data['total']=$data['subtotal']+$data['totaltax'];
        }

        $product= $data['product'];
        unset($data['product']);
        $this->db->insert('tblinvoice', $data);

        $invoiceID = $this->db->insert_id();
        $this->generate_fake_id($invoiceID);
        //Adding Invoice Status
        $inv_id = $this->db->select('id')
            ->where(array('is_default'=>'1','company_id'=>$company_id))
            ->get('tblinvoice_statuses')
            ->row_array();

		$invoice_status['invoice_statuses_id'] = $inv_id['id'];

		$invoice_status['invoice_id']=$invoiceID;
		$this->db->insert('tblinvoice_status', $invoice_status);

		//add details
		$product['inv_id']=$invoiceID;
		$this->_addInvoiceDetails($product);
		return ($this->db->_error_message()) ? $this->db->_error_message() : 'Record Added Successfully';
	}
	public function update($data,$company_id=NULL){
		$company_id = ($company_id)?$company_id: $this->comp_id;
		$data['company_id']=$company_id;
		$data['total']='';
		$data['totaltax']='';
		$data['subtotal']='';
		foreach($data['product']['product_id'] as $key=>$val){
				$tax = $this->tax_details($data['product']['tax_type_id'][$key]);
				$data['subtotal']+=$data['product']['price'][$key]*$data['product']['qty'][$key];
				$data['totaltax']+=$data['product']['qty'][$key]*$data['product']['price'][$key]*$tax['percentage']/100;
				$data['total']=$data['subtotal']+$data['totaltax'];
		}

		$product= $data['product'];
		unset($data['product']);
		$this->db->where('id',$data['id']);
		$this->db->where('company_id',$company_id);
		$this->db->update('tblinvoice', $data);
		$product['inv_id'] = $data['id'];
		//Updating details
		$this->updateInvoiceDetails($product);
		return ($this->db->_error_message()) ? $this->db->_error_message() : 'Record Updated Successfully';
	}
	private function updateInvoiceDetails($data,$user=NULL){
		$this->db->where('invoice_id', $data['inv_id']);
		foreach ($data['invoice_details_id'] as $key => $val) {
				$this->db->where('id', $val)->delete('tblinvoice_details');
				}
		$this->_addInvoiceDetails($data);

    }
    private function _addInvoiceDetails($data,$user=NULL){

        foreach($data['product_id'] as $key=>$val){
            $tax = $this->tax_details($data['tax_type_id'][$key]);
            $ins_data = array(

                'product_id' 				=> $val
            , 'invoice_id' 				=> $data['inv_id']
            , 'product_name' 			=> $data['product_name'][$key]
            , 'price' 					=> $data['price'][$key]
            , 'quantity' 				=> $data['qty'][$key]
            , 'product_description' 	=> $data['description'][$key]
            , 'tax_type_id' 			=> $data['tax_type_id'][$key]
            , 'tax_type_name' 			=> $tax['name']
            , 'tax_type_percentage' 	=> $tax['percentage']
            , 'product_total'       	=> $data['price'][$key]*$data['qty'][$key]*($tax['percentage']/100+1)
            );

            $this->db->insert('tblinvoice_details', $ins_data);

        }
        return true;
    }
    private function tax_details($tax_id,$company_id=NULL){
        $company_id = ($company_id)?$company_id: $this->comp_id;

        return $this->db->select('*')->where(array('id'=>$tax_id,'company_id'=>$company_id))->get('tbltaxtype')->row_array();

    }
    private function currency_symbol($id,$company_id=NULL){
        $company_id = ($company_id)?$company_id: $this->comp_id;

        return $this->db->select('*')->where(array('id'=>$id,'company_id'=>$company_id))->get('tblcurrency')->row_array();

    }

    public function delete($id,$company_id=NULL){
        $company_id = ($company_id)?$company_id: $this->comp_id;
        if ($id > 0) {
            $this->db->where('invoice_id', $id);
            $this->db->delete('tblinvoice_details');

            $this->db->where('id', $id);
            $this->db->where('company_id', $company_id);
            $this->db->limit(1,0);
            $this->db->delete('tblinvoice');

            return ($this->db->affected_rows() > 0) ? 'Record Deleted Successfully' : 'Error Deleting Record';
        }
    }

    public function getinvoice($invoiceId=NULL, $data=array(),$company_id=NULL){

        $company_id = ($company_id)?$company_id: $this->comp_id;
        $this->db->select('*')->where('company_id',$company_id)->order_by('id','DESC');
        if(!$invoiceId) return $this->db->get('tblinvoice')->result_array();
        else{

            $data['invoice']=$this->db->where('id',$invoiceId)->get('tblinvoice')->row_array();
            $data['invoice_details'] = $this->db->select('*')->where('invoice_id', $invoiceId)->get('tblinvoice_details')->result_array();

            return $data;
        }

    }

    /**
     * @param null $company_id
     * @param array $data
     * @return mixed
     */
    public function getinvoiceList($company_id = NULL, $data = array())
    {
        if (!empty($data)) {
            if (isset($data['start_date']) && isset($data['end_date']) && isset($data['status_id'])) {
                $qryResult=$this->filter($data['start_date'],$data['end_date'],$data['status_id'],Null);
                return $qryResult;
            } else {
                $this->db->limit($data['limit'], $data['offset'])->order_by('id', 'DESC');

            }

        }
        $company_id = ($company_id) ? $company_id : $this->comp_id;

		$qry='id,currency_symbol_left,currency_symbol_right,customer_name,current_time_stamp,total,customer_email,customer_id';
        $qryResult=$this->db->select($qry)->where('company_id',$company_id)->from('tblinvoice')->get()->result_array();
        foreach ($qryResult as $key => $value) {

            $qryResult[$key]['invoice_statuses_id']=$this->db->select()->from('tblinvoice_status')->where('invoice_id',$qryResult[$key]['id'])->order_by('time_stamp','desc')->get()->row('invoice_statuses_id');
            $invoice_statuses_id=$this->db->select()->from('tblinvoice_status')->where('invoice_id',$qryResult[$key]['id'])->order_by('time_stamp','desc')->get()->row('invoice_statuses_id');
            foreach ($qryResult as $k => $val) {
                $qryResult[$key]['invoice_status']=$this->db->select()->from('tblinvoice_statuses')->where('id',$invoice_statuses_id)->get()->row('name');
            }
            $qryResult[$key]['comment']=$this->db->select()->from('tblinvoice_status')->where('invoice_id',$qryResult[$key]['id'])->order_by('time_stamp','desc')->limit(1)->get()->row('comment');


				$this->load->model('transaction_model');

			$qryResult[$key]['paid'] = $this->transaction_model->invoiceBalance($value['id']);

			$qryResult[$key]['balance'] = $value['total'] - $qryResult[$key]['paid'];
		}
		return $qryResult;
	}
	private function recordExist($id){
		$this->db->select('*')->from('tblinvoice_details')->where('id',$id);
		$result=$this->db->get();
		if ($result->num_rows() > 0)return true;
	    else return false;
	}
    public function rec_count($company_id=NULL) {
        $company_id = ($company_id)?$company_id: $this->comp_id;
        $this->db->where('company_id',$company_id);
        return $this->db->count_all_results("tblinvoice");
    }

public function filter($start_dt,$end_dt,$status_id,$company_id=NuLL)
{
    $company_id = ($company_id) ? $company_id : $this->comp_id;
    $qry = "Select
           t1.id,t1.currency_symbol_left,t1.currency_symbol_right,t1.customer_name,t1.current_time_stamp, t1.total,t1.customer_email,
           t2.invoice_id,t3.id as 'invoice_statuses_id',t2.comment,
           t3.name as 'invoice_status'

                 FROM tblinvoice t1

                 JOIN tblinvoice_status t2 ON t2.`invoice_id` = t1.id

                 LEFT JOIN tblinvoice_status b2 ON b2.invoice_id = t2.invoice_id AND t2.`time_stamp` < b2.`time_stamp`
     LEFT JOIN tblinvoice_statuses t3 ON t2.invoice_statuses_id = t3.id

                 WHERE b2.`time_stamp` IS NULL
     AND t2.invoice_statuses_id = $status_id
     AND t1.company_id=$company_id
     AND t1.current_time_stamp BETWEEN '".$start_dt."' and '".$end_dt."'";
    return $this->db->query($qry)->result_array();
}

public function get_status($field, $company_id = NULL)
    {

        $company_id = ($company_id) ? $company_id : $this->comp_id;
        $id = $this->db->select('id')->where(array('company_id' => $company_id, 'name' => $field))->from('tblinvoice_statuses')->get()->row('id');
        $this->db->where('invoice_statuses_id', $id);
        return $this->db->count_all_results("tblinvoice_status");

    }
    private function  generate_fake_id($invoice_id){
        $data['invoice_id']=$invoice_id;
        $this->db->insert('fake_invoice',$data);
        $fake_id = $this->db->insert_id();
        return $fake_id;
    }
    public function add_recurring($data){
        $this->db->insert('tblrecurring',$data);
        $id=$this->db->insert_id();
        if($id > 0)
        {
            $this->db->insert('recurring_log',array('invoice_id'=>$data['invoice_id'],'recurring_id'=>$id));
            return true; // to the controller
        }
    }
}