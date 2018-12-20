 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <center style="color:grey;">Distribusi Kelas Reguler<br></center>
      <center><small>Tahun Ajaran 2016-2017 Kurikulum 2013</small></center> </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>superadmin">Dashboard</a></li>
      </ol>
    </section>

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
            if ($this->session->userdata('jabatan') == 'Admin') {
              ?>
              <li class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="false">Buat Kelas Baru</a>
              </li>
              <?php
            }
            ?>

            <li><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Tambah Kelas</a>
            </li>
          </ul>

          <div id="myTabContent" class="tab-content">

            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
              
              <form class="form-horizontal form-mapel" method="post" action="<?php echo base_url('superadmin/pembagian'); ?>">
                <div class="bigbox-mapel"> 
                  <div class="box-mapel">
                   <div class="form-group formgrup jarakform">
                    <label class="control-label col-md-3" for="first-name">Jumlah Kelas <span class="required">*</span>
                    </label>
                    <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                      <input type="text" class="form-control" name="jumlah_kelas">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Nama Kelas</label>
                    <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                      <select class="form-control" name="jenjang">
                        <option value="">- Pilih Jenjang -</option>
                        <option value="7">Kelas 7</option>
                        <option value="8">Kelas 8</option>
                        <option value="9">Kelas 9</option>
                        
                      </select>
                    </div>
                    <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                      <select class="form-control" name="penamaan">
                        <option value="">- Pilih Penamaan -</option>
                        <option value="angka">Angka (1,2,3,..)</option>
                        <option value="huruf">Huruf (A,B,C,..)</option>
                        <option value="romawi">Romawi (I,II,III,..)</option>
                        
                      </select>
                    </div>
                        <!-- <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                          <input type="text" class="form-control" id="first-name" placeholder="Nama Alias Kelas">
                        </div> -->
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3">Pilih Pembagian Kelas</label>
                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                         <input type="submit" class="btn btn-primary" name="btntipe" value="Berdasarkan Agama dan Jenis Kelamin">
                       </div>
                     </div>
                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                      <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                       <input type="submit" class="btn btn-primary" name="btntipe" value="Berdasarkan Prestasi">
                     </div>
                   </div>
                 </form>
               </div>
             </div>
           </form>
         </div>
         <!-- end tab 1 -->
         <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
          <div class="row">
            <div class="col-sm-6">
              <div class="dataTables_length" id="example1_length">
                <label>Kelas 7 <select name="example1_length" aria-controls="example1" class="form-control input-sm">
                  <option>Kelas 8</option>
                  <option>Kelas 9</option>
                  <!-- <option>Kelas Tambahan</option> -->
                </select> entries
              </label>
            </div>
          </div>
          <div class="col-sm-6">
            <div id="example1_filter" class="dataTables_filter">
              <label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1">
              </label>
            </div>
          </div>
        </div>
        
        <table class="table table-striped projects">
          <thead>
            <tr>
              <th style="width: 1%"></th>
              <th style="width: 1%">No</th>
              <th style="width: 5%">Nama Kelas</th>
              <th style="width: 5%">Jumlah Siswa</th>
              <th style="width: 5%">Wali Kelas</th>
              <th style="width: 5%"></th>

              
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input type="checkbox" class="flat" name="table_records"></td>
              <td>1</td>
              <td>Kelas 7A</td>
              <td></td>
              <td>
               <select class="form-control">
                <option>- Pilih Wali Kelas -</option>
                <option>Nadya</option>
                <option>Indi</option>
                <option>Rahesti</option>
                
              </select> 
            </td>
            <td>
              <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
            </td>
          </tr>
          <tr>
            <td><input type="checkbox" class="flat" name="table_records"></td>
            <td>2</td>
            <td>Kelas 7B</td>
            <td></td>   
            
            <td>
             <select class="form-control">
              <option>- Pilih Wali Kelas -</option>
              <option>Nadya</option>
              <option>Indi</option>
              <option>Rahesti</option>
              
            </select> 
          </td>
          <td>
            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
          </td>
          
        </tr>
        <tr>
          <td><input type="checkbox" class="flat" name="table_records"></td>
          <td>3</td>
          <td>Kelas 7C</td>
          <td></td>   
          
          <td>
           <select class="form-control">
            <option>- Pilih Wali Kelas -</option>
            <option>Nadya</option>
            <option>Indi</option>
            <option>Rahesti</option>
            
          </select> 
        </td>
        <td>
          <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
        </td>
        
      </tr>
      <tr>
        <td><input type="checkbox" class="flat" name="table_records"></td>
        <td>4</td>
        <td>Kelas 7D</td>
        <td></td>   
        
        <td>
         <select class="form-control">
          <option>- Pilih Wali Kelas -</option>
          <option>Nadya</option>
          <option>Indi</option>
          <option>Rahesti</option>
          
        </select> 
      </td>
      <td>
        <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
      </td>
    </tr>
    <tr>
      <td><input type="checkbox" class="flat" name="table_records"></td>
      <td>5</td>
      <td>Kelas 7E</td>
      <td></td>   
      
      <td>
       <select class="form-control">
        <option>- Pilih Wali Kelas -</option>
        <option>Nadya</option>
        <option>Indi</option>
        <option>Rahesti</option>
        
      </select> 
    </td>
    <td>
      <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
    </td>
  </tr>
  
</tbody>


</table>
<?php
if ($this->session->userdata('jabatan') == 'Admin') {
  ?>
  
  
  <div class="tambahkelas">
   <i class="fa fa-plus-circle text-red"></i><a style="color:red" href="#" id="tambahkelas"> Tambah kelas</a>
   
 </div>
 <?php
}
?>
&nbsp
&nbsp


<div class="bagikelas">
 <label class="control-label">Pilih Pembagian Kelas</label>
 <a href="<?php echo site_url('superadmin/pembagian_agama'); ?>"><button type="button" class="btn btn-primary">Agama</button></a>
 <a href="<?php echo site_url('superadmin/pembagian_prestasi'); ?>"><button type="button" class="btn btn-primary">Prestasi</button></a>
 
</div>



</div>
</div>

<!-- /.nav-tabs-custom -->
</div>
<!-- /.col -->
</div>
<!-- /.row (main row) -->

</section>

<!-- /.content -->
</div>