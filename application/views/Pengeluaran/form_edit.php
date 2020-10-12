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
                            <input type="hidden" id="id" name="id" value="<?=$transaksi['id'];?>" />
                <input type="hidden" id="index_row" name="index_row" value="<?= $count->count;?>" />
                
                <div class="box box-warning">
                    <div class="box-header">
                        <h3 class="box-title">Data Barang</h3>
                    </div>
                     <div class="form-group">
                                <label class="col-sm-3 control-label">Tanggal Pengeluaran</label>
                                <div class="col-sm-6">
                                    <input id="date1" class="form-control pull-right" name="date1" id="date1"  value="<?= $transaksi['tanggal'] ? $transaksi['tanggal'] : date('Y-m-d')?>" type="text">
                                 </div>
                            </div>
                    <div class="box-body table-responsive ">
                        <table class="table table-hover table-striped" id="tabel_barang">
                            <tr>
                                <th style="width:30%">Nama Barang</th>
                                <th>Jumlah</th>
                                <!--<th>Diskon</th>-->
                                <th>Harga Satuan</th>
                                <th>Total</th>
                                <th>Delete</th>
                            </tr>
                            <tr id="barang_0" style="display: none;" data-id="0">
                                <td>
                                    <select id="id_barang_0"  name="id_barang_0" class="form-control pilih_barang" onchange="getHarga('id_barang_0')">
                                        <option value="0">Pilih Kain</option>
                                        
                                        <?php foreach($kain as $I):?>
                                             <option value="<?=$I['id']?>" > <?= $I['article'] .'-'. $I['kain']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" value="0"  class="form-control" placeholder="jumlah" name="jumlah_0" id="jumlah_0" onchange="getTotalHargaItem('id_barang_0')">
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
                            <?php if(isset($transaksi['barang']) && !empty($transaksi['barang']) ){
                            $no=0; $tot=0;foreach ($transaksi['barang'] as $b):$no++;
                                $tot = $b['jumlah'] * $b['harga'];
                            ?>
                            
                            <tr id="barang_<?= $no?>" data-id="<?= $no ?>">
                                <td>
                                    <select id="id_barang_<?= $no?>"  name="id_barang_<?= $no?>" class="form-control pilih_barang" onchange="getHarga('id_barang_<?= $no?>')">
                                        <option value="0">Pilih Barang</option>
                                       <?php foreach($kain as $I):?>
                                        <option value="<?=$I['id']?>" <?= $I['id']==$b['id_kain'] ? 'selected' :'';?>><b> <?= $I['article'].' - '.$I['kain']?></b></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" value="<?=$b['jumlah']?>"  class="form-control" placeholder="jumlah" name="jumlah_<?= $no?>" id="jumlah_<?= $no?>" onchange="getTotalHargaItem('id_barang_<?= $no?>')">
                                    <input type="hidden" value="<?=$b['jumlah']?>" name="jumlah_lama_<?= $no?>" id="jumlah_lama_<?= $no?>">
                                </td>
                                <td>
                                    <input type="text" value="<?=number_format($b['harga'] , 0 , "." , ".")?>"  class="form-control money-input" placeholder="Harga" name="harga_<?= $no?>" id="harga_<?= $no?>" readonly="readonly">
                                </td>
                                <td>
                                    <input type="text" value="<?=number_format($tot , 0 , '.' , '.')?>"  class="form-control money-input" placeholder="Total" name="total_<?= $no?>" id="total_<?= $no?>" readonly="readonly">
                                </td>
                                <td>
                                    <a href="javascript:void(0)" onclick="removeBarang('barang_<?= $no?>')" class="btn btn-danger"  name="delete_<?= $no?>" id="delete_<?= $no?>"><span class="glyphicon glyphicon-trash"></span></a></td>
                                </td>
                            </tr>
                            <?php endforeach;} ?>
                        </table>
                    </div>
                     <div class="box-footer clearfix">
                         <input type="hidden" readonly="readonly" value="0"  class="form-control money-input" placeholder="Total Harga Barang" name="total_tagihan" id="total_tagihan">
                         <a href="javascript:void(0)" id="add_barang" onclick="addBarang()" class="btn btn-success pull-right"><span class="glyphicon glyphicon-plus"></span> Tambah Barang</a> 
                        <a href="<?php echo BASE_URL('pengeluaran/');?>"><button type="button" id="batal" class="btn btn-danger  pull-right">Batal </button></a>
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
