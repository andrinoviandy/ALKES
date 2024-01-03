<?php

$id=$_GET['id'];
require("config/koneksi.php");
$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,gaji_karyawan.id as idd from gaji_karyawan,karyawan where karyawan.id=gaji_karyawan.karyawan_id and gaji_karyawan.id=$id"));
?>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
        <title>Cetak Slip Gaji</title>
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
    <body onLoad="window.print();" style="font-family:Arial">
    <img src="img/kop4.png" width="100%" height="auto"/>
    <br><br>
    <table width="100%">
        <tr>
          <td align="left" valign="top"><h2><strong>SLIP GAJI</strong><br>
          </h2></td>
          <td align="right" valign="top"><strong><?php echo $data['bulan_tahun']; ?> </strong></td>
        </tr>
      </table>
      <table width="100%">
        <tr>
          <td width="52%" align="left" valign="top"><table width="100%">
            <tr>
              <td width="31%">Nama</td>
              <td width="5%">:</td>
              <td width="64%"><?php echo $data['nama_karyawan'] ?></td>
            </tr>
            <tr>
              <td>NIK</td>
              <td>:</td>
              <td><?php echo $data['nik'] ?></td>
            </tr>
          </table>            <br></td>
          <td width="48%" align="right" valign="top"><table width="100%">
            <tr>
              <td width="45%">Jabatan</td>
              <td width="5%">:</td>
              <td width="50%"><?php echo $data['jabatan'] ?></td>
            </tr>
            <tr>
              <td>Departemen</td>
              <td>:</td>
              <td><?php echo $data['divisi'] ?></td>
            </tr>
          </table></td>
        </tr>
      </table>
      
