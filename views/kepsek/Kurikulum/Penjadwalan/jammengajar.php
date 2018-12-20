<!-- Content Wrapper. Contains page content -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/penjadwalam/chosen/chosen.css">
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <center style="color:##993d00;">Pembagian Jam Mengajar<br></center>
      <!--  <center style="color:##993d00;"><h4>Tahun Ajaran 2016-2017 Kurikulum 2013</h4></center> -->

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
              <!-- <li class="active"><a href="#jammengajar" data-toggle="tab">Kelola Jam Mengajar Guru</a></li> -->
              <li><a href="#kelolajammengajar" data-toggle="tab" alt="test kursor">Data Jam Mengajar</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane" id="jammengajar">
                <div class="box">
                  <!-- /.box-header -->
                  <p style="color: #ff0000">> Pilih <b>Nama</b> guru, kemudian pilih <b>Mata Pelajaran</b> yang diampu dan isi <b>Jam Minim Mengajar</b><br>
                    > Kemudian <b>Submit</b></p>
                  <div class="box-body">
                    <div>
                      <!-- <div class="box-header jarakbox" style="padding-top: : 0px"> -->
                        <form method="post" action="<?php echo site_url('superadmin/simpanjammengajar'); ?>">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th rowspan="3"><center>No.</center></th>
                                <th rowspan="3"><center>Nama</center></th>
                                <th rowspan="3"><center>NIP</center></th>
                               <!--  <th rowspan="3">Kode Guru</th> -->
                                <th rowspan="3"><center>Golongan</center></th>
                                <th rowspan="3"><center>Jabatan Guru</center></th>
                                <th rowspan="3"><center>Ijazah</center></th>
                                <th rowspan="3"><center>Mata pelajaran</center></th>
                                <th rowspan="3"><center>Jam Minim Mengajar</center></th>
                                <!-- <th rowspan="3"><center>Jumlah jam</center></th> -->
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
                                  <!-- <td><span id="kode_text<?php echo $i; ?>">-</span><?php //echo $row_pegawai->kode_guru; ?></td> -->
                                  <td><span id="Golongan_text<?php echo $i; ?>">-</span><?php //echo $row_pegawai->Golongan; ?></td>
                                  <td><span id="pangkat_text<?php echo $i; ?>">-</span><?php //echo $row_pegawai->jabatan; ?></td>
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
                                  <!-- <td><center>-</center></td> -->
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
                  <div> <?php echo $this->session->flashdata('warning') ?></div>
                  <div class="active tab-pane" id="kelolajammengajar">
                    <div class="box">

                      <!-- /.box-header -->
                      <div class="box-body">
                        <div>
                        <!-- <div class="box-header jarakbox" style="overflow: auto"> -->

                          <table id="example1" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th >No.</th>
                                <th >Nama</th>
                                <th >NIP</th>
                                <!-- <th >Kode Guru</th> -->
                                <th >Golongan</th>
                                <th >Jabatan Guru</th>
                                <th >Ijazah</th>
                                <th >Mata pelajaran</th>
                                <th >Jam Minim Mengajar</th>
                                <th ><center>Jumlah jam</center></th>
                                <th >Action</th>

                              </tr>
                            </thead>
                            <tbody>
                             
                                <tr>
                                  <td>1</td>
                                  <td>Ahmad</td>
                                  <td>123123</td>
                                  <!-- <td><?php echo $row_jammengajar->kode_guru; ?></td> -->
                                  <td>III/A</td>
                                  <td>Guru</td>
                                  <td>S2</td>
                                  <td>Bahasa Indonesia></td>
                                  <td>10</td>
                                  <td>98</td>
                                  <td>No Action Needed</td>

                                </tr>

                                <tr>
                                  <td>2</td>
                                  <td>Ahmad</td>
                                  <td>123123</td>
                                  <!-- <td><?php echo $row_jammengajar->kode_guru; ?></td> -->
                                  <td>III/A</td>
                                  <td>Guru</td>
                                  <td>S2</td>
                                  <td>Bahasa Indonesia></td>
                                  <td>10</td>
                                  <td>98</td>
                                  <td>No Action Needed</td>
                                </tr>

                                 <tr>
                                  <td>3</td>
                                  <td>Ahmad</td>
                                  <td>123123</td>
                                  <!-- <td><?php echo $row_jammengajar->kode_guru; ?></td> -->
                                  <td>III/A</td>
                                  <td>Guru</td>
                                  <td>S2</td>
                                  <td>Bahasa Indonesia></td>
                                  <td>10</td>
                                  <td>98</td>
                                  <td>No Action Needed</td>

                                </tr>

                                 <tr>
                                  <td>4</td>
                                  <td>Ahmad</td>
                                  <td>123123</td>
                                  <!-- <td><?php echo $row_jammengajar->kode_guru; ?></td> -->
                                  <td>III/A</td>
                                  <td>Guru</td>
                                  <td>S2</td>
                                  <td>Bahasa Indonesia></td>
                                  <td>10</td>
                                  <td>98</td>
                                 <td>No Action Needed</td>

                                </tr>
                                
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
                      url: '<?php echo site_url('penjadwalan/kurikulum/getinfoguru'); ?>/'+document.getElementById('NIP'+nomor).value,
                      dataType: 'json',
                      cache: false,
                      success: function(msg){
                //alert('ok');
                for(i=0;i<msg.data.length;i++){
                              // alert(msg.data[i].NIP + ' ' + msg.data[i].Nama);
                              document.getElementById('NIP_text'+nomor).innerHTML = msg.data[i].NIP;
                              // document.getElementById('kode_text'+nomor).innerHTML = msg.data[i].kode_guru;
                              document.getElementById('Golongan_text'+nomor).innerHTML = msg.data[i].Golongan;
                              document.getElementById('pangkat_text'+nomor).innerHTML = msg.data[i].pangkat;
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