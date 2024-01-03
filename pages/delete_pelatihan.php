<?php require("../config/koneksi.php"); ?>
<?php
$q = mysqli_fetch_array(mysqli_query($koneksi, "select * from alat_pelatihan where id=".$_GET['id_hapus'].""));
unlink("../gambar_pelatihan/lampiran1/$q[lamp1]");
unlink("../gambar_pelatihan/lampiran2/$q[lamp2]");
$hapus1 = mysqli_query($koneksi, "delete from peserta_pelatihan where alat_pelatihan_id=".$_GET['id_hapus']."");
if ($hapus1) {
	mysqli_query($koneksi, "update alat_uji_detail set status_pelatihan=0 where id=".$q['alat_uji_detail_id']."");
	$hapus = mysqli_query($koneksi, "delete from alat_pelatihan where id=".$_GET['id_hapus']."");
		if ($hapus) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Dihapus !');
		window.location='../index.php?page=pelatihan_alat_lama&id_rumkit=$_GET[id_rumkit]'
		</script>";
		}
else {
		echo "<script type='text/javascript'>
	alert('Maaf Data Tidak Dapat Dihapus !');	window.location='../index.php?page=pelatihan_alat_lama&id_rumkit=$_GET[id_rumkit]'
		</script>";
		}
}
?>