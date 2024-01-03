<?php
if (isset($_POST['tambah_pemusnahan'])) {
	$Result = mysqli_query($koneksi, "insert into pemusnahan values('','".$_POST['tgl']."','".$_POST['disetujui_oleh']."','".$_POST['disiapkan_oleh']."','".$_POST['diperiksa_oleh']."','".$_POST['item']."','".$_POST['jumlah']."','".$_POST['uraian']."','".$_POST['lokasi']."','".$_POST['penanggung_jawab']."','".$_POST['jam_mulai']."','".$_POST['jam_selesai']."')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Pemusnahan Alkes Berhasil Di Tambah !');
		window.location='index.php?page=pemusnahan_alkes'
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pemusnahan
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="index.php?page=pemusnahan_alkes">Pemusnahan</a></li>
        <li class="active"><a href="index.php?page=tambah_pemusnahan">Tambah Pemusnahan Alkes</a></li>
        <li class="active">Dari Luar</li>
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
              <h3 class="box-title">Tambah Data Pemusnahan Alkes</h3>
            </div>
              <div class="box-body">
              <form method="post">
              <label>Tanggal Pemusnahan</label>
              <input name="tgl" class="form-control" type="date" required><br />
              
               <input name="item" class="form-control" type="text" placeholder="Nama Item" required><br />              
              
              <input name="jumlah" class="form-control" type="text" placeholder="Jumlah Unit" required><br />
              
              <input name="uraian" class="form-control" type="text" placeholder="Uraian" required><br />
              
              <input name="lokasi" class="form-control" type="text" placeholder="Lokasi" required><br />
              
              <input name="jam_mulai" class="form-control" type="text" placeholder="Jam Mulai" required><br />
              
              <input name="jam_selesai" class="form-control" type="text" placeholder="Jam Selesai" required><br />
              <input name="penanggung_jawab" class="form-control" type="text" placeholder="Penanggung Jawab" required><br />
              <input name="disetujui_oleh" class="form-control" type="text" placeholder="Disetujui Oleh" required><br />
              <input name="disiapkan_oleh" class="form-control" type="text" placeholder="Disiapkan Oleh" required><br />
              <input name="diperiksa_oleh" class="form-control" type="text" placeholder="Diperiksa Oleh" required><br />
              
              <button name="tambah_pemusnahan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button>
              <br /><br />
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
  