<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Taxtype extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
		else{
		$this->load->model('taxtype_model');
		$this->lang->load('taxtype');
		}
	}
	public function index()
	{
		$offset = isset($_GET['page']) && (int)$_GET['page']!=0?$_GET['page']:1;
		$limit 	= LIMIT;
		$type 	= "all";

		$offset = ($offset > 1)? $limit*($offset - 1) : 0;

		$data['taxlist']=$this->taxtype_model->gettax(null,null,$data=array('limit'=>$limit,'offset'=>$offset, $type='all'));

		//create pagination...
			$count = $this->taxtype_model->rec_count();
			$pagination_url = "taxtype?type=$type";
			$data["links"] = $this->common_lib->pagination($pagination_url, $count , $limit);

		$data['page']='taxtype/taxlist';
		$data['pageName']='taxtypePage';
		$this->load->view('page',$data);
	}
	public function add(){

        if($_POST){

				$this->form_validation->set_rules('name', $this->lang->line('validation_name_label'), 'required');
				$this->form_validation->set_rules('percentage',$this->lang->line('validation_percentage_label'),'required|is_numeric');

            if ($this->form_validation->run() == FALSE)
				{
					$data['page']='settings/tax';
					$data['pageName']='settingsPage';
					$this->load->view('page',$data);
				}

				else
				{
					$data = array(
						'name'  		=> $this->input->post('name'),
						'percentage' 	=> $this->input->post('percentage'),
					);

                    $data['message']=$this->taxtype_model->add($data);
                    $this->session->set_flashdata('message', $data);
                    redirect('setting/tax');
				}

			}//end if data submited...
			else{
					$data['page']='taxtype/addtax';
					$data['pageName']='taxtypePage';
					$this->load->view('page',$data);
			}


    }

	public function update(){
		if($_POST){
				$this->form_validation->set_rules('name', $this->lang->line('validation_name_label'), 'required');
				$this->form_validation->set_rules('percentage',$this->lang->line('validation_percentage_label'),'required|is_numeric');

            if ($this->form_validation->run() == FALSE)
				{
					//if there is any Error in Form validation.
					$taxId= $this->uri->segment(3);
					$data['updatetax']=$this->taxtype_model->gettax($taxId);
					$data['page']='taxtype/edittax';
					$data['pageName']='taxtypePage';
					$this->load->view('page',$data);
				}

				else
				{
					$data = array(
						'name'  		=> $this->input->post('name'),
						'id'  			=> $this->uri->segment(3),
						'percentage' 	=> $this->input->post('percentage'),
					);

                    $data['message']=$this->taxtype_model->update($data);
                    $this->session->set_flashdata('message', $data);
						redirect('setting/tax');
				}
		}
		//this code will be Execute when Update is called from the All Customer Form.
		else
		{
		$taxId= $this->uri->segment(3);
            if (!$taxId) {
                redirect('taxtype');
            }
		$data['updatetax']=$this->taxtype_model->gettax($taxId);
		$data['page']='taxtype/edittax';
		$data['pageName']='taxtypePage';
		$this->load->view('page',$data);

		}
	}
	public function delete(){
		$taxId= $this->uri->segment(3);
		$data['message']=$this->taxtype_model->delete($taxId);
        $this->session->set_flashdata('message', $data);
		redirect('setting/tax');
	}

}