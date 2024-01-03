<?php 
if (isset($_POST['button_urut'])) {
	echo "<script>window.location='cetak_stok_alkes.php?merk=$_POST[merk]'</script>";
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Gudang 2 (Utama)</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Alkes</li>
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
              <div class="input-group pull pull-left col-xs-1" style="padding-right:10px">
              <a href="index.php?page=tambah_barang_masuk">
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah Alkes</button></a></div>
              
              <!--<form method="post" action="cetak_stok_alkes.php">-->
              <form method="post">
              <div class="input-group pull pull-left col-xs-3">  
                <select class="form-control" name="merk" style="margin-right:40px">
                <option value="all">All Brand/Merk</option>
                <?php 
				$q = mysqli_query($koneksi, "select merk_brg from barang_gudang group by merk_brg order by merk_brg ASC");
				while ($d = mysqli_fetch_array($q)) {
				?>
                <option value="<?php echo $d['merk_brg']; ?>"><?php echo $d['merk_brg']; ?></option>
                <?php } ?>
                </select>
                <span class="input-group-btn">
                      <button type="submit" name="button_lihat" class="btn btn-info">Lihat</button>
                    </span>
                
              </div>
              </form>
              
              <form method="post" action="cetak_stok_alkes.php">
              <div class="input-group pull pull-left col-xs-3">  
                <select class="form-control" name="merk" style="margin-right:40px">
                <option value="all">All Brand/Merk</option>
                <?php 
				$q = mysqli_query($koneksi, "select merk_brg from barang_gudang group by merk_brg order by merk_brg ASC");
				while ($d = mysqli_fetch_array($q)) {
				?>
                <option value="<?php echo $d['merk_brg']; ?>"><?php echo $d['merk_brg']; ?></option>
                <?php } ?>
                </select>
                
                <span class="input-group-btn">
                      <button type="submit" name="button_urut" class="btn btn-warning">Cetak Stok Alkes</button>
                    </span>
                
              </div>
              </form>
              <!--<a href="cetak_stok_alkes.php">
              <button name="tambah_laporan" class="btn btn-warning" type="submit"><span class="fa fa-print"></span> Cetak Stok Alkes</button></a>-->
              <span class="pull pull-right"><font color="#FF0000">Keterangan :</font> Klik Nama Alkes Untuk Melihat Proses Penjualan</span>
              <br /><br />
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
              <table width="100%" id="example1" class="table table-bordered table-hover">
                <thead>
    <tr>
      <td align="center">&nbsp;</th>
        <th valign="top"><strong>Nama Alkes</strong></th>
        <th valign="top">NIE</th>
      <th valign="top"><strong>Merk</strong></th>
      <th valign="top"><strong>Tipe</strong></th>
      <!--<th valign="top">NIE</th>
      <th valign="top">No. Bath</th>
      <th valign="top">No. Lot</th>-->
      <th valign="top"><strong>Negara Asal</strong></th>
      <th align="center" valign="top"><strong>Stok    
        
        </strong></th>
        <th align="center" valign="top"><strong>Deskripsi Alat        
        </strong></th>
        <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator'])) { ?>
        <th align="center" valign="top"><strong>Harga Beli        
        </strong></th>
        <th align="center" valign="top"><strong>Harga Jual        
        </strong></th>
        <?php } ?>
        <th align="center" valign="top"><strong>Pengecekan Teknisi</strong>        </th>
        <th align="center" valign="top"><strong>Aksi</strong></th>
          </tr>
  </thead>
  <?php
 
