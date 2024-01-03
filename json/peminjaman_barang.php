<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");

mysqli_set_charset($koneksi,"utf8");
 
//menampilkan data dari database, table tb_anggota
if (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
$sql = "select *,barang_pinjam.id as idd from barang_pinjam,barang_dikirim,pembeli,barang_dijual,barang_pinjam_detail,barang_gudang_detail,barang_gudang where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_pinjam_detail.barang_gudang_detail_id and barang_pinjam.id=barang_pinjam_detail.barang_pinjam_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_pinjam.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and tgl_peminjaman between '$_GET[tgl1]' and '$_GET[tgl2]' group by barang_pinjam.id order by tgl_peminjaman DESC,barang_pinjam.id DESC";
}
elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
$sql = "select *,barang_pinjam.id as idd from barang_pinjam,barang_dikirim,pembeli,barang_dijual,barang_pinjam_detail,barang_gudang_detail,barang_gudang where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_pinjam_detail.barang_gudang_detail_id and barang_pinjam.id=barang_pinjam_detail.barang_pinjam_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_pinjam.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and $_GET[pilihan] like '%$_GET[kunci]%' group by barang_pinjam.id order by tgl_peminjaman DESC,barang_pinjam.id DESC";
} else {
$sql = "select *,barang_pinjam.id as idd from barang_pinjam,barang_dikirim,pembeli,barang_dijual where barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_pinjam.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id group by barang_pinjam.id order by tgl_peminjaman DESC,barang_pinjam.id DESC LIMIT 100";
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