<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");

// $query = mysqli_query($koneksi, "SELECT jumlah_limit FROM limiter");
// list($surat_masuk) = mysqli_fetch_array($query);
// //pagging
// $limit = $surat_masuk;
// $pg = @$_GET['paging'];
// 	if(empty($pg)){
// 	$curr = 0;
//     $pg = 1;
//     } else {
//     $curr = ($pg - 1) * $limit;
//     }

//menampilkan data dari database, table tb_anggota
$start = mysqli_real_escape_string($koneksi, $_GET['start']);
if (isset($_GET['cari'])) {
$sql = "select *,barang_teknisi.id as idd from barang_dikirim,barang_teknisi,barang_teknisi_detail,barang_dikirim_detail,barang_gudang,barang_gudang_detail,barang_dijual,barang_dijual_qty,pembeli where barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_dijual_qty.id=barang_dikirim_detail.barang_dijual_qty_id and barang_dijual.id=barang_dijual_qty.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and barang_dijual.no_po_jual like '%$_GET[cari]%' group by barang_teknisi.id order by tgl_spk DESC,no_spk DESC LIMIT $start";
} else {
$sql = "select *,barang_teknisi.id as idd from barang_teknisi order by tgl_spk DESC,no_spk DESC LIMIT $start";
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