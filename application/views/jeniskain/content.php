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
<!--        <div class="col-md-4">
            <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title" id="form-head">Tambah Jenis Kain</h3>
                </div>
                <div class="box-body">
                  <form action="<?php echo $base_url; ?>save" method="post" id="formAuthor">
                    <input type="hidden" id="id" name="id" value="" />
                   
                   <div class="form-group">
                        <label>Code*</label>
                        <input type="text" class="form-control" placeholder="Code Kain" name="code" id="code" required="required">
                        <p class="help-block">Tinggi Rule*</p>
                    </div>
                    <div class="form-group">
                        <label>Nama*</label>
                        <input type="text" class="form-control" placeholder="Nama Kain" name="nama" id="nama" required="required">
                        <p class="help-block">Nama Rule/Variable</p>
                    </div>
                    <div class="form-group">
                        <label>Satuan Kain</label>
                        <select id="id_satuan" name="satuan" class="form-control select2">
                             <option>-- Pilih Satuan Kain --</option>
                            <?php $lv = array(); ?>
                            <?php foreach($satuan as $l):?>
                            <option value="<?=$l['id']?>">
                                
                                <?=$l['nama']?>
                                <?php $lv[$l['nama']] = $l['nama']?> 
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>  
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button> 
                        <a href="<?php echo BASE_URL('kain/');?>"><button type="button" style="display: none;"  id="batal" class="btn btn-danger">Batal </button></a>
                    
                    </div>
                  </form>
                </div> /.box-body 
              </div>
        </div>-->
             <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">List Data Jenis Kain</h3>
                  <a href="<?= BASE_URL('jenis');?>/add"><button type="button" class="btn bg-blue-active btn-flat pull-right"><span class="glyphicon glyphicon-inbox"></span> Tambah Data</button></a>
                </div>
                
                    <div class="box-body">
                        <form action="<?php echo $base_url; ?>" method="post" id="formBarang">
                            <input type="hidden" class="form-control" name="IDprovinsi" id="IDprovinsi">
                        </form>
                        
                     <table class="table table-hover table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Nama Kain</th>
                                <th>Satuan Kain</th>
                                <th>Harga</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                           
                            </tbody>
                        </table>
                        </div>
                </div>
               
            </div>
        </div>
        </div>
        <div id="delete-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header"  style="background-color: #00a65a;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" style="color:white;"><b>Konfirmasi</b></h4>
                    </div>
                    <div class="modal-body">
                        <h4><b> Apakah Anda yakin ingin menghapus data Jenis Kain ini ? </b></h4>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-danger" id="hapus-true-data">Hapus</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                    </div>

                </div>
            </div>
        </div>
        <div id="edit-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header"  style="background-color: #00a65a;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" style="color:white;"><b>Konfirmasi</b></h4>
                    </div>
                    <div class="modal-body">
                        <h4><b> Apakah Anda yakin ingin mengedit data Jenis Kain ini ? </b></h4>
                    </div>
                     <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-success" id="hapus-true-data">Ya</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
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
