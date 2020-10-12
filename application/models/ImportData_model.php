<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ImportData_model extends CI_Model {

    var $table = "mst_pasien";
    var $primary_key = "id";
//    var $jointTable = "mst_jenis_obat"; 
//    var $jointTableOrtu = "mst_ortu";

    public function __construct() {
        parent::__construct();
//        $this->upload->initialize();
    }

    public function upload_file($filename){
        $this->load->library('upload'); // Load librari upload
		
		$config['upload_path'] = './excel/';
		$config['allowed_types'] = 'xlsx';
		$config['max_size']	= '2048';
		$config['overwrite'] = true;
		$config['file_name'] = $filename;
	
		$this->upload->initialize($config); // Load konfigurasi uploadnya
        
		if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
			// Jika berhasil :
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			return $return;
		}else{
			// Jika gagal :
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
		}
	}
        public function getwhere($id=""){
//            echoPre($id);exit;
              $ret = $this->db->where('nosep', $id)
                ->from('mst_pemeriksaan')
                ->get()->row();
            return $ret;
        }
}
