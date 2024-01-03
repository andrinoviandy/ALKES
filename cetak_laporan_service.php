<?php

require("config/koneksi.php");
$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,tb_maintenance_detail.id as idd from tb_laporan_kerusakan_cs,tb_laporan_kerusakan_cs_detail,tb_laporan_kerusakan_detail,alat_pelatihan,alat_uji_detail,barang_teknisi_detail,barang_dikirim_detail,barang_gudang_detail,barang_gudang,tb_teknisi,pembeli,tb_maintenance_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and alat_uji_detail.id=alat_pelatihan.alat_uji_detail_id and alat_pelatihan.id=tb_laporan_kerusakan_detail.alat_pelatihan_id and tb_laporan_kerusakan_cs.id=tb_laporan_kerusakan_cs_detail.tb_laporan_kerusakan_cs_id and tb_laporan_kerusakan_cs_detail.id=tb_laporan_kerusakan_detail.tb_laporan_kerusakan_cs_detail_id and tb_teknisi.id=tb_laporan_kerusakan_detail.teknisi_id and pembeli.id=tb_laporan_kerusakan_cs.pembeli_id and tb_laporan_kerusakan_detail.id=tb_maintenance_detail.tb_laporan_kerusakan_detail_id and tb_maintenance_detail.id=".$_GET['id'].""));
?>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
        <title>Cetak Laporan Service</title>
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
    <td width="47%" rowspan="2" valign="top"><img src="img/kop.png" width="340px" height="auto" /></td>
    <td width="3%">&nbsp;</td>
    <td width="50%" align="center"><font color="#000099" style="font-size:30px"><b>CUSTOMER SERVICE<br>REPORT</b></font></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center"><table width="300px" class="mytable2">
      <tr>
        <td height="30px"><strong>&nbsp;&nbsp;No :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/CR/TECH/KU/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/20</strong></td>
      </tr>
    </table></td>
  </tr>
</table>
<br />
<strong>Customer Data</strong><br />
<table class="mytable">
  <tr valign="top">
    <td width="50%" style="padding:10px"><table width="100%">
      <tr height="30px">
        <td width="41%" valign="top">Customer</td>
        <td width="4%" valign="top">:</td>
        <td width="55%" valign="top"><?php echo $data['nama_pembeli']; ?></td>
      </tr>
      <tr height="30px">
        <td valign="top">Address</td>
        <td valign="top">:</td>
        <td rowspan="2" valign="top"><?php echo $data['jalan'].", ".$data['kelurahan_id']; ?></td>
      </tr>
      <tr height="30px">
        <td valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
        </tr>
      <tr height="30px">
        <td valign="top">City / State</td>
        <td valign="top">:</td>
        <td valign="top">-</td>
      </tr>
      <tr height="30px">
        <td valign="top">Province</td>
        <td valign="top">:</td>
        <td valign="top">-</td>
      </tr>
    </table></td>
    <td width="50%" style="padding:10px"><table width="100%">
      <tr height="30px">
        <td width="39%" valign="top">Contact Person</td>
        <td width="5%" valign="top">:</td>
        <td width="56%" valign="top"><?php echo $data['kontak_rs']; ?></td>
      </tr>
      <tr height="30px">
        <td valign="top">Phone</td>
        <td valign="top">:</td>
        <td valign="top">-</td>
      </tr>
      <tr height="30px">
        <td valign="top">HP</td>
        <td valign="top">:</td>
        <td valign="top">-</td>
      </tr>
      <tr height="30px">
        <td valign="top">Email</td>
        <td valign="top">:</td>
        <td valign="top"><?php echo "-"; ?></td>
      </tr>
      <tr height="30px">
        <td valign="top">Department</td>
        <td valign="top">:</td>
        <td valign="top"><?php echo $data['nama_pembeli']; ?></td>
      </tr>
    </table></td>
  </tr>
  </table><br />
