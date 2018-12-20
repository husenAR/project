<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <center style="color:navy;">Halaman Kelola Data Mata Pelajaran<br></center>
      
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      
      <!-- /.row -->
      <!-- Main row -->
     <div class="row">
   
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#kelolamapel" data-toggle="tab">< Mata Pelajaran</a></li>
              <li><a href="#datamapel" data-toggle="tab">Data Mata Pelajaran </a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="kelolamapel">
              <div class="box-header">
              <form>
                      <select name="pilihgrade" id="pilihgrade" >
                        <option value="kelas 7"> KELAS 7</option>
                        <option value="kelas 8" > KELAS 8</option>
                        <option value="kelas 9"> KELAS 9</option>
                        <option value="Ekskul"> Ekskul </option>
                      </select>
              </form>
            </div>
               <form id="formmapel" style="display:block;" class="form-horizontal formmapel" method="post" >
                  <input type="hidden" name="id_mapel" id="id_mapel"  />
                  <input type="hidden" name="grade" id="grade"  />
                  <div class="bigbox-mapel"> 
                    <div class="box-mapel">
                      <div class="form-group formgrup jarakform">
                        <label for="inputKurikulum" class="col-sm-2 control-label">Nama Mata Pelajaran</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" placeholder="Nama Mata Pelajaran" value="<?php echo @$edit_mapel->nama_mapel; ?>">
                        </div>
                      </div>

                      <div class="form-group formgrup jarakform">
                        <label for="inputKurikulum" class="col-sm-2 control-label">KKM</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="kkm" name="kkm" placeholder="KKM"  >
                        </div>
                      </div>

                      <div class="form-group formgrup jarakform">
                        <label for="inputKurikulum" class="col-sm-2 control-label">Jam Belajar</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="jam_belajar" name="jam_belajar" placeholder="Jam Belajar" >
                        </div>
                      </div>
                    </div>
                  </div>
                 <!--  <div class="tambahmapel">
                    <i class="fa fa-plus-circle text-red"></i><a style="color:red" href="#" id="tambahmapel"> Tambah mapel</a>
                  </div> -->
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>

                <form id="formekskul" style="display:none;" class="form-horizontal formmapel">
                  <div class="bigbox-mapel"> 
                    <div class="box-mapel">
                      <div class="form-group formgrup jarakform">
                        <label for="inputKurikulum" class="col-sm-2 control-label">Hari</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputName" placeholder="Hari">
                        </div>
                      </div>

                      <div class="form-group formgrup jarakform">
                        <label for="inputKurikulum" class="col-sm-2 control-label">Waktu</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputName" placeholder="Waktu">
                        </div>
                      </div>

                      <div class="form-group formgrup jarakform">
                        <label for="inputKurikulum" class="col-sm-2 control-label">Jenis Ekstrakulikuler</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputName" placeholder="Jenis Ekstrakulikuler">
                        </div>
                      </div>

                      <div class="form-group formgrup jarakform">
                        <label for="inputKurikulum" class="col-sm-2 control-label">Tempat</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputName" placeholder="Tempat">
                        </div>
                      </div>

                      <div class="form-group formgrup jarakform">
                        <label for="inputKurikulum" class="col-sm-2 control-label">Pembimbing</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputName" placeholder="Pembimbing">
                        </div>
                      </div>

                    </div>
                  </div>
                 <!--  <div class="tambahmapel">
                    <i class="fa fa-plus-circle text-red"></i><a style="color:red" href="#" id="tambahmapel">Tambah mapel</a>
                  </div> -->
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
               
              </div>
              <!-- /.tab-pane -->

              <!-- /.tab-pane -->

              <div class="tab-pane" id="datamapel">
              <!-- DATA MAPEL KELAS 7 -->
                <div class="box">
                  <div class="box-header" style="background-color:     #5c8a8a">
                    <h3 class="box-title" style="color:white">Data Mata Pelajaran Semua Kelas</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th class="fit">No</th>
                        <th>Mata Pelajaran</th>
                        <th>KKM</th>
                        <th>Jam Belajar</th>
                        <th>Jumlah Jam Belajar<br>
                        (Jam Belajar x Jumlah Kelas)</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                    
                      <tr>
                        <td class="fit">1</td>
                        <td>Matematika</td>
                        <td>88</td>
                        <td>9</td>
                        <td>36</td>
                        <td> 
                          <a class="btn btn-block btn-primary button-action btnedit"  > Edit </a>
                          <a class="btn btn-block btn-primary button-action btnhapus"  > Hapus </a>
                        </td>               
                      </tr>

                       <tr>
                        <td class="fit">2</td>
                        <td>Bahasa Indonesia</td>
                        <td>88</td>
                        <td>9</td>
                        <td>36</td>
                        <td> 
                          <a class="btn btn-block btn-primary button-action btnedit"  > Edit </a>
                          <a class="btn btn-block btn-primary button-action btnhapus"  > Hapus </a>
                        </td>               
                      </tr>

                       <tr>
                        <td class="fit">3</td>
                        <td>Bahasa Inggris</td>
                        <td>88</td>
                        <td>9</td>
                        <td>36</td>
                        <td> 
                          <a class="btn btn-block btn-primary button-action btnedit"  > Edit </a>
                          <a class="btn btn-block btn-primary button-action btnhapus"  > Hapus </a>
                        </td>               
                      </tr>



                       <tr>
                        <td class="fit">4</td>
                        <td>IPS</td>
                        <td>88</td>
                        <td>9</td>
                        <td>36</td>
                        <td> 
                          <a class="btn btn-block btn-primary button-action btnedit"  > Edit </a>
                          <a class="btn btn-block btn-primary button-action btnhapus"  > Hapus </a>
                        </td>               
                      </tr>

                       <tr>
                        <td class="fit">5</td>
                        <td>IPA</td>
                        <td>88</td>
                        <td>9</td>
                        <td>36</td>
                        <td> 
                          <a class="btn btn-block btn-primary button-action btnedit"  > Edit </a>
                          <a class="btn btn-block btn-primary button-action btnhapus"  > Hapus </a>
                        </td>               
                      </tr>
                    
                      </tbody>
                    </table>
                  </div>
                  <!-- /.box-body -->
                </div>

              <!-- DATA MAPEL KELAS 8 -->
                

              <!-- DATA MAPEL KELAS 9 -->
                
              </div>
              <!-- /.tab-pane -->

              <!-- /.tab-pane -->

              <div class="tab-pane" id="editdatamapel">
              <form class="form-horizontal formmapel">
                  <div class="bigbox-mapel"> 
                    <div class="box-mapel">
                      <div class="form-group formgrup jarakform">
                        <label for="inputKurikulum" class="col-sm-2 control-label">Nama Mata Pelajaran</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputName" placeholder="IPA">  
                        </div>
                      </div>


                      <div class="form-group formgrup jarakform">
                        <label for="inputKurikulum" class="col-sm-2 control-label">KKM</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputName" placeholder="80">
                        </div>
                      </div>

                      <div class="form-group formgrup jarakform">
                        <label for="inputKurikulum" class="col-sm-2 control-label">Jam Belajar</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputName" placeholder="7">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <td><button type="submit" class="btn btn-danger" href="#datamapel" data-toggle="tab">Submit</button></td><td> <button class="btn btn-danger" href="#datamapel" data-toggle="tab">Back</button></td>
                    </div>
                  </div>
                </form>

                </div>

              <!-- /.tab-pane -->


            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->

      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->