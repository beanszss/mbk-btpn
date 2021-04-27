<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_activity_model extends CI_Model{

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $this->load->library('SSP');
		$table = 'activity';
		$primaryKey = 'id_activity';
		$columns = array(
			array('db' => 'id_activity', 'dt' => 'id_activity', 'field' => 'id_activity' ),
			array('db' => 'nama_activity', 'dt' => 'nama_activity', 'field' => 'nama_activity' ),
			array('db' => 'status', 'dt' => 'status', 'field' => 'status'),
			// array('db' => 'avatar', 'dt' => 'avatar', 'field' => 'avatar' ),
			array('db' => 'created_at', 'dt' => 'created_at', 'field' => 'created_at',
			'formatter' => function ($d, $row)
				{
					return date( 'd M Y', strtotime($d));
				}
			),
			array('db' => 'id_activity', 'dt' => 'actions', 'field' => 'actions')
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
		->insert('activity', $data);
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
		->where('id_activity', $this->input->post('id_activity'))
		->update('activity', $data);
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
		->where('id_activity', $id)
		->get('activity')
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
		->where('id_activity', $id)
		->delete('activity');
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