<?php
//header("Content-type: application/vnd.ms-word");

$id=$_GET['id'];
require("config/koneksi.php");
$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_demo_kirim.id as id_kirim from barang_demo_qty,barang_demo_kirim,barang_demo_kirim_detail, barang_demo, pembeli, alamat_provinsi,alamat_kabupaten,alamat_kecamatan where barang_demo.id=barang_demo_qty.barang_demo_id and barang_demo_qty.id=barang_demo_kirim_detail.barang_demo_qty_id and barang_demo_kirim.id=barang_demo_kirim_detail.barang_demo_kirim_id and pembeli.id=barang_demo.pembeli_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and barang_demo_kirim.id=$id"));
?>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
        <title>Cetak Surat Jalan</title>
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
        <td colspan="3" rowspan="4" valign="top" style="font-size:17px; font-family:Tahoma"><b>PT. CIPTA VARIA KHARISMA UTAMA<br>Jl. Utan Kayu Raya No.105A<br>
        Utan Kayu Utara, Matraman<br>
        Jakarta Timur</b></td>
        
      </tr>
      <tr>
        <td width="2%" rowspan="3">&nbsp;</td>
        <td width="15%" height="28" valign="top"><font>Delivery No.</font></td>
        <td width="2%" valign="top">:</td>
        <td width="24%" align="right" valign="top"><?php echo $data['no_pengiriman']; ?></td>
      </tr>
      <tr>
        <td height="24" valign="top"><font>Delivery Date</font></td>
        <td valign="top">:</td>
        <td width="24%" align="right" valign="top"><?php echo date("d M Y", strtotime($data['tgl_kirim'])); ?></td>
      </tr>
      <tr>
        <td height="24" valign="top">&nbsp;</td>
        <td valign="top"></td>
        <td width="24%" align="right" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
        <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td width="7%" valign="top">Paket   : </td>
        <td width="35%" valign="top"><?php echo $data['nama_paket']; ?></td>
        <td width="15%" valign="top">&nbsp;</td>
        <td colspan="4" rowspan="2" valign="top"><strong>Kepada Yth,</strong><br><br>
        <b><?php echo $data['nama_pembeli']; ?></b><br>
        <?php echo $data['jalan']." Kel.".$data['kelurahan_id']; ?><br>
        <?php echo "Kec.".ucwords(strtolower($data['nama_kecamatan'])).", Kab.".ucwords(strtolower($data['nama_kabupaten'])).", ".ucwords(strtolower($data['nama_provinsi'])); ?><br>
        Kontak : <?php echo $data['kontak_rs']; ?><br>
        </td>
      </tr>
      <tr>
        <td colspan="3" valign="bottom">Dengan hormat,<br> Mohon diterima <em><strong>barang - barang demo</strong></em> berikut ini :</td>
      </tr>
    </table>
        <br>
<table width="100%" class="mytable">
  <tr>
    <td width="16%" align="center"><strong>Item</strong></td>
    <td width="37%" align="center"><strong>Item Description</strong></td>
    <td width="13%" align="center"><strong>Qty</strong></td>
    <td width="34%" align="center"><strong>Serial Number</strong></td>
  </tr>
  <?php 
  $q=mysqli_query($koneksi, "select *,barang_demo_kirim.id as id_kirim,barang_gudang.id as id_gudang from barang_demo_qty,barang_demo_kirim,barang_demo_kirim_detail, barang_demo,barang_gudang where barang_demo.id=barang_demo_qty.barang_demo_id and barang_demo_qty.id=barang_demo_kirim_detail.barang_demo_qty_id and barang_demo_kirim.id=barang_demo_kirim_detail.barang_demo_kirim_id and barang_gudang.id=barang_demo_qty.barang_gudang_id and status_kembali=0 and barang_demo_kirim.id=".$data['id_kirim']." group by nama_brg");
  while ($d = mysqli_fetch_array($q)) { ?>
  <tr>
    <td height="100%" align="center" valign="top"><p><?php echo $d['tipe_brg']; ?></p></td>
    <td valign="top"><?php echo $d['nama_brg']; ?></td>
    <td align="center" valign="top">
    <?php echo $d['qty']." Unit"; ?>
    </td>
    <td align="center" valign="top">
    <?php 
	$qq=mysqli_query($koneksi, "select *,barang_demo_kirim.id as id_kirim from barang_demo_qty,barang_demo_kirim,barang_demo_kirim_detail, barang_demo,barang_gudang,barang_gudang_detail where barang_demo.id=barang_demo_qty.barang_demo_id and barang_demo_qty.id=barang_demo_kirim_detail.barang_demo_qty_id and barang_demo_kirim.id=barang_demo_kirim_detail.barang_demo_kirim_id and barang_gudang_detail.id=barang_demo_kirim_detail.barang_gudang_detail_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_demo_kirim.id=$data[id_kirim] and barang_gudang.id=$d[id_gudang]");
	$j = mysqli_num_rows($qq);
	if ($j>1) {
		$koma=", ";
		}
	else {
		$koma="";
		}
	while ($dd = mysqli_fetch_array($qq)) {
	
	echo $dd['no_seri_brg'].$koma;
		}
	 ?>
    </td>
  </tr>
  <?php } ?>
</table>
<br>
<table>
  <tr>
    <td valign="top"><strong>Note</strong></td>
    <td valign="top">:</td>
    <td valign="top"><?php echo $data['keterangan'] ?></td>
  </tr>
</table>

<br>
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
<div style="position:absolute; bottom:10px">
1. Putih : Setelah ttd mohon kembalikan ke PT. Cipta Varia Kharisma Utama, 2. Merah : Expedisi, 3. Kuning Instansi, 4. Hijau : Gudang, 5. Biru : Admin, 6. Copy : Keuangan
</div>
    </body>
</html>
<?php 
//header("Content-Disposition: attachment;Filename=Surat Jalan-".$data['nama_pembeli']."-".$data['nama_pemakai'].".doc");
?>