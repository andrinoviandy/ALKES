<?php
$data=mysqli_fetch_array(mysqli_query($koneksi, "select * from karyawan where id=".$_GET['id_ubah'].""));
if (isset($_POST['tambah_header'])) {
    $Result = mysqli_query($koneksi, "update karyawan set nik='$_POST[nik]',nama_karyawan='$_POST[nama_karyawan]',tempat_lahir='$_POST[tempat_lahir]',tanggal_lahir='$_POST[tanggal_lahir]',alamat='$_POST[alamat]',pendidikan_terakhir='$_POST[pendidikan_akhir]',jabatan='$_POST[jabatan]',divisi='$_POST[divisi]',tanggal_masuk='$_POST[tgl_masuk]',email='$_POST[email]' where id=$_GET[id_ubah]");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Ubah !');
		window.location='index.php?page=karyawan'
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="active">Ubah Karyawan</span></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Karyawan</li>
        <li class="active">Ubah Karyawan</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Ubah <span class="active">Karyawan</span></h3>
            </div>
              <div class="box-body">
              <form method="post">
              <label>NIK</label>
              <input name="nik" class="form-control" type="text" placeholder="" value="<?php echo $data['nik']; ?>" required autofocus="autofocus"><br />
              <label>Nama Karyawan</label>
              <input name="nama_karyawan" class="form-control" type="text" placeholder="" value="<?php echo $data['nama_karyawan']; ?>" required="required"><br />
              <label>Tempat Lahir</label>
              <input name="tempat_lahir" class="form-control" type="text" placeholder="" value="<?php echo $data['tempat_lahir']; ?>"><br />
              <label>Tanggal Lahir</label>
              <input name="tanggal_lahir" class="form-control" type="date" placeholder="" value="<?php echo $data['tanggal_lahir']; ?>"><br />
              <label>Alamat</label>
              <textarea name="alamat" class="form-control" placeholder=""><?php echo $data['alamat']; ?></textarea>
              <br />
              <label>Pendidikan Terakhir</label>
              <input name="pendidikan_akhir" class="form-control" type="text" placeholder="" value="<?php echo $data['pendidikan_terakhir']; ?>"><br />
              <label>Jabatan</label>
              <input name="jabatan" class="form-control" type="text" placeholder="" value="<?php echo $data['jabatan']; ?>">
              <br />
              <label>Divisi</label>
              <input name="divisi" class="form-control" type="text" placeholder="" value="<?php echo $data['divisi']; ?>">
              <br />
              <label>Tanggal Masuk</label>
              <input name="tgl_masuk" class="form-control" type="date" placeholder="" value="<?php echo $data['tanggal_masuk']; ?>"><br />
              <label>Email</label>
              <input name="email" class="form-control" type="email" placeholder="" value="<?php echo $data['email']; ?>"><br />
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
        <section class="col-lg-6 connectedSortable"></section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

  </section>
    <!-- /.content -->
  </div>
  