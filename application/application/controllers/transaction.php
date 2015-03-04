<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class transaction extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
		else{
		$this->load->model('transaction_model');
		$this->lang->load('transaction');
		$data['pageName']='transactionPage';
		}
	}
	public function index()
	{

		$data['alltransaction']=$this->transaction_model->get();
		$data['page']='transaction/alltransaction';
		$this->load->view('page',$data);
	}
	public function add(){

			if($_POST){

				$this->form_validation->set_rules('amount', $this->lang->line('validation_title_label'), 'required');
				$this->form_validation->set_rules('account',$this->lang->line('validation_code_label'), 'required');


				if ($this->form_validation->run() == FALSE)
				{
					$data['page']='transaction/addtransaction';
					$data['pageName']='transactionPage';
					$this->load->view('page',$data);
				}

				else
				{
					$data = array(
						'customer_id'  		=> $this->input->post('customer_id_hide'),
						'invoice_id'  		=> $this->input->post('invoice_id_hide'),
						'amount' 			=> $this->input->post('total'),
						// 'symbol_left'		=> $this->input->post('symbol_left'),
						// 'symbol_right'		=> $this->input->post('symbol_right'),
						// 'value'    			=> $this->input->post('value'),
						'type'    	=> TRANS_TYPE,
						'account'    		=> $this->input->post('payment_method_id'),
						'note'		=>$this->input->post('note'),

					);

					$data['message']=$this->transaction_model->processPayment($data);
					$this->session->set_flashdata('message', $data);
					redirect('transaction');
				}

			}//end if data submited...
			else{

					$data['page']='transaction/addtransaction';
					$data['pageName']='transactionPage';
					$this->load->view('page',$data);

			}


	}

	public function update(){

		if($_POST){
				$this->form_validation->set_rules('title', $this->lang->line('validation_title_label'), 'required');
				$this->form_validation->set_rules('code',$this->lang->line('validation_code_label'), 'required');
				$this->form_validation->set_rules('symbol_left',$this->lang->line('validation_symbol_left_label'), 'required');
				$this->form_validation->set_rules('symbol_right',$this->lang->line('validation_symbol_right_label'), 'required');
				$this->form_validation->set_rules('value',$this->lang->line('validation_value_label'), 'required');
				$this->form_validation->set_rules('decimal_place', $this->lang->line('validation_decimal_place_label'), 'required|is_numeric');
				$this->form_validation->set_rules('status',$this->lang->line('validation_status_label'), 'required|is_numeric');

				if ($this->form_validation->run() == FALSE)
				{
					//if there is any Error in Form validation.
					$transactionId= $this->uri->segment(3);
					$data['updatetransaction']=$this->transaction_model->get($transactionId);
					$data['page']='transaction/edittransaction';

					$this->load->view('page',$data);
				}

				else
				{
					$data = array(
						'title'  		=> $this->input->post('title'),
						'id'  			=> $this->uri->segment(3),
						'code' 			=> $this->input->post('code'),
						'symbol_left'	=> $this->input->post('symbol_left'),
						'symbol_right'	=> $this->input->post('symbol_right'),
						'value'    		=> $this->input->post('value'),
						'decimal_place' => $this->input->post('decimal_place'),
						'status'    	=> $this->input->post('status'),
						'default'    	=> $this->input->post('default'),
						'date_modified'	=>date('Y-m-d H:i:s'),

					);
						$data['message']=$this->transaction_model->update($data);
						$this->session->set_flashdata('message', $data);
						redirect('transaction/index');
				}
		}
		//this code will be Execute when Update is called from the All transaction Form.
		else
		{
		$transactionId= $this->uri->segment(3);
		$data['updatetransaction']=$this->transaction_model->get($transactionId);
		$data['page']='transaction/edittransaction';
		$this->load->view('page',$data);

		}
	}
	public function delete(){
		$key= $this->uri->segment(3);
		$data['message']=$this->transaction_model->delete($key);
		$this->session->set_flashdata('message', $data);
		redirect('transaction');
	}
	public function addThroughAjax(){
		if($_POST) {
            if ($_POST['total'] < $_POST['amount']) {
                return false;
            } 
            else {
            	if ($_POST['total'] == $_POST['amount']) {
            	$_POST['payment_status']=PAID;
            	}
            	else{
            	$_POST['payment_status']=PARTIALLY_PAID;	
            	}
                unset($_POST['total']);
                $data['message'] = $this->transaction_model->processPayment($_POST);
                $this->session->set_flashdata('message', $data);
                redirect('invoice/status');

            }
        }
    }
    public function get_payment($id = NULL)
    {
    	
        if (!$id) {
            $result = $this->transaction_model->gettransaction();
            // $statusJS[$invoice_status['id']] = $invoice_status;
        } else {
            $result = $this->transaction_model->gettransaction($id);
            // $statusJS[$invoice_status['id']] = $invoice_status;
        }
        // echo json_encode($statusJS);
        echo json_encode($result);
    }
}