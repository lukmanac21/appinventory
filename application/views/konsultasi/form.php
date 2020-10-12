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
                    <h3 class="box-title">Hasil Konsultasi</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" action="" method="post" id="formAgenr">
                    <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kadar Air</label>

                  <div class="col-sm-8">
                      <input type="text" class="form-control" name="kadar_air" value="<?= $post['kadar_air'];?>" disabled="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Kotoran</label>

                  <div class="col-sm-8">
                      <input type="text" class="form-control" id="kotoran" name="kotoran" value="<?= $post['kotoran'];?>" disabled="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Ukuran Singkong</label>

                  <div class="col-sm-8">
                      <input type="text" class="form-control" name="ukuran_singkong" value="<?= $post['ukuran_singkong'];?>" disabled="">
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
                        <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                
                                <th>Kode</th>
                                <th>Aturan</th>
                                <th>Nilai Miu Kadar Air</th>
                                <th>Nilai Miu Kotoran</th>
                                <th>Nilai Miu Kualitas Singkong</th>
                                <th>ALPHA</th>
                                <th>Z</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                           <?php  $jika = ""; $dan =""; $dan1=""; $alphas =""; $temp="";  $counter = ""; $htemp="";
        $counter2 = ""; $s=""; $jml ="";$hasil="";$b="";
       
                           foreach ($data as $rows) {    
                             $jika =  $rows['jika'] == 'Kadar Air Tinggi' ? $retval['Kadar_Air_Tinggi'] : $retval['Kadar_Air_Rendah'];
                             $dan = $rows['dan'] == 'Kotoran Tinggi' ? $retval['Kotoran_Tinggi'] : $retval['Kotoran_Rendah'];
                             $dan1 = $rows['dan1'] == 'Ukuran Singkong Besar' ? $retval['Ukuran_Besar'] : $retval['Ukuran_Kecil'] ;
                             $alphas =    min($jika, $dan, $dan1) ;  
//                             
                             $temp = $rows['maka'] == 'Kualitas Singkong Baik' ? 
                                     $dataKualitas['a'] + (($alphas) * ($dataKualitas['b'] - $dataKualitas['a'])) :
                                     $dataKualitas['b'] - (($alphas) * ($dataKualitas['b'] - $dataKualitas['a']));
                              $s += $alphas * $temp;
                              $jml += $alphas;
                              
                            ?>
                            <tr>
                                <td><?= $rows['code'];?></td>
                                <td><?= $rows['kesimpulan'];?></td>
                                <td><?= $jika  ;?></td>
                                <td><?= $dan ;?> </td>
                                <td><?=  $dan1 ;?> </td>
                                <td><?= $alphas ;?></td>
                                <td><?= $temp ;?></td>
                              </tr>
                           <?php }  ?>
                              <tr>
                                  <td colspan="2"><b>Jumlah (Alpha x Z)</b></td>
                                  <td colspan="5"><?= $s ;?></td>
                              </tr>
                              <tr>
                                  <td colspan="2"><b>Jumlah Alpha</b></td>
                                  <td colspan="5"><?= $jml ;?></td>
                              </tr>
                              <tr>
                                  <td colspan="2"><b>Hasil (Jumlah (Alpha x Z) / Jumlah Alpha)</b></td>
                                  <td colspan="5"><?= $s / $jml ;?></td>
                              </tr>
                               <tr>
                                  <td colspan="2"><b>Hasil Kualitas Singkong</b></td>
                                  <td colspan="5"><?= $s / $jml > $dataKualitas['a'] ? 'Baik' : 'Buruk'  ;?></td>
                              </tr>
                        </tbody>
                    </table>
                            
                </div>
                <div class="box-footer clearfix">

                </div>
<!--                        <button type="submit" class="btn btn-primary">Submit</button><a><button type="reset" id="reset"class="btn bg-orange btn-flat">Reset</button></a>
                        <a href="<?= base_url();?>"><button type="submit" class="btn btn-default btn-flat pull-right">Cancel</button></a>-->
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
