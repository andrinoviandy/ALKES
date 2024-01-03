<?php

$id=$_GET['id'];
require("config/koneksi.php");
$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_pesan_set.id as idd from barang_pesan_set,principle,mata_uang where principle.id=barang_pesan_set.principle_id and mata_uang.id=barang_pesan_set.mata_uang_id and barang_pesan_set.id=$id"));
?>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
        <title>Cetak PO</title>
        <style>
         .mytable{
                border:1px solid black; 
                border-collapse: collapse;
                width: 100%;
				
            }
            .mytable tr th, .mytable tr td{
                border:1px solid black; 
                padding: 3px 3px;
            }
        </style>
        <link href='logo.png' rel='icon'>
    </head>
    <body onLoad="window.print();" style="font-family:">
    <table width="100%">
    <thead><img src="img/kop4.png" width="100%"/></thead>
    </table>
    <br>
    <table width="100%">
      <tr>
        <td width="59%" rowspan="4" valign="top"><strong><?php echo $data['nama_principle']; ?></strong><br>
        <?php echo $data['alamat_principle']."<br>Telp : ".$data['telp_principle']."<br>Fax : ".$data['fax_principle']."<br><br><strong>Attn : ".$data['attn_principle']."</strong>"; ?>
        </td>
      </tr>
      <tr>
        <td width="3%" rowspan="3">&nbsp;</td>
        <td height="28" colspan="2" align="right" valign="top">Jakarta, <?php echo date("d F Y",strtotime($data['tgl_po_pesan'])); ?></td>
      </tr>
      <tr>
        <td width="21%" height="24" valign="top">&nbsp;</td>
        <td width="17%" align="right" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td height="24" valign="top">&nbsp;</td>
        <td width="17%" align="right" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4" align="center"><strong><u>PURCHASE ORDER</u></strong><br>
        <strong>No. : <?php echo $data['no_po_pesan']; ?></strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4">We  hereby confirm order the following goods with the term and conditions stated  below :</td>
      </tr>
    </table>
    <table width="100%" style="padding-left:20px">
          <tr>
            <td width="5%">1.&nbsp;</td>
            <td width="18%">ARTICLE</td>
            <td width="2%">:</td>
            <td width="75%">Please  see attached sheet</td>
          </tr>
          <tr>
            <td>2.</td>
            <td>PRICE</td>
            <td>:</td>
            <td>Total  C&amp;F JAKARTA <strong><?php echo $data['simbol']; ?> ……………</strong></td>
          </tr>
          <tr>
            <td>3.</td>
            <td>SHIPMENT</td>
            <td>:</td>
            <td>By <strong><u><?php echo $data['jalur_pengiriman']; ?></u></strong> to Jakarta with the address  as follow :</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><br>
            <strong><?php echo $data['alamat_pengiriman']; ?></strong><br></td>
          </tr>
          <tr>
            <td>4.</td>
            <td>PAYMENT</td>
            <td>:</td>
            <td><?php echo $data['cara_pembayaran']; ?></td>
          </tr>
          <tr>
            <td>5.</td>
            <td>DELIVERY</td>
            <td>:</td>
            <td><?php echo $data['jalur_pengiriman']; ?></td>
          </tr>
          <tr>
            <td>6.</td>
            <td>PACKING</td>
            <td>:</td>
            <td>In  Standard Export packing</td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><strong><?php //echo $data['catatan']; ?></strong></td>
          </tr>
    </table>
    <br><br>
<table width="100%">
  <tr>
    <td width="48%">Your Sincerely<br>
    <strong>PT. Cipta Varia Kharisma Utama</strong><br>
    <img src="img/ttd.png" width="180" ><br>
    <strong><u>Banter Setyaki</u></strong><br>
    D i r e c t o r<br>
    <i>bs/rd</i></td>
    <td width="19%">&nbsp;</td>
    <td width="33%" valign="top">Confirm by,<br>
    <strong><?php echo $data['nama_principle']; ?></strong>,<br><br><br><br><br><br><br>
    --------------------
    </td>
  </tr>
</table>
<div style="page-break-before:always;">
 <table width="100%">
    <thead><img src="img/kop4.png" width="100%"/></thead>
    </table><br>
    Attached sheet of &nbsp;&nbsp; <strong>No. : <?php echo $data['no_po_pesan']; ?></strong><br><br>
