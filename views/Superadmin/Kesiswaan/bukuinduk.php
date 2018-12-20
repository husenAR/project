

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <center style="color:navy;">Buku Induk Siswa<br></center>
      <br>
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="dashboard.php">Dashboard</li>
    </ol>
  </section>
  </a>
  </li>
  </ol>
  </section>
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <!-- Main row -->
    

      <!-- /.col -->
      <div class="col-md-12">
        <div class="nav-tabs-custom">
       
<!-- page content -->
          
                  <!-- end x tittle -->
                    
                    <div class="row">
                    <div class="col-sm-6">
                            <div id="example1_filter" class="dataTables_filter">
                              <label>Data yang ingin dicari: <input type="search"> <button type="submit">Cari</button>
                              </label>
                            </div>
                          </div>
                          </div>

                          <br>
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="dataTables_length" id="example1_length">
                                <label>Menampilkan hasil pencarian <select name="example1_length" aria-controls="example1" class="form-control input-sm">
                                  <option value="10">10</option>
                                  <option value="25">25</option>
                                  <option value="50">50</option>
                                  <option value="100">100</option>
                                  <option value="100">Semua</option>
                                </select> 
                              </label>
                            </div>
                          </div>
                          <br>
                          
                        </div>
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 5%">Tahun</th>
                          <th style="width: 5%">NISN</th>
                          <th style="width: 25%">Nama</th>                         
                          <th style="width: 5%">Status</th>
                          <th style="width: 5%"></th>
                          <th style="width: 5%"></th>
                        </tr>
                      </thead>
                           <tbody class="searchable">
                    <?php 
                    $i=0;
                    foreach ($tabel_pendaftar_ppdb as $row) 
                    {
                      $i=$i+1;
                      ?>
                      <tr>
                        <td><?php echo $row->tahun_ajaran; ?></td>
                         <td><?php echo $row->nisn_pendaftar; ?></td>
                        <td><?php echo $row->nama; ?></td>
                        <td>
                          <?php
                            if ($row->status_siswa == 'Diterima') {
                              echo '<span class="label label-success">Aktif</span>';
                            } elseif ($row->status_siswa == 'Tidak Diterima') {
                              echo '<span class="label label-success">Aktif</span>';
                            } elseif ($row->status_siswa == 'Dicabut') {
                              echo '<span class="label label-success">Aktif</span>';
                            } else {
                              echo '<span class="label label-success"><i>Aktif</i></span>';
                            }
                            ?>
                        </td>
                        <td>
                             <a href="lihatinduk.php" class="btn btn-info btn-xs""></i> Lihat </a>
                          </td>
                          <?php
            if (($this->session->userdata('jabatan') == 'Superadmin') || ($this->session->userdata('jabatan') == 'Kesiswaan')) {
              ?>
                          <td>
                            <a href="editinduk.php" class="btn btn-danger btn-xs"></i> Edit </a>
                          </td>
                          <?php
                    }
                    ?>
                     
                      </tr>
                      <?php
                    }
                    ?>
                    </table>
                    </div>
                      

                        
                        
                    </div>
              </div>


      <!-- end of berkas -->
      <!-- end of berkas -->
      
      <!-- end of profil -->
          </div>
            <!-- end container main -->
      </div>
  
 <!-- end container body-->



       
<!-- /.content-wrapper -->
