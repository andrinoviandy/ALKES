<?php require("../config/koneksi.php"); ?>
<?php
$hapus2 = mysqli_query($koneksi, "delete from tb_laporan_kerusakan_cs_detail where tb_laporan_kerusakan_cs_id=".$_GET['id_hapus']."");
$hapus = mysqli_query($koneksi, "delete from tb_laporan_kerusakan_cs where id=".$_GET['id_hapus']."");
if ($hapus2 and $hapus) {
		echo "<script type='text/javascript'>
		window.location='../index.php?page=laporan_kerusakan_lama_cs&id=$_GET[id]'
		</script>";
		}
else {
		echo "<script type='text/javascript'>
	alert('Maaf Data Tidak Dapat Dihapus ! Jika ingin menghapus, Silakan hapus dari data Service Kerusakan terlebih dahulu !');	window.location='../index.php?page=laporan_kerusakan_lama_cs&id=$_GET[id]'
		</script>";
		}

?>
