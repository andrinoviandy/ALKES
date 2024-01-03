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
if (isset($_GET['id_keuangan'])) {
$sql = "select *,barang_pesan.id as idd from barang_pesan where jenis_po='Dalam Negeri' and keuangan_id='$_GET[id_keuangan]' order by tgl_po_pesan DESC, barang_pesan.id DESC LIMIT $curr, $limit";
} else {
if (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
$sql = "select *,barang_pesan.id as idd from barang_pesan,barang_pesan_detail,barang_gudang,principle where barang_pesan.id=barang_pesan_detail.barang_pesan_id and barang_gudang.id=barang_pesan_detail.barang_gudang_id and principle.id=barang_pesan.principle_id and barang_pesan.jenis_po='Dalam Negeri' and tgl_po_pesan between '$_GET[tgl1]' and '$_GET[tgl2]' group by barang_pesan.id order by tgl_po_pesan DESC, barang_pesan.id DESC LIMIT $curr, $limit";
}
elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
$sql = "select *,barang_pesan.id as idd from barang_pesan,barang_pesan_detail,barang_gudang,principle where barang_pesan.id=barang_pesan_detail.barang_pesan_id and barang_gudang.id=barang_pesan_detail.barang_gudang_id and principle.id=barang_pesan.principle_id and barang_pesan.jenis_po='Dalam Negeri' and $_GET[pilihan] like '%$_GET[kunci]%' group by barang_pesan.id order by tgl_po_pesan DESC, barang_pesan.id DESC LIMIT $curr, $limit";
}
 else {
$sql = "select *,barang_pesan.id as idd from barang_pesan where jenis_po='Dalam Negeri' order by tgl_po_pesan DESC, barang_pesan.id DESC";
}
}
$sql2 = mysqli_query($koneksi, $sql) or die("Error " . mysqli_error($koneksi));
$result = array();
//membuat array
while ($row = mysqli_fetch_assoc($sql2)) {
    $data[] = $row;
}
 
echo json_encode(array("result" => $data));
 
//tutup koneksi ke database
mysqli_close($koneksi);
?>