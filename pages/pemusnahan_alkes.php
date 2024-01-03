
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pemusnahan Alkes</h1><ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pemusnahan Alkes</li>
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
              <a href="index.php?page=tambah_pemusnahan">
              <button type="submit" name="button" id="button" class="btn btn-success"><span class="fa fa-plus"></span> Tambah</button>
              </a><br /><br />
                <table id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td align="center">&nbsp;</td>
      <td><strong>Tanggal</strong></td>
      <td><strong>Jam Mulai</strong></td>
      <td><strong>Jam Selesai</strong></td>
      <td><strong>Nama Alkes</strong></td>
      <td><strong>Jumlah</strong></td>
      <td><strong>Uraian</strong></td>
      <td><strong>Lokasi</strong></td>
      <td><strong>Aktor</strong></td>
      <td align="center"><strong>Aksi</strong></td>
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
  $query = mysqli_query($koneksi, "select *,pemusnahan.id as idd from pemusnahan order by pemusnahan.id DESC");}
  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo date('d-m-Y',strtotime($data['tgl_pemusnahan'])); ?></td>
    <td><?php 
	//$q_teknisi=mysqli_fetch_array(mysqli_query($koneksi,"select * from tb_teknisi where id=".$data['id_teknisi'].""));
	echo $data['jam_mulai']; ?></td>
    <td><?php 
	//$q_lapor=mysqli_fetch_array(mysqli_query($koneksi,"select * from tb_laporan_kerusakan where id=".$data['id_lapor'].""));
	echo $data['jam_selesai']; ?></td>
    <td>
	<?php 
	//$q_lapor=mysqli_fetch_array(mysqli_query($koneksi,"select * from tb_laporan_kerusakan where id=".$data['id_lapor'].""));
	echo $data['nama_item']; ?>
	</td>
    <td><?php
	//$data2 = mysqli_fetch_array(mysqli_query($koneksi, "select * from tb_laporan_kerusakan where id=".$data['id_lapor'].""));
	 echo $data['jumlah_unit']; ?></td>
    <td><?php echo $data['uraian']; ?></td>
    <td><?php echo $data['lokasi']; ?></td>
    <td><a href="index.php?page=pemusnahan_alkes&id_aktor=<?php echo $data['idd']; ?>#lihatAktor"><span class="fa fa-eye"></span></a></td>
    <td align="center"><a href="pages/delete_pemusnahan.php?id_hapus=<?php echo $data['idd']; ?>" onClick="return confirm('Anda Yakin Akan Menghapus Data Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a> &nbsp;&nbsp;<a href="index.php?page=ubah_pemusnahan&id_ubah=<?php echo $data['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a> &nbsp;&nbsp;<a href="cetak_pemusnahan.php?id=<?php echo $data['idd']; ?>"><span data-toggle="tooltip" title="Download Berita Acara" class="glyphicon glyphicon-print"></span></a></td>
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
  
  <?php 
  $data2=mysqli_fetch_array(mysqli_query($koneksi, "select * from pemusnahan where id=".$_GET['id_aktor'].""));
  ?>
  <div id="lihatAktor" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Aktor</h3> 
     <form method="post">
     <strong>Penanggung Jawab :</strong>
     <input id="input" type="text" placeholder="Penanggung Jawab" readonly="readonly" value="<?php echo $data2['penanggung_jawab']; ?>">
     <strong>Disetujui Oleh :</strong>
     <input id="input" type="text" placeholder="Disetujui Oleh" readonly="readonly" value="<?php echo $data2['disetujui_oleh']; ?>">
     <strong>Disiapkan Oleh :</strong>
     <input id="input" type="text" placeholder="Disiapkan Oleh" readonly="readonly" value="<?php echo $data2['disiapkan_oleh']; ?>">
     <strong>Diperiksa Oleh :</strong>
     <input id="input" type="text" placeholder="Diperiksa Oleh" readonly="readonly" value="<?php echo $data2['diperiksa_oleh']; ?>">
    </form>
    </div>
</div>