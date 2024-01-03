<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");
 
//menampilkan data dari database, table tb_anggota
if (isset($_GET['id_b'])) {
$sql = "select *,barang_gudang_detail_rusak.id as idd, barang_gudang_detail.id as id_gudang_detail from barang_gudang,barang_gudang_po,barang_gudang_detail,barang_gudang_detail_rusak,tb_teknisi where barang_gudang.id=barang_gudang_po.barang_gudang_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_gudang_detail_rusak.barang_gudang_detail_id and barang_gudang.id=$_GET[id_gudang] and tb_teknisi.id=barang_gudang_detail_rusak.teknisi_id and teknisi_id=$_GET[id_b] group by barang_gudang_detail_rusak.id order by tgl_po_gudang DESC, barang_gudang_detail_rusak.id DESC";	
	}
else {
$sql = "select *,barang_gudang_detail_rusak.id as idd, barang_gudang_detail.id as id_gudang_detail from barang_gudang,barang_gudang_po,barang_gudang_detail,barang_gudang_detail_rusak where barang_gudang.id=barang_gudang_po.barang_gudang_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_gudang_detail_rusak.barang_gudang_detail_id and barang_gudang.id=$_GET[id_gudang] group by barang_gudang_detail_rusak.id order by tgl_po_gudang DESC, barang_gudang_detail_rusak.id DESC";
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