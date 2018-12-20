<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <center style="color:navy;">Jadwal Tambahan<br></center>
      <center><small>Tahun Ajaran 2016-2017</small></center>
    </h1>

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
            <?php
            if (($this->session->userdata('jabatan') == 'Admin') || ($this->session->userdata('jabatan') == 'Kurikulum')) {
              ?>
              <li><a href="#kelolajadwaltambahan" data-toggle="tab">Kelola Jadwal Tambahan</a></li>
              <li><a href="#datajadwaltambahan" data-toggle="tab">Data Jadwal Tambahan</a></li>
              <?php
               }
              ?>
              <li class="active"><a href="#jadwaltambahan" data-toggle="tab">Jadwal Tambahan</a></li>

            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="jadwaltambahan">
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
                  <table id="example1" class="table table-bordered table-striped tabelmapel">
                    <thead>
                      <tr class="barishari">
                        <th class="tengah" rowspan="2">Jam ke</th>
                        <th class="tengah" rowspan="2">Waktu</th>
                        <th colspan="9">Senin,29 Okt</th>
                        <tr class="bariskelas">
                          <th>7A</th>
                          <th>7B</th>
                          <th>7C</th>
                          <th>7D</th>
                          <th>7E</th>
                          <th>7F</th>
                          <th>7G</th>
                        </tr>
                      </tr>
                      <tbody>
                        <tr>
                          <td class="fit">0</td>
                          <th>06.00 - 07.00</th>
                          <th class="ungu">3</th>
                          <th class="ungu">4</th>
                          <th class="ungu">5</th>
                          <th class="hijau">6</th>
                          <th class="merah">7</th>
                          <th class="kuning"> 8</th>
                          <th>9</th>
                        </tr>
                        <tr>
                          <td class="fit">1</td>
                          <th>08.00 - 09.00</th>
                          <th class="ungu">3</th>
                          <th class="ungu">4</th>
                          <th class="ungu">5</th>
                          <th class="hijau">6</th>
                          <th class="merah">7</th>
                          <th class="kuning"> 8</th>
                          <th>9</th>
                        </tr>
                        <tr>
                          <td class="fit">2</td>
                          <th>09.00 - 10.00</th>
                          <th>17</th>
                          <th>7</th>
                          <th>9</th>
                          <th>10</th>
                          <th>12</th>
                          <th>13</th>
                          <th>14</th>

                        </tr>

                      </tbody>
                      <br>
                    </thead>
                    <thead>
                      <tr class="barishari">
                        <th class="tengah" rowspan="2">Jam ke</th>
                        <th class="tengah" rowspan="2">Waktu</th>
                        <th colspan="9">Selasa,30 Okt</th>
                        <tr class="bariskelas">
                          <th>7A</th>
                          <th>7B</th>
                          <th>7C</th>
                          <th>7D</th>
                          <th>7E</th>
                          <th>7F</th>
                          <th>7G</th>
                        </tr>
                      </tr>
                      <tbody>
                        <tr>
                          <td class="fit">0</td>
                          <th>06.00 - 07.00</th>
                          <th class="ungu">3</th>
                          <th class="ungu">4</th>
                          <th class="ungu">5</th>
                          <th class="hijau">6</th>
                          <th class="merah">7</th>
                          <th class="kuning"> 8</th>
                          <th>9</th>
                        </tr>
                        <tr>
                          <td class="fit">1</td>
                          <th>08.00 - 09.00</th>
                          <th class="ungu">3</th>
                          <th class="ungu">4</th>
                          <th class="ungu">5</th>
                          <th class="hijau">6</th>
                          <th class="merah">7</th>
                          <th class="kuning"> 8</th>
                          <th>9</th>
                        </tr>
                        <tr>
                          <td class="fit">2</td>
                          <th>09.00 - 10.00</th>
                          <th>17</th>
                          <th>7</th>
                          <th>9</th>
                          <th>10</th>
                          <th>12</th>
                          <th>13</th>
                          <th>14</th>

                        </tr>

                      </tbody>
                      <br>
                    </thead>
                    <thead>
                      <tr class="barishari">
                        <th class="tengah" rowspan="2">Jam ke</th>
                        <th class="tengah" rowspan="2">Waktu</th>
                        <th colspan="9">Rabu, 31 Okt</th>
                        <tr class="bariskelas">
                          <th>7A</th>
                          <th>7B</th>
                          <th>7C</th>
                          <th>7D</th>
                          <th>7E</th>
                          <th>7F</th>
                          <th>7G</th>
                        </tr>
                      </tr>
                      <tbody>
                        <tr>
                          <td class="fit">0</td>
                          <th>06.00 - 07.00</th>
                          <th class="ungu">3</th>
                          <th class="ungu">4</th>
                          <th class="ungu">5</th>
                          <th class="hijau">6</th>
                          <th class="merah">7</th>
                          <th class="kuning"> 8</th>
                          <th>9</th>
                        </tr>
                        <tr>
                          <td class="fit">1</td>
                          <th>08.00 - 09.00</th>
                          <th class="ungu">3</th>
                          <th class="ungu">4</th>
                          <th class="ungu">5</th>
                          <th class="hijau">6</th>
                          <th class="merah">7</th>
                          <th class="kuning"> 8</th>
                          <th>9</th>
                        </tr>
                        <tr>
                          <td class="fit">2</td>
                          <th>09.00 - 10.00</th>
                          <th>17</th>
                          <th>7</th>
                          <th>9</th>
                          <th>10</th>
                          <th>12</th>
                          <th>13</th>
                          <th>14</th>

                        </tr>

                      </tbody>
                      <br>
                    </thead>
                    <thead>
                      <tr class="barishari">
                        <th class="tengah" rowspan="2">Jam ke</th>
                        <th class="tengah" rowspan="2">Waktu</th>
                        <th colspan="9">Kamis, 1 Desember</th>
                        <tr class="bariskelas">
                          <th>7A</th>
                          <th>7B</th>
                          <th>7C</th>
                          <th>7D</th>
                          <th>7E</th>
                          <th>7F</th>
                          <th>7G</th>
                        </tr>
                      </tr>
                      <tbody>
                        <tr>
                          <td class="fit">0</td>
                          <th>06.00 - 07.00</th>
                          <th class="ungu">3</th>
                          <th class="ungu">4</th>
                          <th class="ungu">5</th>
                          <th class="hijau">6</th>
                          <th class="merah">7</th>
                          <th class="kuning"> 8</th>
                          <th>9</th>
                        </tr>
                        <tr>
                          <td class="fit">1</td>
                          <th>08.00 - 09.00</th>
                          <th class="ungu">3</th>
                          <th class="ungu">4</th>
                          <th class="ungu">5</th>
                          <th class="hijau">6</th>
                          <th class="merah">7</th>
                          <th class="kuning"> 8</th>
                          <th>9</th>
                        </tr>
                        <tr>
                          <td class="fit">2</td>
                          <th>09.00 - 10.00</th>
                          <th>17</th>
                          <th>7</th>
                          <th>9</th>
                          <th>10</th>
                          <th>12</th>
                          <th>13</th>
                          <th>14</th>

                        </tr>

                      </tbody>
                      <br>
                    </thead>
                    <thead>
                      <tr class="barishari">
                        <th class="tengah" rowspan="2">Jam ke</th>
                        <th class="tengah" rowspan="2">Waktu</th>
                        <th colspan="9">Jumat,2 Desember</th>
                        <tr class="bariskelas">
                          <th>7A</th>
                          <th>7B</th>
                          <th>7C</th>
                          <th>7D</th>
                          <th>7E</th>
                          <th>7F</th>
                          <th>7G</th>
                        </tr>
                      </tr>
                      <tbody>
                        <tr>
                          <td class="fit">0</td>
                          <th>06.00 - 07.00</th>
                          <th class="ungu">3</th>
                          <th class="ungu">4</th>
                          <th class="ungu">5</th>
                          <th class="hijau">6</th>
                          <th class="merah">7</th>
                          <th class="kuning"> 8</th>
                          <th>9</th>
                        </tr>
                        <tr>
                          <td class="fit">1</td>
                          <th>08.00 - 09.00</th>
                          <th class="ungu">3</th>
                          <th class="ungu">4</th>
                          <th class="ungu">5</th>
                          <th class="hijau">6</th>
                          <th class="merah">7</th>
                          <th class="kuning"> 8</th>
                          <th>9</th>
                        </tr>
                        <tr>
                          <td class="fit">2</td>
                          <th>09.00 - 10.00</th>
                          <th>17</th>
                          <th>7</th>
                          <th>9</th>
                          <th>10</th>
                          <th>12</th>
                          <th>13</th>
                          <th>14</th>

                        </tr>

                      </tbody>
                      <br>
                    </thead>
                    <thead>
                      <tr class="barishari">
                        <th class="tengah" rowspan="2">Jam ke</th>
                        <th class="tengah" rowspan="2">Waktu</th>
                        <th colspan="9">Sabtu, 3 Desember</th>
                        <tr class="bariskelas">
                          <th>7A</th>
                          <th>7B</th>
                          <th>7C</th>
                          <th>7D</th>
                          <th>7E</th>
                          <th>7F</th>
                          <th>7G</th>
                        </tr>
                      </tr>
                      <tbody>
                        <tr>
                          <td class="fit">0</td>
                          <th>06.00 - 07.00</th>
                          <th class="ungu">3</th>
                          <th class="ungu">4</th>
                          <th class="ungu">5</th>
                          <th class="hijau">6</th>
                          <th class="merah">7</th>
                          <th class="kuning"> 8</th>
                          <th>9</th>
                        </tr>
                        <tr>
                          <td class="fit">1</td>
                          <th>08.00 - 09.00</th>
                          <th class="ungu">3</th>
                          <th class="ungu">4</th>
                          <th class="ungu">5</th>
                          <th class="hijau">6</th>
                          <th class="merah">7</th>
                          <th class="kuning"> 8</th>
                          <th>9</th>
                        </tr>
                        <tr>
                          <td class="fit">2</td>
                          <th>09.00 - 10.00</th>
                          <th>17</th>
                          <th>7</th>
                          <th>9</th>
                          <th>10</th>
                          <th>12</th>
                          <th>13</th>
                          <th>14</th>

                        </tr>

                      </tbody>
                    </thead>

                  </table>
                  <a href="#jadwalmapel" data-toggle="tab"><button class="btnjdwl"><i class="fa fa-print text-red "></i> Print</button></a>
                </div>
                <!-- /.box-body -->
              </div>


            </div>


            <!-- /.tab-pane -->

            <div class="tab-pane" id="kelolajadwaltambahan">
              <div class="box">


                <!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped tabelmapel">
                    <thead>
                      <tr class="barishari">
                        <th class="tengah" rowspan="2">Keterangan</th>
                        <!-- <th class="tengah" colspan="4"><select>
                             <option>Desember</option>
                             <option>Januari</option>
                             <option>Februari</option>
                             <option>Maret</option>
                             <option>April</option> 
                             <option>Mei</option>
                           </select></th> -->
                         </tr>

                         <tr class="barishari">
                          <th class="tengah"><input type="date" placeholder="Tanggal pelaksanaan les"></th>
                          <th class="tengah"><input type="date" placeholder="Tanggal pelaksanaan les"></th>
                          <th class="tengah"><input type="date" placeholder="Tanggal pelaksanaan les"></th>
                          <th class="tengah"><input type="date" placeholder="Tanggal pelaksanaan les"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th>Kelas</th>
                          <th><select class="kodeguru">
                           <option>9A</option>
                           <option>9B</option>
                           <option>9C</option>
                           <option>9D</option>
                           <option>9E</option> 
                           <option>9F</option>
                         </select>
                       </th>
                       <th>
                        <select class="kodeguru">
                         <option>9A</option>
                         <option>9B</option>
                         <option>9C</option>
                         <option>9D</option>
                         <option>9E</option> 
                         <option>9F</option>
                       </select>
                     </th>
                     <th>
                      <select class="kodeguru">
                       <option>9A</option>
                       <option>9B</option>
                       <option>9C</option>
                       <option>9D</option>
                       <option>9E</option> 
                       <option>9F</option>
                     </select>
                   </th>
                   <th>
                    <select class="kodeguru">
                     <option>9A</option>
                     <option>9B</option>
                     <option>9C</option>
                     <option>9D</option>
                     <option>9E</option> 
                     <option>9F</option>
                   </select>
                 </th> 
               </tr>
               <tr>
                <th>Mata Pelajaran</th>
                <th>
                 <select class="kodeguru">
                   <option>Matematika</option>
                   <option>Bhs Indonesia</option>
                   <option>Fisika</option>
                   <option>Biologi</option>
                   <option>Bahasa Inggris</option> 
                 </select>
               </th>
               <th>
                 <select class="kodeguru">
                   <option>Matematika</option>
                   <option>Bhs Indonesia</option>
                   <option>Fisika</option>
                   <option>Biologi</option>
                   <option>Bahasa Inggris</option>
                 </select>
               </th>
               <th>
                 <select class="kodeguru">
                   <option>Matematika</option>
                   <option>Bhs Indonesia</option>
                   <option>Fisika</option>
                   <option>Biologi</option>
                   <option>Bahasa Inggris</option>
                 </select>
               </th>
               <th>
                 <select class="kodeguru">
                   <option>Matematika</option>
                   <option>Bhs Indonesia</option>
                   <option>Fisika</option>
                   <option>Biologi</option>
                   <option>Bahasa Inggris</option>
                 </select>
               </th>
             </tr>
             <tr>
              <th>Guru</th>
              <th>
                <select class="kodeguru">
                 <option>4</option>
                 <option>17</option>
                 <option>14</option>
                 <option>20</option>
                 <option>10</option> 
                 <option>2</option>
               </select>
             </th>
             <th>
              <select class="kodeguru">
               <option>5</option>
               <option>9</option>
               <option>10</option>
               <option>11</option>
               <option>12</option> 
               <option>13</option>
             </select>
           </th>
           <th>
            <select class="kodeguru">
             <option>1</option>
             <option>2</option>
             <option>3</option>
             <option>4</option>
             <option>5</option> 
             <option>6</option>
           </select>
         </th> 
         <th>
          <select class="kodeguru">
           <option>1</option>
           <option>2</option>
           <option>3</option>
           <option>4</option>
           <option>5</option> 
           <option>6</option>
         </select>
       </th> 
     </tr>
     <tr>
      <th>Jam Mulai</th>
      <th><input type="time" placeholder="Waktu"></th>
      <th><input type="time" placeholder="Waktu"></th>
      <th><input type="time" placeholder="Waktu"></th>
      <th><input type="time" placeholder="Waktu"></th> 
    </tr>
    <tr>
      <th>Jam Selesai</th>
      <th><input type="time" placeholder="Waktu"></th>
      <th><input type="time" placeholder="Waktu"></th>
      <th><input type="time" placeholder="Waktu"></th>
      <th><input type="time" placeholder="Waktu"></th> 
    </tr>
  </tbody>

