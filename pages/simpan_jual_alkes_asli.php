<?php 
if (isset($_GET['simpan_barang'])==1) {
	$cek = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_hash where akun_id=".$_SESSION['id'].""));
	if ($cek!=0) {
	$insert_pembeli=mysqli_query($koneksi, "insert into pembeli values('','".$_SESSION['pembeli']."','".$_SESSION['provinsi']."','".$_SESSION['kabupaten']."','".$_SESSION['kecamatan']."','".$_SESSION['kelurahan']."','".$_SESSION['alamat']."','".$_SESSION['kontak_rs']."')");
	
	$insert_pemakai=mysqli_query($koneksi, "insert into pemakai values('','".$_SESSION['pemakai']."','".$_SESSION['kontak1']."','".$_SESSION['kontak2']."','".$_SESSION['email']."')");
	
	$pembeli=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_pembeli from pembeli"));
	$id_pembeli=$pembeli['id_pembeli'];
	
	$pemakai=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_pemakai from pemakai"));
	$id_pemakai=$pemakai['id_pemakai']; 

	//simpan barang dijual
	$total = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_hash where akun_id=".$_SESSION['id'].""));
	
	$simpan1=mysqli_query($koneksi, "insert into barang_dijual values('','".$_SESSION['tgl_jual']."','".$_SESSION['no_faktur']."','$total','$id_pembeli','$id_pemakai','".$_SESSION['marketing']."','".$_SESSION['subdis']."','".$_SESSION['diskon']."','".$_SESSION['ppn']."')");
	
	$d1=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_jual from barang_dijual"));
	$id_jual=$d1['id_jual'];
	//simpan barang pesan detail
	$q2=mysqli_query($koneksi, "select * from barang_dijual_hash where akun_id=".$_SESSION['id']."");
	while ($d2 = mysqli_fetch_array($q2)) {
		$simpan2=mysqli_query($koneksi, "insert into barang_dijual_detail values('','$id_jual','".$d2['barang_gudang_detail_id']."','0')");
		$up=mysqli_query($koneksi, "update barang_gudang_detail set status_terjual=1 where id=".$d2['barang_gudang_detail_id']."");
		$up2=mysqli_query($koneksi, "update barang_gudang,barang_gudang_detail set stok_total=stok_total-1 where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=".$d2['barang_gudang_detail_id']."");
		}
		if ($simpan1 and $simpan2) {
			mysqli_query($koneksi, "delete from barang_dijual_hash where akun_id=".$_SESSION['id']."");
	echo "<script type='text/javascript'>
	alert('Data Berhasil Di Simpan !');
	window.location='index.php?page=jual_barang'</script>";
		}
	}
	else {
		echo "<script type='text/javascript'>
	alert('Data tidak boleh kosong , silakan tambah terlebih dahulu ! !');
	window.location='index.php?page=simpan_jual_alkes'</script>";
		}
}


if (isset($_POST['simpan_tambah_aksesoris'])) {
	//$no=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_hash"))+1;
	$simpan = mysqli_query($koneksi, "insert into barang_dijual_hash values('','".$_SESSION['id']."','".$_POST['no_seri']."')");
	if ($simpan) {
		echo "<script>window.location='index.php?page=simpan_jual_alkes'</script>";
		}
	}
	
if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from barang_dijual_hash where id=".$_GET['id_hapus']."");
	}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Jual Alkes</h1><ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Jual Alkes</li>
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
              
                <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th colspan="9" align="left" valign="bottom">Marketing : <?php echo $_SESSION['marketing']; ?>&nbsp;&nbsp;&nbsp;&nbsp; , Sub Distributor : <?php echo $_SESSION['subdis']; ?>&nbsp;&nbsp;&nbsp;&nbsp; , Diskon : <?php echo $_SESSION['diskon']." %"; ?>&nbsp;&nbsp;&nbsp;&nbsp; , PPN : <?php echo $_SESSION['ppn']." %"; ?></th>
      </tr>
    <tr>
      <th valign="bottom">&nbsp;</th>
      <th valign="bottom">&nbsp;</th>
      <th valign="bottom">&nbsp;</th>
      <th valign="bottom">&nbsp;</th>
      <th valign="bottom">&nbsp;</th>
      <th valign="bottom">&nbsp;</th>
      <th valign="bottom">&nbsp;</th>
      <th valign="bottom">&nbsp;</th>
      <th valign="bottom">&nbsp;</th>
    </tr>
    <tr>
      <th valign="bottom"><strong>Tgl Jual</strong></th>
      <th valign="bottom">No Faktur</th>
      <th valign="bottom">Nama RS/Dinas/Klinik/dll</th>
      <th valign="bottom"><strong>Kelurahan</strong></th>
      <th valign="bottom">Alamat</th>
      <th valign="bottom"><strong>Kontak RS/Dinas/dll</strong></th>
      <th valign="bottom"><strong>Nama Pemakai</strong></th>
      <th valign="bottom">Kontak Pemakai</th>
      <th valign="bottom">Email</th>
      </tr>
  </thead>
  <tr>
    <td><?php echo date("d-m-Y",strtotime($_SESSION['tgl_jual'])); ?>
    </td>
    <td><?php echo $_SESSION['no_faktur']; ?></td>
    <td><?php echo $_SESSION['pembeli']; ?></td>
    <td><?php echo $_SESSION['kelurahan']; ?></td>
    <td><?php echo $_SESSION['alamat']; ?></td>
    <td><?php echo $_SESSION['kontak_rs']; ?></td>
    <td><?php echo $_SESSION['pemakai']; ?></td>
    <td><?php echo $_SESSION['kontak1']." / ".$_SESSION['kontak2']; ?></td>
    <td><?php echo $_SESSION['email']; ?></td>
    </tr>
