<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MY_Controller {

    var $meta_title = "INVENTORY | Master Customer";
    var $meta_desc = "INVENTORY";
    var $main_title = "Data Customer";
    var $base_url = "";
    var $base_url_redirect = "";
    var $upload_dir = "";
    var $upload_url = "";
    var $limit = "10";

    public function __construct() {
        parent::__construct();
        $this->base_url = $this->base_url_site . "customer/";
//        $this->base_url_redirect = $this->base_url_site . "Master/Customer/";
        $this->load->model("customer_model");
    }
    public function index() {
         $user_data =  $this->session->get_userdata();
        $id_session = $user_data['user_id'];
//        echoPre($id_session);exit;
        if(empty($id_session)){
             redirect();
        }
        $dt = array(
            "title" => $this->meta_title,
            "description" => $this->meta_desc,
            "container" => $this->_home(),
            "custom_js" => array(
                ASSETS_JS_URL . "form/customer.js",
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
        $data = $this->customer_model->getDataIndex($start, $this->limit, $search);
        $countTotal = $this->customer_model->getCountDataIndex($search);
        $arrBreadcrumbs = array(
            "Master Data" => base_url(),
            "Jenis Customer" => $this->base_url,
            "List" => "#",
        );
        $dt["breadcrumbs"] = $this->setBreadcrumbs($arrBreadcrumbs);
        $dt["title"] = $this->main_title;
        $dt["data"] = $data;
        
        $dt["pagination"] = $this->_build_pagination($this->base_url, $countTotal, $this->limit, true, "&search=" . $search);
        $dt["base_url"] = $this->base_url;
        $ret = $this->load->view("customer/content", $dt, true);
        return $ret;
    }
    public function ajax_list() {
        $post = $this->input->post();
        $nama = $post['IDprovinsi'];
        $list = $this->customer_model->get_datatables($nama);
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
                    . 'class="btn btn-danger btn-flat btn-sm del" title="Delete" data-toggle="modal" data-target="#delete-data">'
                    . '<span class="glyphicon glyphicon-trash"></span></a>';
            $data[] = $row;
        }
        $output = array(
//            "draw" => $_POST['draw'],
            "recordsTotal" => $this->customer_model->count_all(),
            "recordsFiltered" => $this->customer_model->count_filtered($nama),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
//    public function edit($term_id) {
//        header('Content-Type: application/json');
//        $data = $this->customer_model->getDetail($term_id);
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
                ASSETS_JS_URL . "form/customer.js",
                ASSETS_URL . "plugins/datatables/jquery.dataTables.min.js",
                ASSETS_URL . "plugins/datatables/dataTables.bootstrap.min.js",
                ASSETS_URL . "plugins/datatables/dataTables.responsive.js",
                ASSETS_URL . "plugins/select2/select2.full.min.js",
                ASSETS_URL . "plugins/validate/jquery.validate_1.11.1.min.js",
                ASSETS_URL . "plugins/datetimepicker/js/moment.js",
                ASSETS_URL . "plugins/datepicker/bootstrap-datepicker.js",
                ASSETS_URL . "plugins/datetimepicker/js/bootstrap-datetimepicker.min.js",
                ASSETS_URL . "plugins/autocomplete/js/jquery.autocomplete.js",
                ASSETS_URL . "plugins/daterangepicker/daterangepicker.js",
                ASSETS_URL . "plugins/ckeditor/ckeditor.js",
                ASSETS_URL . "plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js",
            ),
            "custom_css" => array(
                ASSETS_URL . "plugins/autocomplete/css/jquery.autocomplete.css",
                ASSETS_URL . "plugins/datepicker/datepicker3.css",
                ASSETS_URL . "plugins/daterangepicker/daterangepicker.css",
                ASSETS_URL . "plugins/datatables/dataTables.bootstrap.css",
                ASSETS_URL . "plugins/datatables/dataTables.responsive.css",
                ASSETS_URL . "plugins/select2/select2.min.css",
                ASSETS_URL . "plugins/datetimepicker/css/bootstrap-datetimepicker.min.css",
                ASSETS_URL . "plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css",
            ),
        );
        $this->_render("default", $dt);
    }

    private function _homeEdit($id="") {
        $bread = $id ? 'Edit' : 'Add';
        $data = $this->customer_model->getDetail($id);
        $arrBreadcrumbs = array(
            "Master Data" => base_url(),
            "Customer" => $this->base_url,
            $bread => "#",
        );
        $dt["breadcrumbs"] = $this->setBreadcrumbs($arrBreadcrumbs);
        $dt["title"] = $this->main_title;
        $dt['data'] = $data;
        $dt['base_url'] = $this->base_url;
        $ret = $this->load->view("customer/form", $dt, true);
        return $ret;
    }
     public function save() {
        $id = isset($_POST["id"]) ? trim($_POST["id"]) : '';
        $alert = $this->_saveData($id);
        $this->session->set_flashdata("alert_pelanggaran", $alert);
        redirect($this->base_url);
    }
    private function _saveData($id = '') {

        $user_data =  $this->session->get_userdata();
        $id_session = $user_data['user_id'];
        $nama = isset($_POST["nama"]) ? trim($_POST["nama"]) : '';
        $alamat = isset($_POST["alamat"]) ? trim($_POST["alamat"]) : '';
        $telp = isset($_POST["telp"]) ? trim($_POST["telp"]) : '';
        $return = array(
            "status" => "failed",
            "message" => "Failed to save Customer. Please try again."
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
                $res = $this->customer_model->updateDetail($edit, $id);
                if ($res['status'] == true) {
                    $return = array(
                        "status" => "success",
                        "message" => "Success to update Customer $nama."
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
                $res = $this->customer_model->saveData($insert);
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
        $del_author = $this->customer_model->delete($id);
        $del_author['status'];
        if ($del_author['status']) {
            $alert = array(
                "status" => "success",
                "message" => "Success to delete Data Master Customer."
            );
        } else {
            $alert = array(
                "status" => "failed",
                "message" => "Failed to delete Data Master Customer."
            );
        }

        $this->session->set_flashdata("alert_pelanggaran", $alert);
        redirect($this->base_url);
    }
}

