<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");
 
//menampilkan data dari database, table tb_anggota

if (isset($_GET['id_keuangan'])) {
	if (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
		if (isset($_GET['id'])) {
		$sql = "select *,biaya_lain.id as idd from biaya_lain where buku_kas_id=".$_GET['id']." and keuangan_id=".$_GET['id_keuangan']." and tgl between '$_GET[tgl1]' and '$_GET[tgl2]' order by tgl DESC, biaya_lain.id DESC";
		} else {
		$sql = "select *,biaya_lain.id as idd from biaya_lain where keuangan_id=".$_GET['id_keuangan']." and tgl between '$_GET[tgl1]' and '$_GET[tgl2]' order by tgl DESC, biaya_lain.id DESC";
		}
}
	elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
		if (isset($_GET['id'])) {
		$sql = "select *,biaya_lain.id as idd from biaya_lain where buku_kas_id=".$_GET['id']." and keuangan_id=".$_GET['id_keuangan']." and buku_kas_id=$_GET[id] and $_GET[pilihan] like '%$_GET[kunci]%' order by tgl DESC, biaya_lain.id DESC";
		} else {
		$sql = "select *,biaya_lain.id as idd from biaya_lain where keuangan_id=".$_GET['id_keuangan']." and buku_kas_id=$_GET[id] and $_GET[pilihan] like '%$_GET[kunci]%' order by tgl DESC, biaya_lain.id DESC";
		}
}
 	else {
		if (isset($_GET['id'])) {
		$sql = "select *,biaya_lain.id as idd from biaya_lain where buku_kas_id=".$_GET['id']." and keuangan_id=".$_GET['id_keuangan']." order by tgl DESC, biaya_lain.id DESC LIMIT 100";
		} else {
		$sql = "select *,biaya_lain.id as idd from biaya_lain where keuangan_id=".$_GET['id_keuangan']." order by tgl DESC, biaya_lain.id DESC LIMIT 100";
		}
}
$result = mysqli_query($koneksi, $sql) or die("Error " . mysqli_error($koneksi));
} else {
	if (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
		if (isset($_GET['id'])) {
		$sql = "select *,biaya_lain.id as idd from biaya_lain where buku_kas_id=$_GET[id] and tgl between '$_GET[tgl1]' and '$_GET[tgl2]' order by tgl DESC, biaya_lain.id DESC";
		} else {
		$sql = "select *,biaya_lain.id as idd from biaya_lain where tgl between '$_GET[tgl1]' and '$_GET[tgl2]' order by tgl DESC, biaya_lain.id DESC";
		}
}
	elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
		if (isset($_GET['id'])) {
		$sql = "select *,biaya_lain.id as idd from biaya_lain where buku_kas_id=$_GET[id] and $_GET[pilihan] like '%$_GET[kunci]%' order by tgl DESC, biaya_lain.id DESC";
		} else {
		$sql = "select *,biaya_lain.id as idd from biaya_lain where $_GET[pilihan] like '%$_GET[kunci]%' order by tgl DESC, biaya_lain.id DESC";
		}
}
 	else {
		if (isset($_GET['id'])) {
		$sql = "select *,biaya_lain.id as idd from biaya_lain where buku_kas_id=".$_GET['id']." order by tgl DESC, biaya_lain.id DESC LIMIT 100";
		} else {
		$sql = "select *,biaya_lain.id as idd from biaya_lain order by tgl DESC, biaya_lain.id DESC LIMIT 100";
		}
}

$result = mysqli_query($koneksi, $sql) or die("Error " . mysqli_error($koneksi));
}
 
//membuat array
while ($row = mysqli_fetch_assoc($result)) {
    $ArrAnggota[] = $row;
}
 
echo json_encode($ArrAnggota, JSON_PRETTY_PRINT);
 
//tutup koneksi ke database
mysqli_close($koneksi);
?>