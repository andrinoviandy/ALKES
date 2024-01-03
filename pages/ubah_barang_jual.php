<?php
if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "update jual_barang set id_master_brg='".$_POST['nama_barang']."', pembeli='".$_POST['pembeli']."',alamat_pembeli='".$_POST['alamat']."',telp_pembeli='".$_POST['telp']."', qty='".$_POST['qty']."', tgl_beli='".$_POST['tgl_beli']."' where id=".$_GET['id']."");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Ubah !');
		window.location='index.php?page=jual_barang';
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ubah Data Jual Barang
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Barang</li>
        <li class="active">Ubah Data Jual Barang</li></ol></section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-4 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-info"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Ubah Data Jual Barang</h3>
            </div>
              <div class="box-body">
              <form method="post">
              <label>Nama Alkes</label>
              <select name="nama_barang" class="form-control" required>
              <?php $q1=mysqli_fetch_array(mysqli_query($koneksi, "select *,master_barang.id as id_m, jual_barang.id as idd from master_barang,jual_barang where master_barang.id=jual_barang.id_master_brg and jual_barang.id=".$_GET['id']."")); ?>
              <option value="<?php echo $q1['id_m']; ?>"><?php echo $q1['nama_brg']; ?></option>
              </select>
              <br />
              <label>Tanggal Jual</label>
              <input name="tgl_beli" class="form-control" type="date" placeholder="" required value="<?php echo $q1['tgl_beli'] ?>"><br />
              <label>Pembeli</label>
              <input name="pembeli" class="form-control" type="text" placeholder="Pembeli" required value="<?php echo $q1['pembeli'] ?>"><br />
              <label>Alamat Pembeli</label>
              <input name="alamat" class="form-control" type="text" placeholder="Alamat Pembeli" required value="<?php echo $q1['alamat_pembeli'] ?>"><br />
              <label>Kontak Pembeli</label>
              <input name="telp" class="form-control" type="text" placeholder="Kontak Pembeli" required value="<?php echo $q1['telp_pembeli'] ?>"><br />
              <label>Quantity</label>
              <input name="qty" class="form-control" type="text" placeholder="Quantity" required value="<?php echo $q1['qty'] ?>" readonly="readonly"><br />
              
              <button name="tambah_laporan" class="btn btn-info" type="submit"><span class="fa fa-edit"></span> Simpan Perubahan</button>
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
  