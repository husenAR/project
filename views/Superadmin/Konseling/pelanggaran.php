
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <center style="color:navy;">Pelanggaran Siswa SMP Yogyakarta<br></center>
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
                  <!-- <h4 class="box-title">Pelanggaran Siswa</h4> -->
                </div>
                <form role="form" method="post">
          
                    <div class="box-body">
                      <select name="kelas">
                            <option value="Kelas 7A">Kelas 7A</option>
                            <option value="Kelas 7B">Kelas 7B</option>
                            <option value="Kelas 8A">Kelas 8A</option>
                            <option value="Kelas 8B">Kelas 8B</option>
                            <option value="Kelas 9A">Kelas 9A</option>
                            <option value="Kelas 9B">Kelas 9B</option>
                      </select><br/><br/> 
                      <table class="table table-bordered">
                        <tr>
                          <th style="width: 10px">No</th>
                          <th>Nama Lengkap</th>
                          <th>NIS</th>
                          <th>Kategori Pelanggaran</th>
                          <th>Bentuk Pelanggaran</th> 
                          <th>No Pasal</th> 
                          <th>Point</th> 
                          <th>Sanksi</th>
                          <th>Aksi</th> 
                        </tr>
                        <tr>
                          <td>1.</td>
                          <td>Aisyah</td> 
                          <td>014</td> 
                          <td>
                            <select>
                                <option>Pelanggaran Ringan</option>  
                                <option>Pelanggaran Sedang</option>  
                                <option>Pelanggaran Berat</option>  
                            </select>  
                          </td> 
                          <td>
                            <div class="col-md-12 col-sm-4 col-xs-10">
                              <input type="text" name="request" class="form-control col-md-12 col-xs-12" placeholder="Isi ket Pelanggaran Siswa">
                            </div>  
                          </td>
                          <td>
                            <select>
                                <option>Pasal 4</option>  
                                <option>Pasal 5</option>  
                                <option>Pasal 6</option>   
                            </select>  
                          </td> 
                          <td>
                            <select>
                                <option>5</option>  
                                <option>10</option>  
                                <option>15</option>   
                            </select>  
                          </td> 
                          <td>Memberikan hukuman</td>
                           <td> 
                                <i class="fa fa-edit"></i><a href="#">Edit</a>
                                <i class="fa fa-trash"></i><a href="#">Delete</a> 
                              </td>
                        </tr>
                          
                        <tr>
                          <td>2.</td>
                          <td>Anto</td> 
                          <td>015</td> 
                          <td>
                            <select>
                                <option>Pelanggaran Ringan</option>  
                                <option>Pelanggaran Sedang</option>  
                                <option>Pelanggaran Berat</option>  
                            </select>  
                          </td> 
                          <td>
                            <div class="col-md-12 col-sm-4 col-xs-10">
                              <input type="text" name="request" class="form-control col-md-12 col-xs-12" placeholder="Isi ket Pelanggaran Siswa">
                            </div>  
                          </td>
                          <td>
                            <select>
                                <option>Pasal 4</option>  
                                <option>Pasal 5</option>  
                                <option>Pasal 6</option>   
                            </select>  
                          </td> 
                          <td>
                            <select>
                                <option>5</option>  
                                <option>10</option>  
                                <option>15</option>   
                            </select>  
                          </td> 
                          <td>Memberikan hukuman</td>
                           <td> 
                                <i class="fa fa-edit"></i><a href="#">Edit</a>
                                <i class="fa fa-trash"></i><a href="#">Delete</a> 
                              </td>
                        </tr>
                          
                      </table>
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
                  <h4> <class="box-title">Data Pelanggaran Siswa</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                        <tr>
                          <th style="width: 10px">No</th>
                          <th>Nama Lengkap</th>
                          <th>NIS</th>
                          <th>Kategori Pelanggaran</th>
                          <th>Bentuk Pelanggaran</th> 
                          <th>No Pasal</th> 
                          <th>Point</th> 
                          <th>Sanksi</th> 
                        </tr>
                        <tr>
                          <td>1.</td>
                          <td>Aisyah</td> 
                          <td>014</td> 
                          <td>Pelanggaran Ringan</td> 
                          <td>Membuang Sampah Sembarangan</td>
                          <td>4</td> 
                          <td>5</td> 
                          <td>Memberikan hukuman</td>
                        </tr>
                          
                        <tr>
                          <td>2.</td>
                          <td>Anto</td> 
                          <td>015</td> 
                          <td>Pelanggaran Berat</td> 
                          <td>Merokok</td>
                          <td>5</td> 
                          <td>70</td> 
                          <td>Memberikan hukuman</td>
                        </tr>
                          
                      </table>
                </div>
                  
              </div>
            </div>
        </div>
        
            
    </section>
    <!-- /.content -->
  </div>
  