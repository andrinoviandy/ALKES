<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");
 
//menampilkan data dari database, table tb_anggota
if (isset($_GET['id'])) {
$sql = "select *,barang_dikirim_inventory.id as idd from barang_dikirim_inventory where barang_dijual_inventory_id=".$_GET['id']." order by barang_dikirim_inventory.tgl_kirim DESC, barang_dikirim_inventory.id DESC";
}
else if (isset($_GET['id_riwayat'])) {
$sql = "select *,barang_dikirim_inventory.id as idd from barang_dikirim_inventory where id=".$_GET['id_riwayat']."";
}
else {
$sql = "select *,barang_dikirim_inventory.id as idd from barang_dikirim_inventory order by barang_dikirim_inventory.tgl_kirim DESC, barang_dikirim_inventory.id DESC";
}
$result = mysqli_query($koneksi, $sql) or die("Error " . mysqli_error($koneksi));
 
//membuat array
while ($row = mysqli_fetch_assoc($result)) {
    $ArrAnggota[] = $row;
}
 
echo json_encode($ArrAnggota, JSON_PRETTY_PRINT);
 
//tutup koneksi ke database
mysqli_close($koneksi);
?>