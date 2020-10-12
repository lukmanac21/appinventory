<?php foreach ($data as $row) { ?>
<!--<div style="padding: 20px;">-->
    <form action="<?= base_url('guru/');?>save" method="post">
        <input type="hidden" name="id" value="<?php echo (isset($row->id)) ? $row->id : '' ?>">
        
         <div class="col-md-6">
            <div class="form-group">
                <label>NIP</label>
                <input type="text" class="form-control" readonly="" name="nip" value="<?= (isset($row->nip)) ? $row->nip : ''; ?>">
            </div>
         </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" required="" class="form-control" readonly="" name="nama" value="<?= (isset($row->nama)) ? $row->nama: ''; ?>">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Alamat</label>
                <textarea class="form-control" required="" rows="2" readonly="" name="alamat" ><?= (isset($row->alamat)) ? $row->alamat : ''; ?> </textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Jenis Kelamin</label><br>
                <input type="radio" required="" disabled="" value="laki-laki" name="jk" <?= $row->jk =="laki-laki" ? 'checked':'';?>> Laki-laki
                    &nbsp;
                    <input type="radio" required="" disabled="" name="jk" value="perempuan" <?= $row->jk =="perempuan" ? 'checked':'';?>> Perempuan
            
            </div>
        </div>
          
        <div class="col-md-6">
            <div class="form-group">
                <label>No Telp</label>
                <input type="text" required="" readonly="" class="form-control" name="telp" value="<?= (isset($row->telp)) ? $row->telp :''; ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Tempat Lahir</label>
                <input type="text" required="" readonly="" class="form-control" name="tempat_lahir" value="<?= (isset($row->tempat_lahir)) ? $row->tempat_lahir :''; ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Agama</label>
                <input type="text" required="" readonly="" class="form-control" name="agama" value="<?= (isset($row->agama)) ? $row->agama :''; ?>">
           
            </div>
        </div>
      
        <div class="col-md-12">
            <div class="input-group">
                <label>Tanggal Lahir</label>
            </div>
        </div>
        <div class="col-md-12">
            <table class="col-md-12">
                <thead>
                    <tr>
                        <td>
                         
                            <input type="text" required="" readonly="" class="form-control" name="agama" value="<?= date('d', strtotime($row->tgl))?>">
                       
                </td>
                    <td>
                         <input type="text" required="" readonly="" class="form-control" name="bulan" value="<?= date('M', strtotime($row->tgl))?>">
                       
                </td>
                    <td>
                        <input type="text" required="" readonly="" class="form-control" name="bulan" value="<?= date('Y', strtotime($row->tgl))?>">
                       
                    </td>
                </tr>
                </thead>
            </table>
        </div>
        <div class="col-xs-12">
            <div class="form-group">
            </div>
        </div>
         <div class="col-xs-6">
            <div class="form-group">
                <label>Program Keahlian</label>
                <input type="text" required="" readonly="" class="form-control" name="bulan" value="<?= (isset($row->pelajaran)) ? $row->pelajaran :''; ?>">
                       
            </div>
        </div>
          <div class="col-md-6">
            <div class="form-group">
                <label>Jabatan</label>
                <input type="text" required="" readonly="" class="form-control" name="jabatan" value="<?= (isset($row->jabatan)) ? $row->jabatan :''; ?>">
            </div>
        </div>
       <div class="col-md-6">
            <div class="form-group">
                <label>UserName</label>
                <input type="text" class="form-control" readonly="" name="username" value="<?= (isset($row->username)) ? $row->username :''; ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" readonly="" name="password" >
            </div>
        </div><div class="col-md-12">
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" readonly="" name="email" value="<?= (isset($row->email)) ? $row->email :''; ?>">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>&nbsp;</label>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="modal-footer ">
            <button class="btn btn-info" type="submit"> Simpan</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal"> Batal</button>
        </div>
    </form>
<!--</div>-->
    <?php
}
?>