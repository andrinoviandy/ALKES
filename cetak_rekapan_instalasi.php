<?php require("config/koneksi.php"); ?>
<?php
// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excell

$tgl1=$_GET['tgl1'];
$tgl2=$_GET['tgl2'];
$t1=date("d F Y",strtotime($tgl1));
$t2=date("d F Y",strtotime($tgl2));
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekapan Instalasi (Merk : $_GET[merk]) / $t1 to $t2.xls");
?>

<div class="table-responsive">
  <table width="" id="" class="table table-bordered table-hover" border="1">
  <thead>
    <tr>
      <th valign="bottom" bgcolor="#CCCCCC">Name of Goods</th>
      <th valign="bottom" bgcolor="#CCCCCC">Type</th>
      <th valign="bottom" bgcolor="#CCCCCC">Brand</th>
      <th valign="bottom" bgcolor="#CCCCCC"><strong>Country</strong></th>
      </tr>
  </thead>
  <?php
  $q = mysqli_query($koneksi, "select * from barang_gudang where merk_brg='".$_GET['merk']."'");
  while ($sel = mysqli_fetch_array($q)) {
  ?>
  <tr>
    <td><?php 
	echo $sel['nama_brg']; ?></td>
    <td><?php echo $sel['tipe_brg']; ?></td>
    <td><?php echo $sel['merk_brg']; ?></td>
    <td><?php echo $sel['negara_asal']; ?></td>
    </tr>
    <?php } ?>
</table>
</div>
                <br />
                <h3 align="center">Installation Data</h3>
                Filter From <?php echo $t1." - ".$t2; ?>
                <div class="table-responsive">
                  <table width="" id="example1" class="table table-bordered table-hover" border="1">
                  <thead>
                    <tr>
                      <th valign="bottom" bgcolor="#CCCCCC"><strong>No</strong></th>
                      <th valign="bottom" bgcolor="#CCCCCC"><strong>SPI Date</strong></th>
                      <th valign="bottom" bgcolor="#CCCCCC"> <p>SPI Number</p></th>
                      <th valign="bottom" bgcolor="#CCCCCC">Name of Goods</th>
                      <th valign="bottom" bgcolor="#CCCCCC">Type</th>
                      <th valign="bottom" bgcolor="#CCCCCC">Serial Number</th>
                      <th valign="bottom" bgcolor="#CCCCCC">Software Vers.</th>
                      <th valign="bottom" bgcolor="#CCCCCC">Warranty Date</th>
                      <th valign="bottom" bgcolor="#CCCCCC">Installation Date</th>
                      <th valign="bottom" bgcolor="#CCCCCC">Function Test Date</th>
                      <th valign="bottom" bgcolor="#CCCCCC"><strong>Technician</strong></th>
                      <th valign="bottom" bgcolor="#CCCCCC"><strong>Technician Contact</strong></th>
                      <th valign="bottom" bgcolor="#CCCCCC">Description</th>
                      <th valign="bottom" bgcolor="#CCCCCC">Service Name</th>
                      <th valign="bottom" bgcolor="#CCCCCC">Service Address</th>
                      <th valign="bottom" bgcolor="#CCCCCC">Service Contact</th>
                      </tr>
                  </thead>
                 <?php
 
// membuka file JSON
	$file = file_get_contents("http://localhost/ALKES/json/cetak_rekapan_instalasi.php?merk=".str_replace(" ","%20",$_GET['merk'])."&tgl1=$_GET[tgl1]&tgl2=$_GET[tgl2]");
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
?>
                  <tr>
                    <td align="center" valign="top"><?php echo $i+1; ?></td>
                    <td align="center" valign="top"><?php echo date("d/m/Y",strtotime($json[$i]['tgl_spk'])); ?></td>
                    <td align="center" valign="top"><?php echo $json[$i]['no_spk']; ?></td>
                    <td align="center" valign="top"><?php echo $json[$i]['nama_brg']; ?></td>
                    <td align="center" valign="top"><?php echo $json[$i]['tipe_brg']; ?></td>
                    <td align="center" valign="top"><?php echo $json[$i]['no_seri_brg']; ?></td>
                    <td align="center" valign="top"><?php
					$q3 = mysqli_query($koneksi, "select *,alat_uji_detail.id as idd from alat_uji_detail where barang_teknisi_detail_id=".$json[$i]['idd']."");
					$jm3 = mysqli_num_rows($q3);
					$d3 = mysqli_fetch_array($q3);
					if ($jm3!=0) {
					echo $d3['soft_version'];
					} ?></td>
                    <td align="center" valign="top"><?php
					if ($jm3!=0) { 
					if ($d3['tgl_garansi_habis']!=0000-00-00) {
					echo date("d/m/Y",strtotime($d3['tgl_garansi_habis']));
					}} ?></td>
                    <td align="center" valign="top"><?php
					if ($jm3!=0) { 
					if ($d3['tgl_i']!=0000-00-00) {
					echo date("d/m/Y",strtotime($d3['tgl_i']));}
					}?></td>
                    <td align="center" valign="top"><?php
					if ($jm3!=0) {
                    if ($d3['tgl_f']!=0000-00-00) {
					echo date("d/m/Y",strtotime($d3['tgl_f']));
					}} ?></td>
                    <td align="center" valign="top"><?php
                    $q4 = mysqli_query($koneksi, "select *,barang_teknisi_detail_teknisi.id as idd from barang_teknisi_detail_teknisi,tb_teknisi where tb_teknisi.id=barang_teknisi_detail_teknisi.teknisi_id and barang_teknisi_detail_id=".$json[$i]['idd']."");
					$jm4 = mysqli_num_rows($q4);
					$d4 = mysqli_fetch_array($q4);
					if ($jm4!=0) {
					echo $d4['nama_teknisi']; } ?></td>
                    <td align="center" valign="top"><?php
					if ($jm4!=0) {
					 echo $d4['no_hp']; } ?></td>
                    <td align="center" valign="top"><?php
                    if ($jm4!=0) {
					echo $d3['keterangan']; } ?></td>
                    <td align="center" valign="top"><?php echo $json[$i]['nama_pembeli']; ?></td>
                    <td align="center" valign="top"><?php echo $json[$i]['jalan']; ?></td>
                    <td align="center" valign="top"><?php echo $json[$i]['kontak_rs']; ?></td>
                    </tr>
                  
                  <?php } ?>
                </table>
              </div>