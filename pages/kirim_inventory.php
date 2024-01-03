<?php 
if (isset($_GET['id_b_s'])) {
	$q=mysqli_query($koneksi, "update barang_dikirim_inventory set tgl_sampai='' where id=".$_GET['id_b_s']."");
	if ($q) {
		echo "<script>window.location='index.php?page=kirim_inventory'</script>";
		}
	}
if (isset($_GET['id_hapus'])) {
	//$q= mysqli_query($koneksi, "select * from barang_dikirim_inventory where id=".$_GET['id_hapus']."");
	//while () {
	$up=mysqli_query($koneksi, "update barang_dijual_inventory_qty,barang_dikirim_inventory_detail set barang_dijual_inventory_qty.status_kirim=0 where barang_dijual_inventory_qty.id=barang_dikirim_inventory_detail.barang_dijual_inventory_qty_id and barang_dikirim_inventory_id=".$_GET['id_hapus']."");
	$up2 = mysqli_query($koneksi, "update barang_inventory,barang_dijual_inventory_qty,barang_dikirim_inventory_detail set stok_total=stok_total+qty_jual where barang_inventory.id=barang_dijual_inventory_qty.barang_inventory_id and barang_dijual_inventory_qty.id=barang_dikirim_inventory_detail.barang_dijual_inventory_qty_id and barang_dikirim_inventory_id=".$_GET['id_hapus']."");
	if ($up and $up2) {
	$del1=mysqli_query($koneksi, "delete from barang_dikirim_inventory_detail where barang_dikirim_inventory_id=".$_GET['id_hapus']."");
	$del2=mysqli_query($koneksi, "delete from barang_dikirim_inventory where id=".$_GET['id_hapus']."");
	
		echo "<script>
		window.location='index.php?page=kirim_inventory'</script>";
		}
	else {
		echo "<script>
		alert('Data tidak dapat di hapus karena sudah dibuat SPI');
		window.location='index.php?page=kirim_inventory'</script>";
		}
	
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pengiriman Barang Inventory
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kirim Barang Inventory</li>
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
          <div class="box box-warning"><!-- /.chat -->
            <div class="box-footer">
              <div class="box-body table-responsive no-padding">
              <div class="">
              <!--<a href="index.php?page=tambah_barang_kirim">
              <button name="tambah_laporan" class="btn btn-warning" type="submit"><span class="fa fa-plus"></span> Kirim Alkes</button></a><br /><br />--><span class="pull pull-right"><table>
  <tr>
    <td><strong style="color:#F00">Keterangan</strong> : &nbsp;&nbsp;&nbsp;</td>
    <td valign="top">1. </td>
    <td valign="top"><strong style="color:#F00">Tanggal Sampai</strong> wajib diisi</td>
  </tr>
</table>
</span><br /><br />
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th align="center">&nbsp;</th>
        
        <th bgcolor="#99FFCC">Tanggal Kirim</th>
        <th width="20%">Nama Paket</th>
        
        <th>No_Surat_Jalan</th>
        <th>No_PO</th>
      <th><table width="150px">
        <tr>
          <td>Nama Alkes</td>
          
          <td>Qty</td>
        </tr>
      </table></th>
      <th><strong>Lokasi Tujuan</strong></th>
      <th>Kontak</th>
      <th>Ekspedisi</th>
      <th>Via Pengiriman</th>
      <th>Estimasi Brg Sampai</th>
      <th>Biaya Jasa</th>
      <th bgcolor="#99FFCC"><strong>Tanggal Sampai</strong></th>
      <th align="center"><strong>Aksi</strong></th>
        </tr>
  </thead>
  <?php
// membuka file JSON
$file = file_get_contents("http://localhost/ALKES/json/kirim_inventory.php");
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
?>
  <tr>
    <td align="center"><?php echo $i+1; ?></td>
    <td bgcolor="#99FFCC"><?php echo date("d M Y",strtotime($json[$i]['tgl_kirim'])); ?></td>
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
    <td>
    <table width="100%" border="0">
      <?php 
	  $q=mysqli_query($koneksi, "select nama_brg,qty_jual from barang_inventory,barang_dijual_inventory_qty,barang_dikirim_inventory_detail where barang_inventory.id=barang_dijual_inventory_qty.barang_inventory_id and barang_dijual_inventory_qty.id=barang_dikirim_inventory_detail.barang_dijual_inventory_qty_id and barang_dikirim_inventory_id=".$json[$i]['idd']."");
	  $n=0;
	  while ($d1=mysqli_fetch_array($q)) {
	  $n++;
	  if ($n%2==0) {
		  if ($d1['status_batal']==1){$col="#FF0000";}
		  else {$col="#CCCCCC";}
		  }
		  else {
			  if ($d1['status_batal']==1){$col="#FF0000";}
		  else {$col="#999999";}
			  }
	  ?>
      <tr bgcolor="<?php echo $col; ?>">
        <td align="left"><?php echo $d1['nama_brg']; ?>&nbsp;&nbsp;</td>
        
        <td align="right"><?php echo $d1['qty_jual']; ?>
        <?php 
		//if ($d1['status_rusak'])
		if($d1['status_spi']==1) {
			echo "(<span class='fa fa-sticky-note-o'></span>)";
			} ?>
        </td>
        </tr>
      <?php } ?>
    </table>
    </td>
    <td><?php 
	$data3=mysqli_fetch_array(mysqli_query($koneksi, "select nama_pembeli,kontak_rs from pembeli,barang_dijual_inventory,barang_dikirim_inventory where pembeli.id=barang_dijual_inventory.pembeli_id and barang_dijual_inventory.id=barang_dikirim_inventory.barang_dijual_inventory_id and barang_dikirim_inventory.id=".$json[$i]['idd'].""));
	echo $data3['nama_pembeli']; ?></td>
    <td><?php echo $data3['kontak_rs']; ?></td>
    <td><?php echo $json[$i]['ekspedisi']; ?></td>
    <td><?php echo $json[$i]['via_pengiriman']; ?></td>
    <td><?php 
	if ($json[$i]['estimasi_barang_sampai']!=0000-00-00) {
	echo $json[$i]['estimasi_barang_sampai']; } ?></td>
    <td><?php echo $json[$i]['biaya_pengiriman']; ?></td>
    
    <?php 
	if ($json[$i]['tgl_sampai']!=0000-00-00) {
		$bg="#99FFCC";
		}
		else {
			$bg="red";
			}
	?>
    <td bgcolor=<?php echo $bg; ?>>
		<?php
		if ($json[$i]['tgl_sampai']!=0000-00-00) {
	echo date("d M Y", strtotime($json[$i]['tgl_sampai'])); } else {
		echo "-";
		} ?>
    </td>
    <td align="center">
    <?php if (!isset($_SESSION['user_cs'])) { ?>
    <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator']) or isset($_SESSION['user_admin_gudang'])) { ?>
    <a href="index.php?page=kirim_inventory&id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;
    <?php } ?>
    <a href="index.php?page=ubah_kirim_inventory&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a><br />
    
      <?php if (isset($_GET['id_krm'])) { ?>
      <a href="index.php?page=kirim_inventory&id=<?php echo $json[$i]['idd']; ?>&id_krm=<?php echo $_GET['id_krm']; ?>#openSampai"><span data-toggle="tooltip" title="Status : Sudah Sampai" class="fa fa-calendar-check-o"></span></a>&nbsp;&nbsp;
      <?php } else { ?>
      <a href="index.php?page=kirim_inventory&id=<?php echo $json[$i]['idd']; ?>#openSampai">
      <span data-toggle="tooltip" title="Status : Sudah Sampai" class="fa fa-calendar-check-o"></span>
      </a>&nbsp;&nbsp;
      <?php } ?>
      <a href="index.php?page=kirim_inventory&id_b_s=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Yakin Akan Membatalkan Tanggal Sampai Barang !')">
      <span data-toggle="tooltip" title="Status : Belum Sampai" class="fa fa-calendar-times-o"></span>
      </a><br />
      <a href="cetak_surat_jalan_inventory.php?id=<?php echo $json[$i]['idd']; ?>" target="_blank"><span data-toggle="tooltip" title="Cetak Surat Jalan" class="fa fa-print"></span></a><?php if (isset($_SESSION['user_admin_keuangan']) or isset($_SESSION['user_manajer_keuangan']) or isset($_SESSION['user_administrator'])){ ?>&nbsp;&nbsp;<a target="blank" href="cetak_faktur_penjualan.php?id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Cetak Faktur Penjualan" class="glyphicon glyphicon-print"></span></a><?php } ?>
      <?php } else { ?>
      <a href="index.php?page=riwayat_panggilan&id=<?php echo $json[$i]['idd']; ?>">
      <span class="fa fa-phone-square"></span>
	  </a>
	  <?php } ?>
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
  <?php 
  if (isset($_POST['sampai_barang'])) {
	  $tgl_k = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dikirim_inventory where id=".$_GET['id'].""));
	  if ($_POST['tgl_sampai']>=$tgl_k['tgl_kirim']) {
	  $que = mysqli_query($koneksi, "update barang_dikirim_inventory set tgl_sampai='".$_POST['tgl_sampai']."' where id=".$_GET['id']."");
	  if ($que) {
		  //mysqli_query($koneksi, "insert into uji_f_i values('','".$_GET['id']."','0','0','')");
		  echo "<script type='text/javascript'>
		  window.location='index.php?page=kirim_inventory'
		  </script>";
		  }
	  	} else {
			echo "<script type='text/javascript'>alert('Tanggal Sampai Tidak Boleh Kurang Dari Tanggal Pengiriman !');
		  </script>";
			}
	  }
  ?>
  <div id="openSampai" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Status Alkes</h3>
        <?php $d=mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dikirim_inventory where id=".$_GET['id']."")); ?> 
     <form method="post">
     <label>Tanggal Sampai</label>
     <input id="input" type="date" placeholder="" name="tgl_sampai" required value="<?php echo $d['tgl_sampai']; ?>">
     <!--<label>Keterangan</label>
     <textarea rows="4" id="input" type="text" placeholder="Keterangan" name="keterangan"><?php echo $d['ket_brg']; ?></textarea>-->
        <button id="buttonn" name="sampai_barang" type="submit">Simpan</button>
    </form>
    </div>
</div>
<?php 
$q = mysqli_fetch_array(mysqli_query($koneksi, "select * from pembeli,alamat_provinsi,alamat_kabupaten,alamat_kecamatan where alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and pembeli.id=".$_GET['id'].""))
?>
<div id="openDetailPembeli" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Detail RS/Dinas/Klinik/Dll</h3> 
     <form method="post">
     <label>Nama RS/Dinas/Puskesmas/Klinik/Dll</label>
     <input id="input" type="text" placeholder="" name="no_peng" readonly="readonly" disabled value="<?php echo $q['nama_pembeli']; ?>">
     <label>Alamat</label>
     <textarea rows="4" id="input" placeholder="" name="no_peng" readonly="readonly" disabled><?php echo "Kelurahan ".$q['kelurahan_id']."\nKecamatan ".$q['nama_kecamatan']." \nKabupaten ".$q['nama_kabupaten']."\nProvinsi ".$q['nama_provinsi']; ?></textarea>
     <label>Kontak</label>
     <input id="input" type="text" placeholder="" name="no_po" readonly="readonly" disabled value="<?php echo $q['kontak_rs']; ?>">
     <br /><br />
    </form>
    </div>
</div>