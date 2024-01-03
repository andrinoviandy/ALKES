<?php
 
//header("Content-type:application/json");
 
//koneksi ke database
$konek = new mysqli("localhost", "root", "", "db_kharisma");
mysqli_set_charset($konek,"utf8");
 
//menampilkan data dari database, table tb_anggota
$queryResult = $konek->query("select * from barang_gudang");
	$result	 = array();
	while($fethData = $queryResult->fetch_assoc()){
		$result[] = $fethData;
	}
	echo json_encode($result);

?>