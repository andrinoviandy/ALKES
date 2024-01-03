
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan Kerusakan
        
      Barang</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Laporan Kerusakan Barang</li>
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
              <div class="row">
              <div class="box-body">
              Tanggal Lapor : <br /><br />
              <form method="post" action="cetak_laporan_barang.php">
              <div class="col-xs-3">
                  <div class="input-group">
                        <span class="input-group-addon">
                          Form <span class="fa fa-calendar"></span>
                        </span>
                    <input name="tgl1" required="required" type="date" class="form-control">
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-xs-3">
                  <div class="input-group">
                        <span class="input-group-addon">
                          To <span class="fa fa-calendar"></span>
                        </span>
                    <input name="tgl2" required="required" type="date" class="form-control">
                  </div>
                  <!-- /input-group -->
                </div>
                <button class="btn btn-success" type="submit"><span class="fa fa-print"></span> Cetak Excel</button>
              </form></div></div>
              <!-- /.chat -->
            <div class="box-footer">
            <div class="box-body table-responsive no-padding">
              <div class="">
              <!--
              <br />
                
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td align="center">&nbsp;</td>
      <td><strong>Tanggal Lapor</strong></td>
      <td><strong>Laporan Dari</strong></td>
      <td><strong>Nama / No Seri Alat</strong></td>
      <td><strong>Garansi</strong></td>
      <td><strong>Kerusakan</strong></td>
      <td><strong>Lokasi</strong></td>
      <td><strong>Kontak</strong></td>
      
      </tr>
  </thead>
  <?php
  if (isset($_SESSION['id'])) { 
  if (isset($_POST['tgl_lapor'])) { 
  $cari=$_POST['tgl_lapor'];
  $query = mysqli_query($koneksi, "select * from tb_laporan_kerusakan,barang,akun where akun.id=barang.id_akun and barang.id=tb_laporan_kerusakan.id_barang and akun.id=".$_SESSION['id']." and tgl_lapor like '%$cari%' order by tgl_lapor DESC");
  }
  else if (isset($_POST['pelapor'])) { 
  $cari=$_POST['pelapor'];
  $query = mysqli_query($koneksi, "select * from tb_laporan_kerusakan,barang,akun where akun.id=barang.id_akun and barang.id=tb_laporan_kerusakan.id_barang and akun.id=".$_SESSION['id']." and nama like '%$cari%' order by tgl_lapor DESC");
  }
  else if (isset($_POST['nama_no_seri'])) { 
  $cari=$_POST['nama_no_seri'];
  $query = mysqli_query($koneksi, "select * from tb_laporan_kerusakan,barang,akun where akun.id=barang.id_akun and barang.id=tb_laporan_kerusakan.id_barang and akun.id=".$_SESSION['id']." and nama_barang like '%$cari%' order by tgl_lapor DESC");
  }
  else if (isset($_POST['status_garansi'])) { 
  $cari=$_POST['status_garansi'];
  $query = mysqli_query($koneksi, "select * from tb_laporan_kerusakan,barang,akun where akun.id=barang.id_akun and barang.id=tb_laporan_kerusakan.id_barang and akun.id=".$_SESSION['id']." and garansi like '%$cari%' order by tgl_lapor DESC");
  }
  else if (isset($_POST['kerusakan'])) { 
  $cari=$_POST['kerusakan'];
  $query = mysqli_query($koneksi, "select * from tb_laporan_kerusakan,barang,akun where akun.id=barang.id_akun and barang.id=tb_laporan_kerusakan.id_barang and akun.id=".$_SESSION['id']." and kerusakan like '%$cari%' order by tgl_lapor DESC");
  }
  else if (isset($_POST['lokasi'])) { 
  $cari=$_POST['lokasi'];
  $query = mysqli_query($koneksi, "select * from tb_laporan_kerusakan,barang,akun where akun.id=barang.id_akun and barang.id=tb_laporan_kerusakan.id_barang and akun.id=".$_SESSION['id']." and lokasi like '%$cari%' order by tgl_lapor DESC");
  }
  else if (isset($_POST['kontak'])) { 
  $cari=$_POST['kontak'];
  $query = mysqli_query($koneksi, "select * from tb_laporan_kerusakan,barang,akun where akun.id=barang.id_akun and barang.id=tb_laporan_kerusakan.id_barang and akun.id=".$_SESSION['id']." and kontak like '%$cari%' order by tgl_lapor DESC");
  }
   else {
	  $query = mysqli_query($koneksi, "select *,tb_laporan_kerusakan.id as idd from tb_laporan_kerusakan,barang,akun where akun.id=barang.id_akun and barang.id=tb_laporan_kerusakan.id_barang and akun.id=".$_SESSION['id']." order by tb_laporan_kerusakan.tgl_lapor DESC");
	  }
  }
  
  
  else {
  if (isset($_POST['tgl_lapor'])) { 
  $cari=$_POST['tgl_lapor'];
  $query = mysqli_query($koneksi, "select * from tb_laporan_kerusakan,barang,akun where akun.id=barang.id_akun and barang.id=tb_laporan_kerusakan.id_barang and tgl_lapor like '%$cari%' order by tgl_lapor DESC");
  }
  else if (isset($_POST['pelapor'])) { 
  $cari=$_POST['pelapor'];
  $query = mysqli_query($koneksi, "select * from tb_laporan_kerusakan,barang,akun where akun.id=barang.id_akun and barang.id=tb_laporan_kerusakan.id_barang and nama like '%$cari%' order by tgl_lapor DESC");
  }
  else if (isset($_POST['nama_no_seri'])) { 
  $cari=$_POST['nama_no_seri'];
  $query = mysqli_query($koneksi, "select * from tb_laporan_kerusakan,barang,akun where akun.id=barang.id_akun and barang.id=tb_laporan_kerusakan.id_barang and nama_barang like '%$cari%' order by tgl_lapor DESC");
  }
  else if (isset($_POST['status_garansi'])) { 
  $cari=$_POST['status_garansi'];
  $query = mysqli_query($koneksi, "select * from tb_laporan_kerusakan,barang,akun where akun.id=barang.id_akun and barang.id=tb_laporan_kerusakan.id_barang and garansi like '%$cari%' order by tgl_lapor DESC");
  }
  else if (isset($_POST['kerusakan'])) { 
  $cari=$_POST['kerusakan'];
  $query = mysqli_query($koneksi, "select * from tb_laporan_kerusakan,barang,akun where akun.id=barang.id_akun and barang.id=tb_laporan_kerusakan.id_barang and kerusakan like '%$cari%' order by tgl_lapor DESC");
  }
  else if (isset($_POST['lokasi'])) { 
  $cari=$_POST['lokasi'];
  $query = mysqli_query($koneksi, "select * from tb_laporan_kerusakan,barang,akun where akun.id=barang.id_akun and barang.id=tb_laporan_kerusakan.id_barang and lokasi like '%$cari%' order by tgl_lapor DESC");
  }
  else if (isset($_POST['kontak'])) { 
  $cari=$_POST['kontak'];
  $query = mysqli_query($koneksi, "select * from tb_laporan_kerusakan,barang,akun where akun.id=barang.id_akun and barang.id=tb_laporan_kerusakan.id_barang and kontak like '%$cari%' order by tgl_lapor DESC");
  }
   else {
	  $query = mysqli_query($koneksi, "select *,tb_laporan_kerusakan.id as idd from tb_laporan_kerusakan,barang,akun where akun.id=barang.id_akun and barang.id=tb_laporan_kerusakan.id_barang order by tb_laporan_kerusakan.tgl_lapor DESC");
	  }
  }
  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td>
    <?php
	$jml = mysqli_num_rows(mysqli_query($koneksi, "select * from tb_spk where id_lapor=".$data['idd'].""));
    if ($jml>0) {
		$clr="";
	} else { $clr="#FF0000"; }
	?>
    <font color=""><?php echo date("d F Y",strtotime($data['tgl_lapor'])); ?></font></td>
    <td><?php echo $data['nama']; ?></td>
    <td><?php echo $data['nama_barang']." / ".$data['no_seri']; ?></td>
    <td><?php echo $data['status_garansi']; ?></td>
    <td><?php echo $data['kerusakan']; ?></td>
    <td><?php echo $data['lokasi']; ?></td>
    <td><?php echo $data['kontak']; ?></td>
    
  </tr>
  <?php } ?>
</table>
-->
              </div>
              </div></div>
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