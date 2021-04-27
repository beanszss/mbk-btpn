<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library(array('ion_auth', 'SSP'));
		if (!$this->ion_auth->logged_in()) {
        	redirect('/auth', 'refresh');
		}
		$this->load->model(array('api_laporan_model'));

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
		$data = $this->api_laporan_model->index();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	/**
	 * create
	 *
	 * @return void
	 */
	public function create()
	{
		// $data = array ('status' => false, 'messages' => array());

		// $this->load->library('form_validation');
		//   $this->form_validation->set_rules('case_id', 'case_id', 'trim|required|max_length[11]|callback_case_id_check');
		//   $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		// if($this->form_validation->run()) {
			$data = array(
				'case_id' => $this->input->post('case_id'),
				'tiket_btpn' => $this->input->post('tiket_btpn'),
				'id_category' => $this->input->post('category'),
				'id_sub_kategori' => $this->input->post('sub_kategori'),
				'imei_problem' => $this->input->post('imei_prob'),
				'sn_problem' => $this->input->post('sn_prob'),
				'imei_replace' => $this->input->post('imei_rep'),
				'sn_replace' => $this->input->post('sn_rep'),
				'nama' => $this->input->post('nama'),
				'depart' => $this->input->post('depart'),
				'nohp' => $this->input->post('nohp'),
				'lokasi' => $this->input->post('lokasi'),
				'alamat' => $this->input->post('alamat'),
				'text' => $this->input->post('text'),
				'status' => $this->input->post('status')
			);

			// $data['status'] = true;
			if (!empty($this->input->post('id_laporan'))) {
				$id_laporan = $this->api_laporan_model->update($data);
			} else {
				$id_laporan = $this->api_laporan_model->create($data);
			}
		// }else{
		// 	foreach ($_POST as $key => $value) {
		// 		 $data['messages'][$key] = form_error($key);
		// 	}
		// }

        $this->output->set_content_type('application/json')->set_output(json_encode(['status' => true]));

	}

	// public function case_id_check($case_id)
    // {
    // 	$where = array ('case_id' => $case_id);
   	// 	$check = $this->api_laporan_model->check_all('laporan', $where, 1);
	// 	if ($check)
	// 	{
	// 		$this->form_validation->set_message('case_id_check', 'The {field} already exists');
	// 		return FALSE;
	// 	}else{
	// 		return TRUE;
	// 	}
	// }

	/**
	 * getById
	 *
	 * @param  mixed $id
	 *
	 * @return void
	 */
	public function getById($id)
	{
		$data = $this->api_laporan_model->getById($id);
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
		$data = $this->api_laporan_model->destroy($id);
		$this->output->set_content_type('application/json')->set_output(json_encode(['status' => true]));
	}
}
