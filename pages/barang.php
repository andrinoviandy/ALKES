
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kerusakan Alkes
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kerusakan Alkes</li>
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
              <a href="index.php?page=tambah_barang">
              <button name="tambah_laporan" class="btn btn-warning" type="submit"><span class="fa fa-plus"></span> Tambah Alkes Rusak</button></a>
              <font class="pull pull-right">Keterangan : Dalam Kota <strong>Biru</strong> Yang berisikan <strong>Angka</strong> , Itu Menandakan Berapa Banyak Barang Dilaporkan</font>
              <br /><br />
              
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td align="center">&nbsp;</th>
        <th><strong>Akun</strong></th>
      <th><strong>Nama Alkes</strong></th>
      <th><strong>Merk</strong></th>
      <th><strong>Tipe</strong></th>
      <th><strong>No Seri</strong></th>
      <th><strong>Kepemilikan</strong></th>
      <th><strong>Deskripsi</strong></th>
      <td align="center"><strong>Aksi</strong></th>
        </tr>
  </thead>
  <?php
  if (isset($_SESSION['id'])) {
	  if (isset($_POST['nama_barang'])) { 
  $cari=$_POST['nama_barang'];
  $query = mysqli_query($koneksi, "select *,barang.id as idd from barang,akun where akun.id=barang.id_akun and akun.id=".$_SESSION['id']." and nama_barang like '%$cari%' order by nama_barang DESC");
  }
   else if (isset($_POST['akun'])) { 
  $cari=$_POST['akun'];
  $query = mysqli_query($koneksi, "select *,barang.id as idd from barang,akun where akun.id=barang.id_akun and akun.id=".$_SESSION['id']." and akun.nama like '%$cari%' order by barang.nama_barang DESC");
  }
  else if (isset($_POST['merk'])) { 
  $cari=$_POST['merk'];
  $query = mysqli_query($koneksi, "select *,barang.id as idd from barang,akun where akun.id=barang.id_akun and akun.id=".$_SESSION['id']." and merk like '%$cari%' order by nama_barang DESC");
  }
  else if (isset($_POST['no_seri'])) { 
  $cari=$_POST['no_seri'];
  $query = mysqli_query($koneksi, "select *,barang.id as idd from barang,akun where akun.id=barang.id_akun and akun.id=".$_SESSION['id']." and no_seri like '%$cari%' order by nama_barang DESC");
  }
  else if (isset($_POST['tipe'])) { 
  $cari=$_POST['tipe'];
  $query = mysqli_query($koneksi, "select *,barang.id as idd from barang,akun where akun.id=barang.id_akun and akun.id=".$_SESSION['id']." and tipe like '%$cari%' order by nama_barang DESC");
  }
  else if (isset($_POST['pemilik'])) { 
  $cari=$_POST['pemilik'];
  $query = mysqli_query($koneksi, "select *,barang.id as idd from barang,akun where akun.id=barang.id_akun and akun.id=".$_SESSION['id']." and kepemilikan like '%$cari%' order by nama_barang DESC");
  }
  else if (isset($_POST['deskripsi'])) { 
  $cari=$_POST['deskripsi'];
  $query = mysqli_query($koneksi, "select *,barang.id as idd from barang,akun where akun.id=barang.id_akun and akun.id=".$_SESSION['id']." and deskripsi like '%$cari%' order by nama_barang DESC");
  }
   else {
	  $query = mysqli_query($koneksi, "select *,barang.id as idd from barang,akun where akun.id=barang.id_akun and akun.id=".$_SESSION['id']." order by nama_barang DESC");
	  }
	  } 
	  
	  
	  else {
		  if (isset($_POST['nama_barang'])) { 
  $cari=$_POST['nama_barang'];
  $query = mysqli_query($koneksi, "select *,barang.id as idd from barang,akun where akun.id=barang.id_akun and nama_barang like '%$cari%' order by nama_barang DESC");
  }
   else if (isset($_POST['akun'])) { 
  $cari=$_POST['akun'];
  $query = mysqli_query($koneksi, "select *,barang.id as idd from barang,akun where akun.nama like '%$cari%' and akun.id=barang.id_akun order by barang.nama_barang DESC");
  }
  else if (isset($_POST['merk'])) { 
  $cari=$_POST['merk'];
  $query = mysqli_query($koneksi, "select *,barang.id as idd from barang,akun where akun.id=barang.id_akun and merk like '%$cari%' order by nama_barang DESC");
  }
  else if (isset($_POST['no_seri'])) { 
  $cari=$_POST['no_seri'];
  $query = mysqli_query($koneksi, "select *,barang.id as idd from barang,akun where akun.id=barang.id_akun and no_seri like '%$cari%' order by nama_barang DESC");
  }
  else if (isset($_POST['tipe'])) { 
  $cari=$_POST['tipe'];
  $query = mysqli_query($koneksi, "select *,barang.id as idd from barang,akun where akun.id=barang.id_akun and tipe like '%$cari%' order by nama_barang DESC");
  }
  else if (isset($_POST['pemilik'])) { 
  $cari=$_POST['pemilik'];
  $query = mysqli_query($koneksi, "select *,barang.id as idd from barang,akun where akun.id=barang.id_akun and kepemilikan like '%$cari%' order by nama_barang DESC");
  }
  else if (isset($_POST['deskripsi'])) { 
  $cari=$_POST['deskripsi'];
  $query = mysqli_query($koneksi, "select *,barang.id as idd from barang,akun where akun.id=barang.id_akun and deskripsi like '%$cari%' order by nama_barang DESC");
  }
   else {
	  $query = mysqli_query($koneksi, "select *,barang_rusak.id as idd from barang_rusak,akun where akun.id=barang_rusak.id_akun order by barang_rusak.id DESC");
	  }
		  }
  
  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td><?php 
	$dataa=mysqli_fetch_array(mysqli_query($koneksi,"select * from akun where id=".$data['id_akun'].""));
	echo $dataa['nama']; ?></td>
    <td>
    <?php 
	$q=mysqli_num_rows(mysqli_query($koneksi, "select * from tb_laporan_kerusakan where id_barang=".$data['idd'].""));
	if ($q!=0) { ?>
    <a href="index.php?page=laporan_kerusakan&id_l=<?php echo $data['idd']; ?>"><?php echo $data['nama_barang']; ?></a> <?php } 
	else { 
	echo $data['nama_barang']; 
	}
	?>
    <?php 
	$querii=mysqli_num_rows(mysqli_query($koneksi, "select * from tb_laporan_kerusakan where id_barang=".$data['idd'].""));
	if ($querii>0) {
		?>
    <span class="label label-primary pull-right"><?php echo $querii; ?></span>
    <?php } ?>
    </td>
    <td><?php echo $data['merk']; ?></td>
    <td><?php echo $data['tipe']; ?></td>
    <td><?php echo $data['no_seri']; ?></td>
    <td><?php echo $data['kepemilikan']; ?></td>
    <td><?php echo $data['deskripsi']; ?></td>
    
    <td align="center"><a href="pages/delete_barang.php?id_hapus=<?php echo $data['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a> &nbsp;&nbsp;<a href="index.php?page=ubah_barang&id=<?php echo $data['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a> &nbsp;&nbsp; 
	
    <a href="index.php?page=lapor_barang&id=<?php echo $data['idd']; ?>"><small data-toggle="tooltip" title="Lapor Kerusakan" class="label bg-blue">Lapor</small></a>
    
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