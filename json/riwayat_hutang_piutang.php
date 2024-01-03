<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");
 
//menampilkan data dari database, table tb_anggota
if (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
$sql = "select *,utang_piutang.nominal as nominal_up,utang_piutang.id as id_up from utang_piutang_bayar,buku_kas,utang_piutang where utang_piutang.id=utang_piutang_bayar.utang_piutang_id and buku_kas.id=utang_piutang_bayar.buku_kas_id and tgl_bayar between '$_GET[tgl1]' and '$_GET[tgl2]' group by utang_piutang_id order by utang_piutang.tgl_input DESC, utang_piutang.id DESC";
}
elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
$sql = "select *,utang_piutang.nominal as nominal_up,utang_piutang.id as id_up from utang_piutang_bayar,buku_kas,utang_piutang where utang_piutang.id=utang_piutang_bayar.utang_piutang_id and buku_kas.id=utang_piutang_bayar.buku_kas_id and buku_kas.id=$_GET[id] and $_GET[pilihan] like '%$_GET[kunci]%' group by utang_piutang_id order by utang_piutang.tgl_input DESC, utang_piutang.id DESC";
}
 else {
$sql = "select *,utang_piutang.nominal as nominal_up,utang_piutang.id as id_up from utang_piutang_bayar,buku_kas,utang_piutang where utang_piutang.id=utang_piutang_bayar.utang_piutang_id and buku_kas.id=utang_piutang_bayar.buku_kas_id and buku_kas.id=$_GET[id] group by utang_piutang_id order by utang_piutang.tgl_input DESC, utang_piutang.id DESC LIMIT 100";
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