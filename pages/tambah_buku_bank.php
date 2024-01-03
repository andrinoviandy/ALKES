<?php
if (isset($_POST['tambah_header'])) {
	$Result = mysqli_query($koneksi, "insert into buku_kas values('','".$_POST['no_akun']."','".$_POST['nama_akun']."','".$_POST['akun_tipe']."','".$_POST['saldo']."')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Simpan !');
		window.location='index.php?page=buku_bank'
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="active">Tambah Rek. Bank</span></h1><ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Rek. Bank</li>
        <li class="active">Tambah Rek. Bank</li>
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
              <h3 class="box-title">Tambah <span class="active">Rek. Bank</span></h3>
            </div>
              <div class="box-body">
              <form method="post">
              <label>No. Akun</label>
              <input name="no_akun" class="form-control" type="text" placeholder="" value=""><br />
              <label>Nama Akun</label>
              <input name="nama_akun" class="form-control" type="text" placeholder="" value=""><br />
              <label>Tipe Akun</label>
              <input name="akun_tipe" class="form-control" type="text" placeholder="" value="BANK" readonly="readonly"><br />
              
              <input name="saldo" class="form-control" type="hidden" placeholder="" value="0" readonly="readonly"><br />
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
  