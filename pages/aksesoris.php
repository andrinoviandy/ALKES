<?php
if (isset($_POST['pencarian'])) {
		if ($_POST['pilihan']=='tgl_po_pesan') {
		echo "<script>window.location='index.php?page=$_GET[page]&tgl_awal=$_POST[tgl_awal]&tgl_akhir=$_POST[tgl_akhir]&tampil=$_POST[tampil]'</script>";
		} else {
		echo "<script>window.location='index.php?page=$_GET[page]&pilihan=$_POST[pilihan]&kunci=$_POST[kata_kunci]&tampil=$_POST[tampil]'</script>";
		}
		
	}

if (isset($_GET['id_hapus'])) {
	$hapus2 = mysqli_query($koneksi, "delete from aksesoris_detail where aksesoris_id=".$_GET['id_hapus']."");
	$hapus1 = mysqli_query($koneksi, "delete from aksesoris_po where aksesoris_id=".$_GET['id_hapus']."");
	$hapus = mysqli_query($koneksi, "delete from aksesoris where id=".$_GET['id_hapus']."");
if ($hapus and $hapus1 and $hapus2) {
		echo "<script type='text/javascript'>
		alert('Data berhasil di hapus !');
		window.location='index.php?page=aksesoris'
		</script>";
		}
else {
		echo "<script type='text/javascript'>
	alert('Maaf Data Tidak Dapat Dihapus !');	window.location='index.php?page=aksesoris'
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Aksesoris Alkes</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Aksesoris Alkes</li>
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
              <div class="input-group pull pull-left col-xs-1" style="padding-right:10px">
              <a href="index.php?page=tambah_akse">
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah Aksesoris</button></a></div>
              
              <!--<form method="post" action="cetak_stok_alkes.php">-->
              
              
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
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
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
        
       
        <th valign="top"><strong>Nama Aksesoris</strong></th>
      <th valign="top"><strong>Merk</strong></th>
      <th valign="top"><strong>Tipe</strong></th>
      <th valign="top">NIE</th>
      <th align="center" valign="top"><strong>Deskripsi        
        </strong></th>
        <th align="center" valign="top"><strong>Stok</strong></th>
        <th align="center" valign="top"><strong>Stok PO</strong></th>
        <th align="center" valign="top"><strong>Stok Sisa</strong></th>
        <th align="center" valign="top"><strong>Terkirim</strong></th>        
        <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator']) or isset($_SESSION['user_admin_keuangan']) && isset($_SESSION['pass_admin_keuangan'])) { ?>
        <th align="center" valign="top"><strong>Harga Beli        
        </strong></th>
        <th align="center" valign="top">Harga Jual</th>
        <?php } ?>
        <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator']) or isset($_SESSION['user_admin_gudang']) or isset($_SESSION['user_admin_keuangan']) or isset($_SESSION['adminpoluar']) or isset($_SESSION['adminpodalam'])) { ?>
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
    
    <td>
    <?php echo $json[$i]['nama_akse']; ?>
  </td>
    
      <td><?php echo $json[$i]['merk_akse']; ?></td>
    <td><?php echo $json[$i]['tipe_akse']; ?></td>
    <td><?php echo $json[$i]['nie_akse']; ?></td>
    <td align=""><?php echo $json[$i]['deskripsi_akse']; ?></td>
    
    <td align=""><?php
                                          $stok_total = mysqli_fetch_array(mysqli_query($koneksi, "select COUNT(*) as total from aksesoris_detail where status_kirim_akse=0 and aksesoris_id=" . $json[$i]['idd'] . ""));
                                          echo $stok_total['total']; ?></td>
    <td align="">
	<?php 
	$stok_po1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual_akse) as stok_po from aksesoris_jual_qty where aksesoris_id=".$json[$i]['idd'].""));
	$stok_po2 = mysqli_num_rows(mysqli_query($koneksi, "select * from aksesoris_kirim_detail,aksesoris_detail,aksesoris_jual_qty where aksesoris_detail.id=aksesoris_kirim_detail.aksesoris_detail_id and aksesoris_jual_qty.id=aksesoris_kirim_detail.aksesoris_jual_qty_id and aksesoris_jual_qty.aksesoris_id=".$json[$i]['idd'].""));
	echo $stok_po1['stok_po']-$stok_po2; ?></td>
    <?php if ($json[$i]['stok_total_akse']-($stok_po1['stok_po']-$stok_po2)<=0) {
		$color="red";
		} else {$color="";} ?>
    <td align="" style="background-color:<?php echo $color; ?>"><?php echo $stok_total['total']-($stok_po1['stok_po']-$stok_po2); ?></td>
    <td align="" ><?php echo $stok_po2; ?></td>
    <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator']) or isset($_SESSION['user_admin_keuangan'])) { ?>
    <td align=""><?php echo "Rp ".number_format($json[$i]['harga_beli_akse'],2,',','.'); ?></td>
    
    <td align=""><?php echo "Rp ".number_format($json[$i]['harga_akse'],2,',','.'); ?></td>
    <?php } ?>
    
    <td align="">
      <form method="post">
        <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator'])) { ?>
        <a href="index.php?page=aksesoris&id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a> &nbsp;<a href="index.php?page=ubah_akse2&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp;<!--<a href="index.php?page=aksesoris&id=<?php echo $json[$i]['idd']; ?>#openPilihan"><small data-toggle="tooltip" title="Jual Alkes" class="label bg-blue">Jual</small></a>-->
        <!-- Tombol Jual -->
        <?php } ?>
		<?php if (isset($_SESSION['user_admin_gudang']) or isset($_SESSION['user_admin_keuangan']) or isset($_SESSION['adminpoluar']) or isset($_SESSION['adminpodalam'])) { ?>
			<a href="index.php?page=ubah_akse2&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp;<!--<a href="index.php?page=barang_masuk&id=<?php echo $json[$i]['idd']; ?>#openPilihan"><small data-toggle="tooltip" title="Jual Alkes" class="label bg-blue">Jual</small></a>-->
            
			<?php } ?>
          
          <input type="hidden" name="id" value="<?php echo $json[$i]['idd']; ?>"/>
          </a>
        </form>
    </td>
    
  </tr>
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
	if (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
$queryy = mysqli_query($koneksi, "select *,aksesoris.id as idd from aksesoris where $_GET[pilihan] like '%$_GET[kunci]%' order by nama_akse ASC");
	}
	else {
	$queryy = mysqli_query($koneksi, "select *,aksesoris.id as idd from aksesoris order by nama_akse ASC");
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
<div class="modal fade" id="modal-pencarian">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pencarian</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <select class="form-control select2" name="pilihan" required style="width:100%">
                <option value="">...</option>
                <option value="nama_akse">Berdasarkan Nama Aksesoris</option>
                <option value="nie_akse">Berdasarkan NIE Aksesoris</option>
                <option value="tipe_akse">Berdasarkan Tipe Aksesoris</option>
                <option value="merk_akse">Berdasarkan Merk Aksesoris</option>
                <option value="negara_asal_akse">Berdasarkan Negara Asal</option>
                </select>
                <br /><br />
                <input type="text" class="form-control" name="kata_kunci" placeholder="Kata Kunci"/>
                <br />
                <select name="tampil" class="form-control select2" style="width:100%">
                <option value="">...</option>
                <option value="1">Tampilkan Detail Barang</option>
                <option value="0">Tidak Tampilkan Detail Barang</option>
                </select>
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
<div id="openPilihan" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <br />
        <a href="index.php?page=aksesoris_jual&id=<?php echo $_GET['id']; ?>"><button id="buttonn">Data Dinas/RS/Puskesmas/Klinik Baru</button></a>
        <a href="index.php?page=aksesoris_jual2&id=<?php echo $_GET['id']; ?>"><button id="buttonn">Dari Data Dinas/RS/Puskesmas/Klinik<br />Yang Sudah Terinput</button></a>
    </div>
</div>


