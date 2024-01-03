<?php
$id=$_GET['id'];
require("config/koneksi.php");
$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,alat_uji_detail.id as idd,pembeli_id as id_rumkit,barang_gudang.id as id_gudang from barang_teknisi,barang_teknisi_detail,barang_teknisi_detail_teknisi, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli,pemakai, tb_teknisi,alat_uji_detail,alamat_provinsi,alamat_kabupaten,alamat_kecamatan where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_teknisi_detail.id=barang_teknisi_detail_teknisi.barang_teknisi_detail_id and tb_teknisi.id=barang_teknisi_detail_teknisi.teknisi_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and pemakai.id=barang_dijual.pemakai_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and alat_uji_detail.id=$id"));
?>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
        <title>Cetak Laporan Instalasi</title>
        <style>
         .mytable{
                border:1px solid black; 
                border-collapse: collapse;
                width: 100%;
				border-color:#000099;
            }
			.mytable2{
                border:1px solid black; 
                border-collapse: collapse;
                border-color:#000099;
            }
            
        </style>
        <link href='logo.png' rel='icon'>
    </head>
    <body onLoad="window.print();" style="color:#000099">
    <table width="100%">
  <tr>
    <td width="55%" rowspan="2" valign="top"><img src="img/kop.png" width="350px" height="auto" /></td>
    <td width="3%">&nbsp;</td>
    <td width="42%" align="center"><font color="#000099" style="font-size:25px"><b>INSTALLATION REPORT</b></font></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center"><table width="300px" height="30px" class="mytable2">
      <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>No :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ws-KU</strong></td>
      </tr>
    </table></td>
  </tr>
</table>
<br />
<strong>Institute data</strong><br />
<table class="mytable">
  <tr valign="top">
    <td width="58%" style="padding:10px"><table width="100%">
      <tr height="30px">
        <td width="36%" valign="top">Hospital Name</td>
        <td width="5%" valign="top">:</td>
        <td width="59%" valign="top"><?php echo $data['nama_pembeli']; ?></td>
      </tr>
      <tr height="30px">
        <td valign="top">Department</td>
        <td valign="top">:</td>
        <td valign="top"><?php echo ucwords(strtolower($data['nama_provinsi'])); ?></td>
      </tr>
      <tr height="30px">
        <td valign="top">Address</td>
        <td valign="top">:</td>
        <td valign="top"><?php echo ucwords(strtolower($data['nama_kecamatan'])); ?></td>
      </tr>
    </table></td>
    <td width="45%" style="padding:10px"><table width="100%">
      <tr height="30px">
        <td width="50%" valign="top">User Name</td>
        <td width="6%" valign="top">:</td>
        <td width="44%" valign="top"><?php echo $data['nama_pemakai']; ?></td>
      </tr>
      <tr height="30px">
        <td valign="top">Contact Number</td>
        <td valign="top">:</td>
        <td valign="top"><?php echo $data['kontak1_pemakai']; ?></td>
      </tr>
      <tr height="30px">
        <td valign="top">City</td>
        <td valign="top">:</td>
        <td valign="top"><?php echo $data['kontak2_pemakai']; ?></td>
      </tr>
    </table></td>
  </tr>
  </table><br />
<strong>Instrument Data</strong>
<br />
<table class="mytable">
  <tr>
    <td width="58%" valign="top" style="padding:10px"><table width="100%">
      <tr height="30px">
        <td width="36%" valign="top">Instrument Name</td>
        <td width="5%" valign="top">:</td>
        <td width="59%" valign="top"><?php echo $data['nama_brg']; ?></td>
      </tr>
      <tr height="30px">
        <td valign="top">Serial Number</td>
        <td valign="top">:</td>
        <td valign="top"><?php echo $data['no_seri_brg']; ?></td>
      </tr>
      <tr height="30px">
        <td valign="top">Installation Date</td>
        <td valign="top">:</td>
        <td valign="top"><?php echo date("d M Y",strtotime($data['tgl_i'])); ?></td>
      </tr>
    </table></td>
    <td width="43%" valign="top" style="padding:10px"><table width="100%">
      <tr height="30px">
        <td width="50%" valign="top">Brand</td>
        <td width="6%" valign="top">:</td>
        <td width="44%" valign="top"><?php echo $data['merk_brg']; ?></td>
      </tr>
      <tr height="30px">
        <td valign="top">S / W ver</td>
        <td valign="top">:</td>
        <td valign="top"><?php echo $data['soft_version']; ?></td>
      </tr>
      <tr height="30px">
        <td valign="top">Warranty Expired</td>
        <td valign="top">:</td>
        <td valign="top"><?php echo date("d M Y",strtotime($data['tgl_garansi_habis'])); ?></td>
      </tr>
    </table></td>
  </tr>
  </table>

<br />
<table class="mytable">
  <tr>
    <td width="22%" height="30px">&nbsp;Project name</td>
    <td width="78%">: Installation <?php echo $data['nama_brg']; ?></td>
  </tr>
</table><br />
<strong>Peripherals / Accessories data</strong>
<br />
<table border="1" class="mytable">
  <tr>
    <td width="38%" align="center" height="30px"><strong>Accessories Name</strong></td>
    <td width="32%" align="center"><strong>Model / Type / No</strong></td>
    <td width="30%" align="center"><strong>Description</strong></td>
  </tr>
  <?php
  $q2=mysqli_query($koneksi, "select * from aksesoris_alkes,aksesoris where aksesoris.id=aksesoris_alkes.aksesoris_id and aksesoris_alkes.barang_gudang_id=".$data['id_gudang']."");
  $to=mysqli_num_rows($q2);
  if ($to!=0) {
  while ($d2 = mysqli_fetch_array($q2)) {
  ?>
  <tr>
    <td height="30px" style="padding-left:10px; padding-right:10px"><?php echo $d2['nama_akse']; ?></td>
    <td align="center" style="padding-left:10px; padding-right:10px"><?php echo $d2['merk_akse']." / ".$d2['tipe_akse']." / ".$d2['nie_akse']; ?></td>
    <td style="padding-left:10px; padding-right:10px"><?php echo $d2['deskripsi_akse']; ?></td>
  </tr>
  <?php } } else { ?>
  <tr height="30px"><td colspan="3" height="30px" align="center">Tidak Ada Aksesoris</td></tr>
  <?php } ?>
</table><br />
<table width="100%" border="1" class="mytable">
  <tr>
    <td style="padding-left:10px; padding-top:10px; padding-bottom:60px"><strong >Remarks :</strong></td>
  </tr>
</table>
<br><br>
<table border="1" class="mytable">
  <tr>
    <td width="30%"><strong>&nbsp;Date :</strong></td>
    <td width="35%"><strong>&nbsp;Installation by :</strong></td>
    <td width="35%"><strong>&nbsp; Approved by :</strong></td>
  </tr>
  <tr>
    <td height="90">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center"><strong>Engineer signature</strong></td>
    <td align="center"><strong>Customer name / signature</strong></td>
  </tr>
</table>

    </body>
</html>
