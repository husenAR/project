<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <center style="color:navy;">Jadwal Piket Guru<br></center>
        <!-- <center><small>Tahun Ajaran 2016-2017</small></center> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php">Dashboard</a></li>
      </ol>
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
              
              <li  class="active"><a href="#kelolajadwalpiket" data-toggle="tab" alt="test kursor">Kelola Jadwal Piket Guru</a></li>
              <li><a href="#jadwalpiket" data-toggle="tab">Lihat Jadwal Piket Guru</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane" id="jadwalpiket">
                <div class="box">
                  
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped tabelmapel">
                      <thead>
                        
                       <td>  </td>
                      <tr class="barishari">
                         <td class="tengah" rowspan="2">No. </td>
                         <td >Senin </td>
                         <td class="tengah">Selasa </td>
                         <td class="tengah">Rabu </td>
                         <td class="tengah">Kamis </td>
                         <td class="tengah">Jumat </td>
                         <td class="tengah">Sabtu </td>
                         <td class="tengah">Minggu </td>
                      </tr>
                      </thead>
                      <tbody>
                     
                      <tr>
                        <td class="fit">1</td>
                          <td>Ahmad</td>
                          <td> Udin</td>
                          <td> Rohman</td>
                          <td>  Zuki    </td>
                          <td> Sutardi</td>
                          <td>Sriyanto</td>
                          <td>Wahyu Widodo</td>
                         
                      </tr>

                       <tr>
                        <td class="fit">2</td>
                          <td>Ahmad</td>
                          <td> Udin</td>
                          <td></td>
                          <td> </td>
                          <td>  Zuki    </td>
                          
                          <td>Sriyanto</td>
                          <td>Wahyu Widodo</td>
                         
                      </tr>

                       <tr>
                        <td class="fit">3</td>
                          <td>Ahmad</td>
                          <td> Udin</td>
                          <td> Rohman</td>
                          <td>  Zuki    </td>
                          <td> Sutardi</td>
                          <td>Sriyanto</td>
                          <td>Wahyu Widodo</td>
                         
                      </tr>
                     
                      </tbody>

                    </table>
                    <!-- <a class="btnjdwl btn btn-default" href="<?php echo site_url('penjadwalan/kurikulum/printjadwalpiketguru/'.$id_tahun_ajaran); ?>" target="_blank"><i class="fa fa-print text-red "></i> Print</a> -->
                    <button class="btnjdwl btn btn-default" "><i class="fa fa-print text-red "></i> Print</button>
                  </div>
                  <!-- /.box-body -->
                </div>             
              </div>
              <!-- /.tab-pane -->

              <!-- /.tab-pane -->

              <!-- /.tab-pane -->
              <div class="active tab-pane" id="kelolajadwalpiket">
                <div class="box">
                 
                  <!-- /.box-header -->
                  <div class="box-body">
                    <form method="post" >
                    <table class="table table-bordered table-striped tabelmapel">
                      <thead>
                        
                        <!-- <input type="text" name="id_tahun_ajaran" placeholder="periode"> -->
                      <tr class="barishari">
                         <td class="tengah" rowspan="2">No. </td>
                         <td >Senin </td>
                         <td>Selasa
                         </td>
                         <td >Rabu
                         </td>
                         <td >Kamis
                         </td>
                         <td>Jumat
                         </td>
                         <td >Sabtu
                         </td>
                         <td >Minggu
                        </td>
                      </tr>
                      </thead>
                      <tbody>
                        <?php
                        for ($i=1;$i<=7;$i++) {
                        ?>
                      <tr>
                        <td class="fit"><?php echo $i; ?></td>
                         <td>
                          <select class="kodepiket" name="NIP_senin<?php echo $i; ?>">
                            <option value="">...</option>
                              <?php
                            foreach ($tabel_pegawai as $row_pegawai) {
                            ?>
                            <option value="<?php echo $row_pegawai->NIP; ?>" <?php if ($row_pegawai->NIP == @$tabel_jadwalpiketguru_senin[$i-1]->NIP) { echo " selected"; } ?>><!-- <?php echo $row_pegawai->kode_guru; ?>.  --><?php echo $row_pegawai->nama_panggilan; ?></option>
                            <?php
                            }
                            ?>
                            </select>
                         </td>
                         <td>
                          <select class="kodepiket" name="NIP_selasa<?php echo $i; ?>">
                              <option value="">...</option>
                              <?php
                            foreach ($tabel_pegawai as $row_pegawai) {
                            ?>
                            <option value="<?php echo $row_pegawai->NIP; ?>" <?php if ($row_pegawai->NIP == @$tabel_jadwalpiketguru_selasa[$i-1]->NIP) { echo " selected"; } ?>><!-- ?php echo $row_pegawai->kode_guru; ?>.  --><?php echo $row_pegawai->nama_panggilan; ?></option>
                            <?php
                            }
                            ?>
                            </select>
                         </td>
                          <td>
                          <select class="kodepiket" name="NIP_rabu<?php echo $i; ?>">
                            <option value="">...</option>
                              <?php
                            foreach ($tabel_pegawai as $row_pegawai) {
                            ?>

                            <option value="<?php echo $row_pegawai->NIP; ?>"  <?php if ($row_pegawai->NIP == @$tabel_jadwalpiketguru_rabu[$i-1]->NIP) { echo " selected"; } ?>><!-- <?php echo $row_pegawai->kode_guru; ?>.  --><?php echo $row_pegawai->nama_panggilan; ?></option>
                            <?php
                            }
                            ?>
                            </select>
                         </td>
                          <td>
                         <select class="kodepiket" name="NIP_kamis<?php echo $i; ?>">
                          <option value="">...</option>
                              <?php
                            foreach ($tabel_pegawai as $row_pegawai) {
                            ?>
                            <option value="<?php echo $row_pegawai->NIP; ?>"  <?php if ($row_pegawai->NIP == @$tabel_jadwalpiketguru_kamis[$i-1]->NIP) { echo " selected"; } ?>><!-- <?php echo $row_pegawai->kode_guru; ?>.  --><?php echo $row_pegawai->nama_panggilan; ?></option>
                            <?php
                            }
                            ?>
                            </select>
                         </td>
                         <td>
                          <select class="kodepiket" name="NIP_jumat<?php echo $i; ?>">
                            <option value="">...</option>
                              <?php
                            foreach ($tabel_pegawai as $row_pegawai) {
                            ?>
                            <option value="<?php echo $row_pegawai->NIP; ?>"  <?php if ($row_pegawai->NIP == @$tabel_jadwalpiketguru_jumat[$i-1]->NIP) { echo " selected"; } ?>><!-- <?php echo $row_pegawai->kode_guru; ?>.  --><?php echo $row_pegawai->nama_panggilan; ?></option>
                            <?php
                            }
                            ?>
                            </select>
                         </td>
                          <td>
                          <select class="kodepiket" name="NIP_sabtu<?php echo $i; ?>">
                            <option value="">...</option>
                              <?php
                            foreach ($tabel_pegawai as $row_pegawai) {
                            ?>
                            <option value="<?php echo $row_pegawai->NIP; ?>"  <?php if ($row_pegawai->NIP == @$tabel_jadwalpiketguru_sabtu[$i-1]->NIP) { echo " selected"; } ?>><!-- <?php echo $row_pegawai->kode_guru; ?>.  --><?php echo $row_pegawai->nama_panggilan; ?></option>
                            <?php
                            }
                            ?>
                            </select>
                         </td>
                          <td>
                          <select class="kodepiket" name="NIP_minggu<?php echo $i; ?>">
                            <option value="">...</option>
                              <?php
                            foreach ($tabel_pegawai as $row_pegawai) {
                            ?>
                            <option value="<?php echo $row_pegawai->NIP; ?>"  <?php if ($row_pegawai->NIP == @$tabel_jadwalpiketguru_minggu[$i-1]->NIP) { echo " selected"; } ?>><!-- <?php echo $row_pegawai->kode_guru; ?>.  --><?php echo $row_pegawai->nama_panggilan; ?></option>
                            <?php
                            }
                            ?>
                            </select>
                         </td>
                      </tr>
                       <?php
                        }
                       ?>
                      
                      </tbody>

                    </table>
                    <button class="btn btn-danger" type="submit">Submit</button>
                    </form>
                  </div>
                  <!-- /.box-body -->
                </div> 
              </div>


            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row (main row) -->
      <!-- modal -->
     

      
    </section>
    <!-- /.content -->
  </div>