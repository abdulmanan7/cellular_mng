<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company extends CI_Controller {
	private $fileerr=FALSE;
	public $comp_id;
	function __construct()
	{
		parent::__construct();

			if (!$this->ion_auth->logged_in())
			{
				redirect('auth/login');
			}
				else{
				$this->comp_id=$this->session->userdata('company_id');
				$this->load->model('company_model');
				$this->lang->load('company');
				$data['pageName']='companyPage';

				}
	}
	public function index(){
		$data['record']=$this->company_model->getCompany();
		$data['page']='company/companyinfo';
		$this->load->view('page',$data);
	}

	public function update(){
		if($_POST){
		$this->form_validation->set_rules('name',$this->lang->line('validation_name_label'), 'required');
		$this->form_validation->set_rules('attn_name',$this->lang->line('validation_attn_label'), 'required');
		$this->form_validation->set_rules('address1',$this->lang->line('validation_address1_label'), 'required');
		$this->form_validation->set_rules('postcode',$this->lang->line('validation_postcode_label'), 'required');
		$this->form_validation->set_rules('email',$this->lang->line('validation_email_label'), 'required|valid_email');
					if ($this->form_validation->run() == FALSE )
			{
					$data['record']=$this->company_model->getCompany('1');
					$data['page']='company/update';
					$this->load->view('page',$data);
			}
			else
			{

					$data = array(
					'name'  		    => $this->input->post('name'),
					'attn_name' 	    => $this->input->post('attn_name'),
					'address1'		    => $this->input->post('address1'),
					'address2'		    => $this->input->post('address2'),
					'postcode'		    => $this->input->post('postcode'),
                        'country' => $this->input->post('country'),
                        'city' => $this->input->post('city'),
                        'state' => $this->input->post('state'),
					'phone'    		    => $this->input->post('phone'),
					'fax'    		    => $this->input->post('fax'),
					'email'    		    => $this->input->post('email'),
					'registration_no'	=> $this->input->post('registration_no'),
					'VAT_no'    		=> $this->input->post('VAT_no'),
					'footer_notes'   	=> $this->input->post('footer_notes'),

				);
				$data['message']=$this->company_model->update($data);
				$this->session->set_flashdata('message', $data);
				redirect('setting/company');

			}
		}else{
					$data['record']=$this->company_model->getCompany();
					$data['page']='company/update';
					$this->load->view('page',$data);
		}
	}
	public function changelogo(){
					$data['record']=$this->company_model->getCompany();
					$data['page']='company/changelogo';
					$this->load->view('page',$data);
			}
	public function do_upload(){
		$path='assets/images/';
		$fileName='logo'.$this->comp_id.'.png';
		$config=array(
			'allowed_types'=>'jpg|png|gif',
			'upload_path'=>$path,
			'max_size'=>'200',
			'overwrite'=>true,
			'file_name'=>$fileName,
            'max_height'      => "300",
            'max_width' => "300",

			);

		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('logo'))
		{
			$data['message']=$this->upload->display_errors();
			$this->session->set_flashdata('message', $data);
			redirect('company/changelogo');
        } else
		$imageData=$this->upload->data();
		$data['logo']=$path.$imageData['file_name'];
		$data['message']=$this->company_model->updateLogo($data);
		$this->session->set_flashdata('message', $data);
		redirect('company');

    }
}