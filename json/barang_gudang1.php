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
if (isset($_GET['mutasi1'])) {
	if ($_GET['mutasi1']=='Belum') {
$sql = "select *,barang_pesan.id as idd from barang_pesan,barang_pesan_detail,principle where principle.id=barang_pesan.principle_id and barang_pesan.id=barang_pesan_detail.barang_pesan_id and status_ke_stok=0 and tgl_po_pesan between '$_GET[tgl1]' and '$_GET[tgl2]' group by barang_pesan.id order by tgl_po_pesan DESC, barang_pesan.id DESC LIMIT $curr, $limit";
	}
	else if ($_GET['mutasi1']=='Sudah') {
	$sql = "select *,barang_pesan.id as idd from barang_pesan,principle,barang_pesan_detail where principle.id=barang_pesan.principle_id and barang_pesan.id=barang_pesan_detail.barang_pesan_id and status_ke_stok=1 and tgl_po_pesan between '$_GET[tgl1]' and '$_GET[tgl2]' group by barang_pesan.id order by tgl_po_pesan DESC, barang_pesan.id DESC LIMIT $curr, $limit";
	}
}

elseif (isset($_GET['mutasi2'])) {
	if ($_GET['mutasi2']=='Belum') {
$sql = "select *,barang_pesan.id as idd from barang_pesan,barang_pesan_detail,principle where principle.id=barang_pesan.principle_id and barang_pesan.id=barang_pesan_detail.barang_pesan_id and barang_pesan_detail.status_ke_stok=0 group by barang_pesan.id order by tgl_po_pesan DESC, barang_pesan.id DESC LIMIT $curr, $limit";
	}
	else if ($_GET['mutasi2']=='Sudah') {
	$sql = "select *,barang_pesan.id as idd from barang_pesan,principle,barang_pesan_detail where principle.id=barang_pesan.principle_id and barang_pesan.id=barang_pesan_detail.barang_pesan_id and barang_pesan_detail.status_ke_stok=1 group by barang_pesan.id order by tgl_po_pesan DESC, barang_pesan.id DESC LIMIT $curr, $limit";
	}
}
else {
if (isset($_GET['tgl_awal']) and isset($_GET['tgl_akhir'])) {
$sql = "select *,barang_pesan.id as idd from barang_pesan,barang_pesan_detail,barang_gudang,principle where barang_pesan.id=barang_pesan_detail.barang_pesan_id and barang_gudang.id=barang_pesan_detail.barang_gudang_id and principle.id=barang_pesan.principle_id and tgl_po_pesan between '$_GET[tgl_awal]' and '$_GET[tgl_akhir]' group by barang_pesan.id order by tgl_po_pesan DESC, barang_pesan.id DESC LIMIT $curr, $limit";
}
elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
$sql = "select *,barang_pesan.id as idd from barang_pesan,barang_pesan_detail,barang_gudang,principle where barang_pesan.id=barang_pesan_detail.barang_pesan_id and barang_gudang.id=barang_pesan_detail.barang_gudang_id and principle.id=barang_pesan.principle_id and $_GET[pilihan] like '%$_GET[kunci]%' group by barang_pesan.id order by tgl_po_pesan DESC, barang_pesan.id DESC LIMIT $curr, $limit";
}
 else {
$sql = "select *,barang_pesan.id as idd from barang_pesan,principle where principle.id=barang_pesan.principle_id order by tgl_po_pesan DESC, barang_pesan.id DESC LIMIT $curr, $limit";
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