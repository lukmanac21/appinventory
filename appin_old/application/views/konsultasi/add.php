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
                    <h3 class="box-title">Konsultasi</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" action="<?php echo $base_url; ?>save" method="post" id="formAgenr">
                    <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kadar Air</label>

                  <div class="col-sm-8">
                      <input type="text" class="form-control" name="kadar_air" id="kadar_air" placeholder="Kadar Air" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Kotoran</label>

                  <div class="col-sm-8">
                      <input type="text" class="form-control" id="kotoran" name="kotoran" placeholder="Kotoran" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Ukuran Singkong</label>

                  <div class="col-sm-8">
                      <input type="text" class="form-control" name="ukuran_singkong" id="ukuran_singkong" placeholder="Ukuran Singkong" required="">
                  </div>
                </div>
              </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="clearfix"></div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button><a><button type="reset" id="reset"class="btn bg-orange btn-flat">Reset</button></a>
                        <a href="<?= base_url('oprasi');?>"><button type="submit" class="btn btn-default btn-flat pull-right">Cancel</button></a>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section><!-- /.content -->

<!-- alert -->
<?php
$alert = $this->session->flashdata("alert_diagnostik");
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
