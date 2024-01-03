
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Maintenance Kerusakan
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Maintenance Kerusakan</li>
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
              <!--<a href="index.php?page=tambah_spk">
              <button type="submit" name="button" id="button" class="btn btn-success"><span class="fa fa-clone"></span> Buat SPK</button>
              </a>-->
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
              
                <table id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td align="center">&nbsp;</td>
      <td><strong>Tanggal Mulai Maintenance</strong></td>
      <td><strong>Teknisi</strong></td>
      <td><strong>Pelapor</strong></td>
      <td><strong>Nama Alat / No Seri</strong></td>
      <td><strong>Kerusakan</strong></td>
      <?php if (!isset($_SESSION['user_customer'])) { ?>
      <td align="center"><strong>Aksi</strong></td>
      <?php } ?>
      </tr>
  </thead>
  <?php
  if (isset($_SESSION['id_b'])) {
	  if (isset($_GET['id_lihat'])) {
	  $query = mysqli_query($koneksi, "select *,tb_maintenance.id as idd from tb_maintenance,tb_laporan_kerusakan,akun_customer,kategori_job,tb_teknisi,barang_dikirim,barang_dijual,barang_gudang,barang_gudang_detail where tb_laporan_kerusakan.id=tb_maintenance.laporan_kerusakan_id and tb_teknisi.id=tb_maintenance.teknisi_id and akun_customer.id=tb_laporan_kerusakan.akun_customer_id and kategori_job.id=tb_laporan_kerusakan.kategori_job_id and barang_dikirim.id=tb_laporan_kerusakan.barang_dikirim_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and tb_maintenance.teknisi_id=".$_SESSION['id_b']." and tb_maintenance.laporan_kerusakan_id=".$_GET['id_lihat']." order by tb_maintenance.tgl_maintenance ".$limiter['urut']."");
	  }
  else {
  $query = mysqli_query($koneksi, "select *,tb_maintenance.id as idd from tb_maintenance,tb_laporan_kerusakan,akun_customer,kategori_job,tb_teknisi,barang_dikirim,barang_dijual,barang_gudang,barang_gudang_detail where tb_laporan_kerusakan.id=tb_maintenance.laporan_kerusakan_id and tb_teknisi.id=tb_maintenance.teknisi_id and akun_customer.id=tb_laporan_kerusakan.akun_customer_id and kategori_job.id=tb_laporan_kerusakan.kategori_job_id and barang_dikirim.id=tb_laporan_kerusakan.barang_dikirim_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and tb_maintenance.teknisi_id=".$_SESSION['id_b']." order by tb_maintenance.tgl_maintenance ".$limiter['urut']." LIMIT ".$limiter['limiter']."");
  }
	  }

