<?php require("config/koneksi.php"); ?>
<?php
// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excell
$id=$_GET['id'];

?>
  <?php
  $d1 = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang where id=$id")); 
 
  ?>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
        <title>Cetak Rekapan Stok Alkes</title>
        <style>
         .mytable{
                border:1px solid black; 
                border-collapse: collapse;
                width: 100%;
            }
            .mytable tr th, .mytable tr td{
                border:1px solid black; 
                padding: 5px 10px;
            }
        </style>
        <link href='logo.png' rel='icon'>
    </head>
    <body onLoad="window.print();">
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
              <table border="1" id="" class="mytable">
  <thead>
    <tr>
      <th align="center"><strong>Nama Alkes</strong></th>
        <th align="center">NIE</th>
      <th align="center">Merk</th>
      <th align="center"><strong>Tipe</strong></th>
      <th align="center">Negara asal</th>
      <th align="center">Deskripsi Alat</th>
      <th align="center">Total Stok</th>
      </tr>
  </thead>
  <tr>
    <td><?php echo $d1['nama_brg']; ?></td>
    <td align="center"><?php echo $d1['nie_brg']; ?></td>
    <td align="center"><?php echo $d1['merk_brg']; ?></td>
    <td><?php echo $d1['tipe_brg']; ?></td>
    <td><?php echo $d1['negara_asal']; ?></td>
    <td><?php echo $d1['deskripsi_alat']; ?></td>
    <td align="right"><?php echo $d1['stok_total']; ?></td>
    </tr>
</table>
              <br />
              <h3 align="center">Detail Stok</h3>
                <table border="1" id="" class="mytable">
  
    <tr>
      <td align="center"><strong>No</strong>&nbsp;</th>
        
        <th align="center"><strong>Tanggal Masuk</strong></th>
      <th align="center">No PO</th>
      <th align="center"><strong>Stok Masuk</strong></th>
      <th align="center">Detail</th>
      </tr>
  
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
    <td style="padding:0px; margin:0px">
    <table border="1" class="mytable" width="100%">
      <tr>
        <td bgcolor="#999999"><strong>No Bath</strong></td>
        <td bgcolor="#999999"><strong>No Lot</strong></td>
        <td bgcolor="#999999"><strong>No Seri</strong></td>
        <td bgcolor="#999999"><strong>Nama Set</strong></td>
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
        <td><?php echo $d2['nama_set']; ?></td>
        <td><?php if ($d2['status_kerusakan']==2) {echo "Dikembalikan";} else if ($d2['status_kerusakan']==1) {echo "Rusak";} else {
			if ($d2['status_terjual']==1) { echo "Terjual"; } else { echo "-"; }
			} ?></td>
        <td>
		<?php 
		$d3 = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dijual_detail,barang_dijual,pembeli where barang_dijual.id=barang_dijual_detail.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and barang_gudang_detail_id=".$d2['id_detail'].""));
		if ($d2['status_terjual']==1) { echo $d3['nama_pembeli']; } else { echo ""; } ?></td>
        <td><?php if ($d2['status_terjual']==1) { echo date("d/m/Y",strtotime($d3['tgl_jual'])); } else { echo ""; } ?></td>
        <td><?php 
		$d_cek = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_detail,barang_dikirim,barang_dikirim_detail where barang_dijual_detail.id=barang_dikirim_detail.barang_dijual_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang_detail_id=".$d2['id_detail'].""));
		if ($d_cek!=0) {
			$d4=mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dijual_detail,barang_dikirim,barang_dikirim_detail where barang_dijual_detail.id=barang_dikirim_detail.barang_dijual_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang_detail_id=".$d2['id_detail'].""));
			echo date("d/m/Y",strtotime($d4['tgl_kirim']));
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
  </body>
  </html>
  