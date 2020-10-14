<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*require('./excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;*/
// End load library phpspreadsheet
class Laporan extends MY_Controller {

    var $meta_title = "APPINVENTORY | Laporan";
    var $meta_desc = "APPINVENTORY";
    var $main_title = "Laporan";
    var $base_url = "";
    var $upload_dir = "";
    var $upload_url = "";
    var $limit = "10";

    public function __construct() {
        parent::__construct();
        $this->base_url = $this->base_url_site . "laporan";
        $this->load->model("laporan_model");
    }

    public function index() {
        $user_data = $this->session->get_userdata();
        $id_session = $user_data['user_id'];
        //$status_session = $user_data['user_status'];
        if(empty($id_session)){
             redirect();
        }
        $dt = array(
            "title" => $this->meta_title,
            "description" => $this->meta_desc,
            "container" => $this->_home(),
            "custom_js" => array(
                ASSETS_JS_URL . "form/laporan.js",
                ASSETS_URL . "plugins/select2/select2.full.min.js", 
                ASSETS_URL . "plugins/datatables/jquery.dataTables.min.js",
                ASSETS_URL . "plugins/datatables/dataTables.bootstrap.min.js",
                ASSETS_URL . "plugins/datepicker/bootstrap-datepicker.js",                
                ASSETS_URL . "plugins/daterangepicker/moment.min.js",
                ASSETS_URL . "plugins/daterangepicker/daterangepicker.js",
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
    private function _home(){
        
        $nomor_surat = isset($_REQUEST["nomor_surat"]) ? $_REQUEST["nomor_surat"] : "";
        $kode = isset($_REQUEST["kode"]) ? $_REQUEST["kode"] : "";
        $isi_ringkasan = isset($_REQUEST["isi_ringkasan"]) ? $_REQUEST["isi_ringkasan"] : "";
        $dtStart =  isset($_REQUEST["date1"]) ? $_REQUEST["date1"] : "";
        $dtEnd =  isset($_REQUEST["date2"]) ? $_REQUEST["date2"] : "";
        $tgl = array();
        if(!empty($dtStart) || ($dtEnd)){
            $tgl['start'] = $dtStart.' 00:00:00';
            $tgl['end'] = $dtEnd.' 23:59:59';
        }
        $post = array(
             'nomor_surat' => $nomor_surat,
             'kode' => $kode,
             'isi_ringkasan' => $isi_ringkasan,
             'tanggal' => $tgl,
        );
       
        $url = $this->base_url_site."laporan/";
        $arrBreadcrumbs = array(
            "Laporan" => base_url(),
            "Laporan Data Surat" => $url,
            "Form" => "#",
        );
        $dt["breadcrumbs"] = $this->setBreadcrumbs($arrBreadcrumbs);
        $dt["title"] = "Laporan";
        $dt['kain'] = $this->laporan_model->getKain();
        $dt['warna'] = $this->laporan_model->getWarna();
        $dt['satuan'] = $this->laporan_model->getSatuan();
        $dt['isi_ringkasan'] = $isi_ringkasan;
        $dt['kode'] = $kode;
        $dt['nomor_surat'] = $nomor_surat;
        $dt["base_url"] = $url;
        $dt['post'] = json_encode($post);
        $ret = $this->load->view("laporan/content", $dt, true);
        return $ret;
    }
   public function getData(){
        $t = $this->isAjaxPost();     
        $this->load->library('datatables');
        
        $post = $this->input->post();
        $id_kain = $post['id_kain'];
        $id_warna = $post['id_warna'];
        $id_satuan = $post['id_satuan'];
        
        /*$dtStart = $post['date1'];
        $dtEnd = $post['date2'];
        $tgl = array();
        if(!empty($dtStart) || ($dtEnd)){
            $tgl['start'] = $dtStart.' 00:00:00';
            $tgl['end'] = $dtEnd.' 23:59:59';
        }*/
        $dataTransaksi = $this->laporan_model->getDataTrans($id_kain,$id_satuan,$id_warna);
        
        if(!empty($dataTransaksi)){
        $response = $this->datatables->collection($dataTransaksi)
            ->render();
        echo json_encode($response);
        }
    }
}
