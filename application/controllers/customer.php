<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
		else{
		$this->load->model('customer_model');
		$this->lang->load('customer');

		}

	}
	public function index()
	{
		$offset = isset($_GET['page']) && (int)$_GET['page']!=0?$_GET['page']:1;
		$limit 	= LIMIT;
		$type 	= "all";

		$offset = ($offset > 1)? $limit*($offset - 1) : 0;

        $data['allcustomer']=$this->customer_model->getCustomer(NULL,NULL,$data=array('limit'=>$limit,'offset'=>$offset, $type='all'));

        //create pagination...
			$count = $this->customer_model->rec_count();
			$pagination_url = "customer?type=$type";
			$data["links"] = $this->common_lib->pagination($pagination_url, $count , $limit);

        $data['page']='customers/allcustomer';

		$data['pageName']='customerPage';
		$this->load->view('page',$data);
	}
	public function add(){

        if($_POST){
			//	$this->load->library('form_validation');
				$this->form_validation->set_rules('name', $this->lang->line('validation_name_label'), 'required');
				$this->form_validation->set_rules('company_name',$this->lang->line('validation_company_name_label'),'required');
				$this->form_validation->set_rules('attn_name',$this->lang->line('validation_attn_label'), 'required');

                $this->form_validation->set_rules('address1', $this->lang->line('validation_address1_label'), 'required');
				$this->form_validation->set_rules('email',$this->lang->line('validation_email_label'), 'required|valid_email');

                if ($this->form_validation->run() == FALSE)
				{
					$data['page']='customers/addcustomer';
					$data['pageName']='customerPage';
					$this->load->view('page',$data);
				}

				else
				{
					$data = array(
						'name'  		=> $this->input->post('name'),
						'company_name' 	=> $this->input->post('company_name'),
						'attn_name'		=> $this->input->post('attn_name'),
                        'city' => $this->input->post('city'),
                        'state' => $this->input->post('state'),
                        'country' => $this->input->post('country'),
                        'postcode' => $this->input->post('postcode'),
                        'address1' => $this->input->post('address1'),
                        'address2' => $this->input->post('address2'),
						'phone'    		=> $this->input->post('phone'),
						'email'    		=> $this->input->post('email'),

					);

                    $data['message']=$this->customer_model->add($data);
					$this->session->set_flashdata('message', $data);
                    redirect('customer');
				}

			}//end if data submited...
			else{

				$data['page']='customers/addcustomer';
				$data['pageName']='customerPage';
				$this->load->view('page',$data);

			}


    }

	public function update(){
		if($_POST){
				$this->form_validation->set_rules('name', $this->lang->line('validation_name_label'), 'required');
				$this->form_validation->set_rules('company_name',$this->lang->line('validation_company_name_label'), 'required');
				$this->form_validation->set_rules('attn_name',$this->lang->line('validation_attn_label'), 'required');
            $this->form_validation->set_rules('address1', $this->lang->line('validation_address1_label'), 'required');
				$this->form_validation->set_rules('email',$this->lang->line('validation_email_label'), 'required|valid_email');

            if ($this->form_validation->run() == FALSE)
				{
					//if there is any Error in Form validation.
					$customerId= $this->uri->segment(3);
					$data['updateCustomer']=$this->customer_model->getCustomer($customerId);
					$data['pageName']='customerPage';
					$data['page']='customers/editcustomer';
					$this->load->view('page',$data);
				}

				else
				{
					$data = array(
						'name'  		=> $this->input->post('name'),
						'id'  			=> $this->uri->segment(3),
						'company_name' 	=> $this->input->post('company_name'),
						'attn_name'		=> $this->input->post('attn_name'),
                        'city' => $this->input->post('city'),
                        'state' => $this->input->post('state'),
                        'country' => $this->input->post('country'),
                        'postcode' => $this->input->post('postcode'),
                        'address1' => $this->input->post('address1'),
                        'address2' => $this->input->post('address2'),
						'phone'    		=> $this->input->post('phone'),
						'email'    		=> $this->input->post('email'),

					);

                    $data['message']=$this->customer_model->update($data);
						$this->session->set_flashdata('message', $data);
	   					redirect('customer');

				}
		}
		//this code will be Execute when Update is called from the All Customer Form.
		else
		{
		$customerId= $this->uri->segment(3);
            if (!$customerId) {
                redirect('customer');
            }
		$data['updateCustomer']=$this->customer_model->getCustomer($customerId);

		$data['page']='customers/editcustomer';
		$data['pageName']='customerPage';
		$this->load->view('page',$data);

		}
	}
	public function delete(){
		$key= $this->uri->segment(3);
		$data['message']=$this->customer_model->delete($key);
		$this->session->set_flashdata('message', $data);
		redirect('customer');
	}

}