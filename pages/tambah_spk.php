<?php
if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "insert into tb_spk values('','".$_POST['tgl_spk']."','".$_POST['teknisi']."','".$_POST['id_lapor']."',' ')");
	if ($Result) {
		mysqli_query($koneksi, "update tb_laporan_kerusakan set exp=1 where id=".$_POST['id_lapor']."");
		echo "<script type='text/javascript'>
		alert('SPK Berhasil Dibuat !');
		window.location='index.php?page=pembuatan_spk';
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pembuatan SPK
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="index.php?page=pembuatan_spk">Pembuatan SPK</a></li>
        <li class="active">Tambah Pembuatan SPK</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <?php 
	  $dat = mysqli_num_rows(mysqli_query($koneksi, "select *, tb_laporan_kerusakan.id as idd from tb_laporan_kerusakan,barang,akun where akun.id=barang.id_akun and barang.id=tb_laporan_kerusakan.id_barang and tb_laporan_kerusakan.exp=0 order by barang.nama_barang ASC"));
	  if ($dat==0) {
	  ?>
      <div class="callout callout-warning" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i> Tidak Bisa Menambah SPK</h4>
        Semua Laporan Kerusakan Yang Masuk Sudah Di Buat SPK<br />
        Silakan Tambah Laporan Kerusakan Yang Baru !
        <a href="index.php?page=tambah_laporan" style="color:#06F">Klik Disini</a>
      </div>
      <?php } ?>
   <br />
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Pembuatan SPK</h3>
            </div>
              <div class="box-body">
              <?php if ($dat==0) { $dis="disabled='disabled'"; } ?>
              <form method="post">
              <br />
              <div class="input-group">
              <span class="input-group-addon"><span class="fa fa-calendar"></span></span><input name="tgl_spk" class="form-control" type="date" required <?php echo $dis; ?> autofocus="autofocus"></div><br />
              <div class="input-group">
              <span class="input-group-addon">Nama Barang - Pelapor</span>
              
              <select name="id_lapor" class="form-control" required <?php echo $dis; ?>>
              <option value="">--Pilih--</option>
              <?php 
			  $query_pelapor = mysqli_query($koneksi, "select *, tb_laporan_kerusakan.id as idd from tb_laporan_kerusakan,barang,akun where akun.id=barang.id_akun and barang.id=tb_laporan_kerusakan.id_barang and exp=0 order by barang.nama_barang ASC");
			  while ($data = mysqli_fetch_array($query_pelapor)) {
			  ?>
              <option value="<?php echo $data['idd']; ?>"><?php echo $data['nama_barang']." / ".$data['no_seri']; ?></option>
              <?php } ?>
              </select>	
              </div>
              <br />
              <div class="input-group">
              <span class="input-group-addon">Teknisi</span>
              <select name="teknisi" class="form-control" required <?php echo $dis; ?>>
              <option value="">--Pilih--</option>
              <?php 
			  $query_teknisi = mysqli_query($koneksi, "select * from tb_teknisi order by nama_teknisi ASC");
			  while ($data_t = mysqli_fetch_array($query_teknisi)) {
			  ?>
              <option value="<?php echo $data_t['id']; ?>"><?php echo $data_t['nama_teknisi']." - ".$data_t['bidang']; ?></option>
              <?php } ?>
              </select></div><br />
              
              <input type="submit" name="tambah_laporan" id="button" value="Buat SPK" class="btn btn-success" <?php echo $dis; ?>/><br /><br />
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