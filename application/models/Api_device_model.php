<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api_device_model extends CI_Model
{
    public function index()
    {
       $this->load->library('SSP');
       $table = 'device';
       $primaryKey = 'id_device';
       $columns = array(
           array('db' => '`d`.`id_device`', 'dt' => 'id_device', 'field' => 'id_device'),
           array('db' => '`d`.`nama_device`', 'dt' => 'nama_device', 'field' => 'nama_device'),
           array('db' => '`d`.`brand`', 'dt' => 'brand', 'field' => 'brand'),
           array('db' => '`d`.`model`', 'dt' => 'model', 'field' => 'model'),
           array('db' => '`d`.`sn`', 'dt' => 'sn', 'field' => 'sn'),
           array('db' => '`d`.`imei`', 'dt' => 'imei', 'field' => 'imei'),
           array('db' => '`lb`.`nama_lob`', 'dt' => 'lob', 'field' => 'nama_lob'),
           array('db' => '`sc`.`service`', 'dt' => 'tb_service', 'field' => 'service'),
           array('db' => '`d`.`id_device`', 'dt' => 'actions', 'field' => 'id_device'),
        //    array('db' => 'id_device', 'dt' => 'id_device', 'field' => 'id_device'),
        //    array('db' => 'id_device', 'dt' => 'id_device', 'field' => 'id_device'),
       );
       $sql_details = $this->configDB();
       $joinQuery = "FROM `device` AS `d`
       LEFT JOIN `lob` AS `lb` ON (`lb`.`id_lob` = `d`.`id_lob`)
       LEFT JOIN `tb_service` AS `sc` ON (`sc`.`id_service` = `d`.`id_service`)";
       return SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery);
    }

    public function create($data)
    {
        $this->db
        ->insert('device', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function update($data)
    {
        return $this->db
            ->where('id_device', $this->input->post('id_device'))
            ->update('device', $data);
    }

    public function getById($id)
    {
        return $this->db
            ->where('id_device', $id)
            ->get('device')
            ->row_array();
    }

    public function destroy($id)
    {
        return $this->db
            ->where('id_device', $id)
            ->delete('device');
    }

    public function configDB()
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