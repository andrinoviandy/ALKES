<?php
if (isset($_SESSION['user']) and isset($_SESSION['pass'])) {
	if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "update jual_barang set tgl_kirim='".$_POST['tgl_kirim']."', ket_brg='".$_POST['keterangan']."' where id=".$_POST['nama_barang']."");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Simpan !');
		</script>";
		}
	}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Alkes Yang Akan di kirim</h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="index.php?page=kirim_barang">Alkes</a></li>
        <li class="active">Kirim Alkes</li></ol></section>


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
              <h3 class="box-title">Tambah Alkes Yang Akan Dikirm</h3>
            </div>
              <div class="box-body">
              <form method="post">
              <br />
              <?php if (isset($_SESSION['user']) and isset($_SESSION['pass'])) { ?>
              <label>Nama Alkes</label>
              <select name="nama_barang" class="form-control" required>
              <option>-- Pilih Alkes --</option>
              <?php $q = mysqli_query($koneksi, "select *,jual_barang.id as idd from jual_barang,master_barang where master_barang.id=jual_barang.id_master_brg and tgl_kirim=0000-00-00 order by tgl_beli DESC");
			  $t=mysqli_num_rows($q);
			  if ($t!=0) { 
			  while ($d = mysqli_fetch_array($q)) { ?>
              <option value="<?php echo $d['idd']; ?>"><?php echo $d['nama_brg']; ?></option>
              <?php } } else { echo "<option disabled='disabled'>Data Kosong</option>"; }?>
              </select>
              <br /><?php } ?>
              <label>Tanggal Kirim</label>
              <input name="tgl_kirim" class="form-control" type="date" placeholder="" required><br />
              <label>Keterangan</label>
              <textarea name="keterangan" class="form-control" placeholder="Keterangan" rows="5" required></textarea><br />
              
              <button name="tambah_laporan" class="btn btn-warning" type="submit"><span class="fa fa-plus"></span> Simpan</button>
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
  