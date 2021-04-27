<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_dtKanwil_model extends CI_Model{

    /**
     * index
     *
     * @return void
     */
    public function index($id)
    {
        $this->load->library('SSP');
		$table = 'dt_kanwil';
		$primaryKey = 'id_detail';
		$columns = array(
            array('db' => '`dk`.`id_detail`', 'dt' => 'id_detail', 'field' => 'id_detail' ),
            array('db' => '`k`.`jenis`', 'dt' => 'jenis', 'field' => 'jenis'),
            array('db' => '`dk`.`business`', 'dt' => 'business', 'field' => 'business'),
			array('db' => '`skan`.`nama_cabang`', 'dt' => 'nama_cabang', 'field' => 'nama_cabang' ),
			// array('db' => 'avatar', 'dt' => 'avatar', 'field' => 'avatar' ),
			array('db' => '`skan`.`alamat`', 'dt' => 'alamat', 'field' => 'alamat' ),
            array('db' => '`skan`.`region`', 'dt' => 'region', 'field' => 'region')
		);
        $sql_details = $this->configDB();
        $joinQuery = "FROM `dt_kanwil` AS `dk`
        LEFT JOIN `sub_kanwil` AS `skan` ON (`skan`.`id_sub_kanwil` = `dk`.`id_sub_kanwil`) 
		LEFT JOIN `kanwil` AS `k` ON (`k`.`id_kanwil` = `dk`.`id_kanwil`)";
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
		->insert('sub_kanwil', $data);
		$insert_id = $this->db->insert_id();
   		return  $insert_id;
	}

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
		->where('id_sub_kanwil', $this->input->post('id_sub_kanwil'))
		->update('sub_kanwil', $data);
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
		->where('id_detail', $id)
		->get('dt_kanwil')
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
		->where('id_detail', $id)
		->delete('dt_kanwil');
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