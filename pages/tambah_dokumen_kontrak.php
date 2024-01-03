<?php
if (isset($_POST['tambah_header'])) {
	$Result = mysqli_query($koneksi, "insert into kontrak values('','".$_POST['tgl_kontrak']."','".$_POST['no_kontrak']."','".$_POST['waktu_kontrak']."','".str_replace(".","",$_POST['tagihan_kontrak'])."')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Simpan !');
		window.location='index.php?page=dokumen_kontrak'
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="active">Tambah Dokumen</span></h1><ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dokumen</li>
        <li class="active">Tambah Dokumen</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-5 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah <span class="active">Dokumen</span></h3>
            </div>
              <div class="box-body">
              <form method="post">
              <label>Tanggal Kontrak</label>
              <input name="tgl_kontrak" class="form-control" type="date" placeholder="" value="" required="required"><br />
              <label>Nomor Kontrak</label>
              <input name="no_kontrak" class="form-control" type="text" placeholder="" value="" required="required"><br />
              <label>Waktu / Deadline Kontrak</label>
              <input name="waktu_kontrak" class="form-control" type="date" placeholder="" value=""><br />
              <label>Nilai Kontrak</label>
              <input name="tagihan_kontrak" class="form-control" type="text" placeholder="" value="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"><br />
              
              <button name="tambah_header" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan</button>
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
  