<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class JenisWarna extends MY_Controller {

    var $meta_title = "INVENTORY | Jenis Warna";
    var $meta_desc = "INVENTORY";
    var $main_title = "Data Jenis Warna";
    var $base_url = "";
    var $base_url_redirect = "";
    var $upload_dir = "";
    var $upload_url = "";
    var $limit = "10";

    public function __construct() {
        parent::__construct();
        $this->base_url = $this->base_url_site . "jeniswarna/";
        $this->base_url_redirect = $this->base_url_site . "warna/";
        $this->load->model("JenisWarna_model");
//        $this->load->model("siswa_model");
    }
    public function index() {
         $user_data =  $this->session->get_userdata();
        $id_session = $user_data['user_id'];
       
        if(empty($id_session)){
             redirect();
        }
//         echoPre($id_session);exit;
        $dt = array(
            "title" => $this->meta_title,
            "description" => $this->meta_desc,
            "container" => $this->_home(),
            "custom_js" => array(
                ASSETS_JS_URL . "form/jeniswarna.js",
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
        $data = $this->JenisWarna_model->getDataIndex($start, $this->limit, $search);
        $countTotal = $this->JenisWarna_model->getCountDataIndex($search);
        $arrBreadcrumbs = array(
            "Master Data" => base_url(),
            "Kategori Jenis Warna" => $this->base_url,
            "List" => "#",
        );
        $dt["breadcrumbs"] = $this->setBreadcrumbs($arrBreadcrumbs);
        $dt["title"] = $this->main_title;
        $dt["data"] = $data;
        
        $dt["pagination"] = $this->_build_pagination($this->base_url, $countTotal, $this->limit, true, "&search=" . $search);
        $dt["base_url"] = $this->base_url;
        $ret = $this->load->view("jeniswarna/content", $dt, true);
        return $ret;
    }
    public function ajax_list() {
        $post = $this->input->post();
        $nama = $post['IDprovinsi'];
        $list = $this->JenisWarna_model->get_datatables($nama);
        $data = array();
//        $no = $_POST['start'];
        foreach ($list as $dt) {
//            $no++;
            $row = array();
            $row[] = $dt->nama;
            $row[] = '<a href="javascript:void(0)" onclick="editData(' . "'" . $dt->id . "'" . ')" class="btn btn-flat btn-warning btn-sm del"  data-toggle="modal" data-target="#edit-data" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>'
                    . '<a href="javascript:void(0)" onclick="deleteData(' . "'" . $dt->id . "'" . ')"'
                    . ' class="btn btn-danger btn-flat btn-sm del" title="Delete" data-toggle="modal" data-target="#delete-data">'
                    . '<span class="glyphicon glyphicon-trash"></span></a>';
            $data[] = $row;
        }
        $output = array(
//            "draw" => $_POST['draw'],
            "recordsTotal" => $this->JenisWarna_model->count_all(),
            "recordsFiltered" => $this->JenisWarna_model->count_filtered($nama),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
//    public function edit($term_id) {
//        header('Content-Type: application/json');
//        $data = $this->JenisWarna_model->getDetail($term_id);
//        $resData = $data[0];
//        echo json_encode($resData);
//    }
     public function save() {
        $id = isset($_POST["id"]) ? trim($_POST["id"]) : '';
        $alert = $this->_saveData($id);
        $this->session->set_flashdata("alert_pelanggaran", $alert);
        redirect($this->base_url_redirect);
    }
   
    private function _saveData($id = '') {
        $user_data =  $this->session->get_userdata();
        $id_session = $user_data['user_id'];
        $name = isset($_POST["nama"]) ? trim($_POST["nama"]) : '';
        $return = array(
            "status" => "failed",
            "message" => "Failed to save Jenis Warna. Please try again."
        );

        // update category
        if (!empty($name)) {
            if (!empty($id)) {
                $edit = array(
                    "nama" => $name,
                );
                $res = $this->JenisWarna_model->updateDetail($edit, $id);
                if ($res['status'] == true) {
                    $return = array(
                        "status" => "success",
                        "message" => "Success to update Jenis Warna $name."
                    );
                }
            }
            // insert category
            else {
                $insert = array(
                   "nama" => $name,
                   "createddate" => date("Y-m-d h:i:s"),
                   "createdby" => $id_session,
                );
                $res = $this->JenisWarna_model->saveData($insert);
                if ($res['status'] == true) {
                    $return = array(
                        "status" => "success",
                        "message" => "Success to save Jenis Warna $name."
                    );
                }
            }
        }
        return $return;
    }
 public function delete($id) {
        $del_author = $this->JenisWarna_model->delete($id);
        $del_author['status'];
        if ($del_author['status']) {
            $alert = array(
                "status" => "success",
                "message" => "Success to delete Data Jenis Warna."
            );
        } else {
            $alert = array(
                "status" => "failed",
                "message" => "Failed to delete Data Jenis Warna."
            );
        }

        $this->session->set_flashdata("alert_pelanggaran", $alert);
        redirect($this->base_url_redirect);
    }
    public function edit($id="") {
//         $id = isset($_POST["id"]) ? trim($_POST["id"]) : '';
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
                ASSETS_JS_URL . "form/jenistindakan.js",
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
        $data = $this->JenisWarna_model->getDetail($id);
//        echoPre($id);exit;
        $arrBreadcrumbs = array(
            "Master Data" => base_url(),
            "Warna" => $this->base_url,
            $bread => "#",
        );
        $dt["breadcrumbs"] = $this->setBreadcrumbs($arrBreadcrumbs);
        $dt["title"] = $this->main_title;
        $dt['data'] = $data;
        $dt['base_url'] = $this->base_url;
        $ret = $this->load->view("jeniswarna/form", $dt, true);
        return $ret;
    }

}

