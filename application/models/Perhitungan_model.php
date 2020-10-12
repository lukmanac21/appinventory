<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Perhitungan_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
   public function getDataTrans($tanggal="",$id=""){
        $this->db->select("
            tr_permintaan_detail.permintaan_id,
            tr_permintaan_detail.jumlah,
            tr_permintaan_detail.biaya_simpan,
            tr_permintaan_detail.harga,
            mst_jenis.nama,
            mst_warna.nama as warna,
        ");
        if($tanggal !=""){
                $this->db->where("tr_permintaan.tanggal BETWEEN '".$tanggal['start']."' AND '".$tanggal['end']."'");
        }
        
        if($id !=""){
                $this->db->where("tr_permintaan_detail.id_kain ",$id);
        }
        $this->db->join('tr_permintaan_detail','tr_permintaan_detail.permintaan_id = tr_permintaan.id','left');
        $this->db->join('mst_kain', 'tr_permintaan_detail.id_kain = mst_kain.id');
        $this->db->join('mst_jenis', 'mst_kain.kain_id = mst_jenis.id');
         $this->db->join('mst_warna','mst_kain.warna_id = mst_warna.id');
        $this->db->order_by("tr_permintaan.tanggal ASC"); 
        return $this->db->get_compiled_select('tr_permintaan');
    }
    function getDetail($id="",$tgl=""){
        if($id !="all"){
             $this->db->where('tr_permintaan_detail.id_kain',$id);
        }
        if($tgl !=""){
             $this->db->where("tr_permintaan.tanggal BETWEEN '".$tgl['start']."' AND '".$tgl['end']."'");
        }
        $ret = $this->db->select('SUM(jumlah) as jumlah, SUM(biaya_simpan) as biaya, SUM(harga) as harga')
                ->from('tr_permintaan_detail')
                ->join('tr_permintaan','tr_permintaan.id = tr_permintaan_detail.permintaan_id')
                ->get()->row();
        return $ret;
    }
    function getDataall($id="",$tgl=""){
        if($tgl !=""){
             $this->db->where("tr_permintaan.tanggal BETWEEN '".$tgl['start']."' AND '".$tgl['end']."'");
        }
        $ret = $this->db->select('*')
                ->from('tr_permintaan')
                ->join('tr_permintaan_detail','tr_permintaan_detail.permintaan_id = tr_permintaan.id','left')
                ->get()->result();
        
        return $ret;
    }
}
