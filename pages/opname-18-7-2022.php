<?php 
if (isset($_POST['kode'])) {
	$kode = $_POST['kode'];
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_gudang_detail.id as idd from barang_gudang,barang_gudang_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and qrcode='".$kode."'"));
	$cek = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang where id='".$sel['barang_gudang_id']."'"));
	if ($cek!=0) {
		$cek2 = mysqli_num_rows(mysqli_query($koneksi, "select * from stok_opname_detail where stok_opname_id=".$_GET['id']." and barang_gudang_detail_id=".$sel['idd'].""));
		if ($cek2==0) {
		mysqli_query($koneksi, "insert into stok_opname_detail values('','$_GET[id]','$sel[idd]')");
		}
		$_SESSION['id_gudang']=$sel['barang_gudang_id'];
		$_SESSION['id_detail']=$sel['idd'];
		$_SESSION['qrcode']=$kode;
		$_SESSION['status']=1;
		echo "<script>window.location='index.php?page=$_GET[page]&id=$_GET[id]&kunci=$sel[barang_gudang_id]'</script>";
		}
	else {
		$_SESSION['status']=0;
		$_SESSION['id_detail']=$sel['idd'];
		$_SESSION['qrcode']=$kode;
		$cek3 = mysqli_num_rows(mysqli_query($koneksi, "select * from stok_opname_detail_x where stok_opname_id=".$_GET['id']." and qrcode='".$kode."'"));
		if ($cek3==0) {
			mysqli_query($koneksi, "insert into stok_opname_detail_x values('','$_GET[id]','$sel[idd]','$kode')");
			}
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Stok Opname - Scan Barang</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Stok Opname</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-6">
        <?php
		  $do = mysqli_fetch_array(mysqli_query($koneksi, "select * from stok_opname where id=".$_GET['id'].""));
		  ?>
          <section class="col-lg-3">
         <div class="box box-default">
         	<div class="box-header">
            <center>Tanggal Pengecekan</center>
            </div>
            <div class="box-footer btn-default">
            <div align="center" class="box-body">
            <font size="+2"><strong><?php echo date("d F Y",strtotime($do['tgl_cek'])); ?></strong></font>
            </div>
            </div>
         </div>
         </section>
          <section class="col-lg-9">
         <div class="box box-default">
         	<div class="box-header">
            <center>Keterangan</center>
            </div>
            <div class="box-footer btn-default">
            <div align="center" class="box-body">
            <p align="justify"><?php echo $do['keterangan']; ?></p>
            </div>
            </div>
         </div>
         </section>
         </section>
         <section class="col-lg-2">
         <div class="box box-default">
         	<div class="box-header">
            <center>Jumlah Barang Discan</center>
            </div>
            <div class="box-footer btn-default">
            <div align="center" class="box-body">
            <font size="+2"><strong>
            <?php
            $jm1 = mysqli_num_rows(mysqli_query($koneksi, "select * from stok_opname_detail where stok_opname_id=".$_GET['id'].""));
			$jm2 = mysqli_num_rows(mysqli_query($koneksi, "select * from stok_opname_detail_x where stok_opname_id=".$_GET['id'].""));
			echo $jm1+$jm2;
			?>
            </strong></font>
            </div>
            </div>
         </div>
         </section>
         <section class="col-lg-2">
         <div class="box box-success">
         	<div class="box-header">
            <center>Jumlah Barang Ditemukan</center>
            </div>
            <div class="box-footer btn-success">
            <div align="center" class="box-body">
            <font size="+2" color="#FFFFFF"><strong>
            <?php echo $jm1; ?>
            </strong></font>
            </div>
            </div>
         </div>
         </section>
         <section class="col-lg-2">
         <div class="box box-danger">
         	<div class="box-header">
            <center>Jumlah Barang Tidak Ditemukan</center>
            </div>
            <div class="box-footer btn-danger">
            <div align="center" class="box-body">
            <font size="+2" color="#FFFFFF"><strong>
            <?php echo $jm2; ?>
            </strong></font>
            </div>
            </div>
         </div>
         </section>
        <section class="col-lg-12">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          
          <div class="box box-default"><!-- /.chat -->
            <div class="box-footer">
              <div class="box-body table-responsive no-padding">
              <section class="col-lg-6">
              <form method="post">
<input name="kode" class="form-control" placeholder="Masukkan QRCode Atau Klik disini untuk menggunakan scanner, lalu arahkan scanner ke QRCode" id="theFieldID" type="text"/>
</form>
              <script type="text/javascript">
function SetFocus () {
var input = document.getElementById ("theFieldID");
input.focus ();
}
 </script>
             </section>
             <section class="col-lg-4">
             <button type="button" onClick="document.location.reload(true); alert('Silakan Gunakan Scanner Lagi Setelah tekan OK !')" class="btn btn-warning"><i class="fa fa-refresh"></i> &nbsp;Tekan Ini Jika Tidak Bisa Scanner</button>
             
             <a href="?page=opname_awal"><button type="button" class="btn btn-danger"><i class="fa fa-calendar"></i> &nbsp;Buat Pengecekan Baru</button></a>
             </section>
              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        <?php include "header_qrcode.php"; ?>
        <?php if ($_SESSION['status']!=0) { ?>
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
        <td align="center" valign="top"><strong>Jumlah Cek Fisik</strong></td>
        </tr>
  </thead>
  <?php
// membuka file JSON
if (isset($_GET['kunci'])) {
	$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]&pilihan=$_GET[pilihan]&kunci=".str_replace(" ","%20",$_GET['kunci'])."");
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
			$sel = mysqli_fetch_array(mysqli_query($koneksi, "select jumlah_limit from limiter_stok"));
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
    <?php
    $jml_cek_fisik = mysqli_num_rows(mysqli_query($koneksi, "select * from stok_opname_detail,barang_gudang_detail where barang_gudang_detail.id=stok_opname_detail.barang_gudang_detail_id and stok_opname_id=".$_GET['id']." and barang_gudang_id=".$json[$i]['idd'].""));
	echo $jml_cek_fisik;
	?>
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
        <?php } ?>
        <?php if ($jml!=0 and !isset($_GET['kunci'])) { ?>
  <section class="col-lg-12">      
<center>
	<ul class="pagination btn-success">
    <?php
	include "paging_awal.php";
	?>
    <?php
	$query12 = mysqli_query($koneksi, "SELECT jumlah_limit FROM limiter_stok");
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
      <?php if ($_SESSION['status']!=0) { ?>
	  <?php 
  if (isset($_GET['kunci'])) {
  ?>
  <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Detail Data Alkes</h3><!--<a href="cetak_barcode_no_seri.php?id=<?php echo $_GET['id']; ?>&pilihan=tersedia" class="pull pull-right" target="_blank"><button name="barcode" class="btn btn-danger"><span class="fa fa-barcode"></span> Generate QRCode</button></a>--></div>
              <div class="box-body">
              <div class="table-responsive">
              <table width="100%" id="" class="table">
              <thead>
  <tr>
    
    <th><strong>Tgl Masuk</strong></th>
    <th>No PO</th>
    <?php $no_bath = mysqli_num_rows(mysqli_query($koneksi, "select * form barang_gudang_detail where barang_gudang_id=".$_GET['id']." and no_bath!=''"));
	if ($no_bath!=0) { 
	 ?>
    <th><strong>No. Bath</strong></th>
    <?php } ?>
    <th><strong>No. Lot</strong></th>
    <th><strong>No. Seri</strong></th>
    <th><strong>Kode QRCode</strong></th>
    <th>Expired</th>
    <th>Status</th>
    <th><strong>Scanner Ke-</strong></th>
  </tr>
  </thead>
  <?php
 
// membuka file JSON
$file = file_get_contents("http://localhost/ALKES/json/detail_opname.php?id=$_SESSION[id_gudang]&id_detail=$_SESSION[id_detail]");
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
?>
<?php
$cekk = mysqli_num_rows(mysqli_query($koneksi, "select * from stok_opname_detail where stok_opname_id=".$_GET['id']." and barang_gudang_detail_id=".$json[$i]['idd'].""));
if ($cekk!=0) {
	$bg="btn-success light";
	}
else {
	$bg="btn-danger";
	}
?>
  <tr class="<?php echo $bg ?>">
    <!--<td align="center"><?php
	$akh =0; 
	if (isset($_GET['paging'])) {
		if ($_GET['paging']==1) {
			echo $i+1;
			$akh = $i+1;
			}
		else {
			$sel = mysqli_fetch_array(mysqli_query($koneksi, "select jumlah_limit from limiter_stok"));
			echo (($_GET['paging']-1)*$sel['jumlah_limit'])+$i+1;
			$akh = (($_GET['paging']-1)*$sel['jumlah_limit'])+$i+1;
			}
	} else {
		echo $i+1;
		$akh = $i+1;
		}
	?></td>
    -->
    <td><?php echo date("d-m-Y",strtotime($json[$i]['tgl_po_gudang'])); ?></td>
    <td><?php echo $json[$i]['no_po_gudang']; ?></td>
    <?php if ($no_bath!=0) { ?>
    <td><?php echo $json[$i]['no_bath']; ?></td>
    <?php } ?>
    <td><?php echo $json[$i]['no_lot']; ?></td>
    <td><?php echo $json[$i]['no_seri_brg']; ?></td>
    <td><?php echo $json[$i]['qrcode']; ?></td>
    <td><?php 
	if ($json[$i]['tgl_expired']=='0000-00-00') {echo "-";} else {
	echo date("d-m-Y",strtotime($json[$i]['tgl_expired']));} ?></td>
    <td><?php if ($json[$i]['status_kerusakan']==1){echo "RUSAK";} else if ($json[$i]['status_kerusakan']==2) {echo "DIKEMBALIKAN";} else if ($json[$i]['status_demo']==1) {echo "Demo";} else {echo "-";} ?></td>
    <td align="">
    <?php
    $ss = mysqli_query($koneksi, "select * from stok_opname_detail where stok_opname_id=".$_GET['id']." order by id ASC");
	$sc = 0;
	while ($d = mysqli_fetch_array($ss)){
		$sc++;
		if ($d['barang_gudang_detail_id']==$json[$i]['idd']) {
			echo $sc;
			}
		}
	?>
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
  <?php
  } }
  ?>
      </div>
      <!-- /.row (main row) -->
      
  </section>
  
    <!-- /.content -->
  </div>
