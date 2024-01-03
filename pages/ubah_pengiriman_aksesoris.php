<?php

$q1=mysqli_fetch_array(mysqli_query($koneksi, "select *,aksesoris_kirim.id as idd from aksesoris_kirim where id=".$_GET['id'].""));

if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "update aksesoris_kirim set nama_paket_akse='".$_POST['nama_paket']."', no_pengiriman_akse='".$_POST['no_pengiriman']."', tgl_kirim_akse='".$_POST['tgl_kirim']."', po_no_akse='".$_POST['no_po']."', tgl_sampai_akse='".$_POST['tgl_sampai']."' where id=".$_GET['id']."");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Ubah !');
		window.location='index.php?page=pengiriman_aksesoris';
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ubah Data Pengiriman Aksesoris</h1><ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="index.php?page=kirim_barang">Pengiriman Aksesoris</a></li>
        <li class="active">Ubah Data Pengiriman Aksesoris</li></ol></section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-4 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-warning"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Ubah Data Pengiriman Aksesoris</h3>
            </div>
              <div class="box-body">
              <form method="post">
              <label>Nama Paket</label>
              <input name="nama_paket" class="form-control" type="text" value="<?php echo $q1['nama_paket_akse'] ?>"><br />
              <label>No Pengiriman</label>
              <input name="no_pengiriman" class="form-control" type="text" value="<?php echo $q1['no_pengiriman_akse'] ?>">
              <br />
              <label>Tanggal Kirim</label>
              <input name="tgl_kirim" class="form-control" type="date" placeholder="" required value="<?php echo $q1['tgl_kirim_akse'] ?>"><br />
              <label>No. PO</label>
              <input name="no_po" class="form-control" type="text" value="<?php echo $q1['po_no_akse'] ?>">
              <br />
              <label>Tanggal Sampai</label>
              <input name="tgl_sampai" class="form-control" type="date" placeholder="Pembeli" value="<?php echo $q1['tgl_sampai_akse'] ?>"><br />
              <!--<label>Keterangan</label>
              <textarea name="ket_brg" class="form-control" type="text" rows="5" placeholder="Keterangan"><?php echo $q1['ket_brg'] ?></textarea><br />-->
              
              <button name="tambah_laporan" class="btn btn-warning" type="submit"><span class="fa fa-edit"></span> Simpan Perubahan</button>
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
  