<strong>Equipment Data</strong>
<br />
<table class="mytable">
  <tr valign="top">
    <td width="50%" style="padding:10px"><table width="100%">
      <tr height="30px">
        <td width="41%" valign="top">Equipment Name</td>
        <td width="5%" valign="top">:</td>
        <td width="54%" valign="top"><?php echo $data['nama_brg']; ?></td>
      </tr>
      <tr height="30px">
        <td valign="top">Model / Type</td>
        <td valign="top">:</td>
        <td valign="top"><?php echo $data['tipe_brg']; ?></td>
      </tr>
      <tr height="30px">
        <td valign="top">Installation Date</td>
        <td valign="top">:</td>
        <td valign="top"><?php echo date("d F Y",strtotime($data['tgl_i'])); ?></td>
      </tr>
    </table></td>
    <td width="50%" style="padding:10px"><table width="100%">
      <tr height="30px">
        <td width="39%" valign="top">Brand</td>
        <td width="5%" valign="top">:</td>
        <td width="56%" valign="top"><?php echo $data['merk_brg']; ?></td>
      </tr>
      <tr height="30px">
        <td valign="top">Serial Number</td>
        <td valign="top">:</td>
        <td valign="top"><?php echo $data['no_seri_brg']; ?></td>
      </tr>
      <tr height="30px">
        <td valign="top">Install By</td>
        <td valign="top">:</td>
        <td valign="top"><?php echo $data['nama_teknisi']; ?></td>
      </tr>
    </table></td>
  </tr>
  </table>
<br />

<strong>Description</strong>
<br />
<table border="1" class="mytable">
  <tr>
    <td width="50%" align="center"><strong>Problem</strong></td>
  </tr>
 
  <tr>
    <td style="padding:20px"><?php echo $data['problem']; ?></td>
  </tr>

</table>
<br />
<table border="1" class="mytable">
  <tr>
    <td width="30%"><strong>&nbsp;&nbsp;Date :</strong></td>
    <td width="35%"><strong>&nbsp;&nbsp;Receipt By :</strong></td>
    <td width="35%"><strong>&nbsp;&nbsp;Handle By Engineer :</strong></td>
  </tr>
  <tr>
    <td rowspan="2">&nbsp;</td>
    <td height="90">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table><br>
<table width="100%" border="1" class="mytable">
  <tr>
    <td style="padding:10px"><table width="100%">
      <tr>
        <td width="6%"><input type="checkbox" name="checkbox" id="checkbox" style="height:20px; width:20px;"></td>
        <td width="14%">Clear</td>
        <td width="3%">&nbsp;</td>
        <td width="6%"><input type="checkbox" name="checkbox5" id="checkbox5" style="height:20px; width:20px"></td>
        <td width="25%">Handle By Phone</td>
        <td width="7%"><input type="checkbox" name="checkbox9" id="checkbox9" style="height:20px; width:20px"></td>
        <td width="39%">Other :</td>
      </tr>
      <tr>
        <td><input type="checkbox" name="checkbox2" id="checkbox2" style="height:20px; width:20px"></td>
        <td>Service</td>
        <td>&nbsp;</td>
        <td><input type="checkbox" name="checkbox6" id="checkbox6" style="height:20px; width:20px"></td>
        <td>Send Spare Part</td>
        <td>&nbsp;</td>
        <td rowspan="3" valign="top" align="justify">&nbsp;</td>
      </tr>
      <tr>
        <td><input type="checkbox" name="checkbox3" id="checkbox3" style="height:20px; width:20px"></td>
        <td>Retur</td>
        <td>&nbsp;</td>
        <td><input type="checkbox" name="checkbox7" id="checkbox7" style="height:20px; width:20px"></td>
        <td>Go To Place</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><input type="checkbox" name="checkbox4" id="checkbox4" style="height:20px; width:20px"></td>
        <td>Backup</td>
        <td>&nbsp;</td>
        <td><input type="checkbox" name="checkbox8" id="checkbox8" style="height:20px; width:20px"></td>
        <td>Waiting Spare Part</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
    </body>
</html>
