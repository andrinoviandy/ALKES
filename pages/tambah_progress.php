
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Tambah Progress</h1>
      <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="">Progress Pengerjaan</a></li>
        <li class="active"><a href="">Detail Progress Pengerjaan</a></li>
        <li class="active">Tambah Progress</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-xs-12">
          <div class="box"><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
            <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-cubes"></i> 
            <?php 
			$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,tb_maintenance.id as idd from tb_laporan_kerusakan,akun_customer,kategori_job,barang_dikirim,barang_dijual,barang_gudang,tb_maintenance,tb_teknisi,pembeli,barang_gudang_detail where akun_customer.id=tb_laporan_kerusakan.akun_customer_id and barang_dikirim.id=tb_laporan_kerusakan.barang_dikirim_id and kategori_job.id=tb_laporan_kerusakan.kategori_job_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual.barang_gudang_detail_id and tb_laporan_kerusakan.id=tb_maintenance.laporan_kerusakan_id and tb_teknisi.id=tb_maintenance.teknisi_id and pembeli.id=barang_dijual.pembeli_id and tb_maintenance.id=".$_GET['id'].""));
			echo $data['nama_brg']." / ".$data['no_seri_brg'];
			?>
            </small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <h3>Teknisi</h3>
            <address>
            <strong><?php echo $data['nama_teknisi']; ?></strong><br>
            <?php echo "Bidang : ".$data['bidang']; ?><br>
            <?php echo "No HP : ".$data['no_hp']; ?><br>
            
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <h3>Detail Barang</h3>
          <address>
            <strong><?php echo $data['nama_brg']; ?></strong><br>
            <?php echo "Merk : ".$data['merk_brg']; ?><br>
            <?php echo "Tipe : ".$data['tipe_brg']; ?><br>
            <?php echo "No Seri : ".$data['no_seri_brg']; ?><br>
            <?php echo "Pelapor : ".$data['nama_user']; ?><br />
            <?php echo "Kepemilikan : ".$data['nama_pembeli']; ?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <h3>Kerusakan</h3>
          <address style="text-align:justify">
            <?php echo "Kategori Kerusakan : ".$data['nama_job']; ?><br />
			<?php echo "Problem : ".$data['problem']; ?>
          </address>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      
      
      <!-- /.row --><!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row">
      <?php 
	  if (isset($_POST['simpan'])) {
		  $queri_simpan= mysqli_query($koneksi, "insert into progress_maintenance values('','".$_GET['id']."','".$_POST['tgl']."','".$_POST['deskripsi_kerusakan']."','".$_POST['deskripsi_perbaikan']."','".$_FILES['lampiran']['name']."')");
		  if ($queri_simpan) {
			  copy($_FILES['lampiran']['tmp_name'], "gambar_progress/".$_FILES['lampiran']['name']);
			  mysqli_query($koneksi, "update tb_maintenance set status_proses=1 where id=".$_GET['id']."");
			  echo "<script type='text/javascript'>
			  alert('Progress Berhasil Di Tambah');
			  window.location='index.php?page=detail_progress&id=$_GET[id]'
			  </script>";
			  }
		  }
	  ?>
      <form method="post" enctype="multipart/form-data">
      <label>Tanggal</label>
        <div class="input-group col-sm-1">
              <span class="input-group-addon"><span class="fa fa-calendar"></span></span><input name="tgl" class="form-control" placeholder="" type="date" required="required" autofocus="autofocus">
        </div><br />
        <label>Deskripsi Kerusakan</label>
        <textarea name="deskripsi_kerusakan" cols="" rows="4" class="form-control" required="required" ></textarea>
       <br />
       <label>Deskripsi Perbaikan</label>
        <textarea name="deskripsi_perbaikan" cols="" rows="4" class="form-control" required="required"></textarea>
        <br />
        <label>Lampiran Photo/Video</label>
        <input name="lampiran" type="file" class="form-control" style="background-color:#CCC"/>
        <br />
        <input class="btn btn-success" name="simpan" type="submit" value="Tambah Progress"/>
        </form>
      </div>
    </section>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        </div>
        </section>
    <!-- /.content -->
  </div>