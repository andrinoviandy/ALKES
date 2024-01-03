
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan SPK
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Laporan SPK</li>
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
              <form method="post" action="cetak_spk_all.php">
              <div class="col-xs-3">
                  <div class="input-group">
                        <span class="input-group-addon">
                          Form <span class="fa fa-calendar"></span>
                        </span>
                    <input name="tgl1" type="date" class="form-control" required="required">
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-xs-3">
                  <div class="input-group">
                        <span class="input-group-addon">
                          To <span class="fa fa-calendar"></span>
                        </span>
                    <input name="tgl2" type="date" class="form-control" required="required">
                  </div>
                  <!-- /input-group -->
                </div>
                <button class="btn btn-success" type="submit"><span class="fa fa-print"></span> Cetak Excel</button>
              </form></div></div>
              <!-- /.chat -->
            <div class="box-footer">
            <div class="box-body table-responsive no-padding">
              <div class="">
              <br /><br />
                <table id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td align="center">&nbsp;</td>
      <td><strong>Tanggal SPK</strong></td>
      <td><strong>Teknisi</strong></td>
      <td><strong>Pelapor</strong></td>
      <td><strong>Nama Alat / No Seri</strong></td>
      <td><strong>Kerusakan</strong></td>
      </tr>
  </thead>
  <?php
  if (isset($_POST['tgl_spk'])) { 
  $cari=$_POST['tgl_spk'];
  $query = mysqli_query($koneksi, "select *,tb_spk.id as idd from tb_spk,tb_teknisi,tb_laporan_kerusakan,barang,akun where akun.id=barang.id_akun and barang.id=tb_laporan_kerusakan.id_barang and tb_laporan_kerusakan.id=tb_spk.id_lapor and tb_teknisi.id=tb_spk.id_teknisi and tgl_spk like '%$cari%' order by tb_spk.tgl_spk DESC");
  } 
  else if (isset($_POST['teknisi'])) { 
  $cari=$_POST['teknisi'];
  $query = mysqli_query($koneksi, "select *,tb_spk.id as idd from tb_spk,tb_teknisi,tb_laporan_kerusakan,barang,akun where akun.id=barang.id_akun and barang.id=tb_laporan_kerusakan.id_barang and tb_laporan_kerusakan.id=tb_spk.id_lapor and tb_teknisi.id=tb_spk.id_teknisi and nama_teknisi like '%$cari%' order by tb_spk.tgl_spk DESC");
  }
  else if (isset($_POST['pelapor'])) { 
  $cari=$_POST['pelapor'];
  $query = mysqli_query($koneksi, "select *,tb_spk.id as idd from tb_spk,tb_teknisi,tb_laporan_kerusakan,barang,akun where akun.id=barang.id_akun and barang.id=tb_laporan_kerusakan.id_barang and tb_laporan_kerusakan.id=tb_spk.id_lapor and tb_teknisi.id=tb_spk.id_teknisi and nama like '%$cari%' order by tb_spk.tgl_spk DESC");
  }
  else if (isset($_POST['nama_barang'])) { 
  $cari=$_POST['nama_barang'];
  $query = mysqli_query($koneksi, "select *,tb_spk.id as idd from tb_spk,tb_teknisi,tb_laporan_kerusakan,barang,akun where akun.id=barang.id_akun and barang.id=tb_laporan_kerusakan.id_barang and tb_laporan_kerusakan.id=tb_spk.id_lapor and tb_teknisi.id=tb_spk.id_teknisi and nama_barang like '%$cari%' order by tb_spk.tgl_spk DESC");
  }
  else if (isset($_POST['kerusakan'])) { 
  $cari=$_POST['kerusakan'];
  $query = mysqli_query($koneksi, "select *,tb_spk.id as idd from tb_spk,tb_teknisi,tb_laporan_kerusakan,barang,akun where akun.id=barang.id_akun and barang.id=tb_laporan_kerusakan.id_barang and tb_laporan_kerusakan.id=tb_spk.id_lapor and tb_teknisi.id=tb_spk.id_teknisi and kerusakan like '%$cari%' order by tb_spk.tgl_spk DESC");
  }
  else {
  $query = mysqli_query($koneksi, "select *,tb_spk.id as idd from tb_spk,tb_teknisi,tb_laporan_kerusakan,barang,akun where akun.id=barang.id_akun and barang.id=tb_laporan_kerusakan.id_barang and tb_laporan_kerusakan.id=tb_spk.id_lapor and tb_teknisi.id=tb_spk.id_teknisi order by tb_spk.tgl_spk DESC");}
  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo date('d F Y',strtotime($data['tgl_spk'])); ?></td>
    <td><?php 
	//$q_teknisi=mysqli_fetch_array(mysqli_query($koneksi,"select * from tb_teknisi where id=".$data['id_teknisi'].""));
	echo $data['nama_teknisi']; ?></td>
    <td>
	<?php 
	//$q_lapor=mysqli_fetch_array(mysqli_query($koneksi,"select * from tb_laporan_kerusakan where id=".$data['id_lapor'].""));
	echo $data['nama']; ?>
	</td>
    <td><?php
	//$data2 = mysqli_fetch_array(mysqli_query($koneksi, "select * from tb_laporan_kerusakan where id=".$data['id_lapor'].""));
	 echo $data['nama_barang']." / ".$data['no_seri']; ?></td>
    <td><?php echo $data['kerusakan']; ?></td>
    </tr>
  <?php } ?>
</table>
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