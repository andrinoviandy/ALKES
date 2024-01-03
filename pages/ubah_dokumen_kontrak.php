<?php
$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from kontrak where id=".$_GET['id'].""));

if (isset($_POST['tambah_header'])) {
	$Result = mysqli_query($koneksi, "update kontrak set tgl_kontrak='".$_POST['tgl_kontrak']."',no_kontrak='".$_POST['no_kontrak']."',waktu_kontrak='".$_POST['waktu_kontrak']."',tagihan_kontrak='".str_replace(".","",$_POST['tagihan_kontrak'])."' where id=".$_GET['id']."");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Ubah !');
		window.location='index.php?page=dokumen_kontrak';
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="active">Ubah Dokumen</span></h1><ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dokumen</li>
        <li class="active">Ubah Dokumen</li>
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
              <h3 class="box-title">Ubah <span class="active">Dokumen</span></h3>
            </div>
              <div class="box-body">
              <form method="post">
              <label>Tanggal Kontrak</label>
              <input name="tgl_kontrak" class="form-control" type="date" placeholder="" value="<?php echo $data['tgl_kontrak'] ?>" required="required"><br />
              <label>Nomor Kontrak</label>
              <input name="no_kontrak" class="form-control" type="text" placeholder="" value="<?php echo $data['no_kontrak'] ?>" required="required"><br />
              <label>Waktu / Deadline Kontrak</label>
              <input name="waktu_kontrak" class="form-control" type="date" placeholder="" value="<?php echo $data['waktu_kontrak'] ?>"><br />
              <label>Nilai Kontrak</label>
              <input name="tagihan_kontrak" class="form-control" type="text" placeholder="" value="<?php echo number_format($data['nilai_kontrak'],0,',','.'); ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"><br />
              
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
  