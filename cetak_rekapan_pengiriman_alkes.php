<?php
require("config/koneksi.php");
// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excell
$dateNow = date("d F Y");
$tgl1=$_POST['tgl1'];
$tgl2=$_POST['tgl2'];
$t1=date("d F Y",strtotime($tgl1));
$t2=date("d F Y",strtotime($tgl2));
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekapan Pengiriman Alkes ($t1 to $t2) - PrintDate($dateNow).xls");
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 align="center">
        Rekapan Pengiriman Alkes
      </h1>
        
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
              <div class="input-group col-lg-12">
              <br />
              <?php 
			  echo "<strong>Form</strong> <i>".date("d F Y",strtotime($tgl1))."</i> <strong>To</strong> <i>".date("d F Y",strtotime($tgl2))."</i>"; ?>
                <table border="1" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th align="center">&nbsp;<strong>No</strong>
        </th>
        
        <th align="center"><strong>Tanggal Dijual</strong></th>
        <th align="center">No PO/Faktur</th>
      <th align="center"><strong>Nama Barang</strong></th>
      <th align="center">Tipe Barang</th>
      <th align="center">Merk Barang</th>
      
      <th align="center"><strong>Dinas/RS/Puskemas/Klinik<br />(Tempat Tujuan)</strong></th>
      <th align="center">Provinsi</th>
      <th align="center">Kabupaten/Kota</th>
      <th align="center">Kecamatan</th>
      <th align="center">Kelurahan</th>
      <th align="center">Marketing</th>
      <th align="center">SubDis</th>
      <th align="center">Belum Terkirim</th>
      <th align="center">Sudah Terkirim</th>
      <th align="center"><strong>Qty</strong></th>
      <th align="center">Harga Satuan</th>
      <th align="center">Total</th>
      </tr>
  </thead>
  <?php
  if ($_POST['status']=='Semua') {
	  $query = mysqli_query($koneksi, "select *,barang_dijual.id as idd,sum(qty_jual*harga_jual_saat_itu) as total from barang_dijual,barang_dijual_qty,barang_gudang,pembeli, alamat_provinsi, alamat_kabupaten, alamat_kecamatan where barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual.id=barang_dijual_qty.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and barang_dijual.tgl_jual between '$tgl1' and '$tgl2' group by barang_dijual.id order by barang_dijual.tgl_jual DESC,barang_dijual.id DESC");  
  }
  elseif ($_POST['status']=='Sudah Terkirim') {
	  $query = mysqli_query($koneksi, "select *,barang_dijual.id as idd,sum(qty_jual*harga_jual_saat_itu) as total from barang_dijual,barang_dijual_qty,barang_gudang,pembeli, alamat_provinsi, alamat_kabupaten, alamat_kecamatan,barang_dikirim where barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual.id=barang_dijual_qty.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dijual.tgl_jual between '$tgl1' and '$tgl2' group by barang_dijual.id order by barang_dijual.tgl_jual DESC,barang_dijual.id DESC");
	  }
	
  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center" valign="top"><?php echo $no; ?></td>
    <td align="center" valign="top">
    <?php echo date("d F Y",strtotime($data['tgl_jual']));	
	?>
    </td>
    <td align="center" valign="top"><?php echo $data['no_po_jual']; ?></td>
    <td align="center" valign="top">
    <table width="100%" border="1">
  	<?php
    $brg = mysqli_query($koneksi, "select nama_brg from barang_gudang,barang_dijual_qty where barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual_id=".$data['idd']." order by nama_brg ASC");
	while ($d_brg = mysqli_fetch_array($brg)) {
	?>
  	<tr>
    <td><?php echo $d_brg['nama_brg'] ?></td>
  	</tr>
    <?php } ?>
	</table>
    </td>
    <td align="center" valign="top">
    <table width="100%" border="1">
  	<?php
	$brg2 = mysqli_query($koneksi, "select tipe_brg from barang_gudang,barang_dijual_qty where barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual_id=".$data['idd']." order by nama_brg ASC");
    while ($d_tipe= mysqli_fetch_array($brg2)) {
	?>
  	<tr>
    <td><?php echo $d_tipe['tipe_brg'] ?></td>
  	</tr>
    <?php } ?>
	</table>
    </td>
    <td align="center" valign="top">
    <table width="100%" border="1">
  	<?php
	$brg3 = mysqli_query($koneksi, "select merk_brg from barang_gudang,barang_dijual_qty where barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual_id=".$data['idd']." order by nama_brg ASC");
    while ($d_merk= mysqli_fetch_array($brg3)) {
	?>
  	<tr>
    <td><?php echo $d_merk['merk_brg'] ?></td>
  	</tr>
    <?php } ?>
	</table>
    </td>
    <td align="center" valign="top"><?php echo $data['nama_pembeli']; ?></td>
    <td align="center" valign="top"><?php echo $data['nama_provinsi']; ?></td>
    <td align="center" valign="top"><?php echo $data['nama_kabupaten']; ?></td>
    <td align="center" valign="top"><?php echo $data['nama_kecamatan']; ?></td>
    <td align="center" valign="top"><?php echo $data['kelurahan_id']; ?></td>
    <td align="center" valign="top"><?php echo $data['marketing']; ?></td>
    <td align="center" valign="top"><?php echo $data['subdis']; ?></td>
    <td align="center" valign="top">
	<table width="100%" border="1">
  	<?php
    $blm_terkirim = mysqli_query($koneksi, "select *,barang_dijual_qty.id as idd from barang_gudang,barang_dijual_qty where barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual_id=".$data['idd']." order by nama_brg ASC");
	while ($d_brg = mysqli_fetch_array($blm_terkirim)) {
	?>
  	<tr>
    <td>
    <?php
    $jml_terkirim = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim,barang_dikirim_detail where barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dijual_qty_id=".$d_brg['idd'].""));
	echo $d_brg['qty_jual']-$jml_terkirim;
	?>
    </td>
  	</tr>
    <?php } ?>
	</table>
	</td>
    <td align="center" valign="top">
    <table width="100%" border="1">
  	<?php
    $sdh_terkirim = mysqli_query($koneksi, "select *,barang_dijual_qty.id as idd from barang_gudang,barang_dijual_qty where barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual_id=".$data['idd']." order by nama_brg ASC");
	while ($d_brg = mysqli_fetch_array($sdh_terkirim)) {
	?>
  	<tr>
    <td>
    <?php
    $jml_terkirim = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim,barang_dikirim_detail where barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dijual_qty_id=".$d_brg['idd'].""));
	echo $jml_terkirim;
	?>
    </td>
  	</tr>
    <?php } ?>
	</table>
    </td>
    <td align="center" valign="top">
	<table width="100%" border="1">
  	<?php
    $qty = mysqli_query($koneksi, "select qty_jual from barang_gudang,barang_dijual_qty where barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual_id=".$data['idd']." order by nama_brg ASC");
	while ($d_brg = mysqli_fetch_array($qty)) {
	?>
  	<tr>
    <td><?php echo $d_brg['qty_jual'] ?></td>
  	</tr>
    <?php } ?>
	</table></td>
    <td align="right" valign="top">
	<table width="100%" border="1">
  	<?php
    $harga_jual = mysqli_query($koneksi, "select harga_jual_saat_itu from barang_gudang,barang_dijual_qty where barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual_id=".$data['idd']." order by nama_brg ASC");
	while ($d_brg = mysqli_fetch_array($harga_jual)) {
	?>
  	<tr>
    <td><?php echo $d_brg['harga_jual_saat_itu'] ?></td>
  	</tr>
    <?php } ?>
	</table></td>
    <td align="right" valign="top"><?php echo $data['total']; ?></td>
    </tr>
  <?php } ?>
  <tr>
    <td colspan="17" align="right"><h3><strong>Sub Total : </strong></h3></td>
    <td align="right"><?php
	//$query2 = mysqli_query($koneksi, "select sum(harga_jual_saat_itu*qty_jual) as total from barang_dijual,barang_dijual_qty where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_dijual.tgl_jual between '$tgl1' and '$tgl2'");
	//$data2=mysqli_fetch_array($query2); 
	//echo number_format($data2['total'],0,',','.');
	?></td>
  </tr>
</table>
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