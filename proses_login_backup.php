<?php include "config/koneksi.php"; ?>
<?php
function getClientIP() {

    if (isset($_SERVER)) {

        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
            return $_SERVER["HTTP_X_FORWARDED_FOR"];

        if (isset($_SERVER["HTTP_CLIENT_IP"]))
            return $_SERVER["HTTP_CLIENT_IP"];

        return $_SERVER["REMOTE_ADDR"];
    }

    if (getenv('HTTP_X_FORWARDED_FOR')) {
        return getenv('HTTP_X_FORWARDED_FOR');
	}

    if (getenv('HTTP_CLIENT_IP')) {
        return getenv('HTTP_CLIENT_IP');
	}

    return getenv('REMOTE_ADDR');
}
?>
<?php
error_reporting(0); 
$user=$_POST['username'];
$pass=md5($_POST['password']);

$query = mysqli_query($koneksi, "select * from admin where username='$user' and password='$pass'");
$total_row = mysqli_num_rows($query);
$d = mysqli_fetch_array($query);
if ($total_row>0) {
	session_start();
	$_SESSION['id']=$d['id'];
	$_SESSION['user_administrator']=$user;
	$_SESSION['pass_administrator']=$pass;
	echo "<script type='text/javascript'>alert('Login Berhasil !');
	window.location='index.php?page=beranda';
	</script>";
	$jam = date("h")+5;
	
	mysqli_query($koneksi, "insert into riwayat_admin values('','$user','".date("Y-m-d $jam:i:s")."','')");
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from riwayat_admin order by id DESC limit 1"));
	//header("location: index.php");
	$_SESSION['id_riwayat']=$sel['id'];
	}
