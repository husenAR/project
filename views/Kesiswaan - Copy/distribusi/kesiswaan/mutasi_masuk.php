<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
 <center style="color:grey;">Mutasi Siswa Masuk<br></center>
 <center><small>Tahun Ajaran 2016-2017 Kurikulum 2013</small></center> </h1>
<ol class="breadcrumb">
 <li><a href="<?php echo base_url();?>distribusi/kesiswaan/index">Dashboard</a></li>
</ol>
</section>

<!-- Main content -->
<section class="content">

<div class="row">
<div class="col-md-12">
   <div class="nav-tabs-custom">
     <ul class="nav nav-tabs">
       <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true" >Formulir Pengajuan </a></li>
       <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Pendaftar </a></li>
       <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Pencatatan </a></li>
       <li role="presentation"><a href="#tab_content4" role="tab" id="profile-tab3" data-toggle="tab" aria-expanded="false">Buat Pengumuman </a></li>
     </ul>

     <div id="myTabContent" class="tab-content">
       <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
     
       
		<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="<?php echo site_url('distribusi/kesiswaan/simpan_form_mutasi'); ?>">

<?php
                 $i=1;
                 foreach ($form_pendaftaran_mutasi_masuk as $form) 
                 { 
                   if ($i<29) 
                   {
                     ?><input type="checkbox" class="flat" name="nilai<?php echo $form->id_form_pendaftaran_mutasi_masuk; ?>" value="1" <?php 
                     if ($form->nilai == "1") 
                       {
                         echo " checked"; 
                       } 
                     ?>
                     > <label><?php echo $form->atribut; ?></label>
                     <br> 
                     <?php 
                   }
                   elseif ($form!==NULL) 
                   { 
                     if ($form->id_form_pendaftaran_mutasi_masuk < 34) 
                     {
                       ?><br><input type="checkbox" class="flat" name="nilai<?php echo $form->id_form_pendaftaran_mutasi_masuk; ?>" value="1" <?php 
                         if ($form->nilai == "1") 
                         {
                           echo " checked"; 
                         } 
                         ?>> <label style="font-style: normal;">Berkas lain yg ingin dilampirkan</label> 
                         <input type="text" name="atribut<?php echo $form->id_form_pendaftaran_mutasi_masuk; ?>" placeholder=" Nama Berkas" value="<?php echo $form->atribut; ?>"> <br>
                         <?php 
                     }
                     elseif ($i<37) 
                     {
                       ?><br><input type="checkbox" class="flat" name="nilai<?php echo $form->id_form_pendaftaran_mutasi_masuk; ?>" value="1" <?php 
                       if ($form->nilai == "1") 
                       {
                         echo " checked"; 
                       } 
                       ?>
                       > <label><?php echo $form->atribut; ?></label>
                       <br> 
                     <?php 
                     }
                   }
                   else
                   {
                     echo "error";
                   }
                   $i=$i+1;
                 }
                 ?>

                 <div class="ln_solid"></div>
               <div class="form-group">
             <div class="col-sm-offset-2 col-sm-10">
               <button type="button" class="btn btn-primary">Cancel</button>
               <button type="reset" class="btn btn-primary">Reset</button>
               <button type="submit" class="btn btn-danger">Submit</button>
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
                 <th class="fit">No.pendaftar</th>
                 <th>NISN</th>
                 <th>Nama</th>
                 <th>Total Nilai</th>
                 <th>&nbsp;</th>
                 <th>Berkas</th>
                 <th>Status</th>
                 <th>&nbsp;</th>
                 <!-- <th>Nilai Ujian</th> -->
               </tr>
               </thead>
               <tbody>
                 <?php 
                  $i=1;
            
                  foreach ($tabel_siswa_mutasi_masuk as $row) 
                  {
                    ?>
                    <tr>
                     
                      <td><?php echo $row->id_pendaftar_mutasi; ?></td>
                      <td><?php echo $row->nisn; ?></td>
                      <td><?php echo $row->nama_pendaftar_mutasi; ?></td>
                      <td><?php echo $row->jumlah_nilai_un; ?></td>
                      <td>
                      <!--  Modal detail nilai -->
                      <div class="modal fade bs-example-modal-lg" id="myNilaii<?php echo $i; ?>">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                              <h4 class="modal-title" id="myModalLabel">Daftar Berkas Mutasi Masuk</h4>
                            </div>
                            <div class="modal-body">
                              <table>
                              <tr>
                                  <td>Nilai UN Bahasa Indonesia</td>
                                  <td>:</td>
                                  <td><?php echo $row->nilai_un_bahasaindonesia ?></td>
                                </tr>
                                <tr>
                                  <td>Nilai UN IPA</td>
                                  <td>:</td>
                                  <td><?php echo $row->nilai_un_ipa ?></td>
                                </tr>
                                <tr>
                                  <td>Nilai UN Matematika</td>
                                  <td>:</td>
                                  <td><?php echo $row->nilai_un_matematika ?></td>
                                </tr>
                                <tr>
                                  <td>Nilai UN IPA</td>
                                  <td>:</td>
                                  <td><?php echo $row->nilai_un_ipa ?></td>
                                </tr>
                              </table>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary button-form button-update-barang">Save changes</button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Modal detail berkas -->
                      <div class="modal fade bs-example-modal-lg" id="myBerkas<?php echo $i; ?>">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                              <h4 class="modal-title" id="myModalLabel">Daftar Berkas Mutasi Masuk</h4>
                            </div>
                            <div class="modal-body">
                              <table>
                                <tr>
                                  <td>Surat Keterangan NISN </td>
                                  <td>:</td>
                                  <td><?php echo $row->surat_ket_nisn == 'on' ? 'available' : 'not available'  ?></td>
                                </tr>
                                <tr>
                                  <td>Fotokopi Buku Rapor </td>
                                  <td>:</td>
                                  <td><?php echo $row->fc_buku_rapor == 'on' ? 'available' : 'not available'?></td>
                                </tr>
                                <tr>
                                  <td>Fotokopi SKHUN </td>
                                  <td>:</td>
                                  <td><?php echo $row->fc_skhun == 'on' ? 'available' : 'not available'?></td>
                                </tr>
                                <tr>
                                  <td>Surat Keterangan Bangku Kosong </td>
                                  <td>:</td>
                                  <td><?php echo $row->surat_ket_bangku == 'on' ? 'available' : 'not available'?></td>
                                </tr>
                                <tr>
                                  <td>Surat Keterangan Pindah </td>
                                  <td>:</td>
                                  <td><?php echo $row->surat_ket_pindah == 'on' ? 'available' : 'not available' ?></td>
                                </tr>
                                <tr>
                                  <td>Surat Kelakuan Baik Kepala Sekolah </td>
                                  <td>:</td>
                                  <td><?php echo $row->skck_kepsek == 'on' ? 'available' : 'not available' ?></td>
                                </tr>
                              </table>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary button-form button-update-barang">Save changes</button>
                            </div>
                          </div>
                        </div>
                      </div>
                       <a data-toggle="modal" class="btn btn-default btn-xs" data-show="true" data-target="#myNilaii<?php echo $i; ?>">Detail Nilai</a>
                      </td>
                      <td>
                       <a data-toggle="modal" class="btn btn-default btn-xs" data-show="true" data-target="#myBerkas<?php echo $i; ?>">Detail Berkas</a>
                      </td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-primary">Action</button>
                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <?php
                            $link_diterima = base_url()."distribusi/kesiswaan/ubah_status_siswa_mutasi/".$row->id_pendaftar_mutasi."/Diterima";
                            $link_ditolak = base_url()."distribusi/kesiswaan/ubah_status_siswa_mutasi/".$row->id_pendaftar_mutasi."/Ditolak";
                            $link_dicabut = base_url()."distribusi/kesiswaan/ubah_status_siswa_mutasi/".$row->id_pendaftar_mutasi."/Dicabut";
                            ?>
                            <li><a href="<?php echo $link_diterima ?>">Diterima</a></li>
                            <li><a href="<?php echo $link_ditolak ?>">Ditolak</a></li>
                            <li><a href="<?php echo $link_dicabut ?>">Dicabut</a></li>
                          </ul>

                        </div>
                      </td>
                      <td>
                        <?php
                        if ($row->status_siswa == 'Diterima') {
                          echo '<span class="label label-success">Diterima</span>';
                        } elseif ($row->status_siswa == 'Ditolak') {
                          echo '<span class="label label-danger">Ditolak</span>';
                        } elseif ($row->status_siswa == 'Dicabut') {
                          echo '<span class="label label-warning">Dicabut</span>';
                        } else {
                          echo '<span class="label label-default"><i>Belum ada status</i></span>';
                        }
                        ?>
                      </td>
                    </tr>
                    <?php
                    $i=$i+1;
                    }
                    ?>
                  </tbody>
                </table>
              </form>

             <?php 
                $i=1;
                foreach ($tabel_siswa_mutasi_masuk as $row) 
                { ?>
                    <div id="myBerkas<?php echo $i; ?>" class="modal fade" role="dialog">
                      <div class="modal-dialog modal-md">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Lihat Nilai</h4>
                            </div>
                            <div class="modal-body"></div>
                        </div>
                      </div>
                    </div> 

                    <div id="myBerkas<?php echo $i; ?>" class="modal fade" role="dialog">
                      <div class="modal-dialog modal-md">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Lihat Berkas</h4>
                          </div>
                          <div class="modal-body"></div>
                        </div>
                      </div>
                    </div>
                    <?php
                    $i=$i+1;
                  } ?>
               </tbody>
               </thead>
               </table>
                 <div class="ln_solid"></div>
               <div class="form-group">
                   <button class="btn btn-dark"><i class="fa fa-print text-red "></i> Print Pengumuman</button>
               </div>
         
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
                   <th style="width: 20%">Nama Siswa</th>
                   <th style="width: 10%">Sekolah</th>
                   <th style="width: 10%"></th>
                   <th style="width: 10%"></th>
                 </tr>
               </thead>
               <tbody>
               <?php 
                $i=1;
                foreach ($data_pencatatan as $row) 
                { 
                ?>
                <tr>
                   <td><?php echo $i; ?></td>
                   <td><?php echo $row->nisn; ?></td>
                   <td><?php echo $row->nama_pendaftar_mutasi; ?></td>
                   <td><?php echo $row->sekolah_asal; ?></td>
                   <td>
                     <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
                   </td>
                   <td>
                     <button class="btn btn-dark"><i class="fa fa-print text-red "></i> Print Bukti</button>
                   </td>
                 </tr>
                 <?php
                    $i=$i+1;
                  } ?>

                 
                
               </tbody>


             </table>
              </div>

              <!-- end tab 3 -->


              <div class="tab-pane" id="lihatpengumuman">
                         <a href="#dokumen" data-toggle="tab"><button class="btnback"><i class="fa fa-chevron-left"></i></button></a>
                         <div class="box-header jarakbox">
                         <center><embed src="dokumen/bangku.pdf" width="1000" height="1000"> </embed></center>
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
                   <th style="width: 10%">Nama File</th>
                   <th style="width: 10%">Tahun Ajaran</th>
                   <th style="width: 10%"></th>
                 </tr>
               </thead>
               <tbody>
                 <tr>
                   <td>1</td>
                   <td><a href="#lihatpengumuman" data-toggle="tab">Pengumuman Mutasi.pdf</td>
                   <td>2014/2015</td>
                   <td>
                     <button type="submit" class="btn btn-primary" href="#tab_content4" data-toggle="tab">Ubah</button>
                   <button type="button" class="btn btn-danger" href="#tab_content4" data-toggle="tab"> Hapus</button>
                   </td>
                 </tr>
               </table>
                 </div>

                <div class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
               <div class="tab-pane">
                 <form class="form-horizontal formkaldik" method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>distribusi/kesiswaan/upload_file">
                  <div class="form-group formgrup jarakform">
                    <label class="control-label col-sm-2" for="first-name">Judul Pengumuman <span class="required">*</span>
                    </label>
                    <div class="col-sm-4 form-group">
                    <input type="text" class="form-control" name="judul_pengumuman">
                  </div>
                  </div>                  

                  <div class="form-group formgrup jarakform">
                    <label class="control-label col-sm-2" for="first-name">Tanggal <span class="required">*</span>
                    </label>
                    <div class="col-sm-4 form-group">
                    <input type="date" class="form-control" name="tgl_pengumuman">
                  </div>
                  </div>

                   <div class="form-group formgrup">
                     <label for="inputName" class="col-sm-2 control-label">File </label>
                      <div class="col-sm-4">
                     <input type="file" class="form-control" id="inputName" placeholder="Name" name="pengumuman">
                   </div>
                 </div>
                
                 <div class="form-group" >
                   <div class="col-sm-offset-2 col-sm-10">
                   <button type="submit" class="btn btn-danger">Simpan</button>
                   <button type="button" class="btn btn-danger"> Lihat dokumen</button>
                 </div>
               </div>
               </form> 
               </div>
               </div>
                 </div>
               
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