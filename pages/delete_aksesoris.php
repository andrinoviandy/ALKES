<?php require("../config/koneksi.php"); ?>
<?php
$hapus = mysqli_query($koneksi, "delete from space_part where id=".$_GET['id_hapus']."");
if ($hapus) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Dihapus !');
		window.location='../index.php?page=aksesoris_alkes'
		</script>";
		}
else {
		echo "<script type='text/javascript'>
	alert('Maaf Data Tidak Dapat Dihapus !');	window.location='../index.php?page=aksesoris_alkes'
		</script>";
		}
?>