<?php require("config/koneksi.php"); ?>
<?php
if($_POST['id_akse']) {
	$id 			= $_POST['id_akse'];
	$query 		= "select * from barang_gudang_detail where barang_gudang_id=".$id."";
	$results 	= mysqli_query($koneksi, $query);
	$total 		= mysqli_num_rows($results);
	
	if ($total >0) {
		while ($rows = mysqli_fetch_array($results)) {
			echo '<option value="'.$rows['no_seri_brg'].'">'.$rows['no_seri_brg'].'</option>';
		}
	} else {
		echo '<option value="" selected="selected">No Seri Belum Diisi Di Alkes Ini</option>';
	}
}
?>
