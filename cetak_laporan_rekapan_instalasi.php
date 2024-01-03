<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekapan Instalasi & Uji Fungsi - " . date("d/m/Y", strtotime($_POST['tgl1'])) . " - " . date("d/m/Y", strtotime($_POST['tgl2'])) . ".xls");
?>
<?php require("config/koneksi.php"); ?>
<h2 align="center" style="margin-bottom:0px"><strong>PT. CIPTA VARIA KHARISMA UTAMA</strong></h2>
<center>
  Rekapan Instalasi & Uji Fungsi
  <br />
  Tanggal Instalasi: <?php echo date("d/m/Y", strtotime($_POST['tgl1'])) . " - " . date("d/m/Y", strtotime($_POST['tgl2'])) ?>
</center>
<br />
<table width="100%" border="1">
  <thead>
    <tr>
      <th valign="bottom" bgcolor="#CCCCCC">Tgl Instalasi</th>
      <th valign="bottom" bgcolor="#CCCCCC">Tgl Uji Fungsi</th>
      <th valign="bottom" bgcolor="#CCCCCC">No SPI</th>
      <th valign="bottom" bgcolor="#CCCCCC"><strong>Tgl SPI</strong></th>
      <th valign="bottom" bgcolor="#CCCCCC">Nama Alkes</th>
      <th valign="bottom" bgcolor="#CCCCCC">No Seri</th>
      <th valign="bottom" bgcolor="#CCCCCC">Software Vers.</th>
      <th valign="bottom" bgcolor="#CCCCCC">Tgl Garansi Habis</th>
      <th valign="bottom" bgcolor="#CCCCCC"><strong>Teknisi</strong></th>
      <th valign="bottom" bgcolor="#CCCCCC">Kontak Teknisi</th>
      <th valign="bottom" bgcolor="#CCCCCC">Keterangan</th>
    </tr>
  </thead>
  <?php

  // membuka file JSON
  $file = file_get_contents("http://localhost/ALKES/json/ubah_uji.php?tgl1=" . $_POST['tgl1'] . "&tgl2=" . $_POST['tgl2'] . "");
  $json = json_decode($file, true);
  $jml = count($json);
  for ($i = 0; $i < $jml; $i++) {
    //echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
    //echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
  ?>
    <tr>
      <td><?php echo date("d/m/Y", strtotime($json[$i]['tgl_i'])); ?></td>
      <td><?php echo date("d/m/Y", strtotime($json[$i]['tgl_f'])); ?></td>
      <td><?php echo $json[$i]['no_spk']; ?></td>
      <td <?php if ($json[$i]['status_batal'] == 1) {
            echo "bgcolor='red'";
          } ?>><?php echo date("d/m/Y", strtotime($json[$i]['tgl_spk'])); ?></td>
      <td <?php if ($json[$i]['status_batal'] == 1) {
            echo "bgcolor='red'";
          } ?>><?php echo $json[$i]['nama_brg']; ?></td>
      <td><?php echo $json[$i]['no_seri_brg']; ?></td>
      <td><?php echo $json[$i]['soft_version']; ?></td>
      <td><?php echo date("d/m/Y", strtotime($json[$i]['tgl_garansi_habis'])); ?></td>
      <td><?php echo $json[$i]['nama_teknisi']; ?></td>
      <td><?php echo $json[$i]['no_hp']; ?></td>
      <td><?php echo $json[$i]['keterangan']; ?></td>
    </tr>
  <?php } ?>
</table>