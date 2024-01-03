<?php require("config/koneksi.php"); ?>
<?php 
error_reporting(0);
session_start();
if (isset($_SESSION['user_administrator']) and isset($_SESSION['pass_administrator']) or isset($_SESSION['user_customer']) and isset($_SESSION['pass_customer']) or isset($_SESSION['user_teknisi']) and isset($_SESSION['pass_teknisi']) or isset($_SESSION['user_admin_gudang']) and isset($_SESSION['pass_admin_gudang']) or isset($_SESSION['user_admin_teknisi']) and isset($_SESSION['pass_admin_teknisi'])) { 
?>
<?php 
if (isset($_POST['button_limit'])) {
	$update = mysqli_query($koneksi, "update limiter set limiter=".$_POST['limiterr']." where id=1");
	}
if (isset($_POST['button_urut'])) {
	$update = mysqli_query($koneksi, "update limiter set urut='".$_POST['urutt']."' where id=1");
	}
	
	$limiter = mysqli_fetch_array(mysqli_query($koneksi, "select * from limiter where id=1"));
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Manajemen Alat Kesehatan</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
 
    .modalDialog {
        position: absolute;
        font-family: Arial, Helvetica, sans-serif;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: rgba(0,0,0,0.8);
        z-index: 99999;
        opacity:0;
        transition: opacity 200ms ease-in;
        pointer-events: none;
		
		
    }
	.modalDialog:target {opacity:1; pointer-events: auto;}
    .modalDialog > div {
        width: 300px;
        position: relative;
        
        padding: 5px 20px 13px 20px;
        border-radius: 10px;
        background: #fff;
        background: linear-gradient(#fff, #aaa);
		margin: 3% auto;
    }
	
    .close:hover { background:#00d9ff; }
    .close {
        background: #F00;
        color: #FFFFFF;
        line-height: 25px;
        position: absolute;
        text-align: center;
        top: -10px;
        right: -12px;
        width: 24px;
        text-decoration: none;
        font-weight: bold;
        border-radius: 12px;
        box-shadow: 1px 1px 3px #000;
    }
	
	.modalDialog2 {
        position: absolute;
        font-family: Arial, Helvetica, sans-serif;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: rgba(0,0,0,0.8);
        z-index: 99999;
        opacity:0;
        transition: opacity 200ms ease-in;
        pointer-events: none;
		
    }
	.modalDialog2:target {opacity:1; pointer-events: auto;}
    .modalDialog2 > div {
        width: 700px;
        position: relative;
        
        padding: 5px 20px 13px 20px;
        border-radius: 10px;
        background: #fff;
        background: linear-gradient(#fff, #aaa);
		margin: 4% auto;
    }
	
    .close2:hover { background:#00d9ff; }
    .close2 {
        background: #F00;
        color: #FFFFFF;
        line-height: 25px;
        position: absolute;
        text-align: center;
        top: -10px;
        right: -12px;
        width: 24px;
        text-decoration: none;
        font-weight: bold;
        border-radius: 12px;
        box-shadow: 1px 1px 3px #000;
    }
     
#input {
    width: 100%;
    padding: 8px 18px;
    margin: 3px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}
#buttonn {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

    </style>
<link href='logo.png' rel='icon'>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper" >

  <header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>ALKES</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>ALAT KESEHATAN</b></span>
    </a>
    
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <?php if (!isset($_SESSION['user_customer'])) { ?>
      <div class="navbar-custom-menu pull pull-left">
        <ul class="nav navbar-nav">
        <li class="user-footer">
      <a href="download_panduan.php">* Download Panduan Pemakaian</a></li>
      </ul></div>
      <?php } ?>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- Notifications: style can be found in dropdown.less -->
          <?php if (isset($_SESSION['id_b'])) { ?>
          <li class="dropdown notifications-menu bg-yellow">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <?php
              $sdg=mysqli_num_rows(mysqli_query($koneksi, "select * from tb_maintenance,tb_teknisi where tb_teknisi.id=tb_maintenance.teknisi_id and tb_teknisi.id=".$_SESSION['id_b']." and tb_maintenance.status_proses=1 order by tgl_maintenance DESC"));
			  if ($sdg!=0) {
			  ?>
              <span class="label label-warning"><?php echo $sdg; ?></span>
              <?php } ?>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Anda mempunyai <?php echo $sdg; ?> tugas yang sedang dikerjakan</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                <?php if ($sdg!=0) { ?>
                  <?php 
				  $queryy = mysqli_query($koneksi, "select *,tb_maintenance.id as idd from tb_maintenance,tb_teknisi,tb_laporan_kerusakan,barang_gudang,barang_dijual,barang_dikirim where barang_gudang.id=barang_dijual.barang_gudang_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=tb_laporan_kerusakan.barang_dikirim_id and tb_laporan_kerusakan.id=tb_maintenance.laporan_kerusakan_id and tb_teknisi.id=tb_maintenance.teknisi_id and tb_teknisi.id=".$_SESSION['id_b']." and tb_maintenance.status_proses=1 order by tgl_maintenance DESC");
				  while ($data8 = mysqli_fetch_assoc($queryy)) {
				  ?>
                  <li>
                  <small class="label pull-right bg-green">
              <?php echo date("d F Y", strtotime($data8['tgl_maintenance'])); ?>
              </small>
                    <a href="index.php?page=detail_progress&id=<?php echo $data8['idd'] ?>">
                      <i class="fa fa-cube text-warning"></i> <?php echo $data8['nama_brg']." / ".$data8['lokasi']; ?>
                    </a>
              
                  </li>
                  
                 <?php }} ?>
                </ul>
              </li>
            </ul>
          </li>
          <!--Batass-->
          <li class="dropdown notifications-menu bg-red">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <?php
              $blm=mysqli_num_rows(mysqli_query($koneksi, "select * from tb_maintenance,tb_teknisi where tb_teknisi.id=tb_maintenance.teknisi_id and tb_teknisi.id=".$_SESSION['id_b']." and tb_maintenance.status_proses=0"));
			  if ($blm!=0) {
			  ?>
              <span class="label label-danger">
              <?php echo $blm; ?>
              </span>
              <?php } ?>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Anda mempunyai <?php echo $blm; ?> tugas belum dikerjakan</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <?php if ($blm!=0) { ?>
                  <?php 
				  $query = mysqli_query($koneksi, "select *,tb_maintenance.id as idd from tb_maintenance,tb_teknisi,tb_laporan_kerusakan,barang_gudang,barang_dijual,barang_dikirim where barang_gudang.id=barang_dijual.barang_gudang_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=tb_laporan_kerusakan.barang_dikirim_id and tb_laporan_kerusakan.id=tb_maintenance.laporan_kerusakan_id and tb_teknisi.id=tb_maintenance.teknisi_id and tb_teknisi.id=".$_SESSION['id_b']." and tb_maintenance.status_proses=0");
				  while ($data7 = mysqli_fetch_assoc($query)) {
				  ?>
                  <li>
                  <small class="label pull-right bg-green">
              <?php echo date("d F Y", strtotime($data7['tgl_maintenance'])); ?>
              </small>
                    <a href="index.php?page=detail_progress&id=<?php echo $data7['idd'] ?>">
                      <i class="fa fa-cube text-danger"></i> <?php echo $data7['nama_brg']." / ".$data7['lokasi']; ?>
                    </a>
                  </li>
                  <?php } } ?>
                </ul>
              </li>
              
            </ul>
          </li>
         
          <?php if (isset($_SESSION['id_b'])) { ?>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="logo.png" class="user-image" alt="User Image">
              <span class="hidden-xs">Teknisi</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="logo.png" class="img-circle" alt="User Image">

                <p>
                  <?php 
				  $d=mysqli_fetch_array(mysqli_query($koneksi, "select * from tb_teknisi where id=".$_SESSION['id_b'].""));
				  echo $d['nama_teknisi'];
				  ?>
                  <small>Teknisi</small>
                </p>
              </li>
              <?php } ?>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 pull pull-left">
                    <?php 
					
					echo $d['bidang']; ?>
                  </div>
                  
                  <div class="col-xs-4 pull pull-right">
                    <?php echo $d['no_hp']; ?>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  
                </div>
                <div class="pull-right">
                  <a href="proses_logout.php" class="btn btn-default btn-flat" onclick="return confirm('Yakin Akan Keluar Dari Aplikasi ?')">Logout</a>
                </div>
              </li>
            </ul>
          </li>
          <?php } ?>
          <!-- Control Sidebar Toggle Button -->
         <?php if (!isset($_SESSION['id_b'])) { ?>
          <li>
            <a href="proses_logout.php" title="Logout" onclick="return confirm('Yakin Akan Keluar Dari Aplikasi ?')"><i class="fa fa-close"></i> Logout</a>
          </li>
          <?php } ?>
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <?php 
  if (isset($_SESSION['user_administrator']) and isset($_SESSION['pass_administrator'])) {
  require('sidebar.php'); 
  } 
  else if (isset($_SESSION['user_customer']) and isset($_SESSION['pass_customer'])) {
	  require('sidebar_user.php');
	  } 
else if (isset($_SESSION['user_teknisi']) and isset($_SESSION['pass_teknisi'])) {
			  require('sidebar_teknisi.php');
  } 
  else if (isset($_SESSION['user_admin_gudang']) and isset($_SESSION['pass_admin_gudang'])) {
			  require('sidebar_admin_gudang.php');
  }
  else if (isset($_SESSION['user_admin_teknisi']) and isset($_SESSION['pass_admin_teknisi'])) {
			  require('sidebar_admin_teknisi.php');
  }
  ?>

  <!-- Content Wrapper. Contains page content -->
  <?php 
  if (isset($_GET['page'])) {
	  include "pages/".$_GET['page'].".php";
	  }
	  
	  else {
		  echo "<script>
		  window.location='index.php?page=beranda';
		  </script>";
		  } 
		  ?>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>


<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
        
</body>
</html>
<?php } else {
	echo "<script type='text/javascript'>
	window.location='login.php';
	</script>";
	} ?>
