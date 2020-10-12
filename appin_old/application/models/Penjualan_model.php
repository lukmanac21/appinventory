<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_model extends CI_Model {

    var $table = "tr_penjualan";
    var $primary_key = "id";
    var $column_order = array('id', 'id', null);
    var $jointTable = "tr_penjualan_detail";
//	var $column_search = array('txtProvinsi','txtKabupaten'); 
    var $order = array('id' => 'desc');

    public function __construct() {
        parent::__construct();
    }
    public function check(){

        $ret = $this->db->select('*')
                ->from($this->table)
                ->get()->result();
        return $ret;
    }
    public function getHarga($id){

        $ret = $this->db->select('*')
                ->from('mst_kain')
                ->where('mst_kain.id',$id)
                ->get()->row();
        return $ret;
    }
    public function getPemesanan($id){

        $ret = $this->db->select('*')
                ->from('mst_kain')
                ->where('mst_kain.id',$id)
                ->get()->row();
        return $ret;
    }
    public function getDataIndex($offset = 0, $limit = 10, $search = "") {

        if (!empty($search)) {
            $this->db->like('mst_supplier.nama', $search);
        }
        $this->db->select('tr_penjualan.id,tr_penjualan.status,tr_penjualan.tanggal,mst_supplier.nama,'
                . 'tr_penjualan_detail.jumlah,tr_penjualan_detail.total');
        $this->db->from($this->table);
        $this->db->join('mst_supplier','tr_penjualan.id_supplier = mst_supplier.id','left');
        $this->db->join('tr_penjualan_detail','tr_penjualan.id = tr_penjualan_detail.id_penjualan','left');
        if ($limit != "all") {
            $this->db->limit($limit);
        }
        $this->db->offset($offset);
        $this->db->order_by($this->table . ".id ASC");
        $data = $this->db->get();
        return $data->result();
    }
    public function getProduk(){
        $this->db->select('mst_produk.nama,mst_kain.article,mst_produk.harga,mst_produk.id,mst_produk.ukuran');
        $this->db->from('mst_kain');
           $this->db->join('mst_jenis','mst_kain.kain_id = mst_jenis.id');
           $this->db->join('mst_produk','mst_produk.id_kain = mst_jenis.id');
        $query = $this->db->get();
        $resVal = "";
        if ($query->num_rows() > 0) {
            $resVal = $query->result_array();
        } else {
            $resVal = false;
        }
        return $resVal;
    }
    public function getDetail($id) {
        $this->db->where('tr_penjualan.id', $id);
        $this->db->join('mst_supplier','mst_supplier.id = tr_penjualan.id_supplier','left');
//        $this->db->join('tr_penjualan_detail','tr_penjualan.id = tr_penjualan_detail.id_penjualan','left');
      
        $query = $this->db->get($this->table, 1);
        $resVal = "";
        if ($query->num_rows() > 0) {
            $resVal = $query->result_array();
        } else {
            $resVal = false;
        }
        return $resVal;
    }
     public function getBarangDetail($id) {
        
        $this->db->select('*');
        $this->db->from('tr_penjualan_detail');
          $this->db->join('mst_kain','mst_kain.id = tr_penjualan_detail.id_produk','left');
        $this->db->join('mst_jenis','mst_jenis.id = mst_kain.kain_id','left');
//        $this->db->join('master_barang', 'master_barang.id_barang = '.$this->jointTable.'.id_barang');
        if(is_array($id)){
            $this->db->where_in("tr_penjualan_detail.id_penjualan", $id);
            $this->db->order_by("tr_penjualan_detail.id_penjualan", "asc");
        }
        else{
            $this->db->where("tr_penjualan_detail.id_penjualan", $id);
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
     public function getBarangCount($id) {
        
        $this->db->select('count(id) as count');
        $this->db->from('tr_penjualan_detail');
       
        if(is_array($id)){
            $this->db->where_in("tr_penjualan_detail.id_penjualan", $id);
            $this->db->order_by("tr_penjualan_detail.id_penjualan", "asc");
        }
        else{
            $this->db->where("tr_penjualan_detail.id_penjualan", $id);
        }
        
        $query = $this->db->get();
        $resVal = "";
        if ($query->num_rows() > 0) {
            $resVal = $query->row();
        } else {
            $resVal = false;
        }
        return $resVal;
    }
    public function getCountDataIndex($search = "") {
        if (!empty($search)) {
            $this->db->like('mst_supplier.nama', $search);
        }
        $this->db->select('tr_penjualan.id,tr_penjualan.status,tr_penjualan.tanggal,mst_supplier.nama,'
                . 'tr_penjualan_detail.jumlah,tr_penjualan_detail.total');
        $this->db->from($this->table);
        $this->db->join('mst_supplier','tr_penjualan.id_supplier = mst_supplier.id','left');        
        $this->db->join('tr_penjualan_detail','tr_penjualan.id = tr_penjualan_detail.id_penjualan','left');
        $data = $this->db->count_all_results();
        return $data;
    }

    public function saveData($arrData = array(), $debug = false) {

        $this->db->set($arrData);
        if ($debug) {
            $retVal = $this->db->get_compiled_insert($this->table);
        } else {
            $res = $this->db->insert($this->table);
            if (!$res) {
                $retVal['error_stat'] = "Failed To Insert";
                $retVal['status'] = false;
            } else {
                $retVal['error_stat'] = "Success To Insert";
                $retVal['status'] = true;
                $retVal['id'] = $this->db->insert_id();
            }
        }
        return $retVal;
    }
    public function getDataKain($offset = 0, $limit = 10, $in = array()) {

        if (!empty($in)) {
            $this->db->where_in('id_penjualan', $in);
        }
        $this->db->select('*');
        $this->db->from('tr_penjualan_detail');
        $this->db->join('mst_produk', 'tr_penjualan_detail.id_produk = mst_produk.id');
        $this->db->join('mst_jenis', 'mst_produk.id_kain = mst_jenis.id');
        if($limit != "all"){
            $this->db->limit($limit);
        }  
//        $this->db->where('status_kelas_harga', 1);
        $this->db->offset($offset);
//        $this->db->order_by($this->table . ".id_kelas_harga ASC");
        $data = $this->db->get();
        return $data->result();
    }

    public function updateDetail($array, $id) {

        $this->db->where($this->primary_key, $id);
        $query = $this->db->update($this->table, $array);
        if (!$query) {

            $retVal['error_stat'] = "Failed To Insert";
            $retVal['status'] = false;
        } else {
            $retVal['error_stat'] = "Success To Update";
            $retVal['status'] = true;
            $retVal['id'] = $id;
        }

        return $retVal;
    }
    public function deleteDetail($id) {
        $this->db->where('id_penjualan', $id);
//        $this->db->where('tanggal', $tanggal);
        $q = $this->db->delete('tr_penjualan_detail');
        if (!$q) {
            $retVal['error_stat'] = "Failed To Delete";
            $retVal['status'] = false;
        } else {
            $retVal['error_stat'] = "Success To Delete";
            $retVal['status'] = true;
        }
        return $retVal;
    }
    public function saveUpdateDataDetail($arrData = array(), $debug = false) {
//        echoPre($arrData);exit;
        
        $this->db->set($arrData);
        if ($debug) {
            $retVal = $this->db->get_compiled_insert($this->table);
        } else {
            $res = $this->db->insert('tr_penjualan_detail');
            if (!$res) {
                $retVal['error_stat'] = "Failed To Insert";
                $retVal['status'] = false;
            } else {
                $retVal['error_stat'] = "Success To Insert";
                $retVal['status'] = true;
                $retVal['id'] = $this->db->insert_id();
            }
        }
        return $retVal;
    }
     public function delete($id) {
        $this->db->where($this->primary_key, $id);
        $q = $this->db->delete($this->table);
        if (!$q) {
            $retVal['error_stat'] = "Failed To Delete";
            $retVal['status'] = false;
        } else {
            $retVal['error_stat'] = "Success To Delete";
            $retVal['status'] = true;
        }
        return $retVal;
    }
    private function _get_datatables_query() {
         $this->db->select('tr_penjualan.id,tr_penjualan.status,tr_penjualan.tanggal,tr_penjualan.subtotal,mst_supplier.nama');
        $this->db->from($this->table);
        $this->db->join('mst_supplier','mst_supplier.id = tr_penjualan.id_supplier','left');
        $i = 0;


        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($nama = "") {
        $this->_get_datatables_query();
        $this->db->order_by('mst_supplier.nama ASC');
//        if (!empty($nama)) {
//            $this->db->like("mst_supplier.nama", $nama);
//        }
//        if ($_POST['length'] != -1)
//            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
     public function saveDataDetail($arrData = array(), $debug = false) {

        $this->db->set($arrData);
        if ($debug) {
            $retVal = $this->db->get_compiled_insert($this->table);
        } else {
            $res = $this->db->insert($this->jointTable);
            if (!$res) {
                $retVal['error_stat'] = "Failed To Insert";
                $retVal['status'] = false;
            } else {
                $retVal['error_stat'] = "Success To Insert";
                $retVal['status'] = true;
                $retVal['id'] = $this->db->insert_id();
            }
        }
        return $retVal;
    }
    function count_filtered($nama = "") {
        $this->_get_datatables_query();
        if (!empty($nama)) {
            $this->db->like("mst_supplier.nama", $nama);
        }
//        $this->db->where($this->table.".status =",0);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all() {
        $this->db->from($this->table);
//        $this->db->where($this->table.".status =",0);
        return $this->db->count_all_results();
    }
    public function updated($array, $id) {
 
   
        $this->db->where($this->primary_key, $id);
        $query = $this->db->update($this->table, $array);
        if (!$query) {

            $retVal['error_stat'] = "Failed To Insert";
            $retVal['status'] = false;
        } else {
            $retVal['error_stat'] = "Success To Update";
            $retVal['status'] = true;
            $retVal['id'] = $id;
        }

        return $retVal;
    }
}
