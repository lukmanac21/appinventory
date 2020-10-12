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
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">Preview Data</h3>
                </div>
                <div class="box-body">
                      <form class="form-horizontal" action="<?= base_url('import/save');?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                  
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No SEP</th>
                                <th>Tanggal SEP</th>
                                <th>RIRJ</th>
                                <th>No Kartu</th>
                                <th>Nama Pasien</th>
                                <th>Diagnosa</th>
                                <th>Poli</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $numrow = 1;
		$kosong = 0;
               $no="";
                            foreach($sheet as $row)  { 
                                if($numrow > 1){
                                   $no++;
                                   $nosep = $row['B']; 
			$tgl = $row['C']; 
			$rirj = $row['D']; 
			$noka = $row['E']; 
			$nama = $row['G']; 
			$diagnosa = $row['H']; 
			$poli = $row['I']; 
			
			// Cek jika semua data tidak diisi
			if(empty($nis) && empty($nama) && empty($jenis_kelamin) && empty($alamat))
				continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
			
                                ?>
                                <tr role="row" class="odd">
                                    <td class="sorting_1"><?= $no;?></td>
                                    <td class="sorting_1"><?= $nosep;?></th>
                                    <td class="sorting_1"><?= $tgl;?></td>
                                    <td class="sorting_1"><?= $rirj;?></td>
                                    <td class="sorting_1"><?= $noka;?></td>
                                    <td class="sorting_1"><?= $nama;?></td>
                                    <td class="sorting_1"><?= $diagnosa;?></td>
                                    <td class="sorting_1"><?= $poli;?>
                                    </td>
                                </tr>
                            <?php
                            
                            }
			
			$numrow++; 
                                }?>
                        </tbody>
                    </table>
                          <div class="modal-footer ">
                              <button class="btn btn-info btn-flat btn-sm" type="submit">Simpan</button><a href="<?= $base_url;?>">
                                  <button type="button" class="btn btn-warning btn-flat btn-sm" data-dismiss="modal"> Batal</button></a>
                            </div>
                      </form>
                </div>
                <div class="box-footer clearfix">

                </div>
            </div>

        </div> 
    </div>
</section><!-- /.content -->

<!-- alert -->
<?php
$alert = $this->session->flashdata("alert_siswa");
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
