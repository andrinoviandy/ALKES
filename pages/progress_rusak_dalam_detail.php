<?php
if (isset($_POST['kirim_barang'])) {
$q3 = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang_detail where id=".$_POST['id_gudang_detail'].""));
if (isset($_POST['kirim_barang']) && $q3['status_kerusakan']==0) { 
$up3 = mysqli_query($koneksi, "update barang_gudang_detail,barang_gudang set status_kerusakan=".$_POST['status'].",stok_total=stok_total-1 where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=".$_POST['id_gudang_detail']."");
}
if (isset($_POST['kirim_barang']) && $q3['status_kerusakan']==1) {
	if ($_POST['status']==0) { 
$up3 = mysqli_query($koneksi, "update barang_gudang_detail,barang_gudang set status_kerusakan=".$_POST['status'].",stok_total=stok_total+1 where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=".$_POST['id_gudang_detail']."");
	} else {
		$up3 = mysqli_query($koneksi, "update barang_gudang_detail,barang_gudang set status_kerusakan=".$_POST['status']." where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=".$_POST['id_gudang_detail']."");
		}
}
if (isset($_POST['kirim_barang']) && $q3['status_kerusakan']==2) {
	if ($_POST['status']==0) { 
$up3 = mysqli_query($koneksi, "update barang_gudang_detail,barang_gudang set status_kerusakan=".$_POST['status'].",stok_total=stok_total+1 where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=".$_POST['id_gudang_detail']."");
	} else {
		$up3 = mysqli_query($koneksi, "update barang_gudang_detail,barang_gudang set status_kerusakan=".$_POST['status']." where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=".$_POST['id_gudang_detail']."");
		}
}
if ($up3) {
	echo "<script>
	window.location='index.php?page=progress_rusak_dalam_detail&id_gudang=$_GET[id_gudang]';
	</script>";
	}
}
 
  if (isset($_GET['id_hapus'])) {
	$h = mysqli_query($koneksi, "delete from barang_gudang_detail_rusak where id=$_GET[id_hapus]");
	}
  
  if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "insert into alat_uji_detail values('','".$_POST['id_akse']."','".$_POST['soft_version']."','".$_POST['tgl_garansi_habis']."','".$_POST['tgl_i']."','".$_POST['lampiran_i']."','".$_POST['tgl_f']."','".$_POST['lampiran_f']."','".$_POST['keterangan']."')");
	if ($Result) {
		mysqli_query($koneksi, "update barang_teknisi_detail set status_uji=1 where id=".$_POST['id_akse']."");
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Simpan !');
		window.location='index.php?page=simpan_tambah_uji&id=$_GET[id]';
		</script>";
		}
	}
		?>
<?php 

if (isset($_GET['simpan_barang'])==1) {
	
	//$insert_pembeli=mysqli_query($koneksi, "insert into pembeli values('','".$_SESSION['pembeli']."','".$_SESSION['provinsi']."','".$_SESSION['kabupaten']."','".$_SESSION['kecamatan']."','".$_SESSION['kelurahan']."','".$_SESSION['alamat']."','".$_SESSION['kontak_rs']."')");
	
	$insert_pemakai=mysqli_query($koneksi, "insert into pemakai values('','".$_SESSION['pemakai']."','".$_SESSION['kontak1']."','".$_SESSION['kontak2']."','".$_SESSION['email']."')");
	
	//$pembeli=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_pembeli from pembeli"));
	$id_pembeli=$_SESSION['pembeli'];
	$pemakai=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_pemakai from pemakai"));
	$id_pemakai=$pemakai['id_pemakai'];
	//simpan barang dijual
	$total = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_hash"));
	$simpan1=mysqli_query($koneksi, "insert into barang_dijual values('','".$_SESSION['tgl_jual']."','$total','$id_pembeli','$id_pemakai')");
	
	$d1=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_jual from barang_dijual"));
	$id_jual=$d1['id_jual'];
	//simpan barang pesan detail
	$q2=mysqli_query($koneksi, "select * from barang_dijual_hash");
	$jml_baris = mysqli_num_rows($q2);
	for ($i=1; $i<=$jml_baris; $i++) {
		$d2 = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dijual_hash where no=$i"));
		$simpan2=mysqli_query($koneksi, "insert into barang_dijual_detail values('','$id_jual','".$d2['barang_gudang_detail_id']."','0')");
		$up=mysqli_query($koneksi, "update barang_gudang_detail set status_terjual=1 where id=".$d2['barang_gudang_detail_id']."");
		$up2=mysqli_query($koneksi, "update barang_gudang,barang_gudang_detail set stok_total=stok_total-1 where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=".$d2['barang_gudang_detail_id']."");
		}
		if ($simpan1 and $simpan2) {
			mysqli_query($koneksi, "delete from barang_dijual_hash");
	echo "<script type='text/javascript'>
	alert('Data Berhasil Di Simpan !');
	window.location='index.php?page=jual_barang'</script>";
		}
	}


if (isset($_POST['simpan_tambah_aksesoris'])) {
	$no=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_hash"))+1;
	$simpan = mysqli_query($koneksi, "insert into barang_dijual_hash values('','$no','".$_POST['no_seri']."')");
	if ($simpan) {
		echo "<script>window.location='index.php?page=simpan_jual_alkes2'</script>";
		}
	}
	

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Detail Barang Rusak</h1><ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Detail Barang Rusak</li>
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
              <div class="box-body">
              <div class="">
              <!--<a href="index.php?page=tambah_barang_masuk"><button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah Barang</button></a>-->
              <div class="table-responsive">
              <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">Nama Alkes</th>
      <th valign="bottom">Tipe</th>
      <th valign="bottom"><strong>Merk</strong></th>
      <th valign="bottom">Negara Asal</th>
      <th valign="bottom">Deskripsi alat</th>
      </tr>
  </thead>
  <tr>
    <td><?php 
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang where id=$_GET[id_gudang]"));
	echo $sel['nama_brg']; ?></td>
    <td><?php echo $sel['tipe_brg']; ?></td>
    <td><?php echo $sel['merk_brg']; ?></td>
    <td><?php echo $sel['negara_asal']; ?></td>
    <td><?php echo $sel['deksripsi_alat']; ?></td>
    </tr>
