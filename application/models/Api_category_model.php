<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_category_model extends CI_Model
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $this->load->library('SSP');
		$table = 'category';
		$primaryKey = 'id_category';
		$columns = array(
			array('db' => 'id_category', 'dt' => 'id_category', 'field' => 'id_category' ),
			array('db' => 'nama_category', 'dt' => 'nama_category', 'field' => 'nama_category' ),
			// array('db' => 'avatar', 'dt' => 'avatar', 'field' => 'avatar' ),
			array('db' => 'created_at', 'dt' => 'created_at', 'field' => 'created_at',
			'formatter' => function ($d, $row)
				{
					return date( 'd M Y', strtotime($d));
				} 
			),
			array('db' => 'status', 'dt' => 'status', 'field' => 'status'),
			array('db' => 'id_category', 'dt' => 'actions', 'field' => 'actions')
		);
		$sql_details = $this->configDB();
		return SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns);
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
		->insert('category', $data);
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
		->where('id_category', $this->input->post('id_category'))
		->update('category', $data);
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
		->where('id_category', $id)
		->get('category')
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
		->where('id_category', $id)
		->delete('category');
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