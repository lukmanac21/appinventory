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
          <h3 class="box-title"><?= $data['id'] ? 'Edit Data Kain' : 'Tambah Data Kain';?></h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form action="<?php echo $base_url; ?>save" method="post" id="formPengguna">
                    <input type="hidden" id="id" name="id" value="<?= $data['id'] ? $data['id'] : ''?>" />
                    <!--<input type="hidden"  name="code" value="<?= $data['id'] ? $data['id'] : ''?>" />-->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Code Kain</label>
                <input type="text" class="form-control" placeholder="Code Kain"  value="<?= $data['article'] ? $data['article'] : $code ;?>" name="code" id="code" readonly="">
                       
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Jenis Kain</label>
               <select id="kategori_kain" name="kain" class="form-control select2">
                    <option>-- Pilih Kategori Kain --</option>
                        <?php $lv = array(); ?>
                        <?php foreach($kain as $l):?>
                        <option value="<?=$l['id']?>" <?= $data['kain_id'] == $l['id'] ? 'selected' : '';?>> <?=$l['nama']?></option>
                        <?php endforeach; ?>
               </select>
              </div>
              <div class="form-group">
                <label>Jenis Satuan Kain</label>
               <select id="kategori_satuan" name="satuan" class="form-control select2">
                             <option>-- Pilih Satuan Kain --</option>
                            <?php $lv = array(); ?>
                            <?php foreach($satuan as $l):?>
                            <option value="<?=$l['id']?>" <?= $data['satuan_id'] == $l['id'] ? 'selected' : '';?>>
                                <?= $l['nama']?>
                            </option>
                            <?php endforeach; ?>
                        </select>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label>Jenis Warna Kain</label>
                 <select id="kategori_warna" name="warna" class="form-control select2">
                             <option>-- Pilih Warna Kain --</option>
                            <?php $lv = array(); ?>
                            <?php foreach($warna as $l):?>
                            <option value="<?=$l['id']?>" <?= $data['warna_id'] == $l['id'] ? 'selected' : '';?>> <?= $l['nama']?> </option>
                            <?php endforeach; ?>
                        </select>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Harga Kain</label>
               <input type="text" class="form-control money-input" maxlength="11" placeholder="Harga Kain" value="<?= $data['harga'] ? $data['harga'] : 0 ;?>" name="harga" id="harga" required="">
                                
              </div>
              <div class="form-group">
                <label>Stok Kain</label>
                 <input type="text" class="form-control" placeholder="Stok Kain" name="stok" id="stok" value="<?= $data['stok'] ? $data['stok'] : 0 ;?>" required="">
                       
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
