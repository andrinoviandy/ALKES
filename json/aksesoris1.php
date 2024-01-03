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
if (isset($_GET['tgl_awal']) and isset($_GET['tgl_akhir'])) {
$sql = "select *,barang_pesan_akse.id as idd from barang_pesan_akse,barang_pesan_akse_detail,aksesoris,principle where barang_pesan_akse.id=barang_pesan_akse_detail.barang_pesan_akse_id and aksesoris.id=barang_pesan_akse_detail.aksesoris_id and principle.id=barang_pesan_akse.principle_id and tgl_po_pesan between '$_GET[tgl_awal]' and '$_GET[tgl_akhir]' group by barang_pesan_akse.id order by tgl_po_pesan DESC, barang_pesan_akse.id DESC LIMIT $curr, $limit";
}
elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
$sql = "select *,barang_pesan_akse.id as idd from barang_pesan_akse,barang_pesan_akse_detail,aksesoris,principle where barang_pesan_akse.id=barang_pesan_akse_detail.barang_pesan_akse_id and aksesoris.id=barang_pesan_akse_detail.aksesoris_id and principle.id=barang_pesan_akse.principle_id and $_GET[pilihan] like '%$_GET[kunci]%' group by barang_pesan_akse.id order by tgl_po_pesan DESC, barang_pesan_akse.id DESC LIMIT $curr, $limit";
}
 else {
$sql = "select *,barang_pesan_akse.id as idd from barang_pesan_akse,mata_uang,principle where mata_uang.id=barang_pesan_akse.mata_uang_id and principle.id=barang_pesan_akse.principle_id order by tgl_po_pesan DESC, barang_pesan_akse.id DESC LIMIT $curr, $limit";
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