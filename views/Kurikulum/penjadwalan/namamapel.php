<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <center style="color:navy;">Halaman Kelola Mata Pelajaran<br></center>
      <center><small>Tahun Ajaran 2016-2017 Kurikulum 2013</small></center>
    </h1>
    <ol class="breadcrumb">
      <li><a href="dashboard.php">Dashboard</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row" >
      <div class="col-md-12">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#datakelolamapel" data-toggle="tab"><?php if (@$edit_mapel) { echo "Edit"; } else { echo "Tambah"; } ?> Mata Pelajaran </a></li>
            <li><a href="#datanamamapel" data-toggle="tab">Data Mata Pelajaran </a></li>
          </ul>


          <div class="tab-content">
            <div class="active tab-pane" id="datakelolamapel">
             <form id="formmapel" style="display:block;" class="form-horizontal formmapel" method="post" action="<?php echo site_url('kurikulum/simpannamamapel'); ?>">
             <input type="hidden" name="id_namamapel" id="id_namamapel"  value="<?php echo @$edit_mapel->id_namamapel; ?>"/>
              <div class="bigbox-mapel"> 
                <div class="box-mapel">
                  <div class="form-group formgrup jarakform">
                    <label for="inputKurikulum" class="col-sm-2 control-label">Nama Mata Pelajaran</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Mata Pelajaran" value="<?php echo @$edit_mapel->nama; ?>">
                    </div>
                  </div>
                </div>
              </div>
          
                 <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
            <!-- /.tab-pane -->

            <!-- /.tab-pane -->

            <div class="tab-pane" id="datanamamapel">
              <!-- DATA MAPEL KELAS 7 -->
              <div class="box">
                <div class="box-header" style="background-color:     #5c8a8a">
                  <h3 class="box-title" style="color:white">Data Mata Pelajaran</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="fit">No</th>
                        <th>Mata Pelajaran</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      // $i=0;
                      // $nama_mapel = "";
                      // $kkm = "";
                      // $jam_belajar = "";
                      // $jenjang = "";
                      // foreach ($tabel_mapel as $row_mapel) {
                      //   if (($nama_mapel != $row_mapel->nama_mapel) || ($kkm != $row_mapel->kkm) || ($jam_belajar != $row_mapel->jam_belajar) || ($jenjang != $row_mapel->jenjang)) {

                      //   $i++; 
                        ?>
                        <?php
                        $i=0;
                        foreach ($tabel_namamapel as $row_namamapel) {
                          $i++; 
                      ?>
                        <tr>
                          <td class="fit"><?php echo $i; ?></td>
                          <td><?php echo $row_namamapel->nama; ?></td>
                          <td> 
                            <a class="btn btn-block btn-primary button-action btnedit" href="<?php echo site_url('kurikulum/namamapel/'.$row_namamapel->id_namamapel); ?>" > Edit </a>
                            <a class="btn btn-danger btn-primary button-action btnhapus" href="<?php echo site_url('kurikulum/hapusnamamapel/'.$row_namamapel->id_namamapel); ?>" > Hapus </a>
                          </td>               
                        </tr>
                      <?php
                      //     $nama_mapel = $row_mapel->nama_mapel;
                      //     $kkm = $row_mapel->kkm;
                      //     $jam_belajar = $row_mapel->jam_belajar;
                      //     $jenjang = $row_mapel->jenjang;
                      //   }
                      // }
                      ?> 
                      <?php
                      }
                      ?>
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

            <!-- /.tab-pane -->

          </div>
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
  </div>
</section>
<!-- /.content -->
</div>
  <!-- /.content-wrapper -->