<?php
 
//header("Content-type:application/json");
 
//koneksi ke database
$konek = new mysqli("localhost", "root", "", "db_kharisma_4");
mysqli_set_charset($konek,"utf8");
$sql = mysqli_query($konek, "SELECT * FROM barang_gudang");
$result = array();
 
while($row = mysqli_fetch_array($sql)){
	array_push($result, array('nama_brg' => $row[0], 'nie_brg' => $row[1], 'merk_brg' => $row[2], 'tipe_brg' => $row[3], 'negara_asal' => $row[4], 'stok_total' => $row[5], 'deskripsi_alat' => $row[6], 'harga_beli' => $row[7], 'harga_satuan' => $row[8], 'status_cek' => $row[9], ''));
}
echo json_encode(array("result" => $result));

?>