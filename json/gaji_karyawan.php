<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");

mysqli_set_charset($koneksi,"utf8");
 
//menampilkan data dari database, table tb_anggota
$queryResult = $koneksi->query("select *,gaji_karyawan.id as idd from gaji_karyawan,karyawan where karyawan.id=gaji_karyawan.karyawan_id order by gaji_karyawan.bulan_tahun DESC, gaji_karyawan.id DESC");
	$result	 = array();
	while($fethData = $queryResult->fetch_assoc()){
		$result[] = $fethData;
	}
	echo json_encode($result);

?>