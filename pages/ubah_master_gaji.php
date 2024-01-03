<?php
$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from gaji where id=".$_GET['id_ubah'].""));

if (isset($_POST['tambah_header'])) {
	$cek = mysqli_num_rows(mysqli_query($koneksi, "select * from gaji"));
	if ($cek==0){
	$id=1;
	} else {
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id)+1 as idd from gaji"));
	$id=$max['idd'];
	}
    $Result = mysqli_query($koneksi, "update gaji set kategori='$_POST[kategori]',nama_gaji='$_POST[nama_gaji]',besar_gaji='".str_replace(".","",$_POST['besar_gaji'])."' where id=".$_GET['id_ubah']."");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Ubah !');
		window.location='index.php?page=master_gaji'
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="active">Ubah Master Gaji</span></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Master Gaji</li>
        <li class="active">Ubah Master Gaji</li></ol></section>


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
              <h3 class="box-title">Ubah Master Gaji</h3>
            </div>
              <div class="box-body">
              <form method="post" enctype="multipart/form-data">
              <label>Kategori</label><br />
              <select name="kategori" class="form-contorl select2" style="width:100%" required autofocus="autofocus">
              <option value="">-- Pilih --</option>
              <option <?php if ($data['kategori']=='Penerimaan'){echo "selected";} ?> value="Penerimaan">Penerimaan</option>
              <option <?php if ($data['kategori']=='Pengeluaran'){echo "selected";} ?> value="Pengeluaran">Pengeluaran</option>
              </select>
             <br /><br />
             <label>Nama Gaji</label>
              <input name="nama_gaji" class="form-control" type="text" placeholder="" value="<?php echo $data['nama_gaji'] ?>" required="required"><br />
              
              <label>Besar Gaji</label>
              <input name="besar_gaji" class="form-control" type="text" placeholder="" size="18" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this); sum();" value="<?php echo number_format($data['besar_gaji'],0,',','.') ?>"><br />
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
  