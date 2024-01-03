<?php
//header("Content-type: application/vnd.ms-word");

$id=$_GET['id'];
require("config/koneksi.php");
$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_pesan_akse.id as idd from barang_pesan_akse,principle,mata_uang where principle.id=barang_pesan_akse.principle_id and mata_uang.id=barang_pesan_akse.mata_uang_id and barang_pesan_akse.id=$id"));
?>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
        <title>Cetak PO</title>
        <style>
         .mytable{
                border:1px solid black; 
                border-collapse: collapse;
                width: 100%;
            }
            .mytable tr th, .mytable tr td{
                border:1px solid black; 
                padding: 3px 4px;
            }
        </style>
        <link href='logo.png' rel='icon'>
    </head>
    <body onLoad="window.print();" >
    <center>
    <font size="+2" style="font-family:Arial, Helvetica, sans-serif"><b>PESANAN BARANG</b></font>
    </center><br>
    <table width="100%">
      <tr>
        <td width="56%" rowspan="3" valign="top"><b style="font-size:17px">PT. CIPTA VARIA KHARISMA UTAMA</b><br>          Jl. Utan Kayu  No.105A<br>
        Jakarta 13120 - INDONESIA<br>
        Telp : +62.21.8511 303</td>
        
      </tr>
      <tr>
        <td width="3%" rowspan="2">&nbsp;</td>
        <td width="13%" height="21" valign="top"><font>Nomor</font></td>
        <td width="28%" valign="top"><?php echo " :  ".$data['no_po_pesan']; ?></td>
      </tr>
      <tr>
        <td valign="top"><font>Tanggal</font></td>
        <td width="28%" valign="top"><?php echo " :  ".date("d M Y", strtotime($data['tgl_po_pesan'])); ?></td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td colspan="3" valign="top" style="font-size:13px">Kepada Yth,<br>
        <b><?php echo $data['nama_principle']; ?></b><br>
        <?php echo $data['alamat_principle']; ?><br>
        <?php echo "Telp. : ".$data['telp_principle']; ?><br><?php echo "Fax. : ".$data['fax_principle']; ?>
        </td>
      </tr>
    </table>
        <font style="font-size:13px">Dengan hormat,<br>
        Bersama ini kami sampaikan <em><strong>Pesanan Barang</strong></em>, sebagai berikut :</font>
        <br><br>
<table width="100%" class="mytable" style="padding-left:15px; font-size:13px">
  <tr>
    <td width="7%" align="center"><strong>No</strong></td>
    <td width="50%" align="center"><strong>Nama Barang</strong></td>
    <td width="13%" align="center"><strong>Type/Merk</strong></td>
    <td width="16%" align="center"><strong>Jml</strong></td>
    <td width="14%" align="center"><strong>Satuan Harga (Rp.)</strong></td>
    <td width="11%" align="center"><strong style="">Diskon</strong></td>
    <td width="13%" align="center"><strong>Total Harga (Rp.)</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php 
  $q = mysqli_query($koneksi, "select * from barang_pesan_akse_detail where barang_pesan_akse_id=$id");
  $n=0;
  $total_akse2=0;
  while ($d = mysqli_fetch_array($q)) {
  $n++;
  ?>
  <tr>
    <td align="center"><strong><?php echo $n; ?></strong></td>
    <td><strong>
      <?php 
	$brg = mysqli_fetch_array(mysqli_query($koneksi, "select * from aksesoris where id=".$d['aksesoris_id'].""));
	echo $brg['nama_akse']; ?>
      
    </strong></td>
    <td align="center"><strong><?php echo $brg['tipe_akse']; ?></strong></td>
    <td align="center"><strong><?php echo $d['qty']." Units"; ?></strong></td>
    <td align="center"><strong>
      <?php 
	$mata_uang = mysqli_fetch_array(mysqli_query($koneksi, "select * from mata_uang where id=".$d['mata_uang_id'].""));
	echo $mata_uang['simbol']."".number_format($d['harga_perunit'],2,',','.'); ?>
    </strong></td>
    <td align="center"><?php if ($d['diskon']!=0) { ?>
    <strong style="font-size:11px"><?php echo $d['diskon']." %"; ?></strong>
    <?php } else { echo "-";} ?></td>
    <td align="center"><strong><?php echo $mata_uang['simbol']."".number_format($d['harga_total'],2,',','.'); ?></strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    
  <?php } ?>
  <tr>
    <td colspan="6" align="right"><strong>Sub Total =</strong></td>
    <td align="right">
      <strong>
        <?php 
		//$total_akse = mysqli_fetch_array(mysqli_query($koneksi, "select sum(harga_akse*aksesoris_alkes.qty) as total_akse from aksesoris_alkes,aksesoris,barang_pesan,barang_pesan_detail,barang_gudang where aksesoris.id=aksesoris_alkes.aksesoris_id and barang_gudang.id=aksesoris_alkes.barang_gudang_id and barang_gudang.id=barang_pesan_detail.barang_gudang_id and barang_pesan.id=barang_pesan_detail.barang_pesan_id and barang_pesan.id=$id"));
		//$total = mysqli_fetch_array(mysqli_query($koneksi, "select sum(harga_total) as total from barang_pesan_detail where barang_pesan_id=$id"));
		//$total = mysqli_query($koneksi, "select * from barang_pesan_detail where barang_pesan_id=$id");
		//echo " ".number_format($total_akse2+$total['total'],0,',',',').".00";
		//echo $data['simbol']." ".number_format($total['total'],0,',',',').".00";
		//while ($d_hitung = mysqli_fetch_array($total)) {
			//$s = mysqli_query($koneksi, "select * from mata_uang where ");
			//}
			echo $data['simbol']."".number_format($data['total_price'],2,',','.');
	 ?>
      </strong></td>
  </tr>
  <tr>
    <td colspan="6" align="right"><strong> PPN <?php echo $data['ppn']."%"; ?> =</strong></td>
    <td align="right"><strong><?php 
	echo $data['simbol']."".number_format($data['total_price']*$data['ppn']/100,2,',','.');
	//echo "€ ".number_format(($total_akse2+$total['total'])-(($total_akse2+$total['total'])*$data['ppn']/100),0,',',',').".00"; ?></strong></td>
  </tr>
  <tr>
    <td colspan="6" align="right"><strong>Ongkos Kirim =</strong></td>
    <td align="right"><strong><?php echo $data['simbol']."".number_format($data['cost_byair'],2,',','.'); ?></strong></td>
  </tr>
  <tr>
    <td colspan="6" align="right"><strong>Total =</strong></td>
    <td align="right"><strong><?php echo $data['simbol']."".number_format($data['cost_cf'],2,',','.'); ?></strong></td>
  </tr>
  </table>
  <br>
