<?php 
if (isset($_POST['pencarian'])) {
		if ($_POST['pilihan']=='tgl_jual') {
		echo "<script>window.location='index.php?page=$_GET[page]&tgl1=$_POST[tgl1]&tgl2=$_POST[tgl2]&tampil=$_POST[tampil]'</script>";
		}
		elseif ($_POST['pilihan']=='status') {
		echo "<script>window.location='index.php?page=$_GET[page]&status_barang=$_POST[status_barang]&tampil=$_POST[tampil]'</script>";
		}
		 else {
		echo "<script>window.location='index.php?page=$_GET[page]&pilihan=$_POST[pilihan]&kunci=$_POST[kata_kunci]&tampil=$_POST[tampil]'</script>";
		}
	}

if (isset($_GET['id_hapus'])) {
	$hapus2 = mysqli_query($koneksi, "delete from aksesoris_jual_detail where aksesoris_jual_id=".$_GET['id_hapus']."");
	//$hapus1 = mysqli_query($koneksi, "delete from aksesoris_jual where aksesoris_id=".$_GET['id_hapus']."");
	$hapus = mysqli_query($koneksi, "delete from aksesoris_jual where id=".$_GET['id_hapus']."");
if ($hapus and $hapus2) {
		echo "<script type='text/javascript'>
		alert('Data berhasil di hapus !');
		window.location='index.php?page=penjualan_aksesoris'
		</script>";
		}
else {
		echo "<script type='text/javascript'>
	alert('Maaf Data Tidak Dapat Dihapus !');	window.location='index.php?page=penjualan_aksesoris'
		</script>";
		}
	}

if (isset($_POST['kirim_barang'])) {
	$_SESSION['nama_paket']=$_POST['nama_paket'];
	$_SESSION['no_pengiriman']=$_POST['no_pengiriman'];
	$_SESSION['tgl_pengiriman']=$_POST['tgl_kirim'];
	$_SESSION['no_po']=$_POST['no_po'];
	echo "<script type='text/javascript'>
		window.location='index.php?page=pilih_no_seri_akse&id=".$_POST['idd']."';
		</script>";
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Pengiriman Aksesoris</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pengiriman Aksesoris</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-default"><!-- /.chat -->
            <div class="box-footer">
              <div class="box-body table-responsive no-padding">
              <div class="">
              	<?php if (isset($_SESSION['user_admin_keuangan']) or isset($_SESSION['user_administrator'])) { ?>
              <a href="index.php?page=jual_akse">
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Jual</button></a>
             
			 <?php } ?>
             <div class="pull pull-right">
              <button class="btn btn-success" data-toggle="modal" data-target="#modal-pencarian"><span class="fa fa-search"></span> Pencarian</button>&nbsp;&nbsp;
              <?php if (isset($_GET['kunci']) or isset($_GET['tgl1'])) { ?>
              <a href="?page=<?php echo $_GET['page'] ?>"><button class="btn btn-info"><span class="fa fa-refresh"></span> Reset</button></a>&nbsp;&nbsp;
              <?php } ?>
              <a data-toggle="tooltip" data-title="Jumlah Data Yang Ditampilkan Per Halaman"><button data-toggle="modal" data-target="#modal-atur" name="limit" class="btn btn-default" type="button"><span class="fa fa-cog"></span></button></a>
              </div>
              </div>
              </div>
            </div>
          </div>
          </section>
        <?php include "header_pencarian.php"; ?>
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
              <div class="box-body table-responsive no-padding">
              <div class="">
              
              
                <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th align="center">#</th>
      <th valign="top">Tgl Jual</th>
      <th valign="top">No PO</th>
        
       
        <th valign="top"><strong>Nama Aksesoris</strong><span class="pull pull-right">Qty</span></th>
        <th align="center" valign="top">Sisa Belum Dikirim</th>
      
      <th align="center" valign="top"><strong>Dinas/RS/Puskemas/Klinik</strong></th>
        <th align="center" valign="top"><strong>Kontak RS/Dinas/Dll</strong></th>
        <th align="center" valign="top">Diskon</th>
        <th align="center" valign="top">PPN</th>
        <th align="center" valign="top">Marketing</th>
        <th align="center" valign="top">Subdis</th>        
        
        <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator']) or isset($_SESSION['user_admin_gudang']) && isset($_SESSION['pass_admin_gudang'])) { ?>
        <th align="center" valign="top"><strong>Aksi</strong></th>
        <?php } ?>
          </tr>
  </thead>
  <?php
 
