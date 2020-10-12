<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends MY_Controller {

    var $meta_title = "INVENTORY | Master Supplier";
    var $meta_desc = "INVENTORY";
    var $main_title = "Data Supllier";
    var $base_url = "";
    var $base_url_redirect = "";
    var $upload_dir = "";
    var $upload_url = "";
    var $limit = "10";

    public function __construct() {
        parent::__construct();
        $this->base_url = $this->base_url_site . "supplier/";
//        $this->base_url_redirect = $this->base_url_site . "Master/Supplier/";
        $this->load->model("supplier_model");
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
                ASSETS_JS_URL . "form/supplier.js",
                ASSETS_URL . "plugins/datatables/jquery.dataTables.min.js",
                ASSETS_URL . "plugins/datatables/dataTables.bootstrap.min.js",
                ASSETS_URL . "plugins/datepicker/bootstrap-datepicker.js",
                ASSETS_URL . "plugins/daterangepicker/moment.min.js",
                ASSETS_URL . "plugins/daterangepicker/daterangepicker.js",
            ),
            "custom_css" => array(
                ASSETS_URL . "plugins/datepicker/datepicker3.css",
                ASSETS_URL . "plugins/daterangepicker/daterangepicker.css",
                ASSETS_URL . "plugins/datatables/dataTables.bootstrap.css",
            ),
        );
        $this->_render("default", $dt);
    }

    private function _home() {
        $page = isset($_REQUEST["page"]) ? $_REQUEST["page"] : 1;
        $search = isset($_REQUEST["search"]) ? $_REQUEST["search"] : "";
        $start = ($page - 1) * $this->limit;
        $provinsi = isset($_REQUEST["code"]) ? $_REQUEST["code"] : "";
        $data = $this->supplier_model->getDataIndex($start, $this->limit, $search);
        $countTotal = $this->supplier_model->getCountDataIndex($search);
        $arrBreadcrumbs = array(
            "Master Data" => base_url(),
            "Jenis Supplier" => $this->base_url,
            "List" => "#",
        );
        $dt["breadcrumbs"] = $this->setBreadcrumbs($arrBreadcrumbs);
        $dt["title"] = $this->main_title;
        $dt["data"] = $data;
        
        $dt["pagination"] = $this->_build_pagination($this->base_url, $countTotal, $this->limit, true, "&search=" . $search);
        $dt["base_url"] = $this->base_url;
        $ret = $this->load->view("supplier/content", $dt, true);
        return $ret;
    }
    public function ajax_list() {
        $post = $this->input->post();
        $nama = $post['IDprovinsi'];
        $list = $this->supplier_model->get_datatables($nama);
        $data = array();
//        $no = $_POST['start'];
        foreach ($list as $dt) {
//            $no++;
            $row = array();
            $row[] = $dt->nama;
            $row[] = $dt->alamat;
            $row[] = $dt->telp;
            $row[] = '<a href="javascript:void(0)" onclick="editData(' . "'" . $dt->id . "'" . ')" class="btn btn-flat btn-warning btn-sm del"  data-toggle="modal" data-target="#edit-data" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>'
                    . '<a href="javascript:void(0)" onclick="deleteData(' . "'" . $dt->id . "'" . ')" '
                    . 'class="btn btn-flat btn-danger btn-sm del" title="Delete" data-toggle="modal" data-target="#delete-data">'
                    . '<span class="glyphicon glyphicon-trash"></span></a>';
            $data[] = $row;
        }
        $output = array(
//            "draw" => $_POST['draw'],
            "recordsTotal" => $this->supplier_model->count_all(),
            "recordsFiltered" => $this->supplier_model->count_filtered($nama),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
//    public function edit($term_id) {
//        header('Content-Type: application/json');
//        $data = $this->supplier_model->getDetail($term_id);
//        $resData = $data[0];
//        echo json_encode($resData);
//    }
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
                ASSETS_JS_URL . "form/supplier.js",
                ASSETS_URL . "plugins/datatables/jquery.dataTables.min.js",
                ASSETS_URL . "plugins/datatables/dataTables.bootstrap.min.js",
                ASSETS_URL . "plugins/datepicker/bootstrap-datepicker.js",
                ASSETS_URL . "plugins/daterangepicker/moment.min.js",
                ASSETS_URL . "plugins/daterangepicker/daterangepicker.js",
            ),
            "custom_css" => array(
                ASSETS_URL . "plugins/datepicker/datepicker3.css",
                ASSETS_URL . "plugins/daterangepicker/daterangepicker.css",
                ASSETS_URL . "plugins/datatables/dataTables.bootstrap.css",
            ),
        );
        $this->_render("default", $dt);
    }

    private function _homeEdit($id="") {
        $bread = $id ? 'Edit' : 'Add';
        $data = $this->supplier_model->getDetail($id);
        $arrBreadcrumbs = array(
            "Master Data" => base_url(),
            "Supplier" => $this->base_url,
            $bread => "#",
        );
        $dt["breadcrumbs"] = $this->setBreadcrumbs($arrBreadcrumbs);
        $dt["title"] = $this->main_title;
//        echoPre($data);exit;
        $dt['data'] = $data;
        $dt['base_url'] = $this->base_url;
        $ret = $this->load->view("supplier/form", $dt, true);
        return $ret;
    }
     public function save() {
        $id = isset($_POST["id"]) ? trim($_POST["id"]) : '';
        $alert = $this->_saveData($id);
        $this->session->set_flashdata("alert_pelanggaran", $alert);
        redirect($this->base_url);
    }
     public function submit() {
        $id = isset($_POST["id"]) ? trim($_POST["id"]) : '';
        $alert = $this->_saveDatainput($id);
        $this->session->set_flashdata("alert_pelanggaran", $alert);
        redirect('inputpelanggaran');
    }
    private function _saveData($id = '') {

        $user_data =  $this->session->get_userdata();
        $id_session = $user_data['user_id'];
        $nama = isset($_POST["nama"]) ? trim($_POST["nama"]) : '';
        $alamat = isset($_POST["alamat"]) ? trim($_POST["alamat"]) : '';
        $telp = isset($_POST["telp"]) ? trim($_POST["telp"]) : '';
        $return = array(
            "status" => "failed",
            "message" => "Failed to save Supplier. Please try again."
        );
        // update category
//        if (!empty($code)) {
            if (!empty($id)) {
                $edit = array(
                    "alamat" => $alamat,
                    "telp" => $telp,
                     "nama" =>  $nama,
                    "updateddate" => date("Y-m-d h:i:s"),
                    "updatedby" => $id_session,
                );
                $res = $this->supplier_model->updateDetail($edit, $id);
                if ($res['status'] == true) {
                    $return = array(
                        "status" => "success",
                        "message" => "Success to update Supplier $nama."
                    );
                }
            }
            // insert category
            else {
                $insert = array(
                    "alamat" => $alamat,
                    "telp" => $telp,
                    "nama" =>  $nama,
                    "createddate" => date("Y-m-d h:i:s"),
                    "createdby" => $id_session,
                   );
                $res = $this->supplier_model->saveData($insert);
                if ($res['status'] == true) {
                    $return = array(
                        "status" => "success",
                        "message" => "Success to save Jenis Kain $code $nama ."
                    );
                }
            }
//        }
        return $return;
    }
 public function delete($id) {
        $del_author = $this->supplier_model->delete($id);
        $del_author['status'];
        if ($del_author['status']) {
            $alert = array(
                "status" => "success",
                "message" => "Success to delete Data Master Supplier."
            );
        } else {
            $alert = array(
                "status" => "failed",
                "message" => "Failed to delete Data Master Supplier."
            );
        }

        $this->session->set_flashdata("alert_pelanggaran", $alert);
        redirect($this->base_url);
    }
}

