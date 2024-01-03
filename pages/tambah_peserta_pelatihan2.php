<?php
if (isset($_POST['tambah_laporan'])) {
	$peserta='';
	for ($i=0; $i<$_GET['banyak_peserta']; $i++) {
		$peserta=$_POST['peserta'][$i].",".$peserta;
		$dat=$peserta;
		}
	$sql1=mysqli_query($koneksi, "select * from alat_pelatihan_hash where akun_id='".$_SESSION['id']."'");
	while ($data1=mysqli_fetch_array($sql1)) {
		$smp1=mysqli_query($koneksi, "insert into alat_pelatihan values('','".$data1['alat_uji_detail_id']."','".$data1['banyak_peserta']."','".$data1['pelatih']."','".$data1['tgl_pelatihan']."','".$data1['pelatihan_oleh']."','','')");
		mysqli_query($koneksi, "update alat_uji_detail set status_pelatihan=1 where id=".$data1['alat_uji_detail_id']."");
		$sel=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_max from alat_pelatihan"));
		$sel2=mysqli_fetch_array(mysqli_query($koneksi, "select * from peserta_pelatihan_hash where akun_id=".$_SESSION['id'].""));
		$smp2=mysqli_query($koneksi, "insert into peserta_pelatihan values('','".$sel['id_max']."','".$dat."')");
		}
	if ($smp1 and $smp2) {
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
			  for ($i=0; $i<$_GET['banyak_peserta']; $i++) {
			  ?>
              <input name="peserta[]" class="form-control" type="text" required placeholder="Nama Peserta Ke-<?php echo $i+1; ?>" autofocus="autofocus" value="" /><br />
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
  