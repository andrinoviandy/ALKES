<?php
$query = mysqli_query($koneksi, "select * from barang where id='".$_GET['id']."'");
$data = mysqli_fetch_array($query);

if (isset($_SESSION['id'])) {
if (isset($_POST['simpan_perubahan'])) {
	$Result = mysqli_query($koneksi, "update barang set id_akun=".$_SESSION['id'].", nama_barang='".$_POST['nama_barang']."', merk='".$_POST['merk']."', tipe='".$_POST['tipe']."', no_seri='".$_POST['no_seri']."', kepemilikan='".$_POST['kepemilikan']."', deskripsi='".$_POST['deskripsi']."' where id=".$_GET['id']."");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Barang Berhasil Diubah !');
		window.location='index.php?page=barang'
		</script>";
		}
	}
} else {
	if (isset($_POST['simpan_perubahan'])) {
	$Result = mysqli_query($koneksi, "update barang set id_akun=".$_POST['id_akun'].", nama_barang='".$_POST['nama_barang']."', merk='".$_POST['merk']."', tipe='".$_POST['tipe']."', no_seri='".$_POST['no_seri']."', kepemilikan='".$_POST['kepemilikan']."', deskripsi='".$_POST['deskripsi']."' where id=".$_GET['id']."");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Barang Berhasil Diubah !');
		window.location='index.php?page=barang'
		</script>";
		}
	}
	}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Ubah Data Kerusakan Alkes</h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="index.php?page=barang">Kerusakan Alkes</a></li>
        <li class="active">Ubah Data Alkes Rusak</li></ol></section>


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
              <h3 class="box-title">Ubah Data Alkes Rusak</h3></div><div class="box-body"><br />
              <form method="post">
              <?php
              if (isset($_SESSION['user']) and isset($_SESSION['pass'])) {
			  ?>
              <label>Nama Akun</label>
              <select name="id_akun" class="form-control">
              <?php 
			  $q = mysqli_query($koneksi, "select *,akun.id as idd from barang,akun where akun.id=barang.id_akun and barang.id=".$_GET['id']."");
			  $data3=mysqli_fetch_array($q); ?>
              <option value="<?php echo $data3['idd']; ?>"><?php echo $data3['nama']; ?></option>
              <?php $querii = mysqli_query($koneksi, "select * from akun where nama !='".$data3['nama']."' order by nama ASC");
			  while ($data2=mysqli_fetch_array($querii)) { ?>
              <option value="<?php echo $data2['id']; ?>"><?php echo $data2['nama']; ?></option>
              <?php } ?>
              </select>
              <br /><?php } ?>
              
              <label>Nama Barang</label>
              <input name="nama_barang" class="form-control" placeholder="Nama Barang" type="text" value="<?php echo $data['nama_barang']; ?>"><br />
              
              <label>Merk</label>
              <input name="merk" class="form-control" type="text" placeholder="Merk" value="<?php echo $data['merk']; ?>"><br />
              
              <label>Tipe</label>
              <input name="tipe" class="form-control" type="text" placeholder="Tipe" value="<?php echo $data['tipe']; ?>"><br />
              
              <label>No Seri</label>
              <input name="no_seri" class="form-control" type="text" placeholder="Nomor Seri" value="<?php echo $data['no_seri']; ?>"><br />
              
              <label>Kepemilikan</label>
              <input name="kepemilikan" class="form-control" type="text" placeholder="Kepemilikan" value="<?php echo $data['kepemilikan']; ?>"><br />
              
              <label>Deskripsi</label>
              <textarea name="deskripsi" class="form-control" placeholder="Deskripsi" rows="5"><?php echo $data['deskripsi']; ?></textarea><br />
              
              <button name="simpan_perubahan" class="btn btn-warning" type="submit"><span class="fa fa-edit"></span> Simpan Perubahan</button>
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