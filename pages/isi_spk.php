<?php require("config/koneksi.php"); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 align="center">
        Laporan SPK
      </h1>
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
              <div class="input-group col-lg-12">
              <?php echo "<strong>Form</strong> <i>".date("d F Y",strtotime($tgl1))."</i> <strong>To</strong> <i>".date("d F Y",strtotime($tgl2))."</i>"; ?>
                <table width="100%" border="1" class="table table-hover" id="example2">
  <thead>
    <tr>
      <td align="left">No</td>
      <td align="left"><strong>Tanggal SPK</strong></td>
      <td align="left"><strong>Teknisi</strong></td>
      <td align="left"><strong>Pelapor</strong></td>
      <td align="left"><strong>Nama Alat / No Seri</strong></td>
      <td align="left"><strong>Kerusakan</strong></td>
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
  $query = mysqli_query($koneksi, "select *,tb_spk.id as idd from tb_spk,tb_teknisi,tb_laporan_kerusakan,barang,akun where akun.id=barang.id_akun and barang.id=tb_laporan_kerusakan.id_barang and tb_laporan_kerusakan.id=tb_spk.id_lapor and tb_teknisi.id=tb_spk.id_teknisi and tgl_spk between '$tgl1' and '$tgl2' order by tb_spk.tgl_spk DESC");}
  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="left"><?php echo $no; ?></td>
    <td align="left"><?php echo date('d F Y',strtotime($data['tgl_spk'])); ?></td>
    <td align="left"><?php 
	//$q_teknisi=mysqli_fetch_array(mysqli_query($koneksi,"select * from tb_teknisi where id=".$data['id_teknisi'].""));
	echo $data['nama_teknisi']; ?></td>
    <td align="left">
	<?php 
	//$q_lapor=mysqli_fetch_array(mysqli_query($koneksi,"select * from tb_laporan_kerusakan where id=".$data['id_lapor'].""));
	echo $data['nama']; ?>
	</td>
    <td align="left"><?php
	//$data2 = mysqli_fetch_array(mysqli_query($koneksi, "select * from tb_laporan_kerusakan where id=".$data['id_lapor'].""));
	 echo $data['nama_barang']." / ".$data['no_seri']; ?></td>
    <td align="left"><?php echo $data['kerusakan']; ?></td>
    </tr>
  <?php } ?>
</table>
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