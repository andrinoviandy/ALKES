<?php 
if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from progress_maintenance where id=".$_GET['id_hapus']."");
	if ($del) {
		echo "<script>
		window.location='index.php?page=progress_pengerjaan4&id_alkes=$_GET[id_alkes]&id_detail=$_GET[id_detail]&id=$_GET[id]';
		</script>";
		}
	}
	
if (isset($_POST['simpan_progress'])) {
		  $queri_simpan= mysqli_query($koneksi, "insert into progress_maintenance values('','".$_GET['id_alkes']."','".$_POST['tgl']."','".$_POST['deskripsi_kerusakan']."','".$_POST['deskripsi_perbaikan']."','".$_FILES['lampiran']['name']."','".str_replace(".","",$_POST['biaya'])."')");
		  if ($queri_simpan) {
			  copy($_FILES['lampiran']['tmp_name'], "gambar_progress/".$_FILES['lampiran']['name']);
			  //mysqli_query($koneksi, "update tb_maintenance_detail set status_proses=1 where id=".$_GET['id_alkes']."");
			  echo "<script type='text/javascript'>
			  alert('Progress Berhasil Di Tambah'); window.location='index.php?page=progress_pengerjaan4&id_alkes=$_GET[id_alkes]&id_detail=$_GET[id_detail]&id=$_GET[id]'
			  </script>";
			  }
		  }
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Progress Perbaikan<u><?php $da = mysqli_fetch_array(mysqli_query($koneksi, "select *,tb_maintenance_detail.id as idd from tb_laporan_kerusakan_cs,tb_laporan_kerusakan_cs_detail,tb_laporan_kerusakan_detail,alat_pelatihan,alat_uji_detail,barang_teknisi_detail,barang_dikirim_detail,barang_gudang_detail,barang_gudang,tb_teknisi,pembeli,tb_maintenance_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and alat_uji_detail.id=alat_pelatihan.alat_uji_detail_id and alat_pelatihan.id=tb_laporan_kerusakan_detail.alat_pelatihan_id and tb_laporan_kerusakan_cs.id=tb_laporan_kerusakan_cs_detail.tb_laporan_kerusakan_cs_id and tb_laporan_kerusakan_cs_detail.id=tb_laporan_kerusakan_detail.tb_laporan_kerusakan_cs_detail_id and tb_teknisi.id=tb_laporan_kerusakan_detail.teknisi_id and pembeli.id=tb_laporan_kerusakan_cs.pembeli_id and tb_laporan_kerusakan_detail.id=tb_maintenance_detail.tb_laporan_kerusakan_detail_id and tb_laporan_kerusakan_cs.id=".$_GET['id_detail']." and pembeli.id=".$_GET['id']." and tb_maintenance_detail.id=".$_GET['id_alkes']."")); ?></u></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Detail Laporan Kerusakan</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-body table-responsive no-padding">
              <div class="">
              
              <!--
              <form method="post" class="">
              <div class="input-group input-group-md col-xs-4 pull pull-right">
                <input type="text" name="cari" placeholder="Keyword....." class="form-control">
                    <span class="input-group-btn">
                      <button type="submit" name="button_cari" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari </button>
                    </span>
              </div>
              </form>
              -->
              <a href="index.php?page=progress_pengerjaan3&id_detail=<?php echo $_GET['id_detail']; ?>&id=<?php echo $_GET['id']; ?>"><button class="btn btn-success">Kembali Ke Halaman Sebelumnya</button></a><br />
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
	  
  ?>
  <tr>
    <td><?php echo $da['nama_brg']; ?></td>
    <td><?php echo $da['no_seri_brg']." ".$data['nama_set']; ?></td>
    <td><?php echo $da['status_garansi']; ?></td>
    <td><?php echo $da['nama_job']; ?></td>
    <td><?php echo $da['problem']; ?></td>
    <td><?php echo $da['nama_teknisi']; ?></td>
    <td><?php echo $da['no_hp']; ?></td>
    <td><?php echo number_format($da['total_biaya_maintenance'],0,',','.'); ?></td>
    
    </tr>
  <?php  ?>
</table>

<br />
<h3 align="center">Detail Progress</h3>
<br />

