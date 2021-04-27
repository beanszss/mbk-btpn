<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model{

    public function getLaporan()
    {
        return $this->db
            ->select('laporan.id_laporan, laporan.case_id, laporan.tiket_btpn, activity.nama_activity, laporan.text, category.nama_category')
            ->join('category', 'category.id_category = laporan.id_category', 'left')
            ->join('activity','activity.id_activity = laporan.id_activity', 'left')
            // ->join('sub_kategori', 'sub_kategori.id_sub_kategori = laporan.id_sub_kategori', 'left')
            ->order_by('laporan.id_laporan', 'DESC')
            // ->where('laporan.status', TRUE)
            ->get('laporan')
            ->row_array();
    }

    public function getDevice()
    {
        return $this->db
            ->select('device.id_device, device.device, device.brand, device.model, device.sn, device.imei, lob.nama_lob, tb_service.service')
            ->join('lob', 'lob.id_lob = device.id_lob', 'left')
            ->join('tb_service', 'tb_service.id_service = device.id_service', 'left')
            ->order_by('device.id_device', 'DESC')
            ->get('device')
            ->row_array();
    }

    public function set_laporan_id($id = FALSE)
    {
        $query = $this->db->get_where('laporan', array('id' => $id));
        return $query->row_array();
    }

    public function getLaporanById($id)
    {
        // $data['laporan'] = $this->getLaporanById($id);
        return $this->db
            ->where('id_laporan', $id)
            ->get('laporan')
            ->row_array();
    }

    public function getKanwil()
    {
        return $this->db
        ->order_by('id_kanwil', 'asc')
        ->where('status', true)
        ->get('kanwil')
        ->result_array();


    }

    public function getKanwilById($id)
    {
        return $this->db
            ->where('id_kanwil', $id)
            ->get('kanwil')
            ->row_array();
    }

    public function getService()
    {
        return $this->db
            ->order_by('id_service', 'asc')
            ->where('status', true)
            ->get('tb_service')
            ->result_array();
    }

    public function getLob()
    {
        return $this->db
            ->order_by('id_lob', 'asc')
            ->where('status', true)
            ->get('lob')
            ->result_array();
    }

    public function getCategory()
    {
        return $this->db
            ->order_by('id_category', 'asc')
            ->where('status', true)
            ->get('category')
            ->result_array();
    }

    public function getCategoryById($id)
    {
        return $this->db
            ->where('id_category', $id)
            ->get('category')
            ->row_array();
    }

    public function get_subKategori()
    {
        return $this->db
            ->order_by('id_sub_kategori', 'asc')
            ->where('status', true)
            ->get('sub_kategori')
            ->result_array();
    }

    public function get_wow()
    {
        $this->db->select('device.id_device, device.device, device.brand, device.model, device.sn, device.imei, lob.nama_lob, tb_service.service')
        ->join('lob', 'lob.id_lob = device.id_lob', 'left')
        ->join('tb_service', 'tb_service.id_service = device.id_service', 'left')
        ->order_by('device.id_device', 'DESC')
        ->where('nama_lob');
        $query = $this->db->get('device');
        foreach ($query->result() as $wow) {
            $data [] = $wow->nama_lob;
        }
        return $data;
    }

    public function getSub_kategori($id_category)
    {
        $this->db->where('id_category', $id_category);
        $query = $this->db
            ->where('status', true)
            ->get('sub_kategori');
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return array();
        }
        return result();

    }

    public function getSub_kategoriById($id)
    {
        return $this->db
            ->where('id_sub_kategori', $id)
            ->get('sub_kategori')
            ->row_array();
    }

    public function getSinaya()
    {
        return $this->db
            ->order_by('id_sinaya', 'DESC')
            ->where('status', true)
            ->get('sinaya')
            ->result_array();
    }

    public function getMur()
    {
        return $this->db
            ->order_by('id_mur', 'DESC')
            ->get('mur')
            ->result_array();
    }

    public function getPur()
    {
        return $this->db
            ->order_by('id_pur', 'DESC')
            ->get('pur')
            ->result_array();
    }

    public function getWOW()
    {
        return $this->db
            ->order_by('id_wow', 'DESC')
            ->get('wow')
            ->result_array();
    }

   public function getUser()
    {
        return $this->db
            ->order_by('id', 'DESC')
            ->get('users')
            ->result();
    }

    public function getUserById($id)
    {
        return $this->db
            ->where('id', $id)
            ->get('users')
            ->row_array();
    }

    public function getSinayaById($id)
    {
        return $this->db
            ->where('id_sinaya', $id)
            ->get('sinaya')
            ->row_array();
    }

    public function getMurById($id)
    {
        return $this->db
            ->where('id_mur', $id)
            ->get('mur')
            ->row_array();
    }
    public function getPurById($id)
    {
        return $this->db
            ->where('id_pur', $id)
            ->get('pur')
            ->row_array();
    }

    public function getWOWById($id)
    {
        return $this->db
            ->where('id_wow', $id)
            ->get('wow')
            ->row_array();
    }

    public function count_master_sinaya()
    {
        return $this->db
            ->select('COUNT(id_sinaya) as master_sinaya')
            ->order_by('master_sinaya', 'desc')
            ->get('master_sinaya')
            ->row()->master_sinaya;
    }

    public function count_warranty_sinaya()
    {
        return $this->db
            ->select('COUNT(id_sinaya) as total')
            ->where('id_service', '1')
            ->order_by('total', 'desc')
            ->get('master_sinaya')
            ->row()->total;
    }

    public function count_other_sinaya()
    {
        return $this->db
            ->select('COUNT(id_sinaya) as other_sinaya')
            ->where('status_allocated', 'BACKUP IT')
            ->order_by('other_sinaya')
            ->get('master_sinaya')
            ->row()->other_sinaya;
    }

    public function count_other_wow()
    {
        return $this->db
            ->select('count(id_wow) as other')
            ->where('status_allocated', 'BACKUP IT')
            ->order_by('other', 'desc')
            ->get('master_wow')
            ->row()->other;
    }

    public function count_master_wow()
    {
        return $this->db
            ->select('COUNT(id_wow) as master_wow')
            ->order_by('master_wow', 'desc')
            ->get('master_wow')
            ->row()->master_wow;
    }

    public function count_warranty_wow()
    {
        return $this->db
            ->select('COUNT(id_wow) as total')
            ->where('id_service', '1')
            ->order_by('total', 'desc')
            ->get('master_wow')
            ->row()->total;
    }

    public function count_master_pur()
    {
        return $this->db
            ->select('COUNT(id_pur) as master_pur')
            ->order_by('master_pur', 'desc')
            ->get('master_pur')
            ->row()->master_pur;
    }

    public function count_warranty_pur()
    {
        return $this->db
            ->select('COUNT(id_pur) as total')
            ->where('id_service', '1 ')
            ->order_by('total', 'desc')
            ->get('master_pur')
            ->row()->total;
    }

    public function count_other_pur()
    {
        return $this->db
            ->select('count(id_pur) as other')
            ->where('status_allocated', 'BACKUP IT')
            ->order_by('other', 'desc')
            ->get('master_pur')
            ->row()->other;
    }

    public function count_master_mur()
    {
        return $this->db
            ->select('COUNT(id_mur) as master_mur')
            ->order_by('master_mur', 'desc')
            ->get('master_mur')
            ->row()->master_mur;
    }

    public function count_warranty_mur()
    {
        return $this->db
            ->select('COUNT(id_mur) as total')
            ->where('id_service', '1')
            ->order_by('total', 'desc')
            ->get('master_mur')
            ->row()->total;
    }

    public function count_other_mur()
    {
        return $this->db
            ->select('COUNT(id_mur) as other')
            ->where('status_allocated', 'BACKUP IT')
            ->order_by('other', 'desc')
            ->get('master_mur')
            ->row()->other;
    }

    public function count_master_smbc()
    {
        return $this->db
            ->select('COUNT(id_smbc) as master_smbc')
            ->get('master_smbc')
            ->row()->master_smbc;
    }

    public function count_warranty_smbc()
    {
        return $this->db
            ->select('COUNT(id_smbc) as total')
            ->where('id_service', '1')
            ->get('master_smbc')
            ->row()->total;
    }

    public function count_other_smbc()
    {
        return $this->db
            ->select('COUNT(id_smbc) as other')
            ->where('nama_karyawan', '')
            ->get('master_smbc')
            ->row()->other;
    }

    public function count_master_jenius()
    {
        return $this->db
            ->select('COUNT(id_jenius) as master_jenius')
            ->get('master_jenius')
            ->row()->master_jenius;
    }

    public function count_warranty_jenius()
    {
        return $this->db
            ->select('COUNT(id_jenius) as total')
            ->where('id_service', '1')
            ->get('master_jenius')
            ->row()->total;
    }

    public function count_other_jenius()
    {
        return $this->db
            ->select('COUNT(id_jenius) as other')
            ->where('nama_karyawan', 'BACKUP JENIUS')
            ->get('master_jenius')
            ->row()->other;
    }

    public function count_master_other()
    {
        return $this->db
            ->select('COUNT(id_other) as master_other')
            ->get('master_other')
            ->row()->master_other;
    }

    public function count_warranty_other()
    {
        return $this->db
            ->select('COUNT(id_other) as total')
            ->where('id_service', '1')
            ->get('master_other')
            ->row()->total;
    }

    public function count_other()
    {
        return $this->db
            ->select('COUNT(id_other) as other')
            // ->where('status_allocated', 'backup jenius')
            ->where('status_allocated', 'backup it')
            ->get('master_other')
            ->row()->other;
    }


    public function getActivity()
    {
        return $this->db
            ->order_by('id_activity', 'asc')
            ->where('status', true)
            ->get('activity')
            ->result_array();
    }

}