<table width="100%" class="mytable" style="padding-left:20px">
  <tr>
    <td width="6%" align="center"><strong>No</strong></td>
    <td width="9%" align="center"><strong>Type</strong></td>
    <td width="40%" align="center"><strong>Description</strong></td>
    <td width="7%" align="center"><strong>Qty</strong></td>
    <td width="12%" align="center"><strong>Unit Price</strong></td>
    <td width="8%" align="center"><strong>Diskon</strong></td>
    <td width="18%" align="center"><strong>Total Price</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php 
  $q = mysqli_query($koneksi, "select * from barang_pesan_detail_set where barang_pesan_set_id=$id");
  $n=0;
  $total_akse2=0;
  while ($d = mysqli_fetch_array($q)) {
  $n++;
  ?>
  <tr>
    <td align="center"><strong><?php echo $n; ?></strong></td>
    <td align="center"><strong><?php 
	$brg = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang_set where id=".$d['barang_gudang_set_id'].""));
	echo strtoupper($brg['tipe_brg']); ?></strong></td>
    <td><strong>
      <?php 
	echo strtoupper($brg['nama_brg']); ?>
      
    </strong></td>
    <td align="center"><strong><?php echo $d['qty']." Units"; ?></strong></td>
    <td align="center"><strong>
      <?php 
	$mata_uang = mysqli_fetch_array(mysqli_query($koneksi, "select * from mata_uang where id=".$d['mata_uang_id'].""));
	echo $mata_uang['simbol']."".number_format($d['harga_perunit'],2,',','.'); ?>
    </strong></td>
    <td align="center">
    <?php if ($d['diskon']!=0) { ?>
    <strong style="font-size:11px"><?php echo $d['diskon']." %"; ?></strong>
    <?php } else { echo "-";} ?>
    </td>
    <td align="center"><strong><?php echo $mata_uang['simbol']."".number_format($d['harga_total'],2,',','.'); ?></strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
 
  <tr>
    <td colspan="6" align="right"><strong>Total Price =</strong></td>
    <td align="right">
      <strong>
        <?php 
		//$total_akse = mysqli_fetch_array(mysqli_query($koneksi, "select sum(harga_akse*aksesoris_alkes.qty) as total_akse from aksesoris_alkes,aksesoris,barang_pesan,barang_pesan_detail,barang_gudang where aksesoris.id=aksesoris_alkes.aksesoris_id and barang_gudang.id=aksesoris_alkes.barang_gudang_id and barang_gudang.id=barang_pesan_detail.barang_gudang_id and barang_pesan.id=barang_pesan_detail.barang_pesan_id and barang_pesan.id=$id"));
		//$total = mysqli_fetch_array(mysqli_query($koneksi, "select sum(harga_total) as total from barang_pesan_detail where barang_pesan_id=$id"));
		//$total = mysqli_query($koneksi, "select * from barang_pesan_detail where barang_pesan_id=$id");
		//echo " ".number_format($total_akse2+$total['total'],0,',',',').".00";
		//echo $data['simbol']." ".number_format($total['total'],0,',',',').".00";
		//while ($d_hitung = mysqli_fetch_array($total)) {
			//$s = mysqli_query($koneksi, "select * from mata_uang where ");
			//}
			echo $data['simbol']."".number_format($data['total_price'],2,',','.');
	 ?>
      </strong></td>
  </tr>
  <tr>
    <td colspan="6" align="right"><strong>Total Price + PPN(<?php echo $data['ppn']."%"; ?>) =</strong></td>
    <td align="right"><strong><?php 
	echo $data['simbol']."".number_format($data['total_price_ppn'],2,',','.');
	//echo "€ ".number_format(($total_akse2+$total['total'])-(($total_akse2+$total['total'])*$data['ppn']/100),0,',',',').".00"; ?></strong></td>
  </tr>
  <tr>
    <td colspan="6" align="right"><strong>Freight Cost by Air to JAKARTA =</strong></td>
    <td align="right"><strong><?php echo $data['simbol']."".number_format($data['cost_byair'],2,',','.'); ?></strong></td>
  </tr>
  <tr>
    <td colspan="6" align="right"><strong>Total Cost C&amp;F JAKARTA =</strong></td>
    <td align="right"><strong><?php echo $data['simbol']."".number_format($data['cost_cf'],2,',','.'); ?></strong></td>
  </tr>
  </table>
  <!--
<br>
<strong>Specification</strong><br><br>
    <table width="100%" class="mytable" style="padding-left:20px">
  <tr>
    <td width="13%"><strong>No.</strong></td>
    <td width="48%"><strong>Description</strong></td>
    <td width="19%" align="center"><strong>Type</strong></td>
    <td width="20%" align="center"><strong>Brand</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php 
  $no=0;
  $sel = mysqli_query($koneksi, "select * from barang_pesan_detail_set where barang_pesan_set_id=".$data['idd']."");
  while ($data_sel = mysqli_fetch_array($sel)) {
	  $no++;
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><strong>
      <?php 
	$sel2 = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang_set where id=".$data_sel['barang_gudang_set_id'].""));
	echo strtoupper($sel2['nama_brg']); ?>
    </strong></td>
    <td align="center"><strong><?php echo $sel2['tipe_brg']; ?></strong></td>
    <td align="center"><strong><?php echo $sel2['merk_brg']; ?></strong></td>
  </tr>
  <tr>
    <td></td>
    <td><strong>Specification :</strong></td>
    <td></td>
    <td></td>
  </tr>
  <?php 
	$sel3 = mysqli_query($koneksi, "select * from spesifikasi where barang_gudang_id=".$data_sel['barang_gudang_id']." order by judul_spesifikasi ASC");
	while ($data_sel3 = mysqli_fetch_array($sel3)) {
	?>
  <tr>
    <td>&nbsp;</td>
    <td><strong><?php echo $data_sel3['judul_spesifikasi']; ?></strong><br><br>
    <?php echo $data_sel3['nama_spesifikasi']; ?>
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php } ?>
  <tr>
    <td>&nbsp;</td>
    <td><p align="justify"><strong>Catatan : <?php echo $data_sel['catatan_spek']; ?></strong></p></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
--><br><br><br>
    <table width="100%">
      <tr>
        <td width="48%"><?php echo "Jakarta, ".date("d F Y",strtotime($data['tgl_po_pesan'])); ?><br>Your Sincerely<br>
          <strong>PT. Cipta Varia Kharisma Utama</strong><br>
          <img src="img/ttd.png" alt="" width="180" ><br>
          <strong><u>Banter Setyaki</u></strong><br>
          D i r e c t o r<br>
          <i><strong>bs/rd</strong></i></td>
        <td width="20%">&nbsp;</td>
        <td width="32%" valign="top">Confirm by,<br>
          <strong><?php echo $data['nama_principle']; ?></strong>,<br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          -------------------- </td>
      </tr>
    </table>
    </div>
    </body>
</html>
