<?php
//header("Content-type: application/vnd.ms-word");
require("config/koneksi.php");
$id=$_GET['id'];
$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_dikirim_set.id as id_kirim from barang_dikirim_set,barang_dikirim_set_detail, barang_dijual_set,pembeli,pemakai, alamat_provinsi,alamat_kabupaten,alamat_kecamatan where barang_dijual_set.id=barang_dikirim_set.barang_dijual_set_id and barang_dikirim_set.id=barang_dikirim_set_detail.barang_dikirim_set_id and pembeli.id=barang_dijual_set.pembeli_id and pemakai.id=barang_dijual_set.pemakai_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and barang_dikirim_set.id=$id"));
?>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
        <title>Cetak Surat Jalan</title>
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
    <center>
    <font size="+2" style="font-family:Arial, Helvetica, sans-serif"><b>SURAT JALAN</b></font>
    </center><br>
    <table width="100%">
      <tr>
        <td colspan="3" rowspan="4" valign="top" style="font-size:17px; font-family:Tahoma"><b>PT. CIPTA VARIA KHARISMA UTAMA<br>Jl. Utan Kayu Raya No.105A<br>
        Utan Kayu Utara, Matraman<br>
        Jakarta Timur</b></td>
        
      </tr>
      <tr>
        <td width="2%" rowspan="3">&nbsp;</td>
        <td width="15%" height="28" valign="top"><font>Delivery No.</font></td>
        <td width="2%" valign="top">:</td>
        <td width="24%" align="right" valign="top"><?php echo $data['no_pengiriman']; ?></td>
      </tr>
      <tr>
        <td height="24" valign="top"><font>Delivery Date</font></td>
        <td valign="top">:</td>
        <td width="24%" align="right" valign="top"><?php echo date("d M Y", strtotime($data['tgl_kirim'])); ?></td>
      </tr>
      <tr>
        <td height="24" valign="top"><font>PO. No.</font></td>
        <td valign="top">:</td>
        <td width="24%" align="right" valign="top"><?php echo $data['po_no']; ?></td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
        <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td width="9%" valign="top">Paket   : </td>
        <td width="33%" valign="top"><?php echo $data['nama_paket']; ?></td>
        <td width="15%" valign="top">&nbsp;</td>
        <td colspan="4" rowspan="2" valign="top"><strong>Kepada Yth,</strong><br>
        <b><?php echo $data['nama_pembeli']; ?></b><br>
        <?php echo $data['jalan']." Kel.".$data['kelurahan_id']; ?><br>
        <?php echo "Kec.".ucwords(strtolower($data['nama_kecamatan'])).", Kab.".ucwords(strtolower($data['nama_kabupaten'])).", ".ucwords(strtolower($data['nama_provinsi'])); ?><br>
        UP : <?php echo $data['nama_pemakai']; ?><br>
        Telp : <?php echo $data['kontak1_pemakai']." / ".$data['kontak2_pemakai']; ?></td>
      </tr>
      <tr>
        <td colspan="3" valign="bottom">Dengan hormat,<br> Mohon diterima barang - barang berikut ini :</td>
      </tr>
    </table>
        <br>
<table width="100%" class="mytable" style="font-size:13px">
  <tr>
    <td width="8%" align="center"><strong>No</strong></td>
    <td width="30%"><strong>Nama Set</strong></td>
    <td align="center"><strong>Detail Item</strong></td>
  </tr>
  <?php 
  $q=mysqli_query($koneksi, "select *,barang_dikirim_set.id as idd, barang_dijual_qty_set.id as id_q from barang_dikirim_set,barang_dijual_set,barang_dijual_qty_set,barang_gudang_set where barang_gudang_set.id=barang_dijual_qty_set.barang_gudang_set_id and barang_dijual_set.id=barang_dijual_qty_set.barang_dijual_set_id and barang_dijual_set.id=barang_dikirim_set.barang_dijual_set_id and barang_dikirim_set.id=".$_GET['id']." group by barang_dijual_qty_set.id order by nama_brg ASC");
  $no=0;
  while ($d = mysqli_fetch_array($q)) { 
  $no++;
  ?>
  <tr>
    <td align="center" valign="top"><?php echo $no; ?></td>
    <td height="100%" align="left" valign="top"><p><?php echo $d['nama_brg']; ?><br><?php echo "Jumlah : ".$d['qty_set']." Set"; ?></p></td>
    <td valign="top" style="padding:0px">
      <table width="100%" class="mytable" border="1" style="font-size:13px">
        <?php 
	$jm = mysqli_query($koneksi,"select * from barang_gudang,barang_dikirim_set,barang_dijual_set,barang_dijual_qty_set, barang_dijual_qty_set_detail where barang_dijual_qty_set.id = barang_dijual_qty_set_detail.barang_dijual_qty_set_id and barang_dijual_set.id=barang_dijual_qty_set.barang_dijual_set_id and barang_dijual_set.id=barang_dikirim_set.barang_dijual_set_id and barang_gudang.id=barang_dijual_qty_set_detail.barang_gudang_id and barang_dijual_qty_set.id = ".$d['id_q']." group by barang_dijual_qty_set_detail.id order by nama_brg ASC");
	while ($da = mysqli_fetch_array($jm)) {
	?>
        <tr>
          <td align="left"><?php echo $da['nama_brg'] ?></td>
          <td align="center" style="width: 50px;"><?php echo $da['qty_barang_gudang']*$d['qty_set']." pcs" ?></td>
        </tr>
        <?php
	}
	 ?>
      </table>
    </td>
  </tr>
  <?php } ?>
</table>
<br><br>
<table width="100%">
  <tr>
    <td width="31%">
    Tanggal dikirim : ..../..../<?php echo date("Y"); ?>
    <br>Yang Menyerahkan<br>
    <center><font size="-1">Tanda Tangan & Cap</font></center>
    <p>&nbsp;</p>
    <p>&nbsp;</p></td>
    <td width="36%">&nbsp;</td>
    <td width="33%" valign="top">
    Tanggal diterima : ..../..../<?php echo date("Y"); ?> 
    <br>Yang Menerima<br>
    <center><font size="-1">Tanda Tangan & Cap</font></center>
    </td>
  </tr>
  <tr>
    <td><hr></td>
    <td>&nbsp;</td>
    <td><hr></td>
  </tr>
</table>
<table width="100%">
  <tr>
    <td width="31%"></td>
    <td width="36%" align="center" valign="top"><p>Mengetahui<br>PJT</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p></td>
    <td width="33%" valign="top"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center"><hr></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center">Prasetyo Kristiadi</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br><br><br>
<div>
1. Putih : Setelah ttd mohon kembalikan ke PT. Cipta Varia Kharisma Utama, 2. Merah : Expedisi, 3. Kuning Instansi, 4. Hijau : Gudang, 5. Biru : Admin, 6. Copy : Keuangan
</div>
    </body>
</html>
<?php 
//header("Content-Disposition: attachment;Filename=Surat Jalan-".$data['nama_pembeli']."-".$data['nama_pemakai'].".doc");
?>