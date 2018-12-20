<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Informasi SMP</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/kesiswaan/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/kesiswaan/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/kesiswaan/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/kesiswaan/plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/kesiswaan/plugins/morris/morris.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/kesiswaan/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/kesiswaan/plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/kesiswaan/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/kesiswaan/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/kesiswaan/css/style.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/kesiswaan/sweetalert/sweetalert.css'); ?>">

  <style type="text/css">
  .btn-custom {
    background: none;
    border: none;
    width: 100%;
    text-align: left;
    padding: 8px;
  }
  .btn-custom:hover {
    background: #efefef;
  }
  </style>

</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <a href="index2.html" class="logo">
        <span class="logo-lg"><b>SI</b>SMP</span>
      </a>
      <nav class="navbar navbar-static-top">
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo base_url(); ?>assets/kesiswaan/image/admin.png" class="user-image" alt="User Image">
                <span class="hidden-xs">Admin</span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <img src="<?php echo base_url(); ?>assets/kesiswaan/image/admin.png" class="img-circle" alt="User Image">
                  <p>
                    Anggraeni Dias Saputri
                    <small>SIA 2 13523039</small>
                  </p>
                </li>
                <li class="user-body pdg">
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo site_url('kesiswaan/logout'); ?>" class="btn btn-default btn-flat">Log out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>    

    <!--       INI BUKA DARI MENU      -->
    <aside class="main-sidebar">
      <section class="sidebar">
        <ul class="sidebar-menu">
          <li class="header">KESISWAAN</li>
          <li class="treeview active">
            <a href="#">
              <i class="fa fa-dashboard"></i> <span>Kesiswaan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu active">
              <li class="active"><a href="#"><i class="fa fa-circle-o"></i>Penerimaan Peserta Didik Baru</a>
               <ul class="treeview-menu">
                <li class="active"><a href="<?php echo base_url(); ?>kesiswaan/admin/pendaftar_jalur_ujian"><i class="fa fa-circle-o text-red"></i> Jalur Ujian</a></li>
                <li class="active"><a href="<?php echo base_url(); ?>kesiswaan/admin/pendaftar_jalur_un"><i class="fa fa-circle-o text-red"></i> Jalur UN</a></li>
              </ul>
            </li>
            <li class="active"><a href="#"><i class="fa fa-circle-o"></i>Daftar  Ulang</a>
             <ul class="treeview-menu active">
                <li class="active"><a href="<?php echo base_url(); ?>kesiswaan/admin/daftarulang_ppdb"><i class="fa fa-circle-o text-red"></i>Peserta Didik Baru</a></li>
                <li class="active"><a href="<?php echo base_url(); ?>kesiswaan/admin/daftarulang_kenaikan"><i class="fa fa-circle-o text-red"></i>Kelas</a></li>
              </ul>
            </li>
            <li ><a href="#"><i class="fa fa-circle-o"></i> Distribusi Kelas </a>
              <ul class="treeview-menu">
                <li ><a href="#"><i class="fa fa-circle-o text-red"></i>Kelas Reguler</a></li>
                <li ><a href="#"><i class="fa fa-circle-o text-red"></i>Kelas Tambahan</a></li>
              </ul>
            </li>
            <li ><a href="#"><i class="fa fa-circle-o"></i> Mutasi </a>
            <ul class="treeview-menu">
                <li ><a href="#"><i class="fa fa-circle-o text-red"></i>Mutasi Masuk</a></li>
                <li ><a href="#"><i class="fa fa-circle-o text-red"></i>Mutasi Keluar</a></li>
              </ul>
            </li>
          </li>
          <li class="active"><a href="<?php echo base_url(); ?>kesiswaan/admin/buku_induk"><i class="fa fa-circle-o"></i> Buku Induk </a>
          </li>
        </ul>
      </li>
    </ul>
  </section>
</aside>
<!--       INI TUTUP DARI MENU      -->


<!-- Content Wrapper. Contains page content -->
<?php echo $contents; ?>       


<script type="text/javascript" src="<?php echo base_url('assets/kesiswaan/sweetalert/sweetalert.min.js'); ?>"></script>
<script src="<?php echo base_url(); ?>assets/kesiswaan/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url(); ?>assets/kesiswaan/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/kesiswaan/bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<!-- Sparkline -->
<script src="<?php echo base_url(); ?>assets/kesiswaan/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url(); ?>assets/kesiswaan/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/kesiswaan/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url(); ?>assets/kesiswaan/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url(); ?>assets/kesiswaan/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/kesiswaan/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url(); ?>assets/kesiswaan/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url(); ?>assets/kesiswaan/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url(); ?>assets/kesiswaan/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/kesiswaan/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/kesiswaan/dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/kesiswaan/dist/js/demo.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/kesiswaan/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/kesiswaan/plugins/datatables/dataTables.bootstrap.min.js"></script>
</body>

