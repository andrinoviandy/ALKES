<?php
$query = mysqli_query($koneksi, "select * from space_part where id='".$_GET['id']."'");
$data = mysqli_fetch_array($query);


if (isset($_POST['simpan_perubahan'])) {
	$Result = mysqli_query($koneksi, "update space_part set nama_sp='".$_POST['nama_sp']."', merk_sp='".$_POST['merk']."', tipe_sp='".$_POST['tipe']."', no_sp='".$_POST['no_sp']."', stok_sp='".$_POST['stok']."', deskripsi_sp='".$_POST['deskripsi']."', harga_sp='".$_POST['harga_satuan']."' where id=".$_GET['id']."");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Diubah !');
		window.location='index.php?page=aksesoris_alkes'
		</script>";
		}
	}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Ubah Spare PartAlkes</h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="index.php?page=barang_masuk">Spare Part</a></li>
        <li class="active">Ubah Data Spare Part</li></ol></section>


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
              <h3 class="box-title">Ubah Data Spare Part</h3></div><div class="box-body"><br />
              <form method="post">
              <label>Nama Spare Part</label>
              <input name="nama_sp" class="form-control" placeholder="Nama Spare Part" type="text" value="<?php echo $data['nama_sp']; ?>"><br />
              
              <label>Merk</label>
              <input name="merk" class="form-control" type="text" placeholder="Merk" value="<?php echo $data['merk_sp']; ?>"><br />
              
              <label>Tipe</label>
              <input name="tipe" class="form-control" type="text" placeholder="Tipe" value="<?php echo $data['tipe_sp']; ?>"><br />
              
              
              <label>No Seri</label>
              <input name="no_sp" class="form-control" type="text" placeholder="No Seri" value="<?php echo $data['no_sp']; ?>"><br />
              
              <label>Stok</label>
              <input name="stok" class="form-control" type="text" placeholder="Stok" value="<?php echo $data['stok_sp']; ?>"><br />
              <label>Deskripsi Alat</label>
              <textarea name="deskripsi" class="form-control" type="text" rows="5" placeholder="Deskripsi Alat" required><?php echo $data['deskripsi_sp']; ?></textarea><br />
              
              <label>Harga Satuan</label>
              <input name="harga_satuan" class="form-control" type="text" placeholder="Harga Satuan" value="<?php echo $data['harga_sp']; ?>"><br />
              
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