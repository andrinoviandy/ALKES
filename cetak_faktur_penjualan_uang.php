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
$idd = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dijual where id=".$_GET['id'].""));
$jml_deal = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual where status_deal=1 and no_po_jual='".$idd['no_po_jual']."'"));
if ($jml_deal==0) {
$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_dijual.id as idd from barang_dijual,barang_dijual_qty,barang_gudang,barang_gudang_detail,pembeli,pemakai,alamat_provinsi,alamat_kabupaten,alamat_kecamatan where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual.id=barang_dijual_qty.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and pemakai.id=barang_dijual.pemakai_id and barang_dijual.no_po_jual='".$idd['no_po_jual']."' order by barang_dijual.id DESC LIMIT 1"));
} else {
$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_dijual.id as idd from barang_dijual,barang_dijual_qty,barang_gudang,barang_gudang_detail,pembeli,pemakai,alamat_provinsi,alamat_kabupaten,alamat_kecamatan where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual.id=barang_dijual_qty.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and pemakai.id=barang_dijual.pemakai_id and barang_dijual.no_po_jual='".$idd['no_po_jual']."' and status_deal=1"));
}
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
    <?php
        $qq = mysqli_query($koneksi, "select *,barang_gudang.id as id_gudang from barang_dijual_qty,barang_dijual,barang_gudang where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and status_deal=1 and barang_dijual.id=".$_GET['id']." group by nama_brg");
  $jml_q = mysqli_num_rows($qq);
		?>
    <body onLoad="window.print();" style="font-family:Arial;  <?php if ($jml_deal==0) { ?>background-position:center; background-repeat:no-repeat; background-size:50%; background-image:url(img/belum%20deal.png);<?php } ?>" >
    
    <table width="100%">
      <tr>
        <td width="22%" valign="top"><img src="img/kop5.png" width="350" ></td>
        <td width="78%" align="left" valign="bottom"><strong style="padding-left:40px">FAKTUR No. : <?php echo " ".$data['no_po_jual']; ?></strong></td>
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
    
    <td align="center"><strong>Harga Satuan (Rp)</strong></td>
    <td align="center"><strong>Jumlah (Rp)</strong></td>
  </tr>
  <?php 
  
  $q = mysqli_query($koneksi, "select *,barang_gudang.id as id_gudang from barang_dijual_qty,barang_dijual,barang_gudang where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual.id=".$data['idd']."");
  $jml_q = mysqli_num_rows($q); 
  $no=0;
  while ($d = mysqli_fetch_array($q)) {
  $no++;
  ?>
  <tr>
    <td align="center" valign="top"><?php echo $no; ?></td>
    <td align="center" valign="top"><?php echo $d['qty_jual']; ?></td>
    <td valign="top"><?php echo $d['nama_brg']; ?></td>
    
    <td align="center" valign="top"><?php echo number_format($d['harga_satuan'],0,',','.'); ?></td>
    <td align="right" valign="top"><?php echo number_format($d['qty_jual']*$d['harga_satuan'],0,',','.'); ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="4" align="right" valign="top"><strong>Sub Total</strong></td>
    <td align="right" valign="top"><strong>
      <?php 
	$t = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_gudang.id as id_gudang,sum(harga_jual_saat_itu*qty_jual) as total from barang_dijual_qty,barang_dijual,barang_gudang where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual.id=".$data['idd'].""));
	echo "Rp".number_format($t['total'],0,',','.');
	?>
    </strong></td>
  </tr>
  <tr>
    <td colspan="4" align="right" valign="top"><strong>Diskon (<?php
	
	 echo $data['diskon_jual']."%"; ?>)</strong></td>
    <td align="right" valign="top"><?php 
	if ($data['diskon_jual']!=0) {
	echo number_format($data['diskon_jual']/100*$t['total'],0,',','.'); } else {echo "-";} ?></td>
  </tr>
  <tr>
    <td colspan="4" align="right" valign="top"><strong>PPN (<?php echo $data['ppn_jual']."%"; ?>)</strong></td>
    <td align="right" valign="top"><?php 
	if ($data['ppn_jual']!=0) {
	echo number_format($data['ppn_jual']/100*$t['total'],0,',','.'); } else {echo "-";} ?></td>
  </tr>
  <tr>
    <td colspan="4" align="right" valign="top" style="padding:10px"><strong>TOTAL + PPN - Diskon</strong></td>
    <td align="right" valign="top" style="font-size:20px"><strong><?php echo "Rp".number_format(($t['total']-($t['total']*$data['diskon_jual']/100))+($t['total']*$data['ppn_jual']/100),0,',','.'); 
	
	$TOT = ($t['total']+($t['total']*$data['ppn_jual']/100)-($t['total']*$data['diskon_jual']/100));
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
    </body>
</html>
