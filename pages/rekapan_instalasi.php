<?php
if (isset($_POST['lihat'])) {
	  
		  echo "<script type='text/javascript'>
		  window.location='index.php?page=rekapan_instalasi&merk=$_POST[merk]&tgl1=$_POST[tgl1]&tgl2=$_POST[tgl2]';
		  </script>";
		  
	  }

if (isset($_POST['pencarian'])) {
		if ($_POST['pilihan']=='tgl_spk') {
		if (isset($_GET['merk'])) {
		if ($_GET['merk']=='all') {
		echo "<script>window.location='index.php?page=$_GET[page]&merk=all&tgl1=$_POST[tgl1]&tgl2=$_POST[tgl2]'</script>";
		} else {
		echo "<script>window.location='index.php?page=$_GET[page]&merk=".str_replace("%20"," ",$_GET['merk'])."&tgl1=$_POST[tgl1]&tgl2=$_POST[tgl2]'</script>";			
		} } else {
			echo "<script>window.location='index.php?page=$_GET[page]&tgl1=$_POST[tgl1]&tgl2=$_POST[tgl2]'</script>";
			}
		} else {
		if (isset($_GET['merk'])) {
		if ($_GET['merk']=='all') {
		echo "<script>window.location='index.php?page=$_GET[page]&merk=all&tgl1=$_POST[tgl1]&tgl2=$_POST[tgl2]'</script>";
		} else {
		echo "<script>window.location='index.php?page=$_GET[page]&merk=".str_replace("%20"," ",$_GET['merk'])."&pilihan=$_POST[pilihan]&kunci=$_POST[kata_kunci]'</script>";
		} } else {
			echo "<script>window.location='index.php?page=$_GET[page]&pilihan=$_POST[pilihan]&kunci=$_POST[kata_kunci]'</script>";
			}
		}
	}

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
      Rekapan Instalasi</h1><ol class="breadcrumb">
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
              <form method="post">
              <div class="col-xs-3">
                  <div class="input-group">
                        <span class="input-group-addon">
                          Merk Barang <span class="fa fa-cube"></span>
                        </span>
                    <select class="form-control select2" name="merk" style="margin-right:40px" required <?php if (isset($_GET['merk'])) { echo "disabled";} ?>>
                <option value="">...</option>
                <option value="all" <?php if ($_GET['merk']=='all') {echo "selected";} ?>>Semua</option>
                <?php 
				$q = mysqli_query($koneksi, "select merk_brg from barang_gudang group by merk_brg order by merk_brg ASC");
				while ($d = mysqli_fetch_array($q)) {
				?>
                <option <?php if (isset($_GET['merk'])) { if ($_GET['merk']==$d['merk_brg']) {echo "selected";} } ?> value="<?php echo $d['merk_brg']; ?>"><?php echo $d['merk_brg']; ?></option>
                <?php } ?>
                </select>
                  </div>
                  <!-- /input-group -->
                </div>
              <div class="col-xs-3">
                  <div class="input-group">
                        <span class="input-group-addon">
                          Form <span class="fa fa-calendar"></span>
                        </span>
                    <input name="tgl1" value="<?php if (isset($_GET['tgl1'])) { echo $_GET['tgl1']; } ?>" required="required" type="date" <?php if (isset($_GET['tgl1'])) { echo "disabled"; } ?> class="form-control">
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-xs-3">
                  <div class="input-group">
                        <span class="input-group-addon">
                          To <span class="fa fa-calendar"></span>
                        </span>
                    <input name="tgl2" value="<?php if (isset($_GET['tgl2'])) { echo $_GET['tgl2']; } ?>" required="required" type="date" <?php if (isset($_GET['tgl2'])) { echo "disabled"; } ?> class="form-control">
                  </div>
                  <!-- /input-group -->
                </div>
                <?php if (!isset($_GET['merk'])) { ?>
                <button class="btn btn-success" type="submit" name="lihat"><span class="fa fa-check"></span> Proses</button>
                <?php } else { ?>
                <a href="?page=rekapan_instalasi" class="btn btn-warning"><span class="fa fa-refresh"></span> Ulangi</a>
                <a href="cetak_rekapan_instalasi.php?merk=<?php echo $_GET['merk'] ?>&tgl1=<?php echo $_GET['tgl1'] ?>&tgl2=<?php echo $_GET['tgl2'] ?>" class="btn btn-success"><span class="fa fa-print"></span> Cetak (.xls)</a>
                <?php } ?>
              </form>
              <br /><br />
              <div class="table-responsive">
              <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">Nama Barang</th>
      <th valign="bottom">Tipe</th>
      <th valign="bottom">Merk</th>
      <th valign="bottom"><strong>Negara Asal</strong></th>
      </tr>
  </thead>
  <?php
  if ($_GET['merk']!='all') {
  $q = mysqli_query($koneksi, "select * from barang_gudang where merk_brg='".$_GET['merk']."'");
  while ($sel = mysqli_fetch_array($q)) {
  ?>
  <tr>
    <td><?php 
	echo $sel['nama_brg']; ?></td>
    <td><?php echo $sel['tipe_brg']; ?></td>
    <td><?php echo $sel['merk_brg']; ?></td>
    <td><?php echo $sel['negara_asal']; ?></td>
    </tr>
    <?php }} else { ?>
    <tr><td colspan="4" align="center">Semua Merk</td></tr>
	<?php } ?>
