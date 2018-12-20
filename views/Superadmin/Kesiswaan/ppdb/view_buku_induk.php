<div class="content-wrapper">
  <div style="overflow-y: scroll; height: 600px">
    <section class="content-header">
      <h1><center style="color:navy;"><b>Buku Induk Siswa</b><br></center><br></h1>
    </section>
    <section class="content">
  
    <?php echo $this->session->userdata('status'); ?>  <!-- siswa -->
    <?php echo $this->session->userdata('siswa'); ?>  <!-- siswa -->
    <?php echo $this->session->userdata('orangtua'); ?>  <!-- formulir aktif -->
    <?php echo $this->session->userdata('wali'); ?>  <!-- formulir aktif -->

    <form method="post" action="<?php echo site_url('kesiswaan/admin/buku_induk/ubahstatus');?>">  
      <div class="col-md-12">
        <div class="nav-tabs-custom"><br>
          <div class="row">
            <div class="col-sm-4">
              <div class="dataTables_length" id="example1_length">
                <div class="form-group btn-ubah-status" style="display: none;">
                  Ubah Status siswa
                  <input onclick="return confirm('Apakah anda ingin mengubah status siswa menjadi Aktif?');" type="submit" name="button" value="Aktif" class="btn btn-primary btn-xs"/>
                  <input onclick="return confirm('Apakah anda ingin mengubah status siswa menjadi Lulus?');" type="submit" name="button" value="Lulus" class="btn btn-success btn-xs"/>
                  <input onclick="return confirm('Apakah anda ingin mengubah status siswa menjadi Keluar?');" type="submit" name="button" value="Keluar" class="btn btn-danger btn-xs"/>
                </div>
              </div>
            </div>
          </div>
          <div id="myImpor" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Import</h4>
                </div>
              <div class="modal-body"></div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-8">
              <a data-toggle="modal" class="btn btn-default pull-left" data-show="true" href="<?php echo site_url('kesiswaan/admin/buku_induk/impordata'); ?>" data-target="#myImpor" style="margin-left: 10px;">
                <i class="fa fa-cloud-download text-blue" aria-hidden="true"></i> Import Data
              </a>
              <div class="btn-wrap pull-left" style="margin-left: 10px; visibility: hidden;">
                <button type="submit" name="export" value="export" class="btn btn-default btn-ngumpet"><i class="fa fa-print text-red "></i> Export Data</button> 
                <div class="dropdown" style="display: inline-block; margin-left: 8px;">
                  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ubah Status
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <li><input onclick="return confirm('Apakah anda ingin mengubah status siswa menjadi Aktif?');" type="submit" name="button" value="Aktif" class="btn-custom"/></li>
                    <li><input onclick="return confirm('Apakah anda ingin mengubah status siswa menjadi Lulus?');" type="submit" name="button" value="Lulus" class="btn-custom"/></li>
                    <li><input onclick="return confirm('Apakah anda ingin mengubah status siswa menjadi Keluar?');" type="submit" name="button" value="Keluar" class="btn-custom"/></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="pull-right" style="margin-right: 10px">
                <select class="form-control filter-tahun" name="id_tahunajaran">
                  <option value="">Tahun Ajaran</option>
                  <?php foreach ($tahun_ajaran as $key => $value) 
                  { ?> <option value="<?php echo $value->tahun_ajaran ?>"><?php echo $value->tahun_ajaran ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div><br>
          <table class="table table-striped projects examples">
          <thead>
            <tr>
              <th width="10"><input type="checkbox" class="check-all"></th>
              <th width="10">No</th>
              <th width="130">Th Angkatan <i class="fa fa-caret-down" aria-hidden="true"></i> </th>
              <th width="100">NISN <i class="fa fa-caret-down" aria-hidden="true"></i> </th>
              <th>Nama <i class="fa fa-caret-down" aria-hidden="true"></i> </th>
              <th width="100">Tgl Lahir</th>
              <th width="90">Status <i class="fa fa-caret-down" aria-hidden="true"></i> </th>
              <th width="230">Informasi Lebih Lengkap</th>
            </tr>
          </thead>
          <tbody class="searchable">
            <?php 
            $i=1;
            foreach ($tabel_siswa as $row) {
              ?>
              <tr>
                <td><input type="checkbox" class="flat checkNisn" name="nisn_ubah[]" value="<?php echo $row->nisn; ?>"></td>
                <td><?php echo $i; ?></td>
                <td><?php echo $row->tahun_ajaran; ?></td>
                <td><?php echo $row->nisn; ?></td>
                <td><?php echo $row->nama; ?></td>
                <td><?php echo $row->tanggal_lahir; ?></td>
                <td><?php echo $row->status_siswa; ?></td>
                <td>                        
                  <a data-toggle="modal" class="btn btn-default btn-xs" data-show="true" href="<?php echo site_url('kesiswaan/admin/buku_induk/editsiswa/'.$row->nisn); ?>" data-target="#mySiswa<?php echo $i; ?>"><i class="fa fa-pencil text-red" aria-hidden="true"></i> Siswa</a>
                  <a data-toggle="modal" class="btn btn-default btn-xs" data-show="true" href="<?php echo site_url('kesiswaan/admin/buku_induk/editsiswaortu/'.$row->nisn); ?>" data-target="#myOrtu<?php echo $i; ?>"><i class="fa fa-pencil text-blue" aria-hidden="true"></i> Orang Tua</a>               
                  <a data-toggle="modal" class="btn btn-default btn-xs" data-show="true" href="<?php echo site_url('kesiswaan/admin/buku_induk/editsiswawali/'.$row->nisn); ?>" data-target="#myWali<?php echo $i; ?>"><i class="fa fa-pencil text-green" aria-hidden="true"></i> Wali</a>
                </td>
              </tr>
              <?php
              $i=$i+1;
            }
            ?>
          </tbody>
        </table>
      </form>
    </div>
    <?php 
    $i=1;
    foreach ($tabel_siswa as $row) 
    {
      ?>
      <div id="mySiswa<?php echo $i; ?>" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Data Siswa</h4>
            </div>
          <div class="modal-body"></div>
          </div>
        </div>
      </div> 
      <div id="myOrtu<?php echo $i; ?>" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Data Siswa</h4>
            </div>
          <div class="modal-body"></div>
          </div>
        </div>
      </div>
      <div id="myWali<?php echo $i; ?>" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Data Siswa</h4>
            </div>
          <div class="modal-body"></div>
          </div>
        </div>
      </div>
      <?php
      $i=$i+1;
      }
      ?><br>
      </div>
    </section>
  </div>
</div>