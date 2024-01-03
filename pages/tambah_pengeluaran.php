<?php
if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "insert into pengeluaran values('','".$_POST['tgl']."','".str_replace("\n","<br>",$_POST['kebutuhan'])."','".$_POST['biaya']."')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Tambah !');
		window.location='index.php?page=pengeluaran'
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="active">Tambah Pengeluaran</span></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pengeluaran</li>
        <li class="active">Tambah Pengeluaran</li>
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
              <h3 class="box-title">Tambah <span class="active">Pengeluaran</span></h3>
            </div>
              <div class="box-body">
              <form method="post">
              <label>Tanggal</label>
              <input name="tgl" class="form-control" type="date" required placeholder=""><br />
              Kebutuhan
              <label></label>
              <textarea name="kebutuhan" placeholder="- Kebutuhan 1" rows="5" cols="" class="form-control"></textarea>
              <br />
              Biaya
              <label></label>
              <input name="biaya" class="form-control" type="text" required placeholder=""><br />
              
              <input type="submit" name="tambah_laporan" id="button" value="Simpan" class="btn btn-success"/><br /><br />
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
  