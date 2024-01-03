<?php
if (isset($_GET['id_hapus'])) {
	$delete = mysqli_query($koneksi, "delete from tb_teknisi where id=".$_GET['id_hapus']."");
	if ($delete) {
		echo "<script>window.location='index.php?page=teknisi'</script>";
		}
	else {
		echo "<script type='text/javascript'>alert('Maaf , Data Teknisi Ini Tidak Dapat Di Hapus');
		window.location='index.php?page=teknisi';
		</script>";
		}
	}
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
          <div class="box box-success">
          <div class="box-footer">
            <div class="box-body table-responsive no-padding">
              <div class="">
              <a href="index.php?page=tambah_teknisi"><input type="submit" name="button" id="button" value="Tambah Teknisi" class="btn btn-success"/></a><br /><br />
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td align="center">&nbsp;</td>
      <td><strong>Nama Teknisi</strong></td>
      <td><strong>Bidang</strong></td>
      <td><strong>No STR</strong></td>
      <td><strong>No HP</strong></td>
      <td align="center"><strong>Ijazah</strong></td>
      <td align="center"><strong>Sertifikat</strong></td>
      <td><strong>Username</strong></td>
      <td><strong>Password</strong></td>
      
      <td align="center"><strong>Aksi</strong></td>
      </tr>
  </thead>
  <?php
  if (isset($_POST['nama_teknisi'])) { 
  $cari=$_POST['nama_teknisi'];
  $query = mysqli_query($koneksi, "select * from tb_teknisi where nama_teknisi like '%$cari%' order by nama_teknisi ASC");
  }
  else if (isset($_POST['bidang'])) { 
  $cari=$_POST['bidang'];
  $query = mysqli_query($koneksi, "select * from tb_teknisi where bidang like '%$cari%' order by nama_teknisi ASC");
  }
  else if (isset($_POST['no_hp'])) { 
  $cari=$_POST['no_hp'];
  $query = mysqli_query($koneksi, "select * from tb_teknisi where no_hp like '%$cari%' order by nama_teknisi ASC");
  }
   else {
	  $query = mysqli_query($koneksi, "select * from tb_teknisi order by nama_teknisi ASC");
	  }
  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td><?php echo $data['nama_teknisi']; ?></td>
    <td><?php echo $data['bidang']; ?></td>
    <td><?php echo $data['no_str']; ?></td>
    <td><?php echo $data['no_hp']; ?></td>
    <td align="center">
    <a href="ijazah_teknisi/<?php echo $data['ijazah']; ?>" target="_blank"><img src="ijazah_teknisi/<?php echo $data['ijazah']; ?>" width="50px" /></a>
    </td>
    <td align="center"><a href="ijazah_teknisi/sertifikat/<?php echo $data['sertifikat']; ?>" target="_blank"><img src="ijazah_teknisi/sertifikat/<?php echo $data['sertifikat']; ?>" width="50px" /></a></td>
    <td><?php echo $data['username']; ?></td>
    <td><?php echo "******"; ?></td>
    
    <td align="center"><a href="index.php?page=teknisi&id_hapus=<?php echo $data['id']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a> &nbsp;&nbsp;<a href="index.php?page=ubah_teknisi&id=<?php echo $data['id']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a> &nbsp;&nbsp; 
	
    </td>
  </tr>
  <?php } ?>
</table>
              </div>
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