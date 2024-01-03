<?php
if (isset($_POST['tambah_header'])) {
	$Result = mysqli_query($koneksi, "INSERT into pelanggan values('','$_POST[nama_pelanggan]','$_POST[alamat_penagihan]','".$_POST['alamat_pengiriman']."','".$_POST['email']."')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Simpan !');
		window.location='index.php?page=pelanggan'
		</script>";
		}else{
            echo "<script type='text/javascript'>
		alert('Data gagal Di Simpan !');
		window.location='index.php?page=pelanggan'
		</script>";
        }
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="active">Tambah Pelanggan</span></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pelanggan</li>
        <li class="active">Tambah Pelanggan</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-5 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah <span class="active">Pelanggan</span></h3>
            </div>
              <div class="box-body">
              <form method="post">
              <label>Nama Pelanggan</label>
              <input name="nama_pelanggan" class="form-control" type="text" placeholder="" required="required"><br />
              <label>Alamat Penagihan</label>
              <input type="text" name="alamat_penagihan" class="form-control" required="required">
              <br /> 
              <label>Alamat Pengiriman</label>
              <textarea name="alamat_pengiriman" class="form-control"></textarea><br />
              <label>email</label>
              <input type="email" name="email" class="form-control">
              <br />
              <button name="tambah_header" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan</button>
        </form>
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
  