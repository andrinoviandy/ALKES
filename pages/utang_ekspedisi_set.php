<?php 
if (isset($_POST['button_urut'])) {
	echo "<script>window.location='cetak_stok_alkes.php?merk=$_POST[merk]'</script>";
	}
?>
<?php 
if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from utang_piutang_inventory where id=".$_GET['id_hapus']."");
	if (!$del) {
		echo "<script>
		alert('Maaf , Data Tidak Dapat Di Hapus Karena Masih Ada Detail Pembayaran');
		history.back();
		</script>";
		}
	}
	
if (isset($_GET['id_batal'])) {
	$sel=mysqli_fetch_array(mysqli_query($koneksi, "select * from utang_bayar where utang_id=$_GET[id_batal]"));
	
	$del = mysqli_query($koneksi, "delete from utang where id=".$_GET['id_hapus']."");
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Biaya Ekspedisi (Alkes Ber Set)</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Biaya Ekspedisi</li>
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
              <div class="input-group pull pull-left col-xs-1" style="padding-right:10px"><!--
              <a href="index.php?page=tambah_utang">
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah</button></a>--></div>
              
              <!--<form method="post" action="cetak_stok_alkes.php">--><!--<a href="cetak_stok_alkes.php">
              <button name="tambah_laporan" class="btn btn-warning" type="submit"><span class="fa fa-print"></span> Cetak Stok Alkes</button></a>
              <span class="pull pull-right"><font color="#FF0000">Keterangan :</font> Klik Nama Alkes Untuk Melihat Proses Penjualan</span>
              --><br />
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
              
              <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th align="center">No</th>
      <th>Status</th>
      <th>Tgl Kirim</th>
        
        <th>Nama Paket</th>
        
        <th>No_Surat_Jalan</th>
        <th>No_PO</th>
      <th><strong>Lokasi Tujuan</strong></th>
      <th>Kontak</th>
      <th>Ekspedisi</th>
      <th>Via Pengiriman</th>
      <th>Biaya Jasa</th>
      <th>Estimasi Sampai</th>
      <th>Tgl Sampai</th>
      <th align="center"><strong>Aksi</strong></th>
        </tr>
  </thead>
  <?php
// membuka file JSON
$file = file_get_contents("http://localhost/ALKES/json/kirim_barang_set.php");
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
?>
  <tr>
    <td align="center"><?php echo $i+1; ?></td>
     <?php
    $jumlah_bayar = mysqli_fetch_array(mysqli_query($koneksi, "select sum(nominal) as total from bayar_ekspedisi_set where barang_dikirim_set_id=".$json[$i]['idd'].""));
	if ($jumlah_bayar['total']>=$json[$i]['biaya_pengiriman']) {
		$bg="#00FF00";
		$status="Sudah Lunas Dibayar";
		}
	else {
		$bg="#FF0000";
		$status="Belum Lunas Dibayar";
		}
	?>
    <td bgcolor="<?php echo $bg; ?>">
    <?php
    echo $status;
	?>
    </td>
    <td><?php echo date("d M Y",strtotime($json[$i]['tgl_kirim'])); ?></td>
    <td><?php echo $json[$i]['nama_paket']; ?></td>
    
    <td><?php echo $json[$i]['no_pengiriman']; ?></td>
    <td>
      <!--
    <table width="100%" border="0">
      <?php 
	  $q2=mysqli_query($koneksi, "select no_po_gudang from barang_gudang,barang_gudang_po,barang_gudang_detail,barang_dikirim_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_po.id=barang_gudang_detail.barang_gudang_po_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_id=".$json[$i]['idd']."");
	  $n=0;
	  while ($d1=mysqli_fetch_array($q2)) {
	  $n++;
	  if ($n%2==0) {
		  $col="#CCCCCC";
		  }
		  else {
			  $col="#999999";
			  }
	  ?>
      <tr bgcolor="<?php echo $col; ?>">
        <td align="left"><?php echo $d1['no_po_gudang']; ?></td>
        </tr>
      <?php } ?>
    </table>--><?php echo $json[$i]['no_po_jual']; ?></td>
    <td><?php 
	$data3=mysqli_fetch_array(mysqli_query($koneksi, "select nama_pembeli,kontak_rs from pembeli,barang_dijual_set,barang_dikirim_set where pembeli.id=barang_dijual_set.pembeli_id and barang_dijual_set.id=barang_dikirim_set.barang_dijual_set_id and barang_dikirim_set.id=".$json[$i]['idd'].""));
	echo $data3['nama_pembeli']; ?></td>
    <td><?php echo $data3['kontak_rs']; ?></td>
    <td><?php echo $json[$i]['ekspedisi']; ?></td>
    <td><?php echo $json[$i]['via_pengiriman']; ?></td>
    <td><?php echo "Rp".number_format($json[$i]['biaya_pengiriman'],2,',','.'); ?></td>
    <td><?php 
	if ($json[$i]['estimasi_barang_sampai']!=0000-00-00) {
	echo $json[$i]['estimasi_barang_sampai']; } ?></td>
    <td><?php
		if ($json[$i]['tgl_sampai']!=0000-00-00) {
	echo date("d M Y", strtotime($json[$i]['tgl_sampai'])); } else {
		echo "-";
		} ?></td>
    
    <?php 
	if ($json[$i]['tgl_sampai']!=0000-00-00) {
		$bg="#99FFCC";
		}
		else {
			$bg="red";
			}
	?>
    <td>
      <a href="index.php?page=bayar_ekspedisi_set&id=<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Riwayat Pembayaran" class="label bg-green"> Riwayat Pembayaran </small></a>
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


