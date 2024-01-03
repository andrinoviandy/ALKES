<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");
 
//menampilkan data dari database, table tb_anggota
if (isset($_GET['id'])) {
$sql = "select *,barang_dikirim_set.id as idd from barang_dikirim_set where barang_dijual_set_id=".$_GET['id']." order by barang_dikirim_set.tgl_kirim DESC,barang_dikirim_set.id DESC";
}
else if (isset($_GET['id_riwayat'])) {
$sql = "select *,barang_dikirim_set.id as idd from barang_dikirim_set where id=".$_GET['id_riwayat']."";
}
else {
$sql = "select *,barang_dikirim_set.id as idd from barang_dikirim_set order by barang_dikirim_set.tgl_kirim DESC,barang_dikirim_set.id DESC";
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