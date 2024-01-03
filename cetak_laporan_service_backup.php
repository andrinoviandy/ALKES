<?php
$id=$_GET['id'];
require("config/koneksi.php");
$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,tb_maintenance.id as idd from tb_maintenance,tb_laporan_kerusakan,akun_customer,kategori_job,tb_teknisi,barang_dikirim,barang_dijual,barang_gudang,pembeli,alamat_provinsi,alamat_kabupaten,alamat_kecamatan where tb_laporan_kerusakan.id=tb_maintenance.laporan_kerusakan_id and tb_teknisi.id=tb_maintenance.teknisi_id and akun_customer.id=tb_laporan_kerusakan.akun_customer_id and kategori_job.id=tb_laporan_kerusakan.kategori_job_id and barang_dikirim.id=tb_laporan_kerusakan.barang_dikirim_id and barang_gudang.id=barang_dijual.barang_gudang_id and barang_dijual.id=barang_dikirim.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and tb_maintenance.id=$id"));
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
            }
			.mytable2{
                border:1px solid black; 
                border-collapse: collapse;
                
            }
            
        </style>
        <link href='logo.png' rel='icon'>
    </head>
    <body onLoad="window.print();">
    <table width="100%">
  <tr>
    <td width="47%" rowspan="2" valign="top"><img src="img/kop.png" width="300px" height="auto" /></td>
    <td width="3%">&nbsp;</td>
    <td width="50%" align="center"><font color="#000099" style="font-size:30px"><b>CUSTOMER SERVICE<br>REPORT</b></font></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center"><table width="200px" class="mytable2">
      <tr>
        <td><strong>&nbsp;&nbsp;No :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/CR/TECH/KU/&nbsp;&nbsp;&nbsp;&nbsp;/20</strong></td>
      </tr>
    </table></td>
  </tr>
</table>
<br />
<strong>Customer data</strong><br />
<table class="mytable">
  <tr>
    <td><table width="100%">
      <tr>
        <td width="19%" valign="top">Customer</td>
        <td width="3%" valign="top">:</td>
        <td width="29%" valign="top"><?php echo $data['nama_user']; ?></td>
        <td width="3%" valign="top">&nbsp;</td>
        <td width="16%" valign="top">Contact Person</td>
        <td width="3%" valign="top">:</td>
        <td width="27%" valign="top"><?php echo $data['telp_user']; ?></td>
      </tr>
      <tr>
        <td valign="top">Address</td>
        <td valign="top">:</td>
        <td rowspan="2" valign="top"><?php echo $data['alamat_user']; ?></td>
        <td valign="top">&nbsp;</td>
        <td valign="top">Phone</td>
        <td valign="top">:</td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
        <td valign="top">HP</td>
        <td valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td valign="top">City / State</td>
        <td valign="top">:</td>
        <td valign="top"><?php echo ucwords(strtolower($data['nama_kecamatan'])); ?></td>
        <td valign="top">&nbsp;</td>
        <td valign="top">Email</td>
        <td valign="top">:</td>
        <td valign="top"><?php echo $data['username']; ?></td>
      </tr>
      <tr>
        <td valign="top">Province</td>
        <td valign="top">:</td>
        <td valign="top"><?php echo ucwords(strtolower($data['nama_provinsi'])); ?></td>
        <td valign="top">&nbsp;</td>
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
  <tr>
    <td><table width="100%">
      <tr>
        <td width="19%" valign="top">Equipment Name</td>
        <td width="3%" valign="top">:</td>
        <td width="29%" valign="top"><?php echo $data['nama_brg']; ?></td>
        <td width="3%" valign="top">&nbsp;</td>
        <td width="17%" valign="top">Brand</td>
        <td width="2%" valign="top">:</td>
        <td width="27%" valign="top"><?php echo $data['merk_brg']; ?></td>
      </tr>
      <tr>
        <td valign="top">Model / Type</td>
        <td valign="top">:</td>
        <td valign="top"><?php echo $data['tipe_brg']; ?></td>
        <td valign="top">&nbsp;</td>
        <td valign="top">Serial Number</td>
        <td valign="top">:</td>
        <td valign="top"><?php echo $data['no_seri_brg']; ?></td>
      </tr>
      <tr>
        <td valign="top">Installation Date</td>
        <td valign="top">:</td>
        <td valign="top"><?php echo $data['tipe_brg']; ?></td>
        <td valign="top">&nbsp;</td>
        <td valign="top">Install By</td>
        <td valign="top">:</td>
        <td valign="top"><?php echo $data['tipe_brg']; ?></td>
      </tr>
    </table></td>
  </tr>
