<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends MY_Controller {

    var $meta_title = "INVENTORY | Manage Pemesanan";
    var $meta_desc = "INVENTORY";
    var $main_title = "Data Pemesan";
    var $base_url = "";
    var $base_url_redirect = "";
    var $upload_dir = "";
    var $upload_url = "";
    var $limit = "10";

    public function __construct() {
        parent::__construct();
        $this->base_url = $this->base_url_site . "pemesanan/";
//        $this->base_url_redirect = $this->base_url_site . "Manage/Pemesanan/";
        $this->load->model("pemesanan_model");
         $this->load->model("supplier_model");
         $this->load->model("JenisKain_model");
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
               
                ASSETS_JS_URL . "form/pemesanan.js",
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
        $page = isset($_REQUEST["page"]) ? $_REQUEST["page"] : 1;
        $search = isset($_REQUEST["search"]) ? $_REQUEST["search"] : "";
        $start = ($page - 1) * $this->limit;
        $provinsi = isset($_REQUEST["code"]) ? $_REQUEST["code"] : "";
        $data = $this->pemesanan_model->getDataIndex($start, $this->limit, $search);
        $countTotal = $this->pemesanan_model->getCountDataIndex($search);
        $arrBreadcrumbs = array(
            "Master Data" => base_url(),
            "Manage Pemesanan" => $this->base_url,
            "List" => "#",
        );
        $dt["breadcrumbs"] = $this->setBreadcrumbs($arrBreadcrumbs);
        $dt["title"] = $this->main_title;
        $dt['customer'] = $this->supplier_model->getCust();
        $dt['kain'] = $this->pemesanan_model->getKain();
        
        $dt["data"] = $data;
        $dt["pagination"] = $this->_build_pagination($this->base_url, $countTotal, $this->limit, true, "&search=" . $search);
        $dt["base_url"] = $this->base_url;
        $ret = $this->load->view("pemesanan/content", $dt, true);
        return $ret;
    }
    public function ajax_list() {
        $post = $this->input->post();
        $nama = $post['IDprovinsi'] ? $post['IDprovinsi'] : '';
        $list = $this->pemesanan_model->get_datatables($nama);
//        echoPre($this->db->last_query());exit;
        $data = array();
//        $no = $_POST['start'];
        foreach ($list as $dt) {
            $hasil_rupiah = "Rp " . number_format($dt->subtotal,2,',','.');
            $status= ($dt->status == 1) ? "accepted" : "pending";
           $status1= ($dt->status == 0) ? "time" : "check";
           $style= ($dt->status == 0) ? "primary" : "success";
//            $no++;
            $row = array();
             $kain = $this->pemesanan_model->getDataKain(0, 'all', $dt->id);
//             echoPre($this->db->last_query());exit;
                $strkain = "";
                foreach ($kain as $value) {

                    $strkain .='<ul style="list-style: none;padding: 0px;"><li>Kain : <b>'.$value->nama. '</b> : ' .$value->jumlah.'</li>';
                }  
            $row[] =$dt->nama;
//            $row[] = $dt->kain;
            $row[] = date('d M Y',  strtotime($dt->tanggal));
            $row[] = $strkain;
            $row[] = $hasil_rupiah;
            $row[] = $dt->status == 1 ? "<span class='label label-success' title='accepted'><span class='glyphicon glyphicon-check'></span> diTerima</span>" : "<span class='label label-warning' title='pending'><span class='glyphicon glyphicon-time'></span> Tertunda </span>" ;
            $row[] = '<a href="javascript:void(0)" onclick="editData(' . "'" . $dt->id . "'" . ')" class="btn btn-flat btn-warning btn-sm del"  data-toggle="modal" data-target="#edit-data" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>'
                    . '<a href="javascript:void(0)" onclick="deleteData(' . "'" . $dt->id . "'" . ')" '
                    . 'class="btn btn-danger btn-sm del btn-flat" title="Delete" data-toggle="modal" data-target="#delete-data">'
                    . '<span class="glyphicon glyphicon-trash"></span></a>'
                    . '<a href="javascript:void(0)"  onclick="konfirmasiData(' . "'" . $dt->id . "'" . ')" ' 
                  . 'class="btn btn-flat btn-'.$style.'  btn-sm del btn-flat" title="'.$status.'" data-toggle="modal" data-target="#update-data">'
                    . '<span class="glyphicon glyphicon-'.$status1.'"></span></a>';
            $data[] = $row;
        }
        $output = array(
//            "draw" => $_POST['draw'],
            "recordsTotal" => $this->pemesanan_model->count_all(),
            "recordsFiltered" => $this->pemesanan_model->count_filtered($nama),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
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
               
                ASSETS_JS_URL . "form/pemesanan.js",
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

    private function _homeEdit($id="") {
        $bread = $id ? 'Edit' : 'Add';
        
        $data = $this->pemesanan_model->getDetail($id);
       
        $arrBreadcrumbs = array(
            "Master Data" => base_url(),
            "Manage Pemesanan" => $this->base_url,
            $bread => "#",
        );
        $dt["breadcrumbs"] = $this->setBreadcrumbs($arrBreadcrumbs);
        $dt["title"] = $this->main_title;
        
        $dt['customer'] = $this->supplier_model->getCust();
        $dt['kain'] = $this->pemesanan_model->getKain();
//        echoPre($dt['kain']);exit;
        $dt['data'] = $data;
        $dt['base_url'] = $this->base_url;
        if(is_numeric($id)){
            $data = $this->pemesanan_model->getDetail($id);
            $dataBarang = $this->pemesanan_model->getBarangDetail($id);
            $dt['count'] = $this->pemesanan_model->getBarangCount($id);
//            echoPre($this->db->last_query());exit;
            $resData = $data[0];
            $resData["barang"] = $dataBarang;
            $dt['transaksi'] = $resData;
            $dataAgen = $this->supplier_model->getDetail($resData['supplier_id']);
            $dt["supplier"] = $dataAgen;
//            echoPre($dt);exit;
            $ret = $this->load->view("pemesanan/form_edit", $dt, true);
            
        }else {        
            $ret = $this->load->view("pemesanan/form", $dt, true);
        }
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
     public function getAgen($term_id) {
        header('Content-Type: application/json');
        $data = $this->supplier_model->getDetail($term_id);
        $resData = $data;
        echo json_encode($resData);
    }
    public function getHarga($id_barang) {
        header('Content-Type: application/json');
//        echoPre($id_barang);
        $data = $this->JenisKain_model->getDetail($id_barang);
//        echopre($data);
        $resData = $data;
        echo json_encode($resData);
    }
    private function _saveData($id = '') {
        
        $user_data =  $this->session->get_userdata();
        $id_session = $user_data['user_id'];
        $tanggal = isset($_POST["date1"]) ? trim($_POST["date1"]) : '';
        $supplier_id = isset($_POST["supplier_id"]) ? trim($_POST["supplier_id"]) : '';
        $tot= isset($_POST["total_tagihan"]) ? trim($_POST["total_tagihan"]) : '';
        if(!empty($cek_pemesan)){
            $return = array(
                "status" => "failed",
                "message" => "Failed to save Data Pemesanan. data already exists, Please try again."
            );
        } 
        $return = array(
            "status" => "failed",
            "message" => "Failed to save Pemesanan. Please try again."
        );
        // update category
//        if (!empty($code)) {
            if (!empty($id)) {
                $edit = array(
                    "tanggal" => $tanggal,
                    "supplier_id" => $supplier_id,
                    "subtotal" => filterHarga($tot),
                    "updateddate" => date("Y-m-d h:i:s"),
                    "updatedby" => $id_session,
                );
                
                $res = $this->pemesanan_model->updateDetail($edit, $id);
                 $del_author = $this->pemesanan_model->deleteDetail($id);
                 $del_author['status'];
                if ($del_author['status'] == true) {
                   // save detail barang
                   $index_row = isset($_POST["index_row"]) ? trim($_POST["index_row"]) : '';
                  
                   for($i=1; $i <= $index_row;$i++){
                         
                        $id_barang = isset($_POST["id_barang_".$i]) ? trim($_POST["id_barang_".$i]) : '';
                        $jumlah = isset($_POST["jumlah_".$i]) ? trim($_POST["jumlah_".$i]) : '';
//                        $disc = isset($_POST["diskon_".$i]) ? trim($_POST["diskon_".$i]) : '0';
                        $harga_barang = isset($_POST["harga_".$i]) ? trim($_POST["harga_".$i]) : '';
                        $total_harga = isset($_POST["total_".$i]) ? trim($_POST["total_".$i]) : '';
                        
                        if($jumlah != 0){
                            $inDetail = array(
                                "id_pemesanan" => $id,
                                "id_kain" => $id_barang,
                                "jumlah" => $jumlah,
                                "tanggal" => $tanggal,
                                "harga" => filterHarga($harga_barang),
                                "total" => filterHarga($total_harga),
                            );
                            $resDet = $this->pemesanan_model->saveUpdateDataDetail($inDetail);
                        }
                    }
                } 
                 
                if ($res['status'] == true) {
                    $return = array(
                        "status" => "success",
                        "message" => "Success to update Pemesanan."
                    );
                }
            }
            // insert category
            else {
                $insert = array(
                    "tanggal" => $tanggal,
                    "supplier_id" => $supplier_id,
                    "subtotal" => filterHarga($tot),
                    "status" =>  0,
                    "createddate" => date("Y-m-d h:i:s"),
                    "createdby" => $id_session,
                   );
                $res = $this->pemesanan_model->saveData($insert);
                if ($res['status'] == true) {
                     // save detail barang
                    $index_row = isset($_POST["index_row"]) ? trim($_POST["index_row"]) : '';
                    for($i=1; $i <= $index_row;$i++){
                        
                        $id_barang = isset($_POST["id_barang_".$i]) ? trim($_POST["id_barang_".$i]) : '';
                        $jumlah = isset($_POST["jumlah_".$i]) ? trim($_POST["jumlah_".$i]) : '';
//                        $disc = isset($_POST["diskon_".$i]) ? trim($_POST["diskon_".$i]) : '0';
                        $harga_barang = isset($_POST["harga_".$i]) ? trim($_POST["harga_".$i]) : '';
                        $total_harga = isset($_POST["total_".$i]) ? trim($_POST["total_".$i]) : '';
                        
                        if($jumlah != 0){
                            $inDetail = array(
                                "id_pemesanan" => $res['id'],
                                "id_kain" => $id_barang,
                                "jumlah" => $jumlah,
                                "tanggal" => $tanggal,
                                "harga" => filterHarga($harga_barang),
                                "total" => filterHarga($total_harga),
                            );
                            
                            $resDet = $this->pemesanan_model->saveDataDetail($inDetail);
                        }
                    }
                    
                    $return = array(
                        "status" => "success",
                        "message" => "Success to save Pemesanan"
                    );
                }
            }
//        }
        return $return;
    }
 public function delete($id) {
        $del_author = $this->pemesanan_model->delete($id);
                      $this->pemesanan_model->deleteDetail($id);
        $del_author['status'];
        if ($del_author['status']) {
            $alert = array(
                "status" => "success",
                "message" => "Success to delete Manage Pemesanan."
            );
        } else {
            $alert = array(
                "status" => "failed",
                "message" => "Failed to delete Manage Pemesanan."
            );
        }

        $this->session->set_flashdata("alert_pelanggaran", $alert);
        redirect($this->base_url);
    }
   public function konfirmasi($id) {

        $alert = array(
               "status" => "failed",
               "message" => "Failed to Konfirmasi Data Pemesanan. Please try again."
           );
        $cek = $this->db->from('tr_pemesanan')->where('id', $id)->get()->row_array();
   
      if($cek['status']==0) {
          $up =  array(
                    "status" => 1,
      ); } else {
          $up =  array(
                    "status" => 0,
      ); 
      }
        $res = $this->pemesanan_model->updated($up, $id);
        if ($res['status'] == true) {
            $alert = array(
                "status" => "success",
                "message" => "Success to Konfirmasi Data Pemesanan."
            );
        }
        $this->session->set_flashdata("alert_diagnostik", $alert);
        redirect($this->base_url);
    }
}

