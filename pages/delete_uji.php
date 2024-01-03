<?php require("../config/koneksi.php"); ?>
<?php
$d = mysqli_fetch_array(mysqli_query($koneksi, "select * from alat_uji_detail where id=$_GET[id_hapus]"));
	 unlink("../gambar_fi/instalasi/$d[lampiran_i]");
	 unlink("../gambar_fi/fungsi/$d[lampiran_f]");
$hapus = mysqli_query($koneksi, "delete from alat_uji_detail where id=".$_GET['id_hapus']."");
if ($hapus) {
		mysqli_query($koneksi, "update barang_teknisi_detail set status_uji=0 where id=$d[barang_teknisi_detail_id]");
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Hapus');
		window.location='../index.php?page=ubah_uji&id_rumkit=$_GET[id_rumkit]'
		</script>";
		}
else {
		echo "<script type='text/javascript'>
	alert('Maaf Data Tidak Dapat Dihapus ! Kemungkinan Masih Ada Data di Pelatihan , Silakan Hapus Dulu di Pelatihan !');	window.location='../index.php?page=ubah_uji&id_rumkit=$_GET[id_rumkit]'
		</script>";
		}
?>