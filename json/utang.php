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
$sql = "select *,utang_piutang.id as idd from barang_pesan,barang_pesan_detail,barang_gudang,principle,utang_piutang where barang_pesan.id=barang_pesan_detail.barang_pesan_id and barang_gudang.id=barang_pesan_detail.barang_gudang_id and principle.id=barang_pesan.principle_id and barang_pesan.no_po_pesan=utang_piutang.no_faktur_no_po and u_p='Hutang' and tgl_input between '$_GET[tgl1]' and '$_GET[tgl2]' and utang_piutang.nominal!=0 and status_po_batal=0 group by utang_piutang.id order by tgl_input DESC, utang_piutang.id DESC LIMIT $curr, $limit";
}
elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
$sql = "select *,utang_piutang.id as idd from barang_pesan,barang_pesan_detail,barang_gudang,principle,utang_piutang where barang_pesan.id=barang_pesan_detail.barang_pesan_id and barang_gudang.id=barang_pesan_detail.barang_gudang_id and principle.id=barang_pesan.principle_id and barang_pesan.no_po_pesan=utang_piutang.no_faktur_no_po and u_p='Hutang' and $_GET[pilihan] like '%$_GET[kunci]%' and utang_piutang.nominal!=0 and status_po_batal=0 group by utang_piutang.id order by tgl_input DESC, utang_piutang.id DESC LIMIT $curr, $limit";
}
 else {
$sql = "select *,utang_piutang.id as idd from utang_piutang,barang_pesan where barang_pesan.no_po_pesan=utang_piutang.no_faktur_no_po and u_p='Hutang' and nominal!=0 and status_po_batal=0 order by tgl_input DESC, utang_piutang.id DESC LIMIT $curr, $limit";
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