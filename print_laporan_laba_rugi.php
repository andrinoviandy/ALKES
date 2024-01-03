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
<center><strong>
<h3><u>LAPORAN LABA RUGI</u>
<br /><?php echo date("d/m/Y",strtotime($_GET['tgl1']))." - ".date("d/m/Y",strtotime($_GET['tgl2'])); ?></h3></strong></center>
<table width="100%" style="font-family:'Courier New', Courier, monospace">
  <tr>
    <td><strong>PEMASUKAN</strong></td>
    <td align="right">
      <strong>
      <?php 
				  $pemasukan=mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail,coa,coa_sub where keuangan.id=keuangan_detail.keuangan_id and coa.id=keuangan_detail.coa_id and coa_sub.id=keuangan_detail.coa_sub_id and coa.id=4"));
				  echo number_format($pemasukan['total'],2,',','.'); ?>
    </strong>    </td>
  </tr>
  <tr>
    <td colspan="2" style="padding:0px; margin:0px"><hr /></td>
  </tr>
  <?php 
				$q_coa4 = mysqli_query($koneksi, "select * from coa_sub where coa_id=4");
				while ($d_coa=mysqli_fetch_array($q_coa4)) {
				?>
  <tr>
    <td><?php echo $d_coa['nama_sub_grup']; ?></td>
    <td align="right"><?php 
				  $saldo4 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail where keuangan.id=keuangan_detail.keuangan_id and keuangan_detail.coa_sub_id=$d_coa[id]"));
				  echo number_format($saldo4['total'],2,',','.');
				  ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>PENGELUARAN</strong></td>
    <td align="right">
    <strong><?php 
				  $pengeluaran=mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail,coa,coa_sub where keuangan.id=keuangan_detail.keuangan_id and coa.id=keuangan_detail.coa_id and coa_sub.id=keuangan_detail.coa_sub_id and coa.id=5"));
				  echo number_format($pengeluaran['total'],2,',','.'); ?>
                  </strong>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="padding:0px; margin:0px"><hr /></td>
  </tr>
  <?php 
				$q_coa5 = mysqli_query($koneksi, "select * from coa_sub where coa_id=5");
				while ($d_coa=mysqli_fetch_array($q_coa5)) {
				?>
  <tr>
    <td><?php echo $d_coa['nama_sub_grup']; ?></td>
    <td align="right"><?php 
				  $saldo5 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail where keuangan.id=keuangan_detail.keuangan_id and coa_sub_id=$d_coa[id]"));
				  echo number_format($saldo5['total'],2,',','.');
				  ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>
              <?php if ($pemasukan['total']-$pengeluaran['total']<0) {echo "RUGI BERSIH";} else {echo "LABA BERSIH";} ?></strong></td>
    <td align="right">
    <strong><?php 
				  echo number_format($pemasukan['total']-$pengeluaran['total'],2,',','.'); ?>
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
  <?php } ?>
  <tr>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
</table>

</body>
</html>