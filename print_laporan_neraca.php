<?php require("config/koneksi.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Laporan Neraca</title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body onload="window.print();">
<center><strong><h3><u>LAPORAN NERACA</u>
<br /><?php echo date("d/m/Y",strtotime($_GET['tgl'])); ?></h3></strong></center>
<table width="100%" style="font-family:'Courier New', Courier, monospace">
  <tr>
    <td><strong>ASET</strong></td>
    <td align="right">
      <strong>
      <?php 
				  $aset1=mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from buku_kas"));
				  $aset11_d=mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail,coa,coa_sub where keuangan.id=keuangan_detail.keuangan_id and coa.id=keuangan_detail.coa_id and coa_sub.id=keuangan_detail.coa_sub_id and db_cr='db' and coa.id=1"));
				  $aset11_c=mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail,coa,coa_sub where keuangan.id=keuangan_detail.keuangan_id and coa.id=keuangan_detail.coa_id and coa_sub.id=keuangan_detail.coa_sub_id and db_cr='cr' and coa.id=1"));
				  echo number_format($aset1['total']+($aset11_d['total']-$aset11_c['total']),0,',','.'); ?>
    </strong>    </td>
  </tr>
  <tr>
    <td colspan="2" style="padding:0px; margin:0px"><hr /></td>
  </tr>
  <tr>
    <td>Kas di Bank</td>
    <td align="right">
    <?php 
				  $aset2=mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from buku_kas where tipe_akun='BANK'"));
				  echo number_format($aset2['total'],0,',','.'); ?>
    </td>
  </tr>
  <tr>
    <td>Kas di Tangan</td>
    <td align="right"><font class="pull-right">
      <?php 
				  $aset3=mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from buku_kas where tipe_akun='KAS'"));
				  echo number_format($aset3['total'],0,',','.'); ?>
    </font></td>
  </tr>
  <?php 
				$q_coa = mysqli_query($koneksi, "select * from coa_sub where coa_id=1");
				while ($d_coa=mysqli_fetch_array($q_coa)) {
				?>
  <tr>
    <td><?php echo $d_coa['nama_sub_grup']; ?></td>
    <td align="right"><?php 
				  $saldo1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail where keuangan.id=keuangan_detail.keuangan_id and coa_sub_id=$d_coa[id]"));
				  echo number_format($saldo1['total'],0,',','.');
				  ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>KEWAJIBAN</strong></td>
    <td align="right">
    <strong><?php 
				  $kewajiban1=mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail,coa,coa_sub where keuangan.id=keuangan_detail.keuangan_id and coa.id=keuangan_detail.coa_id and coa_sub.id=keuangan_detail.coa_sub_id and db_cr='db' and coa.id=2"));
				  $kewajiban2=mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail,coa,coa_sub where keuangan.id=keuangan_detail.keuangan_id and coa.id=keuangan_detail.coa_id and coa_sub.id=keuangan_detail.coa_sub_id and db_cr='cr' and coa.id=2"));
				  echo number_format($kewajiban1['total']-$kewajiban2['total'],0,',','.'); ?>
                  </strong>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="padding:0px; margin:0px"><hr /></td>
  </tr>
  <?php 
				$q_coa2 = mysqli_query($koneksi, "select * from coa_sub where coa_id=2");
				while ($d_coa=mysqli_fetch_array($q_coa2)) {
				?>
  <tr>
    <td><?php echo $d_coa['nama_sub_grup']; ?></td>
    <td align="right"><?php 
				  $saldo2_db = mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail where keuangan.id=keuangan_detail.keuangan_id and db_cr='db' and coa_sub_id=$d_coa[id]"));
				  $saldo2_cr = mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail where keuangan.id=keuangan_detail.keuangan_id and db_cr='cr' and coa_sub_id=$d_coa[id]"));
				  echo number_format($saldo2_db['total']-$saldo2_cr['total'],0,',','.');
				  ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>EKUITAS</strong></td>
    <td align="right">
    <strong><?php 
				  $ekuitas_1=mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail,coa,coa_sub where keuangan.id=keuangan_detail.keuangan_id and coa.id=keuangan_detail.coa_id and coa_sub.id=keuangan_detail.coa_sub_id and coa.id=3 and db_cr='db'"));
				  $ekuitas_2=mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail,coa,coa_sub where keuangan.id=keuangan_detail.keuangan_id and coa.id=keuangan_detail.coa_id and coa_sub.id=keuangan_detail.coa_sub_id and coa.id=3 and db_cr='cr'"));
				  echo number_format($ekuitas_1['total']-$ekuitas_2['total'],0,',','.'); ?>
                  </strong>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="padding:0px; margin:0px"><hr /></td>
  </tr>
  <?php 
				$q_coa3 = mysqli_query($koneksi, "select * from coa_sub where coa_id=3");
				while ($d_coa=mysqli_fetch_array($q_coa3)) {
				?>
  <tr>
    <td><?php echo $d_coa['nama_sub_grup']; ?></td>
    <td align="right">
    <?php 
				  $saldo3_1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail where keuangan.id=keuangan_detail.keuangan_id and coa_sub_id=$d_coa[id] and db_cr='db'"));
				  $saldo3_2 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail where keuangan.id=keuangan_detail.keuangan_id and coa_sub_id=$d_coa[id] and db_cr='cr'"));
				  echo number_format($saldo3_1['total']-$saldo3_2['total'],0,',','.');
				  ?>
    </td>
  </tr>
  <?php } ?>
  <tr>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
</table>

</body>
</html>