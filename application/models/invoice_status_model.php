<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Status Model
*
* Author:  Abdul Manan
*
*/

class Invoice_status_model extends CI_Model
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
        if ($data['is_default']) {
            if (!$data['is_enable']) {
                return "You have to make it Enable first.";
                die;
            } else {
                    $this->db->where('company_id', $data['company_id']);
                    $this->db->set('is_default', '0');
                    $this->db->update('tblinvoice_statuses');
             }
        }
			$this->db->insert('tblinvoice_statuses', $data);
			return ($this->db->_error_message()) ? $this->db->_error_message() : 'Record Added Successfully';
	}

	public function update($data,$company_id=NULL){
		$company_id = ($company_id)?$company_id: $this->comp_id;
		$data['company_id']=$company_id;
		$this->db->where('id', $data['id']);
		$this->db->where('company_id', $company_id);
		$this->db->where('is_system !=', '1');
				if ($data['is_default']) {
					if (!$data['is_enable']) {
						return "You have to make it Enable first.";
						die;
					}
					else{
							$this->db->update('tblinvoice_statuses',$data);
							$this->db->where('id !=', $data['id']);
							$this->db->set('is_default','0');
							$this->db->update('tblinvoice_statuses');
					}
				}
				else{
					$this->db->update('tblinvoice_statuses',$data);
						return ($this->db->_error_message()) ? $this->db->_error_message() : 'Atlest one Status must be default.';
				}
}

	public function delete($id, $company_id=NULL){
        $company_id=$company_id?$company_id:$this->comp_id;
		if ($id > 0 && !$this->is_default($id,$company_id)) {
			$this->db->where('id', $id);
			$this->db->where('company_id', $company_id);
			$this->db->limit(1,0);
			$this->db->delete('tblinvoice_statuses');
			return ($this->db->affected_rows() > 0) ? 'Record Deleted Successfully' : 'Error Deleting Record';
		}
		else {
			return "Select A Record to Delete";
		}
	}

	public function get($invoice_statusesId=NULL,$company_id=NULL,$data=array()){
			if (!empty($data)) {
				$this->db->limit($data['limit'], $data['offset']);
			}
		$company_id = ($company_id)?$company_id: $this->comp_id;
		$this->db->select('*')->from('tblinvoice_statuses')->where('company_id',$company_id)->order_by('is_default','DESC');
		//single record
		if($invoice_statusesId) $this->db->where('id', $invoice_statusesId);
		if($invoice_statusesId) return $this->db->get()->row_array();

		//multiple list
		else return $this->db->get()->result_array();

	}
	public function get_st($Id=NULL,$company_id=NULL){
		$company_id = ($company_id)?$company_id: $this->comp_id;
		$qryResult=$this->db->select()->from('tblinvoice_status')->where('invoice_id',$Id)->get()->result_array();
		foreach ($qryResult as $key => $value) {
			$qryResult[$key]['name']=$this->db->select()->from('tblinvoice_statuses')->where(array('id'=>$qryResult[$key]['invoice_statuses_id'],'company_id'=>$company_id))->get()->row('name');
		}

        return $qryResult;

	}
	public function get_st_last($Id=NULL,$company_id=NULL){
		$company_id = ($company_id)?$company_id: $this->comp_id;
		$qryResult=$this->db->select()->from('tblinvoice_status')->where('invoice_id',$Id)->order_by('time_stamp','desc')->limit(1)->get()->row_array();
			$qryResult['status']=$this->db->select()->from('tblinvoice_statuses')->where(array('id'=>$qryResult['invoice_statuses_id'],'company_id'=>$company_id))->get()->row('name');

		 return $qryResult;
	}
	public function getdefault($limit=1,$company_id=NULL){
		$company_id = ($company_id)?$company_id: $this->comp_id;
		$query=$this->db->get_where('tblinvoice_statuses',array('is_default' => '1','company_id'=>$company_id),$limit);
		return $query->row_array();
	}
	public function getstatusjson($limit=1){
		// $query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        $query = $this->db->get_where('tblinvoice_statuses', array('is_default' => '1', 'company_id' => $this->comp_id), $limit);

		return $query->row_array();
	}
	 public function add_details($data){
		$this->db->insert('tblinvoice_status', $data);
		return ($this->db->_error_message()) ? $this->db->_error_message() : 'Record Added Successfully';
	}
	 public function rec_count($company_id=NULL) {
		$company_id = ($company_id)?$company_id: $this->comp_id;
		$this->db->where('company_id',$company_id);
         return $this->db->count_all_results("tblinvoice_statuses");
    }
    public function is_default($Id, $company_id = NULL)
    {
        $company_id = ($company_id) ? $company_id : $this->comp_id;
        $this->db->where('company_id', $company_id);
        $this->db->where('is_default', '1');
        $this->db->where('id', $Id);
        $query = $this->db->get('tblinvoice_statuses');
        return ($query->num_rows() > 0) ? TRUE : FALSE;
    }
}