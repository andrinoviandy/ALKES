<?php 
if (isset($_GET['id_hapus'])) {
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from biaya_lain where id=$_GET[id_hapus]"));
	if ($sel['jenis_transaksi']=='Pembayaran') {
	$up = mysqli_query($koneksi, "update biaya_lain,buku_kas set saldo=saldo+$sel[harga] where buku_kas.id=biaya_lain.buku_kas_id and biaya_lain.buku_kas_id=".$sel['buku_kas_id']."");
	} else {
	$up = mysqli_query($koneksi, "update biaya_lain,buku_kas set saldo=saldo-$sel[harga] where buku_kas.id=biaya_lain.buku_kas_id and biaya_lain.buku_kas_id=".$sel['buku_kas_id']."");
	}
	if ($up) { 
	$de = mysqli_query($koneksi, "delete from biaya_lain where id=$_GET[id_hapus]");
	$de2 = mysqli_query($koneksi, "delete from keuangan_detail where keuangan_id=$sel[keuangan_id]");
	$de3 = mysqli_query($koneksi, "delete from keuangan where id=$sel[keuangan_id]");
	if ($de) {
		echo "<script>
	alert('Data Berhasil Dihapus !');
	window.location='index.php?page=biaya_lain'</script>";
		}
	else {
		echo "<script>
	alert('Data Gagal Dihapus !');
	window.location='index.php?page=biaya_lain'</script>";
		}
	}
	
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Penerimaan &amp; Pembayaran Lain</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Biaya Lain</li>
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
              <a href="index.php?page=tambah_biaya_lain">
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah</button></a></div>
              
              <!--<form method="post" action="cetak_stok_alkes.php">--><!--<a href="cetak_stok_alkes.php">
              <button name="tambah_laporan" class="btn btn-warning" type="submit"><span class="fa fa-print"></span> Cetak Stok Alkes</button></a>
              <span class="pull pull-right"><font color="#FF0000">Keterangan :</font> Klik Nama Alkes Untuk Melihat Proses Penjualan</span>
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
              <div class="table-responsive">
              <table width="100%" id="example1" class="table table-bordered table-hover">
                <thead>
    <tr>
      <th align="center" valign="top">No</th>
      <th valign="top">Jenis Transaksi</th>
        <th valign="top">Tanggal</th>
        <th valign="top">Akun Kas &amp; Bank</th>
        <th valign="top"><strong>Diterima Oleh / Diterima Dari</strong></th>
        <th  valign="top">Deskripsi</th>
        <th valign="top"><strong>Harga</strong></th>
      <th width="16%" align="center" valign="top"><strong>Aksi</strong></th>
          </tr>
  </thead>
  <?php
 
// membuka file JSON
if (isset($_GET['id_keuangan'])) {
$file = file_get_contents("http://localhost/ALKES/json/biaya_lain.php?id_keuangan=$_GET[id_keuangan]");
} else {
$file = file_get_contents("http://localhost/ALKES/json/biaya_lain.php");
}
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
#C33 
$tambahan = $json[$i]['harga'] * $json[$i]['jumlah'];
?>

  <tr>
    <td align="center" valign="center"><?php echo $i+1; ?></td>
    <td valign="center"><?php echo $json[$i]['jenis_transaksi']; ?></td>
    <td valign="center"><?php echo date("d M Y",strtotime($json[$i]['tgl']));?></td>
    <td>
    <?php 
	$akun = mysqli_fetch_array(mysqli_query($koneksi, "select * from buku_kas where id=".$json[$i]['buku_kas_id'].""));
	echo $akun['nama_akun'];
	?>
    </td>
    <td><?php echo $json[$i]['penerima']; ?></td>
    
    <td>
      <?php echo $json[$i]['deskripsi'];  ?></td>
    <td><?php echo "Rp ".number_format($json[$i]['harga'],2,',','.'); ?></td>
    <td>
      <a href="index.php?page=biaya_lain&id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;&nbsp;
      <a href="index.php?page=ubah_biaya_lain&id_ubah=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a><br /> 
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
  $da = mysqli_fetch_array(mysqli_query($koneksi, "select *,buku_kas.id as ide from biaya_lain,buku_kas,pilihan_biaya where buku_kas.id=biaya_lain.buku_kas_id and biaya_lain.pilihan_biaya_id=pilihan_biaya.id and biaya_lain.id=$_GET[id_ubah]"));
  
  if (isset($_POST['ubah_riwayat'])) {
		$up=mysqli_query($koneksi, "update buku_kas set saldo=saldo+$da[harga] where buku_kas.id=$da[ide]");
		if ($up) {
			$up2=mysqli_query($koneksi, "update buku_kas set saldo=saldo-$_POST[harga2] where buku_kas.id=$_POST[buku_kas_id2]");
			
			$up3=mysqli_query($koneksi, "update biaya_lain set pilihan_biaya_id='".$_POST['pilihan_biaya_id2']."', harga='".$_POST['harga2']."',jumlah='".$_POST['jumlah2']."', tanggal='".$_POST['tanggal2']."', buku_kas_id=".$_POST['buku_kas_id2']." where id=$_GET[id_ubah]");
		}
	if ($up and $up2 and $up3) {
	echo "<script type='text/javascript'>
		alert('Perubahan Berhasil Disimpan !');
		window.location='index.php?page=biaya_lain'
		</script>";
	}else{
    echo "<script type='text/javascript'>
		alert('Perubahan Gagal Disimpan !');
		window.location='index.php?page=biaya_lain'
		</script>";
  }
	}
  ?>
  <div id="openUbah" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Ubah Biaya Lain</h3>  
     <form method="post">
     <label>No Akun</label>
              <select name="buku_kas_id2" class="form-control">
              <option>-- Pilih No Akun</option>
              <?php $query = mysqli_query($koneksi,"SELECT id,nama_akun FROM buku_kas"); 
              while ($row = mysqli_fetch_array($query)) {
              ?>
              <option value="<?php echo $row['id'];?>" <?php if($row['id'] == $da['ide']){echo "selected";} ?>><?php echo $row['nama_akun'];?></option>
              <?php } ?>
              </select>
              <br />
              <label>Pembayaran</label>
              <select name="pilihan_biaya_id2" class="form-control">
              <option>-- Pilih Biaya --</option>
              <?php $query1 = mysqli_query($koneksi,"SELECT * FROM pilihan_biaya");
              while ($row1= mysqli_fetch_array($query1)) {
              ?>
              <option value="<?php echo $row1['id']?>" <?php if($row1['id'] == $da['id']){echo "selected";} ?>><?php echo $row1['nama_biaya'];?></option>
              <?php }?>
              </select>
              <br />
              <label>Jumlah</label>
              <input name="jumlah2" class="form-control" type="number" placeholder="" value="<?php echo $da['jumlah'];?>"><br />
              <label>Harga</label>
              <input name="harga2" class="form-control" type="number" placeholder="" value="<?php echo $da['harga'];?>"><br />
              <label>Tanggal</label>
              <input name="tanggal2" class="form-control" type="date" placeholder="" value="<?php echo $da['tanggal'];?>"><br />
       <button name="ubah_riwayat" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan </button>
        </form>

              
    </div>
</div>