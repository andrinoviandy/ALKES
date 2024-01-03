<?php require("config/koneksi.php"); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 align="center">
        Laporan Penjualan Aksesoris<br /><?php echo "Status Barang : ".$_POST['status']; ?></h1>
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
      <th align="center"><strong>Nama Aksesoris</strong></th>
      <th align="center">Tipe Aksesoris</th>
      <th align="center">Merk Aksesoris</th>
      
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
      <th align="center">Diskon Per Barang</th>
      <th align="center">Diskon Per PO</th>
      <th align="center">PPN</th>
      <th align="center">Total</th>
      </tr>
  </thead>
  <?php
  if ($_POST['status']=='Semua') {
	 $query = mysqli_query($koneksi, "select *,aksesoris_jual.id as idd,sum(harga_jual_saat_itu*qty_jual_akse) as total from aksesoris_jual,aksesoris_jual_qty, aksesoris,pembeli, alamat_provinsi, alamat_kabupaten, alamat_kecamatan where aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual.id=aksesoris_jual_qty.aksesoris_jual_id and pembeli.id=aksesoris_jual.pembeli_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and aksesoris_jual.tgl_jual_akse between '$tgl1' and '$tgl2' order by aksesoris_jual.tgl_jual_akse DESC,aksesoris_jual.id DESC");  
	 }
  elseif ($_POST['status']=='Sudah Terkirim') {
	  $query = mysqli_query($koneksi, "select *,aksesoris_jual.id as idd,sum(harga_jual_saat_itu*qty_jual_akse-(diskon_jual_akse/100*harga_jual_saat_itu*qty_jual_akse)) as total from aksesoris_jual,aksesoris_jual_qty, aksesoris,pembeli, alamat_provinsi, alamat_kabupaten, alamat_kecamatan where aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual.id=aksesoris_jual_qty.aksesoris_jual_id and pembeli.id=aksesoris_jual.pembeli_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and aksesoris_jual.tgl_jual_akse between '$tgl1' and '$tgl2' order by aksesoris_jual.tgl_jual_akse DESC,aksesoris_jual.id DESC");
	  }
  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center" valign="top"><?php echo $no; ?></td>
    <td align="center" valign="top">
    <?php echo date("d F Y",strtotime($data['tgl_jual_akse']));	
	?>
    </td>
    <td align="center" valign="top"><?php echo $data['no_po_jual_akse']; ?></td>
    <td align="center" valign="top">
	<table width="100%" border="1">
  	<?php
    $brg = mysqli_query($koneksi, "select nama_akse from aksesoris,aksesoris_jual_qty where aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual_id=".$data['idd']." order by nama_akse ASC");
	while ($d_brg = mysqli_fetch_array($brg)) {
	?>
  	<tr>
    <td><?php echo $d_brg['nama_akse'] ?></td>
  	</tr>
    <?php } ?>
	</table>
	</td>
    <td align="center" valign="top">
    <table width="100%" border="1">
  	<?php
    $tipe = mysqli_query($koneksi, "select tipe_akse from aksesoris,aksesoris_jual_qty where aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual_id=".$data['idd']." order by nama_akse ASC");
	while ($d_brg = mysqli_fetch_array($tipe)) {
	?>
  	<tr>
    <td><?php echo $d_brg['tipe_akse'] ?></td>
  	</tr>
    <?php } ?>
	</table>
    </td>
    <td align="center" valign="top">
    <table width="100%" border="1">
  	<?php
    $merk = mysqli_query($koneksi, "select merk_akse from aksesoris,aksesoris_jual_qty where aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual_id=".$data['idd']." order by nama_akse ASC");
	while ($d_brg = mysqli_fetch_array($merk)) {
	?>
  	<tr>
    <td><?php echo $d_brg['merk_akse'] ?></td>
  	</tr>
    <?php } ?>
	</table>
    </td>
    
    <td align="center" valign="top"><?php echo $data['nama_pembeli']; ?></td>
    <td align="center" valign="top"><?php echo $data['nama_provinsi']; ?></td>
    <td align="center" valign="top"><?php echo $data['nama_kabupaten']; ?></td>
    <td align="center" valign="top"><?php echo $data['nama_kecamatan']; ?></td>
    <td align="center" valign="top"><?php echo $data['kelurahan_id']; ?></td>
    <td align="center" valign="top"><?php echo $data['marketing_akse']; ?></td>
    <td align="center" valign="top"><?php echo $data['subdis_akse']; ?></td>
    <td align="center" valign="top">
    <table width="100%" border="1">
  	<?php
    $blm_terkirim = mysqli_query($koneksi, "select *,aksesoris_jual_qty.id as idd from aksesoris,aksesoris_jual_qty where aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual_id=".$data['idd']." order by nama_akse ASC");
	while ($d_brg = mysqli_fetch_array($blm_terkirim)) {
	?>
  	<tr>
    <td>
    <?php
    $jml_terkirim = mysqli_num_rows(mysqli_query($koneksi, "select * from aksesoris_kirim,aksesoris_kirim_detail where aksesoris_kirim.id=aksesoris_kirim_detail.aksesoris_kirim_id and aksesoris_jual_qty_id=".$d_brg['idd'].""));
	echo $d_brg['qty_jual_akse']-$jml_terkirim;
	?>
    </td>
  	</tr>
    <?php } ?>
	</table>
	</td>
    <td align="center" valign="top">
    <table width="100%" border="1">
  	<?php
    $sdh_terkirim = mysqli_query($koneksi, "select *,aksesoris_jual_qty.id as idd from aksesoris,aksesoris_jual_qty where aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual_id=".$data['idd']." order by nama_akse ASC");
	while ($d_brg = mysqli_fetch_array($sdh_terkirim)) {
	?>
  	<tr>
    <td>
    <?php
     $jml_terkirim = mysqli_num_rows(mysqli_query($koneksi, "select * from aksesoris_kirim,aksesoris_kirim_detail where aksesoris_kirim.id=aksesoris_kirim_detail.aksesoris_kirim_id and aksesoris_jual_qty_id=".$d_brg['idd'].""));
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
    $qty = mysqli_query($koneksi, "select qty_jual_akse from aksesoris,aksesoris_jual_qty where aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual_id=".$data['idd']." order by nama_akse ASC");
	while ($d_brg = mysqli_fetch_array($qty)) {
	?>
  	<tr>
    <td><?php echo $d_brg['qty_jual_akse'] ?></td>
  	</tr>
    <?php } ?>
	</table>
    </td>
    <td align="right" valign="top">
    <table width="100%" border="1">
  	<?php
    $harga_jual = mysqli_query($koneksi, "select harga_jual_saat_itu from aksesoris,aksesoris_jual_qty where aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual_id=".$data['idd']." order by nama_akse ASC");
	while ($d_brg = mysqli_fetch_array($harga_jual)) {
	?>
  	<tr>
    <td><?php echo $d_brg['harga_jual_saat_itu'] ?></td>
  	</tr>
    <?php } ?>
	</table>
    </td>
    <td align="right" valign="top">
	<table width="100%" border="1">
  	<?php
    $diskon = mysqli_query($koneksi, "select diskon_jual_akse from aksesoris,aksesoris_jual_qty where aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual_id=".$data['idd']." order by nama_akse ASC");
	while ($d_brg = mysqli_fetch_array($diskon)) {
	?>
  	<tr>
    <td><?php echo $d_brg['diskon_jual_akse']."%" ?></td>
  	</tr>
    <?php } ?>
	</table>
	</td>
    <td valign="top"><?php echo $data['diskon_akse']."%"; ?></td>
    <td valign="top"><?php echo $data['ppn_akse']."%"; ?></td>
    <td align="right" valign="top"><?php 
	echo $data['total_harga'];
	//echo $data['harga_jual_saat_itu']*$data['qty_jual_akse']+($data['harga_jual_saat_itu']*$data['qty_jual_akse']*$data['ppn_akse']/100)-($data['harga_jual_saat_itu']*$data['qty_jual_akse']*$data['diskon_akse']/100); ?></td>
    </tr>
  <?php } ?>
  <tr>
    <td colspan="20" align="right"><h3><strong>Sub Total : </strong></h3></td>
    <td align="right"><?php
	//$query2 = mysqli_query($koneksi, "select sum(harga_jual_saat_itu*qty_jual_akse) as total from aksesoris_jual,aksesoris_jual_qty, aksesoris, pembeli, alamat_provinsi, alamat_kabupaten, alamat_kecamatan where aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual.id=aksesoris_jual_qty.aksesoris_jual_id and pembeli.id=aksesoris_jual.pembeli_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and aksesoris_jual.tgl_jual_akse between '$tgl1' and '$tgl2'");
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