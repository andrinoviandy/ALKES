<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");

$query = mysqli_query($koneksi, "SELECT jumlah_limit FROM limiter_stok");
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
if (isset($_GET['kunci'])) {
	
		$sql = "select *,barang_gudang.id as idd from barang_gudang where id=$_GET[kunci] order by nama_brg ASC LIMIT $curr, $limit";
		
}
else {
$sql = "select *,barang_gudang.id as idd from barang_gudang order by nama_brg ASC LIMIT $curr, $limit";
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