<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");

mysqli_set_charset($koneksi,"utf8");
 
//menampilkan data dari database, table tb_anggota
$queryResult = $koneksi->query("select *,barang_inventory.id as idd from barang_inventory");
	$result	 = array();
	while($fethData = $queryResult->fetch_assoc()){
		$result[] = $fethData;
	}
	echo json_encode($result);

?>