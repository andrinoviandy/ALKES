
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan Kerusakan
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Laporan Kerusakan</li>
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
              <!--<?php if (!isset($_SESSION['id_b'])) { ?>
              <a href="index.php?page=tambah_laporan">
              <button type="submit" name="button" id="button" class="btn btn-info"><span class="fa fa-plus"></span> Tambah Laporan</button>
              </a>
              <br /><br />
              <?php } ?>
              -->
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
              <table width="100%" id="example1" class="table table-bordered table-hover">
                <thead>
    <tr>
      <td rowspan="2" align="center">#</td>
      <td rowspan="2"><strong>Instansi</strong></td>
      <td rowspan="2"><strong>Alamat</strong></td>
      <td rowspan="2"><strong>Kontak</strong></td>
      <td colspan="2" align="center"><strong>Pilih Teknisi &amp; No Seri Per Barang</strong></td>
      <td rowspan="2" align="center"><strong>Aksi</strong></td>
    </tr>
    <tr>
      <td align="center"><strong>Sudah </strong></td>
      <td align="center"><strong>Belum</strong></td>
      <?php if (isset($_SESSION['user_administrator']) or isset($_SESSION['user_admin_teknisi'])) { ?>
      <!--<td align="center"><strong>Belum Pilih Teknisi</strong></td>-->
      <?php } ?>
      </tr>
  </thead>
  <?php
  
	  $query = mysqli_query($koneksi, "select *,pembeli.id as idd from pembeli,tb_laporan_kerusakan_cs,alamat_provinsi,alamat_kecamatan,alamat_kabupaten where pembeli.id=tb_laporan_kerusakan_cs.pembeli_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id group by pembeli.id order by nama_pembeli ASC");

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
    <?php
    $total1 = mysqli_num_rows(mysqli_query($koneksi, "select * from tb_laporan_kerusakan_detail,tb_laporan_kerusakan_cs,tb_laporan_kerusakan_cs_detail where tb_laporan_kerusakan_cs.id=tb_laporan_kerusakan_cs_detail.tb_laporan_kerusakan_cs_id and tb_laporan_kerusakan_cs_detail.id=tb_laporan_kerusakan_detail.tb_laporan_kerusakan_cs_detail_id and pembeli_id=".$data['idd']." group by barang_gudang_id"));
	echo $total1;
	?>
    </td>
    <td align="center">
    <?php
    $total2 = mysqli_num_rows(mysqli_query($koneksi, "select * from tb_laporan_kerusakan_cs,tb_laporan_kerusakan_cs_detail where tb_laporan_kerusakan_cs.id=tb_laporan_kerusakan_cs_detail.tb_laporan_kerusakan_cs_id and pembeli_id=".$data['idd']." group by barang_gudang_id"));
	echo $total2-$total1;
	?>
    </td>
    <?php if (isset($_SESSION['user_administrator']) or isset($_SESSION['user_admin_teknisi'])) { ?>
    <!--<td align="center">
    <?php
    /*$jm1 = mysqli_num_rows(mysqli_query($koneksi, "select *,pembeli.id as idd from pembeli,tb_laporan_kerusakan where pembeli.id=tb_laporan_kerusakan.pembeli_id and pembeli.id=".$data['idd'].""));
	$jm2 = mysqli_num_rows(mysqli_query($koneksi, "select *,pembeli.id as idd from pembeli,tb_laporan_kerusakan,tb_laporan_kerusakan_detail,tb_maintenance,tb_maintenance_detail where pembeli.id=tb_laporan_kerusakan.pembeli_id and tb_laporan_kerusakan.id=tb_laporan_kerusakan_detail.tb_laporan_kerusakan_id and tb_maintenance.id=tb_maintenance_detail.tb_maintenance_id and tb_laporan_kerusakan_detail.id=tb_maintenance_detail.tb_laporan_kerusakan_detail_id and pembeli.id=".$data['idd'].""));
	$jm = $jm1-$jm2;
	if ($jm>0) {
		echo $jm;
	}else {echo "0";}
	*/?>
    </td>-->
    <?php } ?>
    
    <td align="center">
    <a href="index.php?page=laporan_kerusakan_lama&id=<?php echo $data['idd']; ?>"><span data-toggle="tooltip" title="Detail" class="fa fa-caret-square-o-right"></span></a>
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
