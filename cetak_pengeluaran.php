<?php
require("config/koneksi.php");
$q=mysqli_query($koneksi, "select *,pengeluaran.id as idd from pengeluaran where tgl_pengeluaran between '".$_POST['tgl1']."' and '".$_POST['tgl2']."'");

?>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
        <title>Cetak Pengeluaran</title>
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
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    </head>
    <body onLoad="window.print();" style="font-family:">
    <table width="100%">
    <thead><img src="img/kop4.png" width="100%"/></thead>
    </table>
    <br>
    <table width="100%">
      <tr>
        <td align="center"><strong><u><font size="+2">PENGELUARAN</font></u></strong><br>
        <strong><i>Dari Tanggal <?php echo $_POST['tgl1']; ?> Sampai Tanggal <?php echo $_POST['tgl2']; ?></i></strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
    <table width="100%" class="mytable" style="padding-left:20px">
      <tr>
        <td width="12%" align="center"><strong>No.</strong></td>
        <td width="21%" align="center"><strong>Tanggal</strong></td>
        <td width="45%" align="center"><strong>Kebutuhan</strong></td>
        
        <td width="22%" align="center"><strong>Biaya</strong></td>
      </tr>
      <?php
	  $i=0;
      while ($data = mysqli_fetch_array($q)) {
	  $i++;
	  ?>
      <tr>
        <td align="center"><?php echo $i; ?></td>
        <td align="center"><?php echo $data['tgl_pengeluaran']; ?></td>
        <td><?php echo $data['kebutuhan']; ?></td>
       
        <td align="right"><span class="pull pull-left">Rp</span><?php echo number_format($data['biaya_pengeluaran'],2,',','.'); ?></td>
      </tr>
      <?php } ?>
      <tr>
        <td colspan="3" align="right" style="padding:10px"><strong>Total Price =</strong></td>
        <td align="right"><strong>
        <span class="pull pull-left">Rp</span><?php 
		$d=mysqli_fetch_array(mysqli_query($koneksi, "select sum(biaya_pengeluaran) as total_biaya from pengeluaran where tgl_pengeluaran between '".$_POST['tgl1']."' and '".$_POST['tgl2']."'"));
		echo number_format($d['total_biaya'],2,',','.');
		?></strong>
        </td>
      </tr>
      
    </table>
    <br><br>
<table width="100%">
  <tr>
    <td width="48%">&nbsp;</td>
    <td width="19%">&nbsp;</td>
    <td width="33%" valign="top"><strong>PT. Cipta Varia Kharisma Utama</strong><br>
      <img src="img/ttd.png" width="180" ><br>
      <strong><u>Banter Setyaki</u></strong><br>
D i r e c t o r<br>
<i>bs/rd</i></td>
  </tr>
</table>
    </body>
</html>
