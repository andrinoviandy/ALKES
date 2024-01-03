<?php
if (isset($_POST['ubah_uji'])) {
	  $u = mysqli_query($koneksi, "update alat_uji_detail set soft_version='".$_POST['soft_version']."',tgl_garansi_habis='".$_POST['tgl_garansi']."',tgl_i='".$_POST['tgl_i']."', tgl_f='".$_POST['tgl_f']."', keterangan='".$_POST['keterangan']."' where id=".$_POST['id_ubah']."");
	  if ($u) {
		  echo "<script type='text/javascript'>
		  alert('Berhasil Diubah !');
		  window.location='index.php?page=ubah_uji&id_rumkit=$_GET[id_rumkit]';
		  </script>";
		  }
	  }

if (isset($_POST['ubahlampiran2'])) {
	
	$qq = mysqli_fetch_array(mysqli_query($koneksi, "select * from alat_uji_detail where id=".$_POST['id_f'].""));
	unlink("gambar_fi/fungsi/$qq[lampiran_f]");
	$max2 = mysqli_fetch_array(mysqli_query($koneksi, "select max(id)+1 as maks from alat_uji_detail"));
	$ext2 = explode(".",$_FILES['lampiran_f']['name']);
	if ($_FILES['lampiran_f']['name']!='') {
	$lamp_f="Fungsi".$_POST['id_f'].".".$ext2[1];
	} else {$lamp_f="";}
	$u2=mysqli_query($koneksi, "update alat_uji_detail set lampiran_f='".$lamp_f."' where id=".$_POST['id_f']."");
	if ($u2) {
		copy($_FILES['lampiran_f']['tmp_name'], "gambar_fi/fungsi/".$lamp_f);
		alert('Berhasil di Ubah !');
		echo "<script type='text/javascript'>
		window.location='index.php?page=ubah_uji&id_rumkit=$_GET[id_rumkit]';
		</script>";
		}
	
	}
 
