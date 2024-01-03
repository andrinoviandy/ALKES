<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");
 
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
if (isset($_GET['id_keuangan'])) {
$sql = "select *,aksesoris_jual.id as idd from aksesoris_jual,pembeli where pembeli.id=aksesoris_jual.pembeli_id and keuangan_id=$_GET[id_keuangan] order by tgl_jual_akse DESC, aksesoris_jual.id DESC";
} else {
	if (isset($_GET['kunci'])) {
	$sql = "select *,aksesoris_jual.id as idd from aksesoris_jual,pembeli,aksesoris_jual_qty,aksesoris where aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual.id=aksesoris_jual_qty.aksesoris_jual_id and pembeli.id=aksesoris_jual.pembeli_id and no_po_jual_akse like '%$_GET[kunci]%' or aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual.id=aksesoris_jual_qty.aksesoris_jual_id and pembeli.id=aksesoris_jual.pembeli_id and marketing_akse like '%$_GET[kunci]%' or aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual.id=aksesoris_jual_qty.aksesoris_jual_id and pembeli.id=aksesoris_jual.pembeli_id and nama_pembeli like '%$_GET[kunci]%' or aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual.id=aksesoris_jual_qty.aksesoris_jual_id and pembeli.id=aksesoris_jual.pembeli_id and nama_akse like '%$_GET[kunci]%' or aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual.id=aksesoris_jual_qty.aksesoris_jual_id and pembeli.id=aksesoris_jual.pembeli_id and merk_akse like '%$_GET[kunci]%' or aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual.id=aksesoris_jual_qty.aksesoris_jual_id and pembeli.id=aksesoris_jual.pembeli_id and tipe_akse like '%$_GET[kunci]%' or aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual.id=aksesoris_jual_qty.aksesoris_jual_id and pembeli.id=aksesoris_jual.pembeli_id and nie_akse like '%$_GET[kunci]%' group by aksesoris_jual.id order by tgl_jual_akse DESC, aksesoris_jual.id DESC LIMIT $curr, $limit";
	} elseif (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
	$sql = "select *,aksesoris_jual.id as idd from aksesoris_jual,pembeli where pembeli.id=aksesoris_jual.pembeli_id and tgl_jual_akse between '$_GET[tgl1]' and '$_GET[tgl2]' order by tgl_jual_akse DESC, aksesoris_jual.id DESC LIMIT $curr, $limit";
	} else {
	$sql = "select *,aksesoris_jual.id as idd from aksesoris_jual,pembeli where pembeli.id=aksesoris_jual.pembeli_id order by tgl_jual_akse DESC, aksesoris_jual.id DESC LIMIT $curr, $limit";
	}
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