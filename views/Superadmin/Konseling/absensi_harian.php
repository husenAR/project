  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <center style="color:navy;">Absensi Siswa SMP Yogyakarta<br></center>
        <center><small>Tahun Ajaran 2016-2017</small></center>
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
                  <h3 class="box-title">Surat Izin Siswa</h3>
                </div>
                <form role="form" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label>Nama Siswa</label>
                      <input type="text" class="form-control" name="nama_siswa">
                    </div>
                    <div class="form-group">
                      <label>Kelas</label>
                      <select name="kelas" class="form-control">
                        <option value="7A">7A</option>
                        <option value="7B">7B</option>
                        <option value="7C">7C</option>
                        <option value="7D">7D</option>
                        <option value="7E">7E</option>
                        <option value="7F">7F</option>
                      </select>
                    </div>
                     <div class="form-group">
                      <label>Tanggal </label>
                      <input type="date" name="tgl_s"/> - 
                      <input type="date" name="tgl_e"/>
                    </div>
                    <div class="form-group">
                      <label>Keterangan</label>
                      <input type="text" class="form-control" name="Keterangan">
                    </div>
                    
                  </div>

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="submit" class="btn btn-default">Kembali</button>
                  </div>
                </form>
              </div>
            </div>
         </div>
         
        
        <div class="row">
            <div class="col-md-12">
              
              <div class="box">
                <div class="box-header with-border">
                  <h4 class="box-title">Data Abnsensi Harian Siswa</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                    <tr>
                      <th style="width: 10px">No</th>
                      <th>Nama Siswa</th>
                      <th>Kelas</th>
                      <th>Tanggal</th>
                      <th>Keterangan</th> 
                    </tr>
                    <tr>
                      <td>1.</td>
                      <td>Muhammad Alif</td> 
                      <td>7A</td> 
                      <td>02/03/2017 - 02/10/2017</td> 
                      <td>Umroh</td>
                    </tr>
                    <tr>
                      <td>2.</td>
                      <td>Shella Afiya</td> 
                      <td>8B</td> 
                      <td>02/03/2017 - 02/10/2017</td> 
                      <td>Umroh</td>
                    </tr>
                    <tr>
                      <td>3.</td>
                      <td>Claudya Masyitah</td> 
                      <td>8E</td> 
                      <td>02/03/2017 - 02/10/2017</td> 
                      <td>Umroh</td>
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
  