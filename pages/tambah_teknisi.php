<?php
if (isset($_POST['tambah_laporan'])) {
	$dat=mysqli_num_rows(mysqli_query($koneksi, "select * from tb_teknisi where nama_teknisi='".$_POST['nama_teknisi']."'"));
	if ($dat==0) {
	$Result = mysqli_query($koneksi, "insert into tb_teknisi values('','".$_POST['nama_teknisi']."','".$_POST['bidang']."','".$_POST['no_str']."','".$_POST['no_hp']."','".$_POST['username']."','".md5($_POST['password'])."','".$_POST['nama_teknisi']."-".$_FILES['ijazah']['name']."','".$_POST['nama_teknisi']."-".$_FILES['sertifikat']['name']."')");
	if ($Result) {
		copy($_FILES['ijazah']['tmp_name'], "ijazah_teknisi/".$_POST['nama_teknisi']."-".$_FILES['ijazah']['name']);
		copy($_FILES['sertifikat']['tmp_name'], "ijazah_teknisi/sertifikat/".$_POST['nama_teknisi']."-".$_FILES['sertifikat']['name']);
		echo "<script type='text/javascript'>
		alert('Data Teknisi Berhasil Di Tambah !');
		window.location='index.php?page=teknisi'
		</script>";
		}
	}
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Teknisi
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pengaturan</li>
        <li class="active">Akun</li>
        <li class="active">Teknisi</li>
        <li class="active">Tambah Teknisi</li>
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
              <h3 class="box-title">Tambah Teknisi</h3>
            </div>
              <div class="box-body">
              <form method="post" enctype="multipart/form-data">
              <label>Nama Teknisi</label>
              <input name="nama_teknisi" class="form-control" type="text" required placeholder="Nama Teknisi"><br />
              <label>Bidang / Keahlian</label>
              <input name="bidang" class="form-control" type="text" placeholder="Bidang" required><br />
              <label>No STR</label>
              <input name="no_str" class="form-control" type="text" placeholder="No STR" required><br />
              <label>No HP</label>
              <input name="no_hp" class="form-control" type="text" placeholder="No HP" required><br />
              <label>Username</label>
              <input name="username" class="form-control" type="text" placeholder="Username" required><br />
              <label>Password</label>
              <input name="password" class="form-control" type="password" placeholder="Password" required><br />
              <label>Ijazah (format : image)</label>
              <input name="ijazah" class="form-control" type="file" /><br />
              <label>Sertifikat (format : image)</label>
              <input name="sertifikat" class="form-control" type="file" /><br />
              <input type="submit" name="tambah_laporan" id="button" value="Tambah Teknisi" class="btn btn-success"/><br /><br />
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
  