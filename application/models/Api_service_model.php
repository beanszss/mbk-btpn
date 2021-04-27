<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class Api_service_model extends CI_Model
{
    public function index()
    {
        $this->load->library('SSP');
        $table      = 'tb_service';
        $primaryKey = "id_service";
        $columns    = array (
            array('db' => 'id_service', 'dt' => 'id_service', 'field' => 'id_service'),
            array('db' => 'service',    'dt' => 'service',    'field' => 'service'),
            array('db' => 'status',     'dt' => 'status',     'field' => 'status'),
            array('db' => 'id_service', 'dt' => 'actions',    'field' => 'actions')
        );
        $sql_details = $this->configDB();
        return SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns);
    }

    public function create($data)
    {
        $this->db->insert('tb_service', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function update($data)
    {
        return $this->db
            ->where('id_service', $this->input->post('id_service'))
            ->update('tb_service', $data);
    }

    public function getById($id)
    {
        return $this->db
            ->where('id_service',$id)
            ->get('tb_service')
            ->row_array();
    }

    public function destroy($id)
    {
        return $this->db
            ->where('id_service', $id)
            ->delete('tb_service');
    }

    public function configDB()
    {
        $CI = &get_instance();
        $CI->load->database();

        return array(
            'user' => $CI->db->username,
            'pass' => $CI->db->password,
            'db'   => $CI->db->database,
            'host' => $CI->db->hostname
        );
    }
}