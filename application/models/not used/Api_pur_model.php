<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_pur_model extends CI_Model
{
    /**
     * inde
     * 
     * @return void
     */
    public function index()
    {
        $this->load->library('SSP');
        $table = 'pur';
        $primarykey = "id_pur";
        $columns = array(
            array('db' => 'id_pur', 'dt' => 'id_pur', 'field' => 'no'),
            array('db' => 'type', 'dt' => 'type', 'field' => 'type'),
            array('db' => 'imei', 'dt' => 'imei', 'field' => 'imei'),
            array('db' => 'sn', 'dt' => 'sn', 'field' => 'sn'),
            array('db' => 'pur_wilayah', 'dt' => 'pur_wilayah', 'field' => 'pur_wilayah'),
            array('db' => 'start_date', 'dt' => 'start_date', 'field' => 'start_date',
			'formatter' => function ($d, $row)
				{
					return date( 'd M Y', strtotime($d));
                }
            ),
            array('db' => 'end_date', 'dt' => 'end_date', 'field' => 'end_date',
			'formatter' => function ($d, $row)
				{
					return date( 'd M Y', strtotime($d));
                }
            ),
            array('db' => 'premi_asuransi', 'dt' => 'premi_asuransi', 'field' => 'premi_asuransi'),
        );
        $sql_detail = $this->configDB();
        return SSP::simple($_GET, $sql_detail, $table, $primarykey, $columns);
    }

    /**
     * getById
     * 
     * @return void
     */
    public function getById($id)
    {
        return $this->db
        ->where('id_mur', $id)
        ->get('mur')
        ->row_array();
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
            'db' => $CI->db->database,
            'host' => $CI->db->hostname,
        );
    }
}