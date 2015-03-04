<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Currency extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
		else{
		$this->load->model('currency_model');
		$this->lang->load('currency');
		$data['pageName']='currencyPage';
		}
	}
	public function index()
	{
		$offset = isset($_GET['page']) && (int)$_GET['page']!=0?$_GET['page']:1;
		$limit 	= LIMIT;
		$type 	= "all";

		$offset = ($offset > 1)? $limit*($offset - 1) : 0;

		$data['allcurrency']=$this->currency_model->getcurrency(null,null,$data=array('limit'=>$limit,'offset'=>$offset, $type='all'));

        //create pagination...
			$count = $this->currency_model->rec_count();
			$pagination_url = "currency?type=$type";
			$data["links"] = $this->common_lib->pagination($pagination_url, $count , $limit);

        $data['page']='currency/allcurrency';
		$this->load->view('page',$data);
	}
	public function add(){

        if($_POST){

				$this->form_validation->set_rules('title', $this->lang->line('validation_title_label'), 'required');
				$this->form_validation->set_rules('code',$this->lang->line('validation_code_label'), 'required');
				$this->form_validation->set_rules('value',$this->lang->line('validation_value_label'), 'required');
				$this->form_validation->set_rules('decimal_place', $this->lang->line('validation_decimal_place_label'), 'required|is_numeric');

            if ($this->form_validation->run() == FALSE)
				{
					$data['page']='currency/addcurrency';
					$data['pageName']='currencyPage';
					$this->load->view('page',$data);
				}

				else
				{
					$data = array(
						'title'  			=> $this->input->post('title'),
						'id'  				=> $this->uri->segment(3),
						'code' 				=> $this->input->post('code'),
						'symbol_left'		=> $this->input->post('symbol_left'),
						'symbol_right'		=> $this->input->post('symbol_right'),
						'value'    			=> $this->input->post('value'),
						'decimal_place'    	=> $this->input->post('decimal_place'),
						'status'    		=> $this->input->post('status'),
						'date_modified'		=>date('Y-m-d H:i:s'),

					);

                    $data['message']=$this->currency_model->add($data);
					$this->session->set_flashdata('message', $data);
                    redirect('setting/currency');
				}

			}//end if data submited...
			else{

					$data['page']='currency/addcurrency';
					$data['pageName']='currencyPage';
					$this->load->view('page',$data);

			}


    }

	public function update(){

        if($_POST){
				$this->form_validation->set_rules('title', $this->lang->line('validation_title_label'), 'required');
				$this->form_validation->set_rules('code',$this->lang->line('validation_code_label'), 'required');
				$this->form_validation->set_rules('value',$this->lang->line('validation_value_label'), 'required');
				$this->form_validation->set_rules('decimal_place', $this->lang->line('validation_decimal_place_label'), 'required|is_numeric');

            if ($this->form_validation->run() == FALSE)
				{
					//if there is any Error in Form validation.
					$currencyId= $this->uri->segment(3);
					$data['updateCurrency']=$this->currency_model->getcurrency($currencyId);
					$data['page']='currency/editcurrency';

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
						$data['message']=$this->currency_model->update($data);
						$this->session->set_flashdata('message', $data);
                        redirect('setting/currency');
				}
		}
		//this code will be Execute when Update is called from the All currency Form.
		else
		{
		$currencyId= $this->uri->segment(3);
            if (!$currencyId) {
                redirect('currency');
            }
		$data['updateCurrency']=$this->currency_model->getcurrency($currencyId);
		$data['page']='currency/editcurrency';
		$this->load->view('page',$data);

		}
	}
	public function delete(){
		$key= $this->uri->segment(3);
		$data['message']=$this->currency_model->delete($key);
		$this->session->set_flashdata('message', $data);
		redirect('setting/currency');
	}

}