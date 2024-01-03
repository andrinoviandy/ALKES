<center>
<?php 
	if (isset($_GET['paging'])) {
		if ($_GET['paging']==1) {
			echo "Ditampilkan 1 Sampai ".$akh." dari ".$cdata." Data";
			}
		else {
			$sel = mysqli_fetch_array(mysqli_query($koneksi, "select jumlah_limit from limiter"));
			echo "Ditampilkan ".((($_GET['paging']-1)*$sel['jumlah_limit'])+1)." Sampai ".$akh." dari ".$cdata." Data";
			}
	} else {
		echo "Ditampilkan 1 Sampai ".$akh." dari ".$cdata." Data";
		}
	?>
</center>