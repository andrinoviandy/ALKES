<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");
 
//menampilkan data dari database, table tb_anggota
$sql = "select *, nota_debit.id as idd from nota_debet order by tanggal DESC, id DESC";
$result = mysqli_query($koneksi, $sql) or die("Error " . mysqli_error($koneksi));
$ArrAnggota = array();
//membuat array
while ($row = mysqli_fetch_assoc($result)) {
    $ArrAnggota[] = $row;
}
 
echo json_encode($ArrAnggota, JSON_PRETTY_PRINT);
 
//tutup koneksi ke database
mysqli_close($koneksi);
?>