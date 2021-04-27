<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_pur extends CI_Controller
{
    function __construct()
	{
		parent::__construct();
		$this->load->library(array('ion_auth', 'SSP'));
		if (!$this->ion_auth->logged_in()) {
        	redirect('/auth', 'refresh');
		}
		$this->load->model(array('api_pur_model'));

		$locahostEnv = array(
			'127.0.0.1',
			'::1'
		);
		
		if(!in_array($_SERVER['REMOTE_ADDR'], $locahostEnv)){
			if (!$this->input->is_ajax_request()) {
				exit('No direct script access allowed');
			}
		}
    }
    
     public function index()
    {
		$data = $this->api_pur_model->index();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	
	public function getById($id)
	{
		$data = $this->api_pur_model->getById($id);
		$this->output->set_content_type('application/json')->set_output(json_encode(['status' => true, 'result' => $data]));
	}
}