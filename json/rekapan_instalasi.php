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
if (isset($_GET['merk'])) {
if ($_GET['merk']=='all') {
	if (isset($_GET['pilihan']) and isset($_GET['kunci'])) {
	$sql = "select *,barang_teknisi_detail.id as idd from barang_teknisi,barang_teknisi_detail, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and $_GET[pilihan] like '%$_GET[kunci]%' and tgl_spk between '$_GET[tgl1]' and '$_GET[tgl2]' group by no_seri_brg order by tgl_spk DESC, no_spk DESC LIMIT $curr, $limit";
	}
	elseif (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
	$sql = "select *,barang_teknisi_detail.id as idd from barang_teknisi,barang_teknisi_detail, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and tgl_spk between '$_GET[tgl1]' and '$_GET[tgl2]' group by no_seri_brg order by tgl_spk DESC, no_spk DESC LIMIT $curr, $limit";
	}
	else {
	$sql = "select *,barang_teknisi_detail.id as idd from barang_teknisi,barang_teknisi_detail, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and tgl_spk between '$_GET[tgl1]' and '$_GET[tgl2]' group by no_seri_brg order by tgl_spk DESC, no_spk DESC LIMIT $curr, $limit";
	}
	}
	else {
	if (isset($_GET['pilihan']) and isset($_GET['kunci'])) {
	$sql = "select *,barang_teknisi_detail.id as idd from barang_teknisi,barang_teknisi_detail, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and $_GET[pilihan] like '%$_GET[kunci]%' and barang_gudang.merk_brg='".$_GET['merk']."' and tgl_spk between '$_GET[tgl1]' and '$_GET[tgl2]' group by no_seri_brg order by tgl_spk DESC, no_spk DESC LIMIT $curr, $limit";
	}
	elseif (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
	$sql = "select *,barang_teknisi_detail.id as idd from barang_teknisi,barang_teknisi_detail, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_gudang.merk_brg='".$_GET['merk']."' and tgl_spk between '$_GET[tgl1]' and '$_GET[tgl2]' group by no_seri_brg order by tgl_spk DESC, no_spk DESC LIMIT $curr, $limit";
	}
	else {
	$sql = "select *,barang_teknisi_detail.id as idd from barang_teknisi,barang_teknisi_detail, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_gudang.merk_brg='".$_GET['merk']."' and tgl_spk between '$_GET[tgl1]' and '$_GET[tgl2]' group by no_seri_brg order by tgl_spk DESC, no_spk DESC LIMIT $curr, $limit";
		}
	}
}
else {
	if (isset($_GET['pilihan']) and isset($_GET['kunci'])) {
	$sql = "select *,barang_teknisi_detail.id as idd from barang_teknisi,barang_teknisi_detail, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and $_GET[pilihan] like '%$_GET[kunci]%' group by no_seri_brg order by tgl_spk DESC, no_spk DESC LIMIT $curr, $limit";
	}
	elseif (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
	$sql = "select *,barang_teknisi_detail.id as idd from barang_teknisi,barang_teknisi_detail, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and tgl_spk between '$_GET[tgl1]' and '$_GET[tgl2]' group by no_seri_brg order by tgl_spk DESC, no_spk DESC LIMIT $curr, $limit";
	}
	else {
	$sql = "select *,barang_teknisi_detail.id as idd from barang_teknisi,barang_teknisi_detail, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id group by no_seri_brg order by tgl_spk DESC, no_spk DESC LIMIT $curr, $limit";
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