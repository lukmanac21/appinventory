<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends MY_Controller {

    var $meta_title = "INVENTORY | Manage Pengeluaran";
    var $meta_desc = "INVENTORY";
    var $main_title = "Data Pengeluaran";
    var $base_url = "";
    var $base_url_redirect = "";
    var $upload_dir = "";
    var $upload_url = "";
    var $limit = "10";

    public function __construct() {
        parent::__construct();
        $this->base_url = $this->base_url_site . "pengeluaran/";
//        $this->base_url_redirect = $this->base_url_site . "Manage/Pemesanan/";
        $this->load->model("pengeluaran_model");
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
               
                ASSETS_JS_URL . "form/pengeluaran.js",
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
        $data = $this->pengeluaran_model->getDataIndex($start, $this->limit, $search);
        $countTotal = $this->pengeluaran_model->getCountDataIndex($search);
        $arrBreadcrumbs = array(
            "Master Data" => base_url(),
            "Manage Pengeluaran" => $this->base_url,
            "List" => "#",
        );
        $dt["breadcrumbs"] = $this->setBreadcrumbs($arrBreadcrumbs);
        $dt["title"] = $this->main_title;
        $dt['customer'] = $this->supplier_model->getCust();
        $dt['kain'] = $this->pengeluaran_model->getKain();
        
        $dt["data"] = $data;
        $dt["pagination"] = $this->_build_pagination($this->base_url, $countTotal, $this->limit, true, "&search=" . $search);
        $dt["base_url"] = $this->base_url;
        $ret = $this->load->view("pengeluaran/content", $dt, true);
        return $ret;
    }
public function ajax_list() {
$post = $this->input->post();
$nama = $post['IDprovinsi'] ? $post['IDprovinsi'] : '';
$list = $this->pengeluaran_model->get_datatables($nama);
//        echoPre($this->db->last_query());exit;
$data = array();
//        $no = $_POST['start'];
foreach ($list as $dt) {

$status= ($dt->status == 1) ? "accepted" : "pending";
$status1= ($dt->status == 0) ? "time" : "check";
$style= ($dt->status == 0) ? "primary" : "success";
//            $no++;
$row = array();
$kain = $this->pengeluaran_model->getDataKain(0, 'all', $dt->id);
//             echoPre($this->db->last_query());exit;
$strkain = "";
foreach ($kain as $value) {
$hasil_rupiah = "Rp " . number_format($value->harga,2,',','.');
$sub = $value->harga * $value->jumlah;
$s ="Rp " . number_format($sub,2,',','.');
$strkain .='<ul style="list-style: none;padding: 0px;"><li>Kain  <b>'.$value->nama. '</b> Jumlah pengeluaran <b>' .$value->jumlah.'</b> Harga Per QTY <b>'.$hasil_rupiah.'</b> Subtotal = <b>'.$s.'</b></li>';
}  
$row[] = date('d M Y',  strtotime($dt->tanggal));
$row[] = $strkain;
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
"recordsTotal" => $this->pengeluaran_model->count_all(),
"recordsFiltered" => $this->pengeluaran_model->count_filtered($nama),
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

ASSETS_JS_URL . "form/pengeluaran.js",
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

$data = $this->pengeluaran_model->getDetail($id);

$arrBreadcrumbs = array(
"Master Data" => base_url(),
"Manage Pengeluaran" => $this->base_url,
$bread => "#",
);
$dt["breadcrumbs"] = $this->setBreadcrumbs($arrBreadcrumbs);
$dt["title"] = $this->main_title;

//        $dt['customer'] = $this->supplier_model->getCust();
$dt['kain'] = $this->pengeluaran_model->getKain();
//        echoPre($dt['kain']);exit;
$dt['data'] = $data;
$dt['base_url'] = $this->base_url;
if(is_numeric($id)){
$data = $this->pengeluaran_model->getDetail($id);
$dt['count'] = $this->pengeluaran_model->getBarangCount($id);
$dataBarang = $this->pengeluaran_model->getBarangDetail($id);           
$resData = $data[0];
$resData["barang"] = $dataBarang;
$dt['transaksi'] = $resData;
//            $dataAgen = $this->supplier_model->getDetail($resData['supplier_id']);
//            $dt["supplier"] = $dataAgen;
;
$ret = $this->load->view("pengeluaran/form_edit", $dt, true);

}else {        
$ret = $this->load->view("pengeluaran/form", $dt, true);
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
//        echoPre($_POST);exit;
$user_data =  $this->session->get_userdata();
$id_session = $user_data['user_id'];
$tanggal = isset($_POST["date1"]) ? trim($_POST["date1"]) : '';
$tot= isset($_POST["total_tagihan"]) ? trim($_POST["total_tagihan"]) : '';
$return = array(
"status" => "failed",
"message" => "Failed to save Pemesanan. Please try again."
);
$indexrow = isset($_POST["index_row"]) ? trim($_POST["index_row"]) : ''; 
for($i=1; $i <= $indexrow;$i++){
$idbarang = isset($_POST["id_barang_".$i]) ? trim($_POST["id_barang_".$i]) : '';
$jml_lama = isset($_POST["jumlah_lama_".$i]) ? trim($_POST["jumlah_lama_".$i]) : '';
$jml = isset($_POST["jumlah_".$i]) ? trim($_POST["jumlah_".$i]) : '';
$cek_stok = $this->pengeluaran_model->getDataStok($idbarang);
if(!empty($id)){
if($jml_lama > $jml){                
$jum = $jml_lama - $jml;
$upda= array(
"stok" => $cek_stok->stok + $jum,
);          
$this->pengeluaran_model->updateStok($upda, $idbarang);
} else{
$jumlah = $jml - $jml_lama;

if($cek_stok->stok != 0){
if($cek_stok->stok < $jumlah){
$return = array(
"status" => "failed",
"message" => "Failed to save Pengeluaran. because stok less than the amount."
);
$this->session->set_flashdata("alert_pelanggaran", $return);
redirect($this->base_url);
} else { 

$upd= array(
"stok" => $cek_stok->stok - $jumlah,
);   
$this->pengeluaran_model->updateStok($upd, $idbarang);
}
} else{
$return = array(
"status" => "failed",
"message" => "Failed to save Pengeluaran. because stok null."
);
$this->session->set_flashdata("alert_pelanggaran", $return);
redirect($this->base_url);
}
}
} else{
if($cek_stok->stok != 0){
if($cek_stok->stok < $jml){
$return = array(
"status" => "failed",
"message" => "Failed to save Pengeluaran. because stok less than the amount."
);
$this->session->set_flashdata("alert_pelanggaran", $return);
redirect($this->base_url);
} else { 
$up = array(
"stok" => $cek_stok->stok - $jml,
);                         
$this->pengeluaran_model->updateStok($up, $idbarang);
}
}else{
$return = array(
"status" => "failed",
"message" => "Failed to save Pengeluaran. because stok null."
);
$this->session->set_flashdata("alert_pelanggaran", $return);
redirect($this->base_url);
}
}
}
// update category
//        if (!empty($code)) {
if (!empty($id)) {
$edit = array(
"tanggal" => $tanggal,
//                    "supplier_id" => $supplier_id,
//                    "subtotal" => filterHarga($tot),
"updateddate" => date("Y-m-d h:i:s"),
"updatedby" => $id_session,
);

$res = $this->pengeluaran_model->updateDetail($edit, $id);
$del_author = $this->pengeluaran_model->deleteDetail($id);
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
"id_pengeluaran" => $id,
"id_kain" => $id_barang,
"jumlah" => $jumlah,
//                                "tanggal" => $tanggal,
//                                "harga" => filterHarga($harga_barang),
//                                "total" => filterHarga($total_harga),
);
$resDet = $this->pengeluaran_model->saveUpdateDataDetail($inDetail);
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
//                    "supplier_id" => $supplier_id,
//                    "subtotal" => filterHarga($tot),
"status" =>  0,
"createddate" => date("Y-m-d h:i:s"),
"createdby" => $id_session,
);
$res = $this->pengeluaran_model->saveData($insert);
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
"id_pengeluaran" => $res['id'],
"id_kain" => $id_barang,
"jumlah" => $jumlah,
//                                "tanggal" => $tanggal,
//                                "harga" => filterHarga($harga_barang),
//                                "total" => filterHarga($total_harga),
);

$resDet = $this->pengeluaran_model->saveDataDetail($inDetail);
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
        $del_author = $this->pengeluaran_model->delete($id);
                      $this->pengeluaran_model->deleteDetail($id);
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
        $res = $this->pengeluaran_model->updated($up, $id);
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

