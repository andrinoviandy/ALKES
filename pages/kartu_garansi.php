
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Cetak Kartu Garansi Alat</h1><ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Cetak Kartu Garansi Alat</li>
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
              <div class="box-body">
              <div class="">
              <!--<a href="index.php?page=tambah_barang_masuk"><button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah Barang</button></a>-->
              <div class="table-responsive no-padding">
              <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">Tgl Jual</th>
      <th valign="bottom">No. Surat jalan</th>
      <th valign="bottom">No PO</th>
      <th valign="bottom">RS/Dinas/Klinik/dll</th>
      <th valign="bottom">Kontak RS</th>
      <th valign="bottom">Pemakai</th>
      <th valign="bottom">Kontak Pemakai</th>
      </tr>
  </thead>
  <?php
  
	  $query = mysqli_query($koneksi, "select * from barang_dijual,pembeli,pemakai,barang_dikirim where pembeli.id=barang_dijual.pembeli_id and pemakai.id=barang_dijual.pemakai_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=".$_GET['id']."");
  
  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td><?php echo date("d-m-Y", strtotime($data['tgl_jual'])); ?></td>
    <td><?php echo $data['no_pengiriman']; ?></td>
    <td><?php echo $data['no_po_jual']; ?></td>
    <td><?php echo $data['nama_pembeli']; ?></td>
    <td><?php echo $data['kontak_rs']; ?></td>
    <td><?php echo $data['nama_pemakai']; ?></td>
    <td><?php echo $data['kontak1_pemakai']." / ".$data['kontak2_pemakai']; ?></td>
    </tr>
  <?php } ?>
</table>
              </div>
                <br />
                <h3 align="center">
                  Detail Alat
                </h3>
                <div class="table-responsive no-padding">
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">No</th>
      <th valign="bottom"><strong>Nama Alkes</strong></th>
      <td valign="bottom"><strong>Tipe Barang     
      </strong>
      <td align="center" valign="bottom"><strong>No Seri                
      </strong>
      <td align="center" valign="bottom"><strong>Aksi</strong></tr>
  </thead>
  <?php
  
	  $query_data = mysqli_query($koneksi, "select *,barang_dikirim_detail.id as idd from barang_gudang,barang_gudang_detail,barang_dikirim,barang_dikirim_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and status_batal=0 and barang_dikirim.id=".$_GET['id']."");
 $no=0;
while ($pecah=mysqli_fetch_array($query_data)) {
  $no++;
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $pecah['nama_brg']; ?>
    </td>
    <td><?php echo $pecah['tipe_brg']; ?></td>
    <td align="center"><?php echo $pecah['no_seri_brg']; ?></td>
    <td align="center"><a href="cetak_kartu_garansi.php?id=<?php echo $pecah['idd']; ?>">Cetak Kartu Garansi</a></td>
    </tr>
  <?php } ?>
</table>
                </div>
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
  <?php 
  if (isset($_POST['jual'])) {
	  $jml1 = mysqli_fetch_array(mysqli_query($koneksi, "select * from master_barang where id=".$_GET['id'].""));
	  if ($_POST['qty']<=$jml1['stok']) {
	  $q = mysqli_query($koneksi, "insert into jual_barang values('','".$_GET['id']."','".$_POST['pembeli']."','".$_POST['qty']."','".$_POST['tgl_beli']."','','','')");
	  if ($q) {
		  mysqli_query($koneksi, "update master_barang set stok=stok-".$_POST['qty']." where id=".$_GET['id']."");
		  echo "<script type='text/javascript'>
		  window.location='index.php?page=jual_barang';
		  </script>";
		  }
		//$d = mysqli_fetch_array(mysqli_query($koneksi, "select * from master barang where id=".$_GET['id'].""));
  } else {
  echo "<script type='text/javascript'>
		  alert('Data Stok Kurang !');
		  </script>"; }
  }
		?>
  <div id="openQuantity" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Jual Barang</h3> 
     <form method="post">
     <input id="input" type="date" placeholder="" name="tgl_beli" required>
     <input id="input" type="text" placeholder="Pembeli" name="pembeli" required>
        <input id="input" type="text" placeholder="Quantity" name="qty" required>
        <button id="buttonn" name="jual" type="submit">Jual Barang</button>
    </form>
    </div>
</div>
