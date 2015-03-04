<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {
	private $fileerr=FALSE;

	function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
		else{
		$this->load->model('products_model');
		$this->lang->load('products');
		}
	}
	public function index()
	{
		$offset = isset($_GET['page']) && (int)$_GET['page']!=0?$_GET['page']:1;
		$limit 	= LIMIT;
		$type 	= "all";

		$offset = ($offset > 1)? $limit*($offset - 1) : 0;

        $data['allproducts']=$this->products_model->getProduct(NULL,NULL,$data=array('limit'=>$limit,'offset'=>$offset, $type='all'));

        //create pagination...
			$count = $this->products_model->rec_count();
			$pagination_url = "products?type=$type";
			$data["links"] = $this->common_lib->pagination($pagination_url, $count , $limit);

        $data['page']='products/allproducts';
		$data['pageName']='productPage';
		$this->load->view('page',$data);
	}
	public function add(){

        if($_POST){

			//	$this->load->library('form_validation');
				$this->form_validation->set_rules('name', $this->lang->line('validation_name_label'), 'required');
				$this->form_validation->set_rules('type',$this->lang->line('validation_type_label'),'required');
				$this->form_validation->set_rules('notes',$this->lang->line('validation_notes_label'), 'required');
				$this->form_validation->set_rules('price',$this->lang->line('validation_price_label'), 'required');

            if ($this->form_validation->run() == FALSE)
				{
					//$this->index();
					$data['page']='products/addproduct';
					$data['pageName']='productPage';

					$this->load->view('page',$data);
				}

				else
				{
					$data = array(
						'name'  		=> $this->input->post('name'),
						'type'      	=> $this->input->post('type'),
						'notes'		    => $this->input->post('notes'),
						'price'		    => $this->input->post('price'),

					);

                    $data['message']=$this->products_model->add($data);
					// $this->pageId=$this->db->insert_id();
					$this->session->set_flashdata('message', $data);
					redirect('products');

                }

			}//end if data submited...
			else{

					$data['page']='products/addproduct';
					$data['pageName']='productPage';
					$this->load->view('page',$data);
			}


    }

	public function update(){
		if($_POST){
				$this->form_validation->set_rules('name', $this->lang->line('validation_name_label'), 'required');
				$this->form_validation->set_rules('type',$this->lang->line('validation_type_label'),'required|max_length[1]|integer','true');
				$this->form_validation->set_rules('notes',$this->lang->line('validation_notes_label'), 'required');
				$this->form_validation->set_rules('price',$this->lang->line('validation_price_label'), 'required');
				if ($this->form_validation->run() == FALSE)
				{
					//if there is any Error in Form validation.
					$productId= $this->uri->segment(3);
					$data['product']=$this->products_model->getProduct($productId);
					$data['page']='products/editproducts';
					$data['pageName']='productPage';
					$this->load->view('page',$data);
				}

				else
				{
					$data = array(
						'name'  		=> $this->input->post('name'),
						'id'  			=> $this->uri->segment(3),
						'type'      	=> $this->input->post('type'),
						'notes'		    => $this->input->post('notes'),
						'price'		    => $this->input->post('price'),

					);

                    $data['message']=$this->products_model->update($data);
						$this->session->set_flashdata('message', $data);
						redirect('products');

				}
		}
		//this code will be Execute when Update is called from the All Products Form.
		else
		{
		$productId= $this->uri->segment(3);
            if (!$productId) {
                redirect('products');
            }
		$data['product']=$this->products_model->getProduct($productId);
		$data['page']='products/editproducts';
		$data['pageName']='productPage';
		$this->load->view('page',$data);

		}
	}
	public function delete(){
		$productId= $this->uri->segment(3);
		$data['message']=$this->products_model->delete($productId);
		$this->session->set_flashdata('message', $data);
		redirect('products');

	}

}