</table>
              </div>
                <br />
                <h3 align="center">Data Instalasi</h3>
                <div class="pull pull-right">
              <button class="btn btn-success" data-toggle="modal" data-target="#modal-pencarian"><span class="fa fa-search"></span> Pencarian</button>&nbsp;&nbsp;
              <?php if (isset($_GET['kunci']) or isset($_GET['tgl1'])) { ?>
              <a href="?page=<?php echo $_GET['page'] ?>"><button class="btn btn-info"><span class="fa fa-refresh"></span> Reset</button></a>&nbsp;&nbsp;
              <?php } ?>
              <a data-toggle="tooltip" data-title="Jumlah Data Yang Ditampilkan Per Halaman"><button data-toggle="modal" data-target="#modal-atur" name="limit" class="btn btn-default" type="button"><span class="fa fa-cog"></span></button></a>
              </div>
              <br /><br />
                <div class="table-responsive">
                  <table width="100%" id="" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th valign="bottom">No</th>
                      <th valign="bottom"><strong>Tgl SPI</strong></th>
                      <th valign="bottom">No SPI</th>
                      <th valign="bottom">Tipe</th>
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
                      <th valign="bottom">Nama RS/Dinas/Klinik/Dll</th>
                      <th valign="bottom">Alamat</th>
                      <th valign="bottom">Kontak</th>
                      </tr>
                  </thead>
                 <?php
 
