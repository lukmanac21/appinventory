<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// APPS START HERE //
$route['pemasukan'] = 'pemasukan/index';
$route['pemasukan/add'] = 'pemasukan/edit';
$route['pemasukan/edit/(:num)'] ='pemasukan/edit/$1';

$route['permintaan'] = 'permintaan/index';
$route['permintaan/add'] = 'permintaan/edit';
$route['permintaan/edit/(:num)'] ='permintaan/edit/$1';

$route['pemesanan'] = 'pemesanan/index';
$route['pemesanan/add'] = 'pemesanan/edit';
$route['pemesanan/edit/(:num)'] ='pemesanan/edit/$1';

$route['penjualan'] = 'penjualan/index';
$route['penjualan/add'] = 'penjualan/edit';
$route['penjualan/edit/(:num)'] ='penjualan/edit/$1';

$route['produk'] = 'produk/index';
$route['produk/add'] = 'produk/edit';
$route['produk/edit/(:num)'] ='produk/edit/$1';

$route['pengeluaran'] = 'pengeluaran/index';
$route['pengeluaran/add'] = 'pengeluaran/edit';
$route['pengeluaran/edit/(:num)'] ='pengeluaran/edit/$1';

//customer
$route['customer'] = 'customer/index';
$route['customer/add'] = 'customer/edit';
$route['customer/edit/(:num)'] ='customer/edit/$1';
$route['customer/delete/(:num)'] ='Customer/delete/$1';

//jenis Supplier
$route['supplier'] = 'supplier/index';
$route['supplier/add'] = 'supplier/edit';
$route['supplier/edit/(:num)'] ='supplier/edit/$1';
$route['supplier/delete/(:num)'] ='Supplier/delete/$1';

//satuan
$route['satuan'] = 'satuan_kain/index';
$route['satuan/add'] = 'satuan_kain/edit';
$route['satuan/edit/(:num)'] ='satuan_kain/edit/$1';
$route['satuan/delete/(:num)'] ='satuan_kain/delete/$1';
//jenis Kain
$route['jenis'] = 'jenis_kain/index';
$route['jenis/add'] = 'jenis_kain/edit';
$route['jenis/kain/edit/(:num)'] ='jenis_kain/edit/$1';
$route['jenis/kain/delete/(:num)'] ='jenis_kain/delete/$1';
//Jenis Warna
//$route['/surat/edit'] = 'surat/edit';
$route['warna'] = "jeniswarna/index";
$route['warna/add'] = 'jeniswarna/edit';
$route['warna/edit/(:num)'] ='jeniswarna/edit/$1';
$route['JenisWarna/delete/(:num)'] = 'jeniswarna/delete/$1';
//jenis Product
$route['kain'] = 'kain/index';
$route['kain/add'] = 'kain/edit';
$route['kain/edit/(:num)'] ='kain/edit/$1';
$route['kain/delete/(:num)'] = 'kain/delete/$1';


$route['Konsultasi/'] = 'Konsultasi/index';
$route['Konsultasi/save'] = 'Konsultasi/index_konsultasi';
$route['/kwintansi/searching'] = 'Kwintansi/searching';
// Jenis Kemasan Routes

// Pengguna Routes
$route['/pengguna'] = 'pengguna/index';
$route['/pengguna/add'] = 'pengguna/add';
$route['/pengguna/save'] = 'pengguna/save';
$route['/pengguna/edit/(:num)'] = function($param , $id){
    return 'pengguna/edit/'.$id;
};
//home
$route['/home/'] ='home/index/';
//profile
$route['/pengguna/delete/(:num)'] = function($param , $id){
      return 'pengguna/delete/'.$id;
};
$route['/profile/save_profile'] = 'profile/save_profile';
$route['/profile/edit/(:num)'] = function($param , $id){
    return 'profile/edit/'.$id;
};

// Level Routers
$route['/level'] = 'level/index';
$route['/level/add'] = 'level/add';
$route['/level/save'] = 'level/save';
$route['/level/edit/(:num)'] = function($param , $id){
    return 'level/edit/'.$id;
};

$route['/level/delete/(:num)'] = function($param , $id){
      return 'pengguna/delete/'.$id;
};
// Login Routes

/// Surat Jalan
$route['suratjalan'] = 'suratjalan/index';
$route['suratjalan/create'] = 'suratjalan/detail';  
$route['suratjalan/edit/(:num)'] = 'suratjalan/detail/$1';  

$route['login'] = 'login/index';
$route['logout'] = 'login/logout';

$route['default_controller'] = 'login/index';
//$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