else {
	$queri = mysqli_query($koneksi, "select * from akun_customer where username='$user' and password='$pass'");
$total_roww = mysqli_num_rows($queri);
$data = mysqli_fetch_array($queri);
	if ($total_roww>0) {
		session_start();
		$_SESSION['id']=$data['id'];
		$_SESSION['user_customer']=$user;
		$_SESSION['pass_customer']=$pass; 
		echo "<script type='text/javascript'>alert('Login Berhasil !');
		window.location='index.php?page=beranda';
		</script>";
		$jam = date("h")+5;
	mysqli_query($koneksi, "insert into riwayat_admin values('','$user','".date("Y-m-d $jam:i:s")."','')");
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from riwayat_admin order by id DESC limit 1"));
	//header("location: index.php");
	$_SESSION['id_riwayat']=$sel['id'];
	//header("location: index.php");
		}
	else {
		$querii = mysqli_query($koneksi, "select * from tb_teknisi where username='$user' and password='$pass'");
$total_rowww = mysqli_num_rows($querii);
$dataa = mysqli_fetch_array($querii);
	if ($total_rowww>0) {
		session_start();
		$_SESSION['id_b']=$dataa['id'];
		$_SESSION['user_teknisi']=$user;
		$_SESSION['pass_teknisi']=$pass;
		$_SESSION['teknisi']='teknisi'; 
		echo "<script type='text/javascript'>alert('Login Berhasil !');
		window.location='index.php?page=beranda';
		</script>";
		$jam = date("h")+5;
	mysqli_query($koneksi, "insert into riwayat_admin values('','$user','".date("Y-m-d $jam:i:s")."','')");
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from riwayat_admin order by id DESC limit 1"));
	//header("location: index.php");
	$_SESSION['id_riwayat']=$sel['id'];
	} else {
		$queri3 = mysqli_query($koneksi, "select * from akun_admin_gudang where username='$user' and password='$pass'");
$total_row3 = mysqli_num_rows($queri3);
$data3 = mysqli_fetch_array($queri3);
	if ($total_row3>0) {
		session_start();
		$_SESSION['id']=$data3['id'];
		$_SESSION['user_admin_gudang']=$user;
		$_SESSION['pass_admin_gudang']=$pass;
		$_SESSION['admingudang']='admingudang';
		echo "<script type='text/javascript'>alert('Login Berhasil !');
		window.location='index.php?page=beranda';
		</script>";
		$jam = date("h")+5;
	mysqli_query($koneksi, "insert into riwayat_admin values('','$user','".date("Y-m-d $jam:i:s")."','')");
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from riwayat_admin order by id DESC limit 1"));
	//header("location: index.php");
	$_SESSION['id_riwayat']=$sel['id'];
	} else {
		$queri4 = mysqli_query($koneksi, "select * from akun_admin_teknisi where username='$user' and password='$pass'");
$total_row4 = mysqli_num_rows($queri4);
$data4 = mysqli_fetch_array($queri4);
	if ($total_row4>0) {
		session_start();
		$_SESSION['id']=$data4['id'];
		$_SESSION['user_admin_teknisi']=$user;
		$_SESSION['pass_admin_teknisi']=$pass;
		$_SESSION['adminteknisi']='adminteknisi'; 
		echo "<script type='text/javascript'>alert('Login Berhasil !');
		window.location='index.php?page=beranda';
		</script>";
		$jam = date("h")+5;
	mysqli_query($koneksi, "insert into riwayat_admin values('','$user','".date("Y-m-d $jam:i:s")."','')");
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from riwayat_admin order by id DESC limit 1"));
	//header("location: index.php");
	$_SESSION['id_riwayat']=$sel['id'];
		} 
	else {
		$queri5 = mysqli_query($koneksi, "select * from akun_admin_keuangan where username='$user' and password='$pass'");
$total_row5 = mysqli_num_rows($queri5);
$data5 = mysqli_fetch_array($queri5);
	if ($total_row5>0) {
		session_start();
		$_SESSION['id']=$data5['id'];
		$_SESSION['user_admin_keuangan']=$user;
		$_SESSION['pass_admin_keuangan']=$pass;
		$_SESSION['adminkeuangan']='adminkeuangan'; 
		echo "<script type='text/javascript'>alert('Login Berhasil !');
		alert('Update Kurs Mata Uang Untuk Hari Ini');
		window.location='index.php?page=mata_uang';
		</script>";
		$jam = date("h")+5;
	mysqli_query($koneksi, "insert into riwayat_admin values('','$user','".date("Y-m-d $jam:i:s")."','')");
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from riwayat_admin order by id DESC limit 1"));
	//header("location: index.php");
	$_SESSION['id_riwayat']=$sel['id'];
		} 
	else {
		$queri6 = mysqli_query($koneksi, "select * from admin_po_luar where username='$user' and password='$pass'");
$total_row6 = mysqli_num_rows($queri6);
$data6 = mysqli_fetch_array($queri6);
	if ($total_row6>0) {
		session_start();
		$_SESSION['id']=$data6['id'];
		$_SESSION['user_admin_po_luar']=$user;
		$_SESSION['pass_admin_po_luar']=$pass;
		$_SESSION['adminpoluar']='adminpoluar'; 
		echo "<script type='text/javascript'>alert('Login Berhasil !');
		window.location='index.php?page=beranda';
		</script>";
		$jam = date("h")+5;
	mysqli_query($koneksi, "insert into riwayat_admin values('','$user','".date("Y-m-d $jam:i:s")."','')");
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from riwayat_admin order by id DESC limit 1"));
	//header("location: index.php");
	$_SESSION['id_riwayat']=$sel['id'];
		} 
		else {
			$queri7 = mysqli_query($koneksi, "select * from admin_po_dalam where username='$user' and password='$pass'");
$total_row7 = mysqli_num_rows($queri7);
$data7 = mysqli_fetch_array($queri7);
	if ($total_row7>0) {
		session_start();
		$_SESSION['id']=$data7['id'];
		$_SESSION['user_admin_po_dalam']=$user;
		$_SESSION['pass_admin_po_dalam']=$pass;
		$_SESSION['adminpodalam']='adminpodalam'; 
		echo "<script type='text/javascript'>alert('Login Berhasil !');
		window.location='index.php?page=beranda';
		</script>";
		$jam = date("h")+5;
	mysqli_query($koneksi, "insert into riwayat_admin values('','$user','".date("Y-m-d $jam:i:s")."','')");
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from riwayat_admin order by id DESC limit 1"));
	//header("location: index.php");
	$_SESSION['id_riwayat']=$sel['id'];
		} else {
			$queri7 = mysqli_query($koneksi, "select * from akun_manajer_gudang where username='$user' and password='$pass'");
$total_row7 = mysqli_num_rows($queri7);
$data7 = mysqli_fetch_array($queri7);
	if ($total_row7>0) {
		session_start();
		$_SESSION['id']=$data7['id'];
		$_SESSION['user_manajer_gudang']=$user;
		$_SESSION['pass_manajer_gudang']=$pass;
		$_SESSION['adminmanajergudang']='adminmanajergudang'; 
		echo "<script type='text/javascript'>alert('Login Berhasil !');
		window.location='index.php?page=beranda';
		</script>";
		$jam = date("h")+5;
	mysqli_query($koneksi, "insert into riwayat_admin values('','$user','".date("Y-m-d $jam:i:s")."','')");
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from riwayat_admin order by id DESC limit 1"));
	//header("location: index.php");
	$_SESSION['id_riwayat']=$sel['id'];
		} else {
			$queri7 = mysqli_query($koneksi, "select * from akun_manajer_teknisi where username='$user' and password='$pass'");
$total_row7 = mysqli_num_rows($queri7);
$data7 = mysqli_fetch_array($queri7);
	if ($total_row7>0) {
		session_start();
		$_SESSION['id']=$data7['id'];
		$_SESSION['user_manajer_teknisi']=$user;
		$_SESSION['pass_manajer_teknisi']=$pass;
		$_SESSION['adminmanajerteknisi']='adminmanajerteknisi'; 
		echo "<script type='text/javascript'>alert('Login Berhasil !');
		window.location='index.php?page=beranda';
		</script>";
		$jam = date("h")+5;
	mysqli_query($koneksi, "insert into riwayat_admin values('','$user','".date("Y-m-d $jam:i:s")."','')");
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from riwayat_admin order by id DESC limit 1"));
	//header("location: index.php");
	$_SESSION['id_riwayat']=$sel['id'];
		} else {
			$queri7 = mysqli_query($koneksi, "select * from akun_manajer_keuangan where username='$user' and password='$pass'");
$total_row7 = mysqli_num_rows($queri7);
$data7 = mysqli_fetch_array($queri7);
	if ($total_row7>0) {
		session_start();
		$_SESSION['id']=$data7['id'];
		$_SESSION['user_manajer_keuangan']=$user;
		$_SESSION['pass_manajer_keuangan']=$pass;
		$_SESSION['adminmanajerkeuangan']='adminmanajerkeuangan'; 
		echo "<script type='text/javascript'>alert('Login Berhasil !');
		window.location='index.php?page=beranda';
		</script>";
		$jam = date("h")+5;
	mysqli_query($koneksi, "insert into riwayat_admin values('','$user','".date("Y-m-d $jam:i:s")."','')");
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from riwayat_admin order by id DESC limit 1"));
	//header("location: index.php");
	$_SESSION['id_riwayat']=$sel['id'];
		} else {
			$queri7 = mysqli_query($koneksi, "select * from akun_cs where username='$user' and password='$pass'");
$total_row7 = mysqli_num_rows($queri7);
$data7 = mysqli_fetch_array($queri7);
	if ($total_row7>0) {
		session_start();
		$_SESSION['id']=$data7['id'];
		$_SESSION['user_cs']=$user;
		$_SESSION['pass_cs']=$pass;
		$_SESSION['admincs']='admincs'; 
		echo "<script type='text/javascript'>alert('Login Berhasil !');
		window.location='index.php?page=beranda';
		</script>";
		$jam = date("h")+5;
	mysqli_query($koneksi, "insert into riwayat_admin values('','$user','".date("Y-m-d $jam:i:s")."','')");
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from riwayat_admin order by id DESC limit 1"));
	//header("location: index.php");
	$_SESSION['id_riwayat']=$sel['id'];
		} else {
		$queri7 = mysqli_query($koneksi, "select * from pjt where username='$user' and password='$pass'");
$total_row7 = mysqli_num_rows($queri7);
$data7 = mysqli_fetch_array($queri7);
	if ($total_row7>0) {
		session_start();
		$_SESSION['id']=$data7['id'];
		$_SESSION['user_pjt']=$user;
		$_SESSION['pass_pjt']=$pass;
		$_SESSION['adminpjt']='adminpjt'; 
		echo "<script type='text/javascript'>alert('Login Berhasil !');
		window.location='index.php?page=beranda';
		</script>";
		$jam = date("h")+5;
	mysqli_query($koneksi, "insert into riwayat_admin values('','$user','".date("Y-m-d $jam:i:s")."','')");
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from riwayat_admin order by id DESC limit 1"));
	//header("location: index.php");
	$_SESSION['id_riwayat']=$sel['id'];
		} else {
		echo "<script type='text/javascript'>alert('Username Atau Password Salah !');
		window.location='index.php';
		</script>";
		}
		}}}}}
					} 
				}
			}
		}
	}
}
}
?>