<?php
//header("Content-type: application/vnd.ms-word");

$id=$_GET['id'];
require("config/koneksi.php");
$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_kembali.id as idd from barang_kembali where id=".$_GET['id'].""));
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
    <center><b><font size="+2" style="font-family:Arial, Helvetica, sans-serif">SURAT JALAN</font></b></center><br>
    <table width="100%">
      <tr>
        <td width="53%" rowspan="3" valign="top"><b style="font-size:17px; font-family:Tahoma, Geneva, sans-serif">PT. CIPTA VARIA KHARISMA UTAMA<br>Jl. Utan Kayu Raya No.105A<br>
        Jakarta 13120 - INDONESIA<br>
        Telp &nbsp;&nbsp;&nbsp; +62 21 8511 303</b></td>
        <td width="3%" rowspan="3">&nbsp;</td>
        <td width="19%" height="21"><font>Nomor</font></td>
        <td width="25%" align="right"><?php echo $data['no_retur']; ?></td>
      </tr>
      <tr>
        <td height="21"><font>Tanggal</font></td>
        <td width="25%" align="right"><?php echo date("d M Y", strtotime($data['tgl_retur'])); ?></td>
      </tr>
      <tr>
        <td height="21"><font>No. PO/ID</font></td>
        <td width="25%" align="right"><?php echo $data['no_po_id']; ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td valign="top"></td>
        <td colspan="3" valign="top" style="font-size:14px">
        <?php 
		$p = mysqli_fetch_array(mysqli_query($koneksi, "select * from pembeli,barang_dijual,barang_dikirim,barang_dikirim_detail,barang_kembali,barang_kembali_detail,alamat_provinsi,alamat_kabupaten,alamat_kecamatan,pemakai where pembeli.id=barang_dijual.pembeli_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_kembali.barang_dikirim_id and barang_kembali.id=barang_kembali_detail.barang_kembali_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and pemakai.id=barang_dijual.pemakai_id and barang_kembali.id=".$data['idd'].""));
		?>
        <strong>Kepada Yth,</strong><br>
        <b><?php echo $p['nama_pembeli']; ?></b><br>
        <?php echo $p['jalan']." Kel.".$p['kelurahan_id']; ?><br>
        <?php echo "Kec.".ucwords(strtolower($p['nama_kecamatan'])).", Kab.".ucwords(strtolower($p['nama_kabupaten'])).", ".ucwords(strtolower($p['nama_provinsi'])); ?><br>
        UP : <?php echo $p['nama_pemakai']; ?><br>
        Telp : <?php echo $p['kontak1_pemakai']." / ".$p['kontak2_pemakai']; ?></td>
      </tr>
    </table>
        <br>
<table width="100%" class="mytable" style="border-style:dotted">
  <tr>
    <td align="center"><strong>No.</strong></td>
    <td align="center"><strong>Nama Barang</strong></td>
    <td align="center"><strong>Type</strong></td>
    <td align="center"><strong>Merk</strong></td>
    <td align="center"><strong>Jml</strong></td>
  </tr>
  <?php 
  $b = mysqli_query($koneksi, "select * from barang_kembali_detail where barang_kembali_id=".$data['idd']."");
  $n=0;
  while ($data_b = mysqli_fetch_array($b)) {
  $n++;
  ?>
  <tr>
    <td align="center" valign="top"><strong><?php echo $n; ?></strong></td>
    <td align="center" valign="top"><strong><?php
	$data_brg = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_kembali_detail,barang_gudang_detail,barang_gudang where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_kembali_detail.barang_gudang_detail_id and barang_kembali_detail.id=".$data_b['id'].""));
	 echo $data_brg['nama_brg']; ?></strong>
      <hr>
    <strong>    SN : <?php 
	if ($data_brg['no_seri_brg']!="") {
	echo $data_brg['no_seri_brg']; }
	else {
		echo $data_brg['nama_set'];
		}?></strong></td>
    <td align="center" valign="top"><strong><?php echo $data_brg['tipe_brg']; ?></strong></td>
    <td align="center" valign="top"><strong><?php echo $data_brg['merk_brg']; ?></strong></td>
    <td align="center" valign="top"><strong><?php echo "1 unit"; ?></strong></td>
  </tr>
  <?php } ?>
</table>
<p style="font-family:Arial, Helvetica, sans-serif; font-size:14px"><b>Keterangan : Dengan ini kami ingin menarik barang tersebut karena rusak dan kami akan menggantinya dengan barang yang baru</b></p><br>
<table width="100%">
  <tr>
    <td width="33%"><p>Yang menyerahkan,</p>
    <br><br><br><br>
    </td>
    <td width="34%">&nbsp;</td>
    <td width="33%" valign="top">Yang menerima,</td>
  </tr>
  <tr>
    <td>...............................</td>
    <td>&nbsp;</td>
    <td>...............................</td>
  </tr>
</table>
<div style="position:absolute; bottom:0px">
1. Putih : Setelah ttd mohon kembalikan ke PT. Cipta Varia Kharisma Utama, 2. Merah : Expedisi, 3. Kuning Instansi, 4. Hijau : Gudang, 5. Biru : Admin, 6. Copy : Keuangan
</div>
</body>
</html>
<?php 
//header("Content-Disposition: attachment;Filename=Surat Retur Pengembalian/".$data['no_retur']."/".$data['no_po_id'].".doc");
?>