<?php
//header("Content-type: application/vnd.ms-word");

$id=$_GET['id'];
require("config/koneksi.php");
$data2 = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_dikirim.id as id_kirim from barang_dikirim,barang_dikirim_detail, barang_dijual, pembeli,pemakai, alamat_provinsi,alamat_kabupaten,alamat_kecamatan where barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and pemakai.id=barang_dijual.pemakai_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and barang_dikirim.id=$id"));
?>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
        <title>Cetak Surat Jalan</title>
        <style>
		html,
body {
   margin:0;
   padding:0;
   height:100%;
}
#container {
   min-height:100%;
   position:relative;
}
#header {
   background:#ff0;
   padding:10px;
}
#body {
   padding:10px;
   padding-bottom:60px;   /* sesuaikan dengan tinggi footer */
}
#footer {
   position:absolute;
   bottom:0;
   width:100%;
   height:60px;
   font-size:13px;   /* tinggi dari footer */
   
}
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
    <body onLoad="window.print();" style="font:Arial">
    <div id="container">
    <div id="body">
    <center>
    <font size="+2" style="font-family:Arial, Helvetica, sans-serif"><b>SURAT JALAN</b></font>
    </center><br>
    <table width="100%">
      <tr>
        <td colspan="3" rowspan="4" valign="top" style="font-size:17px; font-family:Arial"><b>PT. CIPTA VARIA KHARISMA UTAMA<br>Jl. Utan Kayu Raya No.105A<br>
        Utan Kayu Utara, Matraman<br>
        Jakarta Timur</b></td>
        
      </tr>
      <tr>
        <td width="2%" rowspan="3">&nbsp;</td>
        <td width="15%" height="28" valign="top"><font style="font:Arial">Delivery No.</font></td>
        <td width="2%" valign="top">:</td>
        <td width="24%" align="right" valign="top"><?php echo $data2['no_pengiriman']; ?></td>
      </tr>
      <tr>
        <td height="24" valign="top"><font>Delivery Date</font></td>
        <td valign="top">:</td>
        <td width="24%" align="right" valign="top"><?php echo date("d M Y", strtotime($data2['tgl_kirim'])); ?></td>
      </tr>
      <tr>
        <td height="24" valign="top"><font>PO. No.</font></td>
        <td valign="top">:</td>
        <td width="24%" align="right" valign="top"><?php echo $data2['no_po_jual']; ?></td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
        <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td width="7%" valign="top">Paket   : </td>
        <td width="35%" valign="top"><?php echo $data2['nama_paket']; ?></td>
        <td width="15%" valign="top">&nbsp;</td>
        <td colspan="4" rowspan="2" valign="top"><strong>Kepada Yth,</strong><br><br>
        <b><?php echo $data2['nama_pembeli']; ?></b><br>
        <?php echo $data2['jalan']." Kel.".$data2['kelurahan_id']; ?><br>
        <?php echo "Kec.".ucwords(strtolower($data2['nama_kecamatan'])).", Kab.".ucwords(strtolower($data2['nama_kabupaten'])).", ".ucwords(strtolower($data2['nama_provinsi'])); ?><br>
        UP : <?php echo $data2['nama_pemakai']; ?><br>
        Telp : <?php echo $data2['kontak1_pemakai']." / ".$data2['kontak2_pemakai']; ?>
        <?php if ($data2['alamat2']!='') { ?>
        <hr>
        <?php echo $data2['alamat2']; ?>
        <?php } ?>
        </td>
      </tr>
      <tr>
        <td colspan="3" valign="bottom">Dengan hormat,<br> Mohon diterima barang - barang berikut ini :</td>
      </tr>
    </table>
        <br>
<table width="100%" class="mytable" style="font-size:13px">
  <tr>
    <td width="16%" align="center"><strong>Item</strong></td>
    <td width="37%" align="center"><strong>Item Description</strong></td>
    <td width="13%" align="center"><strong>Qty</strong></td>
    <td width="34%" align="center"><strong>Serial Number</strong></td>
  </tr>
  <?php 
  $q=mysqli_query($koneksi, "select *,barang_dikirim.id as idd, barang_gudang.id as id_gudang from barang_dikirim,barang_dikirim_detail, barang_gudang_detail,barang_gudang where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and status_batal=0 and barang_dikirim.id=".$data2['id_kirim']." group by nama_brg");
  while ($d = mysqli_fetch_array($q)) { ?>
  <tr>
    <td height="100%" align="center" valign="top"><p><?php echo $d['tipe_brg']; ?></p></td>
    <td valign="top"><?php echo $d['nama_brg']; ?></td>
    <td align="center" valign="top">
    <?php 
	$jm = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim_detail,barang_gudang_detail,barang_gudang where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_detail.barang_dikirim_id=$data2[id_kirim] and barang_gudang.id=$d[id_gudang]"));
	$j_batal = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim_detail,barang_gudang_detail,barang_gudang where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_detail.barang_dikirim_id=$data2[id_kirim] and status_batal=1 and barang_gudang.id=$d[id_gudang]"));
	echo $jm." ".$d['satuan']."<br>";
	if ($j_batal !== 0) {
	echo "Batal : ".$j_batal;
	} ?>
    </td>
    <td align="center" valign="top">
    <?php 
	$qq=mysqli_query($koneksi, "select * from barang_dikirim_detail,barang_gudang_detail,barang_gudang where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_detail.barang_dikirim_id=$data2[id_kirim] and status_batal=0 and barang_gudang.id=$d[id_gudang]");
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
    <td align="center"><hr>Habib Nurrohman</td>
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
</div>
<div id="footer">
1. Putih : Setelah ttd mohon kembalikan ke PT. Cipta Varia Kharisma Utama, 2. Merah : Expedisi, 3. Kuning Instansi, 4. Hijau : Gudang, 5. Biru : Admin, 6. Copy : Keuangan
</div>
</div>
    </body>
</html>
<?php 
//header("Content-Disposition: attachment;Filename=Surat Jalan-".$data2['nama_pembeli']."-".$data2['nama_pemakai'].".doc");
?>