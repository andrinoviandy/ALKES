<?php 
  if (isset($_GET['id_hapus'])) {
	$up = mysqli_query($koneksi, "update barang_gudang_detail set status_demo=1 where id=".$_GET['id_detail']."");
	$up2 = mysqli_query($koneksi, "update barang_demo_kirim_detail set status_kembali=0 where barang_gudang_detail_id=".$_GET['id_detail']."");
	$h = mysqli_query($koneksi, "delete from barang_demo_kembali where id=$_GET[id_hapus]");
	if ($up and $up2 and $h) {
		echo "<script type='text/javascript'>
		alert('Data berhasil di hapus');
		window.location='index.php?page=kembali_barang_demo_detail&id_gudang=$_GET[id_gudang]';
		</script>";
		}
	else {
		echo "<script type='text/javascript'>
		alert('Data gagal di hapus');
		window.location='index.php?page=kembali_barang_demo_detail&id_gudang=$_GET[id_gudang]';
		</script>";
		}
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
      <h1>Detail Pengembalian Barang Demo</h1><ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Detail Barang Demo</li>
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
              <div class="box-body table-responsive no-padding">
              <div class="">
              <!--<a href="index.php?page=tambah_barang_masuk"><button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah Barang</button></a>-->
              
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
</table><br />
                <h3 align="center">
                  Detail Alkes
                </h3>
                <table width="100%" id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th valign="bottom">Tgl Kirim</th>
                      <th valign="bottom"><strong>Tgl Sampai </strong></th>
                      <th valign="bottom">No Seri</th>
                      <th valign="bottom">Kondisi</th>
                      <th valign="bottom">Keterangan</th>
                     
                      <th valign="bottom">Aksi</th>
                    </tr>
                  </thead>
                 <?php
 
// membuka file JSON
if (isset($_SESSION['id_b'])) {
$file = file_get_contents("http://localhost/ALKES/json/barang_demo_kembali.php?id_gudang=$_GET[id_gudang]&id_b=$_SESSION[id_b]");
	}
else {
$file = file_get_contents("http://localhost/ALKES/json/barang_demo_kembali.php?id_gudang=$_GET[id_gudang]");
}
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
?>
                  <tr>
                    <td><?php echo date("d-m-Y",strtotime($json[$i]['tgl_kirim'])); ?></td>
                    <td><?php echo date("d-m-Y",strtotime($json[$i]['tgl_sampai'])); ?></td>
                    <td><?php echo $json[$i]['no_seri_brg']; ?></td>
                    <td><?php echo $json[$i]['kondisi']; ?></td>
                    <td><?php echo $json[$i]['keterangan']; ?></td>
                    <td><a onclick="return confirm('Anda Yakin Akan Menghapus dan Mengembalikan Status Barang Menjadi Barang Untuk Demo ?')" href="index.php?page=kembali_barang_demo_detail&id_hapus=<?php echo $json[$i]['idd']; ?>&id_gudang=<?php echo $_GET['id_gudang']; ?>&id_detail=<?php echo $json[$i]['barang_gudang_detail_id']; ?>"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>
                    </td>
                  </tr>
                  <?php } ?>
                </table>
                <p align="left">&nbsp;</p>
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
  
  <?php 
  if (isset($_POST['ubahuji'])) {
	  $u = mysqli_query($koneksi, "update barang_gudang_detail_rusak set teknisi_id='".$_POST['id_teknisi']."' where id=$_GET[id]");
	  if ($u) {
		  echo "<script type='text/javascript'>
		  alert('Berhasil Di Simpan !');
		  window.location='index.php?page=barang_rusak_detail&id_gudang=$_GET[id_gudang]';
		  </script>";
		  }
	  }
  ?>
<div id="openTeknisi" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Pilh Teknisi</h3>
        <form method="post" enctype="multipart/form-data">
              <select name="id_teknisi" class="form-control">
              <option value="">--Pilih Teknisi--</option>
              <?php 
			  $query_teknisi = mysqli_query($koneksi, "select * from tb_teknisi order by nama_teknisi ASC");
			  while ($data_t = mysqli_fetch_array($query_teknisi)) {
			  ?>
              <option value="<?php echo $data_t['id']; ?>"><?php echo $data_t['nama_teknisi']." - ".$data_t['bidang']; ?></option>
              <?php } ?>
              </select>
             
              <br />
              <button name="ubahuji" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button>
              <br />
              </form>
              </form>
              
    </div>
</div>