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
        <div class="col-md-4">
            <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title" id="form-head"><?= $data['id'] ? 'Edit Jenis Kain' : 'Tambah Jenis Kain';?></h3>
                </div>
                <div class="box-body">
                  <form action="<?php echo $base_url; ?>save" method="post" id="formAuthor">
                    <input type="hidden" id="id" name="id" value="<?= $data['id'] ? $data['id'] : ' ';?>" />
                   
                   <div class="form-group">
                        <label>Code*</label>
                        <input type="text" class="form-control" placeholder="Code Kain" name="code" id="code" value="<?= $data['code'] ? $data['code'] : ' ';?>" required="required">
                        <p class="help-block">Tinggi Rule*</p>
                    </div>
                    <div class="form-group">
                        <label>Nama*</label>
                        <input type="text" class="form-control" placeholder="Nama Kain" name="nama" id="nama" value="<?= $data['nama'] ? $data['nama'] : ' ';?>" required="required">
                        <p class="help-block">Nama Rule/Variable</p>
                    </div>
                    <div class="form-group">
                        <label>Satuan Kain</label>
                        <select id="id_satuan" name="satuan" class="form-control select2">
                             <option>-- Pilih Satuan Kain --</option>
                            <?php $lv = array(); ?>
                            <?php foreach($satuan as $r):?>
                            <option value="<?=$r['id']?>" <?= $r['id'] == $data['id_satuan'] ? 'selected':'';?>>
                                <?= $r['nama']?> 
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>  
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button> 
                        <a href="<?php echo BASE_URL('jenis/');?>"><button type="button" id="batal" class="btn btn-danger">Batal </button></a>
                    
                    </div>
                  </form>
                </div>
              </div>
        </div>
        </div>
        </div>
      </div>
    </section><!-- /.content -->
    
    <!-- alert -->
    <?php
      $alert = $this->session->flashdata("alert_pelanggaran");
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
