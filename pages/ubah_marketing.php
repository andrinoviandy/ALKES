<?php
if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "update marketing set nama_marketing='".$_POST['nama_marketing']."',hp_marketing='".$_POST['no_telp']."', alamat_marketing='".$_POST['alamat']."' where id=".$_GET['id']."");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Berhasil Di Ubah !');
		window.location='index.php?page=marketing'
		</script>";
		}
	}

$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from marketing where id=".$_GET['id'].""));
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="active">Ubah Marketing</span></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Marketing</li>
        <li class="active">Ubah Marketing    </li>
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
              <h3 class="box-title">Ubah <span class="active">Marketing</span></h3>
            </div>
              <div class="box-body">
              <form method="post">
             
               <label>Nama Marketing</label>
              <input name="nama_marketing" class="form-control" type="text" placeholder="" value="<?php echo $data['nama_marketing']; ?>"><br />
             
             <label>No Telp</label>
              <input name="no_telp" class="form-control" type="text" placeholder="" value="<?php echo $data['hp_marketing']; ?>"><br />
             <label>Alamat</label>
              <textarea name="alamat" id="alamat" class="form-control" cols="45" rows="5"><?php echo $data['alamat_marketing']; ?></textarea>
              <br />
              <input type="submit" name="tambah_laporan" id="button" value="Simpan Perubahan" class="btn btn-success"/><br /><br />
              </form>
              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

  </section>
    <!-- /.content -->
  </div>
  