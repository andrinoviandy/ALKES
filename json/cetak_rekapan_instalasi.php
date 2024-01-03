<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");
mysqli_set_charset($koneksi,"utf8");

//menampilkan data dari database, table tb_anggota
$sql = "select *,barang_teknisi_detail.id as idd from barang_teknisi,barang_teknisi_detail, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_gudang.merk_brg='".$_GET['merk']."' and tgl_spk between '$_GET[tgl1]' and '$_GET[tgl2]' group by no_seri_brg order by tgl_spk DESC, no_spk DESC";

$result = mysqli_query($koneksi, $sql) or die("Error " . mysqli_error($koneksi));
 
//membuat array
while ($row = mysqli_fetch_assoc($result)) {
    $ArrAnggota[] = $row;
}
 
echo json_encode($ArrAnggota, JSON_PRETTY_PRINT);
 
//tutup koneksi ke database
mysqli_close($koneksi);
?>