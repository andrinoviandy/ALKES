<?php 
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekapan Rencana Instalasi - ".date("d/m/Y", strtotime($_POST['tgl1']))." - ".date("d/m/Y", strtotime($_POST['tgl2'])).".xls");
?>
<?php require("config/koneksi.php"); ?>
<h2 align="center" style="margin-bottom:0px"><strong>PT. CIPTA VARIA KHARISMA UTAMA</strong></h2>
<center>
Rekapan  Rencana Instalasi 
<br />
Tanggal : <?php echo date("d/m/Y", strtotime($_POST['tgl1']))." - ".date("d/m/Y", strtotime($_POST['tgl2'])) ?>
</center>
<br />
<table width="100%" id="" border="1">
  <thead>
    <tr>
      <th valign="top">No</th>
        <th valign="top">Tanggal_SPI</th>
        <th valign="top">No SPI</th>
        <th valign="top">No Surat Jalan</th>
        <th valign="top">No PO</th>
        <th valign="top">Nama Barang</th>
        <th valign="top">Tipe</th>
        <th valign="top">No. Seri</th>
      <th valign="top"><strong>RS/Dinas/Puskesmas/Dll</strong></th>
      <th valign="top">Kontak </th>
      <th valign="top">Deskripsi</th>
      <!--<th valign="top"><strong>Teknisi</strong></th>-->      </tr>
  </thead>
  <?php
 
// membuka file JSON
$file = file_get_contents("http://localhost/ALKES/json/spk_masuk.php?tgl1=".$_POST['tgl1']."&tgl2=".$_POST['tgl2']."");
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
?>
  <tr>
    <td align="center" valign="top"><?php echo $i+1; ?></td>
    <td valign="top"><?php echo date("d/m/Y", strtotime($json[$i]['tgl_spk'])); ?>
    </td>
    <td valign="top"><?php echo $json[$i]['no_spk']; ?></td>
  	<td valign="top"><?php echo $json[$i]['no_pengiriman']; ?>
     </td>
    <td valign="top">
    <?php
	echo $json[$i]['no_po_jual'];
	?>
    </td>
    <td colspan="3" valign="top">
    <table border="1">
    <?php 
	  $q23=mysqli_query($koneksi, "select nama_brg,no_seri_brg,status_spi,status_kerusakan,status_batal,tipe_brg from barang_gudang,barang_gudang_detail,barang_dikirim_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_id=".$json[$i]['barang_dikirim_id']."");
	  $n2=0;
	  while ($d1=mysqli_fetch_array($q23)) {
	  $n2++;
	  ?>
      
      <tr>
      	<td valign="top"><?php echo $d1['nama_brg'] ?></td>
        <td valign="top"><?php echo $d1['tipe_brg'] ?></td>
        <td valign="top" align="right"><?php echo $d1['no_seri_brg'] ?></td>
      </tr>
      
      <?php } ?>
      </table>
    </td>
    
    <td valign="top"><?php 
	echo $json[$i]['nama_pembeli']; ?>
      <!--<a href="index.php?page=spk_masuk&id_spk=<?php //echo $data['idd']; ?>#open_detail"><span data-toggle="tooltip" title="Detail Rumah Sakit/Dinas/Puskemas/Klinik" class="fa fa-eye pull pull-left"></span></a>-->
    </td>
    <td valign="top"><?php echo $json[$i]['kontak_rs']; ?></td>
    <td align="center" valign="top"><?php 
	echo $json[$i]['keterangan_spk']; ?></td>
    </tr>
  <?php } ?>
</table>