// membuka file JSON
if (isset($_GET['merk'])) {
	if (isset($_GET['pilihan']) and isset($_GET['kunci'])) {
	$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]&pilihan=$_GET[pilihan]&kunci=".str_replace(" ","%20",$_GET['kunci'])."&merk=".str_replace(" ","%20",$_GET['merk'])."");
}
	elseif (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
	$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]&tgl1=".$_GET['tgl1']."&tgl2=".$_GET['tgl2']."&merk=".str_replace(" ","%20",$_GET['merk'])."");
}
	else {
	$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]&merk=".str_replace(" ","%20",$_GET['merk'])."&tgl1=$_GET[tgl1]&tgl2=$_GET[tgl2]");
	}
}
else {
	if (isset($_GET['pilihan']) and isset($_GET['kunci'])) {
	$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]&pilihan=$_GET[pilihan]&kunci=".str_replace(" ","%20",$_GET['kunci'])."");
}
	elseif (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
	$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]&tgl1=".$_GET['tgl1']."&tgl2=".$_GET['tgl2']."");
}
	else {
$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]");
	}
}
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
?>
                  <tr>
                    <td><?php
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
                    <td><?php echo date("d/m/Y",strtotime($json[$i]['tgl_spk'])); ?></td>
                    <td><?php echo $json[$i]['no_spk']; ?></td>
                    <td><?php echo $json[$i]['tipe_brg']; ?></td>
                    <td><?php echo $json[$i]['no_seri_brg']." ".$json[$i]['nama_set']; ?></td>
                    <td><?php
					$q3 = mysqli_query($koneksi, "select *,alat_uji_detail.id as idd from alat_uji_detail where barang_teknisi_detail_id=".$json[$i]['idd']."");
					$d3 = mysqli_fetch_array($q3);
					 echo $d3['soft_version']; ?></td>
                    <td><?php
                    if ($d3['tgl_garansi_habis']!=0000-00-00) {
					echo date("d/m/Y",strtotime($d3['tgl_garansi_habis']));
					} ?></td>
                    <td><?php
                    if ($d3['tgl_i']!=0000-00-00) {
					echo date("d/m/Y",strtotime($d3['tgl_i']));
					} ?></td>
                    <td><?php if ($d3['lampiran_i']!='') { ?>
    <a href="#" data-toggle="modal" data-target="#modal-instalasi<?php echo $json[$i]['idd']; ?>"><img src="gambar_fi/instalasi/<?php echo $d3['lampiran_i']; ?>" width="50px" /></a>
    <?php } ?></td>
                    <td><?php
                    if ($d3['tgl_f']!=0000-00-00) {
					echo date("d/m/Y",strtotime($d3['tgl_f']));
					} ?></td>
                    <td><?php if ($d3['lampiran_f']!='') { ?>
    <a href="#" data-toggle="modal" data-target="#modal-ujifungsi<?php echo $json[$i]['idd']; ?>"><img src="gambar_fi/fungsi/<?php echo $d3['lampiran_f']; ?>" width="50px" /></a>
    <?php } ?></td>
                    <td><?php
                    $q4 = mysqli_query($koneksi, "select *,barang_teknisi_detail_teknisi.id as idd from barang_teknisi_detail_teknisi,tb_teknisi where tb_teknisi.id=barang_teknisi_detail_teknisi.teknisi_id and barang_teknisi_detail_id=".$json[$i]['idd']."");
					$d4 = mysqli_fetch_array($q4);
					echo $d4['nama_teknisi']; ?></td>
                    <td><?php echo $d4['no_hp']; ?></td>
                    <td><?php echo $d3['keterangan']; ?></td>
                    <td><?php echo $json[$i]['nama_pembeli']; ?></td>
                    <td><?php echo $json[$i]['jalan']; ?></td>
                    <td><?php echo $json[$i]['kontak_rs']; ?></td>
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
              <img src="gambar_fi/instalasi/<?php echo $d3['lampiran_i']; ?>" width="100%" height="auto"/>
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
              <img src="gambar_fi/fungsi/<?php echo $d3['lampiran_f']; ?>" width="100%" height="auto"/>
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
                
