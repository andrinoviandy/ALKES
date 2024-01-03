<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");
 
//menampilkan data dari database, table tb_anggota
if (isset($_GET['id_b'])) {
$sql = "select *,tb_laporan_kerusakan_cs.id as idd from pembeli,tb_laporan_kerusakan_cs,tb_laporan_kerusakan_cs_detail,tb_laporan_kerusakan_detail,tb_maintenance_detail,tb_teknisi where pembeli.id=tb_laporan_kerusakan_cs.pembeli_id and tb_laporan_kerusakan_cs.id=tb_laporan_kerusakan_cs_detail.tb_laporan_kerusakan_cs_id and tb_laporan_kerusakan_cs_detail.id=tb_laporan_kerusakan_detail.tb_laporan_kerusakan_cs_detail_id and tb_laporan_kerusakan_detail.id=tb_maintenance_detail.tb_laporan_kerusakan_detail_id and tb_teknisi.id=tb_laporan_kerusakan_detail.teknisi_id and pembeli_id=".$_GET['id']." and tb_teknisi.id=".$_GET['id_b']." group by tb_laporan_kerusakan_cs.id order by tb_laporan_kerusakan_cs.tgl_lapor DESC,tb_laporan_kerusakan_cs.id DESC";
	}
else {
$sql = "select *,tb_laporan_kerusakan_cs.id as idd from pembeli,tb_laporan_kerusakan_cs,tb_laporan_kerusakan_cs_detail,tb_laporan_kerusakan_detail,tb_maintenance_detail,tb_teknisi where pembeli.id=tb_laporan_kerusakan_cs.pembeli_id and tb_laporan_kerusakan_cs.id=tb_laporan_kerusakan_cs_detail.tb_laporan_kerusakan_cs_id and tb_laporan_kerusakan_cs_detail.id=tb_laporan_kerusakan_detail.tb_laporan_kerusakan_cs_detail_id and tb_laporan_kerusakan_detail.id=tb_maintenance_detail.tb_laporan_kerusakan_detail_id and tb_teknisi.id=tb_laporan_kerusakan_detail.teknisi_id and pembeli_id=".$_GET['id']." group by tb_laporan_kerusakan_cs.id order by tb_laporan_kerusakan_cs.tgl_lapor DESC,tb_laporan_kerusakan_cs.id DESC";
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