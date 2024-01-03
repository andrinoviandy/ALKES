<?php
$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_dijual.id as idd,pembeli.id as id_pembeli from barang_dijual,barang_dijual_qty,barang_gudang, pembeli,pemakai where barang_dijual.id=barang_dijual_qty.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and pemakai.id=barang_dijual.pemakai_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual.id=".$_GET['id'].""));

if (isset($_POST['lapor'])) {
	$u = mysqli_query($koneksi, "update utang_piutang set no_faktur_no_po='".$_POST['no_faktur']."' where no_faktur_no_po='".$data['no_po_jual']."'");
	$query=mysqli_query($koneksi, "update barang_dijual set tgl_jual='".$_POST['tgl_jual']."',no_po_jual='".$_POST['no_faktur']."',marketing='".$_POST['marketing']."',subdis='".$_POST['subdis']."',diskon_jual='".$_POST['diskon']."',ppn_jual='".$_POST['ppn']."' where id=".$_GET['id']."");
	$jml = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual*harga_jual_saat_itu)+(sum(qty_jual*harga_jual_saat_itu)*ppn_jual/100)-(sum(qty_jual*harga_jual_saat_itu)*diskon_jual/100) as total from barang_dijual_qty where barang_dijual_id=".$_GET['id'].""));
	$quer2y=mysqli_query($koneksi, "update barang_dijual set total_harga=".$jml['total']." where id=".$_GET['id']."");
		if ($u and $query and $quer2y) {
		echo "<script type='text/javascript'>
		alert('Item Berhasil Diubah !');
		window.location='index.php?page=jual_barang_uang'
		</script>";
			
	} else {
		echo "<script type='text/javascript'>
		alert('Item Gagal Diubah !');
		</script>";
		}
}

if (isset($_GET['id_hapus_qty'])) {
	$del1 = mysqli_query($koneksi, "delete from barang_dijual_qty where id=".$_GET['id_hapus_qty']."");
	
	if ($del1) {
		$jml = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual*harga_jual_saat_itu) as total from barang_dijual_qty where barang_dijual_id=".$_GET['id'].""));
		  mysqli_query($koneksi, "update barang_dijual set total_harga=".$jml['total']." where id=".$_GET['id']."");
		echo "<script type='text/javascript'>
		window.location='index.php?page=ubah_barang_jual2_uang&id=$_GET[id]'
		</script>";
		}
	else {
		echo "<script type='text/javascript'>
		alert('Maaf item tidak dapat di hapus karena sudah masuk proses gudang ! Jika ingin melanjutkan, hapus proses di gudang terlebih dahulu !');
		window.location='index.php?page=ubah_barang_jual2_uang&id=$_GET[id]'
		</script>";
			}
	}
	?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ubah Data Jual Alkes</h1><ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Jual Alkes</li>
        <li class="active">Ubah Data Jual Alkes</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
