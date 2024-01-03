<?php

$id=$_GET['id'];
require("config/koneksi.php");
$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_dikirim.id as idd,barang_gudang.id as id_gudang from barang_dikirim,barang_dikirim_detail,barang_teknisi,barang_teknisi_detail, barang_dijual, pembeli,alamat_provinsi,alamat_kabupaten,alamat_kecamatan,barang_gudang_detail,barang_gudang,pemakai where barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and pemakai.id=barang_dijual.pemakai_id and barang_teknisi.id=$id and barang_dikirim.id=$_GET[id_kirim]"));
?>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
        <title>Cetak Surat Perintah Instalasi</title>
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
    <center><font size="+2" style="font-family:Arial, Helvetica, sans-serif"><b>SURAT PERINTAH INSTALASI</b></font></font></center><br>
    <table width="100%">
      <tr>
        <td colspan="4" rowspan="3" valign="top" style="font-family:Tahoma, Geneva, sans-serif"><strong>PT. CIPTA VARIA KHARISMA UTAMA<br>
        Jl. Utan Kayu Raya No.105A<br>
        Utan Kayu Utara, Matraman<br>
        Jakarta Timur</strong></td>
        <td width="2%" rowspan="3">&nbsp;</td>
        <td width="17%" height="21"><font>Nomor</font></td>
        <td width="25%" align="right"><?php echo $data['no_spk']; ?></td>
      </tr>
      <tr>
        <td height="21"><font>Tanggal</font></td>
        <td width="25%" align="right"><?php echo date("d M Y", strtotime($data['tgl_spk'])); ?></td>
      </tr>
      <tr>
        <td height="21"><font>No. PO/ID</font></td>
        <td width="25%" align="right"><?php echo $data['no_po_jual']; ?></td>
      </tr>
      <tr>
        <td colspan="4">&nbsp;</td>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td width="5%" valign="top">Paket</td>
        <td width="2%" valign="top">:</td>
        <td width="31%" align="left" valign="top"><?php echo $data['nama_paket']; ?></td>
        <td width="5%" valign="top">&nbsp;</td>
        <td colspan="3" valign="top" style="font-size:14px"><strong>Kepada Yth,</strong><br />
        <b><?php echo $data['nama_pembeli']; ?></b><br>
        <?php echo $data['jalan']." Kel.".$data['kelurahan_id']; ?><br>
        <?php echo "Kec.".ucwords(strtolower($data['nama_kecamatan'])).", Kab.".ucwords(strtolower($data['nama_kabupaten'])).", ".ucwords(strtolower($data['nama_provinsi'])); ?><br>
        UP : <?php echo $data['nama_pemakai']; ?><br>
        Telp : <?php echo $data['kontak1_pemakai']." / ".$data['kontak2_pemakai']; ?>
        <?php if ($data['alamat2']!='') { ?>
        <hr>
        <?php echo $data['alamat2']; ?>
        <?php } ?>
        </td>
      </tr>
    </table>
        <br>
        Barang - barang yang di instalasi, sebagai berikut :<br><br>
<table width="100%" class="mytable">
  <tr>
    <td width="16%" align="center"><strong>Item</strong></td>
    <td width="37%" align="center"><strong>Item Description</strong></td>
    <td width="13%" align="center"><strong>Qty</strong></td>
    <td width="34%" align="center"><strong>Serial Number</strong></td>
  </tr>
  <?php 
  $q=mysqli_query($koneksi, "select *,barang_dikirim.id as idd, barang_gudang.id as id_gudang from barang_dikirim,barang_dikirim_detail, barang_gudang_detail,barang_gudang where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and status_batal=0 and barang_dikirim.id=".$_GET['id_kirim']." group by nama_brg");
  while ($d = mysqli_fetch_array($q)) { ?>
  <tr>
    <td height="100%" align="center" valign="top"><p><?php echo $d['tipe_brg']; ?></p></td>
    <td valign="top"><?php echo $d['nama_brg']; ?></td>
    <td align="center" valign="top">
    <?php 
	$jm = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim_detail,barang_gudang_detail,barang_gudang where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_detail.barang_dikirim_id=$_GET[id_kirim] and barang_gudang.id=$d[id_gudang]"));
	$j_batal = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim_detail,barang_gudang_detail,barang_gudang where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_detail.barang_dikirim_id=$_GET[id_kirim] and status_batal=1 and barang_gudang.id=$d[id_gudang]"));
	echo $jm." ".$d['satuan']."<br>Batal : ".$j_batal; ?>
    </td>
    <td align="center" valign="top">
    <?php 
	$qq=mysqli_query($koneksi, "select * from barang_dikirim_detail,barang_gudang_detail,barang_gudang where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_detail.barang_dikirim_id=$_GET[id_kirim] and status_batal=0 and barang_gudang.id=$d[id_gudang]");
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
    <td colspan="5" valign="top" style="padding-bottom:150px;">
    <table width="100%">
    	<tr>
    	<td width="22%" valign="top" style="padding-bottom:30px;">Lokasi Instalasi</td>
        <td valign="top" width="2%">:</td>
    	<td colspan="4" valign="top" style="font-size:12px"><b><?php echo $data['nama_pembeli']; ?></b><br><?php echo $data['jalan']." Kel.".$data['kelurahan_id']; ?><br>
        <?php echo "Kec.".ucwords(strtolower($data['nama_kecamatan'])).", Kab.".ucwords(strtolower($data['nama_kabupaten'])).", ".ucwords(strtolower($data['nama_provinsi'])); ?></td>
  		</tr>
        <tr>
    	<td width="22%" valign="top" style="">Koordinasi Instalasi</td>
        <td valign="top">:</td>
    	<td colspan="4" valign="top" style="font-size:12px"><?php echo $data['subdis']; ?></td>
  		</tr>
    </table>
    </td>
  </tr>
  <tr>
    <td><hr>Yan Herman</td>
    <td width="17%">&nbsp;</td>
    <td width="25%" align="center"><hr>
      Tri Tinitah Kusumastuti</td>
    <td width="16%" align="center">&nbsp;</td>
    <td width="24%" align="center"><hr>Slamet Imam Santoso</td>
  </tr>
</table>
<br><br><br><br><br><br><br><br>
<div style="position:absolute; bottom:10px">
1. Putih : Teknisi, 2. Merah : Teknisi, 3. Keuangan, 4. Hijau : Administrasi, 5. Biru : Copy Admin</div>
</body>
</html>
