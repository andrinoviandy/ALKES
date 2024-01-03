<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");
 
//menampilkan data dari database, table tb_anggota
if (isset($_GET['id_b'])) {
$sql = "select *,barang_gudang.id as id_gudang,barang_gudang_detail.id as id_gudang_detail,barang_kembali_teknisi.id as idd from barang_gudang,barang_gudang_detail,barang_kembali,barang_kembali_detail,barang_kembali_teknisi,tb_teknisi where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_kembali_detail.barang_gudang_detail_id and barang_kembali.id=barang_kembali_detail.barang_kembali_id and barang_kembali_detail.id=barang_kembali_teknisi.barang_kembali_detail_id and tb_teknisi.id=barang_kembali_teknisi.teknisi_id and barang_gudang.id=".$_GET['id_gudang']." and teknisi.id=$_GET[id_b] order by tgl_po_gudang DESC";	
	}
else {
$sql = "select *,barang_gudang.id as id_gudang,barang_gudang_detail.id as id_gudang_detail,barang_kembali_teknisi.id as idd from barang_gudang,barang_gudang_detail,barang_kembali,barang_kembali_detail,barang_kembali_teknisi,tb_teknisi where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_kembali_detail.barang_gudang_detail_id and barang_kembali.id=barang_kembali_detail.barang_kembali_id and barang_kembali_detail.id=barang_kembali_teknisi.barang_kembali_detail_id and tb_teknisi.id=barang_kembali_teknisi.teknisi_id and barang_gudang.id=".$_GET['id_gudang']." order by nama_brg ASC";
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