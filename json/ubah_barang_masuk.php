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
if (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
$sql = "select *,barang_gudang_detail.id as idd,barang_gudang_po.id as id_po,barang_gudang_po.stok as stok_masuk from barang_gudang_detail,barang_gudang_po,barang_gudang where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_po.id=barang_gudang_detail.barang_gudang_po_id and status_kirim=0 and status_kerusakan=0 and barang_gudang_detail.barang_gudang_id=".$_GET['id']." and $_GET[pilihan] like '%$_GET[kunci]%' order by no_po_gudang DESC LIMIT $curr, $limit";
}
else {
$sql = "select *,barang_gudang_detail.id as idd,barang_gudang_po.id as id_po,barang_gudang_po.stok as stok_masuk from barang_gudang_detail,barang_gudang_po,barang_gudang where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_po.id=barang_gudang_detail.barang_gudang_po_id and status_kirim=0 and status_kerusakan=0 and barang_gudang_detail.barang_gudang_id=".$_GET['id']." order by no_po_gudang DESC LIMIT $curr, $limit";
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