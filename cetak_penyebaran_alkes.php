<?php 
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan Penyebaran Alkes.xls");
?>
<?php require("config/koneksi.php"); ?>
<h3 align="center"><strong>PT. CIPTA VARIA KHARISMA UTAMA</strong></h3>

<p><b>Penyebaran Alkes</b></p>
<table width="" border="1" class="table table-bordered table-hover" id="example1">
  <thead>
    <tr>
      <td align="center"><strong>&nbsp;
        </th>No
        
        </strong>
      <th align="center"><strong>Nama Alkes</strong></th>
      <th align="center">Type</th>
      <th align="center">Merk</th>
        <th align="center">No Seri</th>
        <th align="center"><strong>Dinas/RS/Puskesmas/Klinik</strong></th>
      <th align="center"><strong>Provinsi</strong></th>
      <th align="center">Kabupaten/Kota</th>
      <th align="center">Kecamatan</th>
      <th align="center">Kelurahan</th>
      
    </tr>
  </thead>
  <?php
  if ($_POST['provinsi']!='' and $_POST['kabupaten']!='' and $_POST['kecamatan']!='') { 
	  $query = mysqli_query($koneksi, "select * from barang_dijual,barang_dikirim,barang_dikirim_detail, barang_gudang,barang_gudang_detail, pembeli, alamat_provinsi, alamat_kabupaten, alamat_kecamatan where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and alamat_provinsi.id=".$_POST['provinsi']." and alamat_kabupaten.id=".$_POST['kabupaten']." and alamat_kecamatan.id=".$_POST['kecamatan']."");
	  $jml = mysqli_num_rows($query);
	  }
else if ($_POST['provinsi']!="" and $_POST['kabupaten']!="") {
	$query = mysqli_query($koneksi, "select * from barang_dijual,barang_dikirim,barang_dikirim_detail, barang_gudang,barang_gudang_detail, pembeli, alamat_provinsi, alamat_kabupaten, alamat_kecamatan where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and alamat_provinsi.id=".$_POST['provinsi']." and alamat_kabupaten.id=".$_POST['kabupaten']."");
	$jml = mysqli_num_rows($query);
	}
else if ($_POST['provinsi']!="") {
	 $query = mysqli_query($koneksi, "select * from barang_dijual,barang_dikirim,barang_dikirim_detail, barang_gudang,barang_gudang_detail, pembeli, alamat_provinsi, alamat_kabupaten, alamat_kecamatan where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and alamat_provinsi.id=".$_POST['provinsi']."");
	 $jml = mysqli_num_rows($query);
}
else {
	$query = mysqli_query($koneksi, "select * from barang_dijual,barang_dikirim,barang_dikirim_detail, barang_gudang,barang_gudang_detail, pembeli, alamat_provinsi, alamat_kabupaten, alamat_kecamatan where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id");
	$jml = mysqli_num_rows($query);
	}
	
	if ($jml!=0) {
  $no=0;
  while ($data = mysqli_fetch_array($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center" valign="top"><?php echo $no; ?></td>
    <td valign="top">
    <?php
	echo $data['nama_brg']; ?>
    </td>
    <td valign="top"><?php
	echo $data['tipe_brg']; ?></td>
    <td valign="top"><?php
	echo $data['merk_brg']; ?></td>
    <td valign="top"><?php echo $data['no_seri_brg']; ?></td>
    <td valign="top">
      <?php echo $data['nama_pembeli'];	
	?>
    </td>
    <td valign="top"><?php echo $data['nama_provinsi']; ?></td>
    <td valign="top"><?php echo $data['nama_kabupaten']; ?></td>
    <td valign="top"><?php echo $data['nama_kecamatan']; ?></td>
    <td valign="top"><?php echo $data['kelurahan_id']; ?></td>
    
  </tr>
  <?php }} else { ?>
	  <tr>
    <td colspan="10" align="center" valign="top">Data Tidak Ada / Kosong</td>
  </tr>
	 <?php } ?>
</table>