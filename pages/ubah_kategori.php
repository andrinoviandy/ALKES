<?php
$data=mysqli_fetch_array(mysqli_query($koneksi, "select * from kategori_buku_kas where id=$_GET[id]"));
if (isset($_POST['tambah_header'])) {
	$Result = mysqli_query($koneksi, "update kategori_buku_kas set no_kategori='".$_POST['no_akun']."',nama_kategori='".$_POST['nama_akun']."',tipe_kategori='".$_POST['akun_tipe']."',utang_piutang='".$_POST['saldo']."' where id=$_GET[id]");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Simpan !');
		window.location='index.php?page=kategori'
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="active">Tambah Kategori</span></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kategori</li>
        <li class="active">Tambah Kategori</li>
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
              <h3 class="box-title">Tambah <span class="active">Kategori</span></h3>
            </div>
              <div class="box-body">
              <form method="post">
              <label>No. Kategori</label>
              <input name="no_akun" class="form-control" type="text" placeholder="" value="<?php echo $data['no_kategori']; ?>"><br />
              <label>Nama Kategori</label>
              <input name="nama_akun" class="form-control" type="text" placeholder="" value="<?php echo $data['nama_kategori']; ?>"><br />
              <label>Tipe Kategori</label>
              <input name="akun_tipe" class="form-control" type="text" placeholder="" value="<?php echo $data['tipe_kategori']; ?>"><br />
              <label>Hutang/Piutang</label>
              <select name="saldo" class="form-control">
              <option <?php if ($data['utang_piutang']=='Hutang') {echo "selected";} ?> value="Hutang">Hutang</option>
              <option <?php if ($data['utang_piutang']=='Piutang') {echo "selected";} ?> value="Piutang">Piutang</option>
              </select>
              <br />
              <button name="tambah_header" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan Perubahan</button>
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
  