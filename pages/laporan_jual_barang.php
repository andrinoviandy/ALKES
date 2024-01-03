<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan  Alkes Terjual
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Laporan  Alkes Terjual</li>
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
          <div class="box box-info"><!-- /.chat -->
            <div class="box-footer">
              <div class="box-body table-responsive no-padding">
              <div class="">
              <form method="post" action="cetak_laporan_jual_barang.php">
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
              </form>
              <span class="pull pull-right">&nbsp;&nbsp;&nbsp;</span>
              <br /><br />
              
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td align="center">&nbsp;</th>
        
        <th align="center"><strong>Tanggal Jual</strong></th>
      <th align="center"><strong>Nama Alkes</strong></th>
      <th align="center">No Seri</th>
      <th align="center"><strong>Pembeli</strong></th>
      <th align="center">Alamat</th>
      <th align="center">Kontak</th>
      <th align="center"><strong>Qty</strong></th>
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
	  
	  
	  else if (isset ($_GET['id_lihat_jual'])) {
		  if (isset($_POST['nama_barang'])) { 
  $cari=$_POST['nama_barang'];
  $query = mysqli_query($koneksi, "select *,jual_barang.id as idd from master_barang,jual_barang where master_barang.id=jual_barang.id_master_brg and nama_brg like '%$cari%' order by tgl_beli DESC");
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
  $query = mysqli_query($koneksi, "select *,jual_barang.id as idd from master_barang,jual_barang where master_barang.id=jual_barang.id_master_brg and no_seri_brg like '%$cari%' order by tgl_beli DESC");
  }
  else if (isset($_POST['tgl_jual'])) { 
  $cari=$_POST['tgl_jual'];
  $query = mysqli_query($koneksi, "select *,jual_barang.id as idd from master_barang,jual_barang where master_barang.id=jual_barang.id_master_brg and tgl_beli like '%$cari%' order by tgl_beli DESC");
  }
  else if (isset($_POST['pembeli'])) { 
  $cari=$_POST['pembeli'];
  $query = mysqli_query($koneksi, "select *,jual_barang.id as idd from master_barang,jual_barang where master_barang.id=jual_barang.id_master_brg and pembeli like '%$cari%' order by tgl_beli DESC");
  }
  else if (isset($_POST['nominal'])) { 
  $cari=$_POST['nominal'];
  $query = mysqli_query($koneksi, "select *,jual_barang.id as idd from master_barang,jual_barang where master_barang.id=jual_barang.id_master_brg and qty like '%$cari%' order by tgl_beli DESC");
  }
   else {
	  $query = mysqli_query($koneksi, "select *,jual_barang.id as idd from master_barang,jual_barang where master_barang.id=jual_barang.id_master_brg and jual_barang.id_master_brg=".$_GET['id_lihat_jual']." order by tgl_beli DESC");
	  }
		  }
	
	
	//else
	else {
		if (isset($_POST['nama_barang'])) { 
  $cari=$_POST['nama_barang'];
  $query = mysqli_query($koneksi, "select *,jual_barang.id as idd from master_barang,jual_barang where master_barang.id=jual_barang.id_master_brg and nama_brg like '%$cari%' order by tgl_beli DESC");
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
  $query = mysqli_query($koneksi, "select *,jual_barang.id as idd from master_barang,jual_barang where master_barang.id=jual_barang.id_master_brg and no_seri_brg like '%$cari%' order by tgl_beli DESC");
  }
  else if (isset($_POST['tgl_jual'])) { 
  $cari=$_POST['tgl_jual'];
  $query = mysqli_query($koneksi, "select *,jual_barang.id as idd from master_barang,jual_barang where master_barang.id=jual_barang.id_master_brg and tgl_beli like '%$cari%' order by tgl_beli DESC");
  }
  else if (isset($_POST['pembeli'])) { 
  $cari=$_POST['pembeli'];
  $query = mysqli_query($koneksi, "select *,jual_barang.id as idd from master_barang,jual_barang where master_barang.id=jual_barang.id_master_brg and pembeli like '%$cari%' order by tgl_beli DESC");
  }
  else if (isset($_POST['nominal'])) { 
  $cari=$_POST['nominal'];
  $query = mysqli_query($koneksi, "select *,jual_barang.id as idd from master_barang,jual_barang where master_barang.id=jual_barang.id_master_brg and qty like '%$cari%' order by tgl_beli DESC");
  }
   else {
	  $query = mysqli_query($koneksi, "select *,jual_barang.id as idd from master_barang,jual_barang where master_barang.id=jual_barang.id_master_brg order by jual_barang.id DESC");
	  }
		}
  
  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td>
    <?php if ($data['tgl_kirim']!='0000-00-00') { ?>
    <a href="index.php?page=kirim_barang&id_krm=<?php echo $data['id']; ?>"><?php echo date("d F Y",strtotime($data['tgl_beli'])); ?></a>
    <?php } else {
	echo date("d F Y",strtotime($data['tgl_beli']));	
	}?>
    </td>
    <td><?php echo $data['nama_brg']; ?></td>
    <td><?php echo $data['no_seri_brg']; ?></td>
    <td><?php echo $data['pembeli']; ?></td>
    <td><?php echo $data['alamat_pembeli']; ?></td>
    <td><?php echo $data['telp_pembeli']; ?></td>
    <td><?php echo $data['qty']; ?></td>
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
if (isset($_POST['kirim_barang'])) {
	$update = mysqli_query($koneksi, "update jual_barang set tgl_kirim='".$_POST['tgl_kirim']."', ket_brg='".$_POST['keterangan']."' where id=".$_GET['id']."");
	if ($update) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Simpan !');
		window.location='index.php?page=kirim_barang&id_krm=".$_GET['id']."';
		</script>";
		}
	else {
		echo "<script type='text/javascript'>
		alert('Gagal Disimpan');
		</script>";
		}
	}
?>
  <div id="openKirim" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Kirim Alkes</h3> 
     <form method="post">
     <label>Tanggal Kirim</label>
     <input id="input" type="date" placeholder="" name="tgl_kirim" required>
     <label>Keterangan</label>
     <input id="input" type="text" placeholder="Keterangan" name="keterangan" required>
        <button id="buttonn" name="kirim_barang" type="submit">Kirim Alkes</button>
    </form>
    </div>
</div>
