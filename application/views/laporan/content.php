<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= $title ?>
    </h1>
    <?php echo $breadcrumbs; ?>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <form action="<?php echo $base_url; ?>" method="post" id="formTransaksi" class="form-horizontal">
            <!-- Agen -->
            <div class="col-md-12">
                <div class="row">

                    <div class="col-md-12">
                        <div class="box box-success">
                            <div class="box-header">
                                <h3 class="box-title" id="form-head">Filter</h3>
                            </div>
                            <div class="box-body ">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Kain</label>
                                    <div class="col-sm-7">
                                    <select id="id_kain"  name="id_kain" class="form-control select2">
                                        <option value="">Pilih Data Kain</option>
                                        
                                        <?php foreach($kain as $row):?>
                                             <option value="<?=$row['id']?>" > <?=  $row['code'].' - '.$row['nama']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Warna</label>
                                    <div class="col-sm-7">
                                    <select id="id_warna"  name="id_warna" class="form-control select2">
                                        <option value="">Pilih Kategori Warna</option>
                                        
                                        <?php foreach($warna as $row):?>
                                             <option value="<?=$row['id']?>" > <?= $row['nama']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Satuan</label>
                                    <div class="col-sm-7">
                                    <select id="id_satuan"  name="id_satuan" class="form-control select2">
                                        <option value="">Pilih Kategori Satuan</option>
                                        
                                        <?php foreach($satuan as $row):?>
                                             <option value="<?=$row['id']?>" > <?= $row['nama']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label form-label col-sm-3">Tanggal</label>
                                    <div class="col-sm-3">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="glyphicon glyphicon-calendar"></i>
                                            </div>
                                            <input id="date1" class="form-control pull-right" value="dd-mm-yyyy" name="date1" id="date1" type="text">
                                        </div>
                                    </div>
                                    <div class="col-sm-1 text-center">
                                        <label class="control-label form-label">s.d.</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="glyphicon glyphicon-calendar"></i>
                                            </div>
                                            <input id="date2" class="form-control pull-left" value="dd-mm-yyyy" name="date2" id="date2" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="button" id="btnFilter"  class="btn btn-primary btn-flat"><span class="glyphicon glyphicon-search"></span> Cari</button>
                                </div>
                            </div><!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </div>  
        </form>
        <!-- Barang -->
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">Laporan Data Surat </h3>

                    <!--form action="<?php echo $base_url; ?>export" method="post" >
                        <button type="submit" class="btn btn-primary pull-right " id="export-xls">Backup database</button>
                        <input type="hidden" name="date1" value="<?= $post ?>" />
                        <input type="hidden" name="date2" value="<?= $post ?>" />
                        <input type="hidden" name="nomor_surat" value="<?= $post ?>" />
                        <input type="hidden" name="kode" value="<?= $post ?>" />
                        <input type="hidden" name="isi_ringkasan" value="<?= $post ?>" />
                    </form-->
                </div>
                <div class="box-body table-responsive ">
                    <table class="table table-hover table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th>Kain</th>
                                <th>Warna</th>
                                <th>Satuan</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
    </div>
</section><!-- /.content -->

<!-- alert -->
<?php
$alert = $this->session->flashdata("alert_transaksi");
if (isset($alert) && !empty($alert)):
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
                    <h4 class="modal-title"><span class="icon fa fa-<?php echo $icon ?>"></span> <?php echo $status ?></h4>
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
