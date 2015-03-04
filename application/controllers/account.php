<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('account_model');
		$this->lang->load('account');
	}
	public function index()
	{
		$offset = isset($_GET['page']) && (int)$_GET['page']!=0?$_GET['page']:1;
		$limit 	= LIMIT;
		$type 	= "all";

		$offset = ($offset > 1)? $limit*($offset - 1) : 0;

		$data['accountlist']=$this->account_model->getaccount(null,null,$data=array('limit'=>$limit,'offset'=>$offset, $type='all'));

        //create pagination...
			$count = $this->account_model->rec_count();
			$pagination_url = "account?type=$type";
			$data["links"] = $this->common_lib->pagination($pagination_url, $count , $limit);

        $data['page']='account/accountlist';
		$data['pageName']='accountPage';
		$this->load->view('page',$data);
	}
	public function add(){
			if($_POST){

				$this->form_validation->set_rules('name', $this->lang->line('validation_name_label'), 'required');

                if ($this->form_validation->run() == FALSE)
				{
					$data['page']='account/addaccount';
					$data['pageName']='accountPage';
					$this->load->view('page',$data);
				}

				else
				{
					$data = array(
						'name'  		=> $this->input->post('name'),
						'status' 	=> isset($_POST['status'])? $_POST['status']:'0',
						'system_acc' 	=> isset( $_POST['system_acc'] ) ? $_POST['system_acc'] : '0',
					);

                    $this->account_model->add($data);
					redirect('setting/account');

                }

			}//end if data submited...
			else{

				$data['page']='account/addaccount';
				$data['pageName']='accountPage';
				$this->load->view('page',$data);

			}


    }

	public function update(){
		if($_POST){
				$this->form_validation->set_rules('name', $this->lang->line('validation_name_label'), 'required');

            if ($this->form_validation->run() == FALSE)
				{
					//if there is any Error in Form validation.
					$accountId= $this->uri->segment(3);
					$data['updateaccount']=$this->account_model->getaccount($accountId);
					$data['page']='account/editaccount';
					$data['pageName']='accountPage';
					$this->load->view('page',$data);
				}

				else
				{
					$data = array(
						'name'  		=> $this->input->post('name'),
						'id'            => $this->uri->segment(3),
						'status' 	    => $this->input->post('status'),
						'system_acc' 	=> $this->input->post('system_acc'),
					);

                    $data['message']=$this->account_model->update($data);
						$data['accountlist']=$this->account_model->getaccount();
                    $this->session->set_flashdata('message', $data);
                    redirect('setting/account');

				}
		}
		else
		{
            $accountId = $this->uri->segment(3);
            if (!$accountId) {
                redirect('account');
            }
            $data['updateaccount'] = $this->account_model->getaccount($accountId);

            $data['page'] = 'account/editaccount';
            $data['pageName'] = 'accountPage';
            $this->load->view('page', $data);
		}
	}
	public function delete(){
		$accountId= $this->uri->segment(3);
		$data['message']=$this->account_model->delete($accountId);
		$this->session->set_flashdata('message', $data);
		redirect('setting/account');
	}

}