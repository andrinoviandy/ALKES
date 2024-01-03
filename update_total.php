<?php require("config/koneksi.php"); ?>
<?php
$select = mysqli_query($koneksi, "select * from barang_dijual");
while ($data = mysqli_fetch_array($select)) {
$jml = mysqli_fetch_array(mysqli_query($koneksi, "select sum(harga_jual_saat_itu*qty_jual) as total from barang_dijual_qty where barang_dijual_id=".$data['id']."")); 
$simpan = mysqli_query($koneksi, "update barang_dijual set total_harga=$jml[total]+($jml[total]*ppn_jual/100)-($jml[total]*diskon_jual/100) where barang_dijual.id=$data[id]");
}
if ($simpan) {
	echo "<script>
	alert('Berhasil Di Update');
	history.back();</script>";
	}
	else {
		echo "<script>
	alert('Gagal Di Update');
	</script>";
		}
?>