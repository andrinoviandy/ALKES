<?php require("../config/koneksi.php"); ?>
<?php
$hapus=mysqli_query($koneksi, "delete from aksesoris_alkes where barang_gudang_id=".$_GET['id_hapus']."");
	$del1=mysqli_query($koneksi, "delete from barang_gudang_detail where barang_gudang_id=".$_GET['id_hapus']."");
	$del0=mysqli_query($koneksi, "delete from barang_gudang_po where barang_gudang_id=".$_GET['id_hapus']."");
	$del2=mysqli_query($koneksi, "delete from barang_gudang where id=".$_GET['id_hapus']."");
		if ($del2) {
			echo "<script type='text/javascript'>
			alert('Data Berhasil Dihapus !');
		window.location='../index.php?page=barang_masuk'
		</script>";
			}
		else {
			echo "<script type='text/javascript'>
	alert('Maaf Data Tidak Dapat Dihapus ! Kemungkinan Data Terpakai di PO Pembelian atau Penjualan !');	window.location='../index.php?page=barang_masuk'
		</script>";
			}
		
?>