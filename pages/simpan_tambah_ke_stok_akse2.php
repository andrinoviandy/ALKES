<?php 
if (isset($_POST['simpan_akse'])) {
		$ns='';
	for ($k=0; $k<$_SESSION['stok']; $k++) {
		//$no_s=$_POST['no_seri'][$k];
		for ($l=0; $l!=$k and $l<$_SESSION['stok']; $l++) {
			if ($_POST['no_seri'][$k]==$_POST['no_seri'][$l] and $_POST['no_seri'][$k]!='-' and $_POST['no_seri'][$k]!='') {
				$ns=$ns.$_POST['no_seri'][$k].",";
				}
			}
	}
	if ($ns=='') {
		$jml_cek=0;
		$sn='';
	for ($jj=0; $jj<$_SESSION['stok']; $jj++) {
		$ce = mysqli_num_rows(mysqli_query($koneksi, "select * from aksesoris_detail where aksesoris_id=".$_GET['id']." and no_seri_akse!='-' and no_seri_akse!='' and no_seri_akse='".$_POST['no_seri'][$jj]."'"));
		if ($ce!=0) {
			$sn=$sn.$_POST['no_seri'][$jj].",";
			}
		$jml_cek=$jml_cek+$ce;
		}
		if ($jml_cek==0) {
		$nilai_maks=$_GET['id'];
		$update_stok=mysqli_query($koneksi, "update aksesoris set stok_total_akse=stok_total_akse+".$_SESSION['stok']." where id=$nilai_maks");
		
		$simpan_po=mysqli_query($koneksi, "insert into aksesoris_po values('','$nilai_maks','".$_SESSION['tgl_masuk']."','".$_SESSION['no_po']."','".$_SESSION['stok']."')");
		
		$max_po=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as max_po from aksesoris_po"));
		
		for ($j=0; $j<$_SESSION['stok']; $j++) {
			
			$s=mysqli_query($koneksi, "insert into aksesoris_detail values('','$nilai_maks','".$max_po['max_po']."','".$_POST['no_bath'][$j]."','".$_POST['no_lot'][$j]."','".$_POST['no_seri'][$j]."','','".$_POST['tgl_expired'][$j]."','0')");
			
		}
		if ($s) {
			mysqli_query($koneksi, "update barang_pesan_akse_detail set status_ke_stok=1 where id=".$_GET['id_detail']."");
			echo "<script type='text/javascript'>
		alert('Data Berhasil Dimutasi !');
		window.location='index.php?page=mutasi_akse&id=$_GET[id]';
		</script>
		";
		unset($_SESSION['tgl_masuk']);
		unset($_SESSION['tgl_expired']);
		unset($_SESSION['no_po']);
		unset($_SESSION['stok']);
		}
		}
		else {
			echo "<script type='text/javascript'>
		alert('Data Gagal Di Simpan Karena SN dengan Nomor : ($sn) sudah ada !');
		history.back();		
		</script>
		";
			}
	}
	else {
		echo "<script type='text/javascript'>
		alert('Data Gagal Di Simpan , SN Yang anda input dengan Nomor : ($ns) ada yang sama !');
		history.back();
		</script>
		";
		}
}
	
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Tambah Detail Aksesoris</h1><ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Detail Aksesoris</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
              <div class="box-body table-responsive no-padding">
              <div class="">
              <!--<a href="index.php?page=tambah_barang_masuk"><button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah Barang</button></a>-->
              <form method="post" enctype="multipart/form-data">
                <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">Tgl Masuk</th>
      <th valign="bottom">Po Nomor</th>
      <th valign="bottom"><strong>Nama Alkes</strong></th>
      <th valign="bottom">NIE</th>
      <th valign="bottom"><strong>Tipe</strong></th>
      <th valign="bottom">Merk</th>
      <th valign="bottom"><strong>Negara Asal</strong></th>
      <th valign="bottom"><strong>Deskripsi Alat</strong></th>
      <th valign="bottom">Stok</th>
      </tr>
  </thead>
  <?php
	$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from aksesoris where id=".$_GET['id'].""));
	?> 
  <tr>
    <td><?php echo date("d F Y", strtotime($_SESSION['tgl_masuk'])); ?></td>
    <td><?php echo $_SESSION['no_po']; ?></td>
    <td><?php echo $data['nama_akse']; ?>
    </td>
    <td><?php echo $data['nie_akse']; ?></td>
    <td><?php echo $data['tipe_akse']; ?></td>
    <td><?php echo $data['merk_akse']; ?></td>
    <td><?php echo $data['negara_asal_akse']; ?></td>
    <td><?php echo $data['deskripsi_akse']; ?></td>
    <td bgcolor="#00FF00"><?php echo $_SESSION['stok']; ?></td>
    </tr>
