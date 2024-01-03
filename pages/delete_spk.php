<?php require("../config/koneksi.php"); ?>
<?php
$hapus2 = mysqli_query($koneksi, "delete from tb_maintenance_detail where tb_maintenance_id=".$_GET['id_hapus']."");
$hapus = mysqli_query($koneksi, "delete from tb_maintenance where id=".$_GET['id_hapus']."");
if ($hapus and $hapus2) {
	
		echo "<script type='text/javascript'>
		window.location='../index.php?page=pembuatan_spk2&id=$_GET[id]'
		</script>";
		}
else {
		echo "<script type='text/javascript'>
	alert('Tidak Dapat Dihapus ! Jika Ingin Menghapus , Hapus semua proses pengerjaan terlebih dahulu !');	window.location='../index.php?page=pembuatan_spk2&id=$_GET[id]'
		</script>";
		}

?>
