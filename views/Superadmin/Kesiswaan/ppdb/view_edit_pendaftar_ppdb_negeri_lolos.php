<html>
  <body>
    <div class="modal-dialog">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Informasi Pendaftar PPDB : <?php echo $row_pendaftar_ppdb->nama; ?></h4>
      </div>
      <div class="modal-content">
        <form id="formPartE" class="form-horizontal style-form form-goods" method="post" action="<?php echo site_url('kesiswaan/admin/pendaftar_jalur_un/updatependaftarlolos/'.$row_pendaftar_ppdb->nisn_pendaftar); ?>"><br>
          <?php
          if ($settingform['nisn_pendaftar'] == '1') {
          ?>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">NISN </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="last-name" required="required" class="form-control col-md-7 col-xs-12" name='nisn_pendaftar' value="<?php echo $row_pendaftar_ppdb->nisn_pendaftar; ?>">
            </div>
          </div>
          <?php
          }
          if ($settingform['nama'] == '1') {
          ?>
          <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Nama Lengkap </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="nama" value="<?php echo $row_pendaftar_ppdb->nama; ?>">
            </div>
          </div>
          <?php
          }
          if ($settingform['tempat_lahir'] == '1') {
          ?>
          <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Tempat Lahir </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="tempat_lahir" value="<?php echo $row_pendaftar_ppdb->tempat_lahir; ?>">
            </div>
          </div>
          <?php
          }
          if ($settingform['tanggal_lahir'] == '1') {
          ?>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Tanggal Lahir</label>
            <fieldset>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="date" class="form-control" id="tgl_berlaku" placeholder="Tgl Berlaku" name="tanggal_lahir" value="<?php echo $row_pendaftar_ppdb->tanggal_lahir; ?>">
                <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor-one">
                </div>
              </div>
            </fieldset>
          </div>
          <?php
          }
          if ($settingform['jenis_kelamin'] == '1') {
          ?>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Kelamin</label>
            <div class="col-md-6 col-sm-6 col-xs-6">
              <input type="radio" name="jenis_kelamin"
              <?php if (isset($row_pendaftar_ppdb->jenis_kelamin) && $row_pendaftar_ppdb->jenis_kelamin=="Perempuan") echo "checked";?> value="Perempuan">Perempuan <br>
              <input type="radio" name="jenis_kelamin"
              <?php if (isset($row_pendaftar_ppdb->jenis_kelamin) && $row_pendaftar_ppdb->jenis_kelamin=="Laki-Laki") echo "checked";?> value="Laki-laki">Laki-Laki 
            </div>
          </div>
          <?php
          }
          if ($settingform['asal_sekolah'] == '1') {
          ?>
          <div class="form-group">
            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Asal Sekolah</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="asal_sekolah" value="<?php echo $row_pendaftar_ppdb->asal_sekolah; ?>">
            </div>
          </div>
          <?php
          }
          if ($settingform['domisili'] == '1') {
          ?>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Domisili </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input required="required" type="radio" name="domisili"
                <?php if (isset($row_pendaftar_ppdb->domisili) && $row_pendaftar_ppdb->domisili=="Dalam Daerah") echo "checked";?> value="Dalam Daerah">Dalam Daerah <br>
               <input type="radio" name="domisili"
                <?php if (isset($row_pendaftar_ppdb->domisili) && $row_pendaftar_ppdb->domisili=="Luar Daerah") echo "checked";?> value="Luar Daerah">Luar Daerah 
            </div>
          </div>
          <?php
          }
          ?>
          <div class="form-group">
            <br><label class="control-label col-md-3 col-sm-3 col-xs-12">Nilai UN</label>
            <label><h5>*angka desimal gunakan tanda titik</h5></label>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nilai UN Bahasa Indonesia </label>
             <div class="col-md-3 col-sm-3 col-xs-3">
              <input type="text" class="form-control" name="nilai_un_ind" value="<?php echo $row_pendaftar_ppdb->nilai_un_ind; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">UN Matematika </label>
             <div class="col-md-3 col-sm-3 col-xs-3">
              <input type="text" class="form-control" name="nilai_un_mat" value="<?php echo $row_pendaftar_ppdb->nilai_un_mat; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">UN IPA </label>
              <div class="col-md-3 col-sm-3 col-xs-3">
              <input type="text" class="form-control" name="nilai_un_ipa" value="<?php echo $row_pendaftar_ppdb->nilai_un_ipa; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nilai Prestasi </label>
             <div class="col-md-3 col-sm-3 col-xs-3">
              <input type="text" class="form-control" name="nilai_prestasi" value="<?php echo $row_pendaftar_ppdb->nilai_prestasi; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Nilai </label>
             <div class="col-md-3 col-sm-3 col-xs-3">
              <input type="text" class="form-control" name="nilai_un_nun" value="<?php echo $row_pendaftar_ppdb->nilai_un_nun; ?>">
            </div>
          </div> 
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          </div>
        </form>
      </div>
    </div>   
  </body>
</html>