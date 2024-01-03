<?php 
$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang_detail_rusak where id=$_GET[id_ubah]"));

if (isset($_POST['simpan_tambah_aksesoris'])) {
	//$no=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_hash"))+1;
	if ($_POST['status']==$data['status_barang']) {
	$simpan = mysqli_query($koneksi, "update barang_gudang_detail_rusak set tgl_input='".$_POST['tgl_input']."',barang_gudang_detail_id='".$_POST['no_seri']."',kerusakan_alat='".$_POST['kerusakan']."' where id=$_GET[id_ubah]");
		if ($simpan) {
		echo "<script>window.location='index.php?page=barang_rusak_detail&id_gudang=$_GET[id_gudang]'</script>";
		}
	} 
	else {
		$simpan = mysqli_query($koneksi, "update barang_gudang_detail_rusak set tgl_input='".$_POST['tgl_input']."',barang_gudang_detail_id='".$_POST['no_seri']."',kerusakan_alat='".$_POST['kerusakan']."', status_barang='".$_POST['status']."' where id=$_GET[id_ubah]");
	if ($simpan) {
		if ($_POST['status']==2) {
			mysqli_query($koneksi, "update barang_gudang_detail,barang_gudang set barang_gudang_detail.status_kerusakan=2, barang_gudang.stok_total=barang_gudang.stok_total-1 where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=".$_POST['no_seri']."");
			} else {
			mysqli_query($koneksi, "update barang_gudang_detail set status_kerusakan=1 where id=".$_POST['no_seri']."");	
			}
		echo "<script>window.location='index.php?page=barang_rusak_detail&id_gudang=$_GET[id_gudang]'</script>";
		}
		}
	}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Ubah Alkes Rusak</h1><ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">  Ubah Alkes Rusak</li>
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
              <!--<a href="index.php?page=tambah_barang_masuk"><button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah Barang</button></a>--><font align="left" size="+2">
                  Ubah Data Alkes Rusak</font> <br />
                  <form method="post" name="form1" enctype="multipart/form-data">
                <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">Tgl Input</th>
      <th valign="bottom"><strong>Nama Alkes</strong></th>
      <td align="center" valign="bottom"><strong>Tipe      
      </strong></td>
      <td align="center" valign="bottom"><strong>Merk      
      </strong></td>
      <td align="center" valign="bottom"><strong>No Seri</strong></td>
     </tr>
  </thead>
  
  <tr>
    <td><input id="" name="tgl_input" class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>"/></td>
    
      <td>
        <select name="id_akse" id="id_akse" class="form-control" autofocus="autofocus" required onchange="changeValue(this.value)">
          <option value="">-- Pilih Alkes</option>
          <?php 
		$q = mysqli_query($koneksi, "select * from barang_gudang where stok_total!=0 order by nama_brg ASC");
		$jsArray = "var dtBrg = new Array();
";
		while ($d = mysqli_fetch_array($q)) { ?>
          <option <?php if($_GET['id_gudang']==$d['id']) { echo "selected";} ?> value="<?php echo $d['id']; ?>"><?php echo $d['nama_brg']; ?></option>
          <?php 
		$jsArray .= "dtBrg['" . $d['id'] . "'] = {tipe_akse:'".addslashes($d['tipe_brg'])."',
						merk_akse:'".addslashes($d['merk_brg'])."',
						no_akse:'".addslashes($d['nie_brg'])."'
						};";
		} ?>
          </select>
        </td>
      <td align="center"><input id="tipe_akse" name="tipe_akse" class="form-control" type="text" placeholder="Tipe" disabled="disabled"/></td>
      <td align="center"><input id="merk_akse" name="merk_akse" class="form-control" type="text"  placeholder="Merk" disabled="disabled"/></td>
      <td align="center">
        <select required name="no_seri" id="no_seri" class="form-control">
          <option value="">--Pilih No Seri--</option>
          <?php 
	$q_seri = mysqli_query($koneksi, "select *,barang_gudang_detail.id as idd from barang_gudang_detail INNER JOIN barang_gudang ON barang_gudang.id=barang_gudang_detail.barang_gudang_id and status_terjual=0 order by no_seri_brg ASC");
	while ($d_seri=mysqli_fetch_array($q_seri)) {
	?>
          <option id="no_seri" <?php if ($_GET['id_gudang_detail']==$d_seri['idd']) {echo "selected";} ?> value="<?php echo $d_seri['idd']; ?>" class="<?php echo $d_seri['barang_gudang_id']; ?>" <?php if ($d_seri['status_terjual']==1) { echo "disabled"; } ?>><?php echo $d_seri['no_seri_brg']; ?></option>
          <?php } ?>
          </select>
        <script src="jquery-1.10.2.min.js"></script>
        <script src="jquery.chained.min.js"></script>
        <script>
            $("#no_seri").chained("#id_akse");
        </script>
        </td>
    
  </tr>
  <tr>
    <td colspan="6"><strong>Deskripsi Kerusakan</strong><br />
      <textarea class="form-control" rows="3" name="kerusakan" ><?php echo $data['kerusakan_alat']; ?></textarea><br />
      <strong>Status Barang</strong><br />
      <select class="form-control" name="status">
        <option <?php if($data['status_barang']==0){echo "selected";} ?> value="0">Belum Selesai Di Perbaiki Teknisi</option>
        <option <?php if($data['status_barang']==1){echo "selected";} ?> value="1">Sudah Selesai Di Perbaiki Teknisi &nbsp;&nbsp; & &nbsp;&nbsp; Akan Pindah Ke Gudang</option>
        <option <?php if($data['status_barang']==2){echo "selected";} ?> value="2">Barang Tidak Layak Jual & Akan Di Kembalikan Ke Pabrik</option>
      </select><br />
    </td>
    </tr>
  <tr>
    <td colspan="6" align="center"><button name="simpan_tambah_aksesoris" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan Perubahan</button></td>
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
  <?php
   
  $no=0;
  $q_akse = mysqli_query($koneksi, "select *,barang_dijual_hash.id as idd from barang_dijual_hash,barang_gudang_detail,barang_gudang where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual_hash.barang_gudang_detail_id and akun_id=".$_SESSION['id']."");
  $jm = mysqli_num_rows($q_akse);
  if ($jm!=0) { 
  while ($data_akse = mysqli_fetch_array($q_akse)) {
	  $no++;
  ?>
  <?php }} ?>
</table>
</form>
<!--
<center><a href="index.php?page=simpan_jual_alkes&simpan_barang=1"><button name="simpan_" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button></a>&nbsp;&nbsp;<a href="index.php?page=jual_barang"><button name="batal" class="btn btn-success" type="submit"><span class="fa  fa-times-circle"></span> Batal</button></a></center>
-->
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
