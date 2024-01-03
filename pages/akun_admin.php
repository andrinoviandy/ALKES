<?php
if (isset($_POST['lapor'])) {
	$simpan_laporan = mysqli_query($koneksi, "insert into tb_laporan_kerusakan values('','".$_POST['tgl_lapor']."','".$_GET['id']."','".$_POST['garansi']."','".$_POST['kerusakan']."','".$_POST['lokasi']."','".$_POST['kontak']."','0')");
	if ($simpan_laporan) {
		mysqli_query($koneksi, "update barang set status_lapor=1 where id=".$_GET['id']."");
		echo "<script type='text/javascript'>
		alert('Laporan Kerusakan Berhasil Di Simpan !');
		window.location='index.php?page=laporan_kerusakan'
		</script>";
		}
	}?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pengaturan Akun Admin
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pengaturan</li>
        <li class="active">Akun</li>
        <li class="active">Admin</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
<div class="row">
<div class="col-md-4">
      <div class="box box-success">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="logo.png" alt="User profile picture">

              <h3 class="profile-username text-center">Administrator</h3>

              <p class="text-muted text-center">Pengaturan</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Username</b> <a class="pull-right">**********</a>
                </li>
                <li class="list-group-item">
                  <b>Password</b> <a class="pull-right">************</a>
                </li>
                
              </ul>

             
          </div>
            <!-- /.box-body -->
          </div>
          </div>
          
        <div class="col-md-8"><!-- /.box -->

          <!-- iCheck -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Pengaturan Akun Admin</h3>
            </div>
          <div class="box-body">
          <?php 
		  if (isset($_POST['simpan_perubahan'])) {
			  if ($_POST['pass_baru']==$_POST['ulang_pass_baru']) {
			  $Result = mysqli_query($koneksi,"update admin set username='".$_POST['user_baru']."', password='".md5($_POST['pass_baru'])."' where id=2000");
			  		if ($Result) {
				  		echo "<script type='text/javascript'>alert('Berhasil Diubah !');
				  </script>";
				  		}
			  } else {
				  echo "<script type='text/javascript'>alert('Password Tidak Sama !');</script>";
				  }}
		  
		  $data = mysqli_fetch_array(mysqli_query($koneksi, "select * from admin"));
		  ?>
          	
            <label>Username</label>
            <input name="user_lama" type="text" disabled="disabled" required class="form-control" placeholder="" value="<?php echo $data['username']; ?>"/><br />
            <label>Password</label>
            <input name="pass_lama" type="password" disabled="disabled" required class="form-control" placeholder="" value="<?php echo $data['password']; ?>"/>
            <br />
            <form method="post">
            <label>Username Baru</label>
            <input name="user_baru" type="text" class="form-control" placeholder="" required autofocus="autofocus"/><br />
            <label>Password Baru</label>
            <input name="pass_baru" type="password" class="form-control" placeholder="" required/><br />
            <label>Ulang Password Baru</label>
            <input name="ulang_pass_baru" type="password" class="form-control" placeholder="" required/>
            <br /><input name="simpan_perubahan" type="submit" value="Simpan Perubahan" class="form-control btn btn-success"/>
            </form>
          </div>
          </div>
          <!-- /.box -->
        </div>
    <!-- /.content -->
  </div>
  </section>
  </div>