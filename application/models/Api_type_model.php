<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_type_model extends CI_Model
{
    public function index()
    {
        $this->load->library('SSP');
        $table = 'device_conf';
        $primaryKey = 'id_dc';
        $columns = array (
            array('db' => 'id_dc', 'dt' => 'id_dc', 'field' => 'id_dc'),
            array('db' => 'device_type', 'dt' => 'device_type', 'field' => 'device_type'),
            array('db' => 'created_at', 'dt' => 'created_at', 'field' => 'created_at',
                'formatter' => function ($d, $row)
                {
                    return date('d M Y', strtotime($d));
                }
            ),
            array('db' => 'status', 'dt' => 'status', 'field' => 'status'),
            array('db' => 'id_dc', 'dt' => 'actions', 'field' => 'actions'),
        );
        $sql_details = $this->configDB();
        return SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns);
    }

    public function create($data)
    {
        $this->db
        ->insert('device_conf', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function update($data)
    {
        return $this->db
        ->where('id_dc', $this->input->post('id_dc'))
        ->update('device_conf', $data);
        
    }

    public function getById($id)
    {
        return $this->db
        ->where('id_dc', $id)
        ->get('device_conf')
        ->row_array();
    }

    public function destroy($id)
    {
        return $this->db
        ->where('id_dc', $id)
        ->delete('device_conf');        
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