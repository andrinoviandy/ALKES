<?php
$query = mysqli_query($koneksi, "select * from barang_gudang_set where id='".$_GET['id']."'");
$data = mysqli_fetch_array($query);

if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from barang_gudang_set_detail where id=".$_GET['id_hapus']."");
	if ($del) {
		echo "<script type='text/javascript'>
alert('Berhasil di hapus !');		window.location='index.php?page=ubah_barang_set&id=$_GET[id]'
		</script>";
		
		}
	}

if (isset($_POST['pencarian'])) {
	$cek = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_set_detail where barang_gudang_id = ".$_POST['nama_barang']." and barang_gudang_set_id = ".$_GET['id'].""));
	if ($cek == 0) {
		$Result = mysqli_query($koneksi, "insert into barang_gudang_set_detail values('','".$_GET['id']."','".$_POST['nama_barang']."', '".$_POST['qty']."')");
		}
	else {
		echo "<script>alert('Barang Sudah Dimasukkan !')</script>";
		}		
	}

if (isset($_POST['simpan_perubahan'])) {
	$Result = mysqli_query($koneksi, "update barang_gudang_set set nama_brg='".$_POST['nama_akse']."', nie_brg='".$_POST['nie']."', merk_brg='".$_POST['merk']."', tipe_brg='".$_POST['tipe']."', negara_asal='".$_POST['negara_asal']."' , deskripsi_alat='".$_POST['deskripsi']."' where id=".$_GET['id']."");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Diubah !');
		window.location='index.php?page=barang_set'
		</script>";
		}
	}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Ubah Barang Set</h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="index.php?page=barang_masuk">Barang Set</a></li>
        <li class="active">Ubah Barang Set</li></ol></section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-4 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Ubah Data Barang</h3></div><div class="box-body"><br />
              <form method="post">
              
              <label>Nama Barang</label>
              <input name="nama_akse" class="form-control" placeholder="Nama Barang" type="text" value="<?php echo $data['nama_brg']; ?>"><br />
              <label>NIE </label>
              <input name="nie" class="form-control" placeholder="NIE Barang" type="text" value="<?php echo $data['nie_brg']; ?>"><br />
              
              <label>Merk</label>
              <input name="merk" class="form-control" type="text" placeholder="Merk" value="<?php echo $data['merk_brg']; ?>"><br />
              
              <label>Tipe</label>
              <input name="tipe" class="form-control" type="text" placeholder="Tipe" value="<?php echo $data['tipe_brg']; ?>"><br />
              
              <label>Negara Asal</label>
              <input name="negara_asal" class="form-control" type="text" placeholder="Kepemilikan" value="<?php echo $data['negara_asal']; ?>"><br />
              
              
              <label>Deskripsi Alat</label>
              <textarea name="deskripsi" class="form-control" type="text" rows="5" placeholder="Deskripsi Alat" required><?php echo $data['deskripsi_alat']; ?></textarea><br />
              <button name="simpan_perubahan" class="btn btn-success" type="submit"><span class="fa fa-edit"></span> Simpan Perubahan</button>
              <br /><br />
              </form>
              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        
        <section class="col-lg-8 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Rincian Barang Dalam 1 Set</h3></div><div class="box-body">
              <?php //if (isset($_SESSION['user_administrator']) or isset($_SESSION['user_admin_gudang'])) { ?>
              <button name="tambah_detail" class="btn btn-success" type="button" data-toggle="modal" data-target="#modal-pencarian"><span class="fa fa-plus"></span> Tambah Rincian Barang</button>
              <br /><br />
			  <?php //} ?>
              
