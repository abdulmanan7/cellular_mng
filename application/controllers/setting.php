<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class setting extends CI_Controller {
	function __construct()
	{

		parent::__construct();
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
		else{
		$this->lang->load('setting');
		$this->lang->load('common');
		$this->load->model('invoice_model');
		$this->load->model('invoice_status_model');
		$this->load->model('company_model');
		$this->load->model('customer_model');
		$this->load->model('account_model');
		$this->load->model('taxtype_model');
		$this->load->model('invoice_status_model');
		$this->load->model('currency_model');

		}
	}
	public function index()
	{
		$this->company();
//        $data['record']=$this->company_model->getCompany();
//        $data['allcustomer']=$this->customer_model->getCustomer();
//        $data['allcurrency']=$this->currency_model->getcurrency();
//        $data['accountlist']=$this->account_model->getaccount();
//        $data['statuslist']=$this->invoice_status_model->get();
//        $data['taxlist']=$this->taxtype_model->gettax();
//		$data['page']='settings/tab';
//		$data['pageName']='settingPage';
//		$this->load->view('page',$data);
	}
	public function company(){
		$this->lang->load('company');
		$data["pageName"]="settingPage";
		$data['record']=$this->company_model->getCompany();
		$data['page']='settings/company';
		$this->load->view('page',$data);
	}
	public function customer(){
		$this->lang->load('customer');
		$data["pageName"]="settingPage";
		$data['allcustomer']=$this->customer_model->getCustomer();
		$data['page']='settings/customer';
		$this->load->view('page',$data);
	}
	public function currency(){
		$this->lang->load('currency');

        $offset = isset($_GET['page']) && (int)$_GET['page']!=0?$_GET['page']:1;
        $limit 	= LIMIT;
        $type 	= "all";

        $offset = ($offset > 1)? $limit*($offset - 1) : 0;

        $data['allcurrency']=$this->currency_model->getcurrency(null,null,$data=array('limit'=>$limit,'offset'=>$offset, $type='all'));

        //create pagination...
        $count = $this->currency_model->rec_count();
        $pagination_url = "setting/currency?type=$type";
        $data["links"] = $this->common_lib->pagination($pagination_url, $count , $limit);
        $data["pageName"]="settingPage";
        $data['page']='settings/currency';
        $this->load->view('page',$data);
	}
	public function status(){
		$this->lang->load('invoice');
        $offset = isset($_GET['page']) && (int)$_GET['page']!=0?$_GET['page']:1;
        $limit 	= LIMIT;
        $type 	= "all";

        $offset = ($offset > 1)? $limit*($offset - 1) : 0;

        $data['statuslist']=$this->invoice_status_model->get(NULL,NULL,$data=array('limit'=>$limit,'offset'=>$offset, $type='all'));

        //create pagination...
        $count = $this->invoice_status_model->rec_count();
        $pagination_url = "setting/status?type=$type";
        $data["links"] = $this->common_lib->pagination($pagination_url, $count , $limit);

        $data['page']='settings/status';
        $data['pageName']='settingPage';
        $this->load->view('page',$data);
	}
	public function tax(){
		$this->lang->load('taxtype');

        $offset = isset($_GET['page']) && (int)$_GET['page']!=0?$_GET['page']:1;
        $limit 	= LIMIT;
        $type 	= "all";

        $offset = ($offset > 1)? $limit*($offset - 1) : 0;

        $data['taxlist']=$this->taxtype_model->gettax(null,null,$data=array('limit'=>$limit,'offset'=>$offset, $type='all'));

        //create pagination...
        $count = $this->taxtype_model->rec_count();
        $pagination_url = "setting/tax?type=$type";
        $data["links"] = $this->common_lib->pagination($pagination_url, $count , $limit);

        $data['page']='settings/tax';
        $data['pageName']='settingPage';
        $this->load->view('page',$data);
	}
	public function changelogo(){
		$this->lang->load('taxtype');
		$data["pageName"]="settingPage";
		$data['record']=$this->company_model->getCompany();
		$data['page']='settings/changelogo';
		$this->load->view('page',$data);
	}
	public function account(){
		$this->lang->load('account');
		$offset = isset($_GET['page']) && (int)$_GET['page']!=0?$_GET['page']:1;
		$limit 	= LIMIT;
		$type 	= "all";
		
		$offset = ($offset > 1)? $limit*($offset - 1) : 0;
		
		$data['accountlist']=$this->account_model->getaccount(null,null,$data=array('limit'=>$limit,'offset'=>$offset, $type='all'));
		
		//create pagination...
		$count = $this->account_model->rec_count();
		$pagination_url = "setting/account?type=$type";
		$data["links"] = $this->common_lib->pagination($pagination_url, $count , $limit);
		$data['page']='settings/account';
		$data['pageName']='settingPage';
		$this->load->view('page',$data);
	}
}