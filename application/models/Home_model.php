<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    public function getPemesanan(){

        $ret = $this->db->select('sum(id_kain) as pemesanan')
                ->from('tr_pemesanan')
                ->join('tr_pemesanan_detail','tr_pemesanan_detail.id_pemesanan = tr_pemesanan.id')
                ->get()->row();
        return $ret;
    }
    public function getPemasukan(){

        $ret = $this->db->select('sum(id_kain) as pemasukan')
                ->from('tr_pemasukan')
                  ->join('tr_pemasukan_detail','tr_pemasukan_detail.id_pemasukan = tr_pemasukan.id')
                ->get()->row();
        return $ret;
    }
    public function getPermintaan(){

        $ret = $this->db->select('sum(id_kain) as permintaan')
                ->from('tr_permintaan')
                  ->join('tr_permintaan_detail','tr_permintaan_detail.permintaan_id = tr_permintaan.id')
                ->get()->row();
        return $ret;
    }
    public function getPengeluaran(){

        $ret = $this->db->select('sum(id_kain) as pengeluaran')
                ->from('tr_pengeluaran')
                  ->join('tr_pengeluaran_detail','tr_pengeluaran_detail.id_pengeluaran = tr_pengeluaran.id')
                ->get()->row();
        return $ret;
    }
}
