<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");
 
//menampilkan data dari database, table tb_anggota
if (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
$sql = "select *,barang_dikirim.id as idd,riwayat_panggilan.id as id_riwayat from barang_dijual,barang_dijual_qty,barang_gudang,pembeli,barang_dikirim,barang_gudang_detail,barang_dikirim_detail,riwayat_panggilan where barang_dikirim.id=riwayat_panggilan.barang_dikirim_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and pembeli.id=barang_dijual.pembeli_id and tgl_riwayat between '$_GET[tgl1]' and '$_GET[tgl2]' group by riwayat_panggilan.id order by tgl_riwayat DESC, barang_dikirim.id DESC";
}
elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
$sql = "select *,barang_dikirim.id as idd,riwayat_panggilan.id as id_riwayat from barang_dijual,barang_dijual_qty,barang_gudang,pembeli,barang_dikirim,barang_gudang_detail,barang_dikirim_detail,riwayat_panggilan where barang_dikirim.id=riwayat_panggilan.barang_dikirim_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and pembeli.id=barang_dijual.pembeli_id and $_GET[pilihan] like '%$_GET[kunci]%' group by riwayat_panggilan.id order by tgl_riwayat DESC, barang_dikirim.id DESC";
} else {
$sql = "select *,barang_dikirim.id as idd,riwayat_panggilan.id as id_riwayat from riwayat_panggilan,barang_dikirim where barang_dikirim.id=riwayat_panggilan.barang_dikirim_id order by tgl_riwayat DESC, barang_dikirim.id DESC LIMIT 100";
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