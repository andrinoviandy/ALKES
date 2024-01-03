<?php
if (isset($_POST['tambah_header'])) {
	$Result = mysqli_query($koneksi, "insert into deposit values('','".$_POST['tgl_deposit']."','".$_POST['dari_akun']."','".$_POST['ke_akun']."','".str_replace(".","",$_POST['nominal'])."','".$_POST['deskripsi']."')");
	if ($Result) {
		$nom = str_replace(".","",$_POST['nominal']);
		$up1 = mysqli_query($koneksi, "update buku_kas set saldo=saldo-$nom where id=".$_POST['dari_akun']."");
		$up2 = mysqli_query($koneksi, "update buku_kas set saldo=saldo+$nom where id=".$_POST['ke_akun']."");
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Simpan !');
		window.location='index.php?page=deposit'
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="active">Tambah Deposit</span></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Deposit</li>
        <li class="active">Tambah Deposit</li>
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
              <h3 class="box-title">Tambah <span class="active">Deposit</span></h3>
            </div>
              <div class="box-body">
              <form method="post">
              <label>Tgl Deposit</label>
              <input name="tgl_deposit" class="form-control" type="date" placeholder="" value=""><br />
             <label>Dari Akun</label>
              <select name="dari_akun" id="dari_akun" class="form-control select2" required style="width:100%">
              <option value="">...</option>
              <?php
              $q = mysqli_query($koneksi, "select * from buku_kas order by no_akun ASC");
			  while ($d=mysqli_fetch_array($q)) {
			  ?>
              <option value="<?php echo $d['id']; ?>"><?php echo $d['no_akun']." | &nbsp;&nbsp;".$d['nama_akun']; ?></option>
              <?php } ?>
              </select><br /><br />
             <label>Ke Akun</label>
              <select name="ke_akun" id="ke_akun" class="form-control select2" required style="width:100%">
              <option value="">...</option>
              <?php
              $q = mysqli_query($koneksi, "select * from buku_kas order by no_akun ASC");
			  while ($d=mysqli_fetch_array($q)) {
			  ?>
              <option value="<?php echo $d['id']; ?>"><?php echo $d['no_akun']." | &nbsp;&nbsp;".$d['nama_akun']; ?></option>
              <?php } ?>
              </select><br /><br />
              <label>Nominal</label>
              <input name="nominal" class="form-control" type="text" placeholder="" value="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"><br />
              <label>Deskripsi</label>
              <textarea name="deskripsi" class="form-control" rows="4"></textarea><br />
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
  