<?php
$query = mysqli_query($koneksi, "select * from barang_gudang where id='".$_GET['id']."'");
$data = mysqli_fetch_array($query);

if (isset($_POST['pencarian'])) {
		if ($_POST['pilihan']=='tgl_po_pesan') {
		echo "<script>window.location='index.php?page=$_GET[page]&tgl_awal=$_POST[tgl_awal]&tgl_akhir=$_POST[tgl_akhir]&tampil=$_POST[tampil]'</script>";
		} else {
		echo "<script>window.location='index.php?page=$_GET[page]&pilihan=$_POST[pilihan]&kunci=$_POST[kata_kunci]&id=$_GET[id]'</script>";
		}
	}

if (isset($_GET['id_hapus']) and isset($_GET['id_po'])) {
	$del = mysqli_query($koneksi, "delete from barang_gudang_detail where id=".$_GET['id_hapus']."");
	if ($del) {
		$up=mysqli_query($koneksi, "update barang_gudang set stok_total=stok_total-1 where id=".$_GET['id']."");
		
		$lihat_stok=mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang_po where id=".$_GET['id_po'].""));
		if ($lihat_stok['stok']<2) {
		$upd=mysqli_query($koneksi, "delete from barang_gudang_po where id=".$_GET['id_po']."");
		} else {
		$upd = mysqli_query($koneksi, "update barang_gudang_po set stok=stok-1 where id=".$_GET['id_po']."");
		}
		if ($up and $upd) {
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
	$Result = mysqli_query($koneksi, "update barang_gudang set nama_brg='".$_POST['nama_barang']."', nie_brg='".$_POST['nie_brg']."', merk_brg='".$_POST['merk']."', tipe_brg='".$_POST['tipe']."', negara_asal='".$_POST['negara_asal']."', jenis_barang='".$_POST['jenis_barang']."' ,deskripsi_alat='".$_POST['deskripsi']."', harga_beli='".str_replace(".","",$_POST['harga_beli'])."',harga_satuan='".str_replace(".","",$_POST['harga_satuan'])."', satuan='".$_POST['satuan']."', status_cek='".$_POST['status_cek']."' where id=".$_GET['id']."");
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

if (isset($_POST['ubah_detail'])) {
	$cek = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_detail where no_seri_brg='".$_POST['no_seri']."' and id!=".$_POST['id_item'].""));
	if ($cek==0 or $_POST['no_seri']=='') {
	  $u=mysqli_query($koneksi, "update barang_gudang_detail set no_bath='".$_POST['no_bath']."', no_lot='".$_POST['no_lot']."', no_seri_brg='".$_POST['no_seri']."', tgl_expired='".$_POST['tgl_expired']."' where id=".$_POST['id_item']."");
	  if ($u){
		  echo "<script type='text/javascript'>
		  history.back();
		</script>";
		  }
	} else {
	echo "<script type='text/javascript'>
		  alert('No Seri Sudah Ada !');
		  history.back();
		</script>";	
	}
}

if (isset($_POST['simpan_qrcode'])) {
	$simpan = mysqli_query($koneksi, "update barang_gudang_detail set qrcode='".$_POST['kode_qrcode']."' where id=".$_POST['idd']."");
	if ($simpan) {
	echo "<script>history.back()</script>";
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
              
              
              <label>Deskripsi Alat</label>
              <textarea name="deskripsi" class="form-control" type="text" rows="5" placeholder="Deskripsi Alat" required><?php echo $data['deskripsi_alat']; ?></textarea><br />
              <?php if (isset($_SESSION['user_administrator']) or isset($_SESSION['user_admin_keuangan'])) { ?>
              <label>Harga Beli</label>
              <input name="harga_beli" class="form-control" type="text" placeholder="Harga Beli" value="<?php echo $data['harga_beli']; ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"><br />
              <label>Harga Jual</label>
              <input name="harga_satuan" class="form-control" type="text" placeholder="Harga Satuan" value="<?php echo $data['harga_satuan']; ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"><br />
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

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Ubah Data Alkes</h3>
              
              </div><div class="box-body">
              <?php if(isset($_SESSION['pass_admin_gudang']) or isset($_SESSION['pass_administrator'])) { ?>
              <br />
              <a href="index.php?page=simpan_tambah_barang_masuk5&id=<?php echo $_GET['id']; ?>"><button name="tambah_detail" class="btn btn-success" type="submit"><span class="fa fa-edit"></span> Tambah Stok</button></a>&nbsp;&nbsp;
              <?php }
			  if(isset($_SESSION['pass_admin_gudang']) or isset($_SESSION['pass_administrator']) or isset($_SESSION['adminpjt'])) {
			  ?>
              <a href="index.php?page=ubah_barang_masuk&id=<?php echo $_GET['id']; ?>"><button name="tambah_detail" class="btn btn-warning" type="button"> Stok Belum Terjual</button></a>
              <a href="index.php?page=ubah_barang_masuk_terjual&id=<?php echo $_GET['id']; ?>"><button name="tambah_detail" class="btn btn-warning" type="button"> Stok Terjual</button></a>
              <a href="index.php?page=ubah_barang_masuk_rusak&id=<?php echo $_GET['id']; ?>"><button name="tambah_detail" class="btn btn-warning" type="button"> Stok Rusak</button></a>
              
              <?php } ?>
              <font class="pull pull-right">Stok Tidak Layak : <?php 
			  $stok_terjual=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_detail where status_kerusakan=2 and barang_gudang_id=".$_GET['id'].""));
			  echo $stok_terjual ?>&nbsp;
              </font><br />
              <div class="pull pull-right">
             <!--<a href="#" data-toggle="modal" data-target="#barcode<?php echo $json[$i]['idd']; ?>"><button data-toggle="tooltip" title="Generate Barcode" class="btn btn-danger"><span class="fa fa-barcode"></span>&nbsp; Generate Barcode</button></a>-->
             
              <button class="btn btn-success" data-toggle="modal" data-target="#modal-pencarian"><span class="fa fa-search"></span> Pencarian</button>&nbsp;&nbsp;
              <?php if (isset($_GET['kunci']) or isset($_GET['tgl1'])) { ?>
              <a onclick="history.back();"><button class="btn btn-info"><span class="fa fa-refresh"></span> Reset</button></a>&nbsp;&nbsp;
              <?php } ?>
              <a data-toggle="tooltip" data-title="Jumlah Data Yang Ditampilkan Per Halaman"><button data-toggle="modal" data-target="#modal-atur" name="limit" class="btn btn-default" type="button"><span class="fa fa-cog"></span></button></a>
              </div>
              <br /><br />
              <div class="table-responsive">
              <table width="100%" id="" class="table table-bordered table-hover">
              <thead>
  <tr>
    <th>No</th>
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
if (isset($_GET['pilihan']) and isset($_GET['kunci'])) {
	$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]&pilihan=$_GET[pilihan]&kunci=".str_replace(" ","%20",$_GET['kunci'])."&id=$_GET[id]");
}
else {
$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]&id=$_GET[id]");
}
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
?>
  <tr>
    <td align="center"><?php
	$akh =0; 
	if (isset($_GET['paging'])) {
		if ($_GET['paging']==1) {
			echo $i+1;
			$akh = $i+1;
			}
		else {
			$sel = mysqli_fetch_array(mysqli_query($koneksi, "select jumlah_limit from limiter"));
			echo (($_GET['paging']-1)*$sel['jumlah_limit'])+$i+1;
			$akh = (($_GET['paging']-1)*$sel['jumlah_limit'])+$i+1;
			}
	} else {
		echo $i+1;
		$akh = $i+1;
		}
	?></td>
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
    <td><?php if ($json[$i]['status_kerusakan']==1){echo "RUSAK";} else if ($json[$i]['status_kerusakan']==2) {echo "DIKEMBALIKAN";} else {echo "-";} ?></td>
    <td>
    <?php if ($json[$i]['status_kirim']==0) { 
	?>
    <?php if (isset($_SESSION['user_admin_gudang'])) { ?>
    <a href="#" data-toggle="modal" data-target="#modal-ubahitem<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp;
    <?php } else { ?>
    <a href="#" data-toggle="modal" data-target="#modal-ubahitem<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp;
    <?php } ?>
    <?php if (isset($_SESSION['user_administrator'])) { ?>
    <a href="index.php?page=ubah_barang_masuk&id=<?php echo $_GET['id']; ?>&id_hapus=<?php echo $json[$i]['idd']; ?>&id_po=<?php echo $json[$i]['id_po']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="fa fa-trash"></span></a>
    <?php }} else { ?>
    <?php if (isset($_SESSION['user_admin_gudang'])) { ?>
    <a href="#" data-toggle="modal" data-target="#modal-ubahitem<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a> Terjual
		<?php } else { ?>
        <a href="#" data-toggle="modal" data-target="#modal-ubahitem<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a> Terjual
        <?php }} ?>
        <br />
      <a href="#" data-toggle="modal" data-target="#buatbarcode<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Buat QRCode" class="label bg-blue"><span class="fa fa-barcode"></span>&nbsp; Buat QRCode</small></a>
	  <?php if ($json[$i]['qrcode']!="") { ?>
      <a href="#" data-toggle="modal" data-target="#barcode<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Cetak QRCode" class="label bg-red"><span class="fa fa-barcode"></span>&nbsp; Cetak QRCode</small></a>
      <?php } ?>
      
    <!--&nbsp;
    <a href="index.php?page=ubah_barang_masuk&id=<?php //echo $data['idd']; ?>#openPilihan"><small data-toggle="tooltip" title="Jual Alkes" class="label bg-blue">Jual</small></a>-->
    </td>
  </tr>
  <div class="modal fade" id="barcode<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Jumlah QRCode Yang Ingin Di Cetak
                </h4>
              </div>
              <form method="post" action="cetak_barcode_jenis.php" target="_blank">
              <div class="modal-body">
              <p align="justify">
              <!--<input type="hidden" name="kode_barcode" value="<?php echo "(".$json[$i]['nama_brg'].")(".$json[$i]['tipe_brg'].")(".$json[$i]['merk_brg'].")(".$json[$i]['no_po_gudang'].")(".date_format("d/m/Y",strtotime($json[$i]['tgl_po_gudang'])).")(".$json[$i]['no_seri_brg'].")(".($i+1)." of ".$jml.")"; ?>"/>-->
              <input type="hidden" name="kode_barcode" value="<?php echo $json[$i]['qrcode']; ?>"/>
              <input type="hidden" name="nie_brg" value="<?php echo str_replace(" ","",$json[$i]['nie_brg']); ?>"/>
              <input type="hidden" name="no_seri" value="<?php echo $json[$i]['no_seri_brg']; ?>"/>
              <input type="number" name="jml" class="form-control" placeholder="Jumlah QRCode Yang Ingin Di Cetak"/>
              </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger" name="print_barcode"><i class="fa fa-print"></i> Print</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        
        <div class="modal fade" id="buatbarcode<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Buat QRCode
                </h4>
              </div>
              <form method="post" action="">
              <div class="modal-body">
              <p align="justify">
              <input type="hidden" name="idd" value="<?php echo $json[$i]['idd'] ?>"/>
              <input type="text" name="kode_qrcode" class="form-control" value="<?php echo $json[$i]['qrcode']; ?>" placeholder="Kode QRCode"/>
              </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info" name="simpan_qrcode"><i class="fa fa-save"></i> Simpan</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
  <div class="modal fade" id="modal-ubahitem<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubah Data Barang</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <label>No. Bath</label>
              <input type="hidden" name="id_item" value="<?php echo $json[$i]['idd'] ?>"/>
              <input name="no_bath" class="form-control" type="text" placeholder="" value="<?php echo $json[$i]['no_bath']; ?>"><br />
              <label>No. Lot</label>
              <input name="no_lot" class="form-control" type="text" placeholder="" value="<?php echo $json[$i]['no_lot']; ?>"><br />
              <label>No. Seri</label>
              <input name="no_seri" class="form-control" type="text" placeholder="" value="<?php echo $json[$i]['no_seri_brg']; ?>"><br />
              
              <label>Expired</label>
              <input name="tgl_expired" class="form-control" type="date" placeholder="" value="<?php echo $json[$i]['tgl_expired']; ?>"><br />
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button name="ubah_detail" type="submit" class="btn btn-success">Simpan</button>
                
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
  <?php } ?>
</table>
<?php if ($jml!=0) { ?>
  <section class="col-lg-12">      
<center>
	<ul class="pagination btn-success">
    <?php
	include "paging_awal.php";
	?>
    <?php
	$query12 = mysqli_query($koneksi, "SELECT jumlah_limit FROM limiter");
    list($surat_masuk) = mysqli_fetch_array($query12);
	//pagging
    $limit = $surat_masuk;
	if (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
$queryy = mysqli_query($koneksi, "select *,barang_gudang_detail.id as idd,barang_gudang_po.id as id_po from barang_gudang_detail,barang_gudang_po,barang_gudang where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_po.id=barang_gudang_detail.barang_gudang_po_id and status_kerusakan=2 and barang_gudang_detail.barang_gudang_id=".$_GET['id']." and $_GET[pilihan] like '%$_GET[kunci]%' order by no_po_gudang DESC");
	}
	else {
	$queryy = mysqli_query($koneksi, "select *,barang_gudang_detail.id as idd,barang_gudang_po.id as id_po from barang_gudang_detail,barang_gudang_po,barang_gudang where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_po.id=barang_gudang_detail.barang_gudang_po_id and status_kerusakan=2 and barang_gudang_detail.barang_gudang_id=".$_GET['id']." order by no_po_gudang DESC");
	}
	$cdata = mysqli_num_rows($queryy);
    $j = ceil($cdata/$limit);
	if ($j > 10) {
		include "paging_lebih_dari_10.php";
	} 
	//< 10 Halaman
	else {
		include "paging_kurang_dari_10.php";
	}
	?>
    <?php
	include "paging_akhir.php";
	?>
    </ul>
</center>
<?php
include "paging_informasi.php";
?>

  </section>
  <?php } ?>
    <!-- /.content -->
  <?php include "atur_halaman.php"; ?>
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

<div class="modal fade" id="modal-pencarian">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pencarian</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <select class="form-control select2" name="pilihan" required style="width:100%">
                <option value="">...</option>
                <option value="no_po_gudang">Berdasarkan Nomor PO</option>
                <option value="no_bath">Berdasarkan Nomor Bath</option>
                <option value="no_lot">Berdasarkan Nomor Lot</option>
                <option value="no_seri_brg">Berdasarkan No Seri</option>
                </select>
                <br /><br />
                <input type="text" class="form-control" name="kata_kunci" placeholder="Kata Kunci"/>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" name="pencarian">Cari</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>