
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan Pembelian
        
      Alkes Luar Negeri</h1><ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Laporan Penjualan Alkes Luar Negeri</li>
      </ol>
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
              <div class="row">
              <div class="box-body">
              Tanggal Pesan PO (Luar Negeri): <br /><br />
              <form method="post" action="cetak_laporan_pembelian_alkes2.php">
              <div class="col-xs-3">
                  <div class="input-group">
                        <span class="input-group-addon">
                          Form <span class="fa fa-calendar"></span>
                        </span>
                    <input name="tgl1" required="required" type="date" class="form-control">
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-xs-3">
                  <div class="input-group">
                        <span class="input-group-addon">
                          To <span class="fa fa-calendar"></span>
                        </span>
                    <input name="tgl2" required="required" type="date" class="form-control">
                  </div>
                  <!-- /input-group -->
                </div>
                <button class="btn btn-success" type="submit"><span class="fa fa-print"></span> Cetak Excel</button>
              </form></div></div>
              <!-- /.chat -->
            <div class="box-footer">
            <div class="box-body table-responsive no-padding">
              <div class="">
              <br />
                <!--
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td align="center">&nbsp;</th>
        
        <th align="center"><strong>Tanggal Dijual</strong></th>
      <th align="center"><strong>Nama Alkes</strong></th>
      <th align="center">No Seri</th>
      <th align="center"><strong>Dinas/RS/Puskemas/Klinik</strong></th>
      <th align="center"><strong>Qty</strong></th>
      </tr>
  </thead>
  <?php
 if (isset($_GET['id_lihat_jual'])) {
$query = mysqli_query($koneksi, "select *,barang_dijual.id as idd from barang_dijual, barang_gudang where barang_gudang.id=barang_dijual.barang_gudang_id and barang_gudang.id=".$_GET['id_lihat_jual']." order by barang_dijual.id DESC");
 } else {
	 $query = mysqli_query($koneksi, "select *,barang_dijual.id as idd from barang_dijual, barang_gudang,pembeli where barang_gudang.id=barang_dijual.barang_gudang_id and pembeli.id=barang_dijual.pembeli_id order by barang_dijual.id DESC");
	 }
  
  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td>
    <?php echo date("d F Y",strtotime($data['tgl_jual']));	
	?>
    </td>
    <td><?php
	$jml=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim where barang_dijual_id=".$data['idd']."")); 
    if ($jml!=0) {
		?>
        <a href="index.php?page=kirim_barang&id_lihat_kirim=<?php echo $data['idd']; ?>" data-toggle="tooltip" title="Lihat Proses Pengiriman"><?php echo $data['nama_brg']; ?></a>
        <?php
	} else {
	echo $data['nama_brg']; } ?></td>
    <td><?php echo $data['no_seri_brg']; ?></td>
    <td><a href="index.php?page=jual_barang&id=<?php echo $data['pembeli_id']; ?>#openDetailPembeli" style="color:#060" data-toggle="tooltip" title="Detail Dinas/RS/Puskesmas/Klinik/Dll"><?php echo $data['nama_pembeli']; ?></a></td>
    <td><?php echo $data['qty']; ?></td>
    </tr>
  <?php } ?>
</table>
-->
              </div>
              </div></div>
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