<?php 
if (isset($_GET['id_hapus'])) {
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from reimburse where id=$_GET[id_hapus]"));
	$up = mysqli_query($koneksi, "update reimburse,buku_kas set saldo=saldo+$sel[nominal] where buku_kas.id=reimburse.buku_kas_id and reimburse.buku_kas_id=".$sel['buku_kas_id']."");
	if ($up) { 
	$de = mysqli_query($koneksi, "delete from reimburse where id=$_GET[id_hapus]");
	}
	echo "<script>window.location='index.php?page=reimburse'</script>";
	}
	

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Reimburse</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Reimburse</li>
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
              <a href="index.php?page=tambah_reimburse">
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
        <th width="" valign="top">ID</th>
        <th width="" valign="top">Tanggal</th>
        <th width="" valign="top"><strong>Nama Akun</strong></th>
        <th width="" valign="top">Keterangan</th>
        <th width="" valign="top">Buku Kas</th>
      <th width="" valign="top"><strong>Nominal</strong></th>
      <th width="" align="center" valign="top">Deskripsi</th>
      <th width="" align="center" valign="top"><strong>Aksi</strong></th>
          </tr>
  </thead>
  <?php
 
// membuka file JSON
$file = file_get_contents("http://localhost/ALKES/json/reimburse.php");
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
#C33
?>
<?php if ($json[$i]['status_lunas']==0){$b="#FF0000";} else {$b="#00CC66";} ?>
  <tr>
    <td><?php echo "RE".$json[$i]['idd']; ?></td>
    <td><?php echo date("d/m/Y", strtotime($json[$i]['tgl_reimburse']));  ?></td>
    
    <td>
    <?php echo $json[$i]['nama_akun_reimburse'];  ?>
    </td>
    <td><?php echo $json[$i]['keterangan']; ?></td>
    <td><?php echo $json[$i]['nama_akun']; ?></td>
      <td><?php echo "Rp ".number_format($json[$i]['nominal'],2,',','.'); ?></td>
      <td>Di kantor di tambah</td>

    <td>
      <a href="index.php?page=reimburse&id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;&nbsp;
      <a href="index.php?page=ubah_reimburse&id_ubah=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a></td>
    
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
  $da = mysqli_fetch_array(mysqli_query($koneksi, "select *,buku_kas.id as idd from reimburse,buku_kas where buku_kas.id=reimburse.buku_kas_id and reimburse.id=$_GET[id_ubah]"));
  
  if (isset($_POST['ubah_riwayat'])) {
		$up=mysqli_query($koneksi, "update buku_kas set saldo=saldo+$da[nominal] where buku_kas.id=$da[idd]");
		if ($up) {
			$up2=mysqli_query($koneksi, "update buku_kas set saldo=saldo-$_POST[nominal2] where buku_kas.id=$_POST[akun2]");
			
			$up3=mysqli_query($koneksi, "update reimburse set nama_akun_reimburse='".$_POST['nama_akun_reimburse2']."', nominal='".$_POST['nominal2']."', keterangan='".$_POST['keterangan2']."', buku_kas_id=".$_POST['akun2']." where id=$_GET[id_ubah]");
			// if ($up3) {
			// $sel = mysqli_fetch_array(mysqli_query($koneksi, "select sum(nominal) as jumlah from utang_piutang_bayar where utang_piutang_id=$_GET[id]"));
			// if ($sel['jumlah']>=$data['nominal']) {
			// mysqli_query($koneksi, "update utang_piutang set status_lunas=1 where id=$_GET[id]");
			// } else {
			// 	mysqli_query($koneksi, "update utang_piutang set status_lunas=0 where id=$_GET[id]");
			// 	}
		}
	if ($up and $up2 and $up3) {
	echo "<script type='text/javascript'>
		alert('Perubahan Berhasil Disimpan !');
		window.location='index.php?page=reimburse'
		</script>";
	}
	}
  ?>
  <div id="openUbah" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Ubah Riwayat Pembayaran</h3>
         
     <form method="post">
              <label>Nama Akun</label>
              <input name="nama_akun_reimburse2" class="form-control" type="text" placeholder="" required="required" value="<?php echo $da['nama_akun_reimburse']; ?>"><br />
              <label>Nominal</label>
              <input name="nominal2" class="form-control" type="number" placeholder="" required="required" value="<?php echo $da['nominal']; ?>"><br />
              <label>Keterangan</label>
                <textarea name="keterangan2" class="form-control" rows="4" required="required"><?php echo $da['keterangan']; ?></textarea>
                <br />
              
              <label>Akun</label>
              <select name="akun2" id="akun2" class="form-control" required>
              <option value="">-- Pilih --</option>
              <?php
              $q = mysqli_query($koneksi, "select * from buku_kas order by no_akun ASC");
			  while ($d=mysqli_fetch_array($q)) {
			  ?>
              <option <?php if ($da['idd']==$d['id']) {echo "selected";} ?> value="<?php echo $d['id']; ?>"><?php echo $d['no_akun']." | &nbsp;&nbsp;".$d['nama_akun']; ?></option>
              <?php } ?>
              </select><br />
              
       <button name="ubah_riwayat" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan </button>
        </form>
              
    </div>
</div>


