<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");

mysqli_set_charset($koneksi,"utf8");

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
if (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
	$queryResult = $koneksi->query("select *,aksesoris.id as idd from aksesoris where $_GET[pilihan] like '%$_GET[kunci]%' order by nama_akse ASC LIMIT $curr, $limit");
}
else {
	$queryResult = $koneksi->query("select *,aksesoris.id as idd from aksesoris order by nama_akse ASC LIMIT $curr, $limit");
}

	$result	 = array();
	while($fethData = $queryResult->fetch_assoc()){
		$result[] = $fethData;
	}
	echo json_encode($result);

?>