<?php 
if (isset($_POST['sampai_barang'])) {
	  $tgl_k = mysqli_fetch_array(mysqli_query($koneksi, "select * from aksesoris_kirim where id=".$_POST['id'].""));
	  if ($_POST['tgl_sampai']>=$tgl_k['tgl_kirim_akse']) {
	  $que = mysqli_query($koneksi, "update aksesoris_kirim set tgl_sampai_akse='".$_POST['tgl_sampai']."' where id=".$_POST['id']."");
	  if ($que) {
		  //mysqli_query($koneksi, "insert into uji_f_i values('','".$_GET['id']."','0','0','')");
		  echo "<script type='text/javascript'>
		  window.location='index.php?page=pengiriman_aksesoris'
		  </script>";
		  }
	  	} else {
			echo "<script type='text/javascript'>alert('Tanggal Sampai Tidak Boleh Kurang Dari Tanggal Pengiriman !');
		  </script>";
			}
	  }

if (isset($_POST['pencarian'])) {
		if ($_POST['pilihan']=='tgl_kirim') {
		echo "<script>window.location='index.php?page=$_GET[page]&tgl1=$_POST[tgl1]&tgl2=$_POST[tgl2]&tampil=$_POST[tampil]'</script>";
		} else {
		echo "<script>window.location='index.php?page=$_GET[page]&pilihan=$_POST[pilihan]&kunci=$_POST[kata_kunci]&tampil=$_POST[tampil]'</script>";
		}
	}

if (isset($_GET['id_b_s'])) {
	$q=mysqli_query($koneksi, "update aksesoris_kirim set tgl_sampai_akse='' where id=".$_GET['id_b_s']."");
	if ($q) {
		echo "<script>window.location='index.php?page=pengiriman_aksesoris'</script>";
		}
	}
	
