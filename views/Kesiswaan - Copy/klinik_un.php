<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <center style="color:grey;">Klinik UN<br></center>
        <center><small>Tahun Ajaran 2016-2017 Kurikulum 2013</small></center> </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Dashboard</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
   
          <div class="nav-tabs-custom">
            

            <div id="myTabContent" class="tab-content">
             
            
              
                  <div class="bigbox-mapel"> 
                    <div class="box-mapel">
                      <div class="form-group formgrup jarakform">
                     
                     
                       <div class="col-sm-6">
                      
                                <label>Show <select name="example1_length" aria-controls="example1" class="form-control input-sm">
                                  <option value="10">10</option>
                                  <option value="25">25</option>
                                  <option value="50">50</option>
                                  <option value="100">100</option>
                                </select> entries
                              </label>
                            </div>
                          </div>
                          
                        </div>


                    <?php
                    //cetak notifikasi
                    if($this->session->set_flashdata('pesan')) {
                        echo '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                Data berhasil disimpan.">';
                        echo $this->session->flashdata('pesan');
                        echo '</div>';                      
}
?>


                    <table class="table table-striped projects" id="dataTables-example">
                      <thead>
                        <tr>
                          <th class="center"> No </th>
                          <th class="center">NISN</th>
                          <th class="center">Nama</th>
                          <th class="center">Kelas</th>
                          <th class="center">Request Materi</th>
                          <th class="center">Jumlah Peserta</th>
                          <th class="center">Status</th>
                          <th class="center">Respon</th>
                          <th class="center">Aksi</th>
                        </tr>
                      </thead>

                       <tbody>
    <?php 
      if (is_array($klinik_un) && count($klinik_un)) : ?>
    <?php $i=1; foreach($klinik_un as $m) : ?>
    <?php if ($m->id_klinik_un != 0) { ?>

         <tr class="odd gradeX">
            <td><?php echo $i ?></td>
            <td><?php echo $m->nisn?></td>
            <td><?php echo $m->nama_siswa?></td>
            <td><?php echo $m->kelas?></td>
            <td><?php echo $m->req_materi?></td> 
            <td><?php echo $m->jumlah_peserta?></td>
            <td><?php echo $m->status_req; ?></td>
            <!--td--><?php // $respon = isset($_POST['"respon"']) ? htmlspecialchars($_POST['"respon"']) : ""; ?>
            <?php 
            if ($m->respon == "") {
              ?>
            <td>
              <form id="form<?php echo $m->id_klinik_un; ?>" method="post" action="<?php echo site_url("distribusi/kesiswaan/simpan_respon/".$m->id_klinik_un); ?>">
                <input class="text" type="text" id="respon" name="respon" value="" required>
              </form>
            </td>
            <td><input type="submit" name="button" class="btn btn-success btn-lg" value="Simpan Data" onclick="document.getElementById('form<?php echo $m->id_klinik_un; ?>').submit();"></td>
            <?php 
            } else {
            ?>
            <td>
              <?php echo $m->respon; ?>
            </td>
            <td>&nbsp;</td>
            
            <?php
            }
            ?>
        </tr>
              
<?php $i++; } ?>
 <?php endforeach;
 else :
 print "data tidak tersedia";
endif;
?>
    </tbody>
 
                      
                      
                     
</table>
                     </div>

                     <!-- end tab 3 -->


                      
                        <!-- end tab 4 -->
                       
                        </div>
                        </div>
            
            </div>

             <!-- end container main -->
  </section>
  </div>