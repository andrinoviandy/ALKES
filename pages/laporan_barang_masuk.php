
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan Alkes
     Masuk</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Laporan Alkes Masuk</li>
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
              <form method="post" action="cetak_laporan_barang_masuk.php">
              
                <!-- /.col-lg-6 -->
                
                <button class="btn btn-success" type="submit"><span class="fa fa-print"></span> Cetak Excel</button>
              </form>
              <br />
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td align="center">&nbsp;</th>
        
        <th><strong>Nama Alkes</strong></th>
      <th><strong>Merk</strong></th>
      <th><strong>Tipe</strong></th>
      <th><strong>No Seri</strong></th>
      <th>NIE</th>
      <th><strong>Negara Asal</strong></th>
      <td align="center"><strong>Stok    
        
        </strong>
        
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
  $query = mysqli_query($koneksi, "select *,master_barang.id as idd from master_barang where nama_brg like '%$cari%' order by nama_brg ASC");
  }
  else if (isset($_POST['merk'])) { 
  $cari=$_POST['merk'];
  $query = mysqli_query($koneksi, "select *,master_barang.id as idd from master_barang where merk_brg like '%$cari%' order by nama_brg ASC");
  }
  else if (isset($_POST['no_seri'])) { 
  $cari=$_POST['no_seri'];
  $query = mysqli_query($koneksi, "select *,master_barang.id as idd from master_barang where no_seri_brg like '%$cari%' order by nama_brg ASC");
  }
  else if (isset($_POST['tipe'])) { 
  $cari=$_POST['tipe'];
  $query = mysqli_query($koneksi, "select *,master_barang.id as idd from master_barang where tipe_brg like '%$cari%' order by nama_brg ASC");
  }
  else if (isset($_POST['negara_asal'])) { 
  $cari=$_POST['negara_asal'];
  $query = mysqli_query($koneksi, "select *,master_barang.id as idd from master_barang where negara_asal like '%$cari%' order by nama_brg ASC");
  }
  else if (isset($_POST['stok'])) { 
  $cari=$_POST['stok'];
  $query = mysqli_query($koneksi, "select *,master_barang.id as idd from master_barang where stok like '%$cari%' order by nama_brg ASC");
  }
   else {
	  $query = mysqli_query($koneksi, "select *,master_barang.id as idd from master_barang order by id DESC");
	  }
		  }
  
  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td><a href="index.php?page=jual_barang&id_lihat_jual=<?php echo $data['idd']; ?>"><?php echo $data['nama_brg']; ?></a>
    <?php 
	$querii=mysqli_num_rows(mysqli_query($koneksi, "select * from jual_barang where id_master_brg=".$data['idd'].""));
	if ($querii!=0) {
		?>
    <span class="label label-primary pull-right"><?php echo $querii; ?></span>
    <?php } ?>
    </td>
    
      <td><?php echo $data['merk_brg']; ?></td>
    <td><?php echo $data['tipe_brg']; ?></td>
    <td><?php echo $data['no_seri_brg']; ?></td>
    <td><?php echo $data['nie_brg']; ?></td>
    <td><?php echo $data['negara_asal']; ?></td>
    <td align="center"><?php echo $data['stok']; ?></td>
    
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
  