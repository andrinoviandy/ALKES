<?php
if (isset($_POST['tambah_laporan'])) {
	$_SESSION['nama_akse']=$_POST['nama_akse'];
	$_SESSION['merk']=$_POST['merk'];
	$_SESSION['tipe']=$_POST['tipe'];
	$_SESSION['nie']=$_POST['nie'];
	$_SESSION['negara_asal']=$_POST['negara_asal'];
	
	$_SESSION['deskripsi']=$_POST['deskripsi'];
	echo "<script type='text/javascript'>
	window.location='index.php?page=simpan_tambah_barang_set';
		</script>";
	/*$Result = mysqli_query($koneksi, "insert into aksesoris values('','".$_POST['tgl_masuk']."','".$_POST['no_po']."','".$_POST['nama_akse']."','".$_POST['merk']."','".$_POST['tipe']."','".$_POST['no_seri']."','".$_POST['stok']."', '".$_POST['deskripsi']."','".$_POST['harga_beli']."','".$_POST['harga_satuan']."')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Tambah !');
		</script>";
		} */
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Barang Set
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Barang Set</li>
        <li class="active">Tambah Barang Set</li></ol></section>


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
              <h3 class="box-title">Tambah Barang Set</h3>
            </div>
              <div class="box-body">
              <form method="post">
              Nama Barang
                <input name="nama_akse" class="form-control" type="text" required placeholder="Nama Barang" ><br />
              Merk
              <input name="merk" class="form-control" type="text" placeholder="Merk" ><br />
              Tipe
              <input name="tipe" class="form-control" type="text" placeholder="Tipe" ><br />
              NIE (Nomor Ijin Edar)
              <input name="nie" class="form-control" type="text" placeholder="NIE" ><br />
              Negara Asal
              <input name="negara_asal" class="form-control" type="text" placeholder="Negara Asal" required ><br />
              Deskripsi
              <textarea name="deskripsi" class="form-control" type="text" rows="5" placeholder="Deskripsi Alat" ></textarea><br />
              
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Next</button>
              
              <br /><br />
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
  