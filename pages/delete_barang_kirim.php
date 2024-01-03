<?php require("../config/koneksi.php"); ?>
<?php
$sel = mysqli_query($koneksi, "select * from barang_dikirim_detail where barang_dikirim_id=".$_GET['id_hapus']."");
		while ($d = mysqli_fetch_array($sel)) {
			$up = mysqli_query($koneksi, "update barang_dijual_detail set status_kirim=0 where id=".$d['barang_dijual_detail_id']."");
			}
$hapus = mysqli_query($koneksi, "delete from barang_dikirim_detail where barang_dikirim_id=".$_GET['id_hapus']."");
$hapus1 = mysqli_query($koneksi, "delete from barang_dikirim where id=".$_GET['id_hapus']."");
if ($hapus and $hapus1) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Dihapus !');
		window.location='../index.php?page=kirim_barang'
		</script>";
		}
else {
		echo "<script type='text/javascript'>
	alert('Maaf Data Tidak Dapat Dihapus , Karena Data Sudah Terintegrasi !');	window.location='../index.php?page=kirim_barang'
		</script>";
		}
?>