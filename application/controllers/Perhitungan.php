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
        $leadtime = $post['lead_team'];
        $tgl = array();
        if(!empty($dtStart) || ($dtEnd)){
            $tgl['start'] = $dtStart.' 00:00:00';
            $tgl['end'] = $dtEnd.' 23:59:59';
        }
       $begin = new DateTime($dtStart);
        $end = new DateTime($dtEnd);

        $daterange     = new DatePeriod($begin, new DateInterval('P1D'), $end);
        //mendapatkan range antara dua tanggal dan di looping
        $i=0;
        $x     =    0;
        $end     =    1;
        $day = "";
        foreach($daterange as $date){
            $daterange     = $date->format("Y-m-d");
            $datetime     = DateTime::createFromFormat('Y-m-d', $daterange);
            //Convert tanggal untuk mendapatkan nama hari
            $day         = $datetime->format('D');
            //Check untuk menghitung yang bukan hari sabtu dan minggu
            if($day!="Sun" && $day!="Sat") {
                $x    +=    $end-$i;
            }
            $end++;
            $i++;
        } 
        $list = $this->perhitungan_model->get_datatables($tgl,$id);
        $data = array();
        foreach ($list as $dt) {
            $Eoq =  sqrt(2 * $dt->jumlah * $dt->harga / $dt->biaya_simpan);
            $kebutuhan =  $dt->jumlah / $x;
//            $no++;
            $row = array();
            $row[] = $dt->nama;
            $row[] = $dt->warna;
            $row[] = $dt->jumlah;
            $row[] = $dt->harga;
            $row[] = $dt->biaya_simpan;
            $row[] = $Eoq;
            $row[] = $kebutuhan;
            $row[] = $kebutuhan * $leadtime;
            $row[] = $x * $end / $dt->jumlah;
            $data[] = $row;
        }
        $output = array(
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function hitung(){
        echoPre($_POST);exit;
    }
}

