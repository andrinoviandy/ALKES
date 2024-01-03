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
        Progress Pengerjaan
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
            <font class="pull pull-right">Keterangan : Dalam Kotak <strong>Kuning</strong> Yang berisikan <strong>Angka</strong> , Itu Menandakan Berapa Banyak Proses Yang Dilakukan</font>
            
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
              <br /><br /><br />
              <table id="example1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th align="center"></th>
                  <th>Tanggal Mulai Maintenance</th>
                  <th>Alkes</th>
                  <th>No Seri</th>
                  <th>Teknisi</th>
                  <th>Kerusakan</th>
                  <th>Status Progress</th>
                  <?php if(!isset($_SESSION['user_customer'])) { ?>
                  <th>Aksi</th>
                  <?php } ?>
                </tr>
                </thead>
                
                <?php
				
				if (isset($_SESSION['id_b'])) {
					if (isset($_GET['id_lihat'])) {
					$query = mysqli_query($koneksi, "select *,tb_maintenance.id as idd from tb_maintenance,tb_laporan_kerusakan,akun_customer,kategori_job,tb_teknisi,barang_dikirim,barang_dijual,barang_gudang,barang_gudang_detail where tb_laporan_kerusakan.id=tb_maintenance.laporan_kerusakan_id and tb_teknisi.id=tb_maintenance.teknisi_id and akun_customer.id=tb_laporan_kerusakan.akun_customer_id and kategori_job.id=tb_laporan_kerusakan.kategori_job_id and barang_dikirim.id=tb_laporan_kerusakan.barang_dikirim_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and tb_maintenance.teknisi_id=".$_SESSION['id_b']." and tb_maintenance.id=".$_GET['id_lihat']." order by tb_maintenance.tgl_maintenance ".$limiter['urut']."");
					}
				else {
					$query = mysqli_query($koneksi, "select *,tb_maintenance.id as idd from tb_maintenance,tb_laporan_kerusakan,akun_customer,kategori_job,tb_teknisi,barang_dikirim,barang_dijual,barang_gudang,barang_gudang_detail where tb_laporan_kerusakan.id=tb_maintenance.laporan_kerusakan_id and tb_teknisi.id=tb_maintenance.teknisi_id and akun_customer.id=tb_laporan_kerusakan.akun_customer_id and kategori_job.id=tb_laporan_kerusakan.kategori_job_id and barang_dikirim.id=tb_laporan_kerusakan.barang_dikirim_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and tb_maintenance.teknisi_id=".$_SESSION['id_b']." order by tb_maintenance.tgl_maintenance ".$limiter['urut']." LIMIT ".$limiter['limiter']."");
					}
					}
					
				else if (isset($_SESSION['user_customer'])) {
					if (isset($_GET['id_lihat'])) {
					$query = mysqli_query($koneksi, "select *,tb_maintenance.id as idd from tb_maintenance,tb_laporan_kerusakan,akun_customer,kategori_job,tb_teknisi,barang_dikirim,barang_dijual,barang_gudang,barang_gudang_detail where tb_laporan_kerusakan.id=tb_maintenance.laporan_kerusakan_id and tb_teknisi.id=tb_maintenance.teknisi_id and akun_customer.id=tb_laporan_kerusakan.akun_customer_id and kategori_job.id=tb_laporan_kerusakan.kategori_job_id and barang_dikirim.id=tb_laporan_kerusakan.barang_dikirim_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and akun_customer.id=".$_SESSION['id']." and tb_maintenance.id=".$_GET['id_lihat']." order by tb_maintenance.tgl_maintenance ".$limiter['urut']."");
					}
				else {
					$query = mysqli_query($koneksi, "select *,tb_maintenance.id as idd from tb_maintenance,tb_laporan_kerusakan,akun_customer,kategori_job,tb_teknisi,barang_dikirim,barang_dijual,barang_gudang,barang_gudang_detail where tb_laporan_kerusakan.id=tb_maintenance.laporan_kerusakan_id and tb_teknisi.id=tb_maintenance.teknisi_id and akun_customer.id=tb_laporan_kerusakan.akun_customer_id and kategori_job.id=tb_laporan_kerusakan.kategori_job_id and barang_dikirim.id=tb_laporan_kerusakan.barang_dikirim_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and akun_customer.id=".$_SESSION['id']." order by tb_maintenance.tgl_maintenance ".$limiter['urut']." LIMIT ".$limiter['limiter']."");
					}
					}
				
				
				else { 
				if (isset($_GET['id_lihat'])) {
					$query = mysqli_query($koneksi, "select *,tb_maintenance.id as idd from tb_maintenance,tb_laporan_kerusakan,akun_customer,kategori_job,tb_teknisi,barang_dikirim,barang_dijual,barang_gudang,barang_gudang_detail where tb_laporan_kerusakan.id=tb_maintenance.laporan_kerusakan_id and tb_teknisi.id=tb_maintenance.teknisi_id and akun_customer.id=tb_laporan_kerusakan.akun_customer_id and kategori_job.id=tb_laporan_kerusakan.kategori_job_id and barang_dikirim.id=tb_laporan_kerusakan.barang_dikirim_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and tb_maintenance.id=".$_GET['id_lihat']." order by tb_maintenance.tgl_maintenance ".$limiter['urut']."");
					}
				else {
					$query = mysqli_query($koneksi, "select *,tb_maintenance.id as idd from tb_maintenance,tb_laporan_kerusakan,akun_customer,kategori_job,tb_teknisi,barang_dikirim,barang_dijual,barang_gudang,barang_gudang_detail where tb_laporan_kerusakan.id=tb_maintenance.laporan_kerusakan_id and tb_teknisi.id=tb_maintenance.teknisi_id and akun_customer.id=tb_laporan_kerusakan.akun_customer_id and kategori_job.id=tb_laporan_kerusakan.kategori_job_id and barang_dikirim.id=tb_laporan_kerusakan.barang_dikirim_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id LIMIT ".$limiter['limiter']."");
					}
				}
				$no=0; 
				while ($data = mysqli_fetch_assoc($query))
				{ 
				$no++; 
				?>
                <tr>
                  <td align="center"><?php echo $no; ?></td>
                  <td><?php echo date("d F Y", strtotime($data['tgl_maintenance'])); ?></td>
                  <td><?php echo $data['nama_brg']; ?>
                  <?php 
	$querii=mysqli_num_rows(mysqli_query($koneksi, "select * from progress_maintenance where maintenance_id=".$data['idd'].""));
	if ($querii>0) {
		?>
    <span class="label label-warning pull-right"><?php echo $querii; ?></span>
    <?php } ?>
                  </td>
                  <td><?php echo $data['no_seri_brg']; ?></td>
                  <td><?php echo $data['nama_teknisi']; ?></td>
                  <td><?php echo $data['problem']; ?></td>
                  <td>
                  <?php if ($data['status_proses']==0) { ?>
                  <span class="label label-danger">Belum Dikerjakan</span>
                  <?php } else if ($data['status_proses']==1) { ?>
                  <span class="label label-warning">Sedang Dikerjakan</span></td> <?php } else { ?>
                  <span class="label label-success">Selesai</span>
                  <?php } ?>
                  <?php if(!isset($_SESSION['user_customer'])) { ?>
                  <td align="">
                  <!--
                  <a href="index.php?page=progress_pengerjaan&id_hapus_progress=<?php echo $data['idd']; ?>" onclick="return confirm('Apakah Anda Yakin Akan Menghapus Progress Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>
                  &nbsp;-->
                  <?php if ($data['status_proses']!=2) { ?>
                  <a href="index.php?page=detail_progress&id=<?php echo $data['idd']; ?>"><span data-toggle="tooltip" title="Tambah Progress" class="fa fa-plus"></span></a>
                  <?php } ?>
                  <?php if ($data['status_proses']==2) { ?>
                  
                  &nbsp;
                  <a href="index.php?page=detail_progress&id=<?php echo $data['idd']; ?>"><span data-toggle="tooltip" title="Detail Progress" class="fa fa-eye"></span></a>
                  &nbsp;
                  <a target="_blank" href="cetak_laporan_service.php?id=<?php echo $data['idd']; ?>"><span data-toggle="tooltip" title="Cetak Laporan Service" class="fa fa-print"></span></a>
                  
                  <?php } ?>
                  </td>
                  <?php } ?>
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