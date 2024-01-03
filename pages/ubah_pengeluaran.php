<?php
if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "update pengeluaran set tgl_pengeluaran='".$_POST['tgl']."',kebutuhan='".str_replace("\n","<br>",$_POST['kebutuhan'])."', biaya_pengeluaran='".$_POST['biaya']."' where id=".$_GET['id']."");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Biodata Berhasil Di Ubah !');
		window.location='index.php?page=pengeluaran'
		</script>";
		}
	}

$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from pengeluaran where id=".$_GET['id'].""));
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="active">Ubah Pengeluaran</span></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pengeluaran</li>
        <li class="active">Ubah Pengeluaran</li>
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
              <h3 class="box-title">Ubah <span class="active">Pengeluaran</span></h3></div><div class="box-body">
              <form method="post">
              Tanggal
                <label></label>
              <input name="tgl" class="form-control" type="date" required placeholder="" value="<?php echo $data['tgl_pengeluaran']; ?>"><br />
              Kebutuhan
              <label></label>
              <textarea name="kebutuhan" placeholder="" rows="5" cols="" class="form-control"><?php echo str_replace("<br>","\n",$data['kebutuhan']); ?></textarea><br />
              
             Biaya
             <label></label>
              <input name="biaya" class="form-control" type="text" required placeholder="" value="<?php echo $data['biaya_pengeluaran']; ?>"><br />
             <!--<label>Username</label>
              <input name="user" class="form-control" type="text" placeholder="" required value="<?php //echo $data['username']; ?>"><br />
              <label>Password</label>
              <input name="pass" class="form-control" type="password" placeholder="" required value="<?php //echo $data['password']; ?>"><br />-->
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
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box --><!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

  </section>
    <!-- /.content -->
  </div>
  