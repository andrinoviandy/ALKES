<?php
if (isset($_GET['id_hapus'])) {
	$delete = mysqli_query($koneksi, "delete from akun where id=".$_GET['id_hapus']."");
	if ($delete) {
		echo "<script>window.location='index.php?page=akun_teknisi'</script>";
		}
	else {
		echo "<script type='text/javascript'>alert('Maaf , Data Teknisi Ini Tidak Dapat Di Hapus');
		window.location='index.php?page=akun_teknisi';
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Akun Teknisi
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pengaturan</li>
        <li class="active">Akun</li>
        <li class="active">Teknisi</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
              <div class="input-group col-lg-12">
              <a href="index.php?page=tambah_akun_teknisi"><input type="submit" name="button" id="button" value="Tambah Akun Teknisi" class="btn btn-success"/></a><br /><br />
                <table width="100%" id="example2" class="table table-bordered table-hover">
  <thead>
  <tr>
    <td align="center">&nbsp;</td>
    <td><strong>Nama <span class="active">Lengkap</span></strong></td>
    <td><strong>Username</strong></td>
    <td><strong>Password</strong></td>
    
    <td align="center"><strong>Aksi</strong></td>
  </tr>
  </thead>
  <thead>
  <tr>
    <td align="center"><strong>#</strong></td>
      <td>
        <form method="post"><input type="text" name="nama" id="textfield" class="form-control" placeholder=""></form></td>
      <td><form method="post"><input type="text" name="user" id="textfield" class="form-control"></form></td>
      <td><form method="post"><input type="text" name="pass" id="textfield4" class="form-control" placeholder="Password(Full Text)"></form></td>
      
      <td align="center"></td>
  </tr>
  </thead>
  <?php
  if (isset($_POST['nama'])) { 
  $cari=$_POST['nama'];
  $query = mysqli_query($koneksi, "select * from akun where jenis_akun=1 and nama like '%$cari%' order by nama ASC");
  }
  else if (isset($_POST['user'])) { 
  $cari=$_POST['user'];
  $query = mysqli_query($koneksi, "select * from akun where jenis_akun=1 and username like '%$cari%' order by nama ASC");
  }
  else if (isset($_POST['pass'])) { 
  $cari=md5($_POST['pass']);
  $query = mysqli_query($koneksi, "select * from akun where jenis_akun=1 and password like '%$cari%' order by nama ASC");
  }
   else {
	  $query = mysqli_query($koneksi, "select * from akun where jenis_akun=1 order by nama ASC");
	  }
  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td><?php echo $data['nama']; ?></td>
    <td><?php echo $data['username']; ?></td>
    <td><?php echo "***********"; ?></td>
    
    <td align="center"><a href="index.php?page=akun_teknisi&id_hapus=<?php echo $data['id']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a> &nbsp;&nbsp;<a href="index.php?page=ubah_akun_teknisi&id=<?php echo $data['id']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a> &nbsp;&nbsp; 
	
    </td>
  </tr>
  <?php } ?>
</table>
              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

          <!-- Map box --><!-- /.box -->

          <!-- solid sales graph --><!-- /.box -->

          <!-- Calendar --><!-- /.box -->

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

  </section>
    <!-- /.content -->
  </div>