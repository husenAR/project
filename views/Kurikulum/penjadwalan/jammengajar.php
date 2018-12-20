<!-- Content Wrapper. Contains page content -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/chosen/chosen.css">
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <center style="color:##993d00;">Pembagian Jam Mengajar SMP Yogyakarta <br></center>
      <center style="color:##993d00;"><h4>Tahun Ajaran 2016-2017 Kurikulum 2013</h4></center>

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
              <li class="active"><a href="#jammengajar" data-toggle="tab">Kelola Jam Mengajar Guru</a></li>
              <li><a href="#kelolajammengajar" data-toggle="tab" alt="test kursor">Data Jam Mengajar</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="jammengajar">
                <div class="box">
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="box-header jarakbox" style="overflow: auto">
                      <form method="post" action="<?php echo site_url('kurikulum/simpanjammengajar'); ?>">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th rowspan="3">No.</th>
                            <th rowspan="3">Nama</th>
                            <th rowspan="3">NIP</th>
                            <th rowspan="3">Kode Guru</th>
                            <th rowspan="3">Golongan</th>
                            <th rowspan="3">Jabatan Guru</th>
                            <th rowspan="3">Ijazah</th>
                            <th rowspan="3">Mata pelajaran</th>
                            <th rowspan="3">Jumlah Minim Mengajar</th>
                            <th rowspan="3"><center>Jumlah jam</center></th>
                          </tr>
                        </thead>
                        <tbody  style="text-align: center; padding-bottom: 5px">
                        <?php
                            for ($i=1;$i<=10;$i++) {
                        ?>
                          <tr>
                            <td class="fit"><?php echo $i; ?></td>
                              <!-- <input type="text" name="No" value="<?php echo $i; ?>" style="width: 10%"> -->
                            <td><select class="chosen" name="NIP<?php echo $i; ?>" id="NIP<?php echo $i; ?>" onchange="getinfoguru(<?php echo $i; ?>);">
                                <option value="">...</option>
                            <?php
                            foreach ($tabel_pegawai as $row_pegawai) {
                            ?>
                            <option value="<?php echo $row_pegawai->NIP; ?>"><?php echo $row_pegawai->Nama; ?></option>
                            <?php
                            }
                            ?>
                            </select></td>

                            <td><span id="NIP_text<?php echo $i; ?>">-</span><?php //echo $row_pegawai->NIP; ?></td>
                            <td><span id="kode_text<?php echo $i; ?>">-</span><?php //echo $row_pegawai->kode_guru; ?></td>
                            <td><span id="Golongan_text<?php echo $i; ?>">-</span><?php //echo $row_pegawai->Golongan; ?></td>
                            <td><span id="jabatan_text<?php echo $i; ?>">-</span><?php //echo $row_pegawai->jabatan; ?></td>
                            <td><span id="Pendidikan_text<?php echo $i; ?>">-</span><?php //echo $row_pegawai->Pendidikan; ?></td>
                            <td>
                              <select class="kodemapel" name="id_namamapel<?php echo $i; ?>">
                                <option value="">...</option>
                              <?php
                            foreach ($tabel_namamapel as $row_namamapel) {
                            ?>
                            <option value="<?php echo $row_namamapel->id_namamapel; ?>"><?php echo $row_namamapel->nama; ?></option>
                            <?php
                            }
                            ?>
                            </select>
                            </td>
                            <td><input type="text" name="jatah_minim_mgjr<?php echo $i; ?>"></td>
                                <td><center>26</center></td>
                              </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                          </table>
                        </div>

                      </div>
                      <button class=" btn btn-danger" type="submit">Submit</button>
                      <!-- /.box-body -->
                    </div>

                  </div>
                  <!-- /.tab-pane -->
                  

                  <!-- /.tab-pane -->

                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="kelolajammengajar">
                    <div class="box">

                      <!-- /.box-header -->
                      <div class="box-body">
                        <div class="box-header jarakbox" style="overflow: auto">

                          <table class="table table-bordered">
                            <thead>
                              <tr>
                            <th rowspan="3">No.</th>
                            <th rowspan="3">Nama</th>
                            <th rowspan="3">NIP</th>
                            <th rowspan="3">Kode Guru</th>
                            <th rowspan="3">Golongan</th>
                            <th rowspan="3">Jabatan Guru</th>
                            <th rowspan="3">Ijazah</th>
                            <th rowspan="3">Mata pelajaran</th>
                            <th rowspan="3">Jumlah Minim Mengajar</th>
                            <th rowspan="3"><center>Jumlah jam</center></th>
                            <th rowspan="3">Action</th>
                          
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $i=0;
                              foreach ($tabel_jammengajar as $row_jammengajar) {
                                $i++;
                              ?>
                              <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row_jammengajar->Nama; ?></td>
                                <td><?php echo $row_jammengajar->NIP; ?></td>
                                <td><?php echo $row_jammengajar->kode_guru; ?></td>
                                <td><?php echo $row_jammengajar->Golongan; ?></td>
                                <td><?php echo $row_jammengajar->jabatan; ?></td>
                                <td><?php echo $row_jammengajar->Pendidikan; ?></td>
                                <td><?php echo $row_jammengajar->nama; ?></td>
                                <td><?php echo $row_jammengajar->jatah_minim_mgjr; ?></td>
                                <td><?php echo $row_jammengajar->jml_jam_mgjr; ?></td>
                                <td><a href="<?php echo site_url('/kurikulum/hapusjammengajar/'.$row_jammengajar->id_jam_mgjr); ?>" class="btn btn-danger">Hapus</a></td>

                              </tr>
                              <?php
                              }
                              ?>
                            </tbody>
                          </table>
                        </div>

                  </div>                   
                  <button class=" btn btnjdwl">Print</button>                   <!-- /.box-body -->
                  
                </div>

              </div>
              <!-- /.tab-pane -->


              <!-- /.tab-pane -->

              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
            <script type="text/javascript">
                  $(".chosen").chosen()
            </script>
            <script type="text/javascript">
              function getinfoguru(nomor) {
                $.ajax({
                  url: '<?php echo site_url('/kurikulum/getinfoguru'); ?>/'+document.getElementById('NIP'+nomor).value,
                  dataType: 'json',
                  cache: false,
                  success: function(msg){
                //alert('ok');
                           for(i=0;i<msg.data.length;i++){
                              // alert(msg.data[i].NIP + ' ' + msg.data[i].Nama);
                               document.getElementById('NIP_text'+nomor).innerHTML = msg.data[i].NIP;
                               document.getElementById('kode_text'+nomor).innerHTML = msg.data[i].kode_guru;
                               document.getElementById('Golongan_text'+nomor).innerHTML = msg.data[i].Golongan;
                               document.getElementById('jabatan_text'+nomor).innerHTML = msg.data[i].jabatan;
                               document.getElementById('Pendidikan_text'+nomor).innerHTML = msg.data[i].Pendidikan;
                               
                      // var latLng = new google.maps.LatLng(msg.listrik[i].latitude, msg.listrik[i].longitude);
                      // var marker = new google.maps.Marker({
                      //   position: latLng,
                      //   title: msg.listrik[i].nomor_pelanggan,
                      //   map: map,
                      //   draggable: true
                      // });
                      
                      // var html =
                      //   '<b>' + msg.listrik[i].nomor_pelanggan + '</b> <br/><br>'+ 
                      // '<table style="font-size:11px; border-collapse:collapse;" border="0">'+
                      //         '<tr><td valign="top">Nomor Pelanggan :</td><td>' +msg.listrik[i].nomor_pelanggan+  '</td></tr>'+
                      // '<tr><td valign="top">Nama :</td><td>' +msg.listrik[i].nama_pelapor+  '</td></tr>'+
                      // '<tr><td valign="top">Lokasi Kejadian :</td><td>' +msg.listrik[i].lokasi_kejadian+  '</td></tr>'+
                      // '<tr><td valign="top">Jenis Gangguan :</td><td>' +msg.listrik[i].jenis_gangguan+  '</td></tr>'+
                      // '<tr><td valign="top">Posisi&nbsp;(lintang/bujur):</td><td>'+msg.listrik[i].latitude+'/'+msg.listrik[i].longitude+'</td></tr>'+
                      // '</table>'  ;
                      
                      // setWindow(marker, html);
                      // //tidak bisa disini karena marker yang akan tampil hanya marker terakhir
                      // //google.maps.event.addListener(marker, 'click', function() {
                      // //  infoWindow.setContent(html);
                      // //  infoWindow.open(map, marker);
                      // //});
                      }
                  }
              });
              }

              //getinfoguru('13523004');
            </script>