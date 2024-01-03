<?php require("config/koneksi.php"); ?>
<?php
$hapus = mysqli_query($koneksi, "delete from tb_spk where id=".$_GET['id_hapus']."");
if ($hapus) {
		echo "<script type='text/javascript'>
		window.location='index.php?page=pembuatan_spk'
		</script>";
		}
else {
		echo "<script type='text/javascript'>
	alert('Maaf Data Tidak Dapat Dihapus !');	window.location='index.php?page=pembuatan_spk'
		</script>";
		}

?>