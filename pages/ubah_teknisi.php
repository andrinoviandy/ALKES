<?php
if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "update tb_teknisi set nama_teknisi='".$_POST['nama_teknisi']."', bidang='".$_POST['bidang']."', no_str='".$_POST['no_str']."', no_hp='".$_POST['no_hp']."', username='".$_POST['username']."', password='".md5($_POST['password'])."' where id=".$_GET['id']."");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Teknisi Berhasil Di Ubah !');
		window.location='index.php?page=teknisi'
		</script>";
		}
	}
if (isset($_POST['simpan_ijazah'])) {
	$da=mysqli_fetch_array(mysqli_query($koneksi, "select * from tb_teknisi where id=".$_GET['id'].""));
	$go=mysqli_query($koneksi, "update tb_teknisi set ijazah='".$da['nama_teknisi']."-".$_FILES['ijazah']['name']."' where id=".$_GET['id']."");
	if ($go) {
		copy($_FILES['ijazah']['tmp_name'],"ijazah_teknisi/".$da['nama_teknisi']."-".$_FILES['ijazah']['name']);
		echo "<script type='text/javascript'>
		window.location='index.php?page=ubah_teknisi&id=$_GET[id]'
		</script>";
		}
	}

if (isset($_POST['simpan_sertifikat'])) {
	$da=mysqli_fetch_array(mysqli_query($koneksi, "select * from tb_teknisi where id=".$_GET['id'].""));
	$go=mysqli_query($koneksi, "update tb_teknisi set sertifikat='".$da['nama_teknisi']."-".$_FILES['sertifikat']['name']."' where id=".$_GET['id']."");
	if ($go) {
		copy($_FILES['sertifikat']['tmp_name'],"ijazah_teknisi/sertifikat/".$da['nama_teknisi']."-".$_FILES['sertifikat']['name']);
		echo "<script type='text/javascript'>
		window.location='index.php?page=ubah_teknisi&id=$_GET[id]'
		</script>";
		}
	}

$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from tb_teknisi where id=".$_GET['id'].""));
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Teknisi
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pengaturan</li>
        <li class="active">Akun</li>
        <li class="active">Teknisi</li>
        <li class="active">Ubah Teknisi</li>
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
              <h3 class="box-title">Ubah Teknisi</h3>
            </div>
              <div class="box-body">
              <form method="post">
              <label>Nama Teknisi</label>
              <input name="nama_teknisi" class="form-control" type="text" required placeholder="Nama Teknisi" value="<?php echo $data['nama_teknisi']; ?>"><br />
              <label>Bidang</label>
              <input name="bidang" class="form-control" type="text" placeholder="Bidang" required value="<?php echo $data['bidang']; ?>"><br />
              
              <label>No STR</label>
              <input name="no_str" class="form-control" type="text" placeholder="No STR" required value="<?php echo $data['no_str']; ?>"><br />
              
              <label>No HP</label>
              <input name="no_hp" class="form-control" type="text" placeholder="No HP" required value="<?php echo $data['no_hp']; ?>"><br />
              <label>Username</label>
              <input name="username" class="form-control" type="text" placeholder="Username" required value="<?php echo $data['username']; ?>"><br />
              <label>Password</label>
              <input name="password" class="form-control" type="password" placeholder="Password" required value="<?php echo $data['password']; ?>"><br />
              <input type="submit" name="tambah_laporan" id="button" value="Simpan" class="btn btn-success"/><br /><br />
              </form>
              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        
        <section class="col-lg-4 connectedSortable">
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Ijazah</h3>
              <a href="index.php?page=ubah_teknisi&id=<?php echo $_GET['id']; ?>#openIjazah" class="pull-right">Ubah</a>
            </div>
              <div class="box-body">
              <img src="ijazah_teknisi/<?php echo $data['ijazah']; ?>" width="100%" />
              </div>
            </div>
          </div>
          </section>
          
          <section class="col-lg-4 connectedSortable">
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Sertifikat</h3>
              <a href="index.php?page=ubah_teknisi&id=<?php echo $_GET['id']; ?>#openSertifikat" class="pull-right">Ubah</a>
            </div>
              <div class="box-body">
              <img src="ijazah_teknisi/sertifikat/<?php echo $data['sertifikat']; ?>" width="100%" />
              </div>
            </div>
          </div>
          </section>
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
  