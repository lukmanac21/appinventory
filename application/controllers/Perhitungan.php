<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Perhitungan extends MY_Controller {

    var $meta_title = "INVENTORY | Manage Perhitungan";
    var $meta_desc = "INVENTORY";
    var $main_title = "Data Pemesan";
    var $base_url = "";
    var $base_url_redirect = "";
    var $upload_dir = "";
    var $upload_url = "";
    var $limit = "10";

    public function __construct() {
        parent::__construct();
        $this->base_url = $this->base_url_site . "perhitungan/";
//        $this->base_url_redirect = $this->base_url_site . "Manage/Pemesanan/";
        $this->load->model("perhitungan_model");
         $this->load->model("Permintaan_model");
//         $this->load->model("JenisKain_model");
    }
    public function index() {
         $user_data =  $this->session->get_userdata();
        $id_session = $user_data['user_id'];
        if(empty($id_session)){
             redirect();
        }
        $dt = array(
            "title" => $this->meta_title,
            "description" => $this->meta_desc,
            "container" => $this->_home(),
            "custom_js" => array(
               
                ASSETS_JS_URL . "form/perhitungan.js",
                ASSETS_URL . "plugins/datatables/jquery.dataTables.min.js",
                ASSETS_URL . "plugins/datatables/dataTables.bootstrap.min.js",
                ASSETS_URL . "plugins/datepicker/bootstrap-datepicker.js",
                ASSETS_URL . "plugins/daterangepicker/moment.min.js",
                ASSETS_URL . "plugins/daterangepicker/daterangepicker.js",
                 ASSETS_URL . "plugins/select2/select2.min.js",
            ),
            "custom_css" => array(
                 ASSETS_URL . "plugins/select2/select2.min.css",
                ASSETS_URL . "plugins/datepicker/datepicker3.css",
                ASSETS_URL . "plugins/daterangepicker/daterangepicker.css",
                ASSETS_URL . "plugins/datatables/dataTables.bootstrap.css",
            ),
        );
        $this->_render("default", $dt);
    }

    private function _home() {      
        $dtStart =  isset($_REQUEST["date1"]) ? $_REQUEST["date1"] : "";
        $dtEnd =  isset($_REQUEST["date2"]) ? $_REQUEST["date2"] : "";
        $tgl = array();
        if(!empty($dtStart) || ($dtEnd)){
            $tgl['start'] = $dtStart.' 00:00:00';
            $tgl['end'] = $dtEnd.' 23:59:59';
        }
        $post = array(
             'tanggal' => $tgl,
        );
       
        $url = $this->base_url."hitung";
        $arrBreadcrumbs = array(
            "Form" => base_url(),
            "Perhitungan" => $url,
            "EOQ" => "#",
        );
         $dt['jenis'] = $this->Permintaan_model->getKain();
//         echoPre($dt['jenis']);exit;
        $dt["breadcrumbs"] = $this->setBreadcrumbs($arrBreadcrumbs);
        $dt["title"] = "Laporan";
        $dt["base_url"] = $url;
        $dt['post'] = json_encode($post);
        $ret = $this->load->view("perhitungan/content", $dt, true);
        return $ret;
    }
     public function getSearch(){
        $post = $this->input->post();
        
        $dtStart = $post['date1'];
        $dtEnd = $post['date2'];
        $tgl = array();
        if(!empty($dtStart) || ($dtEnd)){
            $tgl['start'] = $dtStart.' 00:00:00';
            $tgl['end'] = $dtEnd.' 23:59:59';
        }
         
         $id = $post['barang'];
         $dataSearch = $this->perhitungan_model->getDetail($id,$tgl);
        if(!empty($dataSearch)){ 
      $callback = array(
        'status' => 'success', 
        'biaya_pesan' => $dataSearch->harga, 
        'biaya' => $dataSearch->biaya, 
        'permintaan_barang' => $dataSearch->jumlah, 
      );
    }else{
      $callback = array('status' => 'failed'); // set array status dengan failed
    }
    echo json_encode($callback); // konversi varibael $callback menjadi JSON
  }
    public function getData(){
        $t = $this->isAjaxPost();     
        $this->load->library('datatables');
        $post = $this->input->post();
        $id = $post['barang'];
        $dtStart = $post['date1'];
        $dtEnd = $post['date2'];
        $tgl = array();
        if(!empty($dtStart) || ($dtEnd)){
            $tgl['start'] = $dtStart.' 00:00:00';
            $tgl['end'] = $dtEnd.' 23:59:59';
        }
        $dataTransaksi = $this->perhitungan_model->getDataTrans($tgl,$id);
        if(!empty($dataTransaksi)){
        $response = $this->datatables->collection($dataTransaksi)
      /*  ->addColumn('nama', function($row) {
            $warna =  $row->nama .' - '. $row->warna;
            return $warna;
        })*/
             ->addColumn('action', function($row) {
                        $btnAksi = sqrt(2 * $row->jumlah * $row->harga / $row->biaya_simpan);
                        return $btnAksi;
                    })
            ->render();
        echo json_encode($response);
        }
    }
    public function hitung(){
        echoPre($_POST);exit;
    }
}

