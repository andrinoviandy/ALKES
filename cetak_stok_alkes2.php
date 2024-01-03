<?php 
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Stok Alkes.xls");
?>
<?php require("config/koneksi.php"); ?>
<h3 align="center"><strong>PT. CIPTA VARIA KHARISMA UTAMA</strong></h3>

<p><b>Stok Alkes</b></p>
<table width="" border="1" class="table table-bordered table-hover" id="example1">
  <thead>
    <tr>
      <th rowspan="2" align="center"><strong>No</strong></th>
      <th rowspan="2" align="center"><strong>Merk/Brand</strong></th>
      <th rowspan="2" align="center">Nama Barang</th>
      <th rowspan="2" align="center"><strong>Type</strong></th>
      <th colspan="3" align="center">Tahun <?php $tahun=getdate(); echo $tahun['year']-2; ?></th>
      <th rowspan="2" align="center" bgcolor="#99FF00">Jumlah Stok</th>
      <th colspan="3" align="center">Tahun <?php $tahun=getdate(); echo $tahun['year']-1; ?></th>
      <th rowspan="2" align="center" bgcolor="#99FF00">Jumlah Stok</th>
      <th colspan="3" align="center">Tahun <?php $tahun=getdate(); echo $tahun['year']; ?></th>
      <th rowspan="2" align="center" bgcolor="#99FF00">Jumlah Stok</th>
      <th rowspan="2" align="center">Deskripsi</th>
    </tr>
    <tr>
      <th align="center" bgcolor="#00CC99">Awal</th>
      <th align="center" bgcolor="#FF6600">In</th>
      <th align="center" bgcolor="#FFCC33">Out</th>
      <th align="center" bgcolor="#00CC99">Awal</th>
      <th align="center" bgcolor="#FF6600">In</th>
      <th align="center" bgcolor="#FFCC33">Out</th>
      <th align="center" bgcolor="#00CC99"><strong>Awal</strong></th>
      <th align="center" bgcolor="#FF6600">In</th>
      <th align="center" bgcolor="#FFCC33">Out</th>
    </tr>
  </thead>
  <?php
 if ($_POST['merk']=='all') {
	$query = mysqli_query($koneksi, "select * from barang_gudang group by merk_brg");
 } else {
	 $query = mysqli_query($koneksi, "select * from barang_gudang where merk_brg='".$_POST['merk']."' group by merk_brg");
	 }
	$jml = mysqli_num_rows($query);
	
	if ($jml!=0) {
  $no=0;
  while ($data = mysqli_fetch_array($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center" valign="top"><?php echo $no; ?></td>
    <td valign="top"><?php
	echo $data['merk_brg']; ?></td>
    <td colspan="15" valign="top">
    <table width="100%" border="1">
    <?php $sel = mysqli_query($koneksi, "select * from barang_gudang where merk_brg='".$data['merk_brg']."' order by nama_brg ASC"); 
	while ($data_sel = mysqli_fetch_array($sel)) {
	?>
      <tr>
        <td><?php echo $data_sel['nama_brg']; ?></td>
        <td><?php echo $data_sel['tipe_brg']; ?></td>
        <td align="center" bgcolor="#00CC99"><?php 
		$th = getdate();
		$t1 = $th['year']-3;
		$t2 = $th['year']-2;
		$t3 = $th['year']-1;
		$t4 = $th['year'];
		$q = mysqli_fetch_array(mysqli_query($koneksi, "select *,sum(stok_total) as total1 from barang_gudang,barang_gudang_po where barang_gudang.id=barang_gudang_po.barang_gudang_id and barang_gudang.id=".$data_sel['id']." and year(tgl_po_gudang)='$t1'"));
		$q1 = mysqli_fetch_array(mysqli_query($koneksi, "select *,sum(stok) as total2 from barang_gudang,barang_gudang_po where barang_gudang.id=barang_gudang_po.barang_gudang_id and barang_gudang.id=".$data_sel['id']." and year(tgl_po_gudang)='$t2'"));
		$q1_1 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_detail,barang_gudang_po where barang_gudang_po.id=barang_gudang_detail.barang_gudang_po_id and barang_gudang_detail.barang_gudang_id=".$data_sel['id']." and year(tgl_po_gudang)='$t2' and status_terjual=1"));
		$q3 = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang_po where barang_gudang_id=".$data_sel['id']." and year(tgl_po_gudang)='$t3'"));
		echo $q['total1']; ?></td>
        <td align="center" bgcolor="#FF6600"><?php echo $q1['total2']; ?></td>
        <td align="center" bgcolor="#FFCC33"><?php echo $q1_1; ?></td>
        <td align="center" bgcolor="#99FF00"><?php echo $q['total1']+$q1['total2']-$q1_1; ?></td>
        <td align="center" bgcolor="#00CC99"><?php //echo $q2; ?></td>
        <td align="center" bgcolor="#FF6600">0</td>
        <td align="center" bgcolor="#FFCC33">0</td>
        <td align="center" bgcolor="#99FF00">0</td>
        <td align="center" bgcolor="#00CC99"><?php echo $q3['stok']; ?></td>
        <td align="center" bgcolor="#FF6600"><?php 
		$q3_in = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_detail,barang_gudang_po where barang_gudang_po.id=barang_gudang_detail.barang_gudang_po_id and barang_gudang_detail.barang_gudang_id=".$data_sel['id']." and year(tgl_po_gudang)='$t4'"));
		echo $q3_in; ?></td>
        <td align="center" bgcolor="#FFCC33"><?php //echo $jml_brs; ?></td>
        <td align="center" bgcolor="#99FF00"><?php echo $data_sel['stok_total']; ?></td>
        <td align="left"><?php echo $data_sel['deskripsi_alat']; ?></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
  <?php }} else { ?>
	  <tr>
    <td colspan="15" align="center" valign="top">Data Tidak Ada / Kosong</td>
  </tr>
	 <?php } ?>
</table>