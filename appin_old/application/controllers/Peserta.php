<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Peserta extends MY_Controller {

    var $meta_title = "appMEC | Peserta";
    var $meta_desc = "appMEC";
    var $main_title = "Cek Data Peserta";
    var $base_url = "";
    var $upload_dir = "";
    var $upload_url = "";
    var $limit = "10";

    public function __construct() {
        parent::__construct();
        $this->base_url = $this->base_url_site . "peserta/";
//        $this->load->model("pasien_model");
//        $this->load->model("siswa_model");
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
               
                ASSETS_JS_URL . "form/pasien.js",
                ASSETS_URL . "plugins/datatables/jquery.dataTables.min.js",
                ASSETS_URL . "plugins/datatables/dataTables.bootstrap.min.js",
                ASSETS_URL . "plugins/datatables/dataTables.responsive.js",
                ASSETS_URL . "plugins/select2/select2.full.min.js",
                 ASSETS_URL . "plugins/validate/jquery.validate_1.11.1.min.js",
                
            ), 
            "custom_css" => array(
                ASSETS_URL . "plugins/datatables/dataTables.bootstrap.css",
                ASSETS_URL . "plugins/datatables/dataTables.responsive.css",
                ASSETS_URL . "plugins/select2/select2.min.css",
            ),

        );
        $this->_render("default", $dt);
    } public function save() {
        $id = isset($_POST["id"]) ? trim($_POST["id"]) : '';
        
        $alert = $this->_saveData($id);
        $this->session->set_flashdata("alert_siswa", $alert);
        redirect($this->base_url);
    }
    private function _home() {
        $telp = isset($_REQUEST["telp"]) ? $_REQUEST["telp"] : "";
        $nama_pasien = isset($_REQUEST["nama_pasien"]) ? $_REQUEST["nama_pasien"] : "";
        $alamat = isset($_REQUEST["alamat"]) ? $_REQUEST["nama_pasien"] : "";
        $kode_pasien = isset($_REQUEST["kode_pasien"]) ? $_REQUEST["kode_pasien"] : "";
        $arrBreadcrumbs = array(
            "Master Data" => base_url(),
            "Peserta" => $this->base_url,
            "List" => "#",
        );
//        $dt['kode'] = $this->pasien_model->getKode();
//        echoPre($dt['kode']);exit;
//        $dt['dokter'] = $this->siswa_model->check();
        $dt["breadcrumbs"] = $this->setBreadcrumbs($arrBreadcrumbs);
        $dt["title"] = $this->main_title;
        $dt['kode_pasien'] = $kode_pasien;
        $dt['alamat'] = $alamat;
        $dt['telp'] = $telp;
        $dt['nama_pasien'] = $nama_pasien;
        $dt['base_url'] = $this->base_url;
        $ret = $this->load->view("peserta/peserta", $dt, true);
        return $ret;
    }

    private function _saveData($id = '') {
       
        $user_data =  $this->session->get_userdata();
        $id_session = $user_data['user_id'];
       
        $noka = isset($id) ? $id : '';
        $data = "15890";
        $secretKey = "4rLE79938A";
        $url = "https://dvlp.bpjs-kesehatan.go.id/VClaim-Katalog/SEP/1.1/insert";
        // Computes the timestamp
        date_default_timezone_set('UTC');
        $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
          // Computes the signature by hashing the salt with the secret key as the key
        $signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);

        // base64 encode…
        $encodedSignature = base64_encode($signature);
        // urlencode…
         $urlencodedSignature = urlencode($encodedSignature);

//        echoPre("X-cons-id: " .$data ."<br>");
//        echopre("X-timestamp:" .$tStamp ."<br>");
//        echoPre("X-signature: " .$encodedSignature."<br>");
        
        $ch = curl_init();
        $headers = array('X-cons-id : '.$data, 
            'X-timestamp : '. $tStamp,
            'X-signature : '. $encodedSignature,
            'Content-Type: application/json');
        curl_setopt($ch, CURLOPT_URL, "");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_TIMEOUT,3);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $content = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
//        echoPre(curl_error($ch));
        echoPre($content);
        exit();
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//            "X-cons-id : $data",
//            "X-timestamp : $tStamp",
//            "X-signature : $encodedSignature"
//        ));
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_URL, $url.$id);
//        
//        $send = curl_exec($ch);
//        if($send === FALSE){
//            die('error fetching data' . curl_error($ch));
//        }
//        
//        echoPre(htmlspecialchars($send, ENT_QUOTES));
    }
  
}

