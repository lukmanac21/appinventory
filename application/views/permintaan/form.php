    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$title?>
      </h1>
      <?=$breadcrumbs?>
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="row">
        <form action="<?php echo $base_url; ?>save" method="post" id="formTransaksi" class="form-horizontal">
            <!-- Barang -->
            <div class="col-md-12">
                           
                <input type="hidden" id="index_row" name="index_row" value="1" />
                
                <div class="box box-warning">
                    <div class="box-header">
                        <h3 class="box-title">Data Barang</h3>
                    </div>
                     <div class="form-group">
                                <label class="col-sm-3 control-label">Tanggal Pemesanan</label>
                                <div class="col-sm-3">
                                    <input id="date1" class="form-control pull-right" name="date1" id="date1"  value="<?= $data['tanggal'] ? $data['tanggal'] : date('Y-m-d')?>" type="text">
                                 </div>
                            </div>
<!--                     <div class="form-group">
                                <label class="col-sm-3 control-label">Biaya Simpan</label>
                                <div class="col-sm-3">
                                     <input type="text" placeholder="Biaya Simpan"  class="form-control money-input" maxlength="11" name="biaya_simpan" id="biaya_simpan">
                                 
                                </div>
                            </div>-->
                    <div class="box-body table-responsive ">
                        <table class="table table-hover table-striped" id="tabel_barang">
                            <tr>
                                <th style="width:30%">Nama Barang</th>
                                <th>Warna</th>                                
                                <th>Satuan</th>
                                <th>Jumlah</th>
                                <th>Biaya Simpan</th>
                                <th>Harga Satuan</th>
                                <th>Total</th>
                                <th>Delete</th>
                            </tr>
                            <tr id="barang_0" style="display: none;" data-id="0">
                                <td>
                                    <select id="id_barang_0"  name="id_barang_0" class="form-control pilih_barang" onchange="getHarga('id_barang_0')">
                                        <option value="0">Pilih Kain</option>
                                        
                                        <?php foreach($kain as $I):?>
                                             <option value="<?=$I['id']?>" > <?= $I['code'] .'-'. $I['kain']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <!--input type="text" value="" class="form-control" placeholder="Wa" name="ukuran_0" id="ukuran_0" readonly="readonly"-->
                                    <select id="id_warna_0"  name="id_warna_0" class="form-control pilih_warna">
                                        <option value="0">Pilih Warna</option>
                                        
                                        <?php foreach($warna as $I):?>
                                             <option value="<?=$I['id']?>" > <?=  $I['nama']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                <select id="id_satuan_0"  name="id_satuan_0" class="form-control pilih_satuan">
                                        <option value="0">Pilih Satuan</option>
                                        
                                        <?php foreach($satuan as $I):?>
                                             <option value="<?=$I['id']?>" > <?=  $I['nama']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" value="0"  class="form-control" placeholder="jumlah" name="jumlah_0" id="jumlah_0" onchange="getTotalHargaItem('id_barang_0')">
                                </td>
                                <td>
                                    <input type="text" value="0" class="form-control money-input" maxlength="11" placeholder="Biaya Simpan Per Produk" name="biaya_0" id="biaya_0">
                                </td>
                                <td>
                                    <input type="text" value="0"  class="form-control money-input" placeholder="Harga" name="harga_0" id="harga_0" readonly="readonly" >
                                </td>
                                <td>
                                    <input type="text" value="0"  class="form-control money-input" placeholder="Total" name="total_0" id="total_0" readonly="readonly">
                                </td>
                                <td>
                                    <a href="javascript:void(0)" onclick="removeBarang('barang_0')" class="btn btn-danger" style="display: none;"  name="delete_0" id="delete_0"><span class="glyphicon glyphicon-trash"></span></a></td>
                                </td>
                            </tr>
                            <tr id="barang_1" data-id="1">
                                <td>
                                    <select id="id_barang_1"  name="id_barang_1" class="form-control pilih_barang select2" onchange="getHarga('id_barang_1')" disabled="disabled">
                                        <option value="0">Pilih Barang</option>
                                       <?php foreach($kain as $l):?>
                                        <option value="<?=$l['id']?>" > <b><?= $l['code'] .' - '. $l['kain']?></b></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <!--input type="text" value="" class="form-control" placeholder="Wa" name="ukuran_0" id="ukuran_0" readonly="readonly"-->
                                    <select id="id_warna_1"  name="id_warna_1" class="form-control pilih_warna" disabled="disabled">
                                        <option value="0">Pilih Warna</option>
                                        
                                        <?php foreach($warna as $I):?>
                                             <option value="<?=$I['id']?>" > <?=  $I['nama']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td><td>
                                <select id="id_satuan_1"  name="id_satuan_1" class="form-control pilih_satuan">
                                        <option value="0">Pilih Satuan</option>
                                        
                                        <?php foreach($satuan as $I):?>
                                             <option value="<?=$I['id']?>" > <?=  $I['nama']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" value="0"  class="form-control" placeholder="jumlah" name="jumlah_1" id="jumlah_1" onchange="getTotalHargaItem('id_barang_1')">
                                </td>
                                <td>
                                    <input type="text" value="0" class="form-control money-input" maxlength="11" placeholder="Biaya Simpan Per Produk" name="biaya_1" id="biaya_1">
                                </td>
                                <td>
                                    <input type="text" value="0"  class="form-control money-input" placeholder="Harga" name="harga_1" id="harga_1" readonly="readonly">
                                </td>
                                <td>
                                    <input type="text" value="0"  class="form-control money-input" placeholder="Total" name="total_1" id="total_1" readonly="readonly">
                                </td>
                                <td>

                                </td>
                            </tr>
                        </table>
                    </div>
                     <div class="box-footer clearfix">
                         <input type="hidden" readonly="readonly" value="0"  class="form-control money-input" placeholder="Total Harga Barang" name="total_tagihan" id="total_tagihan">
                         <a href="javascript:void(0)" id="add_barang" style="display: none;" onclick="addBarang()" class="btn btn-success pull-right"><span class="glyphicon glyphicon-plus"></span> Tambah Barang</a>
                         
                        <a href="<?php echo BASE_URL('permintaan/');?>"><button type="button" id="batal" class="btn btn-danger  pull-right">Batal </button></a>
                         <button type="submit" class="btn btn-primary  pull-right">Submit</button>
                
                    </div>
                </div>

            </div> 
            
        </form>
    </div>
</section>
    <!-- alert -->
    <?php
      $alert = $this->session->flashdata("alert_pengguna");
      if(isset($alert) && !empty($alert)):
        $message = $alert['message'];
        $status = ucwords($alert['status']);
        $class_status = ($alert['status'] == "success") ? 'success' : 'danger';
        $icon = ($alert['status'] == "success") ? 'check' : 'ban';
    ?>
    <div class="modal modal-<?php echo $class_status ?> fade" id="myModal" >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            <h4 class="modal-title"><span class="icon fa fa-<?php echo $icon ?>"></span> <?php echo $status?></h4>
          </div>
          <div class="modal-body">
            <p><?php echo $message ?></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline" data-dismiss="modal">OK</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    <?php endif; ?>
