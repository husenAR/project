<script type="text/javascript">
  function fetch_select_mapel(val, cmb)
  {
   $('#'+cmb).html('<option value="">Please Wait ... </option>');
   $.ajax({
     type: 'post',
     url: '<?php echo site_url('penjadwalan/kurikulum/getmapelkelastambahan'); ?>',
     //data: 'nama=' + jsnama + '&instansi=' + jsinstansi + '&hp=' + jshp  + '&email=' + jsemail,
     data: {
       id:val
     },
     success: function (response) {
       document.getElementById('#'+cmb).innerHTML=response; 
     }
   });
 } 
</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <center style="color:navy;">Jadwal Tambahan<br></center>
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

            <li class="active"><a href="#kelolajadwaltambahan" data-toggle="tab"><?php if (@$edit_jadwaltambahan) { echo "Edit"; } else { echo "Tambah"; } ?> Jadwal Tambahan</a></li>
            <li><a href="#datajadwaltambahan" data-toggle="tab">Data Jadwal Tambahan</a></li>
              <!-- <li ><a href="#jadwaltambahan" data-toggle="tab">Jadwal Tambahan</a></li>
              -->
            </ul>
            <div class="tab-content">
             
              

              <!-- /.tab-pane -->

              <div class="active tab-pane" id="kelolajadwaltambahan">
                <div class="box">


                  <!-- /.box-header -->
                  <div class="box-body">
                    <form method="post" action="<?php echo site_url('superadmin/simpanjadwaltambahan'); ?>">
                      <input type="hidden" name="id_jadwal_tambahan" value="<?php echo @$edit_jadwaltambahan->id_jadwal_tambahan; ?>">
                      <table id="example1" class="table table-bordered table-striped tabelmapel">

                        <tbody>

                          <tr>
                            <tr>
                               <td>Tanggal </td>
                               <td><input type="date" name="tgl_tambahan" placeholder="Tanggal pelaksaan les" value="<?php echo @$edit_jadwaltambahan->tgl_tambahan; ?>"> </td>
                            </tr>

                            <tr>
                               <td>Kelas </td>
                               <td>
                                <select class="kodeguru" name="id_kelas_tambahan" id="kelas1" onchange="fetch_select_mapel(this.value, 'mapel1');">
                                  <option value="">Pilih Kelas</option>
                                  <?php
                                  foreach ($tabel_kelastambahan as $row_kelastambahan) {
                                    ?>
                                    <option value="<?php echo $row_kelastambahan->id_kelas_tambahan; ?>" <?php if (@$edit_jadwaltambahan->id_kelas_tambahan == $row_kelastambahan->id_kelas_tambahan) { echo " selected"; } ?>><?php echo $row_kelastambahan->kelas_tambahan; ?></option>
                                    <?php
                                  }
                                  ?>
                                </select>
                               </td>
                            </tr>


                          </tr>
                          <tr>
                             <td>Mata Pelajaran </td>
                             <td>
                             <select class="kodemapel" name="id_namamapel">
                              <option value="">Pilih Mapel</option>
                              <?php
                              foreach ($tabel_namamapel as $row_namamapel) {
                                ?>
                                <option value="<?php echo $row_namamapel->id_namamapel; ?>" <?php if (@$edit_jadwaltambahan->id_namamapel == $row_namamapel->id_namamapel) { echo " selected"; } ?>><?php echo $row_namamapel->nama; ?></option>
                                <?php
                              }
                              ?>
                            </select>
                           </td>

                        </tr>
                        <tr>
                           <td>Guru </td>
                           <td>
                            <select class="kodeguru" name="NIP">
                              <option value="">Pilih Guru</option>
                              <?php
                              foreach ($tabel_pegawai as $row_pegawai) {
                                ?>
                                <option value="<?php echo $row_pegawai->NIP; ?>"  <?php if (@$edit_jadwaltambahan->NIP == $row_pegawai->NIP) { echo " selected"; } ?>><?php echo $row_pegawai->kode_guru; ?>. <?php echo $row_pegawai->nama_panggilan; ?></option>
                                <?php
                              }
                              ?>
                            </select>
                           </td>

                        </tr>
                        <tr>
                           <td>Jam Mulai </td>
                           <td><input type="time" name="jam_mulai" placeholder="Waktu" value="<?php echo @$edit_jadwaltambahan->jam_mulai; ?>"> </td>
                        </tr>
                        <tr>
                           <td>Jam Selesai </td>
                           <td><input type="time" name="jam_selesai" placeholder="Waktu" value="<?php echo @$edit_jadwaltambahan->jam_selesai; ?>"> </td>
                        </tr>
                      </tbody>

                    </table>
                    <button class="btn btn-danger" type="submit">Submit</button>
                  </form>
                </div>
              </div>
            </div>

            <!-- DATA MAPEL KELAS 7 -->
            <div> <?php echo $this->session->flashdata('warning') ?></div>
            <div class="tab-pane" id="datajadwaltambahan">
              <div class="box">
                <div class="box-header" style="background-color:     #5c8a8a">
                  <h3 class="box-title" style="color:white">Data Jadwal Tambahan </h3>
                </div>
                <!-- /.box-header -->

                <?php
                  function tgl_indo($tanggal) {
                    $tgl = substr($tanggal, 8, 2);
                    $bln = substr($tanggal, 5, 2);
                    $thn = substr($tanggal, 0, 4);
                    if ($bln == "1") { $bulan = "Januari"; } 
                    if ($bln == "2") { $bulan = "Februari"; } 
                    if ($bln == "3") { $bulan = "Maret"; } 
                    if ($bln == "4") { $bulan = "April"; } 
                    if ($bln == "5") { $bulan = "Mei"; } 
                    if ($bln == "6") { $bulan = "Juni"; } 
                    if ($bln == "7") { $bulan = "Juli"; } 
                    if ($bln == "8") { $bulan = "Agustus"; } 
                    if ($bln == "9") { $bulan = "September"; } 
                    if ($bln == "10") { $bulan = "Oktober"; } 
                    if ($bln == "11") { $bulan = "November"; } 
                    if ($bln == "12") { $bulan = "Desember"; } 
                    return $tgl." ".$bulan." ".$thn;
                  }
                ?>
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <td class="fit">No </td>
                         <td>Tanggal </td>
                         <td>Kelas </td>
                         <td>Mata Pelajaran </td>
                         <td>Guru </td>
                         <td>Jam Mulai </td>
                         <td>Jam Selesai </td>
                         <td>Action </td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i=0;
                      foreach ($tabel_jadwaltambahan as $row_jadwaltambahan) {
                        $i++; 
                        ?>
                        <tr>
                          <td class="fit"><?php echo $i; ?></td>
                           <td><?php echo tgl_indo($row_jadwaltambahan->tgl_tambahan); ?> </td>
                           <td><?php echo $row_jadwaltambahan->kelas_tambahan; ?> </td>
                           <td><?php echo $row_jadwaltambahan->nama; ?> </td>
                           <td><?php echo $row_jadwaltambahan->Nama; ?> </td>
                           <td><?php echo substr($row_jadwaltambahan->jam_mulai, 0, 5); ?> </td>
                           <td><?php echo substr($row_jadwaltambahan->jam_selesai, 0, 5); ?> </td>
                          <td> 
                            <a class="btn btn-block btn-primary button-action btnedit" href="<?php echo site_url('superadmin/jadwaltambahan/'.$row_jadwaltambahan->id_jadwal_tambahan); ?>" > Edit </a>
                            <a onclick="return confirm('Apakah Anda yakin?')" class="btn btn-danger btn-primary button-action btnhapus" href="<?php echo site_url('superadmin/hapusjadwaltambahan/'.$row_jadwaltambahan->id_jadwal_tambahan); ?>" > Hapus </a>
                          </td>               
                        </tr>
                        <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.box-body -->
              </div> 
            </div>


            <!-- /.tab-pane -->

            <!-- /.tab-pane -->
            <div class="tab-pane" id="editjadwaltambahan">
              <div class="box">


                <!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped tabelmapel">
                    <thead>
                      <!-- <tr class="barishari">
                        <th class="tengah" rowspan="2">Keterangan </td>
                        <th class="tengah" colspan="4"><select>
                             <option>Desember</option>
                             <option>Januari</option>
                             <option>Februari</option>
                             <option>Maret</option>
                             <option>April</option> 
                             <option>Mei</option>
                            </select> </td>
                          </tr> -->
                          <tr class="barishari">
                            <th class="tengah"><input type="date" placeholder="Tanggal pelaksanaan les"> </td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                             <td>Kelas </td>
                             <td><select class="kodeguru">
                             <option>9A</option>
                             <option>9B</option>
                             <option>9C</option>
                             <option>9D</option>
                             <option>9E</option> 
                             <option>9F</option>
                           </select>
                          </td>
                       </tr>
                       <tr>
                         <td>Mata Pelajaran </td>
                         <td>
                         <select class="kodeguru">
                           <option>Matematika</option>
                           <option>Bhs Indonesia</option>
                           <option>IPA</option>
                           <option>IPS</option>
                           <option>Bhs. Inggris</option> 
                         </select>
                        </td>
                     </tr>
                     <tr>
                       <td>Guru </td>
                       <td>
                        <select class="kodeguru">
                         <option>4</option>
                         <option>17</option>
                         <option>14</option>
                         <option>20</option>
                         <option>10</option> 
                         <option>2</option>
                       </select>
                      </td>
                   </tr>
                   <tr>
                     <td>Jam Mulai </td>
                     <td><input type="time" placeholder="Waktu"> </td>
                  </tr>
                  <tr>
                     <td>Jam Selesai </td>
                     <td><input type="time" placeholder="Waktu"> </td> 
                  </tr>
                </tbody>

              </table>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <form class="posisikanan">
                    <td><button type="submit" class="btn btn-danger" href="#datajadwaltambahan" data-toggle="tab">Submit</button></td><td> <button class="btn btn-danger" href="#datajadwaltambahan" data-toggle="tab">Back</button></td>
                  </form>
                </div>
              </div>


            </div>
          </div>
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
  <!-- /.content-wrapper -->