<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kwintansi_model extends CI_Model {

    var $table = "mst_himpunan";
    var $primary_key = "id";

    public function __construct() {
        parent::__construct();
    }

    public function getDataKwin($kadar = "", $kotoran = "", $ukuran = "") {

        $data_aturan = $this->db->select('*')->from('mst_aturan')->get()->result_array();

        $retval = array();
        $datakadar = $this->db->select('*')->from('mst_himpunan')->like('name_kriteria', 'Kadar Air')->get()->row_array();
        $datakotoran = $this->db->select('*')->from('mst_himpunan')->like('name_kriteria', 'Kotoran')->get()->row_array();
        $dataUkuran = $this->db->select('*')->from('mst_himpunan')->like('name_kriteria', 'ukuran')->get()->row_array();
        $dataKualitas = $this->db->select('*')->from('mst_himpunan')->like('name_kriteria', 'kualitas')->get()->row_array();
        // Mencari Miu Kadar Air Rendah
        if ($kadar != "") {
            $retval['Kadar_Air_Rendah'] = ($datakadar['b'] - $kadar) / ($datakadar['b'] - $datakadar['a']);
        } else {
            $retval['Kadar_Air_Rendah'] = "";
        }

        // Mencari Miu Kadar Air Tinggi
        if ($kadar != "") {
            $retval['Kadar_Air_Tinggi'] = ($kadar - $datakadar['a']) / ($datakadar['b'] - $datakadar['a']);
        } else {
            $retval['Kadar_Air_Tinggi'] = "";
        }
//        Mencari Miu Kotoran Rendah
        if ($kotoran != "") {
            $retval['Kotoran_Rendah'] = ($datakotoran['b'] - $kotoran) / ($datakotoran['b'] - $datakotoran['a']);
        } else {
            $retval['Kotoran_Rendah'] = "";
        }
        // Mencari Miu Kotoran Tinggi
        if ($kotoran != "") {
            $retval['Kotoran_Tinggi'] = ($kotoran - $datakotoran['a']) / ($datakotoran['b'] - $datakotoran['a']);
        } else {
            $retval['Kotoran_Tinggi'] = "";
        }

//        Mencari Miu Ukuran Rendah
        if ($ukuran != "") {
            $retval['Ukuran_Kecil'] = ($dataUkuran['b'] - $ukuran) / ($dataUkuran['b'] - $dataUkuran['a']);
        } else {
            $retval['Ukuran_Kecil'] = "";
        }
        // Mencari Miu Ukuran Tinggi
        if ($ukuran != "") {
            $retval['Ukuran_Besar'] = ($ukuran - $dataUkuran['a']) / ($dataUkuran['b'] - $dataUkuran['a']);
        } else {
            $retval['Ukuran_Besar'] = "";
        }
//        mencari Miu Kualitas Ubi Baik dan Buruk
//        if (($kadar != "") || ($ukuran != "") || ($kotoran != "")) {
//            $retval['Kualitas_Ubi_Buruk'] = ($dataKualitas['b'] - $ukuran) / ($dataKualitas['b'] - $dataKualitas['a']);
//            $retval['Kualitas_Ubi_Baik'] = ($ukuran - $dataKualitas['a']) / ($dataKualitas['b'] - $dataKualitas['a']);
//        }
        //var_dump($retval);
//        return $retval;
        $alphas = array();
        $zs = array();
        $ro = array();
        if (!empty($data_aturan)) {
            foreach ($data_aturan as $rows) {
                if ($rows['id'] == 1) {
//              r01
                    $ro[$rows['code']] = $rows['kesimpulan'];
                    array_push($alphas, min($retval['Kadar_Air_Tinggi'], $retval['Kotoran_Rendah'], $retval['Ukuran_Kecil']));
                    $temp = $dataKualitas['a'] + (end($alphas) * ($dataKualitas['b'] - $dataKualitas['a']));
                    array_push($zs, $temp);
                } else if ($rows['id'] == 2) {
//                r02
                    $ro[$rows['code']] = $rows['kesimpulan'];
                    array_push($alphas, min($retval['Kadar_Air_Tinggi'], $retval['Kotoran_Tinggi'], $retval['Ukuran_Besar']));
                    $temp = $dataKualitas['a'] + (end($alphas) * ($dataKualitas['b'] - $dataKualitas['a']));
                    array_push($zs, $temp);
                } else if ($rows['id'] == 3) {
//                r03
                    $ro[$rows['code']] = $rows['kesimpulan'];
                    array_push($alphas, min($retval['Kadar_Air_Tinggi'], $retval['Kotoran_Tinggi'], $retval['Ukuran_Kecil']));
                    $temp = $dataKualitas['b'] - (end($alphas) * ($dataKualitas['b'] - $dataKualitas['a']));
                    array_push($zs, $temp);
                } else if ($rows['id'] == 4) {
//                r04
                    $ro[$rows['code']] = $rows['kesimpulan'];
                    array_push($alphas, min($retval['Kadar_Air_Rendah'], $retval['Kotoran_Rendah'], $retval['Ukuran_Kecil']));
                    $temp = $dataKualitas['b'] - (end($alphas) * ($dataKualitas['b'] - $dataKualitas['a']));
                    array_push($zs, $temp);
                } else if ($rows['id'] == 5) {
//                r05
                    $ro[$rows['code']] = $rows['kesimpulan'];
                    array_push($alphas, min($retval['Kadar_Air_Rendah'], $retval['Kotoran_Tinggi'], $retval['Ukuran_Besar']));
                    $temp = $dataKualitas['a'] + (end($alphas) * ($dataKualitas['b'] - $dataKualitas['a']));
                    array_push($zs, $temp);
                } else if ($rows['id'] == 6) {
//                r06
                    $ro[$rows['code']] = $rows['kesimpulan'];
                    array_push($alphas, min($retval['Kadar_Air_Rendah'], $retval['Kotoran_Tinggi'], $retval['Ukuran_Kecil']));
                    $temp = $dataKualitas['b'] - (end($alphas) * ($dataKualitas['b'] - $dataKualitas['a']));
                    array_push($zs, $temp);
                }
            }
        }
        $counter = "";
        $counter2 = "";
        if (!empty($alphas)) {
            for ($i = 0; $i < count($alphas) - 1; $i++) {
                $counter += $alphas[$i] * $zs[$i];
                $counter2 += $alphas[$i];
            }
            
        }
        if(!empty($counter) || !empty($counter2)){
            $htemp = $counter / $counter2;
        }
        return $ro;
//         $this->db->select(" * ");
//        if($kadar !=""){
//              $this->db->where("" , $status_pembayaran);           
//        } 
//        if($tanggal !=""){
//                $this->db->where("mst_pemeriksaan.tgl_periksa BETWEEN '".$tanggal['start']."' AND '".$tanggal['end']."'");
//        }
//        $this->db->order_by("mst_pemeriksaan.nosep DESC"); 
//        return $this->db->get_compiled_select($this->table);
    }

    public function update($array, $id) {

        $this->db->where($this->primary_key, $id);
        $query = $this->db->update($this->table, $array);
        if (!$query) {

            $retVal['error_stat'] = "Failed To Insert";
            $retVal['status'] = false;
        } else {
            $retVal['error_stat'] = "Success To Update";
            $retVal['status'] = true;
            $retVal['id'] = $id;
        }

        return $retVal;
    }

    public function updatedrm($array, $id) {

        $this->db->where("nama", $id);
        $query = $this->db->update('mst_pasien', $array);
        if (!$query) {

            $retVal['error_stat'] = "Failed To Insert";
            $retVal['status'] = false;
        } else {
            $retVal['error_stat'] = "Success To Update";
            $retVal['status'] = true;
            $retVal['id'] = $id;
        }

        return $retVal;
    }

}
