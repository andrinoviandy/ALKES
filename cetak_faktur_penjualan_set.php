<?php
function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " Belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " Milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " Trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil;
	}
?>
<?php

$id=$_GET['id'];
require("config/koneksi.php");
$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_dijual_set.id as idd from barang_dijual_set,pembeli,pemakai,alamat_provinsi,alamat_kabupaten,alamat_kecamatan where pembeli.id=barang_dijual_set.pembeli_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and pemakai.id=barang_dijual_set.pemakai_id and barang_dijual_set.id=".$_GET['id'].""));
?>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
        <title>Cetak Faktur Penjualan</title>
        <style>
         .mytable{
                border:1px solid black; 
                border-collapse: collapse;
                width: 100%;
            }
            .mytable tr th, .mytable tr td{
                border:1px solid black; 
                padding: 5px 10px;
            }
        </style>
        <link href='logo.png' rel='icon'>
    </head>
<body onLoad="window.print();" style="font-family:Arial">
    
    <table width="100%">
      <tr>
        <td width="22%" valign="top"><img src="img/kop5.png" width="350" ></td>
        <td width="78%" align="right" valign="bottom"><strong style="padding-left:40px">Faktur No. : <?php echo " ".$data['no_faktur_jual']; ?></strong></td>
      </tr>
      <tr>
        <td colspan="2"><hr style="height:2px; background-color:#000; color:#000"/></td>
      </tr>
    </table>
        <br>
        <table width="100%">
  <tr>
    <td width="16%" align="left" valign="top"><strong>Kepada Yth.  :</strong></td>
    <td width="48%" align="left" valign="top"><b><?php echo $data['nama_pembeli']; ?></b><br>
      <?php echo $data['jalan']." Kel.".$data['kelurahan_id']; ?><br>
      <?php echo "Kec.".ucwords(strtolower($data['nama_kecamatan'])).", Kab.".ucwords(strtolower($data['nama_kabupaten'])).", ".ucwords(strtolower($data['nama_provinsi'])); ?><br>
UP : <?php echo $data['nama_pemakai']; ?><br>
Telp : <?php echo $data['kontak1_pemakai']." / ".$data['kontak2_pemakai']; ?></td>
    <td width="3%" align="left" valign="top">&nbsp;</td>
    <td width="33%" align="left" valign="top"><strong>Jakarta, <?php echo " ".date("d F Y",strtotime($data['tgl_jual'])); ?></strong></td>
  </tr>
</table>

        <br>
<table width="100%" class="mytable">
  <tr>
    <td align="center"><strong>No.</strong></td>
    <td align="center"><strong>Banyaknya</strong></td>
    <td align="center"><strong>Nama Barang</strong></td>
    <td align="center"><strong>Harga Per Set(Rp)</strong></td>
    <td align="center"><strong>Jumlah (Rp)</strong></td>
  </tr>
  <?php 
  $q = mysqli_query($koneksi, "select *,barang_gudang_set.id as id_gudang,barang_dijual_qty_set.id as id_qty_set from barang_dijual_qty_set, barang_gudang_set where barang_gudang_set.id=barang_dijual_qty_set.barang_gudang_set_id and barang_dijual_set_id = ".$_GET['id'].""); 
  $no=0;
  while ($d = mysqli_fetch_array($q)) {
  $no++;
  ?>
  <tr>
    <td align="center" valign="top"><?php echo $no; ?></td>
    <td align="center" valign="top"><?php
	echo $d['qty_set']; ?> SET</td>
    <td valign="top"><?php echo $d['nama_brg']; ?></td>
    <td align="center" valign="top"><?php
    $dt_perset = mysqli_fetch_array(mysqli_query($koneksi, "select sum(harga_jual_saat_itu*qty_barang_gudang) as harga_satuan from barang_dijual_qty_set_detail where barang_dijual_qty_set_id = ".$d['id_qty_set'].""));
	echo number_format($dt_perset['harga_satuan'],0,',','.'); ?></td>
    <td align="right" valign="top"><?php echo number_format($d['qty_set']*$dt_perset['harga_satuan'],0,',','.'); ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="4" align="right" valign="top"><strong>Sub Total</strong></td>
    <td align="right" valign="top">
      <?php
    $t = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_barang_gudang*harga_jual_saat_itu) as total from barang_dijual_qty_set,barang_dijual_qty_set_detail where barang_dijual_qty_set.id=barang_dijual_qty_set_detail.barang_dijual_qty_set_id and barang_dijual_set_id=".$_GET['id'].""));
	$t2 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_set) as total from barang_dijual_qty_set where barang_dijual_set_id=".$_GET['id'].""));
	echo number_format($t['total']*$t2['total'],2,',','.');
	?>
    </td>
  </tr>
  <tr>
    <td colspan="4" align="right" valign="top"><strong>Diskon (<?php
	
	 echo $data['diskon_jual']."%"; ?>)</strong></td>
    <td align="right" valign="top"><?php 
	if ($data['diskon_jual']!=0) {
	echo number_format($data['diskon_jual']/100*($t['total']*$t2['total']),0,',','.'); } else {echo "-";} ?></td>
  </tr>
  <tr>
    <td colspan="4" align="right" valign="top"><strong>PPN (<?php echo $data['ppn_jual']."%"; ?>)</strong></td>
    <td align="right" valign="top"><?php 
	if ($data['ppn_jual']!=0) {
	echo number_format($data['ppn_jual']/100*($t['total']*$t2['total']),0,',','.'); } else {echo "-";} ?></td>
  </tr>
  <tr>
    <td colspan="4" align="right" valign="bottom" style="padding:10px"><strong>TOTAL</strong></td>
    <td align="right" valign="bottom"><strong><?php
    $TOT = (($t['total']*$t2['total'])+(($t['total']*$t2['total'])*$data['ppn_jual']/100)-(($t['total']*$t2['total'])*$data['diskon_jual']/100));
	echo "Rp".number_format($TOT,2,',','.'); 
	?></strong></td>
  </tr>
  <tr>
    <td colspan="5" valign="top" style="padding:20px"><strong><em><font size="+1">Terbilang : <?php echo terbilang($TOT)." Rupiah"; ?></font></em></strong></td>
  </tr>
