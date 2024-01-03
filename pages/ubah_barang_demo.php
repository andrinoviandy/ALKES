<?php
$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_demo.id as idd from barang_demo where id=".$_GET['id_ubah'].""));

if (isset($_GET['id_hapus'])) {
	$del1 = mysqli_query($koneksi, "delete from barang_demo_qty where id=".$_GET['id_hapus_qty']."");
	if ($del1) {
		echo "<script type='text/javascript'>
		window.location='index.php?page=ubah_barang_demo&id_ubah=$_GET[id_ubah]'
		</script>";
		}
	else {
		echo "<script type='text/javascript'>
		alert('Data Tidak Dapat Di Hapus Karena Sudah Di Kirim !');	window.location='index.php?page=ubah_barang_demo&id_ubah=$_GET[id_ubah]'
		</script>";
		}
	}

if (isset($_POST['save'])) {
	  $update = mysqli_query($koneksi, "update barang_demo_qty set barang_gudang_id=".$_POST['id_akse'].", qty=".$_POST['qty']." where id=".$_POST['id_ubah_qty']."");
	  if ($update) {
		  echo "<script>window.location='index.php?page=ubah_barang_demo&id_ubah=$_GET[id_ubah]';
		  </script>";
		  }
	  }

if (isset($_POST['lapor'])) {
	$query=mysqli_query($koneksi, "update barang_demo set tgl_pinjam='".$_POST['tgl_pinjam']."',supplier='".$_POST['supplier']."',deskripsi_kegiatan='".str_replace("\n","<br>",$_POST['kegiatan'])."',estimasi_kembali='".$_POST['estimasi_kembali']."',subdis='".$_POST['subdis']."',pic='".$_POST['pic']."' where id=".$_GET['id_ubah']."");
		if ($query) {
		echo "<script type='text/javascript'>
		alert('Item Berhasil Diubah !');
		window.location='index.php?page=barang_demo'
		</script>";
			
	} else {
		echo "<script type='text/javascript'>
		alert('Item Gagal Diubah !');
		</script>";
		}
}
	?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ubah Data Barang Demo</h1><ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Jual Alkes</li>
        <li class="active">Ubah Data Barang Demo</li>
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
              <strong>Tanggal Pinjam</strong>
              <input name="tgl_pinjam" type="date" class="form-control" required autofocus="autofocus" value="<?php echo $data['tgl_pinjam']; ?>"/><br />
              <strong>Supplier</strong>
              <input name="supplier" type="text" class="form-control" required value="<?php echo $data['supplier']; ?>"/><br />
              <strong>Deskripsi Kegiatan</strong>
              <textarea name="kegiatan" class="form-control" rows="4"><?php echo str_replace("<br>","\n",$data['deskripsi_kegiatan']); ?></textarea>
              <br />
              <strong>Estimasi Kembali</strong>
              <input name="estimasi_kembali" type="date" class="form-control" value="<?php echo $data['estimasi_kembali']; ?>"/>
              <br />
              <strong>Subdis</strong>
              <input name="subdis" type="text" class="form-control" required value="<?php echo $data['subdis']; ?>"/><br />
              <strong>PIC</strong>
              <input name="pic" type="text" class="form-control" required value="<?php echo $data['pic']; ?>"/><br />
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
              <h3 class="box-title">Detail Alkes</h3>
              <span class="pull pull-right"></span>
              </div><div class="box-body">
          <br />
          <table  width="100%" id="example1" class="table table-bordered table-hover">
              <thead>
  <tr>
    <th><strong>Nama Alkes</strong></th>
    <th>Merk</th>

    <th><strong>Tipe</strong></th>
    <th>Qty</th>
   
    <th>Aksi</th>
    
    <!--<th><strong>Aksi</strong></th>-->
  </tr>
  </thead>
  <?php
  $q = mysqli_query($koneksi, "select *,barang_demo_qty.id as idd from barang_demo_qty,barang_gudang where barang_gudang.id=barang_demo_qty.barang_gudang_id and barang_demo_id=".$_GET['id_ubah']."");
  $no=0;
  while ($d = mysqli_fetch_array($q)) {
  $no++;
  ?>
  <tr>
    <td><?php echo $d['nama_brg']; ?></td>
    <td><?php echo $d['merk_brg']; ?></td>
    <td><?php echo $d['tipe_brg']; ?></td>
    <td><?php echo $d['qty']; ?></td>
    
    <td><a href="#" data-toggle="modal" data-target="#modal-ubah<?php echo $d['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp;&nbsp;<a href="index.php?page=ubah_barang_demo&id_hapus=<?php echo $d['idd']; ?>&id_ubah=<?php echo $_GET['id_ubah']; ?>" onclick="return confirm('Anda yakin akan menghapus item ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a></td>
  </tr>
  
  <div class="modal fade" id="modal-ubah<?php echo $d['idd']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Ubah Barang</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <p align="justify">
              <input type="hidden" name="id_ubah_qty" value="<?php echo $d['idd']; ?>" />
              <label>Pilih Alkes</label>
     <select name="id_akse" id="id_akse" class="form-control select2" autofocus="autofocus" required style="width:100%">
    	<option value="">...</option>
        <?php 
		$qq = mysqli_query($koneksi, "select * from barang_gudang where stok_total!=0 order by nama_brg ASC");
		$ss = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_demo_qty,barang_gudang where barang_gudang.id=barang_demo_qty.barang_gudang_id and barang_demo_qty.id=".$d['idd'].""));
		$jsArray2 = "var dtBrg = new Array();
";
		while ($d2 = mysqli_fetch_array($qq)) { ?>
        <option value="<?php echo $d2['id']; ?>" <?php if ($d2['id']==$ss['barang_gudang_id']) {echo "selected";} ?>><?php echo $d2['nama_brg']; ?></option>
        <?php 
		$jsArray2 .= "dtBrg['" . $d2['id'] . "'] = {tipe_akse:'".addslashes($d2['tipe_brg'])."',
						merk_akse:'".addslashes($d2['merk_brg'])."'
						};";
		} ?>
    </select>
     <!--
     <label>Merk</label>
     <input name="merk" type="text" disabled="disabled" required class="form-control" id="merk" placeholder="" value="<?php echo $ss['merk_brg']; ?>">
     <label>Tipe</label>
     <input name="tipe" type="text" disabled="disabled" required class="form-control" id="tipe" placeholder="" value="<?php echo $ss['tipe_brg']; ?>">
     -->
     <label>Qty</label>
     <?php $y = mysqli_fetch_array(mysqli_query($koneksi, "select qty from barang_demo_qty where id=".$d['idd']."")); ?>
     <input id="input" type="text" placeholder="" name="qty" required value="<?php echo $y['qty']; ?>">
              </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button name="save" type="submit" class="btn btn-success">Simpan</button>
              </div>
              </form>
              <!--<script type="text/javascript">    
	<?php 
	//echo $jsArray2; 
	?>  
	function changeValue(id_akse){  
		document.getElementById('tipe').value = dtBrg[id_akse].tipe_akse; 
		document.getElementById('merk').value = dtBrg[id_akse].merk_akse;
	};  
</script>-->
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