// membuka file JSON
$file = file_get_contents("http://localhost/ALKES/json/barang_masuk.php");
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
?>
  <tr>
    <td align="center"><?php echo $i+1; ?></td>
    
    <td>
    <?php echo $json[$i]['nama_brg']; ?>
  </td>
    <td><?php echo $json[$i]['nie_brg']; ?></td>
    
      <td><?php echo $json[$i]['merk_brg']; ?></td>
    <td><?php echo $json[$i]['tipe_brg']; ?></td>
    <!--<td><?php echo $data['nie_brg']; ?></td>
    <td><?php echo $json[$i]['no_bath']; ?></td>
    <td><?php echo $json[$i]['no_lot']; ?></td>-->
    <td><?php echo $json[$i]['negara_asal']; ?></td>
    <?php if ($json[$i]['stok_total']==0) { $color="red"; } else { $color=""; } ?>
    <td align="center" style="background-color:<?php echo $color; ?>"><?php echo $json[$i]['stok_total']; ?></td>
    <td align="center"><?php echo $json[$i]['deskripsi_alat']; ?></td>
    <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator'])) { ?>
    <td align="center"><?php echo "Rp ".number_format($json[$i]['harga_beli'],0,',','.').",-"; ?></td>
    <td align="center"><?php echo "Rp ".number_format($json[$i]['harga_satuan'],0,',','.').",-"; ?></td>
    <?php } ?>
    <td align="center"><?php if ($json[$i]['status_cek']==0) {
		echo "<img src='img/x.png' width='14'/>";
		} else {
			echo "<img src='img/y.png' width='14'/>";
			} ?></td>
    <td align="center">
    <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator'])) { ?>
    <a href="index.php?page=simpan_tambah_aksesoris&id=<?php echo $json[$i]['id']; ?>"><small data-toggle="tooltip" title="Kelola Aksesoris" class="label bg-green"><span class="fa fa-cogs"></span>&nbsp; Akse</small></a>&nbsp;<a href="index.php?page=simpan_tambah_spesifikasi&id=<?php echo $json[$i]['id']; ?>"><small data-toggle="tooltip" title="Kelola Spesifikasi" class="label bg-blue"><span class="fa fa-cogs"></span>&nbsp; Spes</small></a>&nbsp;<a href="cetak_rekapan_alkes.php?id=<?php echo $json[$i]['id']; ?>"><small data-toggle="tooltip" title="Rekap Alkes" class="label bg-yellow">Excel</small></a><br />
    <a href="pages/delete_barang_masuk.php?id_hapus=<?php echo $json[$i]['id']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a> &nbsp;<a href="index.php?page=ubah_barang_masuk&id=<?php echo $json[$i]['id']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>
      <?php } ?>
<?php if (isset($_SESSION['user_admin_gudang']) && isset($_SESSION['pass_admin_gudang'])) { ?>
<a href="index.php?page=simpan_tambah_aksesoris&id=<?php echo $json[$i]['id']; ?>"><small data-toggle="tooltip" title="Kelola Aksesoris" class="label bg-green"><span class="fa fa-cogs"></span>&nbsp; Akse</small></a>&nbsp;<a href="index.php?page=simpan_tambah_spesifikasi&id=<?php $json[$i]['id']; ?>"><small data-toggle="tooltip" title="Kelola Spesifikasi" class="label bg-blue"><span class="fa fa-cogs"></span>&nbsp; Spes</small></a>&nbsp;<a href="cetak_rekapan_alkes.php?id=<?php echo $json[$i]['id']; ?>"><small data-toggle="tooltip" title="Rekap Alkes" class="label bg-yellow">Excel</small></a><br />
<a href="index.php?page=ubah_barang_masuk&id=<?php echo $json[$i]['id']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>
<?php } ?>
      <!-- Tombol Jual -->
	  
	  <?php /* if ($data['stok_total']!=0 and $data['status_cek']!=0) { ?>
      &nbsp;<a href="index.php?page=barang_masuk&id=<?php echo $data['idd']; ?>#openPilihan"><small data-toggle="tooltip" title="Jual Alkes" class="label bg-blue">Jual</small></a>
      <!--&nbsp;<a href="index.php?page=jual_barang2&id=<?php //echo $data['idd']; ?>"><small data-toggle="tooltip" title="Jual Alkes" class="label bg-blue">Jual</small>-->
      <?php } */ ?>
      
    </td>
  </tr>
  <?php } ?>
</table><br />

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
 

<div id="openPilihan" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <br />
        <a href="index.php?page=jual_barang2&id=<?php echo $_GET['id']; ?>"><button id="buttonn">Data Dinas/RS/Puskesmas/Klinik Baru</button></a>
        <a href="index.php?page=jual_barang3&id=<?php echo $_GET['id']; ?>"><button id="buttonn">Dari Data Dinas/RS/Puskesmas/Klinik<br />Yang Sudah Terinput</button></a>
    </div>
</div>


