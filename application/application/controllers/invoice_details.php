<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice_details extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
		else{
		$this->load->model('invoice_model');
		$this->load->model('taxtype_model');
		$this->lang->load('invoice');
		$data['pageName']='invoiceDetailPage';
		}
	}
function index()
	{
		
	}
	public function add($data=NULL){
			if($_POST){

				$this->form_validation->set_rules('name', $this->lang->line('validation_name_label'), 'required');
				$this->form_validation->set_rules('date',$this->lang->line('validation_date_label'), 'required');
				$this->form_validation->set_rules('product[]', $this->lang->line('validation_product_label'), 'required');
				$this->form_validation->set_rules('price[]',$this->lang->line('validation_price_label'), 'required|is_numeric');
				$this->form_validation->set_rules('qty[]',$this->lang->line('validation_quantity_label'), 'required|is_numeric');
				$this->form_validation->set_rules('tax_type[]',$this->lang->line('validation_tax_type_label'), 'required');
				$this->form_validation->set_rules('description[]',$this->lang->line('validation_description_label'), 'required');
		
				if ($this->form_validation->run() == FALSE)
				{
					$data['page']='invoice/addinvoice';

					$this->load->view('page',$data);
				}

				else
				{
					$taxtype=$this->taxtype_model->gettax($data['tax_type_id']);
					if(isset($taxtype)){
					$data['tax_type']['tax_type_id']= $taxtype['id'];
					$data['tax_type']['tax_type_name']= $taxtype['name'];
					$data['tax_type']['tax_type_percentage']= $taxtype['percentage'];
					}

					$data['post'] = array(
						'total'  			=> $this->input->post('title'),
						'id'  				=> $this->uri->segment(3),
						'subtotal' 				=> $this->input->post('code'),
						'totaltax'		=> $this->input->post('symbol_left'),
						'last_modified_ts'		=>date('Y-m-d H:i:s'),

					);
					$data=$data['post']+$data['company']+$data['customer']+$data['currency'];
						echo "<pre>";
						print_r($_POST);

					die;
					$this->invoice_details_model->add($data);
					redirect('invoice/index');
				}

			}//end if data submited...
			else{

				$data['page']='invoice/addinvoice';
				$data['pageName']='invoicePage';
				$this->load->view('page',$data);

			}
			

	}//Addition Function End
/*public function check()
{
					$taxtype=$this->taxtype_model->gettax('3');
					

					$data['post'] = array(
						'total'  				=> $this->input->post('title'),
						'id'  					=> $this->uri->segment(3),
						'subtotal' 				=> $this->input->post('code'),
						'totaltax'				=> $this->input->post('symbol_left'),
						'last_modified_ts'		=>date('Y-m-d H:i:s'),

					);
					// $data=$data['post']+$data['company']+$data['customer']+$data['currency'];
						echo "<pre>";
						// print_r($_POST);
						print_r($data);

					die;
}
public function update(){
		if($_POST){
				$this->form_validation->set_rules('name', $this->lang->line('validation_name_label'), 'required');
				$this->form_validation->set_rules('date',$this->lang->line('validation_date_label'), 'required');
				$this->form_validation->set_rules('product[]', $this->lang->line('validation_product_label'), 'required');
				$this->form_validation->set_rules('price[]',$this->lang->line('validation_price_label'), 'required|is_numeric');
				$this->form_validation->set_rules('qty[]',$this->lang->line('validation_quantity_label'), 'required|is_numeric');
				$this->form_validation->set_rules('tax_type[]',$this->lang->line('validation_tax_type_label'), 'required');
				$this->form_validation->set_rules('description[]',$this->lang->line('validation_description_label'), 'required');
				
				if ($this->form_validation->run() == FALSE)
				{
					//if there is any Error in Form validation.
					$invoiceId= $this->uri->segment(3);
					$data['updateInvoice']=$this->invoice_model->getinvoice($invoiceId);
					$data['page']='invoice/editinvoice';
					$this->load->view('page',$data);
				}

				else
				{
					$data = array(
						'title'  		=> $this->input->post('title'),
						'id'  			=> $this->uri->segment(3),
						'code' 	=> $this->input->post('code'),
						'symbol_left'		=> $this->input->post('symbol_left'),
						'symbol_right'		=> $this->input->post('symbol_right'),
						'value'    	=> $this->input->post('value'),
						'decimal_place'    		=> $this->input->post('decimal_place'),
						'status'    		=> $this->input->post('status'),
						'date_modified'		=>date('Y-m-d H:i:s'),

					);
					
						$data['message']=$this->invoice_model->update($data);
						$data['allinvoice']=$this->invoice_model->getinvoice();
						redirect('invoice/index');
				}
		}
		//this code will be Execute when Update is called from the All invoice Form.
		else
		{
		$invoiceId= $this->uri->segment(3);
		$data['updateinvoice']=$this->invoice_model->getinvoice($invoiceId);

		// 	echo "<pre>";
		// 	print_r($data['cusrec']);

		// die;
		$data['page']='invoice/editinvoice';
		$data['pageName']='invoicePage';
		$this->load->view('page',$data);

		}
	}
	public function delete(){
		$key= $this->uri->segment(3);
		$data['message']=$this->invoice_model->delete($key);
		$data['allinvoice']=$this->invoice_model->getinvoice();
		redirect('invoice/index');

	}*/
}