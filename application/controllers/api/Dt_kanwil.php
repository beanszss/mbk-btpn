<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dt_kanwil extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library(array('ion_auth', 'SSP'));
		if (!$this->ion_auth->logged_in()) {
        	redirect('/auth', 'refresh');
		}
		$this->load->model(array('api_dtKanwil_model'));

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

	/**
	 * index
	 *
	 * @return void
	 */
	public function index()
	{
		$id = $this->input->post('id_detail');
		$data = $this->api_dtKanwil_model->index($id);
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
			'id_kanwil' => $this->input->post('jenis'),
			'nama_cabang' => $this->input->post('nama_cabang'),
			'alamat' => $this->input->post('alamat'),
			'region' => $this->input->post('region')
		);
		if (!empty($this->input->post('id_sub_kanwil'))) {
			$id_sub_kanwil = $this->api_sub_kanwil_model->update($data);
		} else {
			$id_sub_kanwil = $this->api_sub_kanwil_model->create($data);
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
		$data = $this->api_sub_kanwil_model->getById($id);
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
		$data = $this->api_sub_kanwil_model->destroy($id);
		$this->output->set_content_type('application/json')->set_output(json_encode(['status' => true]));
	}
}