</table>
<a href="#jadwalmapel" data-toggle="tab"><button class="btnjdwl"></i> Submit</button></a>
</div>
</div>
</div>

<!-- DATA MAPEL KELAS 7 -->
<div class="tab-pane" id="datajadwaltambahan">
  <div class="box">
    <div class="box-header" style="background-color:     #5c8a8a">
      <h3 class="box-title" style="color:white">Data Jadwal Tambahan </h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th class="fit">No</th>
            <th>Tanggal</th>
            <th>Kelas</th>
            <th>Mata Pelajaran</th>
            <th>Guru</th>
            <th>Jam Mulai</th>
            <th>Jam Selesai</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="fit">1</td>
            <th>2 Desember 2017</th>
            <th>7A</th>
            <th>IPS</th>
            <th>Sumiastuti</th>
            <th>05.30</th>
            <th>06.30</th>
            <td> <button type="button" class="btn btn-block btn-primary button-action btnedit" href="#editjadwaltambahan" data-toggle="tab"> Edit </button><button type="button" class="btn btn-block btn-primary button-action btnhapus">Hapus</button></td>               
          </tr>
          <tr>
            <td class="fit">2</td>
            <th>3 Desember 2017</th>
            <th>7B</th>
            <th>IPA</th>
            <th>Retno</th>
            <th>05.30</th>
            <th>06.30</th>
            <td> <button type="button" class="btn btn-block btn-primary button-action btnedit">Edit</button><button type="button" class="btn btn-block btn-primary button-action btnhapus">Hapus</button></td>               
          </tr>
          <tr>
            <td class="fit">3</td>
            <th>3 Desember 2017</th>
            <th>7B</th>
            <th>IPA</th>
            <th>Retno</th>
            <th>05.30</th>
            <th>06.30</th>
            <td><button type="button" class="btn btn-block btn-primary button-action btnedit">Edit</button><button type="button" class="btn btn-block btn-primary button-action btnhapus">Hapus</button></td>
          </tr>
          <tr>
            <td class="fit">4</td>
            <th>3 Desember 2017</th>
            <th>7B</th>
            <th>IPA</th>
            <th>Retno</th>
            <th>05.30</th>
            <th>06.30</th>
            <td><button type="button" class="btn btn-block btn-primary button-action btnedit">Edit</button><button type="button" class="btn btn-block btn-primary button-action btnhapus">Hapus</button></td>
          </tr>
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
          <tr class="barishari">
            <th class="tengah" rowspan="2">Keterangan</th>
            <th class="tengah" colspan="4"><select>
             <option>Desember</option>
             <option>Januari</option>
             <option>Februari</option>
             <option>Maret</option>
             <option>April</option> 
             <option>Mei</option>
           </select></th>
         </tr>
         <tr class="barishari">
          <th class="tengah">18 Desember 2016</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th>Kelas</th>
          <th><select class="kodeguru">
           <option>9A</option>
           <option>9B</option>
           <option>9C</option>
           <option>9D</option>
           <option>9E</option> 
           <option>9F</option>
         </select>
       </th>
     </tr>
     <tr>
      <th>Mata Pelajaran</th>
      <th>
       <select class="kodeguru">
         <option>Matematika</option>
         <option>Bhs Indonesia</option>
         <option>IPA</option>
         <option>IPS</option>
         <option>Bhs. Inggris</option> 
       </select>
     </th>
   </tr>
   <tr>
    <th>Guru</th>
    <th>
      <select class="kodeguru">
       <option>4</option>
       <option>17</option>
       <option>14</option>
       <option>20</option>
       <option>10</option> 
       <option>2</option>
     </select>
   </th>
 </tr>
 <tr>
  <th>Jam Mulai</th>
  <th><input type="time" placeholder="Waktu"></th>