<table  width="100%" id="example1" class="table table-bordered table-hover">
              <thead>
  <tr>
    <th width="">No</th>
    <th width=""><strong>Nama Barang</strong></th>
    <th width="">Harga Beli</th>
    <th width="">Harga Jual</th>
    <th width="">Qty</th>
    <th width=""><strong>Aksi</strong></th>
  </tr>
  </thead>
  <?php
  $q2 = mysqli_query($koneksi, "select *,barang_gudang_set_detail.id as idd from barang_gudang_set_detail, barang_gudang where barang_gudang.id=barang_gudang_set_detail.barang_gudang_id and barang_gudang_set_id=".$_GET['id']." order by nama_brg ASC");
  $no=0;
  while ($d = mysqli_fetch_array($q2)) {
  $no++;
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $d['nama_brg']; ?></td>
    <td><?php echo number_format($d['harga_beli'],0,'.',','); ?></td>
    <td><?php echo number_format($d['harga_satuan'],0,'.',','); ?></td>
    <td><?php echo $d['qty']; ?></td>
    
    <td>
    <?php //if (isset($_SESSION['user_administrator']) or isset($_SESSION['admin_gudang']) ) { ?>
    <a href="index.php?page=ubah_barang_set&id=<?php echo $_GET['id']; ?>&id_hapus=<?php echo $d['idd']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="fa fa-trash"></span></a>&nbsp;
    <?php //} ?>
    <!--<a href="index.php?page=ubah_barang_set&id=<?php echo $_GET['id']; ?>&id_ubah=<?php echo $d['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp;-->
    <!--&nbsp;
    <a href="index.php?page=ubah_barang_masuk&id=<?php //echo $data['idd']; ?>#openPilihan"><small data-toggle="tooltip" title="Jual Aksesoris" class="label bg-blue">Jual</small></a>-->
    </td>
  </tr>
  <?php } ?>
</table>
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
  $d_1=mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang_set_2 where id=".$_GET['detail3'].""));
  
  if (isset($_POST['ubah_detail'])) {
	  $u=mysqli_query($koneksi, "update barang_gudang_set_2 set nama_set='".$_POST['nama_brg']."', harga_beli='".$_POST['harga_beli']."', harga_jual='".$_POST['harga_jual']."', qty='".$_POST['qty']."' where id=".$_GET['detail3']."");
	  if ($u){
		  echo "<script type='text/javascript'>
		  window.location='index.php?page=ubah_barang_set3&id=$_GET[id]&detail=$_GET[detail]&detail2=$_GET[detail2]'
		</script>";
		  }
	  }
  ?>
  <div id="open_detail" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <br />
        <form method="post">
              <label>Nama Barang</label>
              <input name="nama_brg" class="form-control" type="text" placeholder="" value="<?php echo $d_1['nama_set']; ?>"><br />
              <label>Harga Beli</label>
              <input name="harga_beli" class="form-control" type="text" placeholder="" value="<?php echo $d_1['harga_beli']; ?>"><br />
              <label>Harga Jual</label>
              <input name="harga_jual" class="form-control" type="text" placeholder="" value="<?php echo $d_1['harga_jual']; ?>"><br />
              <label>Stok</label>
              <input name="qty" class="form-control" type="text" placeholder="" value="<?php echo $d_1['qty']; ?>"><br />
              <input id="buttonn" name="ubah_detail" type="submit" value="Ubah" />
        </form>
    </div>
</div>
<?php 
if (isset($_POST['tambah_detail'])) {
	$tmbh = mysqli_query($koneksi, "insert into barang_gudang_detail values('','".$_GET['id']."','".$_POST['no_bath_t']."','".$_POST['no_lot_t']."','".$_POST['no_seri_t']."','0')");
	if ($tmbh) {
		mysqli_query($koneksi, "update barang_gudang set stok=stok+1 where id=".$_GET['id']."");
		echo "<script type='text/javascript'>
		  window.location='index.php?page=ubah_barang_masuk&id=$_GET[id]'
		</script>";
		}
	}
?>
<div id="open_tambah_detail" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <br />
        <form method="post">
        	
              <label>No. Bath</label>
              <input name="no_bath_t" class="form-control" type="text" placeholder="" value=""><br />
              <label>No. Lot</label>
              <input name="no_lot_t" class="form-control" type="text" placeholder="" value=""><br />
              <label>No. Seri</label>
              <input name="no_seri_t" class="form-control" type="text" placeholder="" value=""><br />
              <input id="buttonn" name="tambah_detail" type="submit" value="Tambah" />
        </form>
    </div>
</div>
<div class="modal fade" id="modal-pencarian">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Rincian Barang</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <label>Nama Barang</label>
                <select class="form-control select2" name="nama_barang" required style="width:100%">
                <option value="">...</option>
                <?php
                $q_b = mysqli_query($koneksi, "select id,nama_brg,tipe_brg,merk_brg from barang_gudang order by nama_brg ASC");
				while ($d = mysqli_fetch_array($q_b)) {
				?>
                <option value="<?php echo $d['id'] ?>"><?php echo "<strong>".$d['nama_brg']."</strong> - ".$d['tipe_brg']."/".$d['merk_brg']; ?></option>
                <?php } ?>
                </select>
                <br /><br />
                <label>Qty</label>
                <input type="number" class="form-control" name="qty" placeholder="" required="required"/>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" name="pencarian">Simpan</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>