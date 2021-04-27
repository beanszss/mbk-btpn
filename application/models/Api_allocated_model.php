<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Api_allocated_model extends CI_Model
{
    public function index()
    {
        $this->load->library('SSP');
        $table = 'status_allocated';
        $primaryKey = 'id_allocated';
        $columns = array(
            array('db' => 'id_allocated', 'dt' => 'id_allocated', 'field' => 'id_allocated'),
            array('db' => 'nama_allocated', 'dt' => 'nama_allocated', 'field' => 'nama_allocated'),
            array('db' => 'created_at', 'dt' => 'created_at', 'field' => 'created_at',
                'formatter' => function($d, $row) {
                    return date('d M Y', strtotime($d));
                }
            ),
            array('db' => 'status', 'dt' => 'status', 'field' => 'status'),
            array('db' => 'id_allocated', 'dt' => 'actions', 'field' => 'actions')
        );
        $sql_details = $this->configDB();
        return SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns);
    }

    public function configDB()
    {
        $CI =& get_instance();
        $CI->load->database();

        return array(
            'user' => $CI->db->username,
            'pass' => $CI->db->password,
            'db' => $CI->db->database,
            'host' => $CI->db->hostname
        );
    }
}