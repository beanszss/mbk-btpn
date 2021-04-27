<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_brand_model extends CI_Model
{
    public function index()
    {
        $this->load->library('SSP');
        $table = 'device_brand';
        $primaryKey = 'id_brand';
        $columns = array(
            array('db'=>'id_brand','dt' =>'id_brand','field' =>'id_brand'),
            array('db'=>'nama_brand','dt' =>'nama_brand','field' =>'nama_brand'),
            array('db'=>'created_at','dt' =>'created_at','field' =>'created_at',
                'formatter' => function ($d, $row)
                {
                    return date('d M Y', strtotime($d));
                }
            ),
            array('db'=>'status','dt' =>'status','field' =>'status'),
            array('db'=>'id_brand','dt' =>'actions','field' =>'actions')
        );
        $sql_details = $this->configDB();
        return SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns);
    }

    public function create($data)
    {
        $this->db
        ->insert('device_brand', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function update($data)
    {
        return $this->db
        ->where('id_brand', $this->input->post('id_brand'))
        ->update('device_brand', $data);
    }

    public function getById($id)
    {
        return $this->db
        ->where('id_brand', $id)
        ->get('device_brand')
        ->row_array();
        
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