<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
		else{
			$this->load->model('invoice_model');
			$this->load->model('invoice_details_model');
			$this->load->model('invoice_status_model');
			$this->load->model('company_model');
			$this->load->model('reports_model');
			$this->load->model('customer_model');
			$this->load->model('invoice_status_model');
			$this->load->model('currency_model');
			$this->lang->load('reports');
		}

		//$this->output->enable_profiler(TRUE);


	}
	public function index(){
        $curr_id=$this->currency_model->getDefaultCurrency('id');
        $data['reports']=$this->reports_model->get($curr_id);
        $data['currency_id'] = $curr_id;
        $data['reports']['customer']=$this->customer_model->getCustomer();
        $data['reports']['currency']=$this->currency_model->getCurrency();
		$data['page']='reports/reports';
		$data['pageName']='reportsPage';
		$this->load->view('page',$data);
	}

    /**
     *
     */
    function search(){
		if(isset($_GET['submit'])) {
            $start_date = date('Y-m-d H:i:s', strtotime($_GET['start_date']));
            $end_date = date('Y-m-d H:i:s', strtotime($_GET['end_date'] . " 23:59:59"));
            $data['cus_id'] = $_GET['customer'];
            $data['currency_id'] = $_GET['currency'];
            $data['reports'] = $this->reports_model->search($data['currency_id'],$start_date, $end_date, $data['cus_id']);
            $data['reports']['customer'] = $this->customer_model->getCustomer();
            $data['reports']['currency'] = $this->currency_model->getCurrency();
            // pr($data);
            $data['start_date']=$_GET['start_date'];
            $data['end_date']=$_GET['end_date'];
            $data['page'] = 'reports/reports';
            $data['pageName'] = 'reportsPage';
            $this->load->view('page', $data);
        }
		else redirect('reports');
	}
}