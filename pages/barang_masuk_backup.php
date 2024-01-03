<?php 
if (isset($_POST['pencarian'])) {
		if ($_POST['pilihan']=='tgl_po_pesan') {
		echo "<script>window.location='index.php?page=$_GET[page]&tgl_awal=$_POST[tgl_awal]&tgl_akhir=$_POST[tgl_akhir]&tampil=$_POST[tampil]'</script>";
		} else {
		echo "<script>window.location='index.php?page=$_GET[page]&pilihan=$_POST[pilihan]&kunci=$_POST[kata_kunci]&tampil=$_POST[tampil]'</script>";
		}
		
	}

if (isset($_POST['button_urut'])) {
	echo "<script>window.location='cetak_stok_alkes.php?merk=$_POST[merk]'</script>";
	}
	
if (isset($_POST['simpan_qrcode'])) {
	$simpan = mysqli_query($koneksi, "update barang_gudang set kode_qrcode='".$_POST['kode_qrcode']."' where id=".$_POST['idd']."");
	if ($simpan) {
	echo "<script>history.back()</script>";
	}
}
/*if (isset($_POST['print_barcode'])) {
	echo "<script>window.location='cetak_barcode_jenis.php?kode_barcode=$_POST[kode_barcode]&jml=$_POST[jml]'</script>";
	}*/
	
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Gudang 2 (Utama)</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Alkes</li>
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
              <a href="index.php?page=tambah_barang_masuk">
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah Alkes</button></a></div>
              
              <!--<form method="post" action="cetak_stok_alkes.php">-->
              
              <form method="post" action="cetak_stok_alkes.php">
              <div class="input-group pull pull-left col-xs-3" >
                <select class="form-control select2" name="merk" style="margin-right:40px">
                <option value="all">All Brand/Merk</option>
                <?php 
				$q = mysqli_query($koneksi, "select merk_brg from barang_gudang group by merk_brg order by merk_brg ASC");
				while ($d = mysqli_fetch_array($q)) {
				?>
                <option value="<?php echo $d['merk_brg']; ?>"><?php echo $d['merk_brg']; ?></option>
                <?php } ?>
                </select>
                
                <span class="input-group-btn">
                      <button type="submit" name="button_urut" class="btn btn-warning">Cetak Stok Alkes</button>
                    </span>
                
              </div>
              </form>
             <div class="pull pull-right">
             <!--<a href="#" data-toggle="modal" data-target="#barcode<?php echo $json[$i]['idd']; ?>"><button data-toggle="tooltip" title="Generate Barcode" class="btn btn-danger"><span class="fa fa-barcode"></span>&nbsp; Generate Barcode</button></a>-->
             
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
        <div class=""></div>
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
              <div class="box-body">
              
              <div class="table-responsive no-padding">
              <table width="100%" id="" class="table table-responsive">
                <thead>
    <tr>
      <th align="center">No</th>
      <th valign="top"><strong>Nama_Alkes</strong></th>
      <th valign="top">Type/Merk</th>
      <th valign="top">Detail Alkes</th>
      <th>Jenis Barang</th>
      <th align="center" valign="top"><strong>Stok Gudang</strong></th>
        <th>Stok PO</th>
        <th>Stok Sisa</th>
      <th align="center" valign="top">Terkirim</th>
      <th align="center" valign="top">Rusak</th>
      <th align="center" valign="top">Demo</th>
      
        <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator']) or isset($_SESSION['user_admin_keuangan']) && isset($_SESSION['pass_admin_keuangan'])  or isset($_SESSION['user_manajer_keuangan']) && isset($_SESSION['pass_manajer_keuangan'])) { ?>
        <th align="center" valign="top"><strong>Harga Beli        
        </strong></th>
        <th align="center" valign="top"><strong>Harga Jual        
        </strong></th>
        <?php } ?>
        <!--<th align="center"><strong>Kode Barcode</strong></th>-->
        <th align="center" valign="top"><strong>Pengecekan Teknisi</strong></th>
        <td align="center" valign="top"><strong>Aksi</strong></td>
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
    <?php echo $json[$i]['nama_brg']; ?>
  </td>
    <td><?php echo $json[$i]['tipe_brg']." / ".$json[$i]['merk_brg']; ?></td>
    
    <td>
    <?php if ($_GET['tampil']==1) { ?>
    <?php echo "[".$json[$i]['nie_brg']."]-[".$json[$i]['negara_asal']."]"; ?>
    <hr style="margin:0px; border-top:1px double; width:100%"/>
    <?php } else { ?>
    <a href="#" data-toggle="modal" data-target="#modal-detailbarang<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Detail Barang" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a>
    <?php } ?>
    </td>
    <td>
    <?php
    if ($json[$i]['jenis_barang']==1) { echo "E-Katalog"; }
	?>
    </td>
    <td align="center"><?php 
	$stok_total = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_detail where status_kirim=0 and status_kerusakan=0 and status_kembali_ke_gudang=0 and barang_gudang_id=".$json[$i]['idd'].""));
	echo $stok_total; ?></td>
    <td align="center"><?php 
	$stok_po1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual) as stok_po from barang_dijual_qty where barang_gudang_id=".$json[$i]['idd'].""));
	$stok_po2 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim_detail,barang_gudang_detail,barang_dijual_qty where barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual_qty.id=barang_dikirim_detail.barang_dijual_qty_id and barang_dijual_qty.barang_gudang_id=".$json[$i]['idd'].""));
	if ($stok_po1['stok_po']-$stok_po2!=0) {
	echo $stok_po1['stok_po']-$stok_po2;
	}
	 ?>
     <?php if ($stok_total-($stok_po1['stok_po']-$stok_po2)<=0) { $color="red"; } else { $color=""; } ?>
     </td>
     
     <td style="background-color:<?php echo $color; ?>"><?php 
	echo $stok_total-($stok_po1['stok_po']-$stok_po2);
	 ?></td>
    <td align="center"><?php 
	$cek_stok1=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_detail where status_kirim=1 and barang_gudang_id=".$json[$i]['idd'].""));
	if ($cek_stok1!=0) {
	echo $cek_stok1;
	} else {echo "-";} ?></td>
    <td align="center">
    <?php 
	$cek_stok2=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_detail where status_kerusakan=1 and barang_gudang_id=".$json[$i]['idd'].""));
	if ($cek_stok2!=0) {
	echo $cek_stok2;
	} else {echo "-";}?>
    </td>
    <td align="center"><?php 
	$cek_stok_demo=mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty) as total_demo from barang_demo_qty where barang_gudang_id=".$json[$i]['idd'].""));
	$cek_stok_kembali=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_demo_kirim_detail,barang_gudang_detail,barang_demo_kembali where barang_demo_kirim_detail.id=barang_demo_kembali.barang_demo_kirim_detail_id and barang_gudang_detail.id=barang_demo_kirim_detail.barang_gudang_detail_id and barang_gudang_id=".$json[$i]['idd'].""));
	if ($cek_stok_demo['total_demo']-$cek_stok_kembali!=0) {
	echo $cek_stok_demo['total_demo']-$cek_stok_kembali;
	} else {echo "-";}?></td>
    
    <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator']) or isset($_SESSION['user_admin_keuangan']) && isset($_SESSION['pass_admin_keuangan']) or isset($_SESSION['user_manajer_keuangan']) && isset($_SESSION['pass_manajer_keuangan'])) { ?>
    <td align="center"><?php echo "Rp ".number_format($json[$i]['harga_beli'],0,',','.').",-"; ?></td>
    <td align="center"><?php echo "Rp ".number_format($json[$i]['harga_satuan'],0,',','.').",-"; ?></td>
    <?php } ?>
    <!--<td><?php echo $json[$i]['kode_barcode']; ?></td>-->
    <td align="center">
    <?php if ($json[$i]['status_cek']==1){ ?>
    <span class="fa fa-check"></span>
	<?php } else { ?>
    <span class="fa fa-close"></span>
    <?php } ?>
		</td>
    <td align="center">
    <?php if (isset($_SESSION['user_admin_keuangan']) && isset($_SESSION['pass_admin_keuangan'])) { ?>
    <a href="index.php?page=ubah_barang_masuk&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>
    <?php } ?>
    <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator'])) { ?>
    <a href="index.php?page=simpan_tambah_aksesoris&id=<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Kelola Aksesoris" class="label bg-green"><span class="fa fa-cogs"></span>&nbsp; Akse</small></a>&nbsp;<a href="index.php?page=simpan_tambah_spesifikasi&id=<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Kelola Spesifikasi" class="label bg-blue"><span class="fa fa-cogs"></span>&nbsp; Spes</small></a>&nbsp;<a href="cetak_rekapan_alkes.php?id=<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Rekap Alkes" class="label bg-yellow">Excel</small></a><br />
    <a href="pages/delete_barang_masuk.php?id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a> &nbsp;<a href="index.php?page=ubah_barang_masuk&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>
      <?php if ($json[$i]['nie_brg']!="") { ?>
      
      <?php } ?>
	  <?php } ?>