<table width="100%" class="	">
  <tr>
    <td colspan="3"><hr></td>
  </tr>
  <tr>
    <td width="47%"><strong>PENERIMAAN</strong></td>
    <td width="5%">&nbsp;</td>
    <td width="48%"><strong>POTONGAN</strong></td>
  </tr>
  <tr>
    <td colspan="3"><hr></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%">
    <?php 
	$q=mysqli_query($koneksi, "select * from gaji where kategori='Penerimaan' order by id ASC");
	while ($d=mysqli_fetch_array($q)){ ?>
      <tr>
        <td width="" valign="top" style="padding-bottom:3px"><?php echo $d['nama_gaji'];
		$besar = mysqli_fetch_array(mysqli_query($koneksi, "select * from gaji_karyawan_detail where gaji_karyawan_id=".$_GET['id']." and gaji_id=$d[id]"));
		$jm = mysqli_num_rows(mysqli_query($koneksi, "select * from gaji_karyawan_detail where gaji_karyawan_id=".$_GET['id']." and gaji_id=$d[id]"));
		if ($jm!=0) {
		if ($besar['dikali']!=1) {
			echo "<br>(".$besar['dikali']." X Rp".number_format($d['besar_gaji'],0,',','.').")";
			}
		}
		 ?></td>
        <td width="" valign="top">:</td>
        <td width="" valign="top">Rp</td>
        <td width="" align="right" valign="top"><?php 
		
			if ($besar['total']!=0) {
			echo number_format($besar['total'],0,',','.');
			} 
			else { echo "-"; }
		
		?></td>
      </tr>
    <?php } ?>
    </table></td>
    <td>&nbsp;</td>
    <td valign="top"><table width="100%">
      <?php 
	$q2=mysqli_query($koneksi, "select * from gaji where kategori='Pengeluaran' order by id ASC");
	while ($d=mysqli_fetch_array($q2)){ ?>
      <tr>
        <td width="" valign="top" style="padding-bottom:3px"><?php echo $d['nama_gaji'];
		$besar = mysqli_fetch_array(mysqli_query($koneksi, "select * from gaji_karyawan_detail where gaji_karyawan_id=".$_GET['id']." and gaji_id=$d[id]"));
		$jm = mysqli_num_rows(mysqli_query($koneksi, "select * from gaji_karyawan_detail where gaji_karyawan_id=".$_GET['id']." and gaji_id=$d[id]"));
		if ($jm!=0) {
		if ($besar['dikali']!=1) {
			echo "<br>(".$besar['dikali']." X Rp".number_format($d['besar_gaji'],0,',','.').")";
			}
		}
		 ?></td>
        <td width="" valign="top">:</td>
        <td width="" valign="top">Rp</td>
        <td width="" align="right" valign="top"><?php 
		
			if ($besar['total']!=0) {
		echo number_format($besar['total'],0,',','.');
		} else {echo "-";}
			
		?></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><hr></td>
  </tr>
  <tr>
    <td><table width="100%">
      <tr>
        <td width=""><strong>Total Penerima</strong></td>
        <td width="" align="right">
          <?php 
		$home_pay1=mysqli_fetch_array(mysqli_query($koneksi, "select sum(total) as jumlah from gaji_karyawan_detail,gaji where gaji.id=gaji_karyawan_detail.gaji_id and gaji.kategori='Penerimaan' and gaji_karyawan_id=".$_GET['id'].""));
		if ($home_pay1['jumlah']!=0) {
		echo "Rp ".number_format($home_pay1['jumlah'],0,',','.');
		} else {echo "-";}
		?>
        </td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
    <td><table width="100%">
      <tr>
        <td width=""><strong>Total Potongan</strong></td>
        <td width="" align="right"><?php 
		$home_pay2=mysqli_fetch_array(mysqli_query($koneksi, "select sum(total) as jumlah from gaji_karyawan_detail,gaji where gaji.id=gaji_karyawan_detail.gaji_id and gaji.kategori='Pengeluaran' and gaji_karyawan_id=".$_GET['id'].""));
		if ($home_pay2['jumlah']!=0) {
		echo "Rp ".number_format($home_pay2['jumlah'],0,',','.');
		} else {echo "-";}
		?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><hr></td>
  </tr>
  
  </table>
<br>
<table width="100%">
      <tr>
        <td width="35%"><strong>Take Home Pay</strong></td>
        <td width="25%" align="center" bgcolor="#999999" style="padding:5px">
          <strong>
          <?php $home_pay1=mysqli_fetch_array(mysqli_query($koneksi, "select sum(total) as jumlah from gaji_karyawan_detail,gaji where gaji.id=gaji_karyawan_detail.gaji_id and gaji.kategori='Penerimaan' and gaji_karyawan_id=".$_GET['id'].""));
	$home_pay2=mysqli_fetch_array(mysqli_query($koneksi, "select sum(total) as jumlah from gaji_karyawan_detail,gaji where gaji.id=gaji_karyawan_detail.gaji_id and gaji.kategori='Pengeluaran' and gaji_karyawan_id=".$_GET['id'].""));
	echo "Rp.    ".number_format($home_pay1['jumlah']-$home_pay2['jumlah'],0,',','.');  ?>
        </strong></td>
        <td width="40%" align="right" valign="top">Pontianak, <?php echo date("d M Y",strtotime($data['tgl_gaji'])); ?></td>
      </tr>
    </table>
    <br>
    <table width="100%">
      <tr>
        <td width="34%" valign="top">Note :<br><?php echo $data['catatan']; ?></td>
        <td width="34%"><strong>Dibuat Oleh,</strong><br>
          <br><br><br><br>
          <strong>............................</strong><strong></strong></td>
        <td width="32%" valign="top"><strong>Diterima Oleh,</strong><br>
          <br><br><br><br>
          <strong>............................</strong></td>
      </tr>
    </table>
    <table>
    
    </table>
  
    <!--
    <div style="page-break-before:always;">
    <table width="100%">
    <thead><img src="img/kop4.png" width="100%"/></thead>
    </table><br>
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
  //$sel = mysqli_query($koneksi, "select * from barang_pesan_detail where barang_pesan_id=".$data['idd']."");
  //while ($data_sel = mysqli_fetch_array($sel)) {
	  $no++;
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><strong>
      <?php 
	$sel2 = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang where id=".$data_sel['barang_gudang_id'].""));
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
	//$sel3 = mysqli_query($koneksi, "select * from spesifikasi where barang_gudang_id=".$data_sel['barang_gudang_id']." order by judul_spesifikasi ASC");
	//while ($data_sel3 = mysqli_fetch_array($sel3)) {
	?>
  <tr>
    <td>&nbsp;</td>
    <td><strong><?php //echo $data_sel3['judul_spesifikasi']; ?></strong><br><br>
    <?php //echo $data_sel3['nama_spesifikasi']; ?>
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php //} ?>
  <tr>
    <td>&nbsp;</td>
    <td><p align="justify"><strong>Catatan : <?php //echo $data_sel['catatan_spek']; ?></strong></p></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php //} ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

    </div>
    -->
    </body>
</html>
