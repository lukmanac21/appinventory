<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {

    var $table = "mst_kain";
    var $primary_key = "id";
    var $jointTable = "mst_jenis";

    public function __construct() {
        parent::__construct();
    }

    public function getDataIndex($offset = 0, $limit = 10, $status_pembayaran = "", $tanggal = array()) {
       
            if ($status_pembayaran != "") {
                $this->db->where($this->table.'.status', $status_pembayaran);
            }
          
            if (!empty($tanggal) && isset($tanggal['start']) && isset($tanggal['end'])) {
                $this->db->where($this->table.'.tgl BETWEEN "' . $tanggal['start'] . '" AND "' .$tanggal['end'].'"');
           }
        $this->db->from($this->table);
        if($limit != 'all'){
            $this->db->limit($limit);
        
        }
        $this->db->offset($offset);
        $this->db->order_by($this->table . ".tgl ASC");
        $data = $this->db->get();
        return $data->result();
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
    public function getDataIndexexport($tanggal = array()) {
           
            if (!empty($tanggal) && isset($tanggal['start']) && isset($tanggal['end'])) {
                 $this->db->where("tgl1 BETWEEN '".$tanggal['start']."' AND '".$tanggal['end']."'");
            }
            
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->order_by($this->table . ".tgl1 DESC");
        $data = $this->db->get();
        return $data;
    }
    public function getCountDataIndexexport( $status_pembayaran = "",$tanggal = array(), $id_agen = "") {
        
         if(!empty($id_agen)){
                 $this->db->where('id_agen', $id_agen);
               
        }else {
           
            if ($status_pembayaran != "") {
                $this->db->where('status_pembayaran', $status_pembayaran);
            }
            
            if (!empty($tanggal) && isset($tanggal['start']) && isset($tanggal['end'])) {
                $this->db->where('tanggal_transaksi BETWEEN "' . $tanggal['start'] . '" AND "' .$tanggal['end'].'"');
         
            }
        }
        $this->db->select($this->table . '.*, master_agen.nama_agen ');
        $this->db->join('master_agen','master_agen.id_agen = '.$this->table.'.id_agen');
        $this->db->from($this->table);
        $data = $this->db->count_all_results();
        return $data;
    }
    public function getBarangDetail($id) {
        
        $this->db->select( $this->jointTable .' .*, master_barang.*');
        $this->db->from( $this->jointTable);
        $this->db->join('master_barang', 'master_barang.id_barang = '.$this->jointTable.'.id_barang');
        if(is_array($id)){
            $this->db->where_in($this->jointTable.".id_trans_barang", $id);
            $this->db->order_by($this->jointTable.".id_trans_barang", "asc");
        }
        else{
            $this->db->where($this->jointTable.".id_trans_barang", $id);
        }
        
        $query = $this->db->get();
        $resVal = "";
        if ($query->num_rows() > 0) {
            $resVal = $query->result_array();
        } else {
            $resVal = false;
        }
        return $resVal;
    }

   public function getDataTrans($id_kain = "", $id_warna="",$id_satuan="" ){
   
    $this->db->select("
            mst_kain.id,            
            mst_jenis.nama as kain,
            mst_warna.nama as warna,
            mst_satuan.nama as satuan,
            mst_kain.stok,
        ");
        
        $this->db->join("mst_jenis" , "mst_jenis.id = mst_kain.kain_id");
        $this->db->join("mst_warna" , "mst_warna.id = mst_kain.warna_id");
        $this->db->join("mst_satuan" , "mst_satuan.id = mst_kain.satuan_id");
        if($id_kain !=""){
            $this->db->like("mst_kain.kain_id" , $id_kain);           
        } 
        if($id_warna !=""){
            $this->db->like("mst_kain.warna_id" , $id_warna);           
        } 
        if($id_satuan !=""){
            $this->db->like("mst_kain.satuan_id" , $id_satuan);           
        } 
        return $this->db->get_compiled_select($this->table);
        echopre($this->db->last_query());
    }
   
}
