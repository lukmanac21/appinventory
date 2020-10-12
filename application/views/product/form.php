    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$title?>
      </h1>
      <?=$breadcrumbs?>
    </section>
    <!-- Main content -->
    <section class="content">

<div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title"><?= $data['id'] ? 'Edit Data Produk' : 'Tambah Data Produk';?></h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form action="<?php echo $base_url; ?>save" method="post" id="formPengguna">
                    <input type="hidden" id="id" name="id" value="<?= $data['id'] ? $data['id'] : ''?>" />
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" class="form-control" placeholder="Nama Produk"  value="<?= $data['nama'] ? $data['nama'] : '' ;?>" name="nama" id="nama">
                       
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Jenis Kain</label>
               <select id="id_kain" name="id_kain" class="form-control select2">
                    <option>-- Pilih Jenis Kain --</option>
                        <?php $lv = array(); ?>
                        <?php foreach($jenis as $l):?>
                        <option value="<?=$l['id']?>" <?= $data['id_kain'] == $l['id'] ? 'selected' : '';?>> <?=$l['code'] .' - '. $l['nama']?></option>
                        <?php endforeach; ?>
               </select>
              </div>
              
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6"><div class="form-group">
                <label>Ukuran Produk</label>
                 <input type="text" class="form-control" placeholder="Ukuran Produk" name="ukuran" id="ukuran" value="<?= $data['ukuran'] ? $data['ukuran'] : '' ;?>" required="">
                       
              </div>
               <!-- /.form-group -->
              <div class="form-group">
                <label>Harga Produk</label>
               <input type="text" class="form-control money-input" maxlength="11" placeholder="Harga Kain" value="<?= $data['harga'] ? $data['harga'] : 0 ;?>" name="harga" id="harga" required="">
                                
              </div>
              
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer"> <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="<?php echo BASE_URL('kain/');?>"><button type="button" id="batal" class="btn btn-danger">Batal </button></a>
                
        </div>
        </form>
      </div>
    </section><!-- /.content -->
    
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
