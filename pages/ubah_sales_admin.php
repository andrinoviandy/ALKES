<?php
if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "update sales_admin set nama='".$_POST['nama']."', username='".$_POST['user']."', password='".md5($_POST['pass'])."' where id=$_GET[id]");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Ubah !');
		window.location='index.php?page=sales_admin'
		</script>";
		}
	}



$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from sales_admin where id=".$_GET['id'].""));
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Ubah Sales Admin</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pengaturan</li>
        <li class="active">Akun</li>
        <li class="active">Ubah Sales Admin</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-4 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Ubah Sales Admin</h3></div><div class="box-body">
              <form method="post">
              <label>Nama</label>
              <input name="nama" class="form-control" type="text" required placeholder="Nama Teknisi" value="<?php echo $data['nama']; ?>"><br />
              <label>Username</label>
              <input name="user" class="form-control" type="text" placeholder="Username" required value="<?php echo $data['username']; ?>"><br />
              <label>Password</label>
              <input name="pass" class="form-control" type="password" placeholder="Password" required value=""><br />
              <input type="submit" name="tambah_laporan" id="button" value="Simpan" class="btn btn-success"/><br /><br />
              </form>
              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        
        <section class="col-lg-4 connectedSortable"></section>
          
          <section class="col-lg-4 connectedSortable"></section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

  </section>
    <!-- /.content -->
  </div>
  
  <div id="openIjazah" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Ubah Ijazah</h3> 
     <form method="post" enctype="multipart/form-data">
     <input id="input" name="ijazah" type="file" style="background-color:#FFF"/>
        <button id="buttonn" name="simpan_ijazah" type="submit">Simpan</button>
    </form>
    </div>
</div>

<div id="openSertifikat" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Ubah Sertifikat</h3> 
     <form method="post" enctype="multipart/form-data">
     <input id="input" name="sertifikat" type="file" style="background-color:#FFF"/>
        <button id="buttonn" name="simpan_sertifikat" type="submit">Simpan</button>
    </form>
    </div>
</div>
  