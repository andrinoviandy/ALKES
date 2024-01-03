<?php 
if (isset($_POST['simpan_barang'])) {
	$simp = mysqli_query($koneksi, "update barang_pesan_inventory_detail set status_ke_stok=1 where id=".$_GET['id_detail']."");
	$simp2 = mysqli_query($koneksi, "update barang_inventory set stok_total=stok_total+$_GET[stok_set] where id=".$_GET['id_gudang']."");
	echo "<script type='text/javascript'>		window.location='index.php?page=mutasi_inventory&id=$_GET[id]';</script>";
	}
	
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Mutasi Barang Inventory</h1>
      <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Mutasi Inventory</li>
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
              <form method="post" enctype="multipart/form-data">
                <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom"><strong>Nama Alkes</strong></th>
      <th valign="bottom">NIE</th>
      <th valign="bottom"><strong>Tipe</strong></th>
      <th valign="bottom">Merk</th>
      <th valign="bottom"><strong>Negara Asal</strong></th>
      <th valign="bottom"><strong>Deskripsi Alat</strong></th>
      </tr>
  </thead>
  <?php
	$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_inventory where id=".$_GET['id_gudang'].""));
	?> 
  <tr>
    <td><?php echo $data['nama_brg']; ?>
    </td>
    <td><?php echo $data['nie_brg']; ?></td>
    <td><?php echo $data['tipe_brg']; ?></td>
    <td><?php echo $data['merk_brg']; ?></td>
    <td><?php echo $data['negara_asal']; ?></td>
    <td><?php echo $data['deskripsi_alat']; ?></td>
    </tr>
</table>
                <br />
                <table width="50%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">Nomor PO</th>
      <th valign="bottom">Stok</th>
      </tr>
  </thead>
  <?php

	?> 
  <tr>
    <td>
      <?php
	$data2 = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_pesan_inventory where id=".$_GET['id'].""));
	?> 
      <input id="" name="no_po" class="form-control" type="text"  placeholder="" size="4" required value="<?php echo $data2['no_po_pesan']; ?>" readonly="readonly"/></td>
    <td><input id="no_po" name="stok" class="form-control" type="text" readonly="readonly" placeholder="" size="1" required="required" value="<?php echo $_GET['stok_set']; ?>"/></td>
    </tr>
</table><br /><center>
<button name="simpan_barang" class="btn btn-success" onclick="return confirm('Setelah di mutasi barang tidak dapat dikembalikan !')" type="submit"><span class="fa fa-check"></span> Mutasi & Simpan</button></center>
                <br />
              </form>
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
  if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "insert into aksesoris values('','".$_POST['nama_akse']."','".$_POST['merk']."','".$_POST['tipe']."','".$_POST['no_seri']."','".$_POST['stok']."', '".$_POST['deskripsi']."','".$_POST['harga_satuan']."')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Tambah !');
		window.location='index.php?page=simpan_tambah_aksesoris&id=$_GET[id]';
		</script>";
		}
	}
		?>
  <div id="openAkse" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Tambah Aksesoris Baru</h3> 
     <form method="post">
              <input name="nama_akse" class="form-control" type="text" required placeholder="Nama Aksesoris" autofocus><br />
              
              <input name="merk" class="form-control" type="text" placeholder="Merk" required><br />
              
              <input name="tipe" class="form-control" type="text" placeholder="Tipe" required><br />
              
              <input name="no" class="form-control" type="text" placeholder="Nomor Seri" required><br />
              
              <input name="stok" class="form-control" type="text" placeholder="Stok" required><br />
              
              <textarea name="deskripsi" class="form-control" type="text" rows="5" placeholder="Deskripsi Alat" required></textarea><br />
              <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator'])) { ?>
              <input name="harga_satuan" class="form-control" type="text" placeholder="Harga Satuan" required><br />
              <?php } ?>
              
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button>
              <br /><br />
              </form>
              
    </div>
</div>
