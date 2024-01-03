<?php require("config/koneksi.php"); ?>
<?php session_start(); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 align="center">
        Laporan Pembelian Alkes Luar Negeri</h1>
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
			  if (isset($_SESSION['id'])) {
				  echo "User : ".$_SESSION['id']."<br>";
				  }
			  echo "<strong>Form</strong> <i>".date("d F Y",strtotime($tgl1))."</i> <strong>To</strong> <i>".date("d F Y",strtotime($tgl2))."</i>"; ?>
              <table border="1" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td align="center">&nbsp;<strong>No</strong>
        </th>
        
        <th align="center"><strong>Tanggal Pembelian</strong></th>
        <th align="center">No PO</th>
      <th align="center"><strong>Nama Alkes</strong></th>
      
      <th align="center">Nama Principle</th>
      <th align="center">Cara Bayar</th>
      <th align="center">Jalur Pengiriman</th>
      <th align="center">Mata Uang</th>
      <th align="center">Qty</th>
      <th align="center"><strong>Harga Satuan</strong></th>
      <th align="center">Diskon</th>
      <th align="center">PPN</th>
      <th align="center">Harga Total</th>
      
      </tr>
  </thead>
  <?php

	 $query = mysqli_query($koneksi, "select * from barang_pesan,barang_pesan_detail,mata_uang,principle,barang_gudang where barang_gudang.id=barang_pesan_detail.barang_gudang_id and barang_pesan.id=barang_pesan_detail.barang_pesan_id and principle.id=barang_pesan.principle_id and mata_uang.id=barang_pesan.mata_uang_id and jenis_po='Luar Negeri' and tgl_po_pesan between '$tgl1' and '$tgl2' order by tgl_po_pesan DESC");  
  $no=0;
  $jm = mysqli_num_rows($query);
  if ($jm!=0) {
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td>
    <?php echo date("d F Y",strtotime($data['tgl_po_pesan']));	
	?>
    </td>
    <td><?php echo $data['no_po_pesan']; ?></td>
    <td><?php
	echo $data['nama_brg']; ?></td>
    
    <td><?php echo $data['nama_principle']; ?></td>
    <td><?php echo $data['cara_pembayaran']; ?></td>
    <td><?php echo $data['jalur_pengiriman']; ?></td>
    <td align="center"><?php echo $data['jenis_mu']; ?></td>
    <td align="center"><?php echo $data['qty']; ?></td>
    <td><?php echo number_format($data['harga_perunit'],0,',',','); ?></td>
    <td align="center"><?php echo $data['diskon']; ?></td>
    <td align="center"><?php echo $data['ppn']; ?></td>
    <td align="right"><?php echo number_format($data['total_price_ppn'],0,',',','); ?></td>
    </tr>
  <?php }} else { ?>
  <tr>
  <td colspan="13" align="center">Data Kosong</td>
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