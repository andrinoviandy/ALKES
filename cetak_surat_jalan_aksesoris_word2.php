<?php
//header("Content-type: application/vnd.ms-word");

$id=$_GET['id'];
require("config/koneksi.php");
$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,aksesoris_kirim.id as id_kirim from aksesoris_kirim,aksesoris_kirim_detail, aksesoris_jual,aksesoris_jual_qty, pembeli, alamat_provinsi,alamat_kabupaten,alamat_kecamatan where aksesoris_jual_qty.id=aksesoris_kirim_detail.aksesoris_jual_qty_id and aksesoris_jual.id=aksesoris_jual_qty.aksesoris_jual_id and aksesoris_kirim.id=aksesoris_kirim_detail.aksesoris_kirim_id and pembeli.id=aksesoris_jual.pembeli_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and aksesoris_kirim.id=$id"));

header("Content-type: application/msword");
header("Content-disposition: inline; filename=Surat Jalan Aksesoris - $data[no_pengiriman_akse].doc");
?>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
        <title>Cetak Surat Jalan (Aksesoris)</title>
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
    <body onLoad="window.print();">
    <center>
    <font size="+2" style="font-family:Arial, Helvetica, sans-serif"><b>SURAT JALAN</b></font>
    </center><br>
    <table width="100%">
      <tr>
        <td colspan="3" rowspan="4" valign="top"><b style="font-size:17px; font-family:Tahoma, Geneva, sans-serif">PT. CIPTA VARIA KHARISMA UTAMA<br>Jl. Utan Kayu Raya No.105A<br>
        Utan Kayu Utara, Matraman<br>
        Jakarta Timur</b></td>
        
      </tr>
      <tr>
        <td width="2%" rowspan="3">&nbsp;</td>
        <td width="19%" height="28" valign="top"><font>Delivery No.</font></td>
        <td width="2%" valign="top">:</td>
        <td width="20%" align="right" valign="top"><?php echo $data['no_pengiriman_akse']; ?></td>
      </tr>
      <tr>
        <td height="24" valign="top"><font>Delivery Date</font></td>
        <td valign="top">:</td>
        <td width="20%" align="right" valign="top"><?php echo date("d M Y", strtotime($data['tgl_kirim_akse'])); ?></td>
      </tr>
      <tr>
        <td height="24" valign="top"><font>PO. No.</font></td>
        <td valign="top">:</td>
        <td width="20%" align="right" valign="top"><?php echo $data['po_no_akse']; ?></td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
        <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td width="11%" valign="top">Paket   : </td>
        <td width="31%" valign="top"><?php echo $data['nama_paket_akse']; ?></td>
        <td width="15%" valign="top">&nbsp;</td>
        <td colspan="4" rowspan="2" valign="top"><strong>Kepada Yth,</strong><br><br>
        <b><?php echo $data['nama_pembeli']; ?></b><br>
        <?php echo $data['jalan']." Kel.".$data['kelurahan_id']; ?><br>
        <?php echo "Kec.".ucwords(strtolower($data['nama_kecamatan'])).", Kab.".ucwords(strtolower($data['nama_kabupaten'])).", ".ucwords(strtolower($data['nama_provinsi'])); ?><br>
        Up : <?php echo $data['kontak_rs']; ?></td>
      </tr>
      <tr>
        <td colspan="3" valign="bottom">Dengan hormat,<br> Mohon diterima barang - barang berikut ini :</td>
      </tr>
    </table>
        <br>