</table>
<br />
<strong>Job Type</strong>
<br />
<?php 
if ($data['nama_job']=="Preventive Maintenance") {
	$cek="checked";
	}
else if ($data['nama_job']=="Corrective Maintenance") {
	$cek="checked";
	}
else if ($data['nama_job']="Warranty") {
	$cek="checked";
	}
else if ($data['nama_job']="Up-Grade") {
	$cek="checked";
	}
else {
	$cek="checked";
	}
?>
<table class="mytable">
  <tr>
    <td><table width="100%">
      <tr>
        <td width="29%">Preventive Maintenance <input <?php echo $cek; ?> name="" type="checkbox" value="" /></td>
        <td width="29%">Corrective Maintenance <input <?php echo $cek; ?> name="" type="checkbox" value="" /></td>
        <td width="17%">Warranty <input <?php echo $cek; ?> name="" type="checkbox" value="" /></td>
        <td width="14%">Up-Grade <input <?php echo $cek; ?> name="" type="checkbox" value="" /></td>
        <td width="11%">Other <input <?php echo $cek; ?> name="" type="checkbox" value="" /></td>
        </tr>
    </table></td>
  </tr>
</table>
<br />
<strong>Description</strong>
<br />
<table border="1" class="mytable">
  <tr>
    <td width="50%">Problem <?php echo $data['nama_job']; ?></td>
    <td>Action</td>
  </tr>
  <?php 
  $q = mysqli_query($koneksi, "select * from progress_maintenance where maintenance_id=".$data['idd']."");
  while ($d = mysqli_fetch_array($q)) {
  ?>
  <tr>
    <td><?php echo $d['deskripsi_kerusakan']; ?></td>
    <td><?php echo $d['deskripsi_perbaikan']; ?></td>
  </tr>
  <?php } ?>
</table><br />
<strong>Replacement Part</strong>
<br />
<table border="1" class="mytable">
  <tr>
    <td width="22%" align="center">Order No</td>
    <td width="37%" align="center">Description</td>
    <td width="10%" align="center">Qty</td>
    <td width="14%" align="center">Price</td>
    <td width="17%" align="center">Amount</td>
  </tr>
  <?php
  $q2=mysqli_query($koneksi, "select *,(qty_order*harga_order) as amount, sum(qty_order*harga_order) as total from replacement_part where maintenance_id=".$data['idd']."");
  while ($d2 = mysqli_fetch_array($q2)) {
  ?>
  <tr>
    <td><?php echo $d2['order_no']; ?></td>
    <td><?php echo $d2['deskripsi_order']; ?></td>
    <td align="center"><?php echo $d2['qty_order']; ?></td>
    <td align="center"><?php echo "Rp ".number_format($d2['harga_order'],0,',','.'); ?></td>
    <td align="right" style="padding-right:10px"><?php echo "Rp ".number_format($d2['amount'],0,',','.'); ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="4" align="right">Total :&nbsp;&nbsp;</td>
    <td align="right" style="padding-right:10px"><?php 
	$d3=mysqli_fetch_array(mysqli_query($koneksi, "select *,SUM(qty_order*harga_order) as total from replacement_part where maintenance_id=".$data['idd'].""));
	echo $d3['total']; ?></td>
  </tr>
</table><br />
<table border="1" class="mytable">
  <tr>
    <td width="30%"><strong>Date :</strong></td>
    <td width="35%"><strong>Engineer signature</strong></td>
    <td width="35%"><strong>Customer signature</strong></td>
  </tr>
  <tr>
    <td height="62">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

    </body>
</html>
