<?php
require("config/koneksi.php");

if (isset($_POST['kode'])) {
	$kode = $_POST['kode'];
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang,barang_gudang_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and no_seri_brg='".$kode."'"));
	
	}
?>