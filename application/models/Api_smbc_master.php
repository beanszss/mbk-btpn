<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api_smbc_master extends CI_Model 
{
    public function index()
    {
        $this->load->library('SSP');
        $table = 'master_smbc';
        $primaryKey = 'id_smbc';
        $columns = array(
            array('db' => '`smbc`.`id_smbc`', 'dt' => 'id_smbc', 'field' => 'id_smbc'),
            array('db' => '`smbc`.`nama_device`', 'dt' => 'nama_device', 'field' => 'nama_device'),
            array('db' => '`smbc`.`brand`', 'dt' => 'brand', 'field' => 'brand'),
            array('db' => '`smbc`.`model`', 'dt' => 'model', 'field' => 'model'),
            array('db' => '`smbc`.`sn`', 'dt' => 'sn', 'field' => 'sn'),
            array('db' => '`smbc`.`imei`', 'dt' => 'imei', 'field' => 'imei'),
            array('db' => '`lb`.`nama_lob`', 'dt' => 'lob', 'field' => 'nama_lob'),
            array('db' => '`smbc`.`status_allocated`', 'dt' => 'status_allocated', 'field' => 'status_allocated'),
            array('db' => '`sc`.`service`', 'dt' => 'tb_service', 'field' => 'service'),
            array('db' => '`smbc`.`start_date`', 'dt' => 'start_date', 'field' => 'start_date',
                    'formatter' => function ($d, $row)
                    {
                        return date( 'd M Y', strtotime($d));
                    }     
                ),
            array('db' => '`smbc`.`end_date`', 'dt' => 'end_date', 'field' => 'end_date',
                    'formatter' => function ($d, $row)
                    {
                        return date( 'd M Y', strtotime($d));
                    } 
                ),
            array('db' => '`smbc`.`kondisi`', 'dt' => 'kondisi', 'field' => 'kondisi'),
            array('db' => '`smbc`.`kelengkapan`', 'dt' => 'kelengkapan', 'field' => 'kelengkapan'),
            array('db' => '`smbc`.`nama_karyawan`', 'dt' => 'nama_karyawan', 'field' => 'nama_karyawan'),
            array('db' => '`smbc`.`divisi`', 'dt' => 'divisi', 'field' => 'divisi'),
            array('db' => '`smbc`.`keterangan`', 'dt' => 'keterangan', 'field' => 'keterangan'),
            array('db' => '`smbc`.`id_smbc`', 'dt' => 'actions', 'field' => 'id_smbc'),
            //    array('db' => 'id_device', 'dt' => 'id_device', 'field' => 'id_device'),
            //    array('db' => 'id_device', 'dt' => 'id_device', 'field' => 'id_device'),
        );
        $sql_details = $this->configDB();
        $joinQuery = "FROM `master_smbc` AS `smbc` 
        LEFT JOIN `lob` AS `lb` ON (`lb`.`id_lob` = `smbc`.`id_lob`)
        LEFT JOIN `tb_service` AS `sc` ON (`sc`.`id_service` = `smbc`.`id_service`)";
        return SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery);
    }

    public function create($data)
    {
        $this->db
        ->insert('master_smbc', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function warranty()
    {
        $this->load->library('SSP');
        $table = 'master_smbc';
        $primaryKey = 'id_smbc';
        $where = "`smbc`.`id_service` = '1'";
        $columns = array(
            array('db' => '`smbc`'.'`id_smbc`', 'dt' => 'id_smbc', 'field' => 'id_smbc'),
            array('db' => '`smbc`'.'`nama_device`', 'dt' => 'nama_device', 'field' => 'nama_device'),
            array('db' => '`smbc`'.'`brand`', 'dt' => 'brand', 'field' => 'brand'),
            array('db' => '`smbc`'.'`model`', 'dt' => 'model', 'field' => 'model'),
            array('db' => '`smbc`'.'`sn`', 'dt' => 'sn', 'field' => 'sn'),
            array('db' => '`smbc`'.'`imei`', 'dt' => 'imei', 'field' => 'imei'),
            array('db' => '`lb`'.'`nama_lob`', 'dt' => 'lob', 'field' => 'nama_lob'),
            array('db' => '`smbc`'.'`status_allocated`', 'dt' => 'status_allocated', 'field' => 'status_allocated'),
            array('db' => '`sc`'.'`service`', 'dt' => 'tb_service', 'field' => 'service'),
            array('db' => '`smbc`.`start_date`', 'dt' => 'start_date', 'field' => 'start_date',
                'formatter' => function ($d, $row)
                {
                    return date( 'd M Y', strtotime($d));
                }     
            ),
            array('db' => '`smbc`.`end_date`', 'dt' => 'end_date', 'field' => 'end_date',
                'formatter' => function ($d, $row)
                {
                    return date( 'd M Y', strtotime($d));
                } 
            ),
            array('db' => '`smbc`'.'`kondisi`', 'dt' => 'kondisi', 'field' => 'kondisi'),
            array('db' => '`smbc`'.'`kelengkapan`', 'dt' => 'kelengkapan', 'field' => 'kelengkapan'),
            array('db' => '`smbc`'.'`nama_karyawan`', 'dt' => 'nama_karyawan', 'field' => 'nama_karyawan'),
            array('db' => '`smbc`'.'`divisi`', 'dt' => 'divisi', 'field' => 'divisi'),
            array('db' => '`smbc`'.'`keterangan`', 'dt' => 'keterangan', 'field' => 'keterangan'),
            array('db' => '`smbc`'.'`id_smbc`', 'dt' => 'actions', 'field' => 'id_smbc')
        );
        $sql_details = $this->configDB();
        $joinQuery = "FROM `master_smbc` AS `smbc`
        LEFT JOIN `lob` AS `lb` ON (`lb`.`id_lob` = `smbc`.`id_lob`)
        LEFT JOIN `tb_service` AS `sc` ON (`sc`.`id_service` = `smbc`.`id_service`)";
        return SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery);
    }

    public function update($data)
    {
        return $this->db
        ->where('id_smbc', $this->input->post('id_smbc'))
        ->update('master_smbc', $data);
    }

    public function getById($id)
    {
        return $this->db
        ->where('id_smbc', $id)
        ->get('master_smbc')
        ->row_array();
    }

    public function destroy($id)
    {
        return $this->db
        ->where('id_smbc', $id)
        ->delete('master_smbc');
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