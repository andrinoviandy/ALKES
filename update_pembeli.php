<?php require("config/koneksi.php"); ?>
<?php

$a1 = mysqli_query($koneksi, "select * from pembeli order by Pembeli_id ASC");
while ($up = mysqli_fetch_array($a1)) {
	$pem = mysqli_fetch_array(mysqli_query($koneksi, "select * from pembeli where id=".$up['pembeli_id'].""));
	$sel = mysqli_query($koneksi, "select * from pembeli order by id ASC");
	while ($pem2 = mysqli_fetch_array($sel)) {
		if ($pem2['nama_pembeli']==$pem['nama_pembeli'] and $pem2['kelurahan_id']==$pem['kelurahan_id'] and $pem2['jalan']==$pem['jalan'] and $pem2['kontak_rs']==$pem['kontak_rs']) {
			$update = mysqli_query($koneksi, "update barang_dijual set pembeli_id=".$pem2['id']."");
			$delete = mysqli_query($koneksi, "delete from pembeli where id!=".$pem2['id']." and nama_pembeli='".$pem['nama_pembeli']."' and kelurahan_id='".$pem['kelurahan_id']."' and jalan='".$pem['jalan']."' and kontak_rs='".$pem['kontak_rs']."'");
			}
		}
	
if ($update and $delete) {
	echo "<script>
	alert('Nama Pembeli Berhasil Di Update');
	history.back();</script>";
	}
	else {
		echo "<script>
	alert('Nama Pembeli Gagal Di Update');
	history.back();</script>";
		}
}
?>