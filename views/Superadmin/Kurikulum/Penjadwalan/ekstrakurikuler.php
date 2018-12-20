
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
 <section class="content-header">
    <h1>
      <center style="color:navy;">Jadwal Ekstrakurikuler<br></center>
      <!--  <center><small>Tahun Ajaran 2016-2017 Kurikulum 2013</small></center> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="dashboard.php">Dashboard</a></li>
    </ol>
  </section>





  <section class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#dataekskul" data-toggle="tab"><?php if (@$edit_jadwalekskul) { echo "Edit"; } else { echo "Tambah"; } ?> Jadwal Ekskul</a></li>
           <li><a href="#dataekstrakurikuler" data-toggle="tab">Data Ekskul </a></li>
            
          </ul>
          
          <div class="tab-content">
           <div class="tab-pane" id="dataekstrakurikuler">
             <div class="box">
              <br>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <td class="fit">No. </td>
                     <td>Hari </td>
                     <td>Jam Mulai </td>
                     <td>Jam Selesai </td>
                     <td>Jenis Ekstrakurikuler </td>
                     <td>Tempat </td>
                     <td>Pembimbing </td>
                     <td>Action </td>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i=0;
                  foreach ($tabel_jadwalekskul as $row_jadwalekskul) {
                    $i++;
                    ?>
                    <tr>
                      <td class="fit"><?php echo $i; ?></td>
                      <td><?php echo $row_jadwalekskul->hari; ?></td>
                      <td><?php echo substr($row_jadwalekskul->jam_mulai, 0, 5); ?></td>
                      <td><?php echo substr($row_jadwalekskul->jam_selesai, 0, 5); ?></td>
                      <td><?php echo $row_jadwalekskul->jenis_kls_tambahan; ?></td>
                      <td><?php echo $row_jadwalekskul->tempat; ?></td>
                      <td><?php echo $row_jadwalekskul->nama_pembimbing; ?></td>
                      <td> 
                        <a class="btn btn-block btn-primary button-action btnedit" href="<?php echo site_url('superadmin/ekstrakurikuler/'.$row_jadwalekskul->id_jadwal_ekskul); ?>" > Edit </a>
                        <a onclick="return confirm('Apakah Anda yakin?')" class="btn btn-danger btn-primary button-action btnhapus" href="<?php echo site_url('superadmin/hapusjadwalekskul/'.$row_jadwalekskul->id_jadwal_ekskul); ?>" > Hapus </a>
                      </td>               
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
              </table>
          </div>
        </div>


        <!-- /.tab-pane -->


          <div class="active tab-pane" id="dataekskul">
               <form method="post" action="<?php echo site_url('superadmin/simpanjadwalekskul'); ?>">
              <input type="hidden" name="id_jadwal_ekskul" value="<?php echo @$edit_jadwalekskul->id_jadwal_ekskul; ?>">
              <table id="example1" class="table table-bordered table-striped tabelmapel">

                <tbody>

                  <tr>
                    <tr>
                       <td>Hari </td>
                       <td>
                       <select required="required" name="hari" value="<?php echo $row_jadwalekskul->hari; ?>">
                        <option value="">Pilih Hari</option>
                        <option value="Senin" <?php if (isset($row_jadwalekskul->hari) && $row_jadwalekskul->hari=="Senin") echo "selected";?>> Senin </option>
                        <option value="Selasa" <?php if (isset($row_jadwalekskul->hari) && $row_jadwalekskul->hari=="Selasa") echo "selected";?>> Selasa </option>
                        <option value="Rabu" <?php if (isset($row_jadwalekskul->hari) && $row_jadwalekskul->hari=="Rabu") echo "selected";?>> Rabu </option>
                        <option value="Kamis" <?php if (isset($row_jadwalekskul->hari) && $row_jadwalekskul->hari=="Kamis") echo "selected";?>> Kamis </option>
                        <option value="Jumat" <?php if (isset($row_jadwalekskul->hari) && $row_jadwalekskul->hari=="Jumat") echo "selected";?>> Jumat</option>
                        <option value="Sabtu" <?php if (isset($row_jadwalekskul->hari) && $row_jadwalekskul->hari=="Sabtu") echo "selected";?>> Sabtu </option>
                        <option value="Minggu" <?php if (isset($row_jadwalekskul->hari) && $row_jadwalekskul->hari=="Minggu") echo "selected";?>> Minggu </option>
                      </select> <!-- <input type="text" name="hari" placeholder="hari" value="<?php echo @$edit_jadwalekskul->hari; ?>"> --> </td>
                    </tr>

                    <tr>
                       <td>Jam Mulai </td>
                       <td><input type="time" name="jam_mulai" placeholder="Waktu" value="<?php echo @$edit_jadwalekskul->jam_mulai; ?>"> </td>
                    </tr>
                    <tr>
                       <td>Jam Selesai </td>
                       <td><input type="time" name="jam_selesai" placeholder="Waktu" value="<?php echo @$edit_jadwalekskul->jam_selesai; ?>"> </td>
                    </tr>

                    <tr>
                       <td>Jenis Ekstrakurikuler </td>
                       <td>
                        <select class="ekskul" name="id_jenis_kls_tambahan" id="kelas1" onchange="fetch_select_ekskul(this.value, 'ekskul1');">
                          <option value="">Pilih Ekskul</option>
                          <?php
                          foreach ($tabel_jenisklstambahan as $row_jenisklstambahan) {
                            ?>
                            <option value="<?php echo $row_jenisklstambahan->id_jenis_kls_tambahan; ?>" <?php if (@$edit_jadwalekskul->id_jenis_kls_tambahan == $row_jenisklstambahan->id_jenis_kls_tambahan) { echo " selected"; } ?>><?php echo $row_jenisklstambahan->jenis_kls_tambahan; ?></option>
                            <?php
                          }
                          ?>
                        </select>
                       </td>
                    </tr>


                  </tr>
                  <tr>
                     <td>Tempat </td>
                     <td><input type="text" name="tempat" placeholder="tempat" value="<?php echo @$edit_jadwalekskul->tempat; ?>">
                     </td>

                  </tr>
                  <tr>
                     <td>Pembimbing </td>
                     <td>
                      <select class="Pembimbing" name="id_pembimbing">
                        <option value="">Pilih Pembimbing</option>
                        <?php
                        foreach ($tabel_pembimbing as $row_pembimbing) {
                          ?>
                          <option value="<?php echo $row_pembimbing->id_pembimbing; ?>"  <?php if (@$edit_jadwalekskul->id_pembimbing == $row_pembimbing->id_pembimbing) { echo " selected"; } ?>><?php echo $row_pembimbing->nama_pembimbing; ?></option>
                          <?php
                        }
                        ?>
                      </select>
                     </td>

                  </tr>

                </tbody>

              </table>
              <button class="btn btn-danger" type="submit">Submit</button>
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
<!-- /modal -->

</section>
<!-- /.content -->
</div>