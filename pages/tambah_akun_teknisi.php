<?php
if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "insert into akun values('','1','".$_POST['nama']."','".$_POST['username']."','".md5($_POST['password'])."')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Akun Teknisi Berhasil Di Tambah !');
		window.location='index.php?page=akun_teknisi'
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="active">User</span></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pengaturan</li>
        <li class="active">Akun</li>
        <li class="active">Teknisi</li>
        <li class="active">Tambah Akun Teknisi</li></ol></section>


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
              <h3 class="box-title">Tambah <span class="active">Akun Teknisi</span></h3>
            </div>
              <div class="box-body">
              <form method="post">
              <input name="nama" class="form-control" type="text" required placeholder="Nama Lengkap"><br />
              
              <input name="username" class="form-control" type="text" placeholder="Username" required><br />
              
              <input name="password" class="form-control" type="password" placeholder="Password" required><br />
              <input type="submit" name="tambah_laporan" id="button" value="Tambah Akun Teknisi" class="btn btn-success"/><br /><br />
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
  