<?php
if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "insert into barang_gudang values('','".$_POST['nama_barang']."','".$_POST['tipe']."','".$_POST['merk']."','".$_POST['nie']."', '".$_POST['no_bath']."', '".$_POST['no_lot']."','".$_POST['negara_asal']."','".$_POST['stok']."', '".$_POST['deskripsi']."','".$_POST['harga_beli']."','".$_POST['harga_satuan']."','0')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Tambah !');
		</script>";
		}
	}
if (isset($_POST['tambah_aksesoris'])) {
	$Result = mysqli_query($koneksi, "insert into barang_inventory values('','".$_POST['nama_barang']."','".$_POST['nie']."','".$_POST['tipe']."','".$_POST['merk']."','".$_POST['negara_asal']."','".$_POST['qty']."', '".$_POST['deskripsi']."','".$_POST['harga_beli']."','".$_POST['harga_satuan']."','0')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Berhasil disimpan !');
		window.location='index.php?page=barang_inventory';
		</script>";
	//}
	/*$_SESSION['nama_barang']=$_POST['nama_barang'];
	$_SESSION['nie_brg']=$_POST['nie_brg'];
	$_SESSION['merk']=$_POST['merk'];
	$_SESSION['tipe']=$_POST['tipe'];
	$_SESSION['negara_asal']=$_POST['negara_asal'];
	$_SESSION['deskripsi_alat']=$_POST['deskripsi'];
	$_SESSION['harga_beli']=$_POST['harga_beli'];
	$_SESSION['harga']=$_POST['harga_satuan'];
	echo "<script type='text/javascript'>
	window.location='index.php?page=simpan_tambah_barang_masuk';
		</script>";
	*/
	}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Barang Inventory
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="index.php?page=barang_masuk">Barang Inventory</a></li>
        <li class="active">Tambah Barang Inventory</li></ol></section>


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
              <h3 class="box-title">Tambah Barang</h3>
            </div>
              <div class="box-body">
              <form method="post">
              
              <input name="nama_barang" class="form-control" type="text"  placeholder="Nama Alkes" required><br />
              
              <input name="nie" class="form-control" type="text"  placeholder="NIE" required><br />
              
              <input name="merk" class="form-control" type="text" placeholder="Merk" ><br />
              
              <input name="tipe" class="form-control" type="text" placeholder="Tipe" ><br />
              <!--
              <input name="nie" class="form-control" type="text" placeholder="Nomor Ijin Edar (NIE)" ><br />
              
              <input name="no_bath" class="form-control" type="text" placeholder="Nomor Bath" ><br />
              
              <input name="no_lot" class="form-control" type="text" placeholder="Nomor Lot" ><br />
              -->
              <input name="negara_asal" class="form-control" type="text" placeholder="Negara Asal" ><br />
             
              <textarea name="deskripsi" class="form-control" type="text" rows="5" placeholder="Deskripsi Alat" ></textarea><br />
              <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator'])) { ?>
              <input name="harga_beli" class="form-control" type="text" placeholder="Harga Beli Satuan" ><br />
              <input name="harga_satuan" class="form-control" type="text" placeholder="Harga Jual Satuan" ><br />
              <input name="qty" class="form-control" type="text" placeholder="Kuantity" ><br />
              <?php } ?>
              
              <button name="tambah_aksesoris" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button>
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
  