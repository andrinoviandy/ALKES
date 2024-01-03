<?php
$query = mysqli_query($koneksi, "select * from barang_gudang where id='".$_GET['id']."'");
$data = mysqli_fetch_array($query);

if (isset($_GET['id_hapus']) and isset($_GET['id_po'])) {
	$sel = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim_detail where barang_gudang_detail_id=".$_GET['id_hapus'].""));
	if ($sel==0) {
		$up=mysqli_query($koneksi, "update barang_gudang set stok_total=stok_total-1 where id=".$_GET['id']."");
		
		$lihat_stok=mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang_po where id=".$_GET['id_po'].""));
		if ($lihat_stok['stok']<2) {
		$upd=mysqli_query($koneksi, "delete from barang_gudang_po where id=".$_GET['id_po']."");
		} else {
		$upd = mysqli_query($koneksi, "update barang_gudang_po set stok=stok-1 where id=".$_GET['id_po']."");
		}
		if ($up or $upd) {
		$del = mysqli_query($koneksi, "delete from barang_gudang_detail where id=".$_GET['id_hapus']."");
		echo "<script type='text/javascript'>
		window.location='index.php?page=ubah_barang_masuk&id=$_GET[id]'
		</script>";
		}
		}
	else {
			echo "<script>alert('Data Tidak Dapat Dihapus !')</script>";
			}
	}

if (isset($_POST['simpan_perubahan'])) {
	if (isset($_SESSION['user_administrator']) or isset($_SESSION['user_admin_keuangan'])) { 
	$Result = mysqli_query($koneksi, "update barang_gudang set nama_brg='".$_POST['nama_barang']."', nie_brg='".$_POST['nie_brg']."', merk_brg='".$_POST['merk']."', tipe_brg='".$_POST['tipe']."', negara_asal='".$_POST['negara_asal']."', jenis_barang='".$_POST['jenis_barang']."' ,deskripsi_alat='".$_POST['deskripsi']."', harga_beli='".$_POST['harga_beli']."',harga_satuan='".$_POST['harga_satuan']."', satuan='".$_POST['satuan']."', status_cek='".$_POST['status_cek']."' where id=".$_GET['id']."");
	} else {
		$Result = mysqli_query($koneksi, "update barang_gudang set nama_brg='".$_POST['nama_barang']."', nie_brg='".$_POST['nie_brg']."', merk_brg='".$_POST['merk']."', tipe_brg='".$_POST['tipe']."', negara_asal='".$_POST['negara_asal']."', jenis_barang='".$_POST['jenis_barang']."' , deskripsi_alat='".$_POST['deskripsi']."',satuan='".$_POST['satuan']."', status_cek='".$_POST['status_cek']."' where id=".$_GET['id']."");
		}
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Diubah !');
		window.location='index.php?page=barang_masuk'
		</script>";
		}
	}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Alkes Masuk
     / Data Gudang</h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="index.php?page=barang_masuk">Alkes Masuk</a></li>
        <li class="active">Ubah Data Alkes</li></ol></section>


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
              <h3 class="box-title">Ubah Data Alkes</h3></div><div class="box-body"><br />
              <form method="post">
              
              <label>Nama Alkes</label>
              <input name="nama_barang" class="form-control" placeholder="Nama Barang" type="text" value="<?php echo $data['nama_brg']; ?>"><br />
              <label>NIE Alkes</label>
              <input name="nie_brg" class="form-control" placeholder="NIE Barang" type="text" value="<?php echo $data['nie_brg']; ?>"><br />
              
              <label>Merk</label>
              <input name="merk" class="form-control" type="text" placeholder="Merk" value="<?php echo $data['merk_brg']; ?>"><br />
              
              <label>Tipe</label>
              <input name="tipe" class="form-control" type="text" placeholder="Tipe" value="<?php echo $data['tipe_brg']; ?>"><br />
              
              <label>Negara Asal</label>
              <input name="negara_asal" class="form-control" type="text" placeholder="Kepemilikan" value="<?php echo $data['negara_asal']; ?>"><br />
              <label>Jenis Barang</label>
              <select name="jenis_barang" class="form-control select2" required style="width:100%">
             <option value="">-- Pilih Jenis Barang --</option>
             <option <?php if ($data['jenis_barang']==1) {echo "selected";} ?> value="1">E-Katalog</option>
             <option <?php if ($data['jenis_barang']==0) {echo "selected";} ?> value="0">Bukan E-Katalog</option>
             </select>
             <br />
             <br />             
              <label>Deskripsi Alat</label>
              <textarea name="deskripsi" class="form-control" type="text" rows="5" placeholder="Deskripsi Alat" required><?php echo $data['deskripsi_alat']; ?></textarea><br />
              <?php if (isset($_SESSION['user_administrator']) or isset($_SESSION['user_admin_keuangan'])) { ?>
              <label>Harga Beli</label>
              <input name="harga_beli" class="form-control" type="text" placeholder="Harga Beli" value="<?php echo $data['harga_beli']; ?>"><br />
              <label>Harga Jual</label>
              <input name="harga_satuan" class="form-control" type="text" placeholder="Harga Satuan" value="<?php echo $data['harga_satuan']; ?>" <?php if (!isset($_SESSION['user_administrator'])) {echo "readonly='readonly'";} ?>><br />
              <?php } ?>
              <label>Satuan</label>
              <input name="satuan" class="form-control" type="text" placeholder="Satuan" value="<?php echo $data['satuan']; ?>"><br />
              
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

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Ubah Data Alkes</h3></div><div class="box-body">
              <?php if(isset($_SESSION['pass_admin_gudang']) or isset($_SESSION['pass_administrator'])) { ?>
              <br />
              <a href="index.php?page=simpan_tambah_barang_masuk5&id=<?php echo $_GET['id']; ?>"><button name="tambah_detail" class="btn btn-success" type="submit"><span class="fa fa-edit"></span> Tambah Stok</button></a>&nbsp;&nbsp;
              <a href="index.php?page=ubah_barang_masuk_terjual&id=<?php echo $_GET['id']; ?>"><button name="tambah_detail" class="btn btn-warning" type="button"> Stok Terjual</button></a>
              <a href="index.php?page=ubah_barang_masuk_rusak&id=<?php echo $_GET['id']; ?>"><button name="tambah_detail" class="btn btn-warning" type="button"> Stok Rusak</button></a>
              <a href="index.php?page=ubah_barang_masuk_tidak_layak&id=<?php echo $_GET['id']; ?>"><button name="tambah_detail" class="btn btn-warning" type="button"> Stok Tidak Layak Jual</button></a>
              <?php } ?>
              <font class="pull pull-right">Stok Tersedia : <?php 
			  $stok = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_detail where status_kirim=0 and status_kerusakan=0 and status_kembali_ke_gudang=0 and barang_gudang_id=".$_GET['id'].""));
			  echo $stok; ?></font><br /><br />
              <table width="100%" id="example1" class="table table-bordered table-hover">
              <thead>
  <tr>
    <th><strong>Tgl Masuk</strong></th>
    <th>No PO</th>
    <?php $no_bath = mysqli_num_rows(mysqli_query($koneksi, "select * form barang_gudang_detail where barang_gudang_id=".$_GET['id']." and no_bath!=''"));
	if ($no_bath!=0) { 
	 ?>
    <th><strong>No. Bath</strong></th>
    <?php } ?>
    <th><strong>No. Lot</strong></th>
    <th><strong>No. Seri</strong></th>
    <th>Expired</th>
    <th>Status</th>
    <th><strong>Aksi</strong></th>
  </tr>
  </thead>
  <?php
 
