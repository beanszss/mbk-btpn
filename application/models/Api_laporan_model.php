<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_laporan_model extends CI_Model{

	// var $table = 'laporan';
	// var $select_column = array("id_laporan", "case_id", "tiket_btpn");  
    // var $order_column = array(null, "nim", "tiket_btpn");  
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $this->load->library('SSP');
		$table = 'laporan';
		$primaryKey = 'id_laporan';
		$columns = array(
			array('db' => '`l`.`id_laporan`', 'dt' => 'id_laporan', 'field' => 'id_laporan' ),
			array('db' => '`l`.`case_id`', 'dt' => 'case_id', 'field' => 'case_id' ),
			array('db' => '`l`.`tiket_btpn`', 'dt' => 'tiket_btpn', 'field' => 'tiket_btpn' ),
			// array('db' => 'avatar', 'dt' => 'avatar', 'field' => 'avatar' ),
			array('db' => '`c`.`nama_category`', 'dt' => 'category', 'field' => 'nama_category'),
			array('db' => '`sub_k`.`nama_sub_kategori`', 'dt' => 'sub_kategori', 'field' => 'nama_sub_kategori'),
			array('db' => '`l`.`imei_problem`', 'dt' => 'imei_problem', 'field' => 'imei_problem'),
			array('db' => '`l`.`sn_problem`', 'dt' => 'sn_problem', 'field' => 'sn_problem'),
			array('db' => '`l`.`imei_replace`', 'dt' => 'imei_replace', 'field' => 'imei_replace'),
			array('db' => '`l`.`sn_replace`', 'dt' => 'sn_replace', 'field' => 'sn_replace'),
			array('db' => '`l`.`nama`', 'dt' => 'nama', 'field' => 'nama'),
			array('db' => '`l`.`depart`', 'dt' => 'depart', 'field' => 'depart'),
			array('db' => '`l`.`nohp`', 'dt' => 'nohp', 'field' => 'nohp'),
			array('db' => '`l`.`lokasi`', 'dt' => 'lokasi', 'field' => 'lokasi'),
			array('db' => '`l`.`alamat`', 'dt' => 'alamat', 'field' => 'alamat'),
			array('db' => '`l`.`text`', 'dt' => 'text', 'field' => 'text'),
			array('db' => '`l`.`created_at`', 'dt' => 'created_at', 'field' => 'created_at',
			'formatter' => function ($d, $row)
				{
					return date( 'd M Y', strtotime($d));
				} 
			),
			array('db' => '`a`.`nama_activity`', 'dt' => 'activity', 'field' => 'nama_activity'),
			array('db' => '`l`.`id_laporan`', 'dt' => 'actions', 'field' => 'id_laporan')
		);
		$sql_details = $this->configDB();
		$joinQuery = "FROM `laporan` AS `l`
		LEFT JOIN `category` AS `c` ON (`c`.`id_category` = `l`.`id_category`)
		LEFT JOIN `sub_kategori` AS `sub_k` ON (`sub_k`.`id_sub_kategori` = `l`.`id_sub_kategori`)
		LEFT JOIN `activity`  AS `a` ON (`a`.`id_activity` = `l`.`id_activity`)";
		return SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery);
	}

	/**
	 * create
	 *
	 * @param  array $data
	 *
	 * @return void
	 */
	public function create($data)
	{
		$this->db
		->insert('laporan', $data);
		$insert_id = $this->db->insert_id();
   		return  $insert_id;
	}

	// function check_all($table,$where,$limit) 
    // {
		
    //     $query = $this->db->get_where($table,$where,$limit);
    //     if($query->num_rows()==1){
    //         return $query->result();
    //     }else{
    //         return false;
    //     }
	// }

	/**
	 * update
	 *
	 * @param  array $data
	 * @param  integer $id
	 *
	 * @return void
	 */
	public function update($data)
	{
		return $this->db
		->where('id_laporan', $this->input->post('id_laporan'))
		->update('laporan', $data);
	}

	/**
	 * getById
	 *
	 * @param  integer $id
	 *
	 * @return void
	 */
	public function getById($id)
	{
		return $this->db
		->where('id_laporan', $id)
		->get('laporan')
		->row_array();
	}

	/**
	 * destroy
	 *
	 * @param  integer $id
	 *
	 * @return void
	 */
	public function destroy($id)
	{
		return $this->db
		->where('id_laporan', $id)
		->delete('laporan');
	}
	
	/**
	 * configDB
	 *
	 * @return void
	 */
	private function configDB()
	{
		$CI =& get_instance();
        $CI->load->database();

        return array(
            'user' => $CI->db->username,
            'pass' => $CI->db->password,
            'db'   => $CI->db->database,
            'host' => $CI->db->hostname
        );
	}
}
