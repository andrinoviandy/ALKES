<?php include "config/koneksi.php"; ?>
<?php
session_start();
$jam = date("h")+6;
$update = mysqli_query($koneksi, "update riwayat_admin set tgl_jam_keluar='".date("Y-m-d $jam:i:s")."' where id=".$_SESSION['id_riwayat']."");
/*if (isset($_SESSION['user_administrator']) and isset($_SESSION['pass_administrator'])) {
unset($_SESSION['user_administrator']);
unset($_SESSION['pass_administrator']);
}
else if (isset($_SESSION['user_customer']) and isset($_SESSION['pass_customer'])) {
unset($_SESSION['user_customer']);
unset($_SESSION['pass_customer']);
}
else if (isset($_SESSION['user_teknisi']) and isset($_SESSION['pass_teknisi'])) {
unset($_SESSION['user_teknisi']);
unset($_SESSION['pass_teknisi']);
} 
else if (isset($_SESSION['user_admin_gudang']) and isset($_SESSION['pass_admin_gudang'])) {
unset($_SESSION['user_admin_gudang']);
unset($_SESSION['pass_admin_gudang']);
}
else if (isset($_SESSION['user_manajer_gudang']) and isset($_SESSION['pass_manajer_gudang'])) {
unset($_SESSION['user_manajer_gudang']);
unset($_SESSION['pass_manajer_gudang']);
}
else if (isset($_SESSION['user_manajer_gudang']) and isset($_SESSION['pass_manajer_gudang'])) {
unset($_SESSION['user_manajer_gudang']);
unset($_SESSION['pass_manajer_gudang']);
}
else if (isset($_SESSION['user_manajer_gudang']) and isset($_SESSION['pass_manajer_gudang'])) {
unset($_SESSION['user_manajer_gudang']);
unset($_SESSION['pass_manajer_gudang']);
}
else if (isset($_SESSION['user_cs']) and isset($_SESSION['pass_cs'])) {
unset($_SESSION['user_cs']);
unset($_SESSION['pass_cs']);
}*/
session_destroy();
echo "<script type='text/javascript'>
	window.location='login.php';
	</script>";
?>