<?php if (isset($_SESSION['user_admin_gudang']) && isset($_SESSION['pass_admin_gudang'])) { ?>
<a href="index.php?page=simpan_tambah_aksesoris&id=<?php echo $data['idd']; ?>"><small data-toggle="tooltip" title="Kelola Aksesoris" class="label bg-green"><span class="fa fa-cogs"></span>&nbsp; Akse</small></a>&nbsp;<a href="index.php?page=simpan_tambah_spesifikasi&id=<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Kelola Spesifikasi" class="label bg-blue"><span class="fa fa-cogs"></span>&nbsp; Spes</small></a>&nbsp;<a href="cetak_rekapan_alkes.php?id=<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Rekap Alkes" class="label bg-yellow">Excel</small></a><br />
<a href="index.php?page=ubah_barang_masuk&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>
<?php /*if ($json[$i]['nie_brg']!="") { ?>
<br />
<a href="#" data-toggle="modal" data-target="#barcode<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Cetak QRCode" class="label bg-red"><span class="fa fa-barcode"></span>&nbsp; Cetak QRCode</small></a>
<a href="#" data-toggle="modal" data-target="#buatbarcode<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Buat QRCode" class="label bg-blue"><span class="fa fa-barcode"></span>&nbsp; Buat QRCode</small></a>
<?php } */ ?>
<?php } ?>
<?php 
if (isset($_SESSION['adminpoluar']) or isset($_SESSION['adminpodalam'])) { ?>
<a href="index.php?page=ubah_barang_masuk&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>
<?php /*if ($json[$i]['nie_brg']!="") { ?>
<br />
<a href="#" data-toggle="modal" data-target="#barcode<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Cetak QRCode" class="label bg-red"><span class="fa fa-barcode"></span>&nbsp; Cetak QRCode</small></a>
<a href="#" data-toggle="modal" data-target="#buatbarcode<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Buat QRCode" class="label bg-blue"><span class="fa fa-barcode"></span>&nbsp; Buat QRCode</small></a>
<?php }*/ ?>
<?php } ?>
    </td>
  </tr>
  <div class="modal fade" id="modal-detailbarang<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Data Lengkap Alkes</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <p align="justify">
              <?php
			  echo "<b>Nama Barang :</b> <br/>".$json[$i]['nama_brg']; ?>
      <hr />
      <?php echo "<b>NIE Barang :</b> <br/>".$json[$i]['nie_brg']; ?>
      <hr />
      
      <?php echo "<b>Negara Asal :</b> <br/>".$json[$i]['negara_asal']; ?>
      <hr />
      <?php 
	  if ($json[$i]['jenis_barang']==1) {
		  $jb = "E-Katalog";
		  }
		  else {
			  $jb = "";
			  }
	  echo "<b>Jenis Barang :</b> <br/>".$jb; ?>
      <hr />
      <?php echo "<b>Deskripsi Alkes :</b> <br/>".$json[$i]['deskripsi_alat']; ?>
              </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        
        <div class="modal fade" id="barcode<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Jumlah QRCode Yang Ingin Di Cetak
                <br />
                "<?php echo $json[$i]['nama_brg']; ?>"
                </h4>
              </div>
              <form method="post" action="cetak_barcode_jenis.php" target="_blank">
              <div class="modal-body">
              <p align="justify">
              <input type="hidden" name="kode_barcode" value="<?php if ($json[$i]['kode_qrcode']=='') { echo $json[$i]['nie_brg']; } else { echo $json[$i]['kode_qrcode']; } ?>"/>
              <input type="number" name="jml" class="form-control" placeholder="Jumlah QRCode Yang Ingin Di Cetak"/>
              </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger" name="print_barcode"><i class="fa fa-print"></i> Print</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        
        <div class="modal fade" id="buatbarcode<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Buat QRCode
                <br />
                "<?php echo $json[$i]['nama_brg']; ?>"
                </h4>
              </div>
              <form method="post" action="">
              <div class="modal-body">
              <p align="justify">
              <input type="hidden" name="idd" value="<?php echo $json[$i]['idd'] ?>"/>
              <input type="text" name="kode_qrcode" class="form-control" value="<?php echo $json[$i]['kode_qrcode'] ?>" placeholder="Kode QRCode"/>
              </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info" name="simpan_qrcode"><i class="fa fa-save"></i> Simpan</button>
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
              <br />

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
		if ($_GET['pilihan']=='qrcode') {
		$queryy = mysqli_query($koneksi, "select *,barang_gudang.id as idd from barang_gudang,barang_gudang_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and $_GET[pilihan] like '%$_GET[kunci]%' group by barang_gudang.id order by nama_brg ASC");
		}
		else {
		$queryy = mysqli_query($koneksi, "select *,barang_gudang.id as idd from barang_gudang where $_GET[pilihan] like '%$_GET[kunci]%' order by nama_brg ASC");
		}
	}
	else {
	$queryy = mysqli_query($koneksi, "select *,barang_gudang.id as idd from barang_gudang order by nama_brg ASC");
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
        
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

  </section>
    <!-- /.content -->
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
                <option value="nama_brg">Berdasarkan Nama Alkes</option>
                <option value="nie_brg">Berdasarkan NIE Alkes</option>
                <option value="tipe_brg">Berdasarkan Tipe Alkes</option>
                <option value="merk_brg">Berdasarkan Merk Alkes</option>
                <option value="negara_asal">Berdasarkan Negara Asal</option>
                <option value="qrcode">Berdasarkan Kode QRCode</option>
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