<script> //JAVASCRIPT
  function showButton() {
    var checked = $('.checkNisn:checked').length > 0;
      if (checked) {
        $('.btn-wrap').css('visibility','visible');
      } else {  
        $('.btn-wrap').css('visibility','hidden');
      }
  }

  $(document).ready(function() {
    $('.aku').click(function() {
      console.log('Aku');
    });
  });
  
    // Menampilkan tab sekarang saat reload halmaan
    // Membuka tab
    $('.nav-tabs a').click(function(e) {
      e.preventDefault();
      $(this).tab('show');
    });
    $('ul.nav-tabs > li > a').on('shown.bs.tab', function(e) {
      var id = $(e.target).attr('href').substr(1);
      window.location.hash = id;
    });
    var hash = window.location.hash;
    $('.nav-tabs a[href="' + hash + '"]').tab('show');

    $('.check-all').click(function() {
      var checkbox = $('.checkNisn');
      checkbox.prop('checked', !checkbox.prop('checked'));
      showButton();
    });

    $('.filter-tahun-un').change(function() {
      var val = $(this).val();
      document.location.href= '/kesiswaan/admin/pendaftar_jalur_un?tahun_ajaran='+val+'#tab_pendaftar';
    });
 
    $('.filter-tahun-un-grade').change(function() {
      var val = $(this).val();
      document.location.href= '/kesiswaan/admin/pendaftar_jalur_un?tahun_ajaran='+val+'#tab_grade';
    });

    $('.filter-tahun-un-lolos').change(function() {
      var val = $(this).val();
      document.location.href= '/kesiswaan/admin/pendaftar_jalur_un?tahun_ajaran='+val+'#tab_lolos';
    });

    $('.filter-tahun-ujian').change(function() {
      var val = $(this).val();
      document.location.href= '/kesiswaan/admin/pendaftar_jalur_ujian?tahun_ajaran='+val+'#tab_pendaftar';
    });

    $('.filter-tahun-ujian-lolos').change(function() {
      var val = $(this).val();
      document.location.href= '/kesiswaan/admin/pendaftar_jalur_ujian?tahun_ajaran='+val+'#tab_lolos';
    });

     $('.filter-tahun-duppdb').change(function() {
      var val = $(this).val();
      document.location.href= '/kesiswaan/admin/daftarulang_ppdb?tahun_ajaran='+val+'#tab_content3';
    });

     $('.filter-tahun-duk').change(function() {
      var val = $(this).val();
      document.location.href= '/kesiswaan/admin/daftarulang_kenaikan?tahun_ajaran='+val+'#tab_content2';
    });


    // Filter tahun ajaran buku induk
    $('.filter-tahun').change(function() {
      var val = $(this).val();
      console.log(val);

      if (val != '') {
        var rex = new RegExp(val, 'i');;
        $('.searchable tr').hide();
        $('.searchable tr').filter(function () {
            return rex.test($(this).text());
        }).show();
      } else {
        $('.searchable tr').show();
      }
    });

    $('.checkNisn').click(function() {
      showButton();
    });

  $(function () {
    $("#example1").DataTable();
    $(".examples").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });

   $(document).ready(function() {
        $('#nilai_bahasa_indo, #nilai_presensi, #nilai_matematika, #nilai_ipa').on('keyup keydown keypress', function(){
            var nilai_bahasa_indo = $('#nilai_bahasa_indo').val() != "" ? parseInt($('#nilai_bahasa_indo').val()) : 0;
            var nilai_presensi = $('#nilai_presensi').val() != "" ? parseInt($('#nilai_presensi').val()) : 0;
            var nilai_matematika = $('#nilai_matematika').val() != "" ? parseInt($('#nilai_matematika').val()) : 0;
            var nilai_ipa = $('#nilai_ipa').val() != "" ? parseInt($('#nilai_ipa').val()) : 0;

            var total = nilai_bahasa_indo + nilai_presensi + nilai_matematika + nilai_ipa;

            $('#nilai_total').val(total);
        });
    });
   
</script>
</html>

