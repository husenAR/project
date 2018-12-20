 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <center style="color:grey;">Distribusi Kelas Reguler<br></center>
        <center><small>Tahun Ajaran 2016-2017 Kurikulum 2013</small></center> </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Dashboard</a></li>
      </ol>
    </section>

<section class="content">
      <!-- Small boxes (Stat box) -->
      
      <!-- /.row -->
      <!-- Main row -->
     <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
           <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="false">Buat Kelas Baru</a>
            </li>
            <li><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Tambah Kelas</a>
            </li>
            </ul>

                      <div id="myTabContent" class="tab-content">

                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                    
                  <form class="form-horizontal form-mapel">
                  <div class="bigbox-mapel"> 
                    <div class="box-mapel">
                     <div class="form-group formgrup jarakform">
                    <label class="control-label col-md-3" for="first-name">Jumlah Kelas <span class="required">*</span>
                    </label>
                    <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                    <input type="text" class="form-control">
                  </div>
                  </div>
                  <div class="form-group">
                        <label class="control-label col-md-3">Nama Kelas</label>
                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                          <select class="form-control">
                            <option>- Pilih Jenjang -</option>
                            <option>Kelas 7</option>
                            <option>Kelas 8</option>
                            <option>Kelas 9</option>
                            
                          </select>
                        </div>
                        <!-- <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                          <select class="form-control">
                            <option>- Pilih Penamaan -</option>
                            <option>Angka (1,2,3,..)</option>
                            <option>Huruf (A,B,C,..)</option>
                            <option>Romawi (I,II,III,..)</option>
                            <option>Lainnya</option>
                          </select>
                        </div> -->
                        <!-- <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                          <input type="text" class="form-control" id="first-name" placeholder="Nama Alias Kelas">
                        </div> -->
                  </div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Pilih Pembagian Kelas</label>
                          <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                             <a href="agama.html"><button type="button" class="btn btn-primary">Berdasarkan Agama dan Jenis Kelamin</button></a>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                          <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                             <a href="pembagian_prestasi.html"><button type="button" class="btn btn-primary">Berdasarkan Prestasi</button></a>
                          </div>
                        </div>
                        </form>
                        </div>
                        </div>
                        </form>
                        </div>
                        <!-- end tab 1 -->
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                            <div class="row">
                            <div class="col-sm-6">
                              <div class="dataTables_length" id="example1_length">
                                <label>Kelas 7 <select name="example1_length" aria-controls="example1" class="form-control input-sm">
                                  <option>Kelas 8</option>
                                  <option>Kelas 9</option>
                                  <!-- <option>Kelas Tambahan</option> -->
                                </select> entries
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div id="example1_filter" class="dataTables_filter">
                              <label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1">
                              </label>
                            </div>
                          </div>
                        </div>
                     <!-- <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 1%"></th>
                          <th style="width: 1%">No</th>
                          <th style="width: 5%">Nama Kelas</th>
                          <th style="width: 5%">Wali Kelas</th>
                          <th style="width: 5%"></th>
                          <th style="width: 5%"></th>
                          <th style="width: 5%"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><input type="checkbox" class="flat" name="table_records"></td>
                          <td>1</td>
                          <td>Kelas 7A</td>
                          <td>Happy Wahyu</td>
                          <td>
                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
                          </td>
                          <td>
                            <a href="lihat_kelas.php" class="btn btn-primary btn-xs">Lihat Kelas </a>
                          </td>
                          <td>
                            <a href="tambah_siswa.php" class="btn btn-primary btn-xs">Tambah Siswa </a>
                          </td>
                        </tr>
                        <tr>
                          <td><input type="checkbox" class="flat" name="table_records"></td>
                          <td>2</td>
                          <td>Kelas 7B</td>
                          <td>Desmia Aqmarina</td>   
                          <td>
                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
                          </td>
                          <td>
                            <a href="lihat_kelas.php" class="btn btn-primary btn-xs">Lihat Kelas </a>
                          </td>
                          <td>
                            <a href="tambah_siswa.php" class="btn btn-primary btn-xs">Tambah Siswa </a>
                          </td>
                        </tr>
                        <tr>
                          <td><input type="checkbox" class="flat" name="table_records"></td>
                          <td>3</td>
                          <td>Kelas 7C</td>
                          <td>Fatimatus Zuhro</td>
                          <td>
                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
                          </td>
                          <td>
                            <a href="lihat_kelas.php" class="btn btn-primary btn-xs">Lihat Kelas </a>
                          </td>
                          <td>
                            <a href="tambah_siswa.php" class="btn btn-primary btn-xs">Tambah Siswa </a>
                          </td>
                        </tr>
                        <tr>
                          <td><input type="checkbox" class="flat" name="table_records"></td>
                          <td>4</td>
                          <td>Kelas 7D</td>
                          <td>Hilham Fajri</td>
                          <td>
                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
                          </td>
                          <td>
                            <a href="lihat_kelas.php" class="btn btn-primary btn-xs">Lihat Kelas </a>
                          </td>
                          <td>
                            <a href="tambah_siswa.php" class="btn btn-primary btn-xs">Tambah Siswa </a>
                          </td>
                        </tr>
                        <tr>
                          <td><input type="checkbox" class="flat" name="table_records"></td>
                          <td>5</td>
                          <td>Kelas 7E</td>
                          <td>Yusri Fajri</td>
                          <td>
                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
                          </td>
                          <td>
                            <a href="lihat_kelas.php" class="btn btn-primary btn-xs">Lihat Kelas </a>
                          </td>
                          <td>
                            <a href="tambah_siswa.php" class="btn btn-primary btn-xs">Tambah Siswa </a>
                          </td>
                        </tr>
                      </tbody>
                    </table> -->


                      <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 1%"></th>
                          <th style="width: 1%">No</th>
                          <th style="width: 5%">Nama Kelas</th>
                          <th style="width: 5%">Jumlah Siswa</th>
                          <th style="width: 5%">Wali Kelas</th>
                          <th style="width: 5%"></th>

                          
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><input type="checkbox" class="flat" name="table_records"></td>
                          <td>1</td>
                          <td>Kelas 7A</td>
                          <td>36</td>
                          <td>
                           <select class="form-control">
                            <option>- Pilih Wali Kelas -</option>
                            <option>Nadya</option>
                            <option>Indi</option>
                            <option>Rahesti</option>
                            
                          </select> 
                          </td>
                          <td>
                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
                          </td>
                        </tr>
                        <tr>
                          <td><input type="checkbox" class="flat" name="table_records"></td>
                          <td>2</td>
                          <td>Kelas 7B</td>
                          <td>37</td>   
                          
                           <td>
                           <select class="form-control">
                            <option>- Pilih Wali Kelas -</option>
                            <option>Nadya</option>
                            <option>Indi</option>
                            <option>Rahesti</option>
                            
                          </select> 
                          </td>
                          <td>
                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
                          </td>
                          
                        </tr>
                        <tr>
                          <td><input type="checkbox" class="flat" name="table_records"></td>
                          <td>3</td>
                          <td>Kelas 7C</td>
                          <td>36</td>   
                          
                           <td>
                           <select class="form-control">
                            <option>- Pilih Wali Kelas -</option>
                            <option>Nadya</option>
                            <option>Indi</option>
                            <option>Rahesti</option>
                            
                          </select> 
                          </td>
                          <td>
                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
                          </td>
                          
                        </tr>
                        <tr>
                          <td><input type="checkbox" class="flat" name="table_records"></td>
                          <td>4</td>
                          <td>Kelas 7D</td>
                         <td>37</td>   
                          
                           <td>
                           <select class="form-control">
                            <option>- Pilih Wali Kelas -</option>
                            <option>Nadya</option>
                            <option>Indi</option>
                            <option>Rahesti</option>
                            
                          </select> 
                          </td>
                          <td>
                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
                          </td>
                        </tr>
                        <tr>
                          <td><input type="checkbox" class="flat" name="table_records"></td>
                          <td>5</td>
                          <td>Kelas 7E</td>
                          <td>37</td>   
                          
                           <td>
                           <select class="form-control">
                            <option>- Pilih Wali Kelas -</option>
                            <option>Nadya</option>
                            <option>Indi</option>
                            <option>Rahesti</option>
                            
                          </select> 
                          </td>
                          <td>
                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
                          </td>
                        </tr>
                   
                      </tbody>


                    </table>

                    <div class="tambahkelas">
                     <i class="fa fa-plus-circle text-red"></i><a style="color:red" href="#" id="tambahkelas"> Tambah kelas</a>
                  
                        </div>

                        &nbsp
                        &nbsp


                     <div class="bagikelas">
                     <label class="control-label">Pilih Pembagian Kelas</label>
                     <a href="<?php echo site_url('distribusi/distribusi_reg/pembagian_agama'); ?>"><button type="button" class="btn btn-primary">Agama</button></a>
                     <a href="pembagian_prestasi.html"><button type="button" class="btn btn-primary">Prestasi</button></a>
                     
                      </div>


                        <!-- <div class="form-group">
                        <label class="control-label col-md-3">Pilih Pembagian Kelas</label>
                        <div class="col-sm-offset-2 col-sm-10">

                  <a href="agama.html"><button type="button" class="btn btn-primary">Agama</button></a>
                  <a href="prestasi.html"><button class="btn btn-primary" type="button">Prestasi</button>
                  
                  
                  </div>
                    
                        </div> -->
                        <!-- end tab 2 -->
                        
                        <!-- end tab 3 -->

                        
                        <!-- end tab 4 -->
                      </div>
                    </div>
          
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="col-md-12 ">

          <!-- Profile Image -->
          
          <!-- /.box -->
        </div>
       
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>