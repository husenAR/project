
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <center style="color:navy;">Keterlambatan Siswa SMP Yogyakarta<br></center>
        <center><small>Tahun Ajaran 2016-2017</small></center>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Dashboard</a></li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 ">
                            
                <div class="nav-tabs-custom">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-left">
                      <li class="active"><a href="Keterlambatan.html">Keterlambatan Siswa</a></li>
                      <li>
                          <a href="grafik.php" class="dropdown-toggle" data-toggle="dropdown">Grafik</a>
                          <ul class="dropdown-menu">
                              <li><a tabindex="-1" href="grafik.php#Perkelas">Perkelas</a></li>
                              <li><a tabindex="-1" href="grafik.php#Mingguan">Mingguan</a></li>
                              <li><a tabindex="-1" href="grafik.php#Bulanan">Bulanan</a></li>
                              <li><a tabindex="-1" href="grafik.php#Tahunan">Tahunan</a></li>
                          </ul>
                     </li>
                    </ul>
                <div class="tab-content no-padding">
                <div class="chart tab-pane active" id="tab1" style="position: relative; ">
                <div class="box">
                <div class="box-body">
                <h4 class="box-title">Form Siswa Terlambat</h4>
                </div>
                <form role="form" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label>Kelas</label>
                      <select name="kelas">
                        <option value="7A">7A</option>
                        <option value="7B">7B</option>
                        <option value="7C">7C</option>
                        <option value="7D">7D</option>
                        <option value="7E">7E</option>
                        <option value="7F">7F</option>
                        <option value="8A">8A</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Nama Siswa</label>
                      <input type="text"name="nama_lengkap" required="required">
                    </div>

                   <div class="form-group">
                      <label>Tanggal Terlambat</label> 
                      <input type="date" name="tgl"/>
                    </div>
                      
                      <div class="form-group">
                      <label>Keterangan</label>
                      <input type="text" name="keterangan">
                      </div>

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
            </div>
        </div>
                    <div class="tab-content no-padding">
                      <div class="chart tab-pane active" id="tab1" style="position: relative; ">
                        <div class="box">
                            <div class="box-body">
                                <center><h4>Data Keterlambatan siswa</h4></center>
                            <select name="semester">
                                <option value="semester 1">Semester 1</option>  
                                <option value="semester 2">Semester 2</option>    
                            </select>
                            <select name="tahun">
                                <option value="2016/2017">Tahun 2016/2017</option>  
                                <option value="2017/2018">Tahun 2017/2018</option>    
                            </select>
                            <br/><br/>
                            <table class="table table-bordered">
                                <tr>
                                  <th>Semester</th>
                                  <th>Jumlah Siswa</th>
                                  <th>Jumlah Terlambat</th>
                                </tr>
                                <tr>
                                  <td> Semester 1</td>
                                  <td>
                                      <a data-toggle="modal" data-target="#myModal">7 Siswa</a><br/>
                                      <a data-toggle="modal" data-target="#myModal">10 Siswa</a><br/>
                                      <a data-toggle="modal" data-target="#myModal">5 Siswa</a><br/>
                                      <a data-toggle="modal" data-target="#myModal">9 Siswa</a><br/>
                                      <a data-toggle="modal" data-target="#myModal">3 Siswa</a><br/>
                                      <a data-toggle="modal" data-target="#myModal">20 Siswa</a><br/>  
                                  </td>
                                  <td>
                                      3 Kali<br/>
                                      6 Kali<br/>
                                      9 Kali<br/>
                                      6 Kali<br/>
                                      10 Kali<br/>
                                      1 Kali<br/>  
                                  </td>
                                </tr>
                              </table>
                            </div>

                           </div>
                         </div>            
                     </section>
                   </div>
    </section>
    <!-- /.content -->]
  </div>