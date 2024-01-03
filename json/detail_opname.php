<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");

//menampilkan data dari database, table tb_anggota

$sql = "select *,barang_gudang_detail.id as idd,barang_gudang_po.id as id_po,barang_gudang_po.stok as stok_masuk from barang_gudang_detail,barang_gudang_po,barang_gudang where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_po.id=barang_gudang_detail.barang_gudang_po_id and status_kirim=0 and status_kerusakan=0 and barang_gudang_detail.barang_gudang_id=".$_GET['id']." and barang_gudang_detail.id='".$_GET['id_detail']."' order by no_po_gudang DESC";
$result = mysqli_query($koneksi, $sql) or die("Error " . mysqli_error($koneksi));
 
//membuat array
while ($row = mysqli_fetch_assoc($result)) {
    $ArrAnggota[] = $row;
}
 
echo json_encode($ArrAnggota, JSON_PRETTY_PRINT);
 
//tutup koneksi ke database
mysqli_close($koneksi);
?>