<?php
$query = mysqli_query($koneksi, "select * from barang_inventory where id='".$_GET['id']."'");
$data = mysqli_fetch_array($query);

if (isset($_POST['simpan_perubahan'])) {
	$Result = mysqli_query($koneksi, "update barang_inventory set nama_brg='".$_POST['nama_barang']."', nie_brg='".$_POST['nie_brg']."', merk_brg='".$_POST['merk']."', tipe_brg='".$_POST['tipe']."', negara_asal='".$_POST['negara_asal']."', stok_total='".$_POST['stok']."' , deskripsi_alat='".$_POST['deskripsi']."', harga_beli='".$_POST['harga_beli']."',harga_satuan='".$_POST['harga_satuan']."', status_cek='".$_POST['status_cek']."' where id=".$_GET['id']."");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Diubah !');
		window.location='index.php?page=barang_inventory'
		</script>";
		}
	}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Barang Inventory</h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="index.php?page=barang_masuk">Barang Inventory</a></li>
        <li class="active">Ubah Data Barang</li></ol></section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Ubah Data Barang</h3></div><div class="box-body"><br />
              <form method="post">
              
              <label>Nama Barang</label>
              <input name="nama_barang" class="form-control" placeholder="Nama Barang" type="text" value="<?php echo $data['nama_brg']; ?>"><br />
              <label>NIE Barang</label>
              <input name="nie_brg" class="form-control" placeholder="NIE Barang" type="text" value="<?php echo $data['nie_brg']; ?>"><br />
              
              <label>Merk</label>
              <input name="merk" class="form-control" type="text" placeholder="Merk" value="<?php echo $data['merk_brg']; ?>"><br />
              
              <label>Tipe</label>
              <input name="tipe" class="form-control" type="text" placeholder="Tipe" value="<?php echo $data['tipe_brg']; ?>"><br />
              
              <label>Negara Asal</label>
              <input name="negara_asal" class="form-control" type="text" placeholder="Kepemilikan" value="<?php echo $data['negara_asal']; ?>"><br />
              
              
              <label>Deskripsi Alat</label>
              <textarea name="deskripsi" class="form-control" type="text" rows="5" placeholder="Deskripsi Alat" required><?php echo $data['deskripsi_alat']; ?></textarea><br />
              <?php if (isset($_SESSION['user_administrator']) or isset($_SESSION['user_admin_keuangan'])) { ?>
              <label>Harga Beli</label>
              <input name="harga_beli" class="form-control" type="text" placeholder="Harga Beli" value="<?php echo $data['harga_beli']; ?>"><br />
              <label>Harga Jual</label>
              <input name="harga_satuan" class="form-control" type="text" placeholder="Harga Satuan" value="<?php echo $data['harga_satuan']; ?>"><br />
              <label>Stok</label>
              <input name="stok" class="form-control" type="text" placeholder="Stok" value="<?php echo $data['stok_total']; ?>" disabled="disabled"><br />
              <?php } ?>
              
              <label>Status Pengecekan</label>
              <select name="status_cek" class="form-control">
              <?php if ($data['status_cek']==0) { ?>
              <option value="0">Belum Di Cek</option>
              <option value="1">Sudah Di Cek</option>
              <?php } else { ?>
              <option value="1">Sudah Di Cek</option>
              <option value="0">Belum Di Cek</option>
			  <?php } ?>
              </select>
              <br />
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
 
          <!-- Chat box --><!-- /.box (chat box) -->

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
  $d_1=mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang_detail,barang_gudang_po where barang_gudang_po.id=barang_gudang_detail.barang_gudang_po_id and barang_gudang_detail.id=".$_GET['detail'].""));
  
  if (isset($_POST['ubah_detail'])) {
	  $u=mysqli_query($koneksi, "update barang_gudang_detail set no_bath='".$_POST['no_bath']."', no_lot='".$_POST['no_lot']."', no_seri_brg='".$_POST['no_seri']."', tgl_expired='".$_POST['tgl_expired']."' where id=".$_GET['detail']."");
	  if ($u){
		  echo "<script type='text/javascript'>
		  window.location='index.php?page=ubah_barang_masuk&id=$_GET[id]'
		</script>";
		  }
	  }
  ?>
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
<?php 
if (isset($_POST['manajer_password'])) {
	$cek = mysqli_num_rows(mysqli_query($koneksi, "select * from akun_manajer_gudang where password='".md5($_POST['password_manajer'])."'"));
	if ($cek==0) {
		echo "<script>alert('Password Salah !')</script>";
		}
	else {
		echo "<script>window.location='index.php?page=ubah_barang_masuk&id=$_GET[id]&detail=$_GET[detail]#open_detail'</script>";
		}
	}
?>
<div id="open_password" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <br />
        <form method="post">
        	<label>Masukan Password</label>
              <input name="password_manajer" class="form-control" type="text" placeholder="" value=""><br />
              <input id="buttonn" name="manajer_password" type="submit" value="Next" />
        </form>
    </div>
</div>