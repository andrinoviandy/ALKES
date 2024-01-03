
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Tambah Progress <?php $da = mysqli_fetch_array(mysqli_query($koneksi, "select *,tb_maintenance_detail.id as idd from pembeli,kategori_job,tb_laporan_kerusakan,tb_laporan_kerusakan_detail,alat_pelatihan,alat_uji_detail,barang_teknisi_detail,barang_dikirim_detail,barang_gudang_detail,barang_gudang,tb_teknisi,tb_maintenance,tb_maintenance_detail where kategori_job.id=tb_laporan_kerusakan_detail.kategori_job_id and tb_laporan_kerusakan.id=tb_laporan_kerusakan_detail.tb_laporan_kerusakan_id and alat_pelatihan.id=tb_laporan_kerusakan_detail.alat_pelatihan_id and alat_uji_detail.id=alat_pelatihan.alat_uji_detail_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and tb_maintenance.id=tb_maintenance_detail.tb_maintenance_id and tb_teknisi.id=tb_maintenance.teknisi_id and pembeli.id=tb_laporan_kerusakan.pembeli_id and tb_laporan_kerusakan_detail.id=tb_maintenance_detail.tb_laporan_kerusakan_detail_id and tb_maintenance.id=".$_GET['id_detail']."")); echo date("d-m-Y",strtotime($da['tgl_maintenance'])); ?></h1>
      <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="">Progress Perbaikan</a></li>
        <li class="active"><a href="">Detail Progress Perbaikan</a></li>
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
      
      <!-- info row --><!-- /.row -->

      <!-- Table row -->
      
      
      <!-- /.row --><!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row">
      <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">Nama Customer</th>
      <th valign="bottom">Alamat</th>
      <th valign="bottom"><strong>Kontak</strong></th>
      </tr>
  </thead>
  <tr>
    <td><?php echo $da['nama_pembeli']; ?></td>
    <td><?php echo $da['jalan']; ?></td>
    <td><?php echo $da['kontak_rs']; ?></td>
    </tr>
</table>
<table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td><strong><font>Nama Alkes</font></strong></td>
      <td><strong>No Seri/Set</strong></td>
      <td><strong>Garansi</strong></td>
      <td><strong>Kategori</strong></td>
      <td><strong>Problem</strong></td>
      <td><strong>Teknisi</strong></td>
      <td><strong>Kontak Teknisi</strong></td>
      <td><strong>Total Biaya</strong></td>
  
      </tr>
  </thead>
  <?php
  
	  //$query = mysqli_query($koneksi, "select *,tb_laporan_kerusakan.id as idd from tb_laporan_kerusakan,akun_customer,kategori_job,barang_dikirim,barang_dikirim_detail,barang_dijual,barang_dijual_detail,barang_gudang,barang_gudang_detail where akun_customer.id=tb_laporan_kerusakan.akun_customer_id and barang_dikirim_detail.id=tb_laporan_kerusakan.barang_dikirim_detail_id and kategori_job.id=tb_laporan_kerusakan.kategori_job_id and barang_dijual_detail.id=barang_dikirim_detail.barang_dijual_detail_id and barang_dijual.id=barang_dijual_detail.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual_detail.barang_gudang_detail_id order by tb_laporan_kerusakan.tgl_lapor ".$limiter['urut']." LIMIT ".$limiter['limiter']."");
	  $query = mysqli_query($koneksi, "select *,tb_maintenance_detail.id as idd from kategori_job,tb_laporan_kerusakan,tb_laporan_kerusakan_detail,alat_pelatihan,alat_uji_detail,barang_teknisi_detail,barang_dikirim_detail,barang_gudang_detail,barang_gudang,tb_teknisi,tb_maintenance,tb_maintenance_detail where kategori_job.id=tb_laporan_kerusakan_detail.kategori_job_id and tb_laporan_kerusakan.id=tb_laporan_kerusakan_detail.tb_laporan_kerusakan_id and alat_pelatihan.id=tb_laporan_kerusakan_detail.alat_pelatihan_id and alat_uji_detail.id=alat_pelatihan.alat_uji_detail_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and tb_maintenance.id=tb_maintenance_detail.tb_maintenance_id and tb_teknisi.id=tb_maintenance.teknisi_id and tb_laporan_kerusakan_detail.id=tb_maintenance_detail.tb_laporan_kerusakan_detail_id and tb_maintenance.id=".$_GET['id_detail']." and tb_maintenance_detail.id=".$_GET['id_alkes']."");

  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td><?php echo $data['nama_brg']; ?></td>
    <td><?php echo $data['no_seri_brg']." ".$data['nama_set']; ?></td>
    <td><?php echo $data['status_garansi']; ?></td>
    <td><?php echo $data['nama_job']; ?></td>
    <td><?php echo $data['problem']; ?></td>
    <td><?php echo $data['nama_teknisi']; ?></td>
    <td><?php echo $data['no_hp']; ?></td>
    <td><?php echo number_format($data['total_biaya_maintenance'],0,',','.'); ?></td>
    
    </tr>
  <?php } ?>
</table>
      <?php 
	  if (isset($_POST['simpan'])) {
		  $queri_simpan= mysqli_query($koneksi, "insert into progress_maintenance values('','".$_GET['id_alkes']."','".$_POST['tgl']."','".$_POST['deskripsi_kerusakan']."','".$_POST['deskripsi_perbaikan']."','".$_FILES['lampiran']['name']."')");
		  if ($queri_simpan) {
			  copy($_FILES['lampiran']['tmp_name'], "gambar_progress/".$_FILES['lampiran']['name']);
			  //mysqli_query($koneksi, "update tb_maintenance_detail set status_proses=1 where id=".$_GET['id_alkes']."");
			  echo "<script type='text/javascript'>
			  alert('Progress Berhasil Di Tambah'); window.location='index.php?page=progress_pengerjaan4&id_alkes=$_GET[id_alkes]&id_detail=$_GET[id_detail]&id=$_GET[id]'
			  </script>";
			  }
		  }
	  ?>
      <br /><h3 align="center">Tambah Progress</h3><br />
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