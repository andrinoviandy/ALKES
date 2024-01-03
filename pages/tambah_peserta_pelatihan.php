<?php
$data=mysqli_fetch_array(mysqli_query($koneksi, "select banyak_peserta from alat_pelatihan where id=".$_GET['id'].""));

if (isset($_POST['tambah_laporan'])) {
	$peserta='';
	for ($i=0; $i<$data['banyak_peserta']; $i++) {
		$peserta=$_POST['peserta'][$i].",".$peserta;
		$dat=$peserta;
		}
	$Result = mysqli_query($koneksi, "update peserta_pelatihan set nama_peserta='".$dat."' where alat_pelatihan_id=".$_GET['id']."");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Success !');
		window.location='index.php?page=pelatihan_alat';
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Peserta
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="index.php?page=barang_masuk">Peserta Pelatihan</a></li>
        <li class="active">Tambah</li></ol></section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Peserta Pelatihan</h3>
            </div>
              <div class="box-body">
              <form method="post">
              <?php 
			  for ($i=0; $i<$data['banyak_peserta']; $i++) {
			  $query_data = mysqli_fetch_array(mysqli_query($koneksi, "select * from peserta_pelatihan where pelatihan_alat_id=".$_GET['id'].""));
 
  $pecah=explode(",",$query_data['nama_peserta']);
			  ?>
              <input name="peserta[]" class="form-control" type="text" required placeholder="Nama Peserta Ke-<?php echo $i+1; ?>" autofocus="autofocus" value="<?php echo $pecah[$i]; ?>" /><br />
              <?php } ?>
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button>
              <br /><br />
              </form>
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
  