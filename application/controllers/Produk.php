<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends MY_Controller {

    var $meta_title = "INVENTORY | Data Produk";
    var $meta_desc = "INVENTORY";
    var $main_title = "Data Produk";
    var $base_url = "";
    var $base_url_redirect = "";
    var $upload_dir = "";
    var $upload_url = "";
    var $limit = "10";

    public function __construct() {
        parent::__construct();
         $this->base_url = $this->base_url_site . "produk/";
        $this->load->model("Produk_model");
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
                ASSETS_JS_URL . "form/produk.js",
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
        $del_author = $this->Produk_model->delete($id);
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
                ASSETS_JS_URL . "form/produk.js",
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
        $data = $this->Produk_model->getDetail($id);
        
        $arrBreadcrumbs = array(
            "Master Data" => base_url(),
            "produk" => $this->base_url,
            $bread => "#",
        );
        $dt["breadcrumbs"] = $this->setBreadcrumbs($arrBreadcrumbs);
        $dt["title"] = $this->main_title;
        
        $dt['data'] = $data;
        $dt['jenis'] = $this->Produk_model->getJenis();
        $dt['base_url'] = $this->base_url;
        $ret = $this->load->view("product/form", $dt, true);
        return $ret;
    }
    private function _home() {
        $page = isset($_REQUEST["page"]) ? $_REQUEST["page"] : 1;
        $search = isset($_REQUEST["search"]) ? $_REQUEST["search"] : "";
        $start = ($page - 1) * $this->limit;

        $data = $this->Produk_model->getDataIndex($start, $this->limit, $search);
        $countTotal = $this->Produk_model->getCountDataIndex($search);
        $arrBreadcrumbs = array(
            "Manage" => base_url(),
            "Data Product" => $this->base_url,
            "List" => "#",
        );
        $dt["breadcrumbs"] = $this->setBreadcrumbs($arrBreadcrumbs);
        $dt["title"] = $this->main_title;
        $dt["data"] = $data;        
        $dt["pagination"] = $this->_build_pagination($this->base_url, $countTotal, $this->limit, true, "&search=" . $search);
        $dt["base_url"] = $this->base_url;
        $ret = $this->load->view("product/content_produk", $dt, true);
        return $ret;
    }

    private function _saveData($id = '') {
//        echoPre($_POST);exit;
         $user_data = $this->session->get_userdata();
        $id_session = $user_data['user_id'];
        $nama = isset($_POST["nama"]) ? trim($_POST["nama"]) : '';
        $kain= isset($_POST["id_kain"]) ? $_POST["id_kain"] : '';
        $ukuran = isset($_POST["ukuran"]) ? $_POST["ukuran"] : '';
        $nominal = isset($_POST["harga"]) ? $_POST["harga"] : '';
        $harga = str_replace(".", "", $nominal);
//         update 
        if (!empty($nama)) {
            if (!empty($id)) {
                $editAturan = array(
                    "nama" => $nama,
                    "id_kain" => $kain,
                    "ukuran" => $ukuran,
                    "harga" => $harga,
                    "updateddate" => date('Y-m-d h:i:s'),
                    "updatedby" => $id_session,
                );
//                                        echoPre($editAturan);exit;
                $res = $this->Produk_model->updateDetail($editAturan, $id);
                if ($res['status'] == true) {
                    $return = array(
                        "status" => "success",
                        "message" => "Success to update Produk $nama."
                    );
                }
            }
            // insert 
            else {
                $inAturan = array(
                            "nama" => $nama,
                            "id_kain" => $kain,
                            "ukuran" => $ukuran,
                            "harga" => $harga,
                            "createddate" => date('Y-m-d h:i:s'),
                            "createdby" => $id_session,
                        );

                $res = $this->Produk_model->saveData($inAturan);
                if ($res['status'] == true) {
                    $return = array(
                        "status" => "success",
                        "message" => "Success to save Data Produk $nama."
                    );
                }
            }
        }
        return $return;
    }
    public function ajax_list() {
        $post = $this->input->post();
        $nama = $post['IDprovinsi'];         
        $list = $this->Produk_model->get_datatables($nama);
//        echoPre($list);
        $data = array();
//        $no = $_POST['start'];
        foreach ($list as $dt) {
            $hasil_rupiah = "Rp " . number_format($dt->harga,2,',','.');
//            $no++;
            $row = array();
            $row[] = $dt->nama;
            $row[] = $dt->jenis;
            $row[] = $dt->ukuran;
            $row[] = $hasil_rupiah;
            $row[] = '<a href="javascript:void(0)" onclick="editData(' . "'" . $dt->id . "'" . ')" class="btn btn-flat btn-warning btn-sm del"  data-toggle="modal" data-target="#edit-data" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>'
                    . '<a href="javascript:void(0)" onclick="deleteData(' . "'" . $dt->id . "'" . ')" class="btn btn-flat btn-danger btn-sm del"'
                    . ' title="Delete" data-toggle="modal" data-target="#delete-data"><span class="glyphicon glyphicon-trash">'
                    . '</span></a>';
            $data[] = $row;
        }
        $output = array(
//            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Produk_model->count_all(),
            "recordsFiltered" => $this->Produk_model->count_filtered($nama),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}
