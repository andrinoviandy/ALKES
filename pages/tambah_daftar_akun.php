<?php
if (isset($_POST['tambah_simpan'])) {
	$Result = mysqli_query($koneksi, "insert into daftar_akun values('','".$_POST['no_akun']."','".$_POST['nama']."','".$_POST['tipe']."','".$_POST['saldo']."')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Simpan !');
		window.location='index.php?page=daftar_akun'
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="active">Tambah Akun</span></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Akun (C0A)</li>
        <li class="active">Tambah Daftar Akun</li>
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
              <h3 class="box-title">Tambah <span class="active">Akun</span></h3>
            </div>
              <div class="box-body">
              <form method="post">
              <label>Tipe Akun</label>
              <select name="tipe" class="form-control" required>
                  <option> -- PILIH --</option>
                  <?php $query = mysqli_query($koneksi,"select * from tipe_akun");
                  while ($row = mysqli_fetch_array($query)) {
                  ?>
                  <option value="<?php echo $row['id'];?>"><?php echo $row['tipe_akun'];?></option>
                  <?php }?>
              </select>
              <br>
             <label>No Akun</label>
              <input type="text" name="no_akun" class="form-control" required>
              <br>
              <label>Nama</label>
              <input type="text" name="nama" class="form-control" required>
              <br />
              <label>Saldo</label>
              <input name="saldo" class="form-control" type="number" required placeholder="" value=""><br />
              <button name="tambah_simpan" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan</button>
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
  