</tr>
<tr>
  <th>Jam Selesai</th>
  <th><input type="time" placeholder="Waktu"></th> 
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
<div class="modal fade bs-example-modal-lg" id="review5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Daftar Guru Jadwal Khusus</h4>
      </div>
      <div class="modal-body">
        <form id="formPartE" class="form-horizontal style-form form-goods" method="post" action="#" enctype="multipart/form-data">
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Pilih guru :</label>
            <div class="col-sm-10">
              <ul class="titik">
                <li><input type="checkbox"> Sulaiman [23]</li>
                <li><input type="checkbox"> Sutarto [7]</li>
                <li><input type="checkbox"> Tomy [5]</li>
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

<div class="modal fade bs-example-modal-lg" id="review4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Daftar Guru Jadwal Prioritas</h4>
      </div>
      <div class="modal-body">
        <form id="formPartE" class="form-horizontal style-form form-goods" method="post" action="#" enctype="multipart/form-data">
          <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Pilih guru :</label>
            <div class="col-sm-10">
              <ul class="titik">
                <li><input type="checkbox"> Sulaiman [23]</li>
                <li><input type="checkbox"> Sutarto [7]</li>
                <li><input type="checkbox"> Tomy [5]</li>
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
</section>
<!-- /.content -->
</div>
  <!-- /.content-wrapper -->