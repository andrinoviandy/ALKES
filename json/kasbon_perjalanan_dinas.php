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
if (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
$sql = "select *,kasbon_perjalanan_dinas.id as idd from kasbon_perjalanan_dinas,kasbon_perjalanan_dinas_detail,barang_teknisi,barang_teknisi_detail,barang_dikirim_detail,barang_dikirim,barang_dijual,tb_teknisi,pembeli where barang_teknisi.id=kasbon_perjalanan_dinas_detail.barang_teknisi_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dijual.id=barang_dikirim.barang_dijual_id and tb_teknisi.id=kasbon_perjalanan_dinas_detail.teknisi_id and pembeli.id=barang_dijual.pembeli_id and tgl_kasbon between '$_GET[tgl1]' and '$_GET[tgl2]' group by kasbon_perjalanan_dinas.id order by tgl_kasbon DESC,no_ksabon DESC LIMIT $curr, $limit";
}
elseif (isset($_GET['kunci'])) {
$sql = "select *,kasbon_perjalanan_dinas.id as idd from kasbon_perjalanan_dinas,kasbon_perjalanan_dinas_detail,barang_teknisi,barang_teknisi_detail,barang_dikirim_detail,barang_dikirim,barang_dijual,tb_teknisi,pembeli where barang_teknisi.id=kasbon_perjalanan_dinas_detail.barang_teknisi_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dijual.id=barang_dikirim.barang_dijual_id and tb_teknisi.id=kasbon_perjalanan_dinas_detail.teknisi_id and pembeli.id=barang_dijual.pembeli_id and no_kasbon like '%$_GET[kunci]%' or barang_teknisi.id=kasbon_perjalanan_dinas_detail.barang_teknisi_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dijual.id=barang_dikirim.barang_dijual_id and tb_teknisi.id=kasbon_perjalanan_dinas_detail.teknisi_id and pembeli.id=barang_dijual.pembeli_id and no_spk like '%$_GET[kunci]%' or barang_teknisi.id=kasbon_perjalanan_dinas_detail.barang_teknisi_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dijual.id=barang_dikirim.barang_dijual_id and tb_teknisi.id=kasbon_perjalanan_dinas_detail.teknisi_id and pembeli.id=barang_dijual.pembeli_id and marketing like '%$_GET[kunci]%' or barang_teknisi.id=kasbon_perjalanan_dinas_detail.barang_teknisi_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dijual.id=barang_dikirim.barang_dijual_id and tb_teknisi.id=kasbon_perjalanan_dinas_detail.teknisi_id and pembeli.id=barang_dijual.pembeli_id and nama_pembeli like '%$_GET[kunci]%' or barang_teknisi.id=kasbon_perjalanan_dinas_detail.barang_teknisi_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dijual.id=barang_dikirim.barang_dijual_id and tb_teknisi.id=kasbon_perjalanan_dinas_detail.teknisi_id and pembeli.id=barang_dijual.pembeli_id and nama_teknisi like '%$_GET[kunci]%' or barang_teknisi.id=kasbon_perjalanan_dinas_detail.barang_teknisi_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dijual.id=barang_dikirim.barang_dijual_id and tb_teknisi.id=kasbon_perjalanan_dinas_detail.teknisi_id and pembeli.id=barang_dijual.pembeli_id and barang_dijual.no_po_jual like '%$_GET[kunci]%' group by kasbon_perjalanan_dinas.id order by tgl_kasbon DESC,no_kasbon DESC LIMIT $curr, $limit";
} else {
$sql = "select *,kasbon_perjalanan_dinas.id as idd from kasbon_perjalanan_dinas order by tgl_kasbon DESC,no_kasbon DESC LIMIT $curr, $limit";
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