<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");
 
//menampilkan data dari database, table tb_anggota

$sql = "select *,barang_dikirim.id as idd,riwayat_panggilan.id as id_riwayat from riwayat_panggilan,barang_dikirim where barang_dikirim.id=riwayat_panggilan.barang_dikirim_id order by tgl_riwayat DESC";

$result = mysqli_query($koneksi, $sql) or die("Error " . mysqli_error($koneksi));
 
//membuat array
while ($row = mysqli_fetch_assoc($result)) {
    $ArrAnggota[] = $row;
}
 
echo json_encode($ArrAnggota, JSON_PRETTY_PRINT);
 
//tutup koneksi ke database
mysqli_close($koneksi);
?>