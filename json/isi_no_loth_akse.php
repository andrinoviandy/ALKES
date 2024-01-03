<?php
error_reporting(0);
header("Content-type:application/json");

//koneksi ke database
require("../config/koneksi.php");

$sql = "select *,aksesoris_detail.id as idd from aksesoris_detail , aksesoris where aksesoris.id=aksesoris_detail.aksesoris_id and aksesoris.id =" . $_GET['id'] . " and status_kirim_akse=0 order by no_lot_akse ASC";

$result = mysqli_query($koneksi, $sql) or die("Error " . mysqli_error($koneksi));

//membuat array
while ($row = mysqli_fetch_assoc($result)) {
	$ArrAnggota[] = $row;
}

echo json_encode($ArrAnggota, JSON_PRETTY_PRINT);

//tutup koneksi ke database
mysqli_close($koneksi);
