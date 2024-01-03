<?php
$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_dijual_set.id as idd from barang_dijual_set where id=".$_GET['id'].""));

if (isset($_POST['lapor'])) {
	$query=mysqli_query($koneksi, "update barang_dijual set tgl_jual='".$_POST['tgl_jual']."',no_faktur_jual='".$_POST['no_faktur']."',marketing='".$_POST['marketing']."',subdis='".$_POST['subdis']."',diskon_jual='".$_POST['diskon']."',ppn_jual='".$_POST['ppn']."' where id=".$_GET['id']."");
		if ($query) {
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
	$del1 = mysqli_query($koneksi, "delete from barang_dijual_qty_set_detail where id=".$_GET['id_hapus_qty']."");
	
	/*if ($del1) {
		echo "<script type='text/javascript'>
		window.location='index.php?page=ubah_barang_jual2_uang&id=$_GET[id]'
		</script>";
		}
	else {
		echo "<script type='text/javascript'>
		alert('Maaf item tidak dapat di hapus karena sudah masuk proses gudang ! Jika ingin melanjutkan, hapus proses di gudang terlebih dahulu !');
		window.location='index.php?page=ubah_barang_jual2_uang&id=$_GET[id]'
		</script>";
			}*/
	}
if (isset($_POST['simpan_tambah_aksesoris'])) {
	$hrg = mysqli_fetch_array(mysqli_query($koneksi, "select harga_satuan from barang_gudang where id = ".$_POST['id_akse'].""));
  $insert1 = mysqli_query($koneksi, "UPDATE barang_dijual_qty_set_detail set barang_gudang_id='" . $_POST['id_akse'] . "', harga_jual_saat_itu = '" . $hrg['harga_satuan'] . "', qty_barang_gudang = '".$_POST['qty']."' where id=".$_POST['id_ubah_qty']."");
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
              <button class="btn btn-info pull-right" onclick="window.location.href='?page=ubah_barang_jual_set&id=<?php echo $_GET['id']; ?>'">Kembali</button>
              <span class="pull pull-right"></span>
              </div><div class="box-body">
          <br />
          <table  width="100%" class="table table-bordered table-responsive">
              <thead class="bg-info">
  <tr>
    <th><strong>Nama Set</strong></th>
    <th>Merk</th>
    <th><strong>Qty</strong></th>
    <th class="text-center">Jumlah Barang Dalam 1 Set</th>
    
  </tr>
  </thead>
  <?php
  $q = mysqli_query($koneksi, "select *,barang_dijual_qty_set.id as idd from barang_dijual_qty_set,barang_gudang_set where barang_gudang_set.id=barang_dijual_qty_set.barang_gudang_set_id and barang_dijual_qty_set.id=".$_GET['id_ubah']."");
  $no=0;
  while ($d = mysqli_fetch_array($q)) {
  $no++;
  ?>
  <tr>
    <td><?php echo $d['nama_brg']; ?></td>
    <td><?php echo $d['merk_brg']; ?></td>
    <td><?php echo $d['qty_set']; ?></td>
    <td class="text-center">
	<?php
    $jml = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_qty_set_detail where barang_dijual_qty_set_id = ".$d['idd'].""));
	echo $jml; ?>
    </td>
  </tr>
  <?php } ?>
</table>
<hr />
<div class="box-header with-border">
<h3 class="box-title">Rincian Barang Satuan</h3>
</div>
<div class="box-body">
      <table  width="100%" id="example1" class="table table-bordered table-hover">
              <thead>
  <tr>
    <th><strong>Nama Barang</strong></th>
    <th>Merk</th>
    <th><strong>Tipe</strong></th>
    <th class="text-center">Qty</th>
    <th>Aksi</th>
    
    <!--<th><strong>Aksi</strong></th>-->
  </tr>
  </thead>
  <?php
  $q = mysqli_query($koneksi, "select *,barang_dijual_qty_set_detail.id as idd from barang_dijual_qty_set_detail,barang_gudang where barang_gudang.id=barang_dijual_qty_set_detail.barang_gudang_id and barang_dijual_qty_set_id=".$_GET['id_ubah']."");
  $no=0;
  while ($d = mysqli_fetch_array($q)) {
  $no++;
  ?>
  <tr>
    <td><?php echo $d['nama_brg']; ?></td>
    <td><?php echo $d['merk_brg']; ?></td>
    <td><?php echo $d['tipe_brg']; ?></td>
    <td class="text-center">
	<?php echo $d['qty_barang_gudang']; ?></td>
    <td><a href="index.php?page=ubah_barang_jual_set2&id=<?php echo $_GET['id']; ?>&id_ubah=<?php echo $_GET['id_ubah']; ?>&id_hapus_qty=<?php echo $d['idd']; ?>" onclick="return confirm('Anda yakin akan menghapus item ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;&nbsp;<a data-toggle="modal" data-target="#modal-tambah<?php echo $d['idd'] ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a></td>
  </tr>
  <div class="modal fade" id="modal-tambah<?php echo $d['idd'] ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" align="center"><strong>Ubah Barang</strong></h4>
      </div>
      <form method="post" enctype="multipart/form-data">
        <div class="modal-body">
        <input type="hidden" name="id_ubah_qty" value="<?php echo $d['idd'] ?>" />
          <label>Nama Barang</label>
          <select name="id_akse" id="id_akse" class="form-control select2" autofocus="autofocus" required onchange="changeValue(this.value)" style="width:100%">
            <option value="">...</option>
            <?php
            $q3 = mysqli_query($koneksi, "select * from barang_gudang order by nama_brg ASC");
            $jsArray2 = "var dtBrg = new Array();
";
            while ($d3 = mysqli_fetch_array($q3)) { ?>
              <option <?php if ($d['barang_gudang_id'] == $d3['id']) {echo "selected";} ?> value="<?php echo $d3['id']; ?>"><?php echo $d3['nama_brg']; ?></option>
            <?php
              $jml_brg = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_detail where barang_gudang_id = " . $d3['id'] . " and status_kirim = 0 and status_kerusakan = 0 and status_kembali_ke_gudang = 0 and status_demo = 0"));
              $jsArray2 .= "dtBrg['" . $d3['id'] . "'] = {tipe_akse:'" . addslashes($d3['tipe_brg']) . "',
						merk_akse:'" . addslashes($d3['merk_brg']) . "',
						jumlah_brg:'" . addslashes($jml_brg) . "'
						};";
            } ?>
          </select>
          <br /><br />
          <label>Stok</label>
          <input id="stok_total" name="stok_total" class="form-control" type="text" placeholder="" disabled="disabled" size="4" />
          <br />
          <label>Tipe</label>
          <input id="tipe_akse" name="tipe_akse" class="form-control" type="text" placeholder="" disabled="disabled" size="15" value="<?php echo $d['tipe_brg'] ?>"/>
          <br />
          <label>Merk</label>
          <input id="merk_akse" name="merk_akse" class="form-control" type="text" placeholder="" disabled="disabled" size="15" value="<?php echo $d['merk_brg'] ?>"/>
          <br />
          <label>Qty Jual (Satuan)</label>
          <input id="qty" name="qty" class="form-control" type="number" placeholder="" size="2" value="<?php echo $d['qty_barang_gudang'] ?>"/>
          <br />
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button name="simpan_tambah_aksesoris" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button>
        </div>
        <script type="text/javascript">
          <?php
          echo $jsArray2;
          ?>

          function changeValue(id_akse) {
            document.getElementById('stok_total').value = dtBrg[id_akse].jumlah_brg;
            document.getElementById('tipe_akse').value = dtBrg[id_akse].tipe_akse;
            document.getElementById('merk_akse').value = dtBrg[id_akse].merk_akse;
          };
        </script>
      </form>
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
          </div>
          <!-- /.box --><!-- /.box -->

        </div>
        
    <!-- /.content -->
  </div>
  </section>
  </div>