</table>
              </div>
                <br />
                <h3 align="center">
                  Detail Alkes
                </h3>
                <div class="table-responsive">
                <table width="100%" id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th valign="bottom">Tgl Input</th>
                      <th valign="bottom"><strong>Tgl Masuk Gudang</strong></th>
                      <th valign="bottom">No Seri</th>
                      <th valign="bottom">Kerusakan</th>
                      <th valign="bottom">Teknisi</th>
                      <th valign="bottom">Status Progress</th>
                      <th valign="bottom">Status Barang</th>
                      <th valign="bottom">Aksi</th>
                    </tr>
                  </thead>
                 <?php
 
// membuka file JSON
if (isset($_SESSION['id_b'])) {
$file = file_get_contents("http://localhost/ALKES/json/barang_rusak.php?id_gudang=$_GET[id_gudang]&id_b=$_SESSION[id_b]");	
	}
else {
$file = file_get_contents("http://localhost/ALKES/json/barang_rusak.php?id_gudang=$_GET[id_gudang]");
}
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
?>
                  <tr>
                    <td><?php echo date("d/m/Y",strtotime($json[$i]['tgl_input'])); ?></td>
                    <td><?php echo date("d/m/Y",strtotime($json[$i]['tgl_po_gudang'])); ?></td>
                    <td><?php echo $json[$i]['no_seri_brg']." ".$json[$i]['nama_set']; ?></td>
                    <td><?php echo $json[$i]['kerusakan_alat']; ?></td>
                    <td><?php $tek=mysqli_fetch_array(mysqli_query($koneksi, "select * from tb_teknisi where id=".$json[$i]['teknisi_id'].""));
					echo $tek['nama_teknisi']; ?></td>
                    <td><?php if ($json[$i]['status_progress']==1) {echo "SELESAI"; } else if($json[$i]['status_progress']==0) {echo "BELUM SELESAI";} ?></td>
                    <td><?php if ($json[$i]['status_kerusakan']==1) {echo "RUSAK"; } else if($json[$i]['status_kerusakan']==2) {echo "Tidak Layak Jual & Kembali Ke Pabrik";} else {echo "Layak Dijual & Kembali Ke Gudang";} ?></td>
                    <td><a href="index.php?page=tambah_progress_rusak_dalam&id_gudang_detail=<?php echo $json[$i]['id_gudang_detail']; ?>&id_ubah=<?php echo $json[$i]['idd']; ?>&id_gudang=<?php echo $_GET['id_gudang']; ?>"><small data-toggle="tooltip" title="Progress" class="label bg-green"><span class="fa fa-cogs"></span>&nbsp; Progress</small></a><br /><?php if ($json[$i]['status_progress']==1) { ?><a href="#" data-toggle="modal" data-target="#modal-status<?php echo $json[$i]['idd'] ?>"><small data-toggle="tooltip" title="Ubah Status Barang" class="label bg-yellow"><span class="fa fa-edit"></span>&nbsp; Ubah Status Barang</small></a><?php } ?><!--&nbsp;&nbsp;<a target="_blank" href="cetak_laporan_instalasi.php?id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Download Report" class="glyphicon glyphicon-print"></span></a><br />-->
                     <?php /*if ($json[$i]['status_dikembalikan']==1) { ?>
                      <a href="index.php?page=tambah_pelatihan&id=<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Kembalikan Ke Stok Gudang" class="label bg-blue"><span class="fa fa-share"></span> Stok</small></a> <?php }*/ ?>
                      
                    </td>
                  </tr>
                  <div class="modal fade" id="modal-status<?php echo $json[$i]['idd'] ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Ubah Status Barang</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
              <input type="hidden" name="id_ubah" value="<?php echo $json[$i]['idd'] ?>" />
              <input type="hidden" name="id_gudang_detail" value="<?php echo $json[$i]['id_gudang_detail'] ?>" />
              <select id="input" name="status" class="form-control select2" style="width:100%">
              <?php
              $q3 = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang_detail where id=".$json[$i]['id_gudang_detail'].""));
			  ?>
     <?php if ($q3['status_kerusakan']==0) { ?>
        <option value="1">Barang Rusak & Masih Diperbaiki Teknisi</option>
     	<option value="2">Barang Tidak Layak Dijual & Akan Dikembalikan Ke Pabrik</option>
        <?php } ?>
      <?php if ($q3['status_kerusakan']==1) { ?>
     	<option value="0">Barang Layak Dijual & Kembalikan ke Stok Gudang</option>
     	<option value="2">Barang Tidak Layak Dijual & Akan Dikembalikan Ke Pabrik</option>
        <?php } ?>
      <?php if ($q3['status_kerusakan']==2) { ?>
     	<option value="0">Barang Layak Dijual & Kembalikan ke Stok Gudang</option>
        <option value="1">Barang Rusak & Akan Diperbaiki Teknisi</option>
        <?php } ?>
     </select>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button name="kirim_barang" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan</button>
              </div>
              </form>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
</div>
                  <?php } ?>
                </table>
                </div>
                <br />
                
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
