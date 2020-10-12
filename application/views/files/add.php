<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= $title ?>
    </h1>
    <?= $breadcrumbs ?>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Kirim File</h3>
                </div>
               <!--<div class="col-md-9">-->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true"><span class="glyphicon glyphicon-file text-aquao"></span> Kirim File</a></li>
              <li class=""><a href="#timeline" data-toggle="tab" aria-expanded="false"><span class="glyphicon glyphicon-history text-aquao"> History</a></li>
              <!--<li><a href="#settings" data-toggle="tab">Settings</a></li>-->
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="activity">
                  <form class="form-horizontal" action="<?= base_url('import/form');?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                  
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input class="form-control" type="file" name="file">
                    </div>
                  </div>
                      
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <!--<button type="submit"  name="import" value="Import" class="btn btn-danger">Submit</button>-->
                      <button type="submit"  name="preview" value="Preview" class="btn btn-primary">Submit</button>
                    </div>
                  </div>
                </form>
                
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                   <form class="form-horizontal" action="<?= base_url('import/form');?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                  
                  <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Pelayanan</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <select class="form-control" id="cbjnspelsep_1">
                            <option value="1">Rawat Inap</option>
                            <option value="2">Rawat Jalan</option>
                        </select>
                    </div>
                  </div>
                      
                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-10">
                      <!--<button type="submit"  name="import" value="Import" class="btn btn-danger">Submit</button>-->
                      <button type="submit"  name="preview" value="Preview" class="btn btn-primary">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->

             
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        </div>
        <!-- Barang -->
        
        <!-- END Modal Ubah -->
    </div>
</section><!-- /.content -->

<!-- alert -->
<?php
$alert = $this->session->flashdata("alert_import");
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
