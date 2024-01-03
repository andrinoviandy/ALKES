<?php require("../config/koneksi.php"); ?>
<?php
$hapus = mysqli_query($koneksi, "delete from pemusnahan where id=".$_GET['id_hapus']."");
if ($hapus) {
		echo "<script type='text/javascript'>
		window.location='../index.php?page=pemusnahan_alkes'
		</script>";
		}
else {
		echo "<script type='text/javascript'>
	alert('Data Tidak Berhasil Di Hapus !');	window.location='../index.php?page=pemusnahan_alkes'
		</script>";
		}

?>