// membuka file JSON
$file = file_get_contents("http://localhost/ALKES/json/ubah_barang_masuk.php?id=$_GET[id]");
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
?>
  <tr>
    <td><?php echo date("d-m-Y",strtotime($json[$i]['tgl_po_gudang'])); ?></td>
    <td><?php echo $json[$i]['no_po_gudang']; ?></td>
    <?php if ($no_bath!=0) { ?>
    <td><?php echo $json[$i]['no_bath']; ?></td>
    <?php } ?>
    <td><?php echo $json[$i]['no_lot']; ?></td>
    <td><?php echo $json[$i]['no_seri_brg']; ?></td>
    <td><?php 
	if ($json[$i]['tgl_expired']=='0000-00-00') {echo "-";} else {
	echo date("d-m-Y",strtotime($json[$i]['tgl_expired']));} ?></td>
    <td><?php if ($json[$i]['status_kerusakan']==1){echo "RUSAK";} else if ($json[$i]['status_kerusakan']==2) {echo "DIKEMBALIKAN";} else if ($json[$i]['status_demo']==1) {echo "Demo";} else {echo "-";} ?></td>
    <td>
    <?php if ($json[$i]['status_kirim']==0) { 
	?>
    <?php if (isset($_SESSION['user_admin_gudang'])) { ?>
    <a href="index.php?page=ubah_barang_masuk&id=<?php echo $_GET['id']; ?>&detail=<?php echo $json[$i]['idd']; ?>#open_password"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp;
    <?php } else { ?>
    <a href="index.php?page=ubah_barang_masuk&id=<?php echo $_GET['id']; ?>&detail=<?php echo $json[$i]['idd']; ?>#open_detail"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp;
    <?php } ?>
    <?php if (isset($_SESSION['user_administrator'])) { ?>
    <a href="index.php?page=ubah_barang_masuk&id=<?php echo $_GET['id']; ?>&id_hapus=<?php echo $json[$i]['idd']; ?>&id_po=<?php echo $json[$i]['id_po']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="fa fa-trash"></span></a>
    <?php }} else { ?>
    <?php if (isset($_SESSION['user_admin_gudang'])) { ?>
    <a href="index.php?page=ubah_barang_masuk&id=<?php echo $_GET['id']; ?>&detail=<?php echo $json[$i]['idd']; ?>#open_password"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a> Terjual
		<?php } else { ?>
        <a href="index.php?page=ubah_barang_masuk&id=<?php echo $_GET['id']; ?>&detail=<?php echo $json[$i]['idd']; ?>#open_detail"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a> Terjual
        <?php }} ?>
    <!--&nbsp;
    <a href="index.php?page=ubah_barang_masuk&id=<?php //echo $data['idd']; ?>#openPilihan"><small data-toggle="tooltip" title="Jual Alkes" class="label bg-blue">Jual</small></a>-->
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
  <div id="open_detail" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <br />
        <form method="post">
              <label>No. Bath</label>
              <input name="no_bath" class="form-control" type="text" placeholder="" value="<?php echo $d_1['no_bath']; ?>"><br />
              <label>No. Lot</label>
              <input name="no_lot" class="form-control" type="text" placeholder="" value="<?php echo $d_1['no_lot']; ?>"><br />
              <label>No. Seri</label>
              <input name="no_seri" class="form-control" type="text" placeholder="" value="<?php echo $d_1['no_seri_brg']; ?>"><br />
              
              <label>Expired</label>
              <input name="tgl_expired" class="form-control" type="date" placeholder="" value="<?php echo $d_1['tgl_expired']; ?>"><br />
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