// membuka file JSON
if (isset($_GET['pilihan']) and isset($_GET['kunci'])) {
	$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]&pilihan=$_GET[pilihan]&kunci=".str_replace(" ","%20",$_GET['kunci'])."");
}
elseif (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
	$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]&tgl1=".$_GET['tgl1']."&tgl2=".$_GET['tgl2']."");
}
else {
$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]");
}
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
?>
  <tr>
    <td align="center"><?php
	$akh =0; 
	if (isset($_GET['paging'])) {
		if ($_GET['paging']==1) {
			echo $i+1;
			$akh = $i+1;
			}
		else {
			$sel = mysqli_fetch_array(mysqli_query($koneksi, "select jumlah_limit from limiter"));
			echo (($_GET['paging']-1)*$sel['jumlah_limit'])+$i+1;
			$akh = (($_GET['paging']-1)*$sel['jumlah_limit'])+$i+1;
			}
	} else {
		echo $i+1;
		$akh = $i+1;
		}
	?></td>
    <td><?php echo date("d-m-Y",strtotime($json[$i]['tgl_jual_akse'])); ?></td>
    <td><?php echo $json[$i]['no_po_jual_akse']; ?></td>
    
    <td>
    <table width="100%" border="0">
      <?php 
	  $q2=mysqli_query($koneksi, "select *,aksesoris_jual_qty.id as id_qty from aksesoris_jual_qty,aksesoris where aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual_qty.aksesoris_jual_id=".$json[$i]['idd']."");
	  $n=0;
	  while ($d1=mysqli_fetch_array($q2)) {
	  $n++;
	  if ($n%2==0) {
		  $col="#CCCCCC";
		  }
		  else {
			  $col="#999999";
			  }
	  ?>
      <tr bgcolor="<?php echo $col; ?>">
        <td style="padding-left:2px" align="left"><?php echo $d1['nama_akse'] ?></td>
        <td style="padding-right:2px" align="right"><?php echo $d1['qty_jual_akse']; ?>
        <?php
        $q4 = mysqli_num_rows(mysqli_query($koneksi , "select * from aksesoris_kirim_detail where aksesoris_jual_qty_id=".$d1['id_qty'].""));
		if ($q4!=0) {
		?>
        &nbsp;&nbsp;<span class="fa fa-plane"></span>&nbsp;
        <?php } ?>
        </td>
        </tr>
      <?php } ?>
    </table>
    </td>
    <td align="">
    <table width="100%" border="0">
      <?php 
	  $q2=mysqli_query($koneksi, "select *,aksesoris_jual_qty.id as id_det_jual from aksesoris_jual_qty,aksesoris where aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual_qty.aksesoris_jual_id=".$json[$i]['idd']."");
	  $n=0;
	  while ($d1=mysqli_fetch_array($q2)) {
	  $n++;
	  if ($n%2==0) {
		  $col="#CCCCCC";
		  }
		  else {
			  $col="#999999";
			  }
	  ?>
      <tr bgcolor="<?php echo $col; ?>">
        <td style="padding-left:2px" align="left"><?php echo $d1['nama_akse'] ?></td>
        <td style="padding-right:2px" align="right"><?php 
		$q4 = mysqli_num_rows(mysqli_query($koneksi , "select * from aksesoris_kirim_detail where aksesoris_jual_qty_id=".$d1['id_det_jual'].""));
		echo $d1['qty_jual_akse']-$q4;
		if ($d1['qty_jual_akse']-$q4==0) {
			echo "<span class='fa fa-check'></span>";
			}
		 ?></td>
        </tr>
      <?php } ?>
    </table>
    </td>
    
    <td align=""><?php echo $json[$i]['nama_pembeli']; ?></td>
    <td align="" style="background-color:<?php echo $color; ?>"><?php echo $json[$i]['kontak_rs']; ?></td>
    <td align="" style="background-color:<?php echo $color; ?>"><?php echo $json[$i]['diskon_akse']; ?></td>
    <td align="" style="background-color:<?php echo $color; ?>"><?php echo $json[$i]['ppn_akse']; ?></td>
    <td align="" style="background-color:<?php echo $color; ?>"><?php echo $json[$i]['marketing_akse']; ?></td>
    <td align="" style="background-color:<?php echo $color; ?>"><?php echo $json[$i]['subdis_akse']; ?></td>
    
    <td align="">
      <form method="post">
        <!--
        <a href="index.php?page=penjualan_aksesoris&id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a> <!--&nbsp;<a href="index.php?page=ubah_akse_jual2&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp;--><!--<a href="index.php?page=aksesoris&id=<?php echo $json[$i]['idd']; ?>#openPilihan"><small data-toggle="tooltip" title="Jual Alkes" class="label bg-blue">Jual</small></a>-->
        <!-- Tombol Jual -->
        
		
			<!--<a href="index.php?page=ubah_akse_jual2&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp;<a href="index.php?page=barang_masuk&id=<?php echo $json[$i]['idd']; ?>#openPilihan"><small data-toggle="tooltip" title="Jual Alkes" class="label bg-blue">Jual</small></a>-->
          
            
          
          <input type="hidden" name="id" value="<?php echo $json[$i]['idd']; ?>"/>
          <a href="#" data-toggle="modal" data-target="#modal-kirim<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Kirim Aksesoris" class="label bg-blue">Kirim</small></a>&nbsp;<a href="index.php?page=detail_penjualan_aksesoris&id=<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Detail Kirim" class="label bg-yellow">Lihat</small></a>
        </form>
    </td>
    
  </tr>
  <div class="modal fade" id="modal-kirim<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Kirim Aksesoris</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <input type="hidden" name="idd" value="<?php echo $json[$i]['idd']; ?>" />
              <label>Nama Paket</label>
     <input id="input" type="text" placeholder="" name="nama_paket" required>
     <label>No. Pengiriman</label>
     <input id="input" type="text" placeholder="" name="no_pengiriman" required>
     <label>Tanggal Pengiriman</label>
     <input id="input" type="date" placeholder="" name="tgl_kirim" required>
     <label>No. PO</label>
     <input id="input" type="text" placeholder="" name="no_po" value="<?php echo $json[$i]['no_po_jual_akse']; ?>" readonly="readonly">
     
        
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button name="kirim_barang" type="submit" class="btn btn-success">Simpan</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
  <?php } ?>
