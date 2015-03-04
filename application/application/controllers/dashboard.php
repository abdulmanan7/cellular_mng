<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in())
		{	//if not login it will be redirected to login page
			redirect('auth/login');
		}
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));
		$this->lang->load('common');
		$this->lang->load('auth');
		$this->load->model('products_model');
		$this->load->model('customer_model');
		$this->load->model('invoice_model');

	}
	public function index($page='template/about')
	{
			$data['page']='template/dashboard';
			$data['users']=$this->users();
        	$data['status'] = $this->status();
			$data['allproducts']=$this->products();
			$data['allcustomer']=$this->customers();
			$data['allinvoice']=$this->invoice();
			$data['pageName']='dashboardPage';
        $data['products'] = $this->products_model->rec_count();
        $data['users_count'] = $this->ion_auth->rec_count();
        $data['customers'] = $this->customer_model->rec_count();
        $data['invoices'] = $this->invoice_model->rec_count();
			$this->load->view('page',$data);

	}

	public function users(){

        $data = $this->ion_auth->get(Null,NULL, $data = array('limit' => 5, 'offset' => 0, $type = 'all'));
        $result =toArray($data);

        return $result;
	}
	public function products(){
		$data = $this->products_model->getProduct(Null,NULL, $data = array('limit' => 5, 'offset' => 0, $type = 'all'));

		return $data;
	}
	public function customers(){
		$data = $this->customer_model->getCustomer(Null,NULL, $data = array('limit' => 5, 'offset' => 0, $type = 'all'));

		return $data;
	}
	public function invoice(){
		$offset = isset($_GET['page']) && (int)$_GET['page']!=0?$_GET['page']:1;
		$limit 	= 5;
		$type 	= "all";

		$offset = ($offset > 1)? $limit*($offset - 1) : 0;

		$data=$this->invoice_model->getInvoiceList(NULL,$data=array('limit'=>$limit,'offset'=>$offset, $type='all'));
		return $data;
	}

    public function status()
    {
        $total_invoice = $this->invoice_model->rec_count();
        if($total_invoice<=0){
            $data['total_invoice']=0;
            $data['paid']=0;
            $data['unpaid']=0;
        }
        else {
            $paid = $this->invoice_model->get_status('Paid');

            $data['total_invoice'] = $total_invoice > 0 ? (floatFormat($total_invoice / $total_invoice * 100, 0)) : 0;
            $data['paid'] = $total_invoice > 0 ? floatFormat($paid / $total_invoice * 100, 0) : 0;
            $data['unpaid'] = floatFormat(100 - $data['paid'], 0);
        }
            return $data;
    }
}