<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class Lob extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('ion_auth', 'SSP'));
        if (!$this->ion_auth->logged_in()) {
            redirect('/auth', 'refresh');
        }
        $this->load->model('api_lob_model');

        $locahostEnv = array(
            '127.0.0.1',
            '::1'
        );

        if (!in_array($_SERVER['REMOTE_ADDR'], $locahostEnv)) {
            if(!$this->input->is_ajax_request()) {
                exit ('no direct script access allowed');
            }
        }
    }

    public function index()
    {
        $data = $this->api_lob_model->index();
        $this->output->set_content_type('application/json')
                     ->set_output(json_encode($data));
    }

    public function create()
    {
        $data = array (
            'nama_lob'       => $this->input->post('lob'),
            'status'    => $this->input->post('status')
        );

        if (!empty($this->input->post('id_lob'))) {
            $id_lob = $this->api_lob_model->update($data);
        } else {
            $id_lob = $this->api_lob_model->create($data);
        }
        $this->output->set_content_type('application/json')
                     ->set_output(json_encode(['status' => true]));
    }

    public function getById($id)
    {
        $data = $this->api_lob_model->getById($id);
        $this->output->set_content_type('application/json')
                     ->set_output(json_encode(['status' => true, 'result' => $data]));
    }

    public function destroy($id)
    {
        $data = $this->api_lob_model->destroy($id);
        $this->output->set_content_type('application/json')
                     ->set_output(json_encode(['status' => true]));
    }
}