</table><br />
                <br />
                <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td align="center" valign="bottom">Data Alkes Ke-</td>
      
      <td align="center" valign="bottom"><strong>No. Bath      
      </strong></td>
      <td align="center" valign="bottom"><strong>No. Lot     
      </strong></td>
      <td align="center" valign="bottom"><strong>No. Seri</strong></td>
      <td align="center" valign="bottom"><strong>Tgl Expired</strong></td>
      </tr>
  </thead>
  
  
  <?php 
  for ($i=0; $i<$_SESSION['stok']; $i++) {
  ?>
  <tr>
    <td align="center" bgcolor="#00FF00"><b><?php echo $i+1; ?></b></td>
    
    <td align="center"><input id="" name="no_bath[]" class="form-control" type="text"  placeholder="" size="3"/></td>
    <td align="center"><input name="no_lot[]" class="form-control" type="text" placeholder="" size="3"/></td>
    <td align="center"><input name="no_seri[]" class="form-control" type="text" placeholder="" size="3"/></td>
    <td align="center"><input name="tgl_expired[]" class="form-control" type="date" placeholder="" value="<?php echo $_SESSION['tgl_expired']; ?>"/></td>
    </tr>
  <?php } ?>
  <tr>
    <td colspan="7" align="center"><br /><br /><button name="simpan_akse" class="btn btn-success" type="submit"><span class="fa fa-plus"></span>Simpan</button></td>
    </tr>
  
  <script type="text/javascript">    
	<?php 
	echo $jsArray; 
	?>  
	function changeValue(id_akse){  
		document.getElementById('tipe_akse').value = dtBrg[id_akse].tipe_akse; 
		document.getElementById('merk_akse').value = dtBrg[id_akse].merk_akse;
		document.getElementById('no_akse').value = dtBrg[id_akse].no_akse;
		
	};  
</script>
</table>
</form>
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
  <?php 
  if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "insert into aksesoris values('','".$_POST['nama_akse']."','".$_POST['merk']."','".$_POST['tipe']."','".$_POST['no_seri']."','".$_POST['stok']."', '".$_POST['deskripsi']."','".$_POST['harga_satuan']."')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Tambah !');
		window.location='index.php?page=simpan_tambah_aksesoris&id=$_GET[id]';
		</script>";
		}
	}
		?>
  <div id="openAkse" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Tambah Aksesoris Baru</h3> 
     <form method="post">
              <input name="nama_akse" class="form-control" type="text" required placeholder="Nama Aksesoris" autofocus><br />
              
              <input name="merk" class="form-control" type="text" placeholder="Merk" required><br />
              
              <input name="tipe" class="form-control" type="text" placeholder="Tipe" required><br />
              
              <input name="no" class="form-control" type="text" placeholder="Nomor Seri" required><br />
              
              <input name="stok" class="form-control" type="text" placeholder="Stok" required><br />
              
              <textarea name="deskripsi" class="form-control" type="text" rows="5" placeholder="Deskripsi Alat" required></textarea><br />
              <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator'])) { ?>
              <input name="harga_satuan" class="form-control" type="text" placeholder="Harga Satuan" required><br />
              <?php } ?>
              
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button>
              <br /><br />
              </form>
              
    </div>
</div>
