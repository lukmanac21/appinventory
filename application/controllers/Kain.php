<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kain extends MY_Controller {

    var $meta_title = "INVENTORY | Jenis Product Kain";
    var $meta_desc = "INVENTORY";
    var $main_title = "Data Kain";
    var $base_url = "";
    var $base_url_redirect = "";
    var $upload_dir = "";
    var $upload_url = "";
    var $limit = "10";

    public function __construct() {
        parent::__construct();
         $this->base_url = $this->base_url_site . "kain/";
//        $this->base_url_redirect = $this->base_url_site . "kain/";
        $this->load->model("Kain_model");
//        $this->load->model("level_model");
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
                 ASSETS_URL . "plugins/select2/select2.min.js",
                ASSETS_JS_URL . "form/kain.js",
            ),
            "custom_css" => array(
                ASSETS_URL . "plugins/autocomplete/css/jquery.autocomplete.css",
                ASSETS_URL . "plugins/datepicker/datepicker3.css",
                ASSETS_URL . "plugins/select2/select2.min.css",
            ),
        );
        print_r($this->config->item('menu_initial'));
        $this->_render("default", $dt);
    }
    
    
    public function save() {
        $id = isset($_POST["id"]) ? trim($_POST["id"]) : '';
        $alert = $this->_saveData($id);
        $this->session->set_flashdata("alert_pengguna", $alert);
        redirect($this->base_url);
    }

   public function delete($id) {
//     echoPre($id);exit;
        $del_author = $this->Kain_model->delete($id);
        $del_author['status'];
        if ($del_author['status']) {
            $alert = array(
                "status" => "success",
                "message" => "Success to delete Data Jenis Aturan."
            );
        } else {
            $alert = array(
                "status" => "failed",
                "message" => "Failed to delete Data Jenis Aturan."
            );
        }

        $this->session->set_flashdata("alert_pelanggaran", $alert);
        redirect($this->base_url);
    }

     public function edit($id="") {
        $user_data = $this->session->get_userdata();
        $id_session = $user_data['user_id'];
        if (empty($id_session)) {
            redirect();
        }
        $dt = array(
            "title" => $this->meta_title,
            "description" => $this->meta_desc,
            "container" => $this->_homeEdit($id),
            "custom_js" => array(
                 ASSETS_URL . "plugins/select2/select2.min.js",
                ASSETS_JS_URL . "form/jenisaturan.js",
            ),
            "custom_css" => array(
                ASSETS_URL . "plugins/autocomplete/css/jquery.autocomplete.css",
                ASSETS_URL . "plugins/datepicker/datepicker3.css",
                ASSETS_URL . "plugins/select2/select2.min.css",
            ),
        );
        $this->_render("default", $dt);
    }

    private function _homeEdit($id="") {
        $bread = $id ? 'Edit' : 'Add';
        $data = $this->Kain_model->getDetail($id);
        
        $arrBreadcrumbs = array(
            "Master Data" => base_url(),
            "Supplier" => $this->base_url,
            $bread => "#",
        );
        $dt["breadcrumbs"] = $this->setBreadcrumbs($arrBreadcrumbs);
        $dt["title"] = $this->main_title;
        
        $dt['data'] = $data;
//        echoPre($dt['data']);exit;
        $dt['code'] = $this->Kain_model->buat_kode();
        $dt['kain'] = $this->Kain_model->getKadarAir();
        $dt['warna'] = $this->Kain_model->getKotoran();
        $dt['satuan'] = $this->Kain_model->getSatuan();
        $dt['base_url'] = $this->base_url;
        $ret = $this->load->view("product/form_kain", $dt, true);
        return $ret;
    }
    private function _home() {
        $page = isset($_REQUEST["page"]) ? $_REQUEST["page"] : 1;
        $search = isset($_REQUEST["search"]) ? $_REQUEST["search"] : "";
        $start = ($page - 1) * $this->limit;

        $data = $this->Kain_model->getDataIndex($start, $this->limit, $search);
        $countTotal = $this->Kain_model->getCountDataIndex($search);
        $arrBreadcrumbs = array(
            "Manage" => base_url(),
            "Data Product Kain" => $this->base_url,
            "List" => "#",
        );
        $dt["breadcrumbs"] = $this->setBreadcrumbs($arrBreadcrumbs);
        $dt["title"] = $this->main_title;
        
        $dt["data"] = $data;
        
        $dt['code'] = $this->Kain_model->buat_kode();
        $dt['kadarair'] = $this->Kain_model->getKadarAir();
        $dt['kotoran'] = $this->Kain_model->getKotoran();
        $dt['satuan'] = $this->Kain_model->getSatuan();
//        $dt['ukuran'] = $this->Kain_model->getUkuran();
        $dt["pagination"] = $this->_build_pagination($this->base_url, $countTotal, $this->limit, true, "&search=" . $search);
        $dt["base_url"] = $this->base_url;
        $ret = $this->load->view("product/content", $dt, true);
        return $ret;
    }

    private function _saveData($id = '') {
        $user_data = $this->session->get_userdata();
        $id_session = $user_data['user_id'];
        
        $code = isset($_POST["code"]) ? trim($_POST["code"]) : '';
        $nama = isset($_POST["stok"]) ? trim($_POST["stok"]) : '';
        $kain= isset($_POST["kain"]) ? $_POST["kain"] : '';
        $satuan = isset($_POST["satuan"]) ? $_POST["satuan"] : '';
        $warna = isset($_POST["warna"]) ? $_POST["warna"] : '';
        $nominal = isset($_POST["harga"]) ? $_POST["harga"] : '';
        $harga = str_replace(".", "", $nominal);
//         update 
        if (!empty($code)) {
            if (!empty($id)) {
                $editAturan = array(
                    "article" => $code,
                    "stok" => $nama,
                    "satuan_id" => $satuan,
                    "kain_id" => $kain,
                    "warna_id" => $warna,
                );
//                                        echoPre($editAturan);exit;
                $res = $this->Kain_model->updateDetail($editAturan, $id);
                if ($res['status'] == true) {
                    $return = array(
                        "status" => "success",
                        "message" => "Success to update Jenis Kain Code $code."
                    );
                }
            }
            // insert 
            else {
                $inAturan = array(
                     "article" => $code,
                    "stok" => $nama,
                    "satuan_id" => $satuan,
                    "kain_id" => $kain,
                    "warna_id" => $warna,
                    "createddate" => date('Y-m-d h:i:s'),
                    "createdby" =>$id_session,
                );

                $res = $this->Kain_model->saveData($inAturan);
                if ($res['status'] == true) {
                    $return = array(
                        "status" => "success",
                        "message" => "Success to save Jenis Kain Code $code."
                    );
                }
            }
        }
        return $return;
    }
    public function ajax_list() {
        $post = $this->input->post();
        $nama = $post['IDprovinsi'];         
        $list = $this->Kain_model->get_datatables($nama);
        $data = array();
//        $no = $_POST['start'];
        foreach ($list as $dt) {
            $hasil_rupiah = "Rp " . number_format($dt->harga,2,',','.');
//            $no++;
            $row = array();
            $row[] = $dt->article;
            $row[] = $dt->kain;
            $row[] = $dt->warna;
            $row[] = $dt->stok;
            $row[] = $dt->satuan;
            $row[] = '<a href="javascript:void(0)" onclick="editData(' . "'" . $dt->id . "'" . ')" class="btn btn-flat btn-warning btn-sm del"  data-toggle="modal" data-target="#edit-data" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>'
                    . '<a href="javascript:void(0)" onclick="deleteData(' . "'" . $dt->id . "'" . ')" class="btn btn-flat btn-danger btn-sm del"'
                    . ' title="Delete" data-toggle="modal" data-target="#delete-data"><span class="glyphicon glyphicon-trash">'
                    . '</span></a>';
            $data[] = $row;
        }
        $output = array(
//            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Kain_model->count_all(),
            "recordsFiltered" => $this->Kain_model->count_filtered($nama),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}
