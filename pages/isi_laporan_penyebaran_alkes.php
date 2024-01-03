<table width="" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td align="center"><strong>&nbsp;
        </th>No
        
        </strong>
      <th align="center"><strong>Nama Alkes</strong></th>
        <th align="center">No Seri</th>
        <th align="center"><strong>Dinas/RS/Puskesmas/Klinik</strong></th>
      <th align="center"><strong>Provinsi</strong></th>
      <th align="center">Kabupaten/Kota</th>
      <th align="center">Kecamatan</th>
      <th align="center">Kelurahan</th>
      <th align="center"><strong>Qty</strong></th>
    </tr>
  </thead>
  <?php require("config/koneksi.php"); ?>
  <?php
$id_prov=$_POST['provinsi'];
//$id_kabupaten=$_POST['kabupaten'];
//$id_kecamatan=$_POST['kecamatan'];

	 $query = mysqli_query($koneksi, "select * from barang_dijual, barang_gudang, pembeli, alamat_provinsi, alamat_kabupaten, alamat_kecamatan where barang_gudang.id=barang_dijual.barang_gudang_id and pembeli.id=barang_dijual.pembeli_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and provinsi_id=".$id_prov." order by barang_dijual.tgl_jual ASC");
  
  $no=0;
  while ($data = mysqli_fetch_array($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td>
    <?php
	echo $data['nama_brg']; ?>
    </td>
    <td><?php echo $data['no_seri_brg']; ?></td>
    <td>
      <?php echo $data['nama_pembeli'];	
	?>
    </td>
    <td><?php echo $data['nama_provinsi']; ?></td>
    <td><?php echo $data['nama_kabupaten']; ?></td>
    <td><?php echo $data['nama_kecamatan']; ?></td>
    <td><?php echo $data['kelurahan_id']; ?></td>
    <td><?php echo $data['qty']; ?></td>
    </tr>
  <?php } ?>
</table>