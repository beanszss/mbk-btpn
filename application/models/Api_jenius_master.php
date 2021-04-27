<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Api_jenius_master extends CI_Model
{
    public function index()
    {
       $this->load->library('SSP');
       $table = 'master_jenius';
       $primaryKey = 'id_jenius';
       $columns = array(
           array('db' => '`mw`.`id_jenius`', 'dt' => 'id_jenius', 'field' => 'id_jenius'),
           array('db' => '`mw`.`nama_device`', 'dt' => 'nama_device', 'field' => 'nama_device'),
           array('db' => '`mw`.`brand`', 'dt' => 'brand', 'field' => 'brand'),
           array('db' => '`mw`.`model`', 'dt' => 'model', 'field' => 'model'),
           array('db' => '`mw`.`sn`', 'dt' => 'sn', 'field' => 'sn'),
           array('db' => '`mw`.`imei`', 'dt' => 'imei', 'field' => 'imei'),
           array('db' => '`lb`.`nama_lob`', 'dt' => 'lob', 'field' => 'nama_lob'),
           array('db' => '`mw`.`status_allocated`', 'dt' => 'status_allocated', 'field' => 'status_allocated'),
           array('db' => '`sc`.`service`', 'dt' => 'tb_service', 'field' => 'service'),
           array('db' => '`mw`.`start_date`', 'dt' => 'start_date', 'field' => 'start_date',
                'formatter' => function ($d, $row)
                {
                    return date( 'd M Y', strtotime($d));
                }     
            ),
           array('db' => '`mw`.`end_date`', 'dt' => 'end_date', 'field' => 'end_date',
                'formatter' => function ($d, $row)
                {
                    return date( 'd M Y', strtotime($d));
                } 
            ),
           array('db' => '`mw`.`nama_karyawan`', 'dt' => 'nama_karyawan', 'field' => 'nama_karyawan'),
           array('db' => '`mw`.`nik`', 'dt' => 'nik', 'field' => 'nik'),
           array('db' => '`mw`.`telp`', 'dt' => 'telp', 'field' => 'telp'),
           array('db' => '`mw`.`bc`', 'dt' => 'bc', 'field' => 'bc'),
           array('db' => '`mw`.`cabang`', 'dt' => 'cabang', 'field' => 'cabang'),
           array('db' => '`mw`.`region`', 'dt' => 'region', 'field' => 'region'),
           array('db' => '`mw`.`kota`', 'dt' => 'kota', 'field' => 'kota'),
           array('db' => '`mw`.`provinsi`', 'dt' => 'provinsi', 'field' => 'provinsi'),
           array('db' => '`mw`.`id_jenius`', 'dt' => 'actions', 'field' => 'id_jenius'),
        //    array('db' => 'id_device', 'dt' => 'id_device', 'field' => 'id_device'),
        //    array('db' => 'id_device', 'dt' => 'id_device', 'field' => 'id_device'),
       );
       $sql_details = $this->configDB();
       $joinQuery = "FROM `master_jenius` AS `mw` 
       LEFT JOIN `lob` AS `lb` ON (`lb`.`id_lob` = `mw`.`id_lob`)
       LEFT JOIN `tb_service` AS `sc` ON (`sc`.`id_service` = `mw`.`id_service`)";
       return SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery);
    }

    public function warranty()
    {
        $this->load->library('SSP');
        $table = 'master_jenius';
        $primaryKey = 'id_jenius';
        $where =  "`mw`.`id_service`= '1'";
        $columns = array(
            array('db' => '`mw`.`id_jenius`', 'dt' => 'id_jenius', 'field' => 'id_jenius'),
            array('db' => '`mw`.`nama_device`', 'dt' => 'nama_device', 'field' => 'nama_device'),
            array('db' => '`mw`.`brand`', 'dt' => 'brand', 'field' => 'brand'),
            array('db' => '`mw`.`model`', 'dt' => 'model', 'field' => 'model'),
            array('db' => '`mw`.`sn`', 'dt' => 'sn', 'field' => 'sn'),
            array('db' => '`mw`.`imei`', 'dt' => 'imei', 'field' => 'imei'),
            array('db' => '`lb`.`nama_lob`', 'dt' => 'lob', 'field' => 'nama_lob'),
            array('db' => '`mw`.`status_allocated`', 'dt' => 'status_allocated', 'field' => 'status_allocated'),
            array('db' => '`sc`.`service`', 'dt' => 'tb_service', 'field' => 'service'),
            array('db' => '`mw`.`start_date`', 'dt' => 'start_date', 'field' => 'start_date',
                 'formatter' => function ($d, $row)
                 {
                     return date( 'd M Y', strtotime($d));
                 }     
             ),
            array('db' => '`mw`.`end_date`', 'dt' => 'end_date', 'field' => 'end_date',
                 'formatter' => function ($d, $row)
                 {
                     return date( 'd M Y', strtotime($d));
                 } 
             ),
            array('db' => '`mw`.`nama_karyawan`', 'dt' => 'nama_karyawan', 'field' => 'nama_karyawan'),
            array('db' => '`mw`.`nik`', 'dt' => 'nik', 'field' => 'nik'),
            array('db' => '`mw`.`telp`', 'dt' => 'telp', 'field' => 'telp'),
            array('db' => '`mw`.`bc`', 'dt' => 'bc', 'field' => 'bc'),
            array('db' => '`mw`.`cabang`', 'dt' => 'cabang', 'field' => 'cabang'),
            array('db' => '`mw`.`region`', 'dt' => 'region', 'field' => 'region'),
            array('db' => '`mw`.`kota`', 'dt' => 'kota', 'field' => 'kota'),
            array('db' => '`mw`.`provinsi`', 'dt' => 'provinsi', 'field' => 'provinsi'),
            array('db' => '`mw`.`id_jenius`', 'dt' => 'actions', 'field' => 'id_jenius'),
         //    array('db' => 'id_device', 'dt' => 'id_device', 'field' => 'id_device'),
         //    array('db' => 'id_device', 'dt' => 'id_device', 'field' => 'id_device'),
        );
        $sql_details = $this->configDB();
        $joinQuery = "FROM `master_jenius` AS `mw` 
        LEFT JOIN `lob` AS `lb` ON (`lb`.`id_lob` = `mw`.`id_lob`)
        LEFT JOIN `tb_service` AS `sc` ON (`sc`.`id_service` = `mw`.`id_service`)";
        return SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $where);
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