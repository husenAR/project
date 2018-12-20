<!-- Content Wrapper. Contains page content -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/penjadwalam/chosen/chosen.css">
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <center style="color:navy;">Jadwal Mata Pelajaran<br></center>
      <center><small>Tahun Ajaran 2016-2017</small></center>
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

            <li  class="active"><a href="#jadwalprioritas" data-toggle="tab" alt="test kursor">Jadwal Prioritas</a></li>
            <li><a href="#jadwalkhusus" data-toggle="tab">Jadwal Khusus</a></li>
            <li><a href="#kelolajadwalmapel" data-toggle="tab">Kelola Jadwal Mata Pelajaran</a></li>
            <li><a href="#jadwalmapel" data-toggle="tab">Jadwal Mata Pelajaran</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane" id="jadwalmapel">
              <div class="box">
                <div class="box-header">
                  <form>
                    <select>
                      <option> KELAS 7</option>
                      <option> KELAS 8</option>
                      <option> KELAS 9</option>
                    </select>
                  </form>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered table-striped tabelmapel">
                    <thead>
                      <tr class="barishari">
                        <th class="tengah" rowspan="2">Jam ke</th>
                        <th class="tengah" rowspan="2">Waktu</th>
                        <th colspan="6">Senin</th>
                      </tr>
                      <tr class="bariskelas">
                        <th>7A</th>
                        <th>7B</th>
                        <th>7C</th>
                        <th>7D</th>
                        <th>7E</th>
                        <th>7F</th>

                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="fit">0</td>
                        <th>06.00 - 07.00</th>
                        <th class="ungu">3</th>
                        <th class="ungu">4</th>
                        <th class="ungu">5</th>
                        <th class="merah">12</th>
                        <th class="hijau">10</th>
                        <th class="kuning">23</th>
                      </tr>
                      <tr>
                        <td class="fit">1</td>
                        <th>08.00 - 09.00</th>
                        <th class="ungu">3</th>
                        <th class="ungu">4</th>
                        <th class="ungu">5</th>
                        <th class="merah">12</th>
                        <th class="hijau">10</th>
                        <th class="kuning">23</th>
                      </tr>
                      <tr>
                        <td class="fit">2</td>
                        <th>09.00 - 10.00</th>
                        <th class="hijau">17</th>
                        <th class="ungu">7</th>
                        <th class="kuning">9</th>
                        <th class="merah">21</th>
                        <th class="kuning">12</th>
                        <th class="ungu">20</th>
                        
                      </tr>
                      <tr>
                        <td class="fit">3</td>
                        <th>10.00 - 12.00</th>
                        <th class="hijau">17</th>
                        <th class="ungu">7</th>
                        <th class="kuning">9</th>
                        <th class="merah">21</th>
                        <th class="kuning">12</th>
                        <th class="ungu">20</th>
                        
                      </tr>

                    </tbody>

                  </table>
                  <br>
                  <table class="table table-bordered table-striped tabelmapel">
                    <thead>
                      <tr class="barishari">
                        <th class="tengah" rowspan="2">Jam ke</th>
                        <th class="tengah" rowspan="2">Waktu</th>
                        <th colspan="6">Selasa</th>
                      </tr>
                      <tr class="bariskelas">
                        <th>7A</th>
                        <th>7B</th>
                        <th>7C</th>
                        <th>7D</th>
                        <th>7E</th>
                        <th>7F</th>

                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="fit">0</td>
                        <th>06.00 - 07.00</th>
                        <th class="ungu">3</th>
                        <th class="ungu">4</th>
                        <th class="ungu">5</th>
                        <th class="merah">12</th>
                        <th class="hijau">10</th>
                        <th class="kuning">23</th>
                      </tr>
                      <tr>
                        <td class="fit">1</td>
                        <th>08.00 - 09.00</th>
                        <th class="ungu">3</th>
                        <th class="ungu">4</th>
                        <th class="ungu">5</th>
                        <th class="merah">12</th>
                        <th class="hijau">10</th>
                        <th class="kuning">23</th>
                      </tr>
                      <tr>
                        <td class="fit">2</td>
                        <th>09.00 - 10.00</th>
                        <th class="hijau">17</th>
                        <th class="ungu">7</th>
                        <th class="kuning">9</th>
                        <th class="merah">21</th>
                        <th class="kuning">12</th>
                        <th class="ungu">20</th>
                        
                      </tr>

                      <tr>
                        <td class="fit">3</td>
                        <th>10.00 - 12.00</th>
                        <th class="hijau">17</th>
                        <th class="ungu">7</th>
                        <th class="kuning">9</th>
                        <th class="merah">21</th>
                        <th class="kuning">12</th>
                        <th class="ungu">20</th>
                        
                      </tr>

                    </tbody>

                  </table>
                  <br>
                  <table class="table table-bordered table-striped tabelmapel">
                    <thead>
                      <tr class="barishari">
                        <th class="tengah" rowspan="2">Jam ke</th>
                        <th class="tengah" rowspan="2">Waktu</th>
                        <th colspan="6">Rabu</th>
                      </tr>
                      <tr class="bariskelas">
                        <th>7A</th>
                        <th>7B</th>
                        <th>7C</th>
                        <th>7D</th>
                        <th>7E</th>
                        <th>7F</th>

                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="fit">0</td>
                        <th>06.00 - 07.00</th>
                        <th class="ungu">3</th>
                        <th class="ungu">4</th>
                        <th class="ungu">5</th>
                        <th class="merah">12</th>
                        <th class="hijau">10</th>
                        <th class="kuning">23</th>
                      </tr>
                      <tr>
                        <td class="fit">1</td>
                        <th>08.00 - 09.00</th>
                        <th class="ungu">3</th>
                        <th class="ungu">4</th>
                        <th class="ungu">5</th>
                        <th class="merah">12</th>
                        <th class="hijau">10</th>
                        <th class="kuning">23</th>
                      </tr>
                      <tr>
                        <td class="fit">2</td>
                        <th>09.00 - 10.00</th>
                        <th class="hijau">17</th>
                        <th class="ungu">7</th>
                        <th class="kuning">9</th>
                        <th class="merah">21</th>
                        <th class="kuning">12</th>
                        <th class="ungu">20</th>
                        
                      </tr>

                    </tbody>

                  </table>

                  <table class="table table-bordered table-striped tabelmapel">
                    <thead>
                      <tr class="barishari">
                        <th class="tengah" rowspan="2">Jam ke</th>
                        <th class="tengah" rowspan="2">Waktu</th>
                        <th colspan="6">Kamis</th>
                      </tr>
                      <tr class="bariskelas">
                        <th>7A</th>
                        <th>7B</th>
                        <th>7C</th>
                        <th>7D</th>
                        <th>7E</th>
                        <th>7F</th>

                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="fit">0</td>
                        <th>06.00 - 07.00</th>
                        <th class="ungu">3</th>
                        <th class="ungu">4</th>
                        <th class="ungu">5</th>
                        <th class="merah">12</th>
                        <th class="hijau">10</th>
                        <th class="kuning">23</th>
                      </tr>
                      <tr>
                        <td class="fit">1</td>
                        <th>08.00 - 09.00</th>
                        <th class="ungu">3</th>
                        <th class="ungu">4</th>
                        <th class="ungu">5</th>
                        <th class="merah">12</th>
                        <th class="hijau">10</th>
                        <th class="kuning">23</th>
                      </tr>
                      <tr>
                        <td class="fit">2</td>
                        <th>09.00 - 10.00</th>
                        <th class="hijau">17</th>
                        <th class="ungu">7</th>
                        <th class="kuning">9</th>
                        <th class="merah">21</th>
                        <th class="kuning">12</th>
                        <th class="ungu">20</th>
                        
                      </tr>

                    </tbody>
                    <br>
                  </table>

                  <table class="table table-bordered table-striped tabelmapel">
                    <thead>
                      <tr class="barishari">
                        <th class="tengah" rowspan="2">Jam ke</th>
                        <th class="tengah" rowspan="2">Waktu</th>
                        <th colspan="6">Jum'at</th>
                      </tr>
                      <tr class="bariskelas">
                        <th>7A</th>
                        <th>7B</th>
                        <th>7C</th>
                        <th>7D</th>
                        <th>7E</th>
                        <th>7F</th>

                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="fit">0</td>
                        <th>06.00 - 07.00</th>
                        <th class="ungu">3</th>
                        <th class="ungu">4</th>
                        <th class="ungu">5</th>
                        <th class="merah">12</th>
                        <th class="hijau">10</th>
                        <th class="kuning">23</th>
                      </tr>
                      <tr>
                        <td class="fit">1</td>
                        <th>08.00 - 09.00</th>
                        <th class="ungu">3</th>
                        <th class="ungu">4</th>
                        <th class="ungu">5</th>
                        <th class="merah">12</th>
                        <th class="hijau">10</th>
                        <th class="kuning">23</th>
                      </tr>
                      <tr>
                        <td class="fit">2</td>
                        <th>09.00 - 10.00</th>
                        <th class="hijau">17</th>
                        <th class="ungu">7</th>
                        <th class="kuning">9</th>
                        <th class="merah">21</th>
                        <th class="kuning">12</th>
                        <th class="ungu">20</th>
                        
                      </tr>

                    </tbody>

                  </table>
                  <br>
                  <table class="table table-bordered table-striped tabelmapel">
                    <thead>
                      <tr class="barishari">
                        <th class="tengah" rowspan="2">Jam ke</th>
                        <th class="tengah" rowspan="2">Waktu</th>
                        <th colspan="6">Sabtu</th>
                      </tr>
                      <tr class="bariskelas">
                        <th>7A</th>
                        <th>7B</th>
                        <th>7C</th>
                        <th>7D</th>
                        <th>7E</th>
                        <th>7F</th>

                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="fit">0</td>
                        <th>06.00 - 07.00</th>
                        <th class="ungu">3</th>
                        <th class="ungu">4</th>
                        <th class="ungu">5</th>
                        <th class="merah">12</th>
                        <th class="hijau">10</th>
                        <th class="kuning">23</th>
                      </tr>
                      <tr>
                        <td class="fit">1</td>
                        <th>08.00 - 09.00</th>
                        <th class="ungu">3</th>
                        <th class="ungu">4</th>
                        <th class="ungu">5</th>
                        <th class="merah">12</th>
                        <th class="hijau">10</th>
                        <th class="kuning">23</th>
                      </tr>
                      <tr>
                        <td class="fit">2</td>
                        <th>09.00 - 10.00</th>
                        <th class="hijau">17</th>
                        <th class="ungu">7</th>
                        <th class="kuning">9</th>
                        <th class="merah">21</th>
                        <th class="kuning">12</th>
                        <th class="ungu">20</th>
                        
                      </tr>

                    </tbody>

                  </table>
                  <a href="#jadwalmapel" data-toggle="tab"><button class="btnjdwl"><i class="fa fa-print text-red "></i> Print</button></a>
                </div>
                <!-- /.box-body -->
              </div>


            </div>
            <!-- /.tab-pane -->

            <div class="active tab-pane" id="jadwalprioritas">
              <div class="box">

                <!-- /.box-header -->
                <div class="box-body">
                  <form method="post" action="<?php echo site_url('penjadwalan/kurikulum/simpanprioritas'); ?>">
                    <table class="table table-bordered table-striped tabelmapel">
                      <!-- <select name="jenjang">
                        <option value="7"> KELAS 7</option>
                        <option value="8"> KELAS 8</option>
                        <option value="9"> KELAS 9</option>
                      </select> -->
                      <thead>
                        <tr class="barishari">
                          <th class="tengah" >Jam ke</th>
                          <th class="tengah" >Waktu</th>
                          <th class="tengah">Senin</th>
                          <th class="tengah">Selasa</th>
                          <th class="tengah">Rabu</th>
                          <th class="tengah">Kamis</th>
                          <th class="tengah">Jumat</th>
                          <th class="tengah">Sabtu</th>
                          <th class="tengah">Minggu</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        for($i=0;$i<=8;$i++)  {
                          ?>
                          <tr class="btnpilih">
                            <td class="fit"><?php echo $i; ?></td>
                            <th>&nbsp;</th>
                            <th>

                              <select data-placeholder="Pilih mapel" multiple class="chosen-select" name="id_namamapel_senin_<?php echo $i; ?>[]" id="id_namamapel_senin_<?php echo $i; ?>">
                                <?php
                                foreach ($tabel_namamapel as $row_namamapel) {
                                  ?>
                                  <option value="<?php echo $row_namamapel->id_namamapel; ?>"><?php echo $row_namamapel->nama; ?></option>
                                  <?php
                                }
                                ?>
                              </select>


                              <!-- <button class="btn btn-success button-form" data-toggle="modal" data-target="#review4" style="background-color:#80002a; border-color:#80002a;">Pilih Mapel</button> -->
                            </th>
                            <th>
                              <select data-placeholder="Pilih mapel" multiple class="chosen-select" name="id_namamapel_selasa_<?php echo $i; ?>[]" id="id_namamapel_selasa_<?php echo $i; ?>">
                                <?php
                                foreach ($tabel_namamapel as $row_namamapel) {
                                  ?>
                                  <option value="<?php echo $row_namamapel->id_namamapel; ?>"><?php echo $row_namamapel->nama; ?></option>
                                  <?php
                                }
                                ?>
                              </select>
                              <!-- <button class="btn btn-success button-form" data-toggle="modal" data-target="#review4" style="background-color:#80002a; border-color:#80002a;">Pilih Mapel</button> -->
                            </th>
                            <th>
                              <select data-placeholder="Pilih mapel" multiple class="chosen-select" name="id_namamapel_rabu_<?php echo $i; ?>[]" id="id_namamapel_rabu_<?php echo $i; ?>">
                                <?php
                                foreach ($tabel_namamapel as $row_namamapel) {
                                  ?>
                                  <option value="<?php echo $row_namamapel->id_namamapel; ?>"><?php echo $row_namamapel->nama; ?></option>
                                  <?php
                                }
                                ?>
                              </select>
                              <!-- <button class="btn btn-success button-form" data-toggle="modal" data-target="#review4" style="background-color:#80002a; border-color:#80002a;">Pilih Mapel</button> -->
                            </th>
                            <th>
                              <select data-placeholder="Pilih mapel" multiple class="chosen-select" name="id_namamapel_kamis_<?php echo $i; ?>[]" id="id_namamapel_kamis_<?php echo $i; ?>">
                                <?php
                                foreach ($tabel_namamapel as $row_namamapel) {
                                  ?>
                                  <option value="<?php echo $row_namamapel->id_namamapel; ?>"><?php echo $row_namamapel->nama; ?></option>
                                  <?php
                                }
                                ?>
                              </select>
                              <!-- <button class="btn btn-success button-form" data-toggle="modal" data-target="#review4" style="background-color:#80002a; border-color:#80002a;">Pilih Mapel</button> -->
                            </th>
                            <th>
                              <select data-placeholder="Pilih mapel" multiple class="chosen-select" name="id_namamapel_jumat_<?php echo $i; ?>[]" id="id_namamapel_jumat_<?php echo $i; ?>">
                                <?php
                                foreach ($tabel_namamapel as $row_namamapel) {
                                  ?>
                                  <option value="<?php echo $row_namamapel->id_namamapel; ?>"><?php echo $row_namamapel->nama; ?></option>
                                  <?php
                                }
                                ?>
                              </select>
                              <!-- <button class="btn btn-success button-form" data-toggle="modal" data-target="#review4" style="background-color:#80002a; border-color:#80002a;">Pilih Mapel</button> -->
                            </th>
                            <th>
                              <select data-placeholder="Pilih mapel" multiple class="chosen-select" name="id_namamapel_sabtu_<?php echo $i; ?>[]" id="id_namamapel_sabtu_<?php echo $i; ?>">
                                <?php
                                foreach ($tabel_namamapel as $row_namamapel) {
                                  ?>
                                  <option value="<?php echo $row_namamapel->id_namamapel; ?>"><?php echo $row_namamapel->nama; ?></option>
                                  <?php
                                }
                                ?>
                              </select>
                              <!-- <button class="btn btn-success button-form" data-toggle="modal" data-target="#review4" style="background-color:#80002a; border-color:#80002a;">Pilih Mapel</button> -->
                            </th>
                            <th>
                              <select data-placeholder="Pilih mapel" multiple class="chosen-select" name="id_namamapel_minggu_<?php echo $i; ?>[]" id="id_namamapel_minggu_<?php echo $i; ?>">
                                <?php
                                foreach ($tabel_namamapel as $row_namamapel) {
                                  ?>
                                  <option value="<?php echo $row_namamapel->id_namamapel; ?>"><?php echo $row_namamapel->nama; ?></option>
                                  <?php
                                }
                                ?>
                              </select>
                              <!-- <button class="btn btn-success button-form" data-toggle="modal" data-target="#review4" style="background-color:#80002a; border-color:#80002a;">Pilih Mapel</button> -->
                            </th>
                          </tr>
                          <?php
                        }
                        ?>
                      </tbody>

                    </table>
                    <button class="btn btnjdwl" type="submit">Submit</button>
                  </form>
                </div>
                <!-- /.box-body -->

                <!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered table-striped tabelmapel">
                    <thead>
                      <tr class="barishari" style="background-color:grey; color:white;">
                        <th class="tengah" >Jam ke</th>
                        <th class="tengah" >Waktu</th>
                        <th class="tengah">Senin</th>
                        <th class="tengah">Selasa</th>
                        <th class="tengah">Rabu</th>
                        <th class="tengah">Kamis</th>
                        <th class="tengah">Jumat</th>
                        <th class="tengah">Sabtu</th>
                        <th class="tengah">Minggu</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- <?php $i = 0 ?>
                      <?php foreach ($prioritas_khusus as $nama => $jadwalmapel) : ?>
                        <?php $i++ ?>
                        <?php $nama = implode($jadwalmapel["nama"]) ?>
                       <tr>
                         <td><?php echo $i. "." ?>;</td>
                         <td>&nbsp;</td>
                         <td><?php echo $Senin ?></td>
                         <td><?php echo $Selasa ?>;</td>
                         <td><?php echo $Rabu ?>;</td>
                         <td><?php echo $Kamis ?>;</td>
                         <td><?php echo $Jumat ?>;</td>
                         <td><?php echo $Sabtu ?>;</td>
                         <td><?php echo $Minggu ?>;</td>
                       </tr>

                     <?php endforeach; ?> -->
                      
                      <?php
                      for($i=0;$i<=8;$i++) {
                        ?>
                        <tr>
                          <td class="fit"><?php echo $i; ?></td>
                          <th>&nbsp;</th>
                          <th><?php echo @$tabel_prioritaskhusus_senin[$i]->nama; ?> </th>
                          <th><?php echo @$tabel_prioritaskhusus_selasa[$i]->nama; ?> </th>
                          <th><?php echo @$tabel_prioritaskhusus_rabu[$i]->nama; ?> </th>
                          <th><?php echo @$tabel_prioritaskhusus_kamis[$i]->nama; ?> </th>
                          <th><?php echo @$tabel_prioritaskhusus_jumat[$i]->nama; ?> </th>
                          <th><?php echo @$tabel_prioritaskhusus_sabtu[$i]->nama; ?> </th>
                          <th><?php echo @$tabel_prioritaskhusus_minggu[$i]->nama; ?> </th>
                          <!-- <th>06.00 - 07.00</th>
                          <th>
                            -
                          </th>
                          <th>
                           -
                         </th>
                         <th>
                          -
                        </th>
                        <th>
                          -
                        </th>
                        <th>
                         -
                       </th>
                       <th>
                         -
                       </th>
                       <th>
                         -
                       </th>
                     </tr>
                     <tr class="btnpilih">
                      <td class="fit">1</td>
                      <th>07.00 - 08.00</th>
                      <th>
                        OLAHRAGA,MATEMATIKA,IPA
                      </th>
                      <th>
                        OLAHRAGA,MATEMATIKA,IPA
                      </th>
                      <th>
                       -
                     </th>
                     <th>
                       -
                       <th>
                        KESENIAN
                      </th>
                      <th>
                       KESENIAN
                     </th>
                     <th>
                       IPA
                     </th>
                   </tr>
                   <tr class="btnpilih">
                    <td class="fit">2</td>
                    <th>09.00 - 10.00</th>
                    <th>
                     OLAHRAGA,MATEMATIKA,IPA
                   </th>
                   <th>
                     OLAHRAGA,MATEMATIKA,IPA
                   </th>
                   <th>
                    -
                  </th>
                  <th>
                   -
                 </th>
                 <th>
                  -
                </th>
                <th>
                  -
                </th>
                <th>
                 KESENIAN
               </th>
             </tr>

             <tr class="btnpilih">
              <td class="fit">3</td>
              <th>10.00 - 12.00</th>
              <th>
               OLAHRAGA,MATEMATIKA,IPA
             </th>
             <th>
               OLAHRAGA,MATEMATIKA,IPA
             </th>
             <th>
              -
            </th>
            <th>
             -
           </th>
           <th>
            -
          </th>
          <th>
            -
          </th>
          <th>
           KESENIAN
         </th>
       </tr>
       <tr class="btnpilih">
        <td class="fit">4</td>
        <th>13.00 - 14.00</th>
        <th>
         OLAHRAGA,MATEMATIKA,IPA
       </th>
       <th>
         OLAHRAGA,MATEMATIKA,IPA
       </th>
       <th>
        -
      </th>
      <th>
       -
     </th>
     <th>
      -
    </th>
    <th>
      -
    </th>
    <th>
     KESENIAN
   </th> -->
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

<div class="tab-pane" id="jadwalkhusus">
  <div class="box">

    <!-- /.box-header -->
    <div class="box-body">
     <form method="post" action="<?php echo site_url('penjadwalan/kurikulum/simpankhusus'); ?>">
      <table class="table table-bordered table-striped tabelmapel">
        <thead>
          <tr class="barishari">
            <th class="tengah" >Jam ke</th>
            <th class="tengah" >Waktu</th>
            <th class="tengah">Senin</th>
            <th class="tengah">Selasa</th>
            <th class="tengah">Rabu</th>
            <th class="tengah">Kamis</th>
            <th class="tengah">Jumat</th>
            <th class="tengah">Sabtu</th>
            <th class="tengah">Minggu</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          for($i=0;$i<=8;$i++)  {
            ?>
            <tr class="btnpilih">
              <td class="fit"><?php echo $i; ?></td>
              <th>&nbsp;</th>
              <th>
                <select data-placeholder="Pilih guru" multiple class="chosen-select" name="NIP_senin_<?php echo $i; ?>[]" id="NIP_senin_<?php echo $i; ?>">
                  <?php
                  foreach ($tabel_pegawai as $row_pegawai) {
                    ?>
                    <option value="<?php echo $row_pegawai->NIP; ?>"><?php echo $row_pegawai->kode_guru; ?>. <?php echo $row_pegawai->nama_panggilan; ?></option>
                    <?php
                  }
                  ?>
                </select>
                <!-- <button class="btn btn-success button-form" data-toggle="modal" data-target="#review4" style="background-color:#00994d; border-color:#00994d;">Pilih guru</button> -->
              </th>
              <th>
                <select data-placeholder="Pilih guru" multiple class="chosen-select" name="NIP_selasa_<?php echo $i; ?>[]" id="NIP_selasa_<?php echo $i; ?>">
                  <?php
                  foreach ($tabel_pegawai as $row_pegawai) {
                    ?>
                    <option value="<?php echo $row_pegawai->NIP; ?>"><?php echo $row_pegawai->kode_guru; ?>. <?php echo $row_pegawai->nama_panggilan; ?></option>
                    <?php
                  }
                  ?>
                </select>

                <th>
                  <select data-placeholder="Pilih guru" multiple class="chosen-select" name="NIP_rabu_<?php echo $i; ?>[]" id="NIP_rabu_<?php echo $i; ?>">
                    <?php
                    foreach ($tabel_pegawai as $row_pegawai) {
                      ?>
                      <option value="<?php echo $row_pegawai->NIP; ?>"><?php echo $row_pegawai->kode_guru; ?>. <?php echo $row_pegawai->nama_panggilan; ?></option>
                      <?php
                    }
                    ?>
                  </select>
                  <!-- <button class="btn btn-success button-form" data-toggle="modal" data-target="#review4" style="background-color:#00994d; border-color:#00994d;">Pilih guru</button> -->
                </th>
                <th>
                  <select data-placeholder="Pilih guru" multiple class="chosen-select" name="NIP_kamis_<?php echo $i; ?>[]" id="NIP_kamis_<?php echo $i; ?>">
                    <?php
                    foreach ($tabel_pegawai as $row_pegawai) {
                      ?>
                      <option value="<?php echo $row_pegawai->NIP; ?>"><?php echo $row_pegawai->kode_guru; ?>. <?php echo $row_pegawai->nama_panggilan; ?></option>
                      <?php
                    }
                    ?>
                  </select>
                  <!-- <button class="btn btn-success button-form" data-toggle="modal" data-target="#review4" style="background-color:#00994d; border-color:#00994d;">Pilih guru</button> -->
                </th>
                <th>
                  <select data-placeholder="Pilih guru" multiple class="chosen-select" name="NIP_jumat_<?php echo $i; ?>[]" id="NIP_jumat_<?php echo $i; ?>">
                    <?php
                    foreach ($tabel_pegawai as $row_pegawai) {
                      ?>
                      <option value="<?php echo $row_pegawai->NIP; ?>"><?php echo $row_pegawai->kode_guru; ?>. <?php echo $row_pegawai->nama_panggilan; ?></option>
                      <?php
                    }
                    ?>
                  </select>
                  <!-- <button class="btn btn-success button-form" data-toggle="modal" data-target="#review4" style="background-color:#00994d; border-color:#00994d;">Pilih guru</button> -->
                </th>
                <th>
                  <select data-placeholder="Pilih guru" multiple class="chosen-select" name="NIP_sabtu_<?php echo $i; ?>[]" id="NIP_sabtu_<?php echo $i; ?>">
                    <?php
                    foreach ($tabel_pegawai as $row_pegawai) {
                      ?>
                      <option value="<?php echo $row_pegawai->NIP; ?>"><?php echo $row_pegawai->kode_guru; ?>. <?php echo $row_pegawai->nama_panggilan; ?></option>
                      <?php
                    }
                    ?>
                  </select>
                  <!-- <button class="btn btn-success button-form" data-toggle="modal" data-target="#review4" style="background-color:#00994d; border-color:#00994d;">Pilih guru</button> -->
                </th>
                <th>
                  <select data-placeholder="Pilih guru" multiple class="chosen-select" name="NIP_minggu_<?php echo $i; ?>[]" id="NIP_minggu_<?php echo $i; ?>">
                    <?php
                    foreach ($tabel_pegawai as $row_pegawai) {
                      ?>
                      <option value="<?php echo $row_pegawai->NIP; ?>"><?php echo $row_pegawai->kode_guru; ?>. <?php echo $row_pegawai->nama_panggilan; ?></option>
                      <?php
                    }
                    ?>
                  </select>
                  <!-- <button class="btn btn-success button-form" data-toggle="modal" data-target="#review4" style="background-color:#00994d; border-color:#00994d;">Pilih guru</button> -->
                </th>
              </tr>
              <?php
            }
            ?>
          </tbody>

        </table>
        <button class="btn btnjdwl">Submit</button>
      </form>
    </div>
    <!-- /.box-body -->

    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered table-striped tabelmapel">
        <thead>
          <tr class="barishari" style="background-color:grey; color:white;">
            <th class="tengah" >Jam ke</th>
            <th class="tengah" >Waktu</th>
            <th class="tengah">Senin</th>
            <th class="tengah">Selasa</th>
            <th class="tengah">Rabu</th>
            <th class="tengah">Kamis</th>
            <th class="tengah">Jumat</th>
            <th class="tengah">Sabtu</th>
            <th class="tengah">Minggu</th>
          </tr>
        </thead>
        <tbody>
          <tr class="btnpilih">
            <td class="fit">0</td>
            <th>06.00 - 07.00</th>
            <th>
              -
            </th>
            <th>
             -
           </th>
           <th>
            -
          </th>
          <th>
            -
          </th>
          <th>
           -
         </th>
         <th>
           -
         </th>
       </tr>
       <tr class="btnpilih">
        <td class="fit">1</td>
        <th>07.00 - 08.00</th>
        <th>
         1,20,18
       </th>
       <th>
         1,20,18
       </th>
       <th>
         -
       </th>
       <th>
         -
         <th>
           26
         </th>
         <th>
           26
         </th>
       </tr>
       <tr class="btnpilih">
        <td class="fit">2</td>
        <th>09.00 - 10.00</th>
        <th>
         8
       </th>
       <th>
         8
       </th>
       <th>
        -
      </th>
      <th>
       -
     </th>
     <th>
      -
    </th>
    <th>
      -
    </th>
  </tr>
</tbody>

</table>

</div>
<!-- /.box-body -->
</div> 
</div>
<!-- /.tab-pane -->
<div class="tab-pane" id="kelolajadwalmapel">
  <div class="box">
    <div class="box-header">
      <form>
        <select>
          <option> KELAS 7</option>
          <option> KELAS 8</option>
          <option> KELAS 9</option>
        </select>
      </form>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
      <table  class="table table-bordered table-striped tabelmapel">
        <thead>
          <tr class="barishari">
            <th class="tengah" rowspan="2">Jam ke</th>
            <th class="tengah" rowspan="2">Waktu</th>
            <th colspan="6">Senin</th>

          </tr>
          <tr class="bariskelas">
            <th>7A</th>
            <th>7B</th>
            <th>7C</th>
            <th>7D</th>
            <th>7E</th>
            <th>7F</th>


          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="fit">0</td>
            <th>06.00 - 07.00</th>
            <th>
              <select class="kodeguru">
                <option class="merah">1. Heru (IPA)</option>
                <option class="kuning">2. Rina (MTK)</option>
                <option class="ungu">3. Tuti (PPKn)</option>
                <option class="hijau">4. Sofi (PAI)</option>
              </select>
            </th>
            <th>
              <select class="kodeguru">
               <option class="merah">1. Heru (IPA)</option>
               <option class="kuning">2. Rina (MTK)</option>
               <option class="ungu">3. Tuti (PPKn)</option>
               <option class="hijau">4. Sofi (PAI)</option>
             </select>
           </th>
           <th>
            <select class="kodeguru">
              <option class="merah">1. Heru (IPA)</option>
              <option class="kuning">2. Rina (MTK)</option>
              <option class="ungu">3. Tuti (PPKn)</option>
              <option class="hijau">4. Sofi (PAI)</option>
            </select>
          </th>
          <th>
            <select class="kodeguru">
              <option class="merah">1. Heru (IPA)</option>
              <option class="kuning">2. Rina (MTK)</option>
              <option class="ungu">3. Tuti (PPKn)</option>
              <option class="hijau">4. Sofi (PAI)</option>
            </select>
          </th>
          <th>
            <select class="kodeguru">
              <option class="merah">1. Heru (IPA)</option>
              <option class="kuning">2. Rina (MTK)</option>
              <option class="ungu">3. Tuti (PPKn)</option>
              <option class="hijau">4. Sofi (PAI)</option>
            </select>
          </th>
          <th>
            <select class="kodeguru">
             <option class="merah">1. Heru (IPA)</option>
             <option class="kuning">2. Rina (MTK)</option>
             <option class="ungu">3. Tuti (PPKn)</option>
             <option class="hijau">4. Sofi (PAI)</option>
           </select>
         </th>

       </tr>
       <tr>
        <td class="fit">1</td>
        <th>09.00 - 10.00</th>
        <th>
          <select class="kodeguru">
            <option class="merah">1. Heru (IPA)</option>
            <option class="kuning">2. Rina (MTK)</option>
            <option class="ungu">3. Tuti (PPKn)</option>
            <option class="hijau">4. Sofi (PAI)</option>
          </select>
        </th>
        <th>
          <select class="kodeguru">
           <option class="merah">1. Heru (IPA)</option>
           <option class="kuning">2. Rina (MTK)</option>
           <option class="ungu">3. Tuti (PPKn)</option>
           <option class="hijau">4. Sofi (PAI)</option>
         </select>
       </th>
       <th>
        <select class="kodeguru">
         <option class="merah">1. Heru (IPA)</option>
         <option class="kuning">2. Rina (MTK)</option>
         <option class="ungu">3. Tuti (PPKn)</option>
         <option class="hijau">4. Sofi (PAI)</option>
       </select>
     </th>
     <th>
      <select class="kodeguru">
       <option class="merah">1. Heru (IPA)</option>
       <option class="kuning">2. Rina (MTK)</option>
       <option class="ungu">3. Tuti (PPKn)</option>
       <option class="hijau">4. Sofi (PAI)</option>
     </select>
   </th>
   <th>
    <select class="kodeguru">
     <option class="merah">1. Heru (IPA)</option>
     <option class="kuning">2. Rina (MTK)</option>
     <option class="ungu">3. Tuti (PPKn)</option>
     <option class="hijau">4. Sofi (PAI)</option>
   </select>
 </th>
 <th>
  <select class="kodeguru">
   <option class="merah">1. Heru (IPA)</option>
   <option class="kuning">2. Rina (MTK)</option>
   <option class="ungu">3. Tuti (PPKn)</option>
   <option class="hijau">4. Sofi (PAI)</option>
 </select>
</th>

</tr>

<tr>
  <td class="fit">2</td>
  <th>10.30 - 11.00</th>
  <th>
    <select class="kodeguru">
      <option class="merah">1. Heru (IPA)</option>
      <option class="kuning">2. Rina (MTK)</option>
      <option class="ungu">3. Tuti (PPKn)</option>
      <option class="hijau">4. Sofi (PAI)</option>
    </select>
  </th>
  <th>
    <select class="kodeguru">
     <option class="merah">1. Heru (IPA)</option>
     <option class="kuning">2. Rina (MTK)</option>
     <option class="ungu">3. Tuti (PPKn)</option>
     <option class="hijau">4. Sofi (PAI)</option>
   </select>
 </th>
 <th>
  <select class="kodeguru">
   <option class="merah">1. Heru (IPA)</option>
   <option class="kuning">2. Rina (MTK)</option>
   <option class="ungu">3. Tuti (PPKn)</option>
   <option class="hijau">4. Sofi (PAI)</option>
 </select>
</th>
<th>
  <select class="kodeguru">
   <option class="merah">1. Heru (IPA)</option>
   <option class="kuning">2. Rina (MTK)</option>
   <option class="ungu">3. Tuti (PPKn)</option>
   <option class="hijau">4. Sofi (PAI)</option>
 </select>
</th>
<th>
  <select class="kodeguru">
   <option class="merah">1. Heru (IPA)</option>
   <option class="kuning">2. Rina (MTK)</option>
   <option class="ungu">3. Tuti (PPKn)</option>
   <option class="hijau">4. Sofi (PAI)</option>
 </select>
</th>
<th>
  <select class="kodeguru">
   <option class="merah">1. Heru (IPA)</option>
   <option class="kuning">2. Rina (MTK)</option>
   <option class="ungu">3. Tuti (PPKn)</option>
   <option class="hijau">4. Sofi (PAI)</option>
 </select>
</th>

</tr>

</tbody>

</table>
<a href="#jadwalmapel" data-toggle="tab"><button class="btnjdwl">Submit</button></a>
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


      <!-- <div class="modal fade bs-example-modal-lg" id="review4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Daftar Mata Pelajaran Jadwal Prioritas</h4>
            </div>
            <div class="modal-body">
              <form id="formPartE" class="form-horizontal style-form form-goods" method="post" action="#" enctype="multipart/form-data">
                      <div class="form-group">
                          <label class="col-sm-2 col-sm-2 control-label">Pilih Mata Pelajar :</label>
                          <div class="col-sm-10">
                            <ul class="titik">
                              <li><input type="checkbox"> Matematika</li>
                              <li><input type="checkbox"> Bahasa Indonesia</li>
                              <li><input type="checkbox"> Bahasa Inggris</li>
                              <li><input type="checkbox"> IPS</li>
                              <li><input type="checkbox"> Fisika</li>
                              <li><input type="checkbox"> Biologi</li>
                              <li><input type="checkbox"> Penjaskes</li>
                              <li><input type="checkbox"> Kesenian</li>
                              <li><input type="checkbox"> Bahasa Jawa</li>
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
      </div> -->
    </section>
    <!-- /.content -->
  </div>
  <!--  /.content-wrapper -->
  <script type="text/javascript">
    $(".chosen-select").chosen({width: "95%"}); 
  </script>
  <script type="text/javascript">
              // function getmapel() {
              //   $.ajax({
              //     url: '<?php echo site_url('penjadwalan/kurikulum/getmapelkelas'); ?>/'+document.getElementById('jenjang').value,
              //     dataType: 'json',
              //     cache: false,
              //     success: function(msg){
              //   //alert('ok');

              //              document.getElementById('id_mapel_senin_0').innerHTML = '<option>Please Wait...</option>';
              //              for(i=0;i<msg.data.length;i++){
              //                 // alert(msg.data[i].NIP + ' ' + msg.data[i].Nama);
              //                 // document.getElementById('NIP_text'+nomor).innerHTML = msg.data[i].NIP;
              //                 document.getElementById('id_mapel_senin_0').innerHTML = '<option value="'+msg.data[i].nama_mapel+'">'+msg.data[i].nama_mapel+'</option>';

              //         }
              //     }
              // });
              // }

              // getmapelkelas();
            </script>