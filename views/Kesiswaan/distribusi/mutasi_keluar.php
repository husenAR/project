  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <center style="color:grey;">Mutasi Siswa Keluar<br></center>
        <center><small>Tahun Ajaran 2016-2017 Kurikulum 2013</small></center> </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>kesiswaan/index">Dashboard</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
    <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true" >Surat Pengajuan</a></li>
              <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Pendaftar</a></li>
              <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Pencatatan</a></li>
            </ul>

            <div id="myTabContent" class="tab-content">

              <div class="tab-pane" id="lihatpengumuman">
                                <a href="#dokumen" data-toggle="tab"><button class="btnback"><i class="fa fa-chevron-left"></i></button></a>
                                <div class="box-header jarakbox">
                                <center><embed src="dokumen/surat.pdf" width="1000" height="1000"> </embed></center>
                                </div>
                              </div>
                        <div class="tab-pane" id="dokumen">
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="dataTables_length" id="example1_length">
                                <label>Show <select name="example1_length" aria-controls="example1" class="form-control input-sm">
                                  <option value="10">10</option>
                                  <option value="25">25</option>
                                  <option value="50">50</option>
                                  <option value="100">100</option>
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
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 1%">No</th>
                          <th style="width: 5%">NIS</th>
                          <th style="width: 10%">Nama Siswa</th>
                          <th style:"width: 5%">Kelas</th>
                          <th style="width: 15%">Surat Pengajuan Mutasi</th>
                          <th style="width 15%">Surat Bebas Adminstrasi</th>
                          <th style="width: 10%"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>12523036</td>
                          <td>Yanuar Fajar</td>
                          <td>IX C</td>
                          <td><a href="#lihatpengumuman" data-toggle="tab">surat.pdf</td>
                           <td><a href="#lihatpengumuman" data-toggle="tab">bebas.pdf</td>
                          <td>
                            <button type="submit" class="btn btn-primary" href="#tab_content1" data-toggle="tab">Ubah</button>
                          <button type="button" class="btn btn-danger" href="#tab_content4" data-toggle="tab"> Hapus</button>
                          </td>
                        </tr>
                      </table>
                        </div>






              <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
            
              
				<form class="form-horizontal formmapel">
                  <div class="bigbox-mapel"> 
                    <div class="box-mapel">
                      <div class="form-group formgrup jarakform">
                        <label for="first-name" class="col-sm-2 control-label">NIS*</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="first-name" placeholder="Judul Formulir">
                        </div>
                      </div>
                      <div class="form-group formgrup jarakform">
                        <label for="first-name" class="col-sm-2 control-label">Nama Siswa</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="first-name" placeholder="Judul Formulir">
                        </div>
                      </div>

                      <div class="form-group formgrup jarakform">
                        <label for="logo-daerah" class="col-sm-2 control-label">Surat Permohonan</label>
                        <div class="col-sm-4">
                          <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertFile" class="form-control" id="surat_permohonan" placeholder="Surat Permohonan">
                       </div>
                       <div class="col-sm-4">
                       <button type="button" class="btn btn-danger" href="#dokumen" data-toggle="tab"> Lihat dokumen</button>
                       </div>
                      </div>

                      <div class="form-group formgrup jarakform">
                        <label for="logo-sekolah" class="col-sm-2 control-label">Surat Bebas Administrasi</label>
                        <div class="col-sm-4">
                          <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertFile" class="form-control" id="surat_bebas_administrasi" placeholder="Surat Bebas Administrasi">
                        </div>
                        <div class="col-sm-4">
                       <button type="button" class="btn btn-danger" href="#dokumen" data-toggle="tab"> Lihat dokumen</button>
                       </div>
                      </div>

                      <div class="form-group formgrup jarakform">
                        <label for="atribut-formulir" class="col-sm-2 control-label">Berkas yang dibutuhkan<span class="required">*</span></label>
                        <div class="col-sm-4">
                          <ul class+"to_do">
                          	<li>
                          		<p>
                          		<input type="checkbox" class="flat">
                          		Berkas </p>
                          	</li>
                          	<li>
                          		<p>
                          		<input type="checkbox" class="flat">
                          		Berkas </p>
                          	</li>
 							              <li>
                           		<p>
                          		<input type="checkbox" class="flat">
                          		Berkas </p>
                          	</li>
  								          <li>
                          		<p>
                          		<input type="checkbox" class="flat">
                          		Berkas </p>
                          	</li>
 								             <li>
                          		<p>
                          		<input type="checkbox" class="flat">
                          		Berkas </p>
                          	</li>

                          </ul>
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" class="btn btn-primary">Cancel</button>
                      <button type="reset" class="btn btn-primary">Reset</button>
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                     </div>
                    </div>
                    </div>
                    </form>
                    </div>
        
                <!-- end tab 1 -->

              

            
              <div class="active tab-pane" id="tab_content2" aria-labelledby="profile-tab">
              <div class="col-sm-6">
                              <div class="dataTables_length" id="example_length">
                                <label>Show <select name="example1_length" aria-controls="example1" class="form-control input-sm">
                                  <option value="10">10</option>
                                  <option value="25">25</option>
                                  <option value="50">50</option>
                                  <option value="100">100</option>
                                </select> entries
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div id="example1_filter" class="dataTables_filter">
                              <label>Search:<input type="search" class="form-control input-sm text-right" placeholder="" aria-controls="example1">
                              </label>
                            </div>
                          </div>
                          <table class="table table-striped projects">
                          <thead>
                      <tr>
                        <th style="width: 5%">NISN</th>
                        <th style="width: 20%">Nama Siswa</th>
                        <th style="width: 5%">Berkas yang berkas dibutuhkan</th>
                        <th style="width: 20%"></th>
                        
                      </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>12345666</td>
                          <td>Fatimatus Zuhro
                          <br />
                            <small>Daftar Pada 12.06.2017</small></td>
                          <td>
                             <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#berkas"><i class="fa fa-folder"></i> Lihat Berkas</button>
                          </td>
                          <td>
                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
                          </td>
                          <td>
                            <button class="btn btn-dark"><i class="fa fa-print text-red "></i> Print Pengumuman</button>
                          </td>
                        </tr>
                        <tr>
                          <td>12345666</td>
                          <td>Fatimatus Zuhro
                          <br />
                            <small>Daftar Pada 12.06.2017</small></td>
                          <td>
                             <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#berkas"><i class="fa fa-folder"></i> Lihat Berkas</button>
                          </td>
                          <td>
                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
                          </td>
                          <td>
                            <button class="btn btn-dark"><i class="fa fa-print text-red "></i> Print Pengumuman</button>
                          </td>
                        </tr>
                        <tr>
                          <td>12345666</td>
                          <td>Fatimatus Zuhro
                          <br />
                            <small>Daftar Pada 12.06.2017</small></td>
                          <td>
                             <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#berkas"><i class="fa fa-folder"></i> Lihat Berkas</button>
                          </td>
                          <td>
                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
                          </td>
                          <td>
                            <button class="btn btn-dark"><i class="fa fa-print text-red "></i> Print Pengumuman</button>
                          </td>
                        </tr>
                        <tr>
                          <td>12345666</td>
                          <td>Fatimatus Zuhro
                          <br />
                            <small>Daftar Pada 12.06.2017</small></td>
                          <td>
                             <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#berkas"><i class="fa fa-folder"></i> Lihat Berkas</button>
                          </td>
                          <td>
                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
                          </td>
                          <td>
                            <button class="btn btn-dark"><i class="fa fa-print text-red "></i> Print Pengumuman</button>
                          </td>
                        </tr>
                        <tr>
                          <td>12345666</td>
                          <td>Fatimatus Zuhro
                          <br />
                            <small>Daftar Pada 12.06.2017</small></td>
                          <td>
                             <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#berkas"><i class="fa fa-folder"></i> Lihat Berkas</button>
                          </td>
                          <td>
                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
                          </td>
                          <td>
                            <button class="btn btn-dark"><i class="fa fa-print text-red "></i> Print Pengumuman</button>
                          </td>
                        </tr>
                        <tr>
                          <td>12345666</td>
                          <td>Fatimatus Zuhro
                          <br />
                            <small>Daftar Pada 12.06.2017</small></td>
                          <td>
                             <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#berkas"><i class="fa fa-folder"></i> Lihat Berkas</button>
                          </td>
                          <td>
                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
                          </td>
                          <td>
                            <button class="btn btn-dark"><i class="fa fa-print text-red "></i> Print Pengumuman</button>
                          </td>
                        </tr>
                      </tbody>
                      </thead>
                      </table>
                        
                
              </div>


                            
                                          <!-- END TAB 2 -->



                     <div class="active tab-pane" id="tab_content3" aria-labelledby="profile-tab2">
                       <div class="row">
                       <div class="col-sm-6">
                        <div class="dataTables_length" id="example1_length">
                                <label>Show <select name="example1_length" aria-controls="example1" class="form-control input-sm">
                                  <option value="10">10</option>
                                  <option value="25">25</option>
                                  <option value="50">50</option>
                                  <option value="100">100</option>
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
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 5%">No</th>
                          <th style="width: 5%">NISN</th>
                          <th style="width: 20%">Nama Pendaftar</th>
                          <th style="width: 10%">Tanggal</th>
                          <th style="width: 10%">Keterangan</th>
                          <th style="width: 10%">Sekolah</th>
                          <th style="width: 10%"></th>
                          <th style="width: 10%"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>12345666</td>
                          <td>Fatimatus Zuhro</td>
                          <td>12-09-2011</td>
                          <td>Mutasi Keluar</td>
                          <td>SMPN 7 Karawang</td>
                          <td>
                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
                          </td>
                          
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>12345666</td>
                          <td>Sania Warenda</td>
                          <td>12-10-2015</td>
                          <td>Mutasi Keluar</td>
                          <td>SMPN 8 Pekanbaru</td>
                          <td>
                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
                          </td>
                          
                        </tr>
                      </tbody>
                    </table>
                     </div>

                     <!-- end tab 3 -->

                     
                        <!-- end tab 4 -->
                       
                        </div>
                        </div>
            
            </div>

             <!-- end container main -->
            <div class="modal fade bs-example-modal-lg" id="berkas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Daftar Berkas Mutasi Masuk</h4>
            </div>
            <div class="modal-body">
              <form id="formPartE" class="form-horizontal style-form form-goods" method="post" action="#" enctype="multipart/form-data">
                      <div class="form-group">
                          <label class="col-sm-2 col-sm-2 control-label">Pilih Berkas yang Sudah Dilengkapi Siswa:</label>
                          <div class="col-sm-10">
                            <ul class="titik">
                              <li><input type="checkbox"> berkas</li>
                              <li><input type="checkbox"> berkas</li>
                              <li><input type="checkbox"> berkas</li>
                              <li><input type="checkbox"> berkas</li>
                              <li><input type="checkbox"> berkas</li>
                              <li><input type="checkbox"> berkas</li>
                              <li><input type="checkbox"> berkas</li>
                              <li><input type="checkbox"> berkas</li>
                              <li><input type="checkbox"> berkas</li>
                              <li><input type="checkbox"> berkas</li>
                              <li><input type="checkbox"> berkas</li>
                            </ul>                      
                          </div>
                      </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary button-form button-update-barang">Save changes</button>
            </div>
          </div>
        </div>
      </div>
      <!-- end of berkas -->
      <div class="modal fade bs-example-modal-lg" id="nilai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Nilai Ujian Masuk Siswa</h4>
            </div>
            <div class="modal-body">
              <form id="formPartE" class="form-horizontal style-form form-goods" method="post" action="#" enctype="multipart/form-data">
                      <div class="form-group">
                          <label class="col-sm-2 col-sm-2 control-label">Masukkan Nilai Siswa</label>
                          <div class="col-sm-10">
                            <ul class="titik">
                              <li>Nilai 1 <input type="text"></li>
                              <li>Nilai 2 <input type="text"></li>
                              <li>Nilai 3 <input type="text"></li>
                            </ul>                      
                          </div>
                      </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary button-form button-update-barang">Save changes</button>
            </div>
          </div>
        </div>
      </div>
      <!-- end of profil -->
      </div>
