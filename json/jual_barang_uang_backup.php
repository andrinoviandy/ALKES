<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");
 
//menampilkan data dari database, table tb_anggota
if (isset($_GET['id_keuangan'])) {
$sql = "select *,barang_dijual.id as idd from barang_dijual where keuangan_id=$_GET[id_keuangan] order by tgl_jual DESC, barang_dijual.id DESC";
} else {
$sql = "select *,barang_dijual.id as idd from barang_dijual order by tgl_jual DESC, barang_dijual.id DESC";
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