<div class="row">
<div class="col-md-5"><!-- /.box -->

          <!-- iCheck -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Ubah Data</h3>
            </div>
          <div class="box-body">
          	<form method="post">
              Tanggal Jual
              <input name="tgl_jual" type="date" class="form-control" required autofocus="autofocus" value="<?php echo $data['tgl_jual']; ?>"/><br />
              No PO
              <input name="no_faktur" type="text" class="form-control" required value="<?php echo $data['no_po_jual']; ?>"/><br />
              Marketing
              <input name="marketing" type="text" class="form-control" required value="<?php echo $data['marketing']; ?>"/><br />
              Sub Distributor
              <input name="subdis" type="text" class="form-control" required value="<?php echo $data['subdis']; ?>"/><br />
              Diskon (%)
              <input name="diskon" type="text" class="form-control" required value="<?php echo $data['diskon_jual']; ?>"/><br />
              PPN (%)
              <input name="ppn" type="text" class="form-control" required value="<?php echo $data['ppn_jual']; ?>"/><br />
              <!--Total Harga
              <?php
              $sel = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual*harga_jual_saat_itu) as total from barang_dijual_qty where barang_dijual_id=".$_GET['id'].""));
			  ?>
              <input name="total_harga" type="text" class="form-control" required value="<?php 
			  if ($data['total_harga']!=0) {
			  echo $data['total_harga'];} else {
				  echo $sel['total'];
				  } ?>"/><br />-->
            	<input name="lapor" type="submit" value="Simpan Perubahan" class="btn btn-success"/>
            </form>
          </div>
          </div>
          <!-- /.box -->
        </div>
      <div class="col-md-7">

        <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Detail Alkes Yang Dijual</h3>
              <span class="pull pull-right"></span>
              </div><div class="box-body">
              <a href="index.php?page=ubah_barang_jual2_uang&id=<?php echo $_GET['id']; ?>#openTambah"><button type="button" class="btn btn-success"><span class="fa fa-plus"></span> Tambah</button></a>
              <br />
          <br />
          <table  width="100%" id="example1" class="table table-bordered table-hover">
              <thead>
  <tr>
    <th><strong>Nama Alkes</strong></th>
    <th>Merk</th>

    <th><strong>Tipe</strong></th>
    <th>Qty</th>
    <th>Harga Jual Saat Input</th>
   
    <th>Harga Jual Saat ini</th>
    <th>Aksi</th>
    
    <!--<th><strong>Aksi</strong></th>-->
  </tr>
  </thead>
  <?php
  $q = mysqli_query($koneksi, "select *,barang_dijual_qty.id as idd from barang_dijual_qty,barang_gudang where barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual_id=".$_GET['id']."");
  $no=0;
  while ($d = mysqli_fetch_array($q)) {
  $no++;
  ?>
  <tr>
    <td><?php echo $d['nama_brg']; ?></td>
    <td><?php echo $d['merk_brg']; ?></td>
    <td><?php echo $d['tipe_brg']; ?></td>
    <td><?php echo $d['qty_jual']; ?></td>
    <td><?php echo "Rp ".number_format($d['harga_jual_saat_itu'],0,',','.'); ?></td>
    <td><?php echo "Rp ".number_format($d['harga_satuan'],0,',','.'); ?></td>
    <td><a href="index.php?page=ubah_barang_jual2_uang&id=<?php echo $_GET['id']; ?>&id_hapus_qty=<?php echo $d['idd']; ?>" onclick="return confirm('Anda yakin akan menghapus item ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;&nbsp;&nbsp;<a href="index.php?page=ubah_barang_jual2_uang&id=<?php echo $_GET['id']; ?>&id_ubah=<?php echo $d['idd']; ?>#openUbah"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a></td>
    <!--
    <td><a href="index.php?page=simpan_tambah_aksesoris&id=<?php echo $data['idd']; ?>"><small data-toggle="tooltip" title="Kelola Aksesoris" class="label bg-green">Batal Jual</small></a><br /><a href="index.php?page=simpan_tambah_aksesoris&id=<?php echo $data['idd']; ?>"><small data-toggle="tooltip" title="Kelola Aksesoris" class="label bg-yellow">Ganti Barang</small></a></td>-->
    <!--<td>
    <a href="index.php?page=ubah_barang_dijual2&id=<?php echo $_GET['id']; ?>&detail=<?php echo $d['idd']; ?>#open_detail"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp;
    <?php if (isset($_SESSION['user_administrator']) or isset($_SESSION['user_admin_gudang'])) { ?>
    <a href="index.php?page=ubah_barang_jual2&id=<?php echo $_GET['id']; ?>&id_hapus=<?php echo $d['idd']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="fa fa-trash"></span></a>
    <?php } ?>
    </td>-->
  </tr>
  <?php } ?>
</table>

              
              </div>
            </div>
          </div>
          <!-- /.box --><!-- /.box -->

        </div>
        
    <!-- /.content -->
  </div>
  </section>
  </div>
  <?php
  if (isset($_POST['save'])) {
	  $update = mysqli_query($koneksi, "update barang_dijual_qty set barang_gudang_id=".$_POST['id_akse2'].", qty_jual=".$_POST['qty2'].", harga_jual_saat_itu=".$_POST['harga_jual']." where id=".$_GET['id_ubah']."");
	  if ($update) {
		  echo "<script>
		  alert('Berhasil Di Ubah !');
		  window.location='index.php?page=ubah_barang_jual2_uang&id=$_GET[id]';
		  </script>";
		  }
	  }
  ?>
<div id="openTambah" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Tambah Barang</h3> 
     <form method="post">
     <label>Pilih Alkes</label>
     <select name="id_akse2" id="id_akse2" class="form-control" autofocus="autofocus" required onchange="changeValue(this.value)">
    	<option value="">-- Pilih Alkes --</option>
        <?php 
		$q2 = mysqli_query($koneksi, "select * from barang_gudang where stok_total!=0 order by nama_brg ASC");
		//$s = mysqli_fetch_array(mysqli_query($koneksi, "select barang_gudang_id from barang_dijual_qty where id=".$_GET['id_ubah'].""));
		$jsArray2 = "var dtBrg2 = new Array();
