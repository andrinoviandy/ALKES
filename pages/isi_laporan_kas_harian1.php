<?php require("config/koneksi.php"); ?>
<?php session_start(); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 align="center">
        Laporan Kas Harian</h1>
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
			  echo "<strong>Form</strong> <i>".date("d F Y",strtotime($t1))."</i>"; ?>
                <table border="1" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th align="center">&nbsp;<strong>No</strong></th>
        
        <th align="center"><strong>Nama Akun</strong></th>
        <th align="center">No PO</th>
      <th align="center"><strong>Nominal</strong></th>
<!--       
      <th align="center">Nama Principle</th>
      <th align="center">Cara Bayar</th>
      <th align="center">Jalur Pengiriman</th>
      <th align="center">Mata Uang</th>
      <th align="center">Qty</th>
      <th align="center"><strong>Harga Satuan</strong></th>
      <th align="center">Diskon</th>
      <th align="center">PPN</th>
      <th align="center">Harga Total</th> -->
      
      </tr>
  </thead>
  <?php

	 $query = mysqli_query($koneksi, "select * from utang_piutang_bayar join utang_piutang on utang_piutang_bayar.utang_piutang_id=utang_piutang.id join buku_kas on utang_piutang_bayar.buku_kas_id=buku_kas.id where tgl_bayar='$tanggal' and where nama_akun='$akun' DESC");  
  $no=0;
   $jm = mysqli_num_rows($query);
  if ($jm!=0) {
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td>
    <?php echo date("d F Y",strtotime($data['nama_akun']));	
	?>
    </td>
    <td><?php echo $data['no_faktur_no_po']; ?></td>
    <td><?php echo $data['nominal']; ?></td>
    
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