<?php require("config/koneksi.php"); ?>
<?php session_start(); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 align="center">
        Laporan  Alkes Terjual
      </h1>
      
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
          <div class="box box-info"><!-- /.chat -->
            <div class="box-footer">
              <div class="box-body table-responsive no-padding">
              <div class=""><span class="pull pull-right">&nbsp;&nbsp;&nbsp;</span>
              
                <table border="1" class="table table-bordered table-hover" id="example1">
  <thead>
    <tr>
      <td align="center"><strong>No</strong></th>
        
        <th align="center"><strong>Tanggal Jual</strong></th>
      <th align="center"><strong>Nama Alkes</strong></th>
      <th align="center">No Seri</th>
      <th align="center"><strong>Pembeli</strong></th>
      <th align="center">Alamat</th>
      <th align="center">Kontak</th>
      <th align="center"><strong>Qty</strong></th>
      </tr>
  </thead>
  <?php
	  $query = mysqli_query($koneksi, "select *,jual_barang.id as idd from master_barang,jual_barang where master_barang.id=jual_barang.id_master_brg and jual_barang.tgl_beli between '$tgl1' and '$tgl2' order by jual_barang.id DESC");
  
  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td>
    <?php if ($data['tgl_kirim']!='0000-00-00') { ?>
    <a href="index.php?page=kirim_barang&id_krm=<?php echo $data['id']; ?>"><?php echo date("d F Y",strtotime($data['tgl_beli'])); ?></a>
    <?php } else {
	echo date("d F Y",strtotime($data['tgl_beli']));	
	}?>
    </td>
    <td><?php echo $data['nama_brg']; ?></td>
    <td><?php echo $data['no_seri_brg']; ?></td>
    <td><?php echo $data['pembeli']; ?></td>
    <td><?php echo $data['alamat_pembeli']; ?></td>
    <td><?php echo $data['telp_pembeli']; ?></td>
    <td><?php echo $data['qty']; ?></td>
    </tr>
  <?php } ?>
</table>
</div>
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
