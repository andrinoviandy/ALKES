<?php
$query = mysqli_query($koneksi, "select * from barang_gudang_set where id='".$_GET['id']."'");
$data = mysqli_fetch_array($query);

if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from barang_gudang_po_set,barang_gudang_set_1,barang_gudang_set_2 where barang_gudang_po_set.id=barang_gudang_set_1.barang_gudang_po_set_id and barang_gudang_set_1.id=barang_gudang_set_2.barang_gudang_set1_id and barang_gudang_po_set.id=".$_GET['id_hapus']."");
	if ($del) {
		if ($del) {
		echo "<script type='text/javascript'>
		window.location='index.php?page=ubah_barang_set&id=$_GET[id]'
		</script>";
		}
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
              <h3 class="box-title">Ubah Data Barang</h3></div><div class="box-body">
              <?php if (isset($_SESSION['user_administrator']) or isset($_SESSION['user_admin_gudang'])) { ?>
              <a href="index.php?page=ubah_barang_set&id=<?php echo $_GET['id']; ?>#openPilihan"><button name="tambah_detail" class="btn btn-success" type="submit"><span class="fa fa-edit"></span> Tambah Stok</button></a>
              <?php } ?>
              <font class="pull pull-right"></font><br /><br />
              <table  width="100%" id="example1" class="table table-bordered table-hover">
              <thead>
  <tr>
    <th><strong>Tgl Masuk</strong></th>
    <th>No PO</th>

    <th><strong>Jumlah Set</strong></th>
    <th><strong>Aksi</strong></th>
  </tr>
  </thead>
  <?php
  $q = mysqli_query($koneksi, "select * from barang_gudang_po_set where barang_gudang_set_id=".$_GET['id']."");
  $no=0;
  while ($d = mysqli_fetch_array($q)) {
  $no++;
  ?>
  <tr>
    <td><?php echo date("d F Y",strtotime($d['tgl_po_set'])); ?></td>
    <td><?php echo $d['no_po_set']; ?></td>
    <td><?php echo $d['jumlah_set']; ?></td>
    <td>
    <a href="index.php?page=ubah_barang_set2&id=<?php echo $_GET['id']; ?>&detail=<?php echo $d['id']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp;
    <?php if (isset($_SESSION['user_administrator'])) { ?>
    <a href="index.php?page=ubah_barang_set&id=<?php echo $_GET['id']; ?>&id_hapus=<?php echo $d['id']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="fa fa-trash"></span></a>
    <?php } ?>
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
  $d_1=mysqli_fetch_array(mysqli_query($koneksi, "select * from aksesoris_detail,aksesoris_po where aksesoris_po.id=aksesoris_detail.aksesoris_po_id and aksesoris_detail.id=".$_GET['detail'].""));
  
  if (isset($_POST['ubah_detail'])) {
	  $u=mysqli_query($koneksi, "update aksesoris_detail set no_bath_akse='".$_POST['no_bath']."', no_lot_akse='".$_POST['no_lot']."', no_seri_akse='".$_POST['no_seri']."' where id=".$_GET['detail']."");
	  if ($u){
		  echo "<script type='text/javascript'>
		  window.location='index.php?page=ubah_akse2&id=$_GET[id]'
		</script>";
		  }
	  }
  ?>
  <div id="open_detail" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <br />
        <form method="post">
              <label>No. Bath</label>
              <input name="no_bath" class="form-control" type="text" placeholder="" value="<?php echo $d_1['no_bath_akse']; ?>"><br />
              <label>No. Lot</label>
              <input name="no_lot" class="form-control" type="text" placeholder="" value="<?php echo $d_1['no_lot_akse']; ?>"><br />
              <label>No. Seri</label>
              <input name="no_seri" class="form-control" type="text" placeholder="" value="<?php echo $d_1['no_seri_akse']; ?>"><br />
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
<div id="openPilihan" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <br />
        <a href="index.php?page=simpan_tambah_barang_set3&id=<?php echo $_GET['id']; ?>"><button id="buttonn">Data Set Baru</button></a>
        <a href="index.php?page=simpan_tambah_barang_set33&id=<?php echo $_GET['id']; ?>"><button id="buttonn">Sama Dengan Data Set Yang Lama</button></a>
    </div>
</div>