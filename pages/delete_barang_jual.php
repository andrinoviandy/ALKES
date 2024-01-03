<?php require("../config/koneksi.php"); ?>
<?php
$hap = mysqli_query($koneksi, "delete from barang_dijual_detail where barang_dijual_id=".$_GET['id_hapus']."");
$hapus = mysqli_query($koneksi, "delete from barang_dijual where id=".$_GET['id_hapus']."");
if ($hap and $hapus) {
	
		echo "<script type='text/javascript'>
		alert('Data Berhasil Dihapus !');
		window.location='../index.php?page=jual_barang'
		</script>";
		}
else {
		echo "<script type='text/javascript'>
	alert('Maaf Data Tidak Dapat Dihapus , Silakan Hapus Proses Kirim Terlebih Dahulu !');	
	window.location='../index.php?page=jual_barang'
		</script>";
		}
?>