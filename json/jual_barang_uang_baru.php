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
$sql = "select *,barang_dijual.id as idd from barang_dijual,barang_dijual_qty,barang_gudang,pembeli where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and pembeli.id=barang_dijual.pembeli_id and tgl_jual between '$_GET[tgl1]' and '$_GET[tgl2]' group by barang_dijual.id order by tgl_jual DESC, barang_dijual.id DESC LIMIT $curr, $limit";
$result = mysqli_query($koneksi, $sql) or die("Error " . mysqli_error($koneksi));
 
//membuat array
while ($row = mysqli_fetch_assoc($result)) {
    $ArrAnggota[] = $row;
}
 
echo json_encode($ArrAnggota, JSON_PRETTY_PRINT);
 
//tutup koneksi ke database
mysqli_close($koneksi);
}
elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
$sql = "select *,barang_dijual.id as idd from barang_dijual,barang_dijual_qty,barang_gudang,pembeli where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and pembeli.id=barang_dijual.pembeli_id and $_GET[pilihan] like '%$_GET[kunci]%' group by barang_dijual.id order by tgl_jual DESC, barang_dijual.id";
$result = mysqli_query($koneksi, $sql) or die("Error " . mysqli_error($koneksi));
 
//membuat array
while ($row = mysqli_fetch_assoc($result)) {
    $ArrAnggota[] = $row;
}
 
echo json_encode($ArrAnggota, JSON_PRETTY_PRINT);
 
//tutup koneksi ke database
mysqli_close($koneksi);
}
elseif (isset($_GET['status_barang'])) {
	if ($_GET['status_barang']=='Belum') {
	$sel = mysqli_query($koneksi, "select * from barang_dijual_qty");
	while ($d = mysqli_fetch_array($sel)) {
	$ss = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim_detail where barang_dijual_qty_id=$d[id]"));
	if ($ss==0) {
	$sql = "select *,barang_dijual.id as idd from barang_dijual,barang_dijual_qty,barang_gudang,pembeli where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and pembeli.id=barang_dijual.pembeli_id and barang_dijual_qty.id=$d[id] group by barang_dijual.id order by tgl_jual DESC, barang_dijual.id DESC LIMIT $curr, $limit";
	$result = mysqli_query($koneksi, $sql) or die("Error " . mysqli_error($koneksi));
 
//membuat array
$row = mysqli_fetch_assoc($result);
    $ArrAnggota[] = $row;
	}
	}
	echo json_encode($ArrAnggota, JSON_PRETTY_PRINT);
 
//tutup koneksi ke database
mysqli_close($koneksi);
	}
	elseif ($_GET['status_barang']=='Sudah') {
	$sql = "select *,barang_dijual.id as idd from barang_dijual,barang_dijual_qty,barang_gudang,pembeli,barang_dikirim_detail where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and pembeli.id=barang_dijual.pembeli_id and barang_dijual_qty.id=barang_dikirim_detail.barang_dijual_qty_id group by barang_dijual.id order by tgl_jual DESC, barang_dijual.id DESC LIMIT $curr, $limit";
	$result = mysqli_query($koneksi, $sql) or die("Error " . mysqli_error($koneksi));
 
//membuat array
while ($row = mysqli_fetch_assoc($result)) {
    $ArrAnggota[] = $row;
}
 
echo json_encode($ArrAnggota, JSON_PRETTY_PRINT);
 
//tutup koneksi ke database
mysqli_close($koneksi);
	}
}
 else {
$sql = "select *,barang_dijual.id as idd from barang_dijual order by tgl_jual DESC, barang_dijual.id DESC LIMIT $curr, $limit";
$result = mysqli_query($koneksi, $sql) or die("Error " . mysqli_error($koneksi));
 
//membuat array
while ($row = mysqli_fetch_assoc($result)) {
    $ArrAnggota[] = $row;
}
 
echo json_encode($ArrAnggota, JSON_PRETTY_PRINT);
 
//tutup koneksi ke database
mysqli_close($koneksi);
 }
?>