<?php
$id=$_GET['id'];
require("config/koneksi.php");
$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from diagnosa_pasien where id=$id"));
?>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
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
    </head>
    <body onLoad="window.print();">
    <table width="100%">
  <tr>
    <td align="center" valign="top"><h2><strong><em>Hasil Rekam Medis Pasien</em></strong></h2></td>
  </tr>
  </table>
<br />
<br />
<table class="mytable">
  <tr valign="top">
    <td style="padding:10px">&nbsp;</td>
    <td align="right" style="padding:10px">Tanggal Daftar : <?php echo $data['tgl_daftar']; ?></td>
  </tr>
  <tr valign="top">
    <td width="58%" style="padding:10px"><table width="100%">
      <tr height="30px">
        <td width="36%" valign="top">Nama</td>
        <td width="5%" valign="top">:</td>
        <td width="59%" valign="top"><?php echo $data['nama_pasien']; ?></td>
      </tr>
      <tr height="30px">
        <td valign="top">Keluhan</td>
        <td valign="top">&nbsp;</td>
        <td valign="top"><?php echo ucwords(strtolower($data['keluhan'])); ?></td>
      </tr>
      <tr height="30px">
        <td valign="top">Diagnosa</td>
        <td valign="top">&nbsp;</td>
        <td valign="top"><?php echo ucwords(strtolower($data['diagnosa'])); ?></td>
      </tr>
      <tr height="30px">
        <td valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
      </tr>
    </table></td>
    <td width="45%" style="padding:10px">&nbsp;</td>
  </tr>
  </table>
<br />
<table border="1" class="mytable">
  <tr>
    <td width="6%" align="center"><strong>No.</strong></td>
    <td width="48%" align="center" height="30px"><strong>Nama Obat</strong></td>
    <td width="23%" align="center"><strong>Qty</strong></td>
    <td width="23%" align="center"><strong>Harga Satuan</strong></td>
  </tr>
  <?php
  $q2=mysqli_query($koneksi, "select * from obat_pasien,obat where obat.id=obat_pasien.obat_id and diagnosa_pasien_id=".$id."");
  $no=0;
  while ($d2 = mysqli_fetch_array($q2)) {
  $no++;
  ?>
  <tr>
    <td style="padding-left:10px; padding-right:10px"><?php echo $no; ?></td>
    <td height="30px" style="padding-left:10px; padding-right:10px"><?php echo $d2['nama_obat']; ?></td>
    <td align="center" style="padding-left:10px; padding-right:10px"><?php echo $d2['qty']; ?></td>
    <td style="padding-left:10px; padding-right:10px"><?php echo $d2['harga_obat']; ?></td>
  </tr>
  <?php } ?>
</table><br /><br><br>
<table class="mytable">
  <tr>
    <td width="94%" align="right"><strong>&nbsp; Dokter</strong></td>
    <td width="6%" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td height="90" align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><strong><em>Signature</em></strong></td>
    <td align="right">&nbsp;</td>
  </tr>
</table>

    </body>
</html>
