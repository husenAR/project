<html>
  <body>
    <div class="modal-dialog">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" align="center">Impor PPDB Jalur Ujian</h4>
      </div>
      <div class="modal-content">
          <form id="formPartE" class="form-horizontal style-form form-goods" method="post" action="<?php echo site_url('kesiswaan/admin/pendaftar_jalur_ujian/uploadData'); ?>" enctype="multipart/form-data">
            <div class="form-group">
              <div align="center"><br>
                <p>Untuk menghindari kesalahan dalam memasukan data, <br>disarankan untuk mempelajari file berikut ini: </p>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4" align="right">
                <a type="button" role="button" class="btn btn-default" href="<?php echo base_url(); ?>assets/kesiswaan/import/Ketentuan Import Data PPDB Jalur Ujian.pdf" download="Ketentuan Import Data PPDB Jalur Ujian.pdf"><i class="fa fa-download text-blue"></i> Ketentuan Import Data</a>
              </div> 
              <div class="col-sm-3" align="left">
              </div> 
              <div class="col-sm-4">
                <div class="form-group" align="right">
                  <div class="form-group" align="right">
                  <a type="button" role="button" class="btn btn-default" href="<?php echo base_url(); ?>assets/kesiswaan/import/Template PPDB Ujian.xlsx" download="Template PPDB Ujian.xlsx" class="btn btn-download btn-xs"><i class="fa fa-download text-blue"></i> Template Import Data</a>
                </div>
              </div><br><br>
            </div><br>
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