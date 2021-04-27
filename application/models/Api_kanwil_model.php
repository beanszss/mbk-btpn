<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api_kanwil_model extends CI_Model
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $this->load->library('SSP');
        $table = 'kanwil';
        $primaryKey = 'id_kanwil';
        $columns = array(
            array('db' => 'id_kanwil', 'dt' => 'id_kanwil', 'field' => 'id_kanwil'),
            array('db' => 'jenis', 'dt' => 'jenis', 'field' => 'jenis'),
            array('db' => 'status', 'dt' => 'status', 'field' => 'status'),
            array('db' => 'id_kanwil', 'dt' => 'actions', 'field' => 'actions')
        );
        $sql_details = $this->configDB();
        return SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns);
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
        $this->db->insert('kanwil', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
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
            ->where('id_kanwil', $this->input->post('id_kanwil'))
            ->update('kanwil', $data);
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
            ->where('id_kanwil', $id)
            ->get('kanwil')
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
            ->where('id_kanwil', $id)
            ->delete('kanwil');
    }

    /**
     * configDB
     *
     * @return void
     */
    private function configDB()
    {
        $CI = &get_instance();
        $CI->load->database();

        return array(
            'user' => $CI->db->username,
            'pass' => $CI->db->password,
            'db' => $CI->db->database,
            'host' => $CI->db->hostname
        );
    }
}