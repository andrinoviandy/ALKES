<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");
 
//menampilkan data dari database, table tb_anggota
if (isset($_GET['id'])) {
	if (isset($_GET['pilihan']) and isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
$sql = "select *,barang_demo_kirim.id as idd from barang_demo_kirim,barang_demo_kirim_detail,barang_gudang,pembeli,barang_gudang_detail,barang_demo,barang_demo_qty where barang_demo_kirim.id=barang_demo_kirim_detail.barang_demo_kirim_id and barang_demo.id=barang_demo_qty.barang_demo_id and barang_demo_qty.id=barang_demo_kirim_detail.barang_demo_qty_id and barang_gudang_detail.id=barang_demo_kirim_detail.barang_gudang_detail_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and $_GET[pilihan] between '$_GET[tgl1]' and '$_GET[tgl2]' group by barang_demo_kirim.id order by tgl_kirim DESC, barang_demo_kirim.id DESC";
}
elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
$sql = "select *,barang_demo_kirim.id as idd from barang_demo_kirim,barang_demo_kirim_detail,barang_gudang,pembeli,barang_gudang_detail,barang_demo,barang_demo_qty where barang_demo_kirim.id=barang_demo_kirim_detail.barang_demo_kirim_id and barang_demo.id=barang_demo_qty.barang_demo_id and barang_demo_qty.id=barang_demo_kirim_detail.barang_demo_qty_id and barang_gudang_detail.id=barang_demo_kirim_detail.barang_gudang_detail_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and $_GET[pilihan] like '%$_GET[kunci]%' group by barang_demo_kirim.id order by tgl_kirim DESC, barang_demo_kirim.id DESC";
} else {
$sql = "select *,barang_demo_kirim.id as idd from barang_demo_kirim where barang_demo_kirim.id=".$_GET['id']." order by barang_demo_kirim.tgl_kirim DESC, barang_demo_kirim.id DESC LIMIT 100";
}
}
else if (isset($_GET['id_riwayat'])) {
	if (isset($_GET['pilihan']) and isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
$sql = "select *,barang_demo_kirim.id as idd from barang_demo_kirim,barang_demo_kirim_detail,barang_gudang,pembeli,barang_gudang_detail,barang_demo,barang_demo_qty where barang_demo_kirim.id=barang_demo_kirim_detail.barang_demo_kirim_id and barang_demo.id=barang_demo_qty.barang_demo_id and barang_demo_qty.id=barang_demo_kirim_detail.barang_demo_qty_id and barang_gudang_detail.id=barang_demo_kirim_detail.barang_gudang_detail_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and $_GET[pilihan] between '$_GET[tgl1]' and '$_GET[tgl2]' group by barang_demo_kirim.id order by tgl_kirim DESC, barang_demo_kirim.id DESC";
}
elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
$sql = "select *,barang_demo_kirim.id as idd from barang_demo_kirim,barang_demo_kirim_detail,barang_gudang,pembeli,barang_gudang_detail,barang_demo,barang_demo_qty where barang_demo_kirim.id=barang_demo_kirim_detail.barang_demo_kirim_id and barang_demo.id=barang_demo_qty.barang_demo_id and barang_demo_qty.id=barang_demo_kirim_detail.barang_demo_qty_id and barang_gudang_detail.id=barang_demo_kirim_detail.barang_gudang_detail_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and $_GET[pilihan] like '%$_GET[kunci]%' group by barang_demo_kirim.id order by tgl_kirim DESC, barang_demo_kirim.id DESC";
} else {
$sql = "select *,barang_demo_kirim.id as idd from barang_demo_kirim where barang_demo_kirim.id=".$_GET['id_riwayat']." order by tgl_kirim DESC, barang_demo_kirim.id DESC LIMIT 100";
}
}
else {
if (isset($_GET['pilihan']) and isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
$sql = "select *,barang_demo_kirim.id as idd from barang_demo_kirim,barang_demo_kirim_detail,barang_gudang,pembeli,barang_gudang_detail,barang_demo,barang_demo_qty where barang_demo_kirim.id=barang_demo_kirim_detail.barang_demo_kirim_id and barang_demo.id=barang_demo_qty.barang_demo_id and barang_demo_qty.id=barang_demo_kirim_detail.barang_demo_qty_id and barang_gudang_detail.id=barang_demo_kirim_detail.barang_gudang_detail_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and $_GET[pilihan] between '$_GET[tgl1]' and '$_GET[tgl2]' group by barang_demo_kirim.id order by tgl_kirim DESC, barang_demo_kirim.id DESC";
}
elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
$sql = "select *,barang_demo_kirim.id as idd from barang_demo_kirim,barang_demo_kirim_detail,barang_gudang,pembeli,barang_gudang_detail,barang_demo,barang_demo_qty where barang_demo_kirim.id=barang_demo_kirim_detail.barang_demo_kirim_id and barang_demo.id=barang_demo_qty.barang_demo_id and barang_demo_qty.id=barang_demo_kirim_detail.barang_demo_qty_id and barang_gudang_detail.id=barang_demo_kirim_detail.barang_gudang_detail_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and $_GET[pilihan] like '%$_GET[kunci]%' group by barang_demo_kirim.id order by tgl_kirim DESC, barang_demo_kirim.id DESC";
}
else {
$sql = "select *,barang_demo_kirim.id as idd from barang_demo_kirim order by barang_demo_kirim.tgl_kirim DESC, barang_demo_kirim.id DESC LIMIT 100";
}
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