</table>
<br><br>
<table width="100%">
  <tr>
    <td width="50%" align="center" >Penerima,<br>
    Tanda tangan/cap</td>
    <td width="50%" align="center" >Hormat kami,</td>
  </tr>
</table>
<div style="page-break-before:always;">
<table width="100%">
      <tr>
        <td width="22%" valign="top"><img src="img/kop5.png" width="350" ></td>
        <td width="78%" align="right" valign="bottom"><strong style="padding-left:40px">Faktur No. : <?php echo " ".$data['no_faktur_jual']; ?></strong></td>
      </tr>
      <tr>
        <td colspan="2"><hr style="height:2px; background-color:#000; color:#000"/></td>
      </tr>
    </table>
    <h4>Item Details / Rincian Barang </h4>
    <table width="100%" class="mytable" style="font-size:12px">
  <tr>
    <td align="center" width="2%"><strong>No.</strong></td>
    <td align="center"><strong>Nama Barang</strong></td>
    <td align="center" width="70px"><strong>Kuantitas</strong></td>
    <td align="center" width="120px"><strong>Harga Per Satuan(Rp)</strong></td>
    <td align="center" width="90px"><strong>Jumlah (Rp)</strong></td>
  </tr>
  <?php 
  $q = mysqli_query($koneksi, "select *,barang_gudang_set.id as id_gudang,barang_dijual_qty_set.id as id_qty_set from barang_dijual_qty_set, barang_gudang_set where barang_gudang_set.id=barang_dijual_qty_set.barang_gudang_set_id and barang_dijual_set_id = ".$_GET['id'].""); 
  $no=0;
  while ($d = mysqli_fetch_array($q)) {
  $no++;
  ?>
  <tr>
    <td align="center" valign="top" bgcolor="#CCCCCC"><?php echo $no; ?></td>
    <td valign="top" bgcolor="#CCCCCC"><?php echo $d['nama_brg']; ?></td>
    <td align="center" valign="top" bgcolor="#CCCCCC"><?php
	echo $d['qty_set']; ?>&nbsp;Set</td>
    <td align="right" valign="top" bgcolor="#CCCCCC"><?php
    $dt_perset = mysqli_fetch_array(mysqli_query($koneksi, "select sum(harga_jual_saat_itu*qty_barang_gudang) as harga_satuan from barang_dijual_qty_set_detail where barang_dijual_qty_set_id = ".$d['id_qty_set'].""));
	echo number_format($dt_perset['harga_satuan'],0,',','.'); ?></td>
    <td align="right" valign="top" bgcolor="#CCCCCC"><?php echo number_format($d['qty_set']*$dt_perset['harga_satuan'],0,',','.'); ?></td>
  </tr>
  <tr>
  <td></td>
    <td valign="top" colspan="6" style="padding:0px">
    <table width="100%" style="font-size:11px" class="mytable">
    	<tr>
        <td>Nama Barang</td>
        <td align="center" width="70px">Kuantitas</td>
        <td align="center" width="120px">Harga Satuan (Rp)</td>
        <td align="center" width="89px">Jumlah (Rp)</td>
        </tr>
        <?php 
		$qq = mysqli_query($koneksi, "select * from barang_dijual_qty_set_detail,barang_gudang where barang_gudang.id=barang_dijual_qty_set_detail.barang_gudang_id and barang_dijual_qty_set_id = ".$d['id_qty_set']."");
		while ($d2 = mysqli_fetch_array($qq))
		{ ?>
        <tr>
        <td><?php echo $d2['nama_brg'] ?></td>
        <td><?php echo $d2['qty_barang_gudang'] ?></td>
        <td><?php echo number_format($d2['harga_jual_saat_itu'],0,',','.') ?></td>
        <td><?php echo number_format($d2['qty_barang_gudang']*$d2['harga_jual_saat_itu'],0,',','.'); ?></td>
        </tr>
        <?php } ?>
    </table>
    </td>
  </tr>
  <?php } ?>
</table>
</div>
</body>
</html>
