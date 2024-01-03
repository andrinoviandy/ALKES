<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");
 
//menampilkan data dari database, table tb_anggota
if (isset($_GET['id_keuangan'])) {
$sql = "select *,barang_pesan.id as idd from barang_pesan where jenis_po='Luar Negeri' and keuangan_id='$_GET[id_keuangan]' order by tgl_po_pesan DESC, barang_pesan.id DESC";
} else {
if (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
$sql = "select *,barang_pesan.id as idd from barang_pesan,barang_pesan_detail,barang_gudang,principle where barang_pesan.id=barang_pesan_detail.barang_pesan_id and barang_gudang.id=barang_pesan_detail.barang_gudang_id and principle.id=barang_pesan.principle_id and barang_pesan.jenis_po='Luar Negeri' and tgl_po_pesan between '$_GET[tgl1]' and '$_GET[tgl2]' group by barang_pesan.id order by tgl_po_pesan DESC, barang_pesan.id DESC";
}
elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
$sql = "select *,barang_pesan.id as idd from barang_pesan,barang_pesan_detail,barang_gudang,principle where barang_pesan.id=barang_pesan_detail.barang_pesan_id and barang_gudang.id=barang_pesan_detail.barang_gudang_id and principle.id=barang_pesan.principle_id and barang_pesan.jenis_po='Luar Negeri' and $_GET[pilihan] like '%$_GET[kunci]%' group by barang_pesan.id order by tgl_po_pesan DESC, barang_pesan.id DESC";
}
 else {
$sql = "select *,barang_pesan.id as idd from barang_pesan where jenis_po='Luar Negeri' order by tgl_po_pesan DESC, barang_pesan.id DESC LIMIT 100";
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