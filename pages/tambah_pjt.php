<?php
if (isset($_POST['tambah_laporan'])) {
	$dat=mysqli_num_rows(mysqli_query($koneksi, "select * from pjt where username='".$_POST['user']."' and password='".md5($_POST['pass'])."'"));
	if ($dat==0) {
	$Result = mysqli_query($koneksi, "insert into pjt values('','".$_POST['nama']."','".$_POST['user']."','".md5($_POST['pass'])."')");
		if ($Result) {
			echo "<script type='text/javascript'>
			alert('Data Berhasil Di Tambah !');
			window.location='index.php?page=pjt'
			</script>";
			}
	} else {
		echo "<script type='text/javascript'>
			alert('Maaff ,Inputan Username & Password Sudah Ada !');
			</script>";
		}
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Penanggung Jawab Teknis
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pengaturan</li>
        <li class="active">Akun</li>
        <li class="active">Penanggung Jawab Teknis</li>
        <li class="active">Tambah Penanggung Jawab Teknis</li>
      </ol>
    </section>


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
              <h3 class="box-title">Tambah Penanggung Jawab Teknis</h3>
            </div>
              <div class="box-body">
              <form method="post" enctype="multipart/form-data">
              Nama
              <input name="nama" class="form-control" type="text" required placeholder=""><br />
              Username
              <input name="user" class="form-control" type="text" placeholder="" required><br />
              Password
              <input name="pass" class="form-control" type="password" placeholder="" required><br />
              <input type="submit" name="tambah_laporan" id="button" value="Simpan" class="btn btn-success"/><br /><br />
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
  