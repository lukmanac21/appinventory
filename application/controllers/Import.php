<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends MY_Controller {

    var $meta_title = "appMEC | Import Data Pasien";
    var $meta_desc = "appMEC";
    var $main_title = "Kirim File Data Pasien";
    var $base_url = "";
    var $upload_dir = "";
    var $upload_url = "";
    var $limit = "10";
    private $filename = "import_data";

    public function __construct() {
        parent::__construct();
        $this->base_url = $this->base_url_site . "import/";
        $this->load->model("ImportData_model");
    }

    public function index() {
        $user_data = $this->session->get_userdata();
        $id_session = $user_data['user_id'];
        if (empty($id_session)) {
            redirect();
        }
        $dt = array(
            "title" => $this->meta_title,
            "description" => $this->meta_desc,
            "container" => $this->_home(),
            "custom_js" => array(
                ASSETS_JS_URL . "form/import.js",
                ASSETS_URL . "plugins/datatables/jquery.dataTables.min.js",
                ASSETS_URL . "plugins/datatables/dataTables.bootstrap.min.js",
                ASSETS_URL . "plugins/datatables/dataTables.responsive.js",
                ASSETS_URL . "plugins/select2/select2.full.min.js",
//                ASSETS_URL . "plugins/jQuery/jquery.min.js",
                ASSETS_URL . "plugins/validate/jquery.validate_1.11.1.min.js",
            ),
            "custom_css" => array(
                ASSETS_URL . "plugins/datatables/dataTables.bootstrap.css",
                ASSETS_URL . "plugins/datatables/dataTables.responsive.css",
                ASSETS_URL . "plugins/select2/select2.min.css",
            ),
        );
        $this->_render("default", $dt);
    }

    private function _home() {
        $files = isset($_REQUEST["files"]) ? $_REQUEST["files"] : "";
        $arrBreadcrumbs = array(
            "Home" => base_url(),
            "Kirim File" => $this->base_url,
            "List" => "#",
        );
        $dt["breadcrumbs"] = $this->setBreadcrumbs($arrBreadcrumbs);
        $dt["title"] = $this->main_title;
        $dt['files'] = $files;
        $dt['base_url'] = $this->base_url;
        $ret = $this->load->view("files/add", $dt, true);
        return $ret;
    }

    public function form() {
        $data = array(); // Buat variabel $data sebagai array

        if (isset($_POST['preview'])) {

            $upload = $this->ImportData_model->upload_file($this->filename);
//			echoPre($upload);exit;
            if ($upload['result'] == "success") { // Jika proses upload sukses
                // Load plugin PHPExcel nya
                include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

                $excelreader = new PHPExcel_Reader_Excel2007();
                $loadexcel = $excelreader->load('excel/' . $this->filename . '.xlsx'); // Load file yang tadi diupload ke folder excel
                $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

                $data = $sheet;
            } else { // Jika proses upload gagal
                $data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
            }
        }
        $this->add($data);
    }

    public function add($data = '') {

        $dt = array(
            "title" => $this->meta_title,
            "description" => $this->meta_desc,
            "container" => $this->_add($data),
            "custom_js" => array(
                ASSETS_JS_URL . "form/import.js",
                ASSETS_URL . "plugins/datatables/jquery.dataTables.min.js",
                ASSETS_URL . "plugins/datatables/dataTables.bootstrap.min.js",
                ASSETS_URL . "plugins/datatables/dataTables.responsive.js",
                ASSETS_URL . "plugins/select2/select2.full.min.js",
//                ASSETS_URL . "plugins/jQuery/jquery.min.js",
                ASSETS_URL . "plugins/validate/jquery.validate_1.11.1.min.js",
            ),
            "custom_css" => array(
                ASSETS_URL . "plugins/datatables/dataTables.bootstrap.css",
                ASSETS_URL . "plugins/datatables/dataTables.responsive.css",
                ASSETS_URL . "plugins/select2/select2.min.css",
            ),
        );
        $this->_render("default", $dt);
    }

    private function _add($data) {
        if (!empty($data['upload_error'])) {
            $return = array(
                "status" => "failed",
                "message" => "You did not select a file to upload."
            );
            $this->session->set_flashdata("alert_import", $return);
            redirect($this->base_url);
        } else if ($data == null) {
            $alert = array(
                "status" => "failed",
                "message" => "error to upload file."
            );
            $this->session->set_flashdata("alert_import", $alert);
            redirect($this->base_url);
        } else {
            $alert = array(
                "status" => "success",
                "message" => "Success to upload file."
            );
        }
        $arrBreadcrumbs = array(
            "Home" => base_url(),
            "Import" => $this->base_url,
            "Preview" => "#",
        );
        $dt["breadcrumbs"] = $this->setBreadcrumbs($arrBreadcrumbs);
        $dt["title"] = "Preview Import Data Pasien";
        $dt["base_url"] = $this->base_url;
        $dt['sheet'] = $data;
//        echoPre($data);exit;
        $this->session->set_flashdata("alert_siswa", $alert);
        $ret = $this->load->view("files/form", $dt, true);
        return $ret;
    }

    public function save() {

        // Load plugin PHPExcel
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

        $excelreader = new PHPExcel_Reader_Excel2007();
        $loadexcel = $excelreader->load('excel/' . $this->filename . '.xlsx'); 
        $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
//        echoPre($sheet);exit;
        $data = array();
        $data_duplicate = array();
        $numrow = 1;
        foreach ($sheet as $row) {
          
            $user_data = $this->session->get_userdata();
            $id_session = $user_data['user_id'];
            if ($numrow > 1) {
                if($row['E'] == NULL){
                    $alert = array(
                        "status" => "error",
                        "message" => "error to upload file. undifined colum noka"
                    );

                }
                $cek =  $this->ImportData_model->getwhere($row['B']);
//                echoPre($this->db->last_query());
//                exit;
                if(empty($cek)){
                $insert_mst_pasien = array(
                    'noka' => $row['E'] ? $row['E'] : '',
                    'nama' => $row['G'] ? strtoupper($row['G']) : '',
                    'type' => 1,
                    'createddate' => date('Y-m-d h:i:s'),
                    'createdby' => $id_session,
                );

                 $this->db->insert('mst_pasien', $insert_mst_pasien);
                $id = $this->db->insert_id();
                $in_pemeriksaan = array(
                        'pasien_id' => $id,
                        'diagnosa' => $row['H'] ? $row['H'] : '',
                        'jenis_rawat' => $row['D'] ? $row['D'] : '',
                        'poli' => $row['I'] ? $row['I'] : '',
                        'nosep' => $row['B'] ? $row['B'] : '',
                        'tgl_periksa' => $row['C'] ? $row['C'] : '',
                        'createddate' => date('Y-m-d h:i:s'),
                        'createdby' => $id_session,
                    );
                    $this->db->insert('mst_pemeriksaan', $in_pemeriksaan);
                }
            }
            $numrow++; // Tambah 1 setiap kali looping
        }
        $alert = array(
            "status" => "success",
            "message" => "Success to upload file."
        );

        $this->session->set_flashdata("alert_import", $alert);
        redirect($this->base_url);
    }

}
