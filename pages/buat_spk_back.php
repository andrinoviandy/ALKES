<?php
if (isset($_POST['lapor'])) {
	$simpan_laporan = mysqli_query($koneksi, "insert into tb_maintenance values('','".$_POST['tgl_spk']."','".$_POST['teknisi']."')");
	if ($simpan_laporan) {
		$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_total from tb_maintenance"));
		$q = mysqli_query($koneksi, "select * from tb_laporan_kerusakan_detail where tb_laporan_kerusakan_id=".$_GET['id']."");
		while ($sm = mysqli_fetch_array($q)) {
			$s2=mysqli_query($koneksi, "insert into tb_maintenance_detail values('','".$max['id_total']."','".$sm['id']."','0','0')");
			}
		if ($s2) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Simpan & Otomatis Muncul di Progress Pengerjaan !');
		window.location='index.php?page=pembuatan_spk'
		</script>";}
		}
	}?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Maintenance Kerusakan
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Laporan Kerusakan</li>
        <li class="active">Maintenance Kerusakan</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
<div class="row">
  <div class="col-md-3"><!-- /.box -->

        <!-- iCheck -->
        <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Maintenance Kerusakan</h3>
            </div>
          <div class="box-body">
          	<form method="post">
            Tanggal Mulai Maintenance
            <input name="tgl_spk" type="date" class="form-control" required/><br />
            
           Teknisi
              <select name="teknisi" class="form-control select2" required>
              <option value="">--Pilih--</option>
              <?php 
			  $query_teknisi = mysqli_query($koneksi, "select * from tb_teknisi order by nama_teknisi ASC");
			  while ($data_t = mysqli_fetch_array($query_teknisi)) {
			  ?>
              <option value="<?php echo $data_t['id']; ?>"><?php echo $data_t['nama_teknisi']." - ".$data_t['bidang']; ?></option>
              <?php } ?>
              </select>
            <br /><br />
            	<input name="lapor" type="submit" value="Simpan" class="btn btn-success"/>
            </form>
          </div>
          </div>
          <!-- /.box -->
        </div>
    <!-- /.content -->
  </div>
  </section>
  </div>