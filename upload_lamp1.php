<?php require("config/koneksi.php"); ?>
<?php
$q = mysqli_fetch_array(mysqli_query($koneksi, "select * from alat_uji_detail where id=$_GET[id]"));
	unlink("gambar_fi/instalasi/$q[lampiran_i]");
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id)+1 as maks from alat_uji_detail"));
	$ext = explode(".",$_FILES['lampiran_i']['name']);
	$lamp_i="Instalasi".$max['maks'].".".$ext[1];
	copy($_FILES['lampiran_i']['tmp_name'], "gambar_fi/instalasi/".$lamp_i);
	
	$u1=mysqli_query($koneksi, "update alat_uji_detail set lampiran_i='$lamp_i' where id=$_GET[id]");
	if ($u1) {
		echo "<script type='text/javascript'>
		window.location='index.php?page=ubah_uji&id_rumkit=$_GET[id_rumkit]';
		</script>";
		}