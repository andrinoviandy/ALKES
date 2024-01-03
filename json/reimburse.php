<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");
 
//menampilkan data dari database, table tb_anggota
if (isset($_GET['id_keuangan'])) {
$sql = "select *,reimburse.id as idd from reimburse,buku_kas where buku_kas.id=reimburse.buku_kas_id and keuangan_id=".$_GET['id_keuangan']." order by tgl_reimburse DESC, reimburse.id DESC";
} else {
$sql = "select *,reimburse.id as idd from reimburse,buku_kas where buku_kas.id=reimburse.buku_kas_id order by tgl_reimburse DESC, reimburse.id DESC";
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