";
		while ($d = mysqli_fetch_array($q2)) { ?>
        <option value="<?php echo $d['id']; ?>"><?php echo $d['nama_brg']; ?></option>
        <?php 
		$jsArray2 .= "dtBrg2['" . $d['id'] . "'] = {tipe_akse:'".addslashes($d['tipe_brg'])."',
						merk_akse:'".addslashes($d['merk_brg'])."',
						harga_jual:'".addslashes($d['harga_satuan'])."'
						};";
		} ?>
    </select>
     <label>Merk</label>
     <input name="merk" type="text" disabled="disabled" required class="form-control" id="merk2" placeholder="">
     <label>Tipe</label>
     <input name="tipe" type="text" disabled="disabled" required class="form-control" id="tipe2" placeholder="">
     <label>Harga Jual</label>
     <input name="harga_jual" type="text" readonly="readonly" required class="form-control" id="harga_jual2" placeholder="">
     <label>Qty</label>
     
     <input id="input" type="text" placeholder="" name="qty2" required value="">
     <button id="buttonn" name="tambah" type="submit">Next</button>
    </form>
    <script type="text/javascript">    
	<?php 
	echo $jsArray2; 
	?>  
	function changeValue(id_akse2){  
		document.getElementById('tipe2').value = dtBrg2[id_akse2].tipe_akse; 
		document.getElementById('merk2').value = dtBrg2[id_akse2].merk_akse;
		document.getElementById('harga_jual2').value = dtBrg2[id_akse2].harga_jual;
	};  
</script>
    </div>
</div>

<?php
  if (isset($_POST['tambah'])) {
	  $update = mysqli_query($koneksi, "insert into barang_dijual_qty values('','".$_GET['id']."','".$_POST['id_akse2']."','".$_POST['harga_jual']."','".$_POST['qty2']."','')");
	  if ($update) {
		  $jml = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual*harga_jual_saat_itu) as total from barang_dijual_qty where barang_dijual_id=".$_GET['id'].""));
		  mysqli_query($koneksi, "update barang_dijual set total_harga=".$jml['total']." where id=".$_GET['id']."");
		  echo "<script>
		  alert('Berhasil Disimpan !');
		  window.location='index.php?page=ubah_barang_jual2_uang&id=$_GET[id]';
		  </script>";
		  }
	  }
  ?>
<div id="openTambah" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Tambah Barang</h3> 
     <form method="post">
     <label>Pilih Alkes</label>
     <select name="id_akse2" id="id_akse2" class="form-control" autofocus="autofocus" required onchange="changeValue(this.value)">
    	<option value="">-- Pilih Alkes --</option>
        <?php 
		$q2 = mysqli_query($koneksi, "select * from barang_gudang where stok_total!=0 order by nama_brg ASC");
		//$s = mysqli_fetch_array(mysqli_query($koneksi, "select barang_gudang_id from barang_dijual_qty where id=".$_GET['id_ubah'].""));
		$jsArray2 = "var dtBrg2 = new Array();
";
		while ($d = mysqli_fetch_array($q2)) { ?>
        <option value="<?php echo $d['id']; ?>"><?php echo $d['nama_brg']; ?></option>
        <?php 
		$jsArray2 .= "dtBrg2['" . $d['id'] . "'] = {tipe_akse:'".addslashes($d['tipe_brg'])."',
						merk_akse:'".addslashes($d['merk_brg'])."',
						harga_jual:'".addslashes($d['harga_satuan'])."'
						};";
		} ?>
    </select>
     <label>Merk</label>
     <input name="merk" type="text" disabled="disabled" required class="form-control" id="merk2" placeholder="">
     <label>Tipe</label>
     <input name="tipe" type="text" disabled="disabled" required class="form-control" id="tipe2" placeholder="">
     <label>Harga Jual</label>
     <input name="harga_jual" type="text" readonly="readonly" required class="form-control" id="harga_jual2" placeholder="">
     <label>Qty</label>
     
     <input id="input" type="text" placeholder="" name="qty2" required value="">
     <button id="buttonn" name="tambah" type="submit">Next</button>
    </form>
    <script type="text/javascript">    
	<?php 
	echo $jsArray2; 
	?>  
	function changeValue(id_akse2){  
		document.getElementById('tipe2').value = dtBrg2[id_akse2].tipe_akse; 
		document.getElementById('merk2').value = dtBrg2[id_akse2].merk_akse;
		document.getElementById('harga_jual2').value = dtBrg2[id_akse2].harga_jual;
	};  
</script>
    </div>
</div>