<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");
 
//menampilkan data dari database, table tb_anggota
$sql = "select *,utang_piutang.nominal as nominal_up,utang_piutang.id as id_up from utang_piutang_bayar,buku_kas,utang_piutang,kategori_buku_kas where utang_piutang.id=utang_piutang_bayar.utang_piutang_id and kategori_buku_kas.id=utang_piutang.kategori_buku_kas_id and buku_kas.id=utang_piutang_bayar.buku_kas_id and utang_piutang.u_p='Piutang' group by utang_piutang_id order by utang_piutang.tgl_input DESC, utang_piutang.id DESC";
$result = mysqli_query($koneksi, $sql) or die("Error " . mysqli_error($koneksi));
 
//membuat array
while ($row = mysqli_fetch_assoc($result)) {
    $ArrAnggota[] = $row;
}
 
echo json_encode($ArrAnggota, JSON_PRETTY_PRINT);
 
//tutup koneksi ke database
mysqli_close($koneksi);
?>