<?php require("config/koneksi.php"); ?>
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
      <h1 align="center">
        Laporan Teknisi
      </h1>
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
              
              <br />
                <table width="100%" border="1" class="table table-bordered table-hover" id="example2">
  <thead>
    <tr>
      <td align="left"><strong>No</strong></td>
      <td align="left"><strong>Nama Teknisi</strong></td>
      <td align="left"><strong>Bidang</strong></td>
      <td align="left"><strong>No STR</strong></td>
      <td align="left"><strong>No HP</strong></td>
      <td align="left"><strong>Username</strong></td>
      <td align="left"><strong>Password</strong></td>
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
  else if (isset($_POST['username'])) { 
  $cari=$_POST['username'];
  $query = mysqli_query($koneksi, "select * from tb_teknisi where username like '%$cari%' order by nama_teknisi ASC");
  }
  else if (isset($_POST['password'])) { 
  $cari=md5($_POST['password']);
  $query = mysqli_query($koneksi, "select * from tb_teknisi where password like '%$cari%' order by nama_teknisi ASC");
  }
   else {
	  $query = mysqli_query($koneksi, "select * from tb_teknisi order by nama_teknisi ASC");
	  }
  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="left"><?php echo $no; ?></td>
    <td align="left"><?php echo $data['nama_teknisi']; ?></td>
    <td align="left"><?php echo $data['bidang']; ?></td>
    <td align="left"><?php echo $data['no_str']; ?></td>
    <td align="left"><?php echo $data['no_hp']; ?></td>
    <td align="left"><?php echo $data['username']; ?></td>
    <td align="left"><?php echo $data['password']; ?></td>
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