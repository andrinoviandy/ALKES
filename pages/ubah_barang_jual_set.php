<?php
$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_dijual_set.id as idd from barang_dijual_set where id=".$_GET['id'].""));

if (isset($_POST['lapor'])) {
	$query=mysqli_query($koneksi, "update barang_dijual_set set tgl_jual='".$_POST['tgl_jual']."',no_faktur_jual='".$_POST['no_faktur']."',marketing='".$_POST['marketing']."',subdis='".$_POST['subdis']."',diskon_jual='".$_POST['diskon']."',ppn_jual='".$_POST['ppn']."' where id=".$_GET['id']."");
		if ($query) {
		echo "<script type='text/javascript'>
		alert('Item Berhasil Diubah !');
		window.location='index.php?page=ubah_barang_jual_set&id=$_GET[id]'
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
              No Faktur
              <input name="no_faktur" type="text" class="form-control" required value="<?php echo $data['no_faktur_jual']; ?>"/><br />
              Marketing
              <input name="marketing" type="text" class="form-control" required value="<?php echo $data['marketing']; ?>"/><br />
              Sub Distributor
              <input name="subdis" type="text" class="form-control" required value="<?php echo $data['subdis']; ?>"/><br />
              Diskon (%)
              <input name="diskon" type="text" class="form-control" required value="<?php echo $data['diskon_jual']; ?>"/><br />
              PPN (%)
              <input name="ppn" type="text" class="form-control" required value="<?php echo $data['ppn_jual']; ?>"/><br />
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
          <br />
          <table  width="100%" id="example1" class="table table-bordered table-hover">
              <thead>
  <tr>
    <th><strong>Nama Set</strong></th>
    <th>Merk</th>
    <th><strong>Qty</strong></th>
    <th class="text-center">Jumlah Barang Dalam 1 Set</th>
    <th>Aksi</th>
    
    <!--<th><strong>Aksi</strong></th>-->
  </tr>
  </thead>
  <?php
  $q = mysqli_query($koneksi, "select *,barang_dijual_qty_set.id as idd from barang_dijual_qty_set,barang_gudang_set where barang_gudang_set.id=barang_dijual_qty_set.barang_gudang_set_id and barang_dijual_set_id=".$_GET['id']."");
  $no=0;
  while ($d = mysqli_fetch_array($q)) {
  $no++;
  ?>
  <tr>
    <td><?php echo $d['nama_brg']; ?></td>
    <td><?php echo $d['merk_brg']; ?></td>
    <td><?php echo $d['qty_set']; ?></td>
    <td class="text-center">
	<small class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-lihat<?php echo $d['idd'] ?>">
                            <i class="fa fa-eye"></i>&nbsp;
	<?php
    $jml = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_qty_set_detail where barang_dijual_qty_set_id = ".$d['idd'].""));
	echo $jml; ?>
    </small>
    </td>
    <td><!--<a href="index.php?page=ubah_barang_jual2_uang&id=<?php echo $_GET['id']; ?>&id_hapus_qty=<?php echo $d['idd']; ?>" onclick="return confirm('Anda yakin akan menghapus item ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;&nbsp;&nbsp;--><a href="index.php?page=ubah_barang_jual_set2&id=<?php echo $_GET['id']; ?>&id_ubah=<?php echo $d['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a></td>
    <!--
    <td><a href="index.php?page=simpan_tambah_aksesoris&id=<?php echo $data['idd']; ?>"><small data-toggle="tooltip" title="Kelola Aksesoris" class="label bg-green">Batal Jual</small></a><br /><a href="index.php?page=simpan_tambah_aksesoris&id=<?php echo $data['idd']; ?>"><small data-toggle="tooltip" title="Kelola Aksesoris" class="label bg-yellow">Ganti Barang</small></a></td>-->
    <!--<td>
    <a href="index.php?page=ubah_barang_dijual2&id=<?php echo $_GET['id']; ?>&detail=<?php echo $d['idd']; ?>#open_detail"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp;
    <?php if (isset($_SESSION['user_administrator']) or isset($_SESSION['user_admin_gudang'])) { ?>
    <a href="index.php?page=ubah_barang_jual2&id=<?php echo $_GET['id']; ?>&id_hapus=<?php echo $d['idd']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="fa fa-trash"></span></a>
    <?php } ?>
    </td>-->
  </tr>
  <div class="modal fade" id="modal-lihat<?php echo $d['idd'] ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Rincian Barang Satuan</h4>
      </div>
        <div class="modal-body">
          <div class="box-title"><?php echo $d['nama_brg']; ?><div class="pull pull-right">Jumlah Set : <?php echo $d['qty_set']; ?></div></div>
          <div class="box box-body col-lg-10">
          <div class="row">
          <div class="col-lg-8 bg-info" style="padding:5px; border:1px solid;"><strong>Nama Barang<br />Satuan</strong></div>
          <div align="center" class="col-lg-2 bg-info" style="padding:5px; border:1px solid"><strong>Jumlah (Satuan)</strong></div>
          <div align="center" class="col-lg-2 bg-info" style="padding:5px; border:1px solid"><strong>Total (Satuan*Set)</strong></div>
          </div>
          <?php
          $q_satuan = mysqli_query($koneksi, "select * from barang_dijual_qty_set_detail, barang_gudang where barang_gudang.id=barang_dijual_qty_set_detail.barang_gudang_id and barang_dijual_qty_set_id = ".$d['idd']."");
		  while ($dt = mysqli_fetch_array($q_satuan)) {
		  ?>
          <div class="row">
          <div class="col-lg-8" style="padding:5px; border:1px solid"><?php echo $dt['nama_brg'] ?></div>
          <div align="center" class="col-lg-2" style="padding:5px; border:1px solid"><?php echo $dt['qty_barang_gudang'] ?></div>
          <div align="center" class="col-lg-2" style="padding:5px; border:1px solid"><?php echo $dt['qty_barang_gudang']*$d['qty_set'] ?></div>
          </div>
          <?php } ?>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          
        </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
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
	  $update = mysqli_query($koneksi, "update barang_dijual_qty set barang_gudang_id=".$_POST['id_akse'].", qty_jual=".$_POST['qty']." where id=".$_GET['id_ubah']."");
	  if ($update) {
		  echo "<script>
		  alert('Berhasil Di Ubah !');
		  window.location='index.php?page=ubah_barang_jual2_uang&id=$_GET[id]';
		  </script>";
		  }
	  }
  ?>
  <div id="openUbah" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Ubah Data</h3> 
     <form method="post">
     <label>Pilih Alkes</label>
     <select name="id_akse" id="id_akse" class="form-control" autofocus="autofocus" required onchange="changeValue(this.value)">
    	<option>-- Pilih Alkes</option>
        <?php 
		$q = mysqli_query($koneksi, "select * from barang_gudang where stok_total!=0 order by nama_brg ASC");
		$s = mysqli_fetch_array(mysqli_query($koneksi, "select barang_gudang_id from barang_dijual_qty where id=".$_GET['id_ubah'].""));
		$jsArray = "var dtBrg = new Array();
";
		while ($d = mysqli_fetch_array($q)) { ?>
        <option value="<?php echo $d['id']; ?>" <?php if ($d['id']==$s['barang_gudang_id']) {echo "selected";} ?>><?php echo $d['nama_brg']; ?></option>
        <?php 
		$jsArray .= "dtBrg['" . $d['id'] . "'] = {tipe_akse:'".addslashes($d['tipe_brg'])."',
						merk_akse:'".addslashes($d['merk_brg'])."'
						};";
		} ?>
    </select>
     <label>Merk</label>
     <input name="merk" type="text" disabled="disabled" required class="form-control" id="merk" placeholder="">
     <label>Tipe</label>
     <input name="tipe" type="text" disabled="disabled" required class="form-control" id="tipe" placeholder="">
     <label>Qty</label>
     <?php $y = mysqli_fetch_array(mysqli_query($koneksi, "select qty_jual from barang_dijual_qty where id=".$_GET['id_ubah']."")); ?>
     <input id="input" type="text" placeholder="" name="qty" required value="<?php echo $y['qty_jual']; ?>">
     <button id="buttonn" name="save" type="submit">Next</button>
    </form>
    <script type="text/javascript">    
	<?php 
	echo $jsArray; 
	?>  
	function changeValue(id_akse){  
		document.getElementById('tipe').value = dtBrg[id_akse].tipe_akse; 
		document.getElementById('merk').value = dtBrg[id_akse].merk_akse;
	};  
</script>
    </div>
</div>