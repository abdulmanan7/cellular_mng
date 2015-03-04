<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Company Model
*
* Author:  Abdul Manan
*
*/

class Currency_model extends CI_Model
{
    public $comp_id;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        $this->comp_id = $this->session->userdata('company_id');

    }


    //CRUD Start
    public function add($data, $company_id = NULL)
    {
        $company_id = ($company_id) ? $company_id : $this->comp_id;
        $data['company_id'] = $company_id;
        $this->db->insert('tblcurrency', $data);

        return ($this->db->_error_message()) ? $this->db->_error_message() : 'Record Added Successfully';
    }

    public function update($data, $company_id = NULL)
    {
        $company_id = ($company_id) ? $company_id : $this->comp_id;
        $data['company_id'] = $company_id;
        $this->db->where('id', $data['id']);
        $this->db->where('company_id', $company_id);
        $this->db->update('tblcurrency', $data);
        if ($data['default'] == '1') {
            $this->db->where('id !=', $data['id']);
            $this->db->where('company_id', $company_id);
            $this->db->set('default', '0');
            $this->db->update('tblcurrency');
        }
        return ($this->db->_error_message()) ? $this->db->_error_message() : 'Record Updated Successfully';
    }

    public function delete($id, $company_id = NULL)
    {
        $company_id = ($company_id) ? $company_id : $this->comp_id;
        if ($id > 0 && !$this->is_default($id, $company_id)) {
            $this->db->where('id', $id);
            $this->db->where('company_id', $company_id);
            $this->db->limit(1, 0);
            $this->db->delete('tblcurrency');
            return ($this->db->affected_rows() > 0) ? 'Record Deleted Successfully' : 'Error Deleting Record';
        } else {
            return "Either you are Deleting a Default Currency or the record id is not valid";
        }
    }

    public function getcurrency($currencyId = NULL, $company_id = NULL, $data = array())
    {
        if (!empty($data)) {
            $this->db->limit($data['limit'], $data['offset']);
        }

        $company_id = ($company_id) ? $company_id : $this->comp_id;
        $this->db->select('*')->from('tblcurrency');
        $this->db->where('company_id', $company_id)->order_by('default', 'DESC');
        //single record
        if ($currencyId) $this->db->where('id', $currencyId);
        if ($currencyId) return $this->db->get()->row_array();

        //multiple list
        else return $this->db->get()->result_array();

    }

    public function getcurrencyBySql($currencyId = NULL, $company_id = NULL)
    {
        $company_id = ($company_id) ? $company_id : $this->comp_id;

        $this->db->select('id as "currency_id",title as "currency_name",symbol_left as "currency_symbol_left", symbol_right as "currency_symbol_right"')
            ->from('tblcurrency')
            ->where('company_id', $company_id);

        //single record
        if ($currencyId) $result = $this->db->where('id', $currencyId);
        if ($currencyId) $result = $this->db->get()->row_array();

        //multiple list
        else $result = $this->db->get()->result_array();

        return $result;
    }

    public function getDefaultCurrency($field=NULL,$company_id = NULL)
    {
        $field=($field)?$field:'*';
        $company_id = ($company_id) ? $company_id : $this->comp_id;
        $this->db->select($field)->from('tblcurrency');
        $this->db->where('company_id', $company_id);
        //single record
        $this->db->where('default', '1');
        $this->db->where('status', '1');
        if($field=='*'){return $this->db->get()->row_array();}
        else return $this->db->get()->row($field);
    }

    public function rec_count($company_id = NULL)
    {
        $company_id = ($company_id) ? $company_id : $this->comp_id;
        $this->db->where('company_id', $company_id);
        return $this->db->count_all_results("tblcurrency");
    }

    public function is_default($Id, $company_id = NULL)
    {
        $company_id = ($company_id) ? $company_id : $this->comp_id;
        $this->db->where('company_id', $company_id);
        $this->db->where('default', '1');
        $this->db->where('id', $Id);
        $query = $this->db->get('tblcurrency');
        return ($query->num_rows() > 0) ? TRUE : FALSE;
    }
}