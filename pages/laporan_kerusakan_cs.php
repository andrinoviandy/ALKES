
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
              <?php if (!isset($_SESSION['id_b'])) { ?>
              <a href="index.php?page=tambah_laporan_cs">
              <button type="submit" name="button" id="button" class="btn btn-info"><span class="fa fa-plus"></span> Tambah Laporan</button>
              </a>
              <br /><br />
              <?php } ?>
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
      <td align="center">#</td>
      
      <td><strong>Instansi</strong></td>
     
      <td><strong>Alamat</strong></td>
      <td><strong>Kontak</strong></td>
      
      <?php if (!isset($_SESSION['id_b'])) { ?>
      <td align="center"><strong>Aksi</strong></td>
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
    
    <?php if (!isset($_SESSION['id_b'])) { ?>
    <td align="center">
    <a href="index.php?page=laporan_kerusakan_lama_cs&id=<?php echo $data['idd']; ?>"><span data-toggle="tooltip" title="Detail" class="fa fa-caret-square-o-right"></span></a>
    </td>
    <?php } ?>
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
