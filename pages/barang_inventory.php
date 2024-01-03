<?php 
if (isset($_POST['button_urut'])) {
	echo "<script>window.location='cetak_stok_alkes.php?merk=$_POST[merk]'</script>";
	}

if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from barang_inventory where id=$_GET[id_hapus]");
	if ($del) {
		echo "<script>window.location='index.php?page=barang_inventory'</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Barang Inventory</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Inventory</li>
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
              <a href="index.php?page=tambah_barang_inventory">
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah Barang Baru</button></a></div>
              
              <!--<form method="post" action="cetak_stok_alkes.php">-->
              
              <form method="post" action="cetak_stok_alkes.php">
              <div class="input-group pull pull-left col-xs-3">  
                <select class="form-control" name="merk" style="margin-right:40px">
                <option value="all">All Brand/Merk</option>
                <?php 
				$q = mysqli_query($koneksi, "select merk_brg from barang_inventory group by merk_brg order by merk_brg ASC");
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
              
              <table width="100%" id="example1" class="table table-responsive">
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
      <th align="center" valign="top"><strong>Stok Gudang   
        
        </strong></th>
        <th>Stok PO</th>
        <th>Stok Sisa</th>
      <th align="center" valign="top">Terkirim</th>
      <th align="center" valign="top">Rusak</th>
        <th align="center" valign="top"><strong>Deskripsi Alat        
        </strong></th>
        <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator']) or isset($_SESSION['user_admin_keuangan']) && isset($_SESSION['pass_admin_keuangan'])) { ?>
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
$file = file_get_contents("http://localhost/ALKES/json/barang_inventory.php");
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
    <td align="center"><?php 
	$stok_po1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual) as stok_po from barang_dijual_qty where barang_gudang_id=".$json[$i]['idd'].""));
	$stok_po2 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim_detail,barang_gudang_detail,barang_dijual_qty where barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual_qty.id=barang_dikirim_detail.barang_dijual_qty_id and barang_dijual_qty.barang_gudang_id=".$json[$i]['idd'].""));
	if ($stok_po1['stok_po']-$stok_po2!=0) {
	echo $stok_po1['stok_po']-$stok_po2;
	}
	 ?></td>
     <td><?php 
	echo $json[$i]['stok_total']-($stok_po1['stok_po']-$stok_po2);
	 ?></td>
    <td align="center"><?php 
	$cek_stok1=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_detail where status_kirim=1 and barang_gudang_id=".$json[$i]['idd'].""));
	if ($cek_stok1!=0) {
	echo $cek_stok1;
	} else {echo "-";} ?></td>
    <td align="center">
    <?php 
	$cek_stok2=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_detail where status_kerusakan=1 and barang_gudang_id=".$json[$i]['idd'].""));
	if ($cek_stok2!=0) {
	echo $cek_stok2;
	} else {echo "-";}?>
    </td>
    <td align="center"><?php echo $json[$i]['deskripsi_alat']; ?></td>
    <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator']) or isset($_SESSION['user_admin_keuangan']) && isset($_SESSION['pass_admin_keuangan'])) { ?>
    <td align="center"><?php echo "Rp ".number_format($json[$i]['harga_beli'],0,',','.').",-"; ?></td>
    <td align="center"><?php echo "Rp ".number_format($json[$i]['harga_satuan'],0,',','.').",-"; ?></td>
    <?php } ?>
    <td align="center">
    <?php if ($json[$i]['status_cek']==1){ ?>
    <span class="fa fa-check"></span>
	<?php } else { ?>
    <span class="fa fa-close"></span>
    <?php } ?>
		</td>
    <td align="center">
    
    <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator'])) { ?>
    <a href="index.php?page=barang_inventory&id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a> &nbsp; <?php } ?><a href="index.php?page=ubah_barang_inventory&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>
     
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


