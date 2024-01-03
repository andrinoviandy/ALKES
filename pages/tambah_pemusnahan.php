<?php
if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "insert into master_barang values('','".$_POST['nama_barang']."','".$_POST['tipe']."','".$_POST['merk']."','".$_POST['no_seri']."','".$_POST['nie']."','".$_POST['negara_asal']."','".$_POST['stok']."')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Barang Berhasil Di Tambah !');
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pemusnahan
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pemusnahan Alkes</li></ol></section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Data Pemusnahan Alkes</h3>
            </div>
              <div class="box-body">
              <a href="index.php?page=tambah_pemusnahan_dalam">
              <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h4><strong>Alkes Dari Dalam</strong></h4>

              <p>Klik Disini</p>
            </div>
          </div>
        </div>
            </a>
            <a href="index.php?page=tambah_pemusnahan_luar">
              <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h4><strong>Alkes Dari Luar</strong></h4>

              <p>Klik Disini</p>
            </div>
          </div>
        </div>
            </a>
              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

          <!-- Map box --><!-- /.box -->

          <!-- solid sales graph --><!-- /.box -->

          <!-- Calendar --><!-- /.box -->

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

  </section>
    <!-- /.content -->
  </div>
  