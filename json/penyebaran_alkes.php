<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");

mysqli_set_charset($koneksi,"utf8");

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
$sql = "select *,barang_dikirim.id as idd from barang_dijual,barang_dijual_qty,barang_gudang,pembeli,barang_dikirim,barang_gudang_detail,barang_dikirim_detail where barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and pembeli.id=barang_dijual.pembeli_id and tgl_kirim between '$_GET[tgl1]' and '$_GET[tgl2]' group by barang_dikirim.id order by tgl_kirim DESC, barang_dikirim.id DESC LIMIT $curr, $limit";
}
elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
$sql = "select *,barang_dikirim.id as idd from barang_dijual,barang_dijual_qty,barang_gudang,pembeli,barang_dikirim,barang_gudang_detail,barang_dikirim_detail where barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and pembeli.id=barang_dijual.pembeli_id and $_GET[pilihan] like '%$_GET[kunci]%' group by barang_dikirim.id order by tgl_kirim DESC, barang_dikirim.id DESC LIMIT $curr, $limit";
} else {
	
	$sql = "select *,barang_dikirim.id as idd from barang_dikirim order by tgl_kirim DESC, barang_dikirim.id DESC LIMIT $curr, $limit";
	
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