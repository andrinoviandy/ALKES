<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");

// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=Contoh Template.xls");
 
// Tambahkan table
?>
<table border="1">
  <tr>
    <td bgcolor="#CCCCCC"><strong>Nama Barang</strong></td>
    <td bgcolor="#CCCCCC"><strong>Tipe Barang</strong></td>
    <td bgcolor="#CCCCCC"><strong>Merk Barang</strong></td>
    <td bgcolor="#CCCCCC"><strong>NIE Barang</strong></td>
    <td bgcolor="#CCCCCC"><strong>No Bath</strong></td>
    <td bgcolor="#CCCCCC"><strong>No Lot</strong></td>	
    <td bgcolor="#CCCCCC"><strong>Negara Asal</strong></td>
    <td bgcolor="#CCCCCC"><strong>Stok</strong></td>
    <td bgcolor="#CCCCCC"><strong>Deskripsi Alat</strong></td>
    <td bgcolor="#CCCCCC"><strong>Harga Satuan</strong></td>
    <td bgcolor="#CCCCCC"><strong>Status Cek (1=Sudah Di Cek, 2=Belum Di Cek)</strong></td>
  </tr>
</table>
