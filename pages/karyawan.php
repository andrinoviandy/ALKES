<?php 
if (isset($_GET['id_hapus'])) {
	$del2 = mysqli_query($koneksi, "delete from karyawan where id=".$_GET['id_hapus']."");
	if ($del2) {
		echo "<script>
	alert('Data Berhasil Dihapus !');
	window.location='index.php?page=karyawan'</script>";
		}
	else {
		echo "<script>
	alert('Data Gagal Dihapus !');
	window.location='index.php?page=karyawan'</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Karyawan</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Karyawan</li>
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
              <div class="box-body">
              <div class="input-group pull pull-left col-xs-1" style="padding-right:10px">
              <a href="index.php?page=tambah_karyawan">
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah</button></a></div>
              
              <!--<form method="post" action="cetak_stok_alkes.php">--><!--<a href="cetak_stok_alkes.php">
              <button name="tambah_laporan" class="btn btn-warning" type="submit"><span class="fa fa-print"></span> Cetak Stok Barang</button></a>
              <span class="pull pull-right"><font color="#FF0000">Keterangan :</font> Klik Nama Barang Untuk Melihat Proses Penjualan</span>
              --><br /><br />
              <!--
              <form method="post">
              <div class="input-group pull pull-left col-xs-1">
                
                <select class="form-control" name="limiterr" style="margin-right:40px">
                <option <?php if ($limiter['limiter']==10) {echo "selected";} ?> value="10">10</option>
                <option <?php if ($limiter['limiter']==50) {echo "selected";} ?> value="50">50</option>
                <option <?php if ($limiter['limiter']==100) {echo "selected";} ?> value="100">100</option>
                <option <?php if ($limiter['limiter']==500) {echo "selected";} ?> value="500">500</option>
                <option <?php if ($limiter['limiter']==1000) {echo "selected";} ?> value="1000">1000</option>
                <?php 
				$total=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang"));
				?>
                <option <?php if ($limiter['limiter']==$total) {echo "selected";} ?> <?php if ($_POST['cari']!='') {echo "selected";} ?> value="<?php echo $total; ?>">All</option>
                </select>
                
                <span class="input-group-btn">
                      <button type="submit" name="button_limit" class="btn btn-default btn-flat"><i class="fa fa-check"></i></button>
                    </span>
                
              </div>
              </form>
              
              <form method="post">
              <div class="input-group pull pull-left col-xs-2">
                
                <select class="form-control" name="urutt" style="margin-right:40px">
                <option <?php if ($limiter['urut']=='ASC') {echo "selected";} ?> value="ASC">Ascending</option>
                <option <?php if ($limiter['urut']=='DESC') {echo "selected";} ?> value="DESC">Descending</option>
                
                </select>
                
                <span class="input-group-btn">
                      <button type="submit" name="button_urut" class="btn btn-default btn-flat"><i class="fa fa-check"></i></button>
                    </span>
                
              </div>
              </form>
              
              <form method="post" class="">
              <div class="input-group input-group-md col-xs-4 pull pull-right">
                <input type="text" name="cari" placeholder="Keyword .. (Not ; Stok, Harga, Pengecekan)" class="form-control">
                    <span class="input-group-btn">
                      <button type="submit" name="button_cari" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari </button>
                    </span>
              </div>
              </form>-->
              <br />
              
              <?php
              if ($_POST['cari']!='') {
                echo "Results  Of  '".$_POST['cari']."'";
			  	}
				?>
                <div class="table-responsive">
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td width="" align="center"><strong>No</strong>
        </th>
        <th width="" valign="top">NIK</th>
        <th width="" valign="top"><strong>Nama Karyawan</strong></th>
        <th width="" valign="top">TTL</th>
        <th width="" valign="top">Alamat</th>
        <th width="" valign="top">Pendidikan Terakhir</th>
        <th width="" valign="top">Jabatan</th>
        <th width="" valign="top">Divisi</th>
        <th width="" valign="top">Tanggal Masuk</th>
      <th width="" valign="top">Email</th>
      <th width="" align="center" valign="top"><strong>Aksi</strong></th>
          </tr>
  </thead>
  <?php
	  $query = mysqli_query($koneksi, "SELECT *,karyawan.id as idd FROM karyawan order by karyawan.nama_karyawan ASC");

  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td><?php echo $data['nik'];  ?></td>
    
    <td>
    <?php echo $data['nama_karyawan'];  ?>
  </td>
    <td><?php echo $data['tempat_lahir'].", ".date("d-m-Y",strtotime($data['tanggal_lahir']));  ?></td>
    <td><?php echo $data['alamat']; ?></td>
    <td><?php echo $data['pendidikan_terakhir'];  ?></td>
    <td><?php echo $data['nama_jabatan'];  ?></td>
    <td><?php echo $data['nama_divisi'];  ?></td>
    <td><?php echo date("d-m-Y",strtotime($data['tanggal_masuk']));  ?></td>
    
      <td><?php echo $data['email']; ?></td>
      <td>
        <a href="index.php?page=karyawan&id_hapus=<?php echo $data['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;&nbsp;<a href="index.php?page=ubah_karyawan&id_ubah=<?php echo $data['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>
        
      </td>
  </tr>
  <?php } ?>
</table>
                </div>
                <br />

              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

  </section>
    <!-- /.content -->
  </div>
  <?php 
  if (isset($_POST['ubahbukti'])) {
	$qq = mysqli_fetch_array(mysqli_query($koneksi, "select * from karyawan where id=".$_GET['id_bukti'].""));
	unlink("gambar_foto/foto_karyawan/$qq[foto]");
	
	$ext2 = explode(".",$_FILES['foto']['name']);
	$lamp_f=$_GET['id_bukti'].".".$ext2[1];
	
	$u2=mysqli_query($koneksi, "update karyawan set foto='".$lamp_f."' where id=".$_GET['id_bukti']."");
	if ($u2) {
		copy($_FILES['foto']['tmp_name'], "gambar_foto/foto_karyawan/".$lamp_f);
		echo "<script type='text/javascript'>
		alert('Berhasil Di Ubah !');
		window.location='index.php?page=karyawan';
		</script>";
		}
	
	}
  ?>
  <div id="ubah_bukti" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Ubah Foto</h3>
        <form method="post" enctype="multipart/form-data" >
              <input name="foto" type="file" class="form-control"/>
              <br />
              <button name="ubahbukti" class="form-control btn btn-success" type="submit">Simpan</button>
              <br />
              </form>
              </form>
              
    </div>
</div>