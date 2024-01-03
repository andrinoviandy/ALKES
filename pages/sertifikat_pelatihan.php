
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Sertifikat Pelatihan</h1><ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sertifikat Pelatihan</li>
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
              
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td align="center"><strong>No</strong>
        </th>
        
        <th valign="bottom"><strong>Nama Alkes</strong></th>
      <th valign="bottom"><strong>No Seri</strong></th>
      <th valign="bottom">RS/Dinas/Klinik/dll</th>
      <th valign="bottom"><strong>Jumlah Peserta</strong></th>
      <th valign="bottom"><strong>Pelatih</strong></th>
      <th valign="bottom"><strong>Tgl Pelatihan</strong></th>
      <td align="center" valign="bottom"><strong>Pelatihan Oleh</strong>      
      <td align="center" valign="bottom"><strong>Lamp. 1   
        </strong>
        <td align="center" valign="bottom"><strong>Lamp. 2    
          </strong>          </tr>
  </thead>
  <?php
  
	  $query = mysqli_query($koneksi, "select *,alat_pelatihan.id as idd,aksesoris.id as id_akse from alat_uji,barang_teknisi,barang_dikirim,barang_dijual, barang_gudang,pembeli,aksesoris,alat_pelatihan where barang_gudang.id=barang_dijual.barang_gudang_id and barang_dijual.id=barang_dikirim.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim.id=barang_teknisi.barang_dikirim_id and aksesoris.id=alat_uji.aksesoris_id and barang_teknisi.id=alat_uji.barang_teknisi_id and alat_uji.id=alat_pelatihan.uji_id order by alat_pelatihan.id DESC");
  
  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td><?php echo $data['nama_brg']; ?>
    </td>
    <td><?php echo $data['no_seri_brg']; ?></td>
    <td><?php echo $data['nama_pembeli']; ?></td>
    <td><?php echo $data['banyak_peserta']." Orang"; ?></td>
    <td><?php echo $data['pelatih']; ?></td>
    <td><?php echo date("d F Y",strtotime($data['tgl_pelatihan'])); ?></td>
    <td align="center"><?php echo $data['pelatihan_oleh']; ?></td>
    <td align="center">
    <?php if ($data['lamp1']!="") { ?>
    <a href="gambar_pelatihan/lampiran1/<?php echo $data['lamp1']; ?>" target="_blank"><img src="gambar_pelatihan/lampiran1/<?php echo $data['lamp1']; ?>" width="50px" /></a>
    <?php } ?>
    </td>
    <td align="center">
      <?php if ($data['lamp1']!="") { ?>
      <a target="_blank" href="gambar_pelatihan/lampiran2/<?php echo $data['lamp2']; ?>"><img src="gambar_pelatihan/lampiran2/<?php echo $data['lamp2']; ?>" width="50px" /></a>
      <?php } ?>
    </td>
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
