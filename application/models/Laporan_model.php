<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {

    var $table = "mst_kain";
    var $primary_key = "id";
    var $jointTable = "mst_jenis";

    public function __construct() {
        parent::__construct();
    }

    public function getKain(){
        $this->db->select('mst_jenis.nama,mst_jenis.code,mst_jenis.id,');
        $this->db->from('mst_jenis');
          // $this->db->join('mst_kain','mst_kain.kain_id = mst_jenis.id');
        $query = $this->db->get();
        $resVal = "";
        if ($query->num_rows() > 0) {
            $resVal = $query->result_array();
        } else {
            $resVal = false;
        }
        return $resVal;
    }
    public function getWarna(){
        $this->db->select('*');
        $this->db->from('mst_warna');
        $query = $this->db->get();
        $resVal = "";
        if ($query->num_rows() > 0) {
            $resVal = $query->result_array();
        } else {
            $resVal = false;
        }
        return $resVal;
    }
    public function getSatuan(){
        $this->db->select('*');
        $this->db->from('mst_satuan');
        $query = $this->db->get();
        $resVal = "";
        if ($query->num_rows() > 0) {
            $resVal = $query->result_array();
        } else {
            $resVal = false;
        }
        return $resVal;
    }

    private function _get_datatables_query() {
        $this->db->select('mst_kain.stok,
            mst_kain.id,
            mst_jenis.nama as kain,
            mst_warna.nama as warna,
            mst_satuan.nama as satuan');
        $this->db->from('mst_kain');
        $this->db->join('mst_satuan', 'mst_kain.satuan_id = mst_satuan.id');
        $this->db->join('mst_jenis', 'mst_kain.kain_id = mst_jenis.id');
        $this->db->join('mst_warna','mst_kain.warna_id = mst_warna.id');
       
    }
    function get_datatables($id_kain="",$id_warna="",$id_satuan="") {
        $this->_get_datatables_query();
        $this->db->order_by('mst_kain.id ASC');
        if($id_kain !=""){
                $this->db->where("mst_kain.kain_id",$id_kain);
        }
        
        if($id_warna !=""){
                $this->db->where("mst_kain.warna_id ",$id_warna);
        }
        if ($id_satuan != "") {
            $this->db->where("mst_kain.satuan_id", $id_satuan);
        }
        $query = $this->db->get();
        return $query->result();
    }
   
}
