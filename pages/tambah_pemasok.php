<?php
if (isset($_POST['tambah_header'])) {
	$Result = mysqli_query($koneksi, "insert into principle values('','".$_POST['nama_pemasok']."','".$_POST['alamat']."','".$_POST['telp']."','".$_POST['fax']."','".$_POST['attn']."')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Simpan !');
		window.location='index.php?page=pemasok'
		</script>";
		}else{
            echo "<script type='text/javascript'>
		alert('Data Gagal Di Simpan !');
		window.location='index.php?page=pemasok'
		</script>";
        }
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="active">Tambah Pemasok</span></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pemasok</li>
        <li class="active">Tambah Pemasok</li>
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
              <h3 class="box-title">Tambah <span class="active">Pemasok</span></h3>
            </div>
              <div class="box-body">
              <form method="post">
              <label>Nama Pemasok</label>
              <input name="nama_pemasok" class="form-control" type="text" placeholder="" value=""><br />
              <label>Alamat</label>
              <textarea name="alamat" class="form-control"></textarea><br />
              <label>Telepon</label>
              <input name="telp" class="form-control" type="text" placeholder=""><br />
              <label>Fax.</label>
              <input name="fax" class="form-control" type="text" placeholder=""><br />
              <label>Attn</label>
              <input name="attn" class="form-control" type="text" placeholder=""><br />
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
  