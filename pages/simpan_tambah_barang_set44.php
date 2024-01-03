<?php
if (isset($_POST['simpan_akse'])) {
	$nilai_maks1=$_GET['id_gudang'];
	
	$simpan_po=mysqli_query($koneksi, "insert into barang_gudang_po_set values('','$nilai_maks1','".$_SESSION['tgl_masuk']."','".$_SESSION['no_po']."','".$_SESSION['stok_set']."')");
	
	$maks = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as mak from barang_gudang_po_set"));
	
	$nilai_maks=$maks['mak'];
	
	for ($i=0; $i<$_SESSION['stok_set']; $i++) {
		$s2=mysqli_query($koneksi, "insert into barang_gudang_set_1 values('','$nilai_maks')");
		$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_set from barang_gudang_set_1"));
		for ($j=0; $j<$_SESSION['stok_dalam_1set']; $j++) {
			$s3=mysqli_query($koneksi, "insert into barang_gudang_set_2 values('','".$max['id_set']."','".$_POST['nama_brg'][$j]."','".$_POST['harga_beli'][$j]."','".$_POST['harga_jual'][$j]."','".$_POST['qty'][$j]."')");
			}
		}	
		
		if ($s2 and $s3 and $simpan_po) {
			mysqli_query($koneksi, "update barang_pesan_set_detail set status_ke_stok=1 where id=".$_GET['id_detail']."");
			echo "<script type='text/javascript'>
		alert('Data Berhasil Disimpan !');		window.location='index.php?page=mutasi_set&id=$_GET[id]';
		</script>
		";
		unset($_SESSION['tgl_masuk']);
		unset($_SESSION['no_po']);
		unset($_SESSION['stok_set']);
		unset($_SESSION['stok_dalam_1set']);
		}
	}
	
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Tambah Barang Set</h1><ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Barang Set</li>
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
      <th valign="bottom">Tgl Masuk</th>
      <th valign="bottom">Po Nomor</th>
      <th valign="bottom">Jumlah Set</th>
      <th valign="bottom">Stok Dalam 1 Set</th>
      </tr>
  </thead>
  <?php

	?> 
  <tr>
    <td><?php echo date("d/m/Y",strtotime($_SESSION['tgl_masuk'])); ?></td>
    <td><?php echo $_SESSION['no_po']; ?></td>
    <td bgcolor=""><?php echo $_SESSION['stok_set']; ?></td>
    <td bgcolor="#00FF00"><?php echo $_SESSION['stok_dalam_1set']; ?></td>
    </tr>
</table><br />
                <br />
                <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td width="8%" align="center" valign="bottom">Data  Ke-</td>
      
      <td width="45%" align="center" valign="bottom"><strong>Nama Barang</strong></td>
      <td width="19%" align="center" valign="bottom"><strong>Harga Beli</strong></td>
      <td width="20%" align="center" valign="bottom"><strong>Harga Jual</strong></td>
      <td width="8%" align="center" valign="bottom"><strong>Qty</strong></td>
      </tr>
  </thead>
  
  
  <?php 
  $sql=mysqli_query($koneksi, "select * from barang_gudang_set,barang_gudang_po_set,barang_gudang_set_1,barang_gudang_set_2 where barang_gudang_set.id=barang_gudang_po_set.barang_gudang_set_id and barang_gudang_po_set.id=barang_gudang_set_1.barang_gudang_po_set_id and barang_gudang_set_1.id=barang_gudang_set_2.barang_gudang_set1_id and barang_gudang_set.id=".$_GET['id']." order by barang_gudang_set_2.id ASC");
  $no=0;
  while ($data = mysqli_fetch_array($sql)) {
  $no++;
  ?>
  <tr>
    <td align="center" bgcolor="#00FF00"><b><?php echo $no; ?></b></td>
    
    <td align="center"><input name="nama_brg[]" class="form-control" type="text" placeholder="" value="<?php echo $data['nama_set']; ?>" required="required"/></td>
    <td align="center"><input name="harga_beli[]" class="form-control" type="text" placeholder="" size="4"/></td>
    <td align="center"><input name="harga_jual[]" class="form-control" type="text" placeholder="" value="<?php echo $data['harga_jual']; ?>" size="4"/></td>
    <td align="center"><strong>
      <input id="[]" name="qty[]" class="form-control" type="text" required placeholder="" size="3" value="<?php echo $data['qty']; ?>"/>
    </strong></td>
    </tr>
  <?php } ?>
  <tr>
    <td colspan="6" align="center"><br /><br /><button name="simpan_akse" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan</button></td>
    </tr>
  
  <script type="text/javascript">    
	<?php 
	echo $jsArray; 
	?>  
	function changeValue(id_akse){  
		document.getElementById('tipe_akse').value = dtBrg[id_akse].tipe_akse; 
		document.getElementById('merk_akse').value = dtBrg[id_akse].merk_akse;
		document.getElementById('no_akse').value = dtBrg[id_akse].no_akse;
		
	};  
</script>
</table>
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