<table style="font-size:13px">
  <tr>
      <td colspan="4" valign="top">
Syarat-syarat :</td>
    </tr>
    <tr>
      <td valign="top">1&nbsp;&nbsp;</td>
      <td valign="top">Harga</td>
      <td valign="top">:</td>
      <td valign="top">Frandko Gudang Kharisma, sudah termasuk PPn 10%</td>
    </tr>
    <tr>
      <td valign="top">2&nbsp;&nbsp;</td>
      <td valign="top">Pembayaran</td>
      <td valign="top">:</td>
      <td valign="top">Sesuai Perjanjian</td>
    </tr>
    <tr>
      <td valign="top">3&nbsp;&nbsp;</td>
      <td valign="top">Faktur</td>
      <td valign="top">:</td>
      <td valign="top"><strong>PT. CIPTA VARIA KHARISMA UTAMA<br>
      Jl. Utan Kayu Raya No. 105A, Utan Kayu Utara<br>
      Matraman - Jakarta Timur 13120</strong></td>
    </tr>
    <tr>
      <td valign="top">4&nbsp;&nbsp;</td>
      <td valign="top">NPWP</td>
      <td valign="top">:</td>
      <td valign="top">01.321.289.9.007.000</td>
    </tr>
  </table>
  <font style="font-size:13px">Demikian surat pesanan ini kami sampaikan, atas perhatian dan kerjasamanya, kami ucapkan terima kasih.<br></font><br>
<table width="100%" style="font-size:13px">
      <tr>
        <td width="53%">
          Hormat kami<br>
          <strong>PT. Cipta Varia Kharisma Utama</strong><br>
          <img src="img/ttd.png" alt="" width="180" ><br>
          <strong><u>Banter Setyaki</u></strong><br>
          D i r e c t o r<br>
          <i><strong>af/bs</strong></i><br>
          <i><strong style="font-size:14px">Node : Mohon setelah tanda tangan di Email kembali</strong></i></td>
        <td width="2%">&nbsp;</td>
        <td width="45%" valign="top">Disetujui Oleh,<br>
          <strong><?php echo $data['nama_principle']; ?></strong>,<br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
        -------------------------</td>
      </tr>
    </table>
<br><br>
<div style="position:absolute; font-size:13px">1. Putih : Supplier, 2. Merah : Keuangan, 3. Kuning : Administrasi I, 4. Hijau : Administrasi II, 5. Biru : Gudang</div>
</body>
</html>
<?php 
//header("Content-Disposition: attachment;Filename=Surat Jalan-".$data['nama_pembeli']."-".$data['nama_pemakai'].".doc");
?>