if (isset($_POST['ubahlampiran1'])) {
	
	$qq = mysqli_fetch_array(mysqli_query($koneksi, "select * from alat_uji_detail where id=".$_POST['id_i'].""));
	unlink("gambar_fi/instalasi/$qq[lampiran_i]");
	$max2 = mysqli_fetch_array(mysqli_query($koneksi, "select max(id)+1 as maks from alat_uji_detail"));
	$ext2 = explode(".",$_FILES['lampiran_i']['name']);
	if ($_FILES['lampiran_i']['name']!='') {
	$lamp_f=$_POST['id_i'].".".$ext2[1];
	} else {$lamp_f="";}
	$u2=mysqli_query($koneksi, "update alat_uji_detail set lampiran_i='".$lamp_f."' where id=".$_POST['id_i']."");
	if ($u2) {
		copy($_FILES['lampiran_i']['tmp_name'], "gambar_fi/instalasi/".$lamp_f);
		echo "<script type='text/javascript'>
		alert('Berhasil di Ubah !');
		window.location='index.php?page=ubah_uji&id_rumkit=$_GET[id_rumkit]';
		</script>";
		}
	
}

  if (isset($_GET['id_hapus'])) {
	 
	$Result = mysqli_query($koneksi, "delete from alat_uji_detail where barang_teknisi_detail_id=$_GET[id_hapus]");
	if ($Result) {
		mysqli_query($koneksi, "update barang_teknisi_detail set status_uji=0 where id=$_GET[id_hapus]");
		echo "<script type='text/javascript'>
		window.location='index.php?page=simpan_tambah_uji&id=$_GET[id]';
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
      <h1>
      Instalasi &amp; Uji Fungsi</h1><ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Instalasi &amp; Uji Fungsi</li>
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
      <th valign="bottom">Nama RS/Dinas/Klinik/dll</th>
      <th valign="bottom">Alamat</th>
      <th valign="bottom"><strong>Kontak RS/Dinas/dll</strong></th>
      </tr>
  </thead>
  <tr>
    <td><?php 
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from pembeli where id=$_GET[id_rumkit]"));
	echo $sel['nama_pembeli']; ?></td>
    <td><?php echo $sel['jalan']; ?></td>
    <td><?php echo $sel['kontak_rs']; ?></td>
    </tr>
</table>
              </div>
                <br />
                <h3 align="center">
                  Detail Alkes
                </h3>
                <span class="pull pull-right">
              <table>
  <tr>
    <td valign="top"><strong style="color:#F00">Keterangan</strong> : &nbsp;&nbsp;&nbsp;</td>
    <td valign="top">1. </td>
    <td valign="top">Jika <strong>Box</strong> Di <strong>Nama Alkes</strong> Berwarna <strong style="color:#F00">Merah</strong> , Itu menandakan<br />
barang telah dikembalikan karena mengalami kerusakan</td>
  </tr>
</table>
              </span><br /><br /><br />
                <div class="table-responsive">
                <table width="100%" id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th valign="bottom"><strong>Tgl SPI</strong></th>
                      <th valign="bottom">No SPI</th>
                      <th valign="bottom">Nama Alkes</th>
                      <th valign="bottom">No Seri</th>
                      <th valign="bottom">Software Vers.</th>
                      <th valign="bottom">Tgl Garansi Habis</th>
                      <th valign="bottom">Tgl Instalasi</th>
                      <th valign="bottom">Lampiran Instalasi</th>
                      <th valign="bottom">Tgl Uji Fungsi</th>
                      <th valign="bottom">Lampiran U. Fungsi</th>
                      <th valign="bottom"><strong>Teknisi</strong></th>
                      <th valign="bottom">Kontak Teknisi</th>
                      <th valign="bottom">Keterangan</th>
                      <th valign="bottom">Aksi</th>
                    </tr>
                  </thead>
                 <?php
 
// membuka file JSON
if (isset($_SESSION['id_b'])) {
	$file = file_get_contents("http://localhost/ALKES/json/ubah_uji.php?id_rumkit=$_GET[id_rumkit]&id_b=$_SESSION[id_b]");
	}
else {
$file = file_get_contents("http://localhost/ALKES/json/ubah_uji.php?id_rumkit=$_GET[id_rumkit]");
}
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
?>
                  <tr>
                    <td><?php echo date("d/m/Y",strtotime($json[$i]['tgl_spk'])); ?></td>
                    <td><?php echo $json[$i]['no_spk']; ?></td>
                    <td <?php if ($json[$i]['status_batal']==1){echo "bgcolor='red'";} ?>><?php echo $json[$i]['nama_brg']; ?></td>
                    <td><?php echo $json[$i]['no_seri_brg']." ".$json[$i]['nama_set']; ?></td>
                    <td><?php echo $json[$i]['soft_version']; ?></td>
                    <td><?php echo date("d/m/Y",strtotime($json[$i]['tgl_garansi_habis'])); ?></td>
                    <td><?php echo date("d/m/Y",strtotime($json[$i]['tgl_i'])); ?></td>
                    <td><a href="#" data-toggle="modal" data-target="#modal-ubahinstalasi<?php echo $json[$i]['idd'] ?>"><small data-toggle="tooltip" title="Ubah Lampiran" class="label bg-blue pull pull-right pull-top">Ubah</small></a><?php if ($json[$i]['lampiran_i']!='') { ?>
    <a href="#" data-toggle="modal" data-target="#modal-instalasi<?php echo $json[$i]['idd']; ?>"><img src="gambar_fi/instalasi/<?php echo $json[$i]['lampiran_i']; ?>" width="50px" /></a>
    <?php } ?></td>
                    <td><?php echo date("d/m/Y",strtotime($json[$i]['tgl_f'])); ?></td>
                    <td><a href="#" data-toggle="modal" data-target="#modal-ubahfungsi<?php echo $json[$i]['idd'] ?>"><small data-toggle="tooltip" title="Ubah Lampiran" class="label bg-blue pull pull-right pull-top">Ubah</small></a><?php if ($json[$i]['lampiran_f']!='') { ?>
    <a href="#" data-toggle="modal" data-target="#modal-ujifungsi<?php echo $json[$i]['idd']; ?>"><img src="gambar_fi/fungsi/<?php echo $json[$i]['lampiran_f']; ?>" width="50px" /></a>
    <?php } ?></td>
                    <td><?php echo $json[$i]['nama_teknisi']; ?></td>
                    <td><?php echo $json[$i]['no_hp']." / ".$_SESSION['kontak2']; ?></td>
                    <td><?php echo $json[$i]['keterangan']; ?></td>
                    <td align="center"><a href="pages/delete_uji.php?id_hapus=<?php echo $json[$i]['idd']; ?>&id_rumkit=<?php echo $_GET['id_rumkit']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a><!--&nbsp;&nbsp;<a target="blank" href="cetak_surat_perintah_instalasi.php?id=<?php echo $dataa['idd']; ?>"><span data-toggle="tooltip" title="Cetak Surat Perintah Instalasi" class="fa fa-print"></span></a>-->&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#modal-ubah<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp;&nbsp;<a target="_blank" href="cetak_laporan_instalasi.php?id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Download Report" class="glyphicon glyphicon-print"></span></a><br />
                    <?php 
					//$lihat = mysqli_num_rows(mysqli_query($koneksi, "select * from alat_pelatihan where alat_uji_detail_id=".$json[$i]['idd'].""));
					if ($json[$i]['status_pelatihan']==0) { ?>
                    <a href="index.php?page=tambah_pelatihan&id=<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Pelatihan Alat" class="label bg-blue">Pelatihan</small></a>
                    <?php } ?>
                    </td>
                  </tr>
                  <div class="modal fade" id="modal-ubahinstalasi<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" align="center">Ubah Lampiran Instalasi</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
              <input type="hidden" name="id_i" value="<?php echo $json[$i]['idd'] ?>" />
              <input name="lampiran_i" type="file" class="form-control"/>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button name="ubahlampiran1" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        
        <div class="modal fade" id="modal-ubahfungsi<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" align="center">Ubah Lampiran Uji Fungsi</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
              <input type="hidden" name="id_f" value="<?php echo $json[$i]['idd'] ?>" />
              <input name="lampiran_f" type="file" class="form-control"/>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button name="ubahlampiran2" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
                  
                  <div class="modal fade" id="modal-instalasi<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              </div>
              <form method="post">
              <div class="modal-body">
              <img src="gambar_fi/instalasi/<?php echo $json[$i]['lampiran_i']; ?>" width="100%" height="auto"/>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        
        <div class="modal fade" id="modal-ujifungsi<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              </div>
              <form method="post">
              <div class="modal-body">
              <img src="gambar_fi/fungsi/<?php echo $json[$i]['lampiran_f']; ?>" width="100%" height="auto"/>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        
        <div class="modal fade" id="modal-ubah<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" align="center">Ubah Instalasi & Uji Fungsi</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
              <input type="hidden" name="id_ubah" value="<?php echo $json[$i]['idd'] ?>" />
              
              <label>Soft. Version</label>
          <input name="soft_version" class="form-control" type="text" required placeholder="Soft. Version" value="<?php echo $json[$i]['soft_version']; ?>"><br />
          <label>Tgl Garansi</label>
          <input name="tgl_garansi" class="form-control" type="date" required placeholder="Tgl Garansi" value="<?php echo $json[$i]['tgl_garansi_habis']; ?>"><br />
          <label>Tgl Instalasi</label>
          <input name="tgl_i" class="form-control" type="date" required placeholder="Nama Aksesoris" value="<?php echo $json[$i]['tgl_i']; ?>"><br />
          <label>Tgl Uji Fungsi</label>
              <input name="tgl_f" class="form-control" type="date" placeholder="Tipe" required value="<?php echo $json[$i]['tgl_f']; ?>"><br />
              <label>Keterangan</label>
              <textarea name="keterangan" class="form-control" placeholder="" rows="3"><?php echo $json[$i]['keterangan'] ?></textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button name="ubah_uji" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button>
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

?>

