<?php
function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " Belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " Milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " Trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil;
	}
?>
<?php

$id=$_GET['id'];
require("config/koneksi.php");
$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,kasbon_perjalanan_dinas.id as idd from kasbon_perjalanan_dinas, kasbon_perjalanan_dinas_detail,barang_teknisi,barang_teknisi_detail,barang_dikirim_detail,barang_dikirim,barang_dijual,tb_teknisi,pembeli where kasbon_perjalanan_dinas.id=kasbon_perjalanan_dinas_detail.kasbon_perjalanan_dinas_id and barang_teknisi.id=kasbon_perjalanan_dinas_detail.barang_teknisi_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dijual.id=barang_dikirim.barang_dijual_id and tb_teknisi.id=kasbon_perjalanan_dinas_detail.teknisi_id and pembeli.id=barang_dijual.pembeli_id and kasbon_perjalanan_dinas.id=".$_GET['id']." group by kasbon_perjalanan_dinas.id order by kasbon_perjalanan_dinas_detail.id ASC"));
?>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
        <title>Cetak Faktur Penjualan</title>
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
    <body onLoad="window.print();" style="font-family:Arial">
    
    <table width="100%">
      <tr>
        <td width="22%" valign="top"><img src="img/kop5.png" width="350" ></td>
        <td width="78%" align="center" valign="bottom">
        <table style="font-size:12px">
          <tr>
            <td>Tanggal Kasbon</td>
            <td>:</td>
            <td><?php echo date("d F Y", strtotime($data['tgl_kasbon'])) ?></td>
          </tr>
          <tr>
            <td>Nomor Kasbon</td>
            <td>:</td>
            <td><?php echo $data['no_kasbon'] ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2"><hr style="height:2px; background-color:#000; color:#000"/></td>
      </tr>
    </table>
        <br>
        <table width="100%" style="font-size:12px">
  <tr>
    <td width="16%" align="left" valign="top">&nbsp;</td>
    <td width="48%" align="left" valign="top">&nbsp;</td>
    <td width="3%" align="left" valign="top">&nbsp;</td>
    <td width="33%" align="right" valign="top"><strong>Jakarta, <?php echo " ".date("d F Y",strtotime($data['tgl_kasbon'])); ?></strong></td>
  </tr>
</table>

        <br>
    <table width="100%" class="mytable" style="font-size:11px">
  <tr>
    <td align="center"><strong>No.</strong></td>
    <td align="center"><strong>Tanggal SPI</strong></td>
    <td align="center"><strong>Nomor SPI</strong></td>
    
    <td align="center"><strong>No PO</strong></td>
    <td align="center"><strong>Sales</strong></td>
    <td align="center"><strong>Lokasi Instalasi</strong></td>
    <td align="center"><strong>Teknisi</strong></td>
    <td align="center"><strong>Estimasi Berangkat</strong></td>
    <td align="center"><strong>Tanggal Berangkat</strong></td>
    <td align="center"><strong>Deskripsi</strong></td>
  </tr>
  <?php 
  $q = mysqli_query($koneksi, "select *,kasbon_perjalanan_dinas.id as idd from kasbon_perjalanan_dinas, kasbon_perjalanan_dinas_detail,barang_teknisi,barang_teknisi_detail,barang_dikirim_detail,barang_dikirim,barang_dijual,tb_teknisi,pembeli where kasbon_perjalanan_dinas.id=kasbon_perjalanan_dinas_detail.kasbon_perjalanan_dinas_id and barang_teknisi.id=kasbon_perjalanan_dinas_detail.barang_teknisi_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dijual.id=barang_dikirim.barang_dijual_id and tb_teknisi.id=kasbon_perjalanan_dinas_detail.teknisi_id and pembeli.id=barang_dijual.pembeli_id and kasbon_perjalanan_dinas.id=".$_GET['id']." group by kasbon_perjalanan_dinas_detail.id order by kasbon_perjalanan_dinas_detail.id ASC"); 
  $no=0;
  while ($d = mysqli_fetch_array($q)) {
  $no++;
  ?>
  <tr>
    <td align="center" valign="top"><?php echo $no; ?></td>
    <td valign="top"><?php echo date("d/m/Y",strtotime($d['tgl_spk'])); ?></td>
    <td valign="top"><?php echo $d['no_spk']; ?></td>
    
    <td valign="top"><?php echo $d['no_po_jual']; ?></td>
    <td valign="top"><?php echo $d['marketing']; ?></td>
    <td valign="top"><?php echo $d['nama_pembeli']; ?></td>
    <td valign="top"><?php echo $d['nama_teknisi']; ?></td>
    <td valign="top"><?php echo date("d/m/Y",strtotime($d['estimasi'])); ?></td>
    <td valign="top"><?php echo date("d/m/Y",strtotime($d['tgl_berangkat_teknisi'])); ?></td>
    <td valign="top"><?php echo $d['deskripsi']; ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="10" align="center" valign="top" style="padding:10px"><strong>Nilai Kasbon : </strong><strong><?php echo "Rp".number_format($data['nilai_kasbon'],0,',','.'); 
	?></strong></td>
    </tr>
  <tr>
    <td colspan="10" valign="top" style="padding:20px; font-size:12"><strong><em><font>Terbilang : <?php echo terbilang($data['nilai_kasbon'])." Rupiah"; ?></font></em></strong></td>
    </tr>
</table>
<br><br>
<table width="100%">
  <tr>
    <td align="center">Admin</td>
    <td align="center" >Kepala Teknisi</td>
    <td align="center" >Manajemen</td>
    <td align="center" >Keuangan</td>
  </tr>
  <tr>
    <td align="center" height="100px">&nbsp;</td>
    <td align="center" >&nbsp;</td>
    <td align="center" >&nbsp;</td>
    <td align="center" >&nbsp;</td>
  </tr>
  <tr>
    <td width="25%" align="center" >.................................<hr width="60%"></td>
    <td width="25%" align="center" >.................................<hr width="60%"></td>
    <td width="25%" align="center" >.................................<hr width="60%"></td>
    <td width="25%" align="center" >.................................<hr width="60%"></td>
  </tr>
  </table>
    </body>
</html>
