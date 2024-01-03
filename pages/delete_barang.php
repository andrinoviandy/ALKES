<?php require("../config/koneksi.php"); ?>
<?php
$hapus = mysqli_query($koneksi, "delete from barang where id=".$_GET['id_hapus']."");
if ($hapus) {
		echo "<script type='text/javascript'>
		window.location='../index.php?page=barang'
		</script>";
		}
else {
		echo "<script type='text/javascript'>
	alert('Maaf Data Tidak Dapat Dihapus , Karena Laporan Kerusakan Sudah Masuk !');	window.location='../index.php?page=barang'
		</script>";
		}
?>