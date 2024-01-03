<?php 
if (isset($_GET['id_hapus'])) {
	$sl = mysqli_fetch_array(mysqli_query($koneksi, "select * from gaji_karyawan where id=".$_GET['id_hapus'].""));
	$del01 = mysqli_query($koneksi, "delete from keuangan_detail where keuangan_id=".$sl['keuangan_id']."");
	$del02 = mysqli_query($koneksi, "delete from keuangan where id=".$sl['keuangan_id']."");
	$del1 = mysqli_query($koneksi, "delete from gaji_karyawan_detail where gaji_karyawan_id=".$_GET['id_hapus']."");
	$del2 = mysqli_query($koneksi, "delete from gaji_karyawan where id=".$_GET['id_hapus']."");
	if ($del01 and $del02 and $del1 and $del2) {
		echo "<script>
	alert('Data Berhasil Dihapus !');
	window.location='index.php?page=gaji_karyawan'</script>";
		}
	else {
		echo "<script>
	alert('Data Gagal Dihapus !');
	window.location='index.php?page=gaji_karyawan'</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Gaji Karyawan</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Gaji Karyawan</li>
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
              <a href="index.php?page=tambah_gaji_karyawan">
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
        <th width="" valign="top">Tanggal Dikeluarkan Gaji</th>
        <th width="" valign="top">NIK</th>
        <th width="" valign="top"><strong>Nama Karyawan</strong></th>
        <th width="" valign="top">Jabatan</th>
        <th width="" valign="top">Divisi</th>
        <th width="" valign="top">Bulan &amp; Tahun</th>
        <th width="" valign="top">Jumlah Hari Kerja</th>
        <th width="" align="center" valign="top">Catatan</th>
        <th width="" align="center" valign="top">Home Pay</th>
        <th width="" align="center" valign="top">Detail Gaji</th>
        <th width="" align="center" valign="top"><strong>Aksi</strong></th>
          </tr>
  </thead>
  <?php
 
// membuka file JSON
$file = file_get_contents("http://localhost/ALKES/json/gaji_karyawan.php");
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
?>
  <tr>
    <td align="center"><?php echo $i+1; ?></td>
    <td><?php echo date("d/M/Y",strtotime($json[$i]['tgl_gaji']));  ?></td>
    <td><?php echo $json[$i]['nik'];  ?></td>
    
    <td>
    <?php echo $json[$i]['nama_karyawan'];  ?>
  </td>
    <td><?php echo $json[$i]['jabatan'];  ?></td>
    <td><?php echo $json[$i]['divisi']; ?></td>
    <td><?php echo $json[$i]['bulan_tahun'];  ?></td>
    <td><?php echo $json[$i]['jumlah_hari_kerja']." hari";  ?></td>
    <td><?php echo $json[$i]['catatan'];  ?></td>
    <td><?php $home_pay1=mysqli_fetch_array(mysqli_query($koneksi, "select sum(total) as jumlah from gaji_karyawan_detail,gaji where gaji.id=gaji_karyawan_detail.gaji_id and gaji.kategori='Penerimaan' and gaji_karyawan_id=".$json[$i]['idd'].""));
	$home_pay2=mysqli_fetch_array(mysqli_query($koneksi, "select sum(total) as jumlah from gaji_karyawan_detail,gaji where gaji.id=gaji_karyawan_detail.gaji_id and gaji.kategori='Pengeluaran' and gaji_karyawan_id=".$json[$i]['idd'].""));
	echo "Rp".number_format($home_pay1['jumlah']-$home_pay2['jumlah'],2,',','.');  ?></td>
    <td><a href="index.php?page=detail_gaji&id=<?php echo $json[$i]['idd'] ?>" data-toggle="tooltip" title="Detail Gaji"><span class="fa fa-toggle-right col-lg-1"></span></a></td>
    <td align="center">
      <a href="index.php?page=gaji_karyawan&id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;&nbsp;<a href="index.php?page=ubah_gaji_karyawan&id_ubah=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a><br />
      <a href="cetak_slip_gaji.php?id=<?php echo $json[$i]['idd'] ?>" data-toggle="tooltip" title="Cetak Slip Gaji" target="_blank"><span class="fa fa-print"></span></a>
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