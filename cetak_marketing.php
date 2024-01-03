<?php 
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekapan Penjualan _ Marketing ".$_POST['marketing']." ($_POST[tahun]).xls");
?>
<?php require("config/koneksi.php"); ?>
<?php session_start(); ?>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
        <style>
         .mytable{
                border:1px solid black; 
                border-collapse: collapse;
                width: 100%;
            }
            .mytable tr th, .mytable tr td{
                border:1px solid black; 
                padding: 2px 5px;
            }
        </style>
    </head>
    <body>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 align="center">
       Penjualan Alkes</h1>
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
			  echo "<h3>Marketing : ".$_POST['marketing']." (".$_POST['tahun'].")"."</h3>"; 
			  ?>
                <table border="1" class="mytable">
  <thead>
    <tr>
      <td align="center" valign="top">&nbsp;<strong>No</strong>
        </th>
        
        <th align="center"><strong>Tanggal Dijual</strong></th>
        <th align="center">No PO</th>
        <th align="center">Nama Barang</th>
        <th align="center">Tipe Barang</th>
        <th align="center">Merk Barang</th>
     
      <th align="center"><strong>Dinas/RS/Puskemas/Klinik<br />(Tempat Tujuan)</strong></th>
      <th align="center">Provinsi</th>
      <th align="center">Kabupaten/Kota</th>
      <th align="center">Kecamatan</th>
      <th align="center">Kelurahan</th>
      <th align="center">Marketing</th>
      <th align="center">SubDis</th>
      <th align="center"><strong>Qty</strong></th>
      <th align="center">Harga Satuan</th>
      <th align="center">Harga Total</th>
      </tr>
  </thead>
  <?php
	if ($_POST['marketing']=='all') {
		$query = mysqli_query($koneksi, "select *,barang_dijual.id as idd,(barang_dijual_qty.qty_jual*barang_dijual_qty.harga_jual_saat_itu) as total from barang_dijual,barang_dijual_qty, barang_gudang,pembeli, alamat_provinsi, alamat_kabupaten, alamat_kecamatan where barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual.id=barang_dijual_qty.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and year(barang_dijual.tgl_jual)='".$_POST['tahun']."' order by barang_dijual.tgl_jual DESC, barang_dijual.id DESC");
		}
	else {
	 $query = mysqli_query($koneksi, "select *,barang_dijual.id as idd,(qty_jual*harga_jual_saat_itu) as total from barang_dijual,barang_dijual_qty, barang_gudang,pembeli, alamat_provinsi, alamat_kabupaten, alamat_kecamatan where barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual.id=barang_dijual_qty.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and barang_dijual.marketing='".$_POST['marketing']."' and year(barang_dijual.tgl_jual)='$_POST[tahun]' order by barang_dijual.tgl_jual DESC"); } 
  $no=0;
  while ($data = mysqli_fetch_array($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td>
    <?php echo date("d F Y",strtotime($data['tgl_jual']));	
	?>
    </td>
    <td><?php echo $data['no_po_jual']; ?></td>
    <td>
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
    <td><table width="100%" border="1">
  	<?php
	$brg2 = mysqli_query($koneksi, "select tipe_brg from barang_gudang,barang_dijual_qty where barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual_id=".$data['idd']." order by nama_brg ASC");
    while ($d_tipe= mysqli_fetch_array($brg2)) {
	?>
  	<tr>
    <td><?php echo $d_tipe['tipe_brg'] ?></td>
  	</tr>
    <?php } ?>
	</table></td>
    <td><table width="100%" border="1">
  	<?php
	$brg3 = mysqli_query($koneksi, "select merk_brg from barang_gudang,barang_dijual_qty where barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual_id=".$data['idd']." order by nama_brg ASC");
    while ($d_merk= mysqli_fetch_array($brg3)) {
	?>
  	<tr>
    <td><?php echo $d_merk['merk_brg'] ?></td>
  	</tr>
    <?php } ?>
	</table></td>
    
    <td><?php echo $data['nama_pembeli']; ?></td>
    <td><?php echo $data['nama_provinsi']; ?></td>
    <td><?php echo $data['nama_kabupaten']; ?></td>
    <td><?php echo $data['nama_kecamatan']; ?></td>
    <td><?php echo $data['kelurahan_id']; ?></td>
    <td align="center"><?php echo $data['marketing']; ?></td>
    <td align="center"><?php echo $data['subdis']; ?></td>
    <td align="center"><table width="100%" border="1">
  	<?php
    $qty = mysqli_query($koneksi, "select qty_jual from barang_gudang,barang_dijual_qty where barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual_id=".$data['idd']." order by nama_brg ASC");
	while ($d_brg = mysqli_fetch_array($qty)) {
	?>
  	<tr>
    <td><?php echo $d_brg['qty_jual'] ?></td>
  	</tr>
    <?php } ?>
	</table></td>
    <td align="right"><table width="100%" border="1">
  	<?php
    $harga_jual = mysqli_query($koneksi, "select harga_jual_saat_itu from barang_gudang,barang_dijual_qty where barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual_id=".$data['idd']." order by nama_brg ASC");
	while ($d_brg = mysqli_fetch_array($harga_jual)) {
	?>
  	<tr>
    <td><?php echo $d_brg['harga_jual_saat_itu'] ?></td>
  	</tr>
    <?php } ?>
	</table></td>
    <td align="right"><?php echo $data['total']; ?></td>
    </tr>
  <?php } ?>
  <!--
  <tr>
    <td colspan="13" align="right"><h3><strong>Total : </strong></h3></td>
    <td align="right"><?php
	if ($_POST['marketing']=='all') {
		$query2 = mysqli_query($koneksi, "select sum(total_harga) as totall from barang_dijual,barang_dijual_qty, barang_gudang,pembeli, alamat_provinsi, alamat_kabupaten, alamat_kecamatan where barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual.id=barang_dijual_qty.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and DATE_FORMAT(barang_dijual.tgl_jual,'%Y')='".$_POST['tahun']."'");
		$data2=mysqli_fetch_array($query2); 
		}
		else {
	$query2 = mysqli_query($koneksi, "select sum(total_harga) as totall from barang_dijual,barang_dijual_qty, barang_gudang,pembeli, alamat_provinsi, alamat_kabupaten, alamat_kecamatan where barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual.id=barang_dijual_qty.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and barang_dijual.marketing='".$_POST['marketing']."' and DATE_FORMAT(barang_dijual.tgl_jual,'%Y')='".$_POST['tahun']."'");
	$data2=mysqli_fetch_array($query2); 
	}
	echo $data2['totall'];
	?>
    </td>
  </tr>
  -->
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
  </body>
</html>