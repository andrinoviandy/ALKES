<?php
if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "update akun set nama='".$_POST['nama']."', username='".$_POST['user']."', password='".$_POST['pass']."' where id=".$_GET['id']."");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Akun Teknisi Berhasil Di Ubah !');
		window.location='index.php?page=akun_teknisi'
		</script>";
		}
	}

$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from akun where id=".$_GET['id'].""));
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="active">User</span></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pengaturan</li>
        <li class="active">Akun</li>
        <li class="active">User</li>
        <li class="active">Ubah User</li>
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
              <h3 class="box-title">Ubah <span class="active">User</span></h3>
            </div>
              <div class="box-body">
              <form method="post">
              <label>Nama User</label>
              <input name="nama" class="form-control" type="text" required placeholder="" value="<?php echo $data['nama']; ?>"><br />
             <label>Username</label>
              <input name="user" class="form-control" type="text" placeholder="" required value="<?php echo $data['username']; ?>"><br />
              <label>Password</label>
              <input name="pass" class="form-control" type="text" placeholder="Ketik Ulang Atau Password Baru" required value=""><br />
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
  