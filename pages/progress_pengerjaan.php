<?php
if (isset($_GET['id_hapus_progress'])) {
	$delete = mysqli_query($koneksi, "delete from progress where id_spk=".$_GET['id_hapus_progress']."");
	if ($delete) {
		mysqli_query($koneksi, "update tb_spk set status_proses=0 where id=".$_GET['id_hapus_progress']."");
		echo "<script>window.location='index.php?page=progress_pengerjaan'</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Progress Perbaikan
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Progress Pengerjaan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
      <section class="col-lg-12 connectedSortable">
        <!-- Left col -->
        <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-body table-responsive no-padding">
           
            <!--
            <form method="post">
              <div class="input-group pull pull-left col-xs-1">
                
                <select class="form-control" name="limiterr" style="margin-right:40px">
                <option <?php if ($limiter['limiter']==10) {echo "selected";} ?> value="10">10</option>
                <option <?php if ($limiter['limiter']==50) {echo "selected";} ?> value="50">50</option>
                <option <?php if ($limiter['limiter']==100) {echo "selected";} ?> value="100">100</option>
                <option <?php if ($limiter['limiter']==500) {echo "selected";} ?> value="500">500</option>
                <option <?php if ($limiter['limiter']==1000) {echo "selected";} ?> value="1000">1000</option>
                <?php 
				$total=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang"));
				?>
                <option <?php if ($limiter['limiter']==$total) {echo "selected";} ?> <?php if ($_POST['cari']!='') {echo "selected";} ?> value="<?php echo $total; ?>">All</option>
                </select>
                
                <span class="input-group-btn">
                      <button type="submit" name="button_limit" class="btn btn-default btn-flat"><i class="fa fa-check"></i></button>
                    </span>
                
              </div>
              </form>
              
              <form method="post">
              <div class="input-group pull pull-left col-xs-2">
                
                <select class="form-control" name="urutt" style="margin-right:40px">
                <option <?php if ($limiter['urut']=='ASC') {echo "selected";} ?> value="ASC">Ascending</option>
                <option <?php if ($limiter['urut']=='DESC') {echo "selected";} ?> value="DESC">Descending</option>
                
                </select>
                
                <span class="input-group-btn">
                      <button type="submit" name="button_urut" class="btn btn-default btn-flat"><i class="fa fa-check"></i></button>
                    </span>
                
              </div>
              </form>
              
              <form method="post" class="">
              <div class="input-group input-group-md col-xs-4 pull pull-right">
                <input type="text" name="cari" placeholder="Keyword....." class="form-control">
                    <span class="input-group-btn">
                      <button type="submit" name="button_cari" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari </button>
                    </span>
              </div>
              </form>
              -->
              
              <table width="100%" id="example1" class="table table-bordered table-hover">
                <thead>
    <tr>
      <td align="center">#</td>
      
      <td><strong>Nama Instansi</strong></td>
     
      <td><strong>Alamat</strong></td>
      <td><strong>Kontak</strong></td>
      <td align="center"><strong>Sudah Ada Progress Perbaikan Per Alat</strong></td>
      <td align="center"><strong>Belum Ada Progress Perbaikan Per Alat</strong></td>
      <td align="center"><strong>Banyak Alat</strong></td>
      <td align="center"><strong>Aksi</strong></td>
      </tr>
  </thead>
  <?php
  if (isset($_SESSION['id_b'])) {
	$query = mysqli_query($koneksi, "select *,pembeli.id as idd from pembeli,tb_laporan_kerusakan_cs,tb_laporan_kerusakan_cs_detail,tb_laporan_kerusakan_detail,tb_maintenance_detail,alamat_provinsi,alamat_kecamatan,alamat_kabupaten where pembeli.id=tb_laporan_kerusakan_cs.pembeli_id and tb_laporan_kerusakan_cs.id=tb_laporan_kerusakan_cs_detail.tb_laporan_kerusakan_cs_id and tb_laporan_kerusakan_cs_detail.id=tb_laporan_kerusakan_detail.tb_laporan_kerusakan_cs_detail_id and tb_laporan_kerusakan_detail.id=tb_maintenance_detail.tb_laporan_kerusakan_detail_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and teknisi_id=".$_SESSION['id_b']." group by pembeli.id order by nama_pembeli ASC");
  }
else {
	  $query = mysqli_query($koneksi, "select *,pembeli.id as idd from pembeli,tb_laporan_kerusakan_cs,tb_laporan_kerusakan_cs_detail,tb_laporan_kerusakan_detail,tb_maintenance_detail,alamat_provinsi,alamat_kecamatan,alamat_kabupaten where pembeli.id=tb_laporan_kerusakan_cs.pembeli_id and tb_laporan_kerusakan_cs.id=tb_laporan_kerusakan_cs_detail.tb_laporan_kerusakan_cs_id and tb_laporan_kerusakan_cs_detail.id=tb_laporan_kerusakan_detail.tb_laporan_kerusakan_cs_detail_id and tb_laporan_kerusakan_detail.id=tb_maintenance_detail.tb_laporan_kerusakan_detail_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id group by pembeli.id order by nama_pembeli ASC");
} 
  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    
    <td><?php echo $data['nama_pembeli']; ?></td>
    
    <td><?php echo $data['jalan'].", ".$data['kelurahan_id'].", ".$data['nama_kecamatan'].", ".$data['nama_kabupaten'].", ".$data['nama_provinsi']; ?></td>
    <td><?php echo $data['kontak_rs']; ?></td>
    <td align="center">
    <?php $total1=mysqli_num_rows(mysqli_query($koneksi, "select *,pembeli.id as idd from pembeli,tb_laporan_kerusakan_cs,tb_laporan_kerusakan_cs_detail,tb_laporan_kerusakan_detail,tb_maintenance_detail,progress_maintenance where pembeli.id=tb_laporan_kerusakan_cs.pembeli_id and tb_laporan_kerusakan_cs.id=tb_laporan_kerusakan_cs_detail.tb_laporan_kerusakan_cs_id and tb_laporan_kerusakan_cs_detail.id=tb_laporan_kerusakan_detail.tb_laporan_kerusakan_cs_detail_id and tb_laporan_kerusakan_detail.id=tb_maintenance_detail.tb_laporan_kerusakan_detail_id and tb_maintenance_detail.id=progress_maintenance.tb_maintenance_detail_id and pembeli.id=".$data['idd'].""));
			  echo $total1; ?>
    </td>
    <td align="center">
    <?php $total2=mysqli_num_rows(mysqli_query($koneksi, "select *,pembeli.id as idd from pembeli,tb_laporan_kerusakan_cs,tb_laporan_kerusakan_cs_detail,tb_laporan_kerusakan_detail,tb_maintenance_detail where pembeli.id=tb_laporan_kerusakan_cs.pembeli_id and tb_laporan_kerusakan_cs.id=tb_laporan_kerusakan_cs_detail.tb_laporan_kerusakan_cs_id and tb_laporan_kerusakan_cs_detail.id=tb_laporan_kerusakan_detail.tb_laporan_kerusakan_cs_detail_id and tb_laporan_kerusakan_detail.id=tb_maintenance_detail.tb_laporan_kerusakan_detail_id and pembeli.id=".$data['idd'].""));
			  echo $total2-$total1; ?>
    </td>
    <td align="center"><?php echo $total2 ?></td>
    <td align="center">
    <a href="index.php?page=progress_pengerjaan2&id=<?php echo $data['idd']; ?>"><span data-toggle="tooltip" title="Detail" class="fa fa-caret-square-o-right"></span></a>
    </td>
  </tr>
  <?php } ?>
</table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        </section>
        </div>
        </section>
    <!-- /.content -->
  </div>