<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");
 
//menampilkan data dari database, table tb_anggota
$sql = "select *,barang_pesan_inventory.id as idd from barang_pesan_inventory,mata_uang,principle where mata_uang.id=barang_pesan_inventory.mata_uang_id and principle.id=barang_pesan_inventory.principle_id order by tgl_po_pesan DESC, barang_pesan_inventory.id DESC";
$result = mysqli_query($koneksi, $sql) or die("Error " . mysqli_error($koneksi));
 
//membuat array
while ($row = mysqli_fetch_assoc($result)) {
    $ArrAnggota[] = $row;
}
 
echo json_encode($ArrAnggota, JSON_PRETTY_PRINT);
 
//tutup koneksi ke database
mysqli_close($koneksi);
?>