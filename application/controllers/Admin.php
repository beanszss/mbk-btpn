<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('ion_auth', 'form_validation'));
		$this->load->helper(array('url', 'language'));
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');
		if (!$this->ion_auth->logged_in()) {
        	redirect('auth/', 'refresh');
		}
		$this->load->model(array('admin_model'));
	}

  public function index()
	{
		$title['title'] = "Admin | Dashboard";

		$data['count_master_wow'] = $this->admin_model->count_master_wow();
		$data['count_master_mur'] = $this->admin_model->count_master_mur();
		$data['count_master_pur'] = $this->admin_model->count_master_pur();
		$data['count_master_sinaya'] = $this->admin_model->count_master_sinaya();
		$data['count_master_smbc'] = $this->admin_model->count_master_smbc();
		$data['count_master_jenius'] = $this->admin_model->count_master_jenius();
		$data['count_master_other'] = $this->admin_model->count_master_other();

		$data['count_warranty_wow'] = $this->admin_model->count_warranty_wow();
		$data['count_warranty_sinaya'] = $this->admin_model->count_warranty_sinaya();
		$data['count_warranty_pur'] = $this->admin_model->count_warranty_pur();
		$data['count_warranty_mur'] = $this->admin_model->count_warranty_mur();
		$data['count_warranty_smbc'] = $this->admin_model->count_warranty_smbc();
		$data['count_warranty_jenius'] = $this->admin_model->count_warranty_jenius();
		$data['count_warranty_other'] = $this->admin_model->count_warranty_other();

		$data['count_other_wow'] = $this->admin_model->count_other_wow();
		$data['count_other_pur'] = $this->admin_model->count_other_pur();
		$data['count_other_sinaya'] = $this->admin_model->count_other_sinaya();
		$data['count_other_mur'] = $this->admin_model->count_other_mur();
		$data['count_other_smbc'] = $this->admin_model->count_other_smbc();
		$data['count_other_jenius'] = $this->admin_model->count_other_jenius();
		$data['count_other'] = $this->admin_model->count_other();

		$this->load->view('admin/partials/header', $title);
		$this->load->view('admin/partials/topbar');
		$this->load->view('admin/partials/sidebar');
		$this->load->view('admin/dashboard', $data);
		$this->load->view('admin/partials/js');
		$this->load->view('admin/partials/footer');
	}

	public function under_construction()
	{
		$this->load->view('admin/partials/header');
		$this->load->view('admin/partials/topbar');
		$this->load->view('admin/partials/sidebar');
		$this->load->view('under/under_construction');
		$this->load->view('admin/partials/js');
		$this->load->view('admin/partials/footer');
	}

	public function map()
	{
		$title['title'] = "Admin | Create Ticket";
		$this->load->view('admin/partials/header', $title);
		$this->load->view('admin/partials/topbar');
		$this->load->view('admin/partials/sidebar');
		$this->load->view('admin/map');
		$this->load->view('admin/partials/js');
		$this->load->view('admin/partials/footer');
	}

	public function getSub_kategori()
	{

		$id_category = $this->input->post('id_category');
		$sub_kategori = $this->admin_model->getSub_kategori($id_category);
		// $data .= "<option value=''>Pilih Sub Kategori</option>";
		foreach($sub_kategori as $sk){
			$data .="<option value='$sk[id_sub_kategori]'>$sk[nama_sub_kategori]</option>";
		}
		echo $data;
	}

	public function laporan()
	{
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('mod')) {
			redirect ('/', 'refresh');
		}
		$title['title'] = "Admin | Create Ticket";
		$data['category'] = $this->admin_model->getCategory();
		$data['laporan'] = $this->admin_model->getLaporan();
		$data['sub_kategori'] = $this->admin_model->get_subKategori();

		$this->load->view('admin/partials/header', $title);
		$this->load->view('admin/partials/topbar');
		$this->load->view('admin/partials/sidebar');
		if (!$this->input->get('type')) {
			$this->load->view('admin/laporan', $data);
		} else {
			$this->load->view('admin/laporan_add', $data);
		}
		$this->load->view('admin/partials/js');
		$this->load->view('admin/partials/footer');
	}

	public function detail_laporan()
	{
		$title['title'] = "Admin | Detail Tiket";

		$data['category'] = $this->admin_model->getCategory();
		$data['laporan'] = $this->admin_model->getLaporan();
		$data['sub_kategori'] = $this->admin_model->get_subKategori();

		$this->load->view('admin/partials/header', $title);
		$this->load->view('admin/partials/topbar');
		$this->load->view('admin/partials/sidebar');
		$this->load->view('admin/dt_case', $data);
		$this->load->view('admin/partials/js');
		$this->load->view('admin/partials/footer');
	}

	public function ambil_data()
	{
		$modul = $this->input->post('modul');
		$id = $this->input->post('id');

		if ($modul == 'sub_kategori') {
			echo $this->admin_model->get_subkategori($id);
		}
	}

	public function detail_kanwil()
	{
		$title['title'] = "Admin | Data Cabang";
		if (!$this->ion_auth->is_admin()) {
			redirect('admin/dashboard','refresh');
		}
		$this->load->view('admin/partials/header', $title);
		$this->load->view('admin/partials/topbar');
		$this->load->view('admin/partials/sidebar');
		$this->load->view('admin/detail_kanwil');
		$this->load->view('admin/partials/js');
		$this->load->view('admin/partials/footer');
	}

	/**==========================
	CONFIGURATION
	=============================*/

	public function user(){

		$title['title'] = "Setting | User Data";

		if (!$this->ion_auth->is_admin()) {
			// exit('No direct script access allowed');
			redirect('admin/under_construction','refresh');

		}
		$this->load->view('admin/partials/header', $title);
		$this->load->view('admin/partials/topbar');
		$this->load->view('admin/partials/sidebar');
		$this->load->view('admin/user');
		$this->load->view('admin/partials/js');
		$this->load->view('admin/partials/footer');

	}

	public function category(){
		$title['title'] = "Setting | Kategori Data";
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('mod')) {
			redirect('/','refresh');
		}
		$data['category'] = $this->admin_model->getCategory();
		$this->load->view('admin/partials/header', $title);
		$this->load->view('admin/partials/topbar');
		$this->load->view('admin/partials/sidebar');
		$this->load->view('admin/category', $data);
		$this->load->view('admin/partials/js');
		$this->load->view('admin/partials/footer');
	}

	public function sub_kategori()
	{
		$title['title'] = "Setting | Sub Kategori Data";
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('mod')) {
			redirect('/','refresh');
		}
		$data['category'] = $this->admin_model->getCategory();
		$data['sub_kategori'] = $this->admin_model->get_subKategori();
		$this->load->view('admin/partials/header', $title);
		$this->load->view('admin/partials/topbar');
		$this->load->view('admin/partials/sidebar');
		$this->load->view('admin/sub_kategori', $data);
		$this->load->view('admin/partials/js');
		$this->load->view('admin/partials/footer');
	}

	public function services()
	{
		$title['title'] = "Setting | Services";
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('mod')) {
			redirect('/','refresh');
		}
		// $data['kanwil'] = $this->admin_model->getKanwil();
		$this->load->view('admin/partials/header', $title);
		$this->load->view('admin/partials/topbar');
		$this->load->view('admin/partials/sidebar');
		$this->load->view('admin/services');
		$this->load->view('admin/partials/js');
		$this->load->view('admin/partials/footer');
	}

	public function lob()
	{
		$title['title'] = "Setting | LOB";
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('mod')) {
			redirect('/','refresh');
		}
		// $data['kanwil'] = $this->admin_model->getKanwil();
		$this->load->view('admin/partials/header', $title);
		$this->load->view('admin/partials/topbar');
		$this->load->view('admin/partials/sidebar');
		$this->load->view('admin/lob');
		$this->load->view('admin/partials/js');
		$this->load->view('admin/partials/footer');
	}

	// public function activity()
	// {
	// 	$title['title'] = "Setting | Sub Kategori Data";
	// 	if (!$this->ion_auth->is_admin()) {
	// 		redirect('admin/dashboard','refresh');
	// 	}

	// 	$this->load->view('admin/partials/header', $title);
	// 	$this->load->view('admin/partials/topbar');
	// 	$this->load->view('admin/partials/sidebar');
	// 	$this->load->view('admin/activity');
	// 	$this->load->view('admin/partials/js');
	// 	$this->load->view('admin/partials/footer');
	// }


	public function j_kanwil()
	{
		$title['title'] = "Setting | Data Cabang";
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('mod')) {
			redirect('/','refresh');
		}
		// $data['kanwil'] = $this->admin_model->getKanwil();
		$this->load->view('admin/partials/header', $title);
		$this->load->view('admin/partials/topbar');
		$this->load->view('admin/partials/sidebar');
		$this->load->view('admin/j_kanwil');
		$this->load->view('admin/partials/js');
		$this->load->view('admin/partials/footer');
	}

	public function sub_kanwil()
	{
		$title['title'] = "Setting | Detail Data Cabang";
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('mod')) {
			redirect('/','refresh');
		}
		$data['kanwil'] = $this->admin_model->getKanwil();
		$this->load->view('admin/partials/header', $title);
		$this->load->view('admin/partials/topbar');
		$this->load->view('admin/partials/sidebar');
		$this->load->view('admin/sub_kanwil', $data);
		$this->load->view('admin/partials/js');
		$this->load->view('admin/partials/footer');
	}

	/**==========================
	END OF CONFIGURATION
	=============================*/

	/**======================================
	Table Device (Master | Warranty | Others)
	=========================================*/
	public function get_device()
	{
		$title['title'] = "Setting | Device";
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('mod')) {
			redirect('/','refresh');
		}


		$this->load->view('admin/partials/header', $title);
		$this->load->view('admin/partials/topbar');
		$this->load->view('admin/partials/sidebar');
		$this->load->view('admin/master_device');
		$this->load->view('admin/partials/js');
		$this->load->view('admin/partials/footer');
	}

	public function get_wow()
	{
		$title['title'] = "Device | BTPN WOW";
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('mod')) {
			redirect('/','refresh');
		}

		$this->load->view('admin/partials/header', $title);
		$this->load->view('admin/partials/topbar');
		$this->load->view('admin/partials/sidebar');
		if (!$this->input->get('type')) {
			$this->load->view('admin/wow/warranty_wow');
		} else {
			$this->load->view('admin/wow/master');
		}
		$this->load->view('admin/partials/js');
		$this->load->view('admin/partials/footer');
	}

	public function get_sinaya()
	{
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('mod')) {
			redirect('/','refresh');
		}

		$title['title'] = "Device | BTPN Sinaya";
		$this->load->view('admin/partials/header', $title);

		$this->load->view('admin/partials/topbar');
		$this->load->view('admin/partials/sidebar');
		if(!$this->input->get('type')) {
			$this->load->view('admin/sinaya/warranty_sinaya');
		} else {
			$this->load->view('admin/sinaya/master');
		}
		$this->load->view('admin/partials/js');
		$this->load->view('admin/partials/footer');
	}

	public function get_pur()
	{
		$title['title'] = "Device | BTPN Purnabakti";
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('mod')) {
			redirect('/','refresh');
		}

		$this->load->view('admin/partials/header', $title);
		$this->load->view('admin/partials/topbar');
		$this->load->view('admin/partials/sidebar');
		if (!$this->input->get('type')) {
			$this->load->view('admin/pur/warranty_pur');
		} else {
			$this->load->view('admin/pur/master');
		}
		$this->load->view('admin/partials/js');
		$this->load->view('admin/partials/footer');
	}

	public function get_mur()
	{
		$title['title'] = "Device | BTPN MUR";
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('mod')) {
			redirect('/','refresh');
		}

		$this->load->view('admin/partials/header', $title);
		$this->load->view('admin/partials/topbar');
		$this->load->view('admin/partials/sidebar');
		if (!$this->input->get('type')) {
			$this->load->view('admin/mur/warranty_mur');
		} else {
			$this->load->view('admin/mur/master');
		}
		$this->load->view('admin/partials/js');
		$this->load->view('admin/partials/footer');
	}

	public function get_smbc()
	{
		$title['title'] = "Device | SMBC";
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('mod')) {
			redirect('/','refresh');
		}

		$this->load->view('admin/partials/header', $title);
		$this->load->view('admin/partials/topbar');
		$this->load->view('admin/partials/sidebar');
		if (!$this->input->get('type')) {
			$this->load->view('admin/smbc/warranty_smbc');
		} else {
			$this->load->view('admin/smbc/master');
		}
		$this->load->view('admin/partials/js');
		$this->load->view('admin/partials/footer');
	}

	public function get_jenius()
	{
		$title['title'] = "Device | Jenius";
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('mod')) {
			redirect('/','refresh');
		}

		$this->load->view('admin/partials/header', $title);
		$this->load->view('admin/partials/topbar');
		$this->load->view('admin/partials/sidebar');
		if (!$this->input->get('type')) {
			$this->load->view('admin/jenius/warranty_jenius');
		} else {
			$this->load->view('admin/jenius/master');
		}
		$this->load->view('admin/partials/js');
		$this->load->view('admin/partials/footer');
	}

	public function get_other()
	{
		$title['title'] = "Device | Others";
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('mod')) {
			redirect('/','refresh');
		}

		$this->load->view('admin/partials/header', $title);
		$this->load->view('admin/partials/topbar');
		$this->load->view('admin/partials/sidebar');
		if (!$this->input->get('type')) {
			$this->load->view('admin/others/warranty_other');
		} else {
			$this->load->view('admin/others/master');
		}
		$this->load->view('admin/partials/js');
		$this->load->view('admin/partials/footer');
	}
	/**======================================
	End of Table Device
	=========================================*/

	/**======================================
	Device Configureation
	=========================================*/
	public function device()
	{
		$title['title'] = "Setting | Device";
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('mod')) {
			redirect('/','refresh');
		}

		// $data['device'] = $this->admin_model->getDevice();
		$data['lob'] = $this->admin_model->getLob();
		$data['service'] = $this->admin_model->getService();
		$this->load->view('admin/partials/header', $title);
		$this->load->view('admin/partials/topbar');
		$this->load->view('admin/partials/sidebar');
		$this->load->view('admin/deviceSetting/devices', $data);
		$this->load->view('admin/partials/js');
		$this->load->view('admin/partials/footer');
	}

	public function deviceType()
	{
		$title['title'] = "Setting | Device";
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('mod')) {
			redirect('/','refresh');
		}

		$this->load->view('admin/partials/header', $title);
		$this->load->view('admin/partials/topbar');
		$this->load->view('admin/partials/sidebar');
		$this->load->view('admin/deviceSetting/deviceType');
		$this->load->view('admin/partials/js');
		$this->load->view('admin/partials/footer');
	}

	public function deviceBrand()
	{
		$title['title'] = "Setting | Device";
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('mod')) {
			redirect('/','refresh');
		}

		$this->load->view('admin/partials/header', $title);
		$this->load->view('admin/partials/topbar');
		$this->load->view('admin/partials/sidebar');
		$this->load->view('admin/deviceSetting/deviceBrand');
		$this->load->view('admin/partials/js');
		$this->load->view('admin/partials/footer');
	}

	public function allocated()
	{
		$title['title'] = "Setting | Device";
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('mod')) {
			redirect('/','refresh');
		}

		$this->load->view('admin/partials/header', $title);
		$this->load->view('admin/partials/topbar');
		$this->load->view('admin/partials/sidebar');
		$this->load->view('admin/deviceSetting/allocated');
		$this->load->view('admin/partials/js');
		$this->load->view('admin/partials/footer');
	}

	public function activity()
	{
		$title['title'] = "Setting | Activity";
		if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('mod')) {
			redirect('/', 'refresh');
		}

		$data['activity'] = $this->admin_model->getActivity();
		$this->load->view('admin/partials/header', $title);
		$this->load->view('admin/partials/topbar');
		$this->load->view('admin/partials/sidebar');
		$this->load->view('admin/activity');
		$this->load->view('admin/partials/js');
		$this->load->view('admin/partials/footer');
	}
}
