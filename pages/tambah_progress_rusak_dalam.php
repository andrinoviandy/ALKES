<?php
if (isset($_POST['kirim_barang'])) {
	  $input = mysqli_query($koneksi, "update barang_gudang_detail_rusak set status_progress=".$_POST['status']." where id=".$_GET['id_ubah']."");
	  	
		if ($input) {
		  		echo "<script>
			window.location='index.php?page=tambah_progress_rusak_dalam&id_gudang_detail	=$_GET[id_gudang_detail]&id_ubah=$_GET[id_ubah]&id_gudang=$_GET[id_gudang]'
				</script>";
		  		}
			
		
	  }
 
if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from barang_gudang_detail_rusak_progress where id=".$_GET['id_hapus']."");
	if ($del) {
		echo "<script>
		window.location='index.php?page=tambah_progress_rusak_dalam&id_gudang_detail=$_GET[id_gudang_detail]&id_ubah=$_GET[id_ubah]&id_gudang=$_GET[id_gudang]';
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Progress Pengerjaan</h1>
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
            <div class="box-body">
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
              <a href="index.php?page=progress_rusak_dalam_detail&id_gudang=<?php echo $_GET['id_gudang']; ?>"><button class="btn btn-success">Kembali Ke Halaman Sebelumnya</button></a>
              <br /><br />
              <div class="table-responsive">
              <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="top"><strong>Nama Alkes</strong></th>
        
      <th valign="top"><strong>Merk</strong></th>
      <th valign="top"><strong>Tipe</strong></th>
      <th valign="top">No Seri/Nama Set</th>
      <!--<th valign="top">NIE</th>
      <th valign="top">No. Bath</th>
      <th valign="top">No. Lot</th>-->
      <th valign="top"><strong>Negara Asal</strong></th>
     
        <th align="center" valign="top"><strong>Deskripsi Alat        
        </strong></th>
        <th align="center" valign="top">Status Barang</th>
        
        </tr>
  </thead>
  <?php
 
	  $query = mysqli_query($koneksi, "select *,barang_gudang.id as id_gudang from barang_gudang,barang_gudang_detail,barang_gudang_detail_rusak where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_gudang_detail_rusak.barang_gudang_detail_id and barang_gudang_detail.id=".$_GET['id_gudang_detail']." and barang_gudang_detail_rusak.id=".$_GET['id_ubah']."");
	  //$query = mysqli_query($koneksi, "select *,barang_gudang.id as idd from barang_gudang order by id ".$limiter['urut']." LIMIT ".$limiter['limiter']."");

  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td>
      <?php $jml=mysqli_num_rows(mysqli_query($koneksi, "select barang_gudang_detail_id from barang_dijual,barang_gudang,barang_gudang_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual.barang_gudang_detail_id and barang_gudang_id=".$data['idd'].""));
	if ($jml!=0) {
	?>
      <a href="index.php?page=jual_barang&id_lihat_jual=<?php echo $data['idd']; ?>" data-toggle="tooltip" title="Lihat Proses Penjualan"><?php echo $data['nama_brg']; ?></a>
      <span class="label label-primary pull-right"><?php echo $jml; ?></span>
      <?php } else { echo $data['nama_brg']; } ?>
    </td>
    
      <td><?php echo $data['merk_brg']; ?></td>
    <td><?php echo $data['tipe_brg']; ?></td>
    <td><?php echo $data['no_seri_brg']." ".$data['nama_set']; ?></td>
    <!--<td><?php echo $data['nie_brg']; ?></td>
    <td><?php echo $data['no_bath']; ?></td>
    <td><?php echo $data['no_lot']; ?></td>-->
    <td><?php echo $data['negara_asal']; ?></td>
    <td><?php echo $data['deskripsi_alat']; ?></td>
    <td><?php if($data['status_kerusakan']==1) {echo "RUSAK";} else if ($data['status_kerusakan']==2) {echo "Dikembalikan ke pabrik";} else {echo "-";} ?></td>
    </tr>
  <?php } ?>
</table>
              </div>

<br />
<h3 align="center">Detail Progress</h3>
<br />
<?php 
	$da = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang_detail_rusak where id=".$_GET['id_ubah'].""));
	if ($da['status_progress']==0) { ?>
<a href="index.php?page=tambah_progress_rusak_dalam2&id_gudang_detail=<?php echo $_GET['id_gudang_detail']; ?>&id_ubah=<?php echo $_GET['id_ubah']; ?>&id_gudang=<?php echo $_GET['id_gudang']; ?>"><button class="btn btn-success"><span class="fa fa-plus"></span> &nbsp;Tambah</button></a>
<?php } ?>
<a target="_blank" href="cetak_progress_belum_dijual.php?id_gudang_detail=<?php echo $_GET['id_gudang_detail']; ?>&id_ubah=<?php echo $_GET['id_ubah']; ?>&id_gudang=<?php echo $_GET['id_gudang']; ?>"><button class="btn btn-info"><span class="fa fa-print"></span> &nbsp;Cetak Progress</button></a>
<a href="#" data-toggle="modal" data-target="#modal-status"><button class="pull pull-right btn btn-success"><span class="fa fa-edit"></span> &nbsp;Ubah Status Progress</button></a><br /><br />
<div class="table-responsive">
<table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td><strong><font>Tanggal Progress</font></strong></td>
      <td><strong>Deskripsi Kerusakan</strong></td>
      <td><strong>Deskripsi Perbaikan</strong></td>
      <td><strong>Lampiran</strong></td>
      <td><strong>Aksi</strong></td>
  
      </tr>
  </thead>
  <?php
  
	  //$query = mysqli_query($koneksi, "select *,tb_laporan_kerusakan.id as idd from tb_laporan_kerusakan,akun_customer,kategori_job,barang_dikirim,barang_dikirim_detail,barang_dijual,barang_dijual_detail,barang_gudang,barang_gudang_detail where akun_customer.id=tb_laporan_kerusakan.akun_customer_id and barang_dikirim_detail.id=tb_laporan_kerusakan.barang_dikirim_detail_id and kategori_job.id=tb_laporan_kerusakan.kategori_job_id and barang_dijual_detail.id=barang_dikirim_detail.barang_dijual_detail_id and barang_dijual.id=barang_dijual_detail.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual_detail.barang_gudang_detail_id order by tb_laporan_kerusakan.tgl_lapor ".$limiter['urut']." LIMIT ".$limiter['limiter']."");
	  $query = mysqli_query($koneksi, "select * from barang_gudang_detail_rusak_progress where barang_gudang_detail_rusak_id=".$_GET['id_ubah']."");

  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td><?php echo date("d-m-Y",strtotime($data['tgl_progress'])); ?></td>
    <td><?php echo $data['deskripsi_kerusakan']; ?></td>
    <td><?php echo $data['deskripsi_perbaikan']; ?></td>
    <td><?php if ($data['lampiran']!="") { ?>
    <a href="gambar_progress_belum_dijual/<?php echo $data['lampiran']; ?>" target="_blank"><img src="gambar_progress_belum_dijual/<?php echo $data['lampiran']; ?>" width="50px" /></a>
    <?php } ?></td>
    <td>
    <?php 
	//$d = mysqli_fetch_array(mysqli_query($koneksi, "select * from tb_maintenance_detail.id="));
	if ($da['status_progress']==0) { ?>
    <a href="index.php?page=tambah_progress_rusak_dalam&id_gudang_detail=<?php echo $_GET['id_gudang_detail']; ?>&id_ubah=<?php echo $_GET['id_ubah']; ?>&id_gudang=<?php echo $_GET['id_gudang']; ?>&id_hapus=<?php echo $data['id']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>
    <?php } ?>
    </td>
    
    </tr>
  <?php } ?>
</table>
</div>
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
<div class="modal fade" id="modal-status">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Ubah Status Progress</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
              <select id="input" name="status" class="form-control select2" style="width:100%">
     <?php if ($da['status_progress']==0) { ?>
     	<option value="0">Belum Selesai</option>
        <option value="1">Sudah Selesai</option>
        <?php } else if ($da['status_progress']==1){ ?>
        <option value="1">Sudah Selesai</option>
        <option value="0">Belum Selesai</option>
        <?php } ?>
     </select>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button name="kirim_barang" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan</button>
              </div>
              </form>
              <script type="text/javascript">    
	<?php 
	echo $jsArray; 
	?>  
	function changeValue(id_akse){  
		document.getElementById('tipe_akse').value = dtBrg[id_akse].tipe_akse; 
		document.getElementById('merk_akse').value = dtBrg[id_akse].merk_akse;
		document.getElementById('no_akse').value = dtBrg[id_akse].no_akse;
		
	};  
</script>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
</div>