</table>
</div>
              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        <?php if ($jml!=0) { ?>
  <section class="col-lg-12">      
<center>
	<ul class="pagination btn-success">
    <?php
	include "paging_awal.php";
	?>
    <?php
	$query12 = mysqli_query($koneksi, "SELECT jumlah_limit FROM limiter");
    list($surat_masuk) = mysqli_fetch_array($query12);
	//pagging
    $limit = $surat_masuk;
	if (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
$queryy = mysqli_query($koneksi, "select *,aksesoris_jual.id as idd from aksesoris_jual,pembeli where pembeli.id=aksesoris_jual.pembeli_id and tgl_jual_akse between '$_GET[tgl1]' and '$_GET[tgl2]' order by tgl_jual_akse DESC, aksesoris_jual.id DESC");
}
elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
$queryy = mysqli_query($koneksi, "select *,aksesoris_jual.id as idd from aksesoris_jual,pembeli,aksesoris_jual_qty,aksesoris where aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual.id=aksesoris_jual_qty.aksesoris_jual_id and pembeli.id=aksesoris_jual.pembeli_id and $_GET[pilihan] like '%$_GET[kunci]%' group by aksesoris_jual.id order by tgl_jual_akse DESC, aksesoris_jual.id DESC");
}
 else {
$queryy = mysqli_query($koneksi, "select *,aksesoris_jual.id as idd from aksesoris_jual,pembeli where pembeli.id=aksesoris_jual.pembeli_id order by tgl_jual_akse DESC");
}
	$cdata = mysqli_num_rows($queryy);
    $j = ceil($cdata/$limit);
	if ($j > 10) {
		include "paging_lebih_dari_10.php";
	} 
	//< 10 Halaman
	else {
		include "paging_kurang_dari_10.php";
	}
	?>
    <?php
	include "paging_akhir.php";
	?>
    </ul>
