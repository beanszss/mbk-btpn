<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_sub_kategori_model extends CI_Model{

    /**
     * index
     *
     * @return void
     */
    public function index($id)
    {
        $this->load->library('SSP');
		$table = 'sub_kategori';
		$primaryKey = 'id_sub_kategori';
		$columns = array(
			array('db' => '`sk`.`id_sub_kategori`', 'dt' => 'id_sub_kategori', 'field' => 'id_sub_kategori' ),
			array('db' => '`sk`.`nama_sub_kategori`', 'dt' => 'nama_sub_kategori', 'field' => 'nama_sub_kategori' ),
			// array('db' => 'avatar', 'dt' => 'avatar', 'field' => 'avatar' ),
            array('db' => '`c`.`nama_category`', 'dt' => 'category', 'field' => 'nama_category'),
            array('db' => '`sk`.`status`', 'dt' => 'status', 'field' => 'status'),
			array('db' => '`sk`.`id_sub_kategori`', 'dt' => 'actions', 'field' => 'id_sub_kategori')
		);
        $sql_details = $this->configDB();
        $joinQuery = "FROM `sub_kategori` AS `sk` 
		LEFT JOIN `category` AS `c` ON (`c`.`id_category` = `sk`.`id_category`)";
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
		->insert('sub_kategori', $data);
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
		->where('id_sub_kategori', $this->input->post('id_sub_kategori'))
		->update('sub_kategori', $data);
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
		->where('id_sub_kategori', $id)
		->get('sub_kategori')
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
		->where('id_sub_kategori', $id)
		->delete('sub_kategori');
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
