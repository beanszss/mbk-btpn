<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class Api_lob_model extends CI_Model
{
    public function index()
    {
        $this->load->library('SSP');
        $table      = 'lob';
        $primaryKey = 'id_lob';
        $columns    = array (
            array('db' => 'id_lob', 'dt'    => 'id_lob', 'field'    => 'id_lob'),
            array('db' => 'nama_lob', 'dt'  => 'nama_lob', 'field'  => 'nama_lob'),
            array('db' => 'status', 'dt'    => 'status', 'field'    => 'status'),
            array('db' => 'id_lob', 'dt'    => 'actions', 'field'   => 'actions')
        );
        $sql_details = $this->configDB();
        return SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns);
    }

    public function create($data)
    {
        $this->db->insert('lob', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function update($data)
    {
        return $this->db
            ->where('id_lob', $this->input->post('id_lob'))
            ->update('lob', $data);
    }

    public function getById($id)
    {
        return $this->db
            ->where('id_lob', $id)
            ->get('lob')
            ->row_array();
    }

    public function destroy($id)
    {
        return $this->db
            ->where('id_lob', $id)
            ->delete('lob');
    }

    public function configDB()
    {
        $CI = &get_instance();
        $CI->load->database();

        return array(
            'user'  => $CI->db->username,
            'pass'  => $CI->db->password,
            'db'    => $CI->db->database,
            'host'  => $CI->db->hostname
        );
    }
}