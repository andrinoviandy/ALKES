<?php

$id=$_GET['id'];
require("config/koneksi.php");
$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,alat_uji_detail.id as idd,pembeli_id as id_rumkit from barang_teknisi,barang_teknisi_detail, barang_dikirim,barang_dikirim_detail, barang_dijual,barang_dijual_detail, barang_gudang, barang_gudang_detail,pembeli, tb_teknisi,alat_uji_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual_detail.barang_gudang_detail_id and barang_dijual.id=barang_dijual_detail.barang_dijual_id and barang_dijual_detail.id=barang_dikirim_detail.barang_dijual_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and tb_teknisi.id=barang_teknisi.teknisi_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and alat_uji_detail.id=$id"));
?>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
        <title>Cetak Surat Perintah Instalasi</title>
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
    <center><font size="+3" style="font-family:Arial, Helvetica, sans-serif"><b>SURAT PERINTAH INSTALASI</b></font></font></center><br>
    <table width="100%">
      <tr>
        <td width="59%" rowspan="3" valign="top"><b style="font-size:17px">PT. CIPTA VARIA KHARISMA UTAMA</b><br>Jl. Utan Kayu Raya No.105A<br>
        Utan Kayu Utara, Matraman<br>
        Jakarta Timur</td>
        <td width="5%" rowspan="3">&nbsp;</td>
        <td width="19%" height="38"><font>Delivery No.</font></td>
        <td width="17%" align="right"><?php echo $data['no_pengiriman']; ?></td>
      </tr>
      <tr>
        <td height="32"><font>Delivery Date</font></td>
        <td width="17%" align="right"><?php echo date("d M Y", strtotime($data['tgl_kirim'])); ?></td>
      </tr>
      <tr>
        <td height="33"><font>PO. No.</font></td>
        <td width="17%" align="right"><?php echo $data['po_no']; ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td valign="top">Paket   : Pengadaan Alat Kedokteran Umum</td>
        <td colspan="3" valign="top"><p><strong>Kepada Yth,</strong></p>
        <b><?php echo $data['nama_pembeli']; ?></b><br>
        <?php echo $data['jalan']." Kel.".$data['kelurahan_id']; ?><br>
        <?php echo "Kec.".ucwords(strtolower($data['nama_kecamatan'])).", Kab.".ucwords(strtolower($data['nama_kabupaten'])).", ".ucwords(strtolower($data['nama_provinsi'])); ?><br>
        UP : <?php echo $data['nama_pemakai']; ?><br>
        Telp : <?php echo $data['kontak']; ?></td>
      </tr>
    </table>
        <br>
<table width="100%" class="mytable">
  <tr>
    <td align="center"><strong>Item</strong></td>
    <td align="center"><strong>Item Description</strong></td>
    <td align="center"><strong>Qty</strong></td>
    <td align="center"><strong>Serial Number</strong></td>
  </tr>
  <tr>
    <td height="100%" align="center" valign="top" style="padding-bottom:30%"><p><?php echo $data['nama_brg']; ?></p></td>
    <td valign="top"><?php echo $data['deskripsi_alat']; ?></td>
    <td align="center" valign="top"><?php echo $data['qty']." pc"; ?></td>
    <td align="center" valign="top"><?php echo $data['nie_brg']; ?></td>
  </tr>
</table>
<br>
<table width="100%">
  <tr>
    <td width="18%"><p>Hormat Kami</p>
    <br><br>
    </td>
    <td width="17%">&nbsp;</td>
    <td width="25%">&nbsp;</td>
    <td width="16%" valign="top">&nbsp;</td>
    <td width="24%" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td><hr>Yan Herman</td>
    <td>&nbsp;</td>
    <td align="center"><hr>
      Wening Esti Utami</td>
    <td align="center">&nbsp;</td>
    <td align="center"><hr><?php echo $data['nama_teknisi']; ?></td>
  </tr>
</table>
<br>
1. Putih : Teknisi, 2. Merah : Teknisi, 3. Keuangan, 4. Hijau : Administrasi, 5. Biru : Copy Admin
    </body>
</html>