</div>
              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
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
	if (isset($_GET['merk'])) {
if ($_GET['merk']=='all') {
	if (isset($_GET['pilihan']) and isset($_GET['kunci'])) {
	$queryy = mysqli_query($koneksi, "select *,barang_teknisi_detail.id as idd from barang_teknisi,barang_teknisi_detail, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and $_GET[pilihan] like '%$_GET[kunci]%' and tgl_spk between '$_GET[tgl1]' and '$_GET[tgl2]' group by no_seri_brg order by tgl_spk DESC, no_spk DESC");
	}
	elseif (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
	$queryy = mysqli_query($koneksi, "select *,barang_teknisi_detail.id as idd from barang_teknisi,barang_teknisi_detail, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and tgl_spk between '$_GET[tgl1]' and '$_GET[tgl2]' group by no_seri_brg order by tgl_spk DESC, no_spk DESC");
	}
	else {
	$queryy = mysqli_query($koneksi, "select *,barang_teknisi_detail.id as idd from barang_teknisi,barang_teknisi_detail, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and tgl_spk between '$_GET[tgl1]' and '$_GET[tgl2]' group by no_seri_brg order by tgl_spk DESC, no_spk DESC");
	}
	}
	else {
	if (isset($_GET['pilihan']) and isset($_GET['kunci'])) {
	$queryy = mysqli_query($koneksi, "select *,barang_teknisi_detail.id as idd from barang_teknisi,barang_teknisi_detail, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and $_GET[pilihan] like '%$_GET[kunci]%' and barang_gudang.merk_brg='".$_GET['merk']."' and tgl_spk between '$_GET[tgl1]' and '$_GET[tgl2]' group by no_seri_brg order by tgl_spk DESC, no_spk DESC");
	}
	elseif (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
	$queryy = mysqli_query($koneksi, "select *,barang_teknisi_detail.id as idd from barang_teknisi,barang_teknisi_detail, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_gudang.merk_brg='".$_GET['merk']."' and tgl_spk between '$_GET[tgl1]' and '$_GET[tgl2]' group by no_seri_brg order by tgl_spk DESC, no_spk DESC");
	}
	else {
	$queryy = mysqli_query($koneksi, "select *,barang_teknisi_detail.id as idd from barang_teknisi,barang_teknisi_detail, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_gudang.merk_brg='".$_GET['merk']."' and tgl_spk between '$_GET[tgl1]' and '$_GET[tgl2]' group by no_seri_brg order by tgl_spk DESC, no_spk DESC");
		}
	}
}
else {
	if (isset($_GET['pilihan']) and isset($_GET['kunci'])) {
	$queryy = mysqli_query($koneksi, "select *,barang_teknisi_detail.id as idd from barang_teknisi,barang_teknisi_detail, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and $_GET[pilihan] like '%$_GET[kunci]%' group by no_seri_brg order by tgl_spk DESC, no_spk DESC");
	}
	elseif (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
	$queryy = mysqli_query($koneksi, "select *,barang_teknisi_detail.id as idd from barang_teknisi,barang_teknisi_detail, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and tgl_spk between '$_GET[tgl1]' and '$_GET[tgl2]' group by no_seri_brg order by tgl_spk DESC, no_spk DESC");
	}
	else {
	$queryy = mysqli_query($koneksi, "select *,barang_teknisi_detail.id as idd from barang_teknisi,barang_teknisi_detail, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id group by no_seri_brg order by tgl_spk DESC, no_spk DESC");
	}
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
<div class="modal fade" id="modal-pencarian">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              <script type="text/javascript">
			  function yesnoCheck() {
				  if (document.getElementById('yesCheck').value=='tgl_spk') {
					  document.getElementById('ifYes').style.display = 'block';
					  document.getElementById('kata_kunci').style.display = 'none';
					  }
					  else 
					  { document.getElementById('ifYes').style.display = 'none';
					  document.getElementById('kata_kunci').style.display = 'block';
					  }
					  }

 

</script>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pencarian</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <select class="form-control select2" name="pilihan" required style="width:100%" onchange="javascript:yesnoCheck();" id="yesCheck">
                <option value="">...</option>
                <option value="tgl_spk">Berdasarkan Rentang Tanggal SPI</option>
                <option value="barang_dijual.no_po_jual">Berdasarkan Nomor PO</option>
                <option value="no_spk">Berdasarkan Nomor SPI</option>
                <option value="nama_pembeli">Berdasarkan RS/Dinas/Puskesmas/Dll</option>
                <option value="nama_brg">Berdasarkan Nama Barang</option>
                <option value="tipe_brg">Berdasarkan Tipe Barang</option>
                <option value="no_seri_brg">Berdasarkan No Seri Barang</option>
                </select>
                <br /><br />
                <div id="kata_kunci" style="display:block">
                <input type="text" class="form-control" name="kata_kunci" placeholder="Kata Kunci"/>
                </div>
                <div id="ifYes" style="display:none">
              <label>Dari Tanggal</label>
              <input name="tgl1" type="date" class="form-control" placeholder="" value=""><br />
              <label>Sampai Tanggal</label>
              <input name="tgl2" type="date" class="form-control" placeholder="" value="">
              </div>
              
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