</center>
<?php
include "paging_informasi.php";
?>

  </section>
  <?php } ?>
    <!-- /.content -->
  <?php include "atur_halaman.php"; ?>
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
  if (isset($_POST['jual'])) {
	  $jml1 = mysqli_fetch_array(mysqli_query($koneksi, "select * from master_barang where id=".$_GET['id'].""));
	  if ($_POST['qty']<=$jml1['stok']) {
	  $q = mysqli_query($koneksi, "insert into jual_barang values('','".$_GET['id']."','".$_POST['pembeli']."','".$_POST['alamat']."','".$_POST['qty']."','".$_POST['tgl_beli']."','','','','','','','','','','','')");
	  if ($q) {
		  mysqli_query($koneksi, "update master_barang set stok=stok-".$_POST['qty']." where id=".$_GET['id']."");
		  echo "<script type='text/javascript'>
		  window.location='index.php?page=jual_barang&id_lihat_jual=".$_GET['id']."';
		  </script>";
		  }
		//$d = mysqli_fetch_array(mysqli_query($koneksi, "select * from master barang where id=".$_GET['id'].""));
  } else {
  echo "<script type='text/javascript'>
		  alert('Data Stok Kurang !');
		  </script>"; }
  }
		?>
  <div id="openQuantity" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Jual Alkes</h3> 
     <form method="post">
     Tgl Dijual
     <input id="input" type="date" placeholder="" name="tgl_beli" required>
     Pembeli
     <input id="input" type="text" placeholder="Pembeli (RS/Dinas/Puskesmas/Klinik" name="pembeli" required>
     Provinsi
     <select id="input">
     <option>-- Pilih --</option>
	 <?php $q1=mysqli_query($koneksi, "select * from alamat_provinsi order by nama_provinsi ASC"); 
	 while ($row1=mysqli_fetch_array($q1)){
	 ?>
     <option value="<?php echo $row1['id']; ?>"><?php echo $row1['nama_provinsi']; ?></option>
     <?php } ?>
     </select>
     Kabupaten
     <select id="input">
     <option>-- Pilih --</option>
     <?php $q2=mysqli_query($koneksi, "select * from alamat_kabupaten order by nama_kabupaten ASC"); 
	 while ($row2=mysqli_fetch_array($q2)){
	 ?>
     <option value="<?php echo $row2['id']; ?>"><?php echo $row2['nama_kabupaten']; ?></option>
     <?php } ?>
     </select>
     Kecamatan
     <select id="input">
     <option>-- Pilih --</option>
     <?php $q3=mysqli_query($koneksi, "select * from alamat_kecamatan order by nama_kecamatan ASC"); 
	 while ($row3=mysqli_fetch_array($q3)){
	 ?>
     <option value="<?php echo $row3['id']; ?>"><?php echo $row3['nama_kecamatan']; ?></option>
     <?php } ?>
     </select>
     Alamat Jalan
     <input id="input" type="text" placeholder="Jl.Xxx" name="alamat" required>
     Quantity
        <input id="input" type="text" placeholder="Quantity" name="qty" required>
        <button id="buttonn" name="jual" type="submit">Jual Alkes</button>
    </form>
    </div>
</div>

<div id="openPilihan" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <br />
        <a href="index.php?page=aksesoris_jual&id=<?php echo $_GET['id']; ?>"><button id="buttonn">Data Dinas/RS/Puskesmas/Klinik Baru</button></a>
        <a href="index.php?page=aksesoris_jual2&id=<?php echo $_GET['id']; ?>"><button id="buttonn">Dari Data Dinas/RS/Puskesmas/Klinik<br />Yang Sudah Terinput</button></a>
    </div>
</div>

<!--kirim akssoris-->
<?php 

if (isset($_POST['kirim2_barang'])) {
	if ($_POST['id_alkes']=='all') { 
	$update = mysqli_query($koneksi, "insert into barang_dikirim values('','".$_POST['nama_paket']."','".$_POST['no_peng']."','".$_POST['tgl_kirim']."','".$_POST['no_po']."','0000-00-00')");
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_kirim from barang_dikirim"));
	$sel = mysqli_query($koneksi, "select * from barang_dijual_detail where barang_dijual_id=".$_GET['id']."");
	$tot_sel = mysqli_num_rows($sel);
	while ($data_sel = mysqli_fetch_array($sel)) {
		$ins = mysqli_query($koneksi, "insert into barang_dikirim_detail values('','".$max['id_kirim']."','".$data_sel['id']."')");	
		}
	
	if ($update and $ins) {
		mysqli_query($koneksi, "update barang_dijual_detail set status_kirim=1 where barang_dijual_id=".$_GET['id']."");	
		
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Simpan !');
		window.location='index.php?page=kirim_barang&id_krm=".$_GET['id']."';
		</script>";
		}
	else {
		echo "<script type='text/javascript'>
		alert('Gagal Disimpan');
		</script>";
		}
	}
	else {
	$update = mysqli_query($koneksi, "insert into barang_dikirim values('','".$_POST['nama_paket']."','".$_POST['no_peng']."','".$_POST['tgl_kirim']."','".$_POST['no_po']."','0000-00-00')");
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_kirim from barang_dikirim"));
	$ins = mysqli_query($koneksi, "insert into barang_dikirim_detail values('','".$max['id_kirim']."','".$_POST['id_alkes']."')");
	if ($update and $ins) {
		mysqli_query($koneksi, "update barang_dijual_detail set status_kirim=1 where id=".$_POST['id_alkes']."");
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Simpan !');
		window.location='index.php?page=kirim_barang&id_krm=".$_GET['id']."';
		</script>";
		}
	else {
		echo "<script type='text/javascript'>
		alert('Gagal Disimpan');
		</script>";
		}
	}}
?>
  <div id="openKirim" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Kirim Aksesoris</h3> 
     <form method="post">
     <!--<label>Pilih Aksesoris</label>
     <select id="input" name="id_alkes" required>
     	<?php 
		$q3 = mysqli_query($koneksi, "select *,aksesoris_jual_detail.id as idd from aksesoris_jual_detail,aksesoris,aksesoris_detail where aksesoris_detail.id=aksesoris_jual_detail.aksesoris_detail_id and aksesoris.id=aksesoris_detail.aksesoris_id and status_kirim_akse=0 and aksesoris_jual_id=".$_GET['id']."");
		$q4 = mysqli_query($koneksi, "select *,aksesoris_jual_detail.id as idd from aksesoris_jual_detail,aksesoris,aksesoris_detail where aksesoris_detail.id=aksesoris_jual_detail.aksesoris_detail_id and aksesoris.id=aksesoris_detail.aksesoris_id and status_kirim_akse=1 and aksesoris_jual_id=".$_GET['id'].""); 
		$d4 = mysqli_num_rows($q4);
		if ($d4==0) {
		?>
        <option value="all">All</option>
        <?php } ?>
        <?php
		while ($d3 = mysqli_fetch_array($q3)) { ?>
		<option value="<?php echo $d3['idd']; ?>"><?php echo $d3['nama_akse']." - No Seri : ".$d3['no_seri_akse']; ?></option>
		<?php } ?>
     </select>-->
     <label>Nama Paket</label>
     <input id="input" type="text" placeholder="" name="nama_paket" required>
     <label>No. Pengiriman</label>
     <input id="input" type="text" placeholder="" name="no_pengiriman" required>
     <label>Tanggal Pengiriman</label>
     <input id="input" type="date" placeholder="" name="tgl_kirim" required>
     <label>No. PO</label>
     <input id="input" type="text" placeholder="" name="no_po" value="<?php
     $d5 = mysqli_fetch_array(mysqli_query($koneksi, "select no_po_jual_akse from aksesoris_jual where id=".$_GET['id'].""));
	 echo $d5['no_po_jual_akse'];
	 ?>" readonly="readonly">
     
        <button id="buttonn" name="kirim_barang" type="submit">Next</button>
    </form>
    </div>
</div>

<div class="modal fade" id="modal-pencarian">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              <script type="text/javascript">
			  function yesnoCheck() {
				  if (document.getElementById('yesCheck').value=='tgl_jual') {
					  document.getElementById('ifYes').style.display = 'block';
					  document.getElementById('kata_kunci').style.display = 'none';
					  document.getElementById('status').style.display = 'none';
					  }
					  else if (document.getElementById('yesCheck').value=='status')
					  { document.getElementById('ifYes').style.display = 'none';
					  document.getElementById('kata_kunci').style.display = 'none';
					  document.getElementById('status').style.display = 'block';
					  }
					  else 
					  { document.getElementById('ifYes').style.display = 'none';
					  document.getElementById('kata_kunci').style.display = 'block';
					  document.getElementById('status').style.display = 'none';
					  }
					  }

 

</script>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pencarian</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <select class="form-control select2" name="pilihan" required style="width:100%" onchange="javascript:yesnoCheck();" id="yesCheck">
                <option value="">...</option>
                <option value="tgl_jual">Berdasarkan Rentang Tanggal Jual</option>
                <option value="no_po_jual_akse">Berdasarkan Nomor PO</option>
                <option value="nama_pembeli">Berdasarkan Nama RS/Dinas/Klink/Dll</option>
                <option value="nama_akse">Berdasarkan Nama Barang</option>
                <option value="tipe_akse">Berdasarkan Tipe Barang</option>
                <option value="marketing_akse">Berdasarkan Marketing</option>
                <!--<option value="status">Status Terkirim / Belum Terkirim</option>-->
                </select>
                <br /><br />
                <div id="kata_kunci" style="display:block">
                <input type="text" class="form-control" name="kata_kunci" placeholder="Kata Kunci"/>
                </div>
                <div id="status" style="display:none">
                <select name="status_kirim_jual_akse" class="form-control select2" style="width:100%">
                <option value="">...</option>
                <option value="Belum">Belum Terkirim</option>
                <option value="Sudah">Sudah Terkirim</option>
                </select>
                </div>
                <div id="ifYes" style="display:none">
              <label>Dari Tanggal</label>
              <input name="tgl1" type="date" class="form-control" placeholder="" value=""><br />
              <label>Sampai Tanggal</label>
              <input name="tgl2" type="date" class="form-control" placeholder="" value="">
              </div>
              
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" name="pencarian">Cari</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