<a target="_blank" href="cetak_progress.php?id_alkes=<?php echo $_GET['id_alkes']; ?>&id_detail=<?php echo $_GET['id_detail']; ?>&id=<?php echo $_GET['id']; ?>"><button class="btn btn-info"><span class="fa fa-print"></span> &nbsp;Cetak Progress</button></a>
<?php 
	//$d = mysqli_fetch_array(mysqli_query($koneksi, "select * from tb_maintenance_detail.id="));
	if ($da['status_proses']==0) { ?>
<a data-toggle="modal" data-target="#modal-tambah"><button class="btn btn-success pull pull-right"><span class="fa fa-plus"></span> &nbsp;Tambah</button></a>
<!--
<a href="index.php?page=progress_pengerjaan5&id_alkes=<?php echo $_GET['id_alkes']; ?>&id_detail=<?php echo $_GET['id_detail']; ?>&id=<?php echo $_GET['id']; ?>"><button class="btn btn-success"><span class="fa fa-plus"></span> &nbsp;Tambah</button></a>
-->
<?php } ?>
<a data-toggle="modal" data-target="#modal-status"><button class="pull pull-right btn btn-danger" style="margin-right:15px"><span class="fa fa-edit"></span> &nbsp;Ubah Status</button></a><br /><br />
<table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td width="3%"><strong>No</strong></td>
      <td><strong><font>Tanggal Progress</font></strong></td>
      <td><strong>Deskripsi Kerusakan</strong></td>
      <td><strong>Deskripsi Perbaikan</strong></td>
      <td><strong>Lampiran</strong></td>
      <td><strong>Biaya</strong></td>
      <td><strong>Aksi</strong></td>
  
      </tr>
  </thead>
  <?php
  
	  //$query = mysqli_query($koneksi, "select *,tb_laporan_kerusakan.id as idd from tb_laporan_kerusakan,akun_customer,kategori_job,barang_dikirim,barang_dikirim_detail,barang_dijual,barang_dijual_detail,barang_gudang,barang_gudang_detail where akun_customer.id=tb_laporan_kerusakan.akun_customer_id and barang_dikirim_detail.id=tb_laporan_kerusakan.barang_dikirim_detail_id and kategori_job.id=tb_laporan_kerusakan.kategori_job_id and barang_dijual_detail.id=barang_dikirim_detail.barang_dijual_detail_id and barang_dijual.id=barang_dijual_detail.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual_detail.barang_gudang_detail_id order by tb_laporan_kerusakan.tgl_lapor ".$limiter['urut']." LIMIT ".$limiter['limiter']."");
	  $query = mysqli_query($koneksi, "select * from progress_maintenance where tb_maintenance_detail_id=".$_GET['id_alkes']."");

  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo date("d-m-Y",strtotime($data['tgl_progress'])); ?></td>
    <td><?php echo $data['deskripsi_kerusakan']; ?></td>
    <td><?php echo $data['deskripsi_perbaikan']; ?></td>
    <td><?php if ($data['lampiran']!="") { ?>
    <a href="gambar_progress/<?php echo $data['lampiran']; ?>" target="_blank"><img src="gambar_progress/<?php echo $data['lampiran']; ?>" width="50px" /></a>
    <?php } ?></td>
    <td><?php echo number_format($data['biaya'],0,',','.'); ?></td>
    <td>
    <?php 
	//$d = mysqli_fetch_array(mysqli_query($koneksi, "select * from tb_maintenance_detail.id="));
	if ($da['status_proses']==0) { ?>
    <a href="index.php?page=progress_pengerjaan4&id_alkes=<?php echo $_GET['id_alkes']; ?>&id_detail=<?php echo $_GET['id_detail']; ?>&id=<?php echo $_GET['id']; ?>&id_hapus=<?php echo $data['id']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>
    <?php } ?>
    </td>
    
    </tr>
  <?php } ?>
</table>
</div>
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
  
  <?php 
  if (isset($_POST['kirim_barang'])) {
	  if ($_POST['status']==0) {
	  $input = mysqli_query($koneksi, "update tb_maintenance_detail set total_biaya_maintenance='0',status_proses=0 where id=".$_GET['id_alkes']."");
	  		if ($input) {
		  		echo "<script>
				alert('Status Berhasil Di Ubah , Karena Belum Selesai , Biaya Otomatis Akan Menjadi Nol Kembali !'); window.location='index.php?page=progress_pengerjaan4&id_alkes=$_GET[id_alkes]&id_detail=$_GET[id_detail]&id=$_GET[id]'
				</script>";
		  		}
	  	} else {
		$input = mysqli_query($koneksi, "update tb_maintenance_detail set total_biaya_maintenance='".str_replace(".","",$_POST['total_biaya'])."',status_proses=1 where id=".$_GET['id_alkes']."");
		if ($input) {
		  		echo "<script>
				alert('Status Berhasil Di Ubah !'); window.location='index.php?page=progress_pengerjaan4&id_alkes=$_GET[id_alkes]&id_detail=$_GET[id_detail]&id=$_GET[id]'
				</script>";
		  		}
			}
		
	  }
  ?>
  
<div class="modal fade" id="modal-status">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Pilih Status</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <p align="justify">
              <label>Pilih status</label>
     <select id="input" name="status" class="form-control select2" style="width:100%">
     <?php if ($da['status_proses']==0) { ?>
     	<option value="0">Belum Selesai</option>
        <option value="1">Sudah Selesai</option>
        <?php } else { ?>
        <option value="1">Sudah Selesai</option>
        <option value="0">Belum Selesai</option>
        <?php } ?>
     </select>
     <br /><br />
     <label>Total Biaya</label>
     <?php
     $tot = mysqli_fetch_array(mysqli_query($koneksi, "select sum(biaya) as biaya_total from progress_maintenance where tb_maintenance_detail_id=".$_GET['id_alkes'].""));
	 ?>
     <input type="text" id="input" name="total_biaya" readonly="readonly" value="<?php echo number_format($tot['biaya_total'],0,',','.'); ?>"/>
              </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button name="kirim_barang" class="btn btn-danger" type="submit"><span class="fa fa-check"></span> Simpan</button>
              </div>
              </form>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        
        <div class="modal fade" id="modal-tambah">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Tambah Progress</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <p align="justify">
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
        <input name="lampiran" type="file" class="form-control"/>
        <br />
        <label>Biaya</label>
        <input name="biaya" type="text" class="form-control" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"/>
              </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button name="simpan_progress" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan</button>
              </div>
              </form>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>