else if (isset($_SESSION['user_customer']) and isset($_SESSION['pass_customer'])) {
	  if (isset($_GET['id_lihat'])) {
	  $query = mysqli_query($koneksi, "select *,tb_maintenance.id as idd from tb_maintenance,tb_laporan_kerusakan,akun_customer,kategori_job,tb_teknisi,barang_dikirim,barang_dijual,barang_gudang,barang_gudang_detail where tb_laporan_kerusakan.id=tb_maintenance.laporan_kerusakan_id and tb_teknisi.id=tb_maintenance.teknisi_id and akun_customer.id=tb_laporan_kerusakan.akun_customer_id and kategori_job.id=tb_laporan_kerusakan.kategori_job_id and barang_dikirim.id=tb_laporan_kerusakan.barang_dikirim_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and tb_laporan_kerusakan.akun_customer_id=".$_SESSION['id']." and tb_maintenance.laporan_kerusakan_id=".$_GET['id_lihat']." order by tb_maintenance.tgl_maintenance ".$limiter['urut']."");
	  }
  else {
  $query = mysqli_query($koneksi, "select *,tb_maintenance.id as idd from tb_maintenance,tb_laporan_kerusakan,akun_customer,kategori_job,tb_teknisi,barang_dikirim,barang_dijual,barang_gudang,barang_gudang_detail where tb_laporan_kerusakan.id=tb_maintenance.laporan_kerusakan_id and tb_teknisi.id=tb_maintenance.teknisi_id and akun_customer.id=tb_laporan_kerusakan.akun_customer_id and kategori_job.id=tb_laporan_kerusakan.kategori_job_id and barang_dikirim.id=tb_laporan_kerusakan.barang_dikirim_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and akun_customer.id=".$_SESSION['id']." order by tb_maintenance.tgl_maintenance ".$limiter['urut']." LIMIT ".$limiter['limiter']."");
  }
	  }
	  
  
  
  else {
  if (isset($_GET['id_lihat'])) {
	  $query = mysqli_query($koneksi, "select *,tb_maintenance.id as idd from tb_maintenance,tb_laporan_kerusakan,akun_customer,kategori_job,tb_teknisi,barang_dikirim,barang_dijual,barang_gudang,barang_gudang_detail where tb_laporan_kerusakan.id=tb_maintenance.laporan_kerusakan_id and tb_teknisi.id=tb_maintenance.teknisi_id and akun_customer.id=tb_laporan_kerusakan.akun_customer_id and kategori_job.id=tb_laporan_kerusakan.kategori_job_id and barang_dikirim.id=tb_laporan_kerusakan.barang_dikirim_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and tb_maintenance.laporan_kerusakan_id=".$_GET['id_lihat']." order by tb_maintenance.tgl_maintenance ".$limiter['urut']."");
	  }
  else {
  $query = mysqli_query($koneksi, "select *,tb_maintenance.id as idd from tb_maintenance,tb_laporan_kerusakan,akun_customer,kategori_job,tb_teknisi,barang_dikirim,barang_dijual,barang_gudang,barang_gudang_detail where tb_laporan_kerusakan.id=tb_maintenance.laporan_kerusakan_id and tb_teknisi.id=tb_maintenance.teknisi_id and akun_customer.id=tb_laporan_kerusakan.akun_customer_id and kategori_job.id=tb_laporan_kerusakan.kategori_job_id and barang_dikirim.id=tb_laporan_kerusakan.barang_dikirim_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id order by tb_maintenance.tgl_maintenance ".$limiter['urut']." LIMIT ".$limiter['limiter']."");
  }
  }
  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td>
	<?php 
	$brs = mysqli_num_rows(mysqli_query($koneksi, "select maintenance_id from progress_maintenance where maintenance_id=".$data['idd'].""));
	if ($brs!=0) { ?>
	<a href="index.php?page=progress_pengerjaan&id_lihat=<?php echo $data['idd']; ?>"><?php echo date('d F Y',strtotime($data['tgl_maintenance']));?></a> <?php } else { ?>
    <?php echo date('d F Y',strtotime($data['tgl_maintenance'])); ?>
	<?php } ?>
    </td>
    <td><?php 
	//$q_teknisi=mysqli_fetch_array(mysqli_query($koneksi,"select * from tb_teknisi where id=".$data['id_teknisi'].""));
	echo $data['nama_teknisi']; ?></td>
    <td>
	<?php 
	//$q_lapor=mysqli_fetch_array(mysqli_query($koneksi,"select * from tb_laporan_kerusakan where id=".$data['id_lapor'].""));
	echo $data['nama_user']; ?>
	</td>
    <td><?php
	//$data2 = mysqli_fetch_array(mysqli_query($koneksi, "select * from tb_laporan_kerusakan where id=".$data['id_lapor'].""));
	 echo $data['nama_brg']." / ".$data['no_seri_brg']; ?></td>
    <td><?php echo $data['problem']; ?></td>
    <td align="center">
    <?php if (!isset($_SESSION['id_b']) and !isset($_SESSION['user_customer'])){ ?>
    <a href="pages/delete_spk.php?id_hapus=<?php echo $data['idd']; ?>&lapor=<?php echo $data['laporan_kerusakan_id']; ?>" onClick="return confirm('Anda Yakin Akan Menghapus Data Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a> &nbsp;&nbsp;<a href="index.php?page=ubah_spk&id_ubah=<?php echo $data['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>
    <?php } ?> <!--&nbsp;&nbsp;<a href="cetak_spk_one.php?id=<?php echo $data['idd']; ?>"><span data-toggle="tooltip" title="Download" class="glyphicon glyphicon-print"></span></a>--></td>
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