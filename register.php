<?php require("config/koneksi.php"); ?>
<?php 
if (isset($_POST['register'])) {
	$Result = mysqli_query($koneksi, "insert into akun_customer values('','".$_POST['nama']."','".$_POST['alamat']."','".$_POST['kontak']."','".$_POST['username']."','".md5($_POST['password'])."')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Simpan ! Silakan Login !');
		window.location='login.php'
		</script>";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ALKES | Register Customer</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link href='logo.png' rel='icon' />
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
  <a href=""><b>Register Customer</b></a></div>
  <div class="login-box-body">
    <p class="login-box-msg"><i>Isi lah Data Dengan Benar !!!</i></p>

    <form method="post">
      <div class="form-group has-feedback">
        <label>Nama Lengkap</label>
        <input name="nama" type="text" class="form-control" placeholder="">
        
      </div>
      <div class="form-group has-feedback">
        <label>Alamat</label>
        <input name="alamat" type="text" class="form-control" placeholder="">
        
      </div>
      <div class="form-group has-feedback">
        <label>Kontak Person</label>
        <input name="kontak" type="text" class="form-control" placeholder="">
        
      </div>
      <div class="form-group has-feedback">
        <label>Username / Email</label>
        <input name="username" type="email" class="form-control" placeholder="">
        
      </div>
      <div class="form-group has-feedback">
        <label>Password</label>
        <input name="password" type="password" class="form-control" placeholder="">
        
      </div>
      <div class="row">
        <div class="col-xs-8">
          <a href="login.php"><u>Back To Login</u></a>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button name="register" type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- /.social-auth-links -->

    <!--<a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a>-->	

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