if (isset($_GET['id_hapus'])) {
	$sel = mysqli_query($koneksi, "select * from aksesoris_kirim_detail where aksesoris_kirim_id=".$_GET['id_hapus']."");
		while ($da = mysqli_fetch_array($sel)) {
			mysqli_query($koneksi, "update aksesoris_detail set status_kirim_akse=0 where id=".$da['aksesoris_detail_id']."");
			}
	$jml_sel = mysqli_num_rows(mysqli_query($koneksi, "select * from aksesoris_kirim_detail where aksesoris_kirim_id=".$_GET['id_hapus'].""));
	$up = mysqli_query($koneksi, "update aksesoris,aksesoris_detail,aksesoris_kirim_detail set stok_total_akse=stok_total_akse+$jml_sel where aksesoris.id=aksesoris_detail.aksesoris_id and aksesoris_detail.id=aksesoris_kirim_detail.aksesoris_detail_id and aksesoris_kirim_id=".$_GET['id_hapus']."");
	$hapus = mysqli_query($koneksi, "delete from aksesoris_kirim_detail where aksesoris_kirim_id=".$_GET['id_hapus']."");
	$hapus2 = mysqli_query($koneksi, "delete from aksesoris_kirim where id=".$_GET['id_hapus']."");
	if ($hapus and $hapus2) {
		echo "<script>
		alert('Data berhasil di hapus !');
		window.location='index.php?page=pengiriman_aksesoris'</script>";
		}
	else {
		echo "<script>
		alert('Data Gagal di hapus !');
		window.location='index.php?page=pengiriman_aksesoris'</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pengiriman Aksesoris
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kirim Aksesoris</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
        <div class="box box-body">
              <div class="pull pull-right">
              <button class="btn btn-success" data-toggle="modal" data-target="#modal-pencarian"><span class="fa fa-search"></span> Pencarian</button>&nbsp;&nbsp;
              <?php if (isset($_GET['kunci']) or isset($_GET['tgl1'])) { ?>
              <a href="?page=<?php echo $_GET['page']; ?>"><button class="btn btn-info"><span class="fa fa-refresh"></span> Reset</button></a>&nbsp;&nbsp;
              <?php } ?>
              <a data-toggle="tooltip" data-title="Jumlah Data Yang Ditampilkan Per Halaman"><button data-toggle="modal" data-target="#modal-atur" name="limit" class="btn btn-default" type="button"><span class="fa fa-cog"></span></button></a>
              </div>
        </div>
              
        </section>
        <?php include "header_pencarian.php"; ?>
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-warning"><!-- /.chat -->
            <div class="box-footer">
              <div class="box-body table-responsive no-padding">
              <div class="">
              
                <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th align="center">#</th>
        
        <th bgcolor="#99FFCC">Tanggal Kirim</th>
        <th>Nama Paket</th>
        
        <th>No Pengiriman</th>
        <th>No PO</th>
      <th><strong>Detail Alkes</strong></th>
      <th><strong>Tempat Tujuan</strong></th>
      
      <th bgcolor="#99FFCC"><strong>Tanggal Sampai</strong></th>
     
      <th align="center"></th>      
      <th align="center"><strong>Aksi</strong></th>
        </tr>
  </thead>
  <?php
 
// membuka file JSON
if (isset($_GET['pilihan']) and isset($_GET['kunci'])) {
	$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]&pilihan=$_GET[pilihan]&kunci=".str_replace(" ","%20",$_GET['kunci'])."");
}
elseif (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
	$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]&tgl1=".$_GET['tgl1']."&tgl2=".$_GET['tgl2']."");
}
else {
$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]");
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
    <td bgcolor="#99FFCC"><?php echo date("d M Y",strtotime($json[$i]['tgl_kirim_akse'])); ?></td>
    <td><?php echo $json[$i]['nama_paket_akse']; ?></td>
    
    <td><?php echo $json[$i]['no_pengiriman_akse']; ?></td>
    <td><?php echo $json[$i]['po_no_akse']; ?></td>
    <td>
    <table width="100%" border="0">
      <?php 
	  $q=mysqli_query($koneksi, "select *,aksesoris_kirim.id as idd from aksesoris,aksesoris_detail,aksesoris_kirim,aksesoris_kirim_detail where aksesoris.id=aksesoris_detail.aksesoris_id and aksesoris_detail.id=aksesoris_kirim_detail.aksesoris_detail_id and aksesoris_kirim.id=aksesoris_kirim_detail.aksesoris_kirim_id and aksesoris_kirim.id=".$json[$i]['idd']."");
	  $n=0;
	  while ($d1=mysqli_fetch_array($q)) {
	  $n++;
	  if ($n%2==0) {
		  $col="#CCCCCC";
		  }
		  else {
			  $col="#999999";
			  }
	  ?>
      <tr bgcolor="<?php echo $col; ?>">
        <td align="left"><?php echo $d1['nama_akse']."|"; ?></td>
        <td align="right"><?php echo $d1['no_seri_akse']." ".$d1['nama_set_akse']; ?></td>
        </tr>
      <?php } ?>
    </table>
    </td>
    <td><?php 
	$data3=mysqli_fetch_array(mysqli_query($koneksi, "select nama_pembeli,aksesoris_kirim.id as idd from aksesoris,aksesoris_detail,aksesoris_jual,aksesoris_jual_qty,pembeli,aksesoris_kirim,aksesoris_kirim_detail where aksesoris.id=aksesoris_detail.aksesoris_id and aksesoris_detail.id=aksesoris_kirim_detail.aksesoris_detail_id and aksesoris_jual.id=aksesoris_jual_qty.aksesoris_jual_id and aksesoris_jual_qty.id=aksesoris_kirim_detail.aksesoris_jual_qty_id and pembeli.id=aksesoris_jual.pembeli_id and aksesoris_kirim.id=aksesoris_kirim_detail.aksesoris_kirim_id and aksesoris_kirim.id=".$json[$i]['idd'].""));
	echo $data3['nama_pembeli']; ?></td>
    
    <?php 
	if ($json[$i]['tgl_sampai_akse']!=0000-00-00) {
		$bg="#99FFCC";
		}
		else {
			$bg="red";
			}
	?>
    <td bgcolor=<?php echo $bg; ?>>
		<?php
		if ($json[$i]['tgl_sampai_akse']!=0000-00-00) {
	echo date("d M Y", strtotime($json[$i]['tgl_sampai_akse'])); } else {
		echo "-";
		} ?>
    </td>
    
    <td align="center"><input name="pilih[]" type="checkbox" value=""/></td>
    <td align="center">
    <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator']) or isset($_SESSION['user_admin_gudang'])) { ?>
    <a href="index.php?page=pengiriman_aksesoris&id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;&nbsp;
    <?php } ?>
    <a href="index.php?page=ubah_pengiriman_aksesoris&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp;&nbsp;
    <!--<a href="cetak_surat_jalan_aksesoris.php?id=<?php echo $json[$i]['idd']; ?>" target="_blank">-->
    <a href="#" data-toggle="modal" data-target="#modal-cetak-surat-jalan<?php echo $json[$i]['idd']; ?>">
    <span data-toggle="tooltip" title="Cetak Surat Jalan" class="fa fa-print"></span></a><br />
      
      <!--<a href="index.php?page=pengiriman_aksesoris&id=<?php echo $json[$i]['idd']; ?>#openSampai">-->
      <a href="#" data-toggle="modal" data-target="#modal-status<?php echo $json[$i]['idd']; ?>">
      <span data-toggle="tooltip" title="Status : Sudah Sampai" class="fa fa-calendar-check-o"></span>
      </a>&nbsp;&nbsp;
      <a href="index.php?page=pengiriman_aksesoris&id_b_s=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Yakin Akan Membatalkan Tanggal Sampai Barang !')">
      <span data-toggle="tooltip" title="Status : Belum Sampai" class="fa fa-calendar-times-o"></span>
      </a>
    </td>
  </tr>
  <div class="modal fade" id="modal-cetak-surat-jalan<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cetak Surat Jalan</h4>
              </div>
              <div class="modal-body">
              <div class="col-lg-6">
              <div class="box box-body" align="center">
              <a href="cetak_surat_jalan_aksesoris.php?id=<?php echo $json[$i]['idd']; ?>" target="_blank" class="btn btn-app"><i class="fa fa-print"></i> Print</a> 
              <a href="cetak_surat_jalan_aksesoris_word.php?id=<?php echo $json[$i]['idd']; ?>" class="btn btn-app"><i class="fa fa-file-word-o"></i> Word</a>
              <div class="box-footer">Format 1</div>
              </div>
              </div>
              <div class="col-lg-6">
              <div class="box box-body" align="center">
              <a href="cetak_surat_jalan_aksesoris2.php?id=<?php echo $json[$i]['idd']; ?>" target="_blank" class="btn btn-app"><i class="fa fa-print"></i> Print</a> 
              <a href="cetak_surat_jalan_aksesoris_word2.php?id=<?php echo $json[$i]['idd']; ?>" class="btn btn-app"><i class="fa fa-file-word-o"></i> Word</a>
              <div class="box-footer">Format 2</div>
              </div>
              </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