</table><br />
                <font align="left" size="+2">
                  Tambah Data Alkes Yang Akan Dijual</font><font class="pull pull-right" color="#FF0000">(* Yang tidak bisa di pilih menandakan barang sudah dijual)</font>
                <!--<font color="#FF0000">* Jika Ingin Menambah Data Aksesoris Yang Baru ! Klik Disini <a href="index.php?page=simpan_tambah_aksesoris&id=<?php //echo $_GET['id']; ?>#openAkse"><small data-toggle="tooltip" title="Tambah Aksesoris Baru" class="label bg-blue">+ New Accessories</small></a></font>-->
                <br />
                <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">No</th>
      <th valign="bottom"><strong>Nama Alkes</strong></th>
      <td align="center" valign="bottom"><strong>Tipe      
      </strong>
      <td align="center" valign="bottom"><strong>Merk      
      </strong>
      <td align="center" valign="bottom"><strong>NIE      
      </strong>
      <td align="center" valign="bottom"><strong>No Seri</strong>
      <td align="center" valign="bottom"><strong>Aksi</strong></tr>
  </thead>
  
  <tr>
    <td>#</td>
    <form method="post" name="form1" enctype="multipart/form-data">
    <td>
    <select name="id_akse" id="id_akse" class="form-control" autofocus="autofocus" required onchange="changeValue(this.value)">
    	<option>-- Pilih Alkes</option>
        <?php 
		$q = mysqli_query($koneksi, "select * from barang_gudang where stok_total!=0 order by nama_brg ASC");
		$jsArray = "var dtBrg = new Array();
";
		while ($d = mysqli_fetch_array($q)) { ?>
        <option value="<?php echo $d['id']; ?>"><?php echo $d['nama_brg']; ?></option>
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
    <td align="center"><input id="no_akse" name="no_akse" class="form-control" type="text" placeholder="No Akse" disabled="disabled" /></td>
    <td align="center">
    <select name="no_seri" id="no_seri" class="form-control">
    <option value="">--Pilih No Seri--</option>
    <?php 
	$q_seri = mysqli_query($koneksi, "select *,barang_gudang_detail.id as idd from barang_gudang_detail INNER JOIN barang_gudang ON barang_gudang.id=barang_gudang_detail.barang_gudang_id and status_terjual=0 and status_kerusakan=0 order by no_seri_brg ASC");
	while ($d_seri=mysqli_fetch_array($q_seri)) {
	?>
    <option id="no_seri" value="<?php echo $d_seri['idd']; ?>" class="<?php echo $d_seri['barang_gudang_id']; ?>" <?php if ($d_seri['status_terjual']==1) { echo "disabled"; } ?>><?php echo $d_seri['no_seri_brg']; ?></option>
    <?php } ?>
    </select>
    <script src="jquery-1.10.2.min.js"></script>
        <script src="jquery.chained.min.js"></script>
        <script>
            $("#no_seri").chained("#id_akse");
        </script>
    </td>
    <td align="center"><button name="simpan_tambah_aksesoris" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah</button></td>
    </form>
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
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $data_akse['nama_brg']; ?>
    </td>
    <td align="center"><?php echo $data_akse['tipe_brg']; ?></td>
    <td align="center"><?php echo $data_akse['merk_brg']; ?></td>
    <td align="center"><?php echo $data_akse['nie_brg']; ?></td>
    <td align="center"><?php echo $data_akse['no_seri_brg']; ?></td>
    <td align="center"><a href="index.php?page=simpan_jual_alkes&id_hapus=<?php echo $data_akse['idd']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a></td>
    </tr>
  <?php }} else {
	  echo "<tr><td colspan='7' align='center'>Tidak Ada Data</td></tr>";
	  } ?>
</table>
<center><a href="index.php?page=simpan_jual_alkes&simpan_barang=1"><button name="simpan_" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button></a>&nbsp;&nbsp;<a href="index.php?page=jual_barang"><button name="batal" class="btn btn-success" type="submit"><span class="fa  fa-times-circle"></span> Batal</button></a></center>
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
