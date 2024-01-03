<?php require("config/koneksi.php"); ?>
<?php
// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excell
$id=$_GET['id'];
header("Content-type: application/vnd-ms-excel");
?>
  <?php
  $d1 = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang where id=$id")); 
  header("Content-Disposition: attachment; filename=Rekapan Data $d1[nama_brg].xls");
  ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 align="center">
        Rekapan <?php echo $d1['nama_brg']; ?></h1>
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
              <h3 align="center">Data Alkes</h3>
              <table border="1" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td align="center"><strong>#</strong>&nbsp;</th>
        
        <th align="center"><strong>Nama Alkes</strong></th>
        <th align="center">NIE</th>
      <th align="center">Merk</th>
      <th align="center"><strong>Tipe</strong></th>
      <th align="center">Negara asal</th>
      <th align="center">Deskripsi Alat</th>
      <th align="center">Stok Gudang</th>
      <th align="center">Stok PO</th>
      <th align="center">Stok Rusak</th>
      <th align="center">Stok Demo</th>
      <th align="center">Stok Sisa</th>
      </tr>
  </thead>
  <tr>
    <td align="center"></td>
    <td><?php echo $d1['nama_brg']; ?></td>
    <td align="center"><?php echo $d1['nie_brg']; ?></td>
    <td align="center"><?php echo $d1['merk_brg']; ?></td>
    <td><?php echo $d1['tipe_brg']; ?></td>
    <td><?php echo $d1['negara_asal']; ?></td>
    <td><?php echo $d1['deskripsi_alat']; ?></td>
    <td align="right">
    <?php 
	$stok_total = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_detail where status_kirim=0 and status_kerusakan=0 and status_kembali_ke_gudang=0 and barang_gudang_id=".$d1['id'].""));
	echo $stok_total; ?>
    </td>
    <td align="right"><?php 
	$stok_po1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual) as stok_po from barang_dijual_qty where barang_gudang_id=".$d1['id'].""));
	$stok_po2 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim_detail,barang_gudang_detail,barang_dijual_qty where barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual_qty.id=barang_dikirim_detail.barang_dijual_qty_id and barang_dijual_qty.barang_gudang_id=".$d1['id'].""));
	$stok_po_set1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_barang_gudang*qty_set) as stok_po_set from barang_dijual_qty_set_detail,barang_dijual_qty_set where barang_dijual_qty_set.id=barang_dijual_qty_set_detail.barang_dijual_qty_set_id and barang_gudang_id=" . $d1['id'] . ""));
										  $stok_po_set2 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim_set_detail,barang_gudang_detail where barang_gudang_detail.id=barang_dikirim_set_detail.barang_gudang_detail_id and barang_gudang_id=" . $d1['id'] . ""));
	if ($stok_po1['stok_po']-$stok_po2!=0 or $stok_po_set1['stok_po_set'] - $stok_po_set2 != 0) {
	echo ($stok_po1['stok_po']-$stok_po2) + ($stok_po_set1['stok_po_set'] - $stok_po_set2);
	}
	 ?></td>
    <td align="right"><?php 
	$stok_rusak2 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_detail where status_kerusakan=1 and barang_gudang_id=".$d1['id'].""));
	echo $stok_rusak2; ?></td>
    <td align="right"><?php 
	$stok_demo = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_detail where status_demo=1 and status_kerusakan=0 and status_kembali_ke_gudang=0 and barang_gudang_id=".$d1['id'].""));
	echo $stok_demo; ?></td>
    <td align="right"><span style="background-color:<?php echo $color; ?>">
      <?php 
	echo $stok_total-($stok_po1['stok_po']-$stok_po2);
	 ?>
    </span></td>
    </tr>
</table>
              <br />
              <h3 align="center">Detail Stok</h3>
                <table border="1" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td align="center"><strong>No</strong>&nbsp;</th>
        
        <th align="center"><strong>Tanggal Masuk</strong></th>
      <th align="center">No PO</th>
      <th align="center"><strong>Stok Masuk</strong></th>
      <th align="center">Detail</th>
      </tr>
  </thead>
  <?php
  $query=mysqli_query($koneksi, "select *,barang_gudang_po.id as id_po from barang_gudang,barang_gudang_po where barang_gudang.id=barang_gudang_po.barang_gudang_id and barang_gudang.id=$id");
  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center" valign="top"><?php echo $no; ?></td>
    <td align="left" valign="top">
      <?php echo date("d/m/Y",strtotime($data['tgl_po_gudang']));	
	?>
    </td>
    <td align="left" valign="top"><?php echo $data['no_po_gudang']; ?></td>
    <td align="center" valign="top"><?php echo $data['stok']; ?></td>
    <td><table border="1">
      <tr>
        <td bgcolor="#999999"><strong>No Bath</strong></td>
        <td bgcolor="#999999"><strong>No Lot</strong></td>
        <td bgcolor="#999999"><strong>No Seri</strong></td>
        <td bgcolor="#999999"><strong>Status Alat</strong></td>
        <td bgcolor="#999999"><strong>Terjual Ke-</strong></td>
        <td bgcolor="#999999"><strong>Tgl Terjual</strong></td>
        <td bgcolor="#999999"><strong>Tgl Kirim</strong></td>
      </tr>
      <?php $q2=mysqli_query($koneksi, "select *,barang_gudang_detail.id as id_detail from barang_gudang_detail,barang_gudang_po where barang_gudang_po.id=barang_gudang_detail.barang_gudang_po_id and barang_gudang_po.id=".$data['id_po']."");
	  while ($d2=mysqli_fetch_array($q2)) {
	   ?>
      <tr>
        <td><?php echo $d2['no_bath']; ?></td>
        <td><?php echo $d2['no_lot']; ?></td>
        <td><?php echo $d2['no_seri_brg']; ?></td>
        <td><?php if ($d2['status_kerusakan']==2) {echo "Dikembalikan";} else if ($d2['status_kerusakan']==1) {echo "Rusak";} else {
			if ($d2['status_kirim']==1) { echo "Terjual"; } elseif ($d2['status_demo']==1) { echo "Demo"; } else { echo ""; }
			} ?></td>
        <td>
		<?php 
		$d3 = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dikirim,barang_dikirim_detail,barang_dijual,pembeli where barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_gudang_detail_id=".$d2['id_detail'].""));
		if ($d2['status_kirim']==1) { echo $d3['nama_pembeli']; } else { echo ""; } ?></td>
        <td><?php if ($d2['status_kirim']==1) { echo $d3['tgl_jual']; } else { echo ""; } ?></td>
        <td><?php 
		 if ($d2['status_kirim']==1) {
			echo date("d/m/Y",strtotime($d3['tgl_kirim']));
			} else { echo ""; } ?></td>
      </tr>
      <?php } ?>
    </table></td>
    </tr>
  <?php } ?>
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