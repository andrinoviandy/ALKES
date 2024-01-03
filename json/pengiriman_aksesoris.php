<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");

$query = mysqli_query($koneksi, "SELECT jumlah_limit FROM limiter");
list($surat_masuk) = mysqli_fetch_array($query);
//pagging
$limit = $surat_masuk;
$pg = @$_GET['paging'];
	if(empty($pg)){
	$curr = 0;
    $pg = 1;
    } else {
    $curr = ($pg - 1) * $limit;
    }

//menampilkan data dari database, table tb_anggota
if (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
$sql = "select *,aksesoris_kirim.id as idd from aksesoris_kirim,aksesoris_jual,aksesoris_jual_qty,aksesoris_kirim_detail where aksesoris_kirim.id=aksesoris_kirim_detail.aksesoris_kirim_id and aksesoris_jual_qty.id=aksesoris_kirim_detail.aksesoris_jual_qty_id and aksesoris_jual.id=aksesoris_jual_qty.aksesoris_jual_id and tgl_kirim_akse between '$_GET[tgl1]' and '$_GET[tgl2]' group by aksesoris_kirim.id order by tgl_kirim_akse DESC, aksesoris_kirim.id DESC LIMIT $curr, $limit";
}
elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
$sql = "select *,aksesoris_kirim.id as idd from aksesoris_kirim,aksesoris_jual,aksesoris_jual_qty,aksesoris_kirim_detail,aksesoris_detail,pembeli where aksesoris_kirim.id=aksesoris_kirim_detail.aksesoris_kirim_id and aksesoris_jual_qty.id=aksesoris_kirim_detail.aksesoris_jual_qty_id and aksesoris_jual.id=aksesoris_jual_qty.aksesoris_jual_id and aksesoris_detail.id=aksesoris_kirim_detail.aksesoris_detail_id and pembeli.id=aksesoris_jual.pembeli_id and $_GET[pilihan] like '%$_GET[kunci]%' group by aksesoris_kirim.id order by tgl_kirim_akse DESC, aksesoris_kirim.id DESC LIMIT $curr, $limit";
} else {
$sql = "select *,aksesoris_kirim.id as idd from aksesoris_kirim order by aksesoris_kirim.tgl_kirim_akse DESC, aksesoris_kirim.id DESC LIMIT $curr, $limit";
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