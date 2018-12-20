<html>
  <body>
    <div class="modal-dialog">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Impor Data Buku Induk</h4>
      </div>
      <div class="modal-content">
        <form id="formPartE" class="form-horizontal style-form form-goods" method="post" action="<?php echo site_url('kesiswaan/admin/Buku_induk/uploadData'); ?>" enctype="multipart/form-data">
          <div class="form-group">
            <div align="center"><br>
              <p>Untuk menghindari kesalahan dalam memasukan data, disarankan untuk mempelajari file berikut ini: </p>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4" align="right">
              <a type="button" role="button" class="btn btn-default" href="<?php echo base_url(); ?>assets/kesiswaan/import/Ketentuan Import Data Buku Induk.pdf" download="Ketentuan Import Data Buku Induk.pdf"><i class="fa fa-download text-blue"></i> Download Ketentuan</a>
            </div> 
            <div class="col-sm-4">
              <div class="form-group" align="right">
                <a type="button" role="button" class="btn btn-default" href="<?php echo base_url(); ?>assets/kesiswaan/import/Template Buku Induk.xlsx" download="Template Buku Induk.xlsx" class="btn btn-download btn-xs"><i class="fa fa-download text-blue"></i> Download Format Excel</a>
              </div> 
            </div><br><br>
          </div><br>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tahun Ajaran</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="id_tahunajaran" required>
                  <?php foreach ($tahun_ajaran as $key => $value) { ?>
                    <option value="<?php echo $value->id_tahun_ajaran ?>"><?php echo $value->tahun_ajaran ?></option>
                  <?php } ?>
                </select>
                  *apabila Tahun Ajaran yang diinginkan belum muncul, harap hubungi Super Admin.
              </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">File</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                 <input type="file" class="form-control" id="inputName" placeholder="Name" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
              </div>
          </div><br><br> 
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          </div>
       </form> 
     </div>
    </div>   
  </body>
</html>