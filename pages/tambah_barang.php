<?php
if (isset($_SESSION['user']) and isset($_SESSION['pass'])) {
if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "insert into barang_rusak values('','".$_POST['id_akun']."','".$_POST['nama_barang']."','".$_POST['merk']."','".$_POST['tipe']."','".$_POST['no_seri']."','".$_POST['kepemilikan']."','".$_POST['deskripsi']."','0')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Barang Berhasil Di Tambah !');
		window.location='index.php?page=tambah_barang';
		</script>";
		}
	}
if (isset($_POST['tambah_laporan_dlm'])) {
	$ms = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang where id=".$_POST['nama_barang'].""));
	$Result = mysqli_query($koneksi, "insert into barang_rusak values('','".$_POST['id_akun']."','".$ms['nama_brg']."','".$ms['merk_brg']."','".$ms['tipe_brg']."','".$ms['no_seri_brg']."','".$_POST['kepemilikan']."','".$_POST['deskripsi']."','0')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Barang Berhasil Di Tambah !');
		window.location='index.php?page=tambah_barang';
		</script>";
		}
	}
} else {
	if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "insert into barang_rusak values('','".$_SESSION['id']."','".$_POST['nama_barang']."','".$_POST['merk']."','".$_POST['tipe']."','".$_POST['no_seri']."','".$_POST['kepemilikan']."','".$_POST['deskripsi']."','0')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Barang Berhasil Di Tambah !');
		
		</script>";
		}
	}
	if (isset($_POST['tambah_laporan_dlm'])) {
	$ms = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang where id=".$_POST['nama_barang'].""));
	$Result = mysqli_query($koneksi, "insert into barang_rusak values('','".$_POST['id_akun']."','".$ms['nama_brg']."','".$ms['merk_brg']."','".$ms['tipe_brg']."','".$ms['no_seri_brg']."','".$_POST['kepemilikan']."','".$_POST['deskripsi']."','0')");
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
            <form method="post">
            	
              Nama Akun
              <select id="" name="id_akun" class="form-control" autofocus="autofocus" >
              <option value="">--Pilih--</option>
              <?php $query = mysqli_query($koneksi, "select * from akun_customer order by nama_user ASC");
			  while ($data=mysqli_fetch_array($query)) { ?>
              <option value="<?php echo $data['id']; ?>"><?php echo $data['nama']; ?></option>
              <?php } ?>
              </select><br />
              Nama Alkes
              <select onchange="changeValue(this.value)" id="id_alkes" name="id_alkes" class="form-control" >
              <option value="">--Pilih--</option>
              <?php $query = mysqli_query($koneksi, "select nama_brg,merk_brg,tipe_brg,nie_brg,no_lot,no_bath,no_seri_brg,nama_pembeli,barang_dikirim.id as idd from barang_dikirim,barang_dijual,barang_gudang,pembeli where barang_gudang.id=barang_dijual.barang_gudang_id and barang_dijual.id=barang_dikirim.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and tgl_kirim!=0000-00-00 order by nama_brg ASC");
			  $jsArray = "var dtBrg = new Array();";
			  while ($row=mysqli_fetch_array($query)) { ?>
              <option value="<?php echo $row['idd']; ?>"><?php echo $row['nama_brg']." - No Seri : ".$row['no_seri_brg']; ?></option>
              <?php 
			  $jsArray .= "dtBrg['" . $row['idd'] . "'] = {nama_pembeli:'".addslashes($row['nama_pembeli'])."',
						merk_brg:'".addslashes($row['merk_brg'])."',
						tipe_brg:'".addslashes($row['tipe_brg'])."',
						nie_brg:'".addslashes($row['nie_brg'])."',
						no_bath:'".addslashes($row['no_bath'])."',
						no_lot:'".addslashes($row['no_lot'])."',
						no_seri:'".addslashes($row['no_seri_brg'])."'
						};
"; 
			  } ?>
              </select><br />
              <input name="merk" type="text" disabled="disabled" required class="form-control" id="merk" placeholder="Merk">
              <br />
              <input name="tipe" type="text" disabled="disabled" required class="form-control" id="tipe" placeholder="Tipe">
              <br />
              <input name="nie_brg" type="text" disabled="disabled" required class="form-control" id="nie_brg" placeholder="Nomor Ijin Edar"><br />
              <input name="no_bath" type="text" disabled="disabled" required class="form-control" id="no_bath" placeholder="Nomor Bath"><br />
              <input name="no_lot" type="text" disabled="disabled" required class="form-control" id="no_lot" placeholder="Nomor Lot"><br />
              <input name="no_seri" type="text" disabled="disabled" required class="form-control" id="no_seri" placeholder="Nomor Seri"><br />
              
              <input name="kepemilikan" type="text" disabled="disabled" required class="form-control" id="kepemilikan" placeholder="Kepemilikan"><br />
              <textarea id="" name="deskripsi" class="form-control" placeholder="Deskripsi Kerusakan" rows="5" required></textarea><br />
              
              <button name="tambah_laporan" class="btn btn-warning" type="submit"><span class="fa fa-plus"></span> Tambah Barang</button>
              
              </form>
              <script type="text/javascript">    
	<?php 
	echo $jsArray; 
	?>  
	function changeValue(id_alkes){  
		document.getElementById('merk').value = dtBrg[id_alkes].merk_brg;
		document.getElementById('tipe').value = dtBrg[id_alkes].tipe_brg;
		document.getElementById('nie_brg').value = dtBrg[id_alkes].nie_brg;
		document.getElementById('no_bath').value = dtBrg[id_alkes].no_bath;
		document.getElementById('no_lot').value = dtBrg[id_alkes].no_lot;
		document.getElementById('no_seri').value = dtBrg[id_alkes].no_seri;
		document.getElementById('kepemilikan').value = dtBrg[id_alkes].nama_pembeli;
		
	};  
</script>
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
  