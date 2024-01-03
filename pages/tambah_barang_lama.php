<?php
if (isset($_SESSION['user']) and isset($_SESSION['pass'])) {
if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "insert into barang values('','".$_POST['id_akun']."','".$_POST['nama_barang']."','".$_POST['merk']."','".$_POST['tipe']."','".$_POST['no_seri']."','".$_POST['kepemilikan']."','".$_POST['deskripsi']."','0')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Barang Berhasil Di Tambah !');
		window.location='index.php?page=tambah_barang';
		</script>";
		}
	}
if (isset($_POST['tambah_laporan_dlm'])) {
	$ms = mysqli_fetch_array(mysqli_query($koneksi, "select * from master_barang where id=".$_POST['nama_barang'].""));
	$Result = mysqli_query($koneksi, "insert into barang values('','".$_POST['id_akun']."','".$ms['nama_brg']."','".$ms['merk_brg']."','".$ms['tipe_brg']."','".$ms['no_seri_brg']."','".$_POST['kepemilikan']."','".$_POST['deskripsi']."','0')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Barang Berhasil Di Tambah !');
		window.location='index.php?page=tambah_barang';
		</script>";
		}
	}
} else {
	if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "insert into barang values('','".$_SESSION['id']."','".$_POST['nama_barang']."','".$_POST['merk']."','".$_POST['tipe']."','".$_POST['no_seri']."','".$_POST['kepemilikan']."','".$_POST['deskripsi']."','0')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Barang Berhasil Di Tambah !');
		
		</script>";
		}
	}
	if (isset($_POST['tambah_laporan_dlm'])) {
	$ms = mysqli_fetch_array(mysqli_query($koneksi, "select * from master_barang where id=".$_POST['nama_barang'].""));
	$Result = mysqli_query($koneksi, "insert into barang values('','".$_POST['id_akun']."','".$ms['nama_brg']."','".$ms['merk_brg']."','".$ms['tipe_brg']."','".$ms['no_seri_brg']."','".$_POST['kepemilikan']."','".$_POST['deskripsi']."','0')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Barang Berhasil Di Tambah !');
		window.location='index.php?page=tambah_barang';
		</script>";
		}
	}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kerusakan Alkes
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="index.php?page=barang">Kerusakan Alkes</a></li>
        <li class="active">Tambah Alkes Rusak</li></ol></section>


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
              <h3 class="box-title">Tambah Barang Rusak</h3>
            </div>
              <div class="box-body">
              <div class="box-body">
              <a href="index.php?page=tambah_barang#openDalam">
              <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h4><strong>Alkes Dari Dalam</strong></h4>

              <p>Klik Disini</p>
            </div>
          </div>
        </div>
            </a>
            <a href="index.php?page=tambah_barang#openLuar">
              <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h4><strong>Alkes Dari Luar</strong></h4>

              <p>Klik Disini</p>
            </div>
          </div>
        </div>
            </a>
              </div>
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
  <div id="openLuar" class="modalDialog">
     <div>
     <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Tambah Alkes Rusak</h3>
  <form method="post">
            	
              <?php if (isset($_SESSION['user']) and isset($_SESSION['pass'])) { ?>
              
              Nama Akun
              <select id="" name="id_akun" class="form-control" autofocus="autofocus" >
              <option value="">--Pilih--</option>
              <?php $query = mysqli_query($koneksi, "select * from akun order by nama ASC");
			  while ($data=mysqli_fetch_array($query)) { ?>
              <option value="<?php echo $data['id']; ?>"><?php echo $data['nama']; ?></option>
              <?php } ?>
              </select>
              <?php } ?>

              <input id="input" name="nama_barang" class="form-control" type="text" required placeholder="Nama Barang">
              
              <input id="input" name="merk" class="form-control" type="text" placeholder="Merk" required>
              
              <input id="input" name="tipe" class="form-control" type="text" placeholder="Tipe" required>
              
              <input id="input" name="no_seri" class="form-control" type="text" placeholder="Nomor Seri" required>
              
              <input id="input" name="kepemilikan" class="form-control" type="text" placeholder="Kepemilikan" required>
              <textarea id="input" name="deskripsi" class="form-control" placeholder="Deskripsi" rows="5" required></textarea>
              
              <button name="tambah_laporan" class="btn btn-warning form-control" type="submit"><span class="fa fa-plus"></span> Tambah Barang</button>
              
              </form>
              </div>
              </div>
              
<div id="openDalam" class="modalDialog">
     <div>
     <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Tambah Alkes Rusak</h3>
  <form method="post">
              <br />
              <?php if (isset($_SESSION['user']) and isset($_SESSION['pass'])) { ?>
             Nama Akun
              <select id="input" name="id_akun" autofocus="autofocus" >
              <option>--Pilih--</option>
              <?php $query = mysqli_query($koneksi, "select * from akun order by nama ASC");
			  while ($data=mysqli_fetch_array($query)) { ?>
              <option value="<?php echo $data['id']; ?>"><?php echo $data['nama']; ?></option>
              <?php } ?>
              </select>
              <?php } ?>
Nama Barang
				<select id="input" name="nama_barang">
                <option>--Pilih--</option>
				<?php $q= mysqli_query($koneksi, "select * from master_barang order by nama_brg ASC");
				while ($d=mysqli_fetch_array($q)) {
				 ?>
                <option value="<?php echo $d['id']; ?>"><?php echo $d['nama_brg']; ?></option>
                <?php } ?>
                </select>
              
              <input id="input" name="kepemilikan" class="form-control" type="text" placeholder="Kepemilikan" required>
              <textarea id="input" name="deskripsi" class="form-control" placeholder="Deskripsi" rows="5" required></textarea>
              
              <button name="tambah_laporan_dlm" class="btn btn-warning form-control" type="submit"><span class="fa fa-plus"></span> Tambah Barang</button>
              
              </form>
              </div>
              </div>
  