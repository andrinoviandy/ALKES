<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");
 
//menampilkan data dari database, table tb_anggota
if (isset($_GET['tgl_awal']) and isset($_GET['tgl_akhir'])) {
$sql = "select *,barang_demo.id as idd from barang_demo,pembeli where pembeli.id=barang_demo.pembeli_id and tgl_pinjam between '$_GET[tgl_awal]' and '$_GET[tgl_akhir]' order by tgl_pinjam DESC, barang_demo.id DESC";
}
elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
$sql = "select *,barang_demo.id as idd from barang_demo,pembeli,barang_demo_qty,barang_gudang where barang_gudang.id=barang_demo_qty.barang_gudang_id and barang_demo.id=barang_demo_qty.barang_demo_id and pembeli.id=barang_demo.pembeli_id and $_GET[pilihan] like '%$_GET[kunci]%' order by tgl_pinjam DESC, barang_demo.id DESC";
}
 else {
$sql = "select *,barang_demo.id as idd from barang_demo,pembeli where pembeli.id=barang_demo.pembeli_id order by tgl_pinjam DESC, barang_demo.id DESC LIMIT 100";
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