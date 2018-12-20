
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <center style="color:navy;">Pendaftaran Ekstrakurikuler Siswa SMP Yogyakarta<br></center>
        <center><small>Tahun Ajaran <?php echo $setting->tahun_ajaran; ?></small></center>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Dashboard</a></li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
       
         <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h4 class="box-title">Formulir Pendaftaran</h4>
                </div>
                <form role="form" method="post">
                  <div class="box-body">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Kelas</label>
                        <div class="col-md-2 col-sm-2 col-xs-10">
                          <select class="select2_single form-control" tabindex="-1">
                            <option>-Pilih Kelas-</option>
                            <option>7A</optnion>
                            <option>7B</option>
                            <option>7C</option>
                            <option>7D</option>
                            <option>7F</option>
                            <option>8A</option>
                            <option>8B</option>
                            <option>8C</option>
                            <option>8D</option>
                            <option>8F</option>
                            <option>9A</option>
                            <option>9B</option>
                            <option>9C</option>
                            <option>9D</option>
                            <option>9E</option>
                            <option>9F</option>
                          </select>
                        </div>
                    </div>
                    <br/>
                    <br/>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">NIS</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input type="text" name="nama_lengkap" required="required" class="form-control" placeholder="Nomor Induk Siswa" style="font-size: 14px">
                        </div>
                    </div>
                    <br/>
                    <br/>
                    <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Ekstrakurikuler Pilihan</label> 
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" maxlength="1" name="eks_pil" id="eks_pil" size="1" max="2" /><h6>*maks bisa nambah hanya 2 ekskul</h6>
                      </div>
                      <div id="eks" class="col-md-12 col-sm-12 col-xs-12">
                          <select name="kelas" id="kelas">
                            <option value="Bulutangkis">Bulutangkis</option>
                            <option value="BahasaInggris">Bahasa Inggris</option>
                            <option value="Volly">Volly</option>
                            <option value="Tonti">Tonti</option>
                            <option value="Olimpiade">Olimpiade IPA</option>
                          </select><br/> 
                        <br/>
                              
                        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
                        <script type="text/javascript">
                            $(function () {
                                $("#eks_pil").bind("change", function () {
                                    var input1 = parseInt($(this).val());
                                    if(input1<3){
                                        for(i=0;i<input1;i++){
                                            var index = $("#eks select").length + i;
                                            var ddl = $("#kelas").clone();
                                            ddl.attr("id", "kelas" + index);
                                            ddl.attr("name", "kelas_" + index);
                                            $("#eks").append(ddl);
                                            $("#eks").append("<br/><br/>");
                                        }
                                    }else{
                                        alert('maximal 2');
                                    } 
                                });
                            });
                        </script>

                      </div>
                    </div>
                    <br/>
                    <br/>
                    <br/>
                     <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Request Ekstrakulikuler</label>
                        <div class="col-md-3 col-sm-4 col-xs-10">
                          <input type="text" name="request" class="form-control col-md-7 col-xs-12" placeholder="Masukan Ekstrakulikuler Request">
                        </div>
                    </div>
                    
                  </div>

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
            </div>
        </div>
         
        
        <div class="row">
            <div class="col-md-12">
              <center><h3>Data Peserta Ekstrakurikuler SMP Yogyakarta</h3></center>
              <center><h4>Tahun Ajaran 2016-2017</h4></center>
              
              <div class="box">
                <div class="box-header with-border">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                    <tr style="background-color: #33669b">
                      <th style="width: 10px">No</th>
                      <th>Jenis Ekstrakurikuler</th>
                      <th>Jumlah Peserta</th>
                      <th>Aksi</th>
                    </tr>
                    <tr>
                      <td>1.</td>
                      <td>Bulutangkis</td> 
                      <td><a href="Pendaftaran_jumlah_peserta_ekskul.php">20</a></td>
                      <td><button type="submit" class="btn btn-primary">Buat Jadwal</button></td>  
                    </tr>
                    <tr>
                      <td>2.</td>
                      <td>Olimpiade IPA</td> 
                      <td><a href="Pendaftaran_jumlah_peserta_ekskul.php">10</a></td>
                      <td><button type="submit" class="btn btn-primary">Buat Jadwal</button></td>  
                    </tr>
                    <tr>
                      <td>3.</td>
                      <td>Volly</td> 
                      <td><a href="Pendaftaran_jumlah_peserta_ekskul.php">15</a></td>
                      <td><button type="submit" class="btn btn-primary">Buat Jadwal</button></td>  
                    </tr>
                    <tr>
                      <td>4.</td>
                      <td>Bahasa Inggris</td> 
                      <td><a href="Pendaftaran_jumlah_peserta_ekskul.php">15</a></td><td><button type="submit" class="btn btn-primary">Buat Jadwal</button></td> 
                    </tr>
                    <tr>
                      <td>5.</td>
                      <td>Tonti</td> 
                      <td><a href="Pendaftaran_jumlah_peserta_ekskul.php">20</a></td>
                      <td><button type="submit" class="btn btn-primary">Buat Jadwal</button></td>  
                    </tr>
                  </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                  <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                  </ul>
                </div>
              </div>
            </div>
        </div>

            
    </section>
    <!-- /.content -->
  </div>