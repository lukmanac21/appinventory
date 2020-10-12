<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kain_model extends CI_Model {

    var $table = "mst_kain";
    var $primary_key = "id";
    var $column_order = array('article', 'article', null);
    public function __construct() {
        parent::__construct();
    }

    public function getDataIndex($offset = 0, $limit = 10, $search = "") {

         if (!empty($search)) {
            $this->db->like('article', $search);
        }
        $this->db->from($this->table);
//        $this->db->join('mst_himpunan','');
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by($this->table . ".article ASC");
        $data = $this->db->get();
        return $data->result();
    }
    public function getKadarAir(){
//        $this->db->like('nama', 'kadar air');
        $query = $this->db->get('mst_jenis');
        $resVal = "";
        if ($query->num_rows() > 0) {
            $resVal = $query->result_array();
        } else {
            $resVal = false;
        }
        return $resVal;
    }
    public function getKotoran(){
        $query = $this->db->get('mst_warna');
        $resVal = "";
        if ($query->num_rows() > 0) {
            $resVal = $query->result_array();
        } else {
            $resVal = false;
        }
        return $resVal;
    }
    public function getSatuan(){
        $query = $this->db->get('mst_satuan');
        $resVal = "";
        if ($query->num_rows() > 0) {
            $resVal = $query->result_array();
        } else {
            $resVal = false;
        }
        return $resVal;
    }
    public function buat_kode()   {
		  $this->db->select('MAX(RIGHT(mst_kain.id,2)) as kode', FALSE);
		  $this->db->order_by('id','DESC');    
		  $this->db->limit(1);    
		  $query = $this->db->get('mst_kain');         
		  if($query->num_rows() <> 0){      
		   //jika kode ternyata sudah ada.      
		   $data = $query->row();                   
		   $kode = intval($data->kode) + 1;    
		  }
		  else {      
		   //jika kode belum ada      
		   $kode = 1;    
		  }

		  $kodemax = str_pad($kode, 2, "0", STR_PAD_LEFT); // angka 2 menunjukkan jumlah digit angka 0
		  $kodejadi = "P".$kodemax;    // hasilnya R01 dst.
		  return $kodejadi;  
	}
    public function getDetail($id) {
        $this->db->where($this->primary_key, $id);
        $query = $this->db->get($this->table, 1);
        $resVal = "";
        if ($query->num_rows() > 0) {
            $resVal = $query->row_array();
        } else {
            $resVal = false;
        }
        return $resVal;
    }
    
    public function getByLevel($id) {
        $this->db->where('id_level', $id);
        $query = $this->db->get($this->table, 1);
        $resVal = "";
        if ($query->num_rows() > 0) {
            $resVal = $query->result_array();
        } else {
            $resVal = false;
        }
        return $resVal;
    }

    public function getCountDataIndex($search = "") {
        if (!empty($search)) {
            $this->db->like('article', $search);
        }
        $this->db->select($this->table . '.* ');
        $this->db->from($this->table);
        $data = $this->db->count_all_results();
        return $data;
    }
     function count_filtered($nama = "") {
        $this->_get_datatables_query();
        if (!empty($nama)) {
            $this->db->like("article", $nama);
        }
//        $this->db->where('status =',1);
        $query = $this->db->get();
        return $query->num_rows();
    }
     public function count_all() {
        $this->db->from($this->table);
//        $this->db->where('mst_jenis_tindakan_op.status =',1);
        return $this->db->count_all_results();
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
        $this->db->select('mst_kain.stok,mst_kain.article,'
                . 'mst_kain.harga,mst_jenis.nama as kain,mst_warna.nama as warna,mst_kain.id,mst_satuan.nama as satuan');
        $this->db->from($this->table);
        $this->db->join('mst_jenis','mst_jenis.id = mst_kain.kain_id','left');
        $this->db->join('mst_warna','mst_warna.id = mst_kain.warna_id','left');
        $this->db->join('mst_satuan','mst_satuan.id = mst_kain.satuan_id','left');
        $i = 0;
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_datatables($nama = "") {
        $this->_get_datatables_query();
        $this->db->order_by('article ASC');
//         $this->db->where($this->table.".status =",1);
//        if (!empty($nama)) {
//            $this->db->like("article", $nama);
//        }
//        if ($_POST['length'] != -1)
//            $this->db->limit($_POST['length'], $_POST['start']);
        
        $query = $this->db->get();
        return $query->result();
    }
}