</div>
  <div class="modal fade" id="modal-status<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Tanggal Sampai</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <p align="justify">
              <input type="hidden" name="id" value="<?php echo $json[$i]['idd']; ?>"/>
              <input id="input" type="date" placeholder="" name="tgl_sampai" required value="<?php echo $json[$i]['tgl_sampai']; ?>">
              </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button class="btn btn-success" name="sampai_barang" type="submit">Simpan</button>
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
	if (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
$queryy = mysqli_query($koneksi, "select *,aksesoris_kirim.id as idd from aksesoris_kirim,aksesoris_jual,aksesoris_jual_qty,aksesoris_kirim_detail where aksesoris_kirim.id=aksesoris_kirim_detail.aksesoris_kirim_id and aksesoris_jual_qty.id=aksesoris_kirim_detail.aksesoris_jual_qty_id and aksesoris_jual.id=aksesoris_jual_qty.aksesoris_jual_id and tgl_kirim_akse between '$_GET[tgl1]' and '$_GET[tgl2]' group by aksesoris_kirim.id order by tgl_kirim_akse DESC, aksesoris_kirim.id DESC");
}
elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
$queryy = mysqli_query($koneksi, "select *,aksesoris_kirim.id as idd from aksesoris_kirim,aksesoris_jual,aksesoris_jual_qty,aksesoris_kirim_detail,aksesoris_detail,pembeli where aksesoris_kirim.id=aksesoris_kirim_detail.aksesoris_kirim_id and aksesoris_jual_qty.id=aksesoris_kirim_detail.aksesoris_jual_qty_id and aksesoris_jual.id=aksesoris_jual_qty.aksesoris_jual_id and aksesoris_detail.id=aksesoris_kirim_detail.aksesoris_detail_id and pembeli.id=aksesoris_jual.pembeli_id and $_GET[pilihan] like '%$_GET[kunci]%' group by aksesoris_kirim.id order by tgl_kirim_akse DESC, aksesoris_kirim.id DESC");
}
 else {
$queryy = mysqli_query($koneksi, "select *,aksesoris_kirim.id as idd from aksesoris_kirim order by aksesoris_kirim.tgl_kirim_akse DESC, aksesoris_kirim.id DESC");
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
<?php 
$q = mysqli_fetch_array(mysqli_query($koneksi, "select * from pembeli,alamat_provinsi,alamat_kabupaten,alamat_kecamatan where alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and pembeli.id=".$_GET['id'].""))
?>
<div id="openDetailPembeli" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Detail RS/Dinas/Klinik/Dll</h3> 
     <form method="post">
     <label>Nama RS/Dinas/Puskesmas/Klinik/Dll</label>
     <input id="input" type="text" placeholder="" name="no_peng" readonly="readonly" disabled value="<?php echo $q['nama_pembeli']; ?>">
     <label>Alamat</label>
     <textarea rows="4" id="input" placeholder="" name="no_peng" readonly="readonly" disabled><?php echo "Kelurahan ".$q['kelurahan_id']."\nKecamatan ".$q['nama_kecamatan']." \nKabupaten ".$q['nama_kabupaten']."\nProvinsi ".$q['nama_provinsi']; ?></textarea>
     <label>Kontak</label>
     <input id="input" type="text" placeholder="" name="no_po" readonly="readonly" disabled value="<?php echo $q['kontak_rs']; ?>">
     <br /><br />
    </form>
    </div>
</div>
<div class="modal fade" id="modal-pencarian">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              <script type="text/javascript">
			  function yesnoCheck() {
				  if (document.getElementById('yesCheck').value=='tgl_kirim') {
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
                <option value="tgl_kirim">Berdasarkan Rentang Tanggal Kirim</option>
                <option value="no_pengiriman_akse">Berdasarkan Nomor Surat Jalan/Pengiriman</option>
                <option value="no_po_jual_akse">Berdasarkan Nomor PO</option>
                <option value="nama_pembeli">Berdasarkan Lokasi Tujuan</option>
                <option value="nama_akse">Berdasarkan Nama Aksesoris</option>
                <option value="tipe_akse">Berdasarkan Tipe Aksesoris</option>
                <option value="no_seri_akse">Berdasarkan No Seri Aksesoris</option>
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
              <br />
              <select name="tampil" class="form-control select2" style="width:100%">
                <option value="">...</option>
                <option value="1">Tampilkan Detail Barang</option>
                <option value="0">Jangan Tampilkan Detail Barang</option>
                </select>
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