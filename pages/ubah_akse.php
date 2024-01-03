<?php
$query = mysqli_query($koneksi, "select * from aksesoris where id='".$_GET['id']."'");
$data = mysqli_fetch_array($query);


if (isset($_POST['simpan_perubahan'])) {
	$Result = mysqli_query($koneksi, "update aksesoris set tgl_masuk_akse='".$_POST['tgl_masuk']."', no_po_akse='".$_POST['no_po']."',nama_akse='".$_POST['nama_akse']."', merk_akse='".$_POST['merk']."', tipe_akse='".$_POST['tipe']."', no_akse='".$_POST['no_akse']."', stok_akse='".$_POST['stok']."', deskripsi_akse='".$_POST['deskripsi']."', harga_akse='".$_POST['harga_satuan']."' where id=".$_GET['id']."");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Diubah !');
		window.location='index.php?page=aksesoris'
		</script>";
		}
	}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Ubah Aksesoris Alkes</h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="index.php?page=barang_masuk">Aksesoris</a></li>
        <li class="active">Ubah Data Aksesoris</li></ol></section>


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
              <h3 class="box-title">Ubah Data Aksesoris</h3></div><div class="box-body"><br />
              <form method="post">
              <label>Tgl Masuk</label>
              <input name="tgl_masuk" class="form-control" placeholder="" type="text" value="<?php echo $data['tgl_masuk_akse']; ?>"><br />
              
              <label>Nomor PO</label>
              <input name="no_po" class="form-control" placeholder="" type="text" value="<?php echo $data['no_po_akse']; ?>"><br />
              
              <label>Nama Aksesoris</label>
              <input name="nama_akse" class="form-control" placeholder="Nama Aksesoris" type="text" value="<?php echo $data['nama_akse']; ?>"><br />
              
              <label>Merk</label>
              <input name="merk" class="form-control" type="text" placeholder="Merk" value="<?php echo $data['merk_akse']; ?>"><br />
              
              <label>Tipe</label>
              <input name="tipe" class="form-control" type="text" placeholder="Tipe" value="<?php echo $data['tipe_akse']; ?>"><br />
              
              
              <label>No Seri</label>
              <input name="no_akse" class="form-control" type="text" placeholder="No Seri" value="<?php echo $data['no_akse']; ?>"><br />
              
              <label>Stok</label>
              <input name="stok" class="form-control" type="text" placeholder="Stok" value="<?php echo $data['stok_akse']; ?>"><br />
              <label>Deskripsi Alat</label>
              <textarea name="deskripsi" class="form-control" type="text" rows="5" placeholder="Deskripsi Alat" required><?php echo $data['deskripsi_akse']; ?></textarea><br />
              <?php if (isset($_SESSION['user_administrator'])) { ?>
              <label>Harga Beli / Satuan</label>
              <input name="harga_beli" class="form-control" type="text" placeholder="Harga Satuan" value="<?php echo $data['harga_akse']; ?>"><br />
              <label>Harga Jual / Satuan</label>
              <input name="harga_satuan" class="form-control" type="text" placeholder="Harga Satuan" value="<?php echo $data['harga_akse']; ?>"><br />
              <?php } ?>
              <button name="simpan_perubahan" class="btn btn-success" type="submit"><span class="fa fa-edit"></span> Simpan Perubahan</button>
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