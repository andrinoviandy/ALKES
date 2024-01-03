
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Progress Perbaikan <u><?php $da = mysqli_fetch_array(mysqli_query($koneksi, "select * from pembeli where id=$_GET[id]")); ?></u></h1>
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
              <a href="index.php?page=progress_pengerjaan2&id=<?php echo $_GET['id']; ?>"><button class="btn btn-success">Kembali Ke Halaman Sebelumnya</button></a>
              <br /><br />
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
             <br />
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td align="center">#</td>
      <td><strong><font>Nama Alkes</font></strong></td>
      <td><strong>Progress</strong></td>
      <td><strong>No Seri/Set</strong></td>
      <td><strong>Garansi</strong></td>
      <td><strong>Problem</strong></td>
      <td><strong>Lokasi</strong></td>
      <td><strong>Teknisi</strong></td>
      <td><strong>Kontak Teknisi</strong></td>
      <td align="center"><strong>Status</strong></td>
      <td align="center"><strong>Biaya</strong></td>
  
      <td align="center"><strong>Aksi</strong></td>

      </tr>
  </thead>
  <?php
  
	  //$query = mysqli_query($koneksi, "select *,tb_laporan_kerusakan.id as idd from tb_laporan_kerusakan,akun_customer,kategori_job,barang_dikirim,barang_dikirim_detail,barang_dijual,barang_dijual_detail,barang_gudang,barang_gudang_detail where akun_customer.id=tb_laporan_kerusakan.akun_customer_id and barang_dikirim_detail.id=tb_laporan_kerusakan.barang_dikirim_detail_id and kategori_job.id=tb_laporan_kerusakan.kategori_job_id and barang_dijual_detail.id=barang_dikirim_detail.barang_dijual_detail_id and barang_dijual.id=barang_dijual_detail.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual_detail.barang_gudang_detail_id order by tb_laporan_kerusakan.tgl_lapor ".$limiter['urut']." LIMIT ".$limiter['limiter']."");
	  $query = mysqli_query($koneksi, "select *,tb_maintenance_detail.id as idd from tb_laporan_kerusakan_cs,tb_laporan_kerusakan_cs_detail,tb_laporan_kerusakan_detail,alat_pelatihan,alat_uji_detail,barang_teknisi_detail,barang_dikirim_detail,barang_gudang_detail,barang_gudang,tb_teknisi,pembeli,tb_maintenance_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and alat_uji_detail.id=alat_pelatihan.alat_uji_detail_id and alat_pelatihan.id=tb_laporan_kerusakan_detail.alat_pelatihan_id and tb_laporan_kerusakan_cs.id=tb_laporan_kerusakan_cs_detail.tb_laporan_kerusakan_cs_id and tb_laporan_kerusakan_cs_detail.id=tb_laporan_kerusakan_detail.tb_laporan_kerusakan_cs_detail_id and tb_teknisi.id=tb_laporan_kerusakan_detail.teknisi_id and pembeli.id=tb_laporan_kerusakan_cs.pembeli_id and tb_laporan_kerusakan_detail.id=tb_maintenance_detail.tb_laporan_kerusakan_detail_id and tb_laporan_kerusakan_cs.id=".$_GET['id_detail']." and pembeli.id=".$_GET['id']."");

  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td><?php echo $data['nama_brg']; ?>
    <!--<span class="pull-right-container">
              <small class="label pull-right bg-green">
              <?php $total11=mysqli_num_rows(mysqli_query($koneksi, "select * from progress_maintenance where tb_maintenance_detail_id=".$data['idd'].""));
			  echo $total11;
			   ?>
              </small>
            </span>-->
    </td>
    <td><?php $total11=mysqli_num_rows(mysqli_query($koneksi, "select * from progress_maintenance where tb_maintenance_detail_id=".$data['idd'].""));
			  echo $total11." Kali";
			   ?></td>
    <td><?php echo $data['no_seri_brg']." ".$data['nama_set']; ?></td>
    <td><?php echo $data['status_garansi']; ?></td>
    <td><?php echo $data['problem']; ?></td>
    <td><?php echo $data['jalan']; ?></td>
    <td><?php echo $data['nama_teknisi']; ?></td>
    <td><?php echo $data['no_hp']; ?></td>
    <?php
    if ($da['status_proses']==0) {
		$col = "yellow";
		}
	else {
		$col = "green";
		}
	?>
    <td bgcolor="<?php echo $col; ?>"><?php if ($data['status_proses']==0){echo "Belum Selesai";} else {echo "Sudah Selesai";} ?></td>
    <td align="center"><?php echo number_format($data['total_biaya_maintenance'],0,',','.'); ?></td>
    
    <td align="center">
      <!--
      <a href="pages/delete_laporan.php?id_hapus=<?php echo $data['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a> &nbsp;&nbsp;
      
      <a href="index.php?page=ubah_laporan&id=<?php echo $data['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-caret-square-o-right"></span></a> &nbsp;&nbsp; 
      -->
      <a href="index.php?page=progress_pengerjaan4&id_alkes=<?php echo $data['idd']; ?>&id_detail=<?php echo $_GET['id_detail'] ?>&id=<?php echo $_GET['id']; ?>"><small data-toggle="tooltip" title="Progress" class="label bg-green"><span class="fa fa-plus"></span>&nbsp; Progress</small></a><br />
      <a target="_blank" href="cetak_laporan_service.php?id=<?php echo $data['idd']; ?>"><span data-toggle="tooltip" title="Cetak Laporan Service" class="fa fa-print"></span></a>
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