<table width="100%" class="mytable">
  <tr>
    <td align="center"><strong>Cat No</strong></td>
    <td align="center"><strong>Item Description</strong></td>
    <td align="center"><strong>Qty</strong></td>
    <td align="center"><strong>No.Lot/Exp</strong></td>
  </tr>
  <?php 
  $q=mysqli_query($koneksi, "select *,aksesoris_kirim.id as idd,aksesoris.id as id_akse from aksesoris,aksesoris_detail,aksesoris_kirim,aksesoris_kirim_detail where aksesoris.id=aksesoris_detail.aksesoris_id and aksesoris_detail.id=aksesoris_kirim_detail.aksesoris_detail_id and aksesoris_kirim.id=aksesoris_kirim_detail.aksesoris_kirim_id and aksesoris_kirim.id=".$data['id_kirim']." group by nama_akse");
  while ($d = mysqli_fetch_array($q)) { ?>
  <tr>
    <td align="center" valign="top"><p><?php echo $d['tipe_akse']; ?></p></td>
    <td valign="top"><?php echo $d['nama_akse']; ?></td>
    <td align="center" valign="top"><?php 
	$jm = mysqli_num_rows(mysqli_query($koneksi, "select * from aksesoris_kirim_detail,aksesoris_detail,aksesoris where aksesoris.id=aksesoris_detail.aksesoris_id and aksesoris_detail.id=aksesoris_kirim_detail.aksesoris_detail_id and aksesoris_kirim_detail.aksesoris_kirim_id=$d[idd] and aksesoris.id=$d[id_akse]"));
	echo $jm." Kit"; ?></td>
    <td align="center" valign="top">
      <?php 
	$q_lot=mysqli_query($koneksi, "select * from aksesoris_detail,aksesoris_kirim_detail,aksesoris where aksesoris.id=aksesoris_detail.aksesoris_id and aksesoris_detail.id=aksesoris_kirim_detail.aksesoris_detail_id and aksesoris_kirim_detail.aksesoris_kirim_id=$d[idd] and aksesoris.id=$d[id_akse]");
	$j_lot = mysqli_num_rows($q_lot);
	if ($j_lot>1) {
		$komaa=", ";
		}
	else {
		$komaa="";
		}
	while ($dd = mysqli_fetch_array($q_lot)) {
		if ($dd['no_lot_akse']!="" or $dd['tgl_expired_akse'] != '0000-00-00') {
			echo $dd['no_lot_akse'];
			if ($dd['tgl_expired_akse'] != '0000-00-00') {
				echo "(".date("d/m/Y", strtotime($dd['tgl_expired_akse'])).")".$komaa;
				}
			else {
				echo $komaa;
				}
		}
	}
	 ?>
    </td>
  </tr>
  <?php } ?>
</table>
<br><br>
<table width="100%">
  <tr>
    <td width="31%">
    Tanggal dikirim : ..../..../<?php echo date("Y"); ?>
    <br>Yang Menyerahkan<br>
    <center><font size="-1">Tanda Tangan & Cap</font></center>
    <p>&nbsp;</p>
    <p>&nbsp;</p></td>
    <td width="36%">&nbsp;</td>
    <td width="33%" valign="top">
    Tanggal diterima : ..../..../<?php echo date("Y"); ?> 
    <br>Yang Menerima<br>
    <center><font size="-1">Tanda Tangan & Cap</font></center>
    </td>
  </tr>
  <tr>
    <td><hr></td>
    <td>&nbsp;</td>
    <td><hr></td>
  </tr>
  <tr>
    <td align="center">Habib Nurrohman</td>
    <td></td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="100%">
  <tr>
    <td width="31%"></td>
    <td width="36%" align="center" valign="top"><p>Mengetahui<br>PJT</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p></td>
    <td width="33%" valign="top"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center"><hr></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center">Prasetyo Kristiadi</td>
    <td>&nbsp;</td>
  </tr>
</table>
<div style="position:absolute; bottom:100px">
1. Putih : Setelah ttd mohon kembalikan ke PT. Cipta Varia Kharisma Utama, 2. Merah : Expedisi, 3. Kuning Instansi, 4. Hijau : Gudang, 5. Biru : Admin, 6. Copy : Keuangan
</div>
    </body>
</html>
<?php 
//header("Content-Disposition: attachment;Filename=Surat Jalan-".$data['nama_pembeli']."-".$data['nama_pemakai'].".doc");
?>