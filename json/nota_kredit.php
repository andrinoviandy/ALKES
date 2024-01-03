<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");
 
//menampilkan data dari database, table tb_anggota
$sql = "select *, nota_kredit.id as idd from nota_kredit join pelanggan on nota_kredit.pelanggan_id=pelanggan.id join pilihan_biaya on nota_kredit.pilihan_biaya_id=pilihan_biaya.id order by tanggal DESC,nota_kredit.id DESC";
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