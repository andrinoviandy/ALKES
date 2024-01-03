
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Cetak Sertifikat Pelatihan</h1><ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Cetak Sertifikat Pelatihan</li>
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
              <div class="box-body table-responsive no-padding">
              <div class="">
              <!--<a href="index.php?page=tambah_barang_masuk"><button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah Barang</button></a>-->
              
                <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom"><strong>Nama Alkes</strong></th>
      <th valign="bottom"><strong>No Seri/Nama Set</strong></th>
      <th valign="bottom">RS/Dinas/Klinik/dll</th>
      <th valign="bottom"><strong>Jumlah Peserta</strong></th>
      <th valign="bottom"><strong>Pelatih</strong></th>
      <th valign="bottom"><strong>Tgl Pelatihan</strong></th>
      <td align="center" valign="bottom"><strong>Pelatihan Oleh</strong>      </tr>
  </thead>
  <?php
  
	  $query = mysqli_query($koneksi, "select *,alat_uji_detail.id as idd,pembeli_id as id_rumkit from barang_teknisi,barang_teknisi_detail,barang_teknisi_detail_teknisi, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli, tb_teknisi,alat_uji_detail,alat_pelatihan where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_teknisi_detail.id=barang_teknisi_detail_teknisi.barang_teknisi_detail_id and tb_teknisi.id=barang_teknisi_detail_teknisi.teknisi_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and alat_uji_detail.id=alat_pelatihan.alat_uji_detail_id and alat_pelatihan.id=".$_GET['id']."");
  
  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td><?php echo $data['nama_brg']; ?>
    </td>
    <td><?php echo $data['no_seri_brg']." ".$data['nama_set']; ?></td>
    <td><?php echo $data['nama_pembeli']; ?></td>
    <td><?php echo $data['banyak_peserta']." Orang"; ?></td>
    <td><?php echo $data['pelatih']; ?></td>
    <td><?php echo date("d F Y",strtotime($data['tgl_pelatihan'])); ?></td>
    <td align="center"><?php echo $data['pelatihan_oleh']; ?></td>
    </tr>
  <?php } ?>
</table><br />
                <h3 align="center">
                  Peserta Pelatihan
                </h3>
                <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">No</th>
      <th valign="bottom"><strong>Nama Peserta</strong></th>
      <td align="center" valign="bottom"><strong>Aksi</strong></tr>
  </thead>
  <?php
  
	  $query_data = mysqli_fetch_array(mysqli_query($koneksi, "select * from peserta_pelatihan where alat_pelatihan_id=".$_GET['id'].""));
 
  $pecah=explode(",",$query_data['nama_peserta']);
  $jmlah=count($pecah)-1;
  for ($no=0; $no<$jmlah; $no++) { 
  
  ?>
  <tr>
    <td><?php echo $no+1; ?></td>
    <td><?php echo $pecah[$no]; ?>
    </td>
    <td align="center"><a href="cetak_sertifikat_pelatihan.php?id=<?php echo $_GET['id']; ?>&nama=<?php echo $pecah[$no]; ?>">Cetak Sertifikat Pelatihan</a></td>
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
