<?php
if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "insert into mata_uang values('','".$_POST['jenis_mu']."','".$_POST['simbol']."','".$_POST['negara_mu']."','".$_POST['dalam_rupiah']."','".$_POST['exp_time']."')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Mata Uang Berhasil Di Tambah !');
		window.location='index.php?page=mata_uang'
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="active">Tambah Mata Uang</span></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Mata Uang</li>
        <li class="active">Tambah Mata Uang</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah <span class="active">Mata Uang</span></h3>
            </div>
              <div class="box-body">
              <form method="post">
              <label>Mata Uang</label>
              <input name="jenis_mu" class="form-control" type="text" required placeholder="Mata Uang"><br />
             <label>Simbol</label>
              <input name="simbol" class="form-control" type="text" required placeholder="Copy kan SIMBOL Disini"><br />
              <label>Negara</label>
              <input name="negara_mu" class="form-control" type="text" required placeholder="Negara"><br />
              Satuan Dalam Rupiah
             <input name="dalam_rupiah" class="form-control" type="text" required placeholder="Negara" value=""><br />
              <label>Exp Time</label>
              <input name="exp_time" class="form-control" type="date" required placeholder=""><br />
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
  