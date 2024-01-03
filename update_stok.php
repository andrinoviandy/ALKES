<?php require("config/koneksi.php"); ?>
<?php

$simpan = mysqli_query($koneksi, "select * from barang_gudang");
while ($up = mysqli_fetch_array($simpan)) {
	$stok = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM barang_gudang_detail WHERE barang_gudang_id=$up[id] and status_kirim=0 and status_kerusakan=0 and status_kembali_ke_gudang=0"));
	$update= mysqli_query($koneksi, "update barang_gudang set stok_total=$stok where id=".$up['id']."");
}
if ($update) {
	echo "<script>
	alert('Stok Berhasil Di Update');
	history.back();</script>";
	}
	else {
		echo "<script>
	alert('Stok Gagal Di Update');
	history.back();</script>";
		}
?>