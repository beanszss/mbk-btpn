<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_other extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('ion_auth', 'SSP'));
        if(!$this->ion_auth->logged_in()) {
            redirect('/auth', 'refresh');
        }
        $this->load->model(array('api_other_master'));
        
        $locahostEnv = array(
            '127.0.0.1',
            '::1'
        );

        if (!array($_SERVER['REMOTE_ADDR'], $locahostEnv)) {
            if (!$this->input->is_ajax_request()) {
                exit('No direct script access allowed');
            }
        }
    }

    public function index()
    {
       $data = $this->api_other_master->index();
       $this->output->set_content_type('application/json')
                    ->set_output(json_encode($data));
           
    }

    public function get_warranty()
    {
        $data = $this->api_other_master->warranty();
        $this->output->set_content_type('application/json')
                     ->set_output(json_encode($data));
    }
}