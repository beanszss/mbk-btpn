<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kanwil extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library(array('ion_auth', 'SSP'));
        if (!$this->ion_auth->logged_in()) {
            redirect('/auth', 'refresh');
        }
        $this->load->model(array('api_kanwil_model'));

        $locahostEnv = array(
            '127.0.0.1',
            '::1'
        );

        if (!in_array($_SERVER['REMOTE_ADDR'], $locahostEnv)) {
            if (!$this->input->is_ajax_request()) {
                exit('No direct script access allowed');
            }
        }
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $data = $this->api_kanwil_model->index();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        $data = array(
            'jenis' => $this->input->post('jenis'),
            'status' => $this->input->post('status')
        );
        if (!empty($this->input->post('id_kanwil'))) {
            $id_kanwil = $this->api_kanwil_model->update($data);
        } else {
            $id_kanwil = $this->api_kanwil_model->create($data);
        }
        $this->output->set_content_type('application/json')->set_output(json_encode(['status' => true]));
    }

    /**
     * getById
     *
     * @param  mixed $id
     *
     * @return void
     */
    public function getById($id)
    {
        $data = $this->api_kanwil_model->getById($id);
        $this->output->set_content_type('application/json')->set_output(json_encode(['status' => true, 'result' => $data]));
    }

    /**
     * destroy
     *
     * @param  mixed $id
     *
     * @return void
     */
    public function destroy($id)
    {
        $data = $this->api_kanwil_model->destroy($id);
        $this->output->set_content_type('application/json')->set_output(json_encode(['status' => true]));
    }
}
