<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Device extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('ion_auth', 'SSP'));
        if(!$this->ion_auth->logged_in()) {
            redirect('/auth', 'refresh');
        }
        $this->load->model(array('api_device_model'));

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
       $data = $this->api_device_model->index();
       $this->output->set_content_type('application/json')
                    ->set_output(json_encode($data));

    }

    public function create()
    {
        $data = array(
            'nama_device' => $this->input->post('nama_device'),
            'brand' => $this->input->post('brand'),
            'model' => $this->input->post('model'),
            'sn' => $this->input->post('sn'),
            'imei' => $this->input->post('imei'),
            'id_lob' => $this->input->post('nama_lob'),
            'id_service' => $this->input->post('jenis_service')
        );

        if (!empty($this->input->post('id_device'))) {
            $id_device = $this->api_device_model->update($data);
        } else {
            $id_device = $this->api_device_model->create($data);
        }

        $this->output->set_content_type('application/json')
            ->set_output(json_encode(['status' => true]));
    }

    public function getById($id)
    {
        $data = $this->api_device_model->getById($id);
        $this->output->set_content_type('application/json')->set_output(json_encode(['status' => true, 'result' => $data]));
    }

    public function destroy($id)
    {
        $data = $this->api_device_model->destroy($id);
        $this->output->set_content_type('application/json')
                     ->set_output(json_encode(['status' => true]));
    }
}