<?php
if (isset($_POST['pencarian'])) {
		if ($_POST['pilihan']=='tgl_jual') {
		echo "<script>window.location='index.php?page=$_GET[page]&tgl1=$_POST[tgl1]&tgl2=$_POST[tgl2]'</script>";
		} else {
		echo "<script>window.location='index.php?page=$_GET[page]&kunci=$_POST[kata_kunci]'</script>";
		}
	}

if (isset($_POST['cetak'])) {
		echo "<script>window.location='cetak_penjualan_akse.php?tgl1=$_POST[tgl_a]&tgl2=$_POST[tgl_b]'</script>";
		echo "";
	}

if (isset($_GET['id_batal'])) {
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from aksesoris_jual where id=".$_GET['id_batal'].""));
	$del0 = mysqli_query($koneksi, "delete from utang_piutang_aksesoris where no_faktur_no_po_akse='".$sel['no_po_jual_akse']."'"); 
	$del1=mysqli_query($koneksi, "delete from aksesoris_jual_qty where aksesoris_jual_id=".$_GET['id_batal']."");
	$del2=mysqli_query($koneksi, "delete from aksesoris_jual where id=".$_GET['id_batal']."");
	
	if ($del0 and $del1 and $del2) {
echo "<script>window.location='index.php?page=penjualan_aksesoris_uang;</script>";
		}
	else {
			echo "<script type='text/javascript'>alert('Maaf Data Tidak Dapat DI Hapus !');
			history.back();
			</script>";
			}
}
			 
if (isset($_GET['id_hapus'])) {
	$hapus2 = mysqli_query($koneksi, "delete from aksesoris_jual_detail where aksesoris_jual_id=".$_GET['id_hapus']."");
	//$hapus1 = mysqli_query($koneksi, "delete from aksesoris_jual where aksesoris_id=".$_GET['id_hapus']."");
	$hapus = mysqli_query($koneksi, "delete from aksesoris_jual where id=".$_GET['id_hapus']."");
if ($hapus and $hapus2) {
		echo "<script type='text/javascript'>
		window.location='index.php?page=penjualan_aksesoris'
		</script>";
		}
else {
		echo "<script type='text/javascript'>
	alert('Maaf Data Tidak Dapat Dihapus !');	window.location='index.php?page=penjualan_aksesoris'
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Penjualan Aksesoris</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Penjualan Aksesoris</li>
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
              <a href="index.php?page=jual_akse" class="col-sm-1">
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah</button></a>
              <div class="col-xs-1">
              <button class="btn btn-info" data-toggle="modal" data-target="#modal-cetak"><span class="fa fa-print"></span> Cetak</button>
              </div>
              <form method="post" action="cetak_marketing_akse.php">
              <div class="col-xs-2">  
                <select class="form-control select2" name="marketing" style="margin-right:40px">
                <option value="all">All Marketing</option>
                <?php 
				$q = mysqli_query($koneksi, "select marketing,subdis from barang_dijual group by marketing order by marketing ASC");
				while ($d = mysqli_fetch_array($q)) {
				?>
                <option value="<?php echo $d['marketing']; ?>"><?php echo $d['marketing']; ?></option>
                <?php } ?>
                </select>
                </div>
                <div class="col-xs-2">
                <select class="form-control select2" name="tahun" style="margin-right:40px">
                <?php
                $t1 = mysqli_fetch_array(mysqli_query($koneksi, "select min(tgl_jual) as tgl_min from barang_dijual"));
				$t2 = mysqli_fetch_array(mysqli_query($koneksi, "select max(tgl_jual) as tgl_max from barang_dijual"));
				$thn1 = date("Y",strtotime($t1['tgl_min']));
				$thn2 = date("Y",strtotime($t2['tgl_max']));
				for ($i=$thn1; $i<=$thn2; $i++) {
				?>
                <option <?php if (date("Y")==$i) {echo "selected";} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
                </select>
                </div>
                <div class="col-xs-1">
                <button type="submit" name="button_urut" class="btn btn-warning">Cetak</button>
                </div>
              </form>
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
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <?php include "header_pencarian.php"; ?>
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
              <div class="box-body">
              <div class="table-responsive">
                
              <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th align="center">No</th>
      <th valign="top">Tgl Jual</th>
        <th valign="top">No PO</th>
       
        <th valign="top"><strong>Nama Aksesoris</strong><span class="pull pull-right">Qty</span></th>
      
      <th align="center" valign="top"><strong>Dinas/RS/Puskemas/Klinik</strong></th>
        <th align="center" valign="top"><strong>Kontak Dinas/RS/dll</strong></th>
        <th align="center" valign="top"><strong>Diskon</strong></th>
        <th align="center" valign="top"><strong>PPN</strong></th>
        <th align="center" valign="top"><strong>Total Harga</strong></th>
        <th align="center" valign="top"><strong>Marketing</strong></th>
        <th align="center" valign="top"><strong>Subdis</strong></th>        
        
        <?php if (!isset($_SESSION['adminmanajermarketing'])) { ?>
		<?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator']) or isset($_SESSION['user_admin_gudang']) && isset($_SESSION['pass_admin_gudang'])) { ?>
        <th align="center" valign="top"><strong>Aksi</strong></th>
        <?php }} ?>
          </tr>
  </thead>
  <?php
 
// membuka file JSON
if (isset($_GET['kunci'])) {
	$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]&kunci=".str_replace(" ","%20",$_GET['kunci'])."");
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
	  $q2=mysqli_query($koneksi, "select * from aksesoris_jual_qty,aksesoris where aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual_qty.aksesoris_jual_id=".$json[$i]['idd']."");
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
        <td style="padding-right:2px" align="right"><?php echo $d1['qty_jual_akse']; ?></td>
        </tr>
      <?php } ?>
    </table>
    </td>
    
    <td align=""><?php echo $json[$i]['nama_pembeli']; ?></td>
    <td align="" style="background-color:<?php echo $color; ?>"><?php echo $json[$i]['kontak_rs']; ?></td>
    <td align=""><?php echo $json[$i]['diskon_akse']." %"; ?></td>
    <td align=""><?php echo $json[$i]['ppn_akse']." %"; ?></td>
    <td align="center"><?php echo number_format($json[$i]['total_harga'],2,',','.'); ?></td>
    <td align=""><?php echo $json[$i]['marketing_akse']; ?></td>
    <td align=""><?php echo $json[$i]['subdis_akse']; ?></td>
    <?php if (!isset($_SESSION['adminmanajermarketing'])) { ?>
    <td align="center">
      <a href="index.php?page=ubah_jual_akse_uang&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp;<a href="index.php?page=penjualan_aksesoris_uang&id_batal=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Yakin Akan Membatalkan Penjualan Item Ini ? . Proses ini akan berhasil jika bagian gudang belum memilih no seri nya !')"><span data-toggle="tooltip" title="Batalkan Penjualan" class="fa fa-close"></span></a><br /><a target="blank" href="cetak_faktur_penjualan_akse.php?id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Cetak Faktur Penjualan" class="glyphicon glyphicon-print"></span></a>
    </td>
    <?php } ?>
  </tr>
  <?php } ?>
</table>
              </div>
              </div>
            </div>
           </div>
        </section>
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
	elseif (isset($_GET['kunci'])) {
$queryy = mysqli_query($koneksi, "select *,aksesoris_jual.id as idd from aksesoris_jual,pembeli,aksesoris_jual_qty,aksesoris where aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual.id=aksesoris_jual_qty.aksesoris_jual_id and pembeli.id=aksesoris_jual.pembeli_id and no_po_jual_akse like '%$_GET[kunci]%' or aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual.id=aksesoris_jual_qty.aksesoris_jual_id and pembeli.id=aksesoris_jual.pembeli_id and marketing_akse like '%$_GET[kunci]%' or aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual.id=aksesoris_jual_qty.aksesoris_jual_id and pembeli.id=aksesoris_jual.pembeli_id and nama_pembeli like '%$_GET[kunci]%' or aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual.id=aksesoris_jual_qty.aksesoris_jual_id and pembeli.id=aksesoris_jual.pembeli_id and nama_akse like '%$_GET[kunci]%' or aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual.id=aksesoris_jual_qty.aksesoris_jual_id and pembeli.id=aksesoris_jual.pembeli_id and merk_akse like '%$_GET[kunci]%' or aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual.id=aksesoris_jual_qty.aksesoris_jual_id and pembeli.id=aksesoris_jual.pembeli_id and tipe_akse like '%$_GET[kunci]%' or aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual.id=aksesoris_jual_qty.aksesoris_jual_id and pembeli.id=aksesoris_jual.pembeli_id and nie_akse like '%$_GET[kunci]%' group by aksesoris_jual.id order by tgl_jual_akse DESC, aksesoris_jual.id DESC");
	}
	else {
	$queryy = mysqli_query($koneksi, "select *,aksesoris_jual.id as idd from aksesoris_jual,pembeli where pembeli.id=aksesoris_jual.pembeli_id order by tgl_jual_akse DESC, aksesoris_jual.id DESC");
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
  <?php include "modal-cari.php"; ?>
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
if (isset($_POST['kirim_barang'])) {
	$_SESSION['nama_paket']=$_POST['nama_paket'];
	$_SESSION['no_pengiriman']=$_POST['no_pengiriman'];
	$_SESSION['tgl_pengiriman']=$_POST['tgl_kirim'];
	$_SESSION['no_po']=$_POST['no_po'];
	echo "<script type='text/javascript'>
		window.location='index.php?page=simpan_kirim_aksesoris&id=".$_GET['id']."';
		</script>";
}
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
  <div class="modal fade" id="modal-cetak">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><center>Cetak Penjualan Aksesoris</center></h4>
              </div>
              <form method="post" enctype="multipart/form-data" action="cetak_laporan_penjualan_akse.php">
              <div class="modal-body">
              <label>Dari Tanggal</label>
              <input name="tgl1" type="date" class="form-control" placeholder="" value=""><br />
              <label>Sampai Tanggal</label>
              <input name="tgl2" type="date" class="form-control" placeholder="" value=""><br />
              <label>Status Barang</label>
              <select class="form-control" style="width:100%" name="status">
              <option value="Semua">Semua</option>
              <option value="Sudah Terkirim">Sudah Terkirim</option>
              </select>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info" name="cetak">Cetak</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>



