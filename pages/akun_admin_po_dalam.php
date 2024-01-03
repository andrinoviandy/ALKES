<?php
if (isset($_GET['id_hapus'])) {
	$delete = mysqli_query($koneksi, "delete from admin_po_dalam where id=".$_GET['id_hapus']."");
	if ($delete) {
		echo "<script>window.location='index.php?page=akun_admin_po_dalam'</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Admin PO Dalam Negeri
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pengaturan</li>
        <li class="active">Akun</li>
        <li class="active">Admin PO Dalam Negeri</li></ol></section>


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
              <a href="index.php?page=tambah_admin_po_dalam"><input type="submit" name="button" id="button" value="Tambah" class="btn btn-success"/></a><br /><br />
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td align="center">&nbsp;</td>
      <td><strong>Nama</strong></td>
      <td><strong>Username</strong></td>
      <td><strong>Password</strong></td>
      <td align="center"><strong>Aksi</strong></td>
      </tr>
  </thead>
  <?php
  
	  $query = mysqli_query($koneksi, "select * from admin_po_dalam order by nama ASC");
	  
  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td><?php echo $data['nama']; ?></td>
    <td><?php echo $data['username']; ?></td>
    <td><?php echo "************"; ?></td>
    <td align="center"><a href="index.php?page=akun_admin_po_dalam&id_hapus=<?php echo $data['id']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a> &nbsp;&nbsp;<a href="index.php?page=ubah_admin_po_dalam&id=<?php echo $data['id']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a> &nbsp;&nbsp; 
      
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