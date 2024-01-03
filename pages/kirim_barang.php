<?php
if (isset($_POST['tampilkan'])) {
	echo "<script type='text/javascript'>
	window.location='index.php?page=kirim_barang&thn=".$_POST['tahun']."'</script>";
	}

if (isset($_POST['kirim_pengganti'])) {
	$_SESSION['nama_paket']=$_POST['nama_paket'];
	$_SESSION['no_pengiriman']=$_POST['no_peng'];
	$_SESSION['ekspedisi']=$_POST['ekspedisi'];
	$_SESSION['tgl_pengiriman']=$_POST['tgl_kirim'];
	$_SESSION['via_pengiriman']=$_POST['via_kirim'];
	$_SESSION['estimasi']=$_POST['estimasi_brg_sampai'];
	$_SESSION['biaya_kirim']=$_POST['biaya_kirim'];
	$_SESSION['no_po']=$_POST['no_po'];
	
	echo "<script type='text/javascript'>
		window.location='index.php?page=pilih_no_seri_pengganti';
		</script>";
} 

if (isset($_POST['sampai_barang'])) {
	  $tgl_k = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dikirim where id=".$_POST['id_status'].""));
	  if ($_POST['tgl_sampai']>=$tgl_k['tgl_kirim']) {
	  $que = mysqli_query($koneksi, "update barang_dikirim set tgl_sampai='".$_POST['tgl_sampai']."' where id=".$_POST['id_status']."");
	  if ($que) {
		  //mysqli_query($koneksi, "insert into uji_f_i values('','".$_GET['id']."','0','0','')");
		  echo "<script type='text/javascript'>
		  window.location='index.php?page=kirim_barang'
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

if (isset($_POST['rekap'])) {
	if ($_POST['pilihan']=='tgl_kirim') {
		echo "<script>window.location='index.php?page=$_GET[page]&tgl1=$_POST[tgl1]&tgl2=$_POST[tgl2]&tampil=$_POST[tampil]&rekap=1'</script>";
		} else {
		echo "<script>window.location='index.php?page=$_GET[page]&pilihan=$_POST[pilihan]&kunci=$_POST[kata_kunci]&tampil=$_POST[tampil]&rekap=1'</script>";
		}
	}
if (isset($_GET['rekap'])) {
	echo "<script>window.location.href='cetak_rekapan_pengiriman_alkes.php?tgl1=$_GET[tgl1]&tgl2=$_GET[tgl2]';</script>";
	}

if (isset($_GET['id_b_s'])) {
	$q=mysqli_query($koneksi, "update barang_dikirim set tgl_sampai='' where id=".$_GET['id_b_s']."");
	if ($q) {
		echo "<script>window.location='index.php?page=kirim_barang'</script>";
		}
	}
if (isset($_POST['simpan_tujuan'])) {
	$q=mysqli_query($koneksi, "update barang_dikirim set alamat2='".str_replace("\n","<br>",$_POST['alamat2'])."' where id=".$_POST['idd']."");
	if ($q) {
		echo "<script>
		alert('Alamat Ke-2 Berhasil Di Ubah !');
		window.location='index.php?page=kirim_barang';</script>";
		}
	else {
		echo "<script>
		alert('Alamat Ke-2 Gagal Di Ubah !');
		window.location='index.php?page=kirim_barang'</script>";
		}
	}
	
if (isset($_GET['id_hapus'])) {
	$cek = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim,barang_dikirim_detail,barang_teknisi_detail where barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_dikirim.id=".$_GET['id_hapus'].""));
	if ($cek==0) {
	$up=mysqli_query($koneksi, "update barang_gudang_detail,barang_dikirim_detail set barang_gudang_detail.status_kirim=0 where barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_id=".$_GET['id_hapus']."");
		$jml_sel = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim_detail where barang_dikirim_id=".$_GET['id_hapus'].""));
		$up2 = mysqli_query($koneksi, "update barang_gudang,barang_gudang_detail,barang_dikirim_detail set stok_total=stok_total+$jml_sel where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_id=".$_GET['id_hapus']."");
	$del1=mysqli_query($koneksi, "delete from barang_dikirim_detail where barang_dikirim_id=".$_GET['id_hapus']."");
	$del2=mysqli_query($koneksi, "delete from barang_dikirim where id=".$_GET['id_hapus']."");
	if ($up and $up2 and $del1 and $del2) {
		echo "<script>
		alert('Data berhasil di hapus');
		window.location='index.php?page=kirim_barang'</script>";
		}
	else {
		echo "<script>
		alert('Data tidak dapat di hapus karena sudah dibuat SPI');
		window.location='index.php?page=kirim_barang'</script>";
		}
	}
	else {
		echo "<script>
		alert('Data tidak dapat di hapus karena sudah dibuat SPI');
		window.location='index.php?page=kirim_barang'</script>";
		}
	//$q2 = mysqli_query($koneksi, "select * from barang_dikirim,barang_dikirm_detail,barang_gudang_detail,barang_gudang where barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim.id=".$_GET['id_hapus']."");
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Alkes Terkirim
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kirim Alkes</li>
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
        <button class="btn btn-info" data-toggle="modal" data-target="#kirim-barang-pengganti">Kirim Barang Pengganti</button>
          <div class="pull pull-right"><table>
  <tr>
    <td><strong style="color:#F00">Keterangan</strong> : &nbsp;&nbsp;&nbsp;</td>
    <td valign="top">1. </td>
    <td valign="top"><strong style="color:#F00">Tanggal Sampai</strong> wajib diisi , untuk pembuatan SPI </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td valign="top">2. </td>
    <td>Jika <strong>Box</strong> Di <strong>Nama Alkes</strong> Berwarna <strong style="color:#F00">Merah</strong> , Itu menandakan<br /> 
      barang telah dikembalikan karena mengalami kerusakan</td>
  </tr>
</table>
</div>
             <br /><br /><br />
             <div class="pull pull-left">
             
        <form method="post" class="pull pull-left">
             <div class="input-group col-xs-2">  
                <select class="form-control select2" name="tahun">
                <option <?php if (isset($_GET['thn'])=='all' or isset($_GET['pilihan'])) {
					echo "selected";
					} ?> value="all">Semua</option>
                <?php 
				$q99 = mysqli_query($koneksi, "select year(tgl_kirim) as thn from barang_dikirim group by year(tgl_kirim) order by year(tgl_kirim) ASC");
				while ($d = mysqli_fetch_array($q99)) {
				?>
                <option <?php 
				if (isset($_GET['thn'])) {
					if ($_GET['thn']!='all') {
						if ($_GET['thn']==$d['thn']) {echo "selected";}
						}
					}
				else {
					if (!isset($_GET['pilihan'])) {
						if (date('Y')==$d['thn']) {echo "selected";}
						}
					}
				?> value="<?php echo $d['thn']; ?>"><?php echo $d['thn']; ?></option>
                <?php } ?>
                </select>
                
                <span class="input-group-btn">
                      <button type="submit" name="tampilkan" class="btn btn-warning">Tampilkan Barang</button>
                    </span>
                
              </div>
              </form>
        	</div>
            <br /><br />
            <div class="pull pull-left">
              <button class="btn btn-info" data-toggle="modal" data-target="#modal-cetak"><span class="fa fa-print"></span> Rekap</button>
              </div>
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
              <div class="box-body">
              <div class="">
              
                <div class="table-responsive no-padding">
                <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th align="center">No</th>
      <th bgcolor="#99FFCC">Tanggal Kirim</th>
      <th width="20%">Nama Paket</th>
      <th>No_Surat_Jalan</th>
      <th>No_PO</th>
      <th>Barang</th>
      <th><strong>Lokasi Tujuan</strong></th>
      <th>Kontak</th>
      <th>Pengiriman</th>
      <th bgcolor="#99FFCC"><strong>Tanggal Sampai</strong></th>
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
	if (isset($_GET['thn'])) {
		if ($_GET['thn']=='all') {
		$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]&thn=all");
		} else {
			$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]&thn=".$_GET['thn']."");
			}
	} else {
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
    <td bgcolor="#99FFCC"><?php echo date("d M Y",strtotime($json[$i]['tgl_kirim'])); ?></td>
    <td><?php echo $json[$i]['nama_paket']; ?></td>
    
    <td><span class="label bg-info" style="color:#000; font-size:12px"><?php echo $json[$i]['no_pengiriman'];
	 ?></span>
     <?php if ($json[$i]['status_pengganti']==1) {echo "<br><marquee><em>(Barang Pengganti)</em></marquee>";}
	 ?>
     </td>
    <td>
    <!--
    <table width="100%" border="0">
      <?php 
	  $q2=mysqli_query($koneksi, "select no_po_gudang from barang_gudang,barang_gudang_po,barang_gudang_detail,barang_dikirim_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_po.id=barang_gudang_detail.barang_gudang_po_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_id=".$json[$i]['idd']."");
	  $n=0;
	  while ($d1=mysqli_fetch_array($q2)) {
	  $n++;
	  if ($n%2==0) {
		  $col="#CCCCCC";
		  }
		  else {
			  $col="#999999";
			  }
	  ?>
      <tr bgcolor="<?php echo $col; ?>">
        <td align="left"><?php echo $d1['no_po_gudang']; ?></td>
        </tr>
      <?php } ?>
    </table>--><?php echo $json[$i]['no_po_jual']; ?></td>
    <td>
    <?php if ($_GET['tampil']==1) { ?>
    <?php 
	  $q23=mysqli_query($koneksi, "select nama_brg,no_seri_brg,status_spi,status_kerusakan,status_batal,tipe_brg from barang_gudang,barang_gudang_detail,barang_dikirim_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_id=".$json[$i]['idd']."");
	  $n2=0;
	  while ($d1=mysqli_fetch_array($q23)) {
	  $n2++;
	  ?>
      <?php if ($d1['status_batal']==1) { ?>
        <font class="pull pull-right" size="">Batal</font>
        <?php } ?>
        <font class="pull pull-right" size="">
        <?php
		if($d1['status_spi']==1) {
			echo "(<span class='fa fa-sticky-note-o'></span>)";
			}
			?>
            </font>
      <?php echo $n2.".[".$d1['nama_brg']."]-[".$d1['tipe_brg']."]-[".$d1['no_seri_brg']."]"; ?>
      <hr style="margin:0px; border-top:1px double; width:100%"/>
      <?php } ?>
    <?php } else { ?>
    <a href="#" data-toggle="modal" data-target="#modal-detailbarang<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Detail Barang" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a>
    <?php } ?>
    </td>
    <td><?php 
	$data3=mysqli_fetch_array(mysqli_query($koneksi, "select nama_pembeli,kontak_rs from pembeli,barang_dijual,barang_dikirim where pembeli.id=barang_dijual.pembeli_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=".$json[$i]['idd'].""));
	echo $data3['nama_pembeli']; ?><br />
    <a href="#" data-toggle="modal" data-target="#modal-tujuan<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Input Alamat Ke-2" class="label bg-primary"><span class="fa fa-maps"> Alamat Ke-2</span></small></a>
    </td>
    <td><?php echo $data3['kontak_rs']; ?></td>
    <td><a href="#" data-toggle="modal" data-target="#modal-kirim<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Detail Pengiriman" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a></td>
    <?php 
	if ($json[$i]['tgl_sampai']!=0000-00-00) {
		$bg="#99FFCC";
		}
		else {
			$bg="red";
			}
	?>
    <td bgcolor=<?php echo $bg; ?>>
		<?php
		if ($json[$i]['tgl_sampai']!=0000-00-00) {
	echo date("d M Y", strtotime($json[$i]['tgl_sampai'])); } else {
		echo "-";
		} ?>
    </td>
    <td align="center" style="margin:0px; padding:0px">
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <button type="button" class="btn btn-success">Aksi &nbsp;<span class="fa fa-caret-down"></span></button>
            </a>
            <ul class="dropdown-menu">
              <li class="header" align="center">Aksi</li>
              <li class="body">
              <ul class="menu">
              <?php if (!isset($_SESSION['user_cs'])) { ?>
              	<?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator']) or isset($_SESSION['user_admin_gudang'])) { ?>
    <li><a href="index.php?page=kirim_barang&id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="fa fa-trash"></span> Hapus</a></li>
    <li><a href="index.php?page=riwayat_panggilan&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Riwayat Panggilan CS" class="fa fa-phone-square"></span> Riwayat Panggilan CS</a></li>
    <?php } ?>
                <li><a href="index.php?page=ubah_barang_kirim&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span> Ubah</a></li>
                <li>
      <a href="#" data-toggle="modal" data-target="#modal-status<?php echo $json[$i]['idd']; ?>">
      <span data-toggle="tooltip" title="Status : Sudah Sampai" class="fa fa-calendar-check-o"></span> Status : Sudah Sampai</a></li>
      <li>
      <a href="index.php?page=kirim_barang&id_b_s=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Yakin Akan Membatalkan Tanggal Sampai Barang !')">
      <span data-toggle="tooltip" title="Status : Belum Sampai" class="fa fa-calendar-times-o"></span> Status : Belum Sampai</a></li>
      <li><a href="index.php?page=kartu_garansi&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Cetak Kartu Garansi" class="fa fa-print"></span> Cetak Kartu Garansi</a></li>
      <li>
      <a href="#" data-toggle="modal" data-target="#modal-cetak-surat-jalan<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Cetak Surat Jalan" class="fa fa-print"></span> Cetak Surat Jalan</a>
	  </li>
                <?php if (isset($_SESSION['user_admin_keuangan']) or isset($_SESSION['user_manajer_keuangan']) or isset($_SESSION['user_administrator'])){ ?>
                <li><a target="blank" href="cetak_faktur_penjualan.php?id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Cetak Faktur Penjualan" class="glyphicon glyphicon-print"></span> Cetak Faktur Penjualan</a>
                </li>
                <!--<a target="blank" href="cetak_surat_perintah_instalasi.php?id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Cetak Surat Perintah Instalasi" class="glyphicon glyphicon-print"></span></a><a href="cetak_surat_perintah_instalasi.php?id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Buat Surat Perintah Instalasi" class="fa fa-file-pdf-o"></span></a>-->
				<?php } ?>
                <?php } else { ?>
      <li>
      <a href="index.php?page=riwayat_panggilan&id=<?php echo $json[$i]['idd']; ?>">
      <span class="fa fa-phone-square"></span> Riwayat Panggilan</a></li>
	  <?php } ?>
              </ul>
              </li>
            </ul>
          </li>
          </ul>
          </div>
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
              <a href="cetak_surat_jalan.php?id=<?php echo $json[$i]['idd']; ?>" target="_blank" class="btn btn-app"><i class="fa fa-print"></i> Print</a> 
              <a href="cetak_surat_jalan_word.php?id=<?php echo $json[$i]['idd']; ?>" class="btn btn-app"><i class="fa fa-file-word-o"></i> Word</a>
              <div class="box-footer">Format 1</div>
              </div>
              </div>
              <div class="col-lg-6">
              <div class="box box-body" align="center">
              <a href="cetak_surat_jalan2.php?id=<?php echo $json[$i]['idd']; ?>" target="_blank" class="btn btn-app"><i class="fa fa-print"></i> Print</a> 
              <a href="cetak_surat_jalan_word2.php?id=<?php echo $json[$i]['idd']; ?>" class="btn btn-app"><i class="fa fa-file-word-o"></i> Word</a>
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

<div class="modal fade" id="modal-tujuan<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Input Alamat Ke-2</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <input type="hidden" name="idd" value="<?php echo $json[$i]['idd']; ?>" />
              <label>Alamat Lengkap , Pisahkan Dengan Enter Untuk Baris Berikutnya</label>
              <textarea class="form-control" rows="8" name="alamat2"><?php echo str_replace("<br>","\n",$json[$i]['alamat2']); ?></textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button class="btn btn-success" name="simpan_tujuan" type="submit">Simpan</button>
              </div>
              </form>
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
              <input type="hidden" name="id_status" value="<?php echo $json[$i]['idd']; ?>"/>
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
  
  <div class="modal fade" id="modal-detailbarang<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Detail Barang</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <p align="justify">
              
      <?php 
	  $q=mysqli_query($koneksi, "select nama_brg,no_seri_brg,status_spi,status_kerusakan,status_batal,tipe_brg from barang_gudang,barang_gudang_detail,barang_dikirim_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_id=".$json[$i]['idd']."");
	  $n=0;
	  while ($d1=mysqli_fetch_array($q)) {
	  $n++;
	  ?>
      <?php if ($d1['status_batal']==1) { ?>
        <font class="pull pull-right" size="+1">Batal</font>
        <?php } ?>
        <font class="pull pull-right" size="+2">
        <?php
		if($d1['status_spi']==1) {
			echo "(<span class='fa fa-sticky-note-o'></span>)";
			}
			?>
            </font>
      <?php echo $n.". ".$d1['nama_brg']."     |    "; ?>
      <?php echo $d1['tipe_brg']."     |    "; ?>
      <?php echo $d1['no_seri_brg']; ?>
      <hr />
      <?php } ?>
    
              </p>
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
        
        <div class="modal fade" id="modal-kirim<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Data Pengiriman</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <p align="justify">
              <?php 
	  echo "<b>Ekspedisi :</b> <br/>".$json[$i]['ekspedisi']; ?>
      <hr />
      <?php echo "<b>Pengiriman Via :</b> <br/>".$json[$i]['via_pengiriman']; ?>
      <hr />
      <?php echo "<b>Estimasi Barang Sampai :</b> <br/>"; ?>
      <?php 
	if ($json[$i]['estimasi_barang_sampai']!=0000-00-00) {
	echo date("d/m/Y",strtotime($json[$i]['estimasi_barang_sampai'])); } ?>
              <hr />
              <?php echo "<b>Biaya Jasa Pengiriman :</b> <br/>".number_format($json[$i]['biaya_pengiriman'],0,',','.'); ?>
      
              </p>
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
	if (isset($_GET['id'])) {
if (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
	$queryy = mysqli_query($koneksi, "select *,barang_dikirim.id as idd from barang_dijual,barang_dijual_qty,barang_gudang,pembeli,barang_dikirim where barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and pembeli.id=barang_dijual.pembeli_id and $_GET[pilihan] like '%$_GET[kunci]%' and barang_dijual.id=".$_GET['id']." group by barang_dikirim.id order by tgl_kirim DESC, barang_dikirim.id DESC");
} else {
	$queryy = mysqli_query($koneksi, "select *,barang_dikirim.id as idd from barang_dikirim where barang_dijual_id=".$_GET['id']." order by tgl_kirim DESC, barang_dikirim.id DESC");

}
}
else if (isset($_GET['id_riwayat'])) {
if (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
	$queryy = mysqli_query($koneksi, "select *,barang_dikirim.id as idd from barang_dijual,barang_dijual_qty,barang_gudang,pembeli,barang_dikirim where barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and pembeli.id=barang_dijual.pembeli_id and $_GET[pilihan] like '%$_GET[kunci]%' and barang_dikirim.id=".$_GET['id_riwayat']." group by barang_dikirim.id order by tgl_kirim DESC, barang_dikirim.id DESC");

} else {
	$queryy = mysqli_query($koneksi, "select *,barang_dikirim.id as idd from barang_dikirim where id=".$_GET['id_riwayat']." order by tgl_kirim DESC, barang_dikirim.id DESC");
}
}
else {
if (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
	$queryy = mysqli_query($koneksi, "select *,barang_dikirim.id as idd from barang_dijual,barang_dijual_qty,barang_gudang,pembeli,barang_dikirim,barang_gudang_detail,barang_dikirim_detail where barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and pembeli.id=barang_dijual.pembeli_id and tgl_kirim between '$_GET[tgl1]' and '$_GET[tgl2]' group by barang_dikirim.id order by tgl_kirim DESC, barang_dikirim.id DESC");

}
elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
	$queryy = mysqli_query($koneksi, "select *,barang_dikirim.id as idd from barang_dijual,barang_dijual_qty,barang_gudang,pembeli,barang_dikirim,barang_gudang_detail,barang_dikirim_detail where barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and pembeli.id=barang_dijual.pembeli_id and $_GET[pilihan] like '%$_GET[kunci]%' group by barang_dikirim.id order by tgl_kirim DESC, barang_dikirim.id DESC");

} else {
	if (isset($_GET['thn'])) {
		if ($_GET['thn']=='all') {
			$queryy = mysqli_query($koneksi, "select *,barang_dikirim.id as idd from barang_dikirim order by tgl_kirim DESC");
		
		} else {
			$queryy = mysqli_query($koneksi, "select *,barang_dikirim.id as idd from barang_dikirim where year(tgl_kirim)='".$_GET['thn']."' order by tgl_kirim DESC, barang_dikirim.id DESC");
			
		}
	} else {
		$queryy = mysqli_query($koneksi, "select *,barang_dikirim.id as idd from barang_dikirim where year(tgl_kirim)='".date('Y')."' order by tgl_kirim DESC, barang_dikirim.id DESC");
	}
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
                <option value="no_pengiriman">Berdasarkan Nomor Surat Jalan</option>
                <option value="barang_dijual.no_po_jual">Berdasarkan Nomor PO</option>
                <option value="nama_pembeli">Berdasarkan Lokasi Tujuan</option>
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

<div class="modal fade" id="kirim-barang-pengganti">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Kirim Barang Pengganti</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
              <label>Pilih No PO / No Surat Jalan</label>
                <select class="form-control select2" id="pilihan" name="no_po" required style="width:100%">
                <option value="">...</option>
                <?php 
				$q_no_po = mysqli_query($koneksi, "select *,barang_dikirim.id as idd from barang_dikirim,barang_dikirim_detail where barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and status_batal=1 group by no_pengiriman order by no_po_jual ASC");
				
				while ($data = mysqli_fetch_array($q_no_po)){ ?>
                <option value="<?php echo $data['idd'] ?>"><?php echo $data['no_po_jual']." @ ".$data['no_pengiriman'] ?></option>
                <?php } ?>
                </select>
                <br /><br />
                <label>Nama Paket</label>
     <input type="text" class="form-control" placeholder="" name="nama_paket" required>
     <br />
     <label>No. Surat Jalan</label>
     <input id="input" type="text" placeholder="" name="no_peng" required class="form-control">
     <br /><br />
     <label>Ekspedisi</label>
     <input id="input" type="text" placeholder="" name="ekspedisi" required class="form-control">
     <br /><br />
     <label>Tanggal Pengiriman</label>
     <input id="input" type="date" placeholder="" name="tgl_kirim" required class="form-control">
     <br /><br />
     <label>Via Pengiriman</label>
     <input id="input" type="text" placeholder="" name="via_kirim" required class="form-control">
     <br /><br />
     <label>Estimasi Barang Sampai</label>
     <input id="input" type="date" placeholder="" name="estimasi_brg_sampai" class="form-control">
     <br /><br />
     <label>Biaya Jasa</label>
     <input id="input" type="text" placeholder="" name="biaya_kirim" required="required" class="form-control" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" name="kirim_pengganti">Next</button>
              </div>
              </form>
              <script type="text/javascript">    
	<?php 
	echo $jsArray; 
	?>  
	function changeValue(pilihan){  
		document.getElementById('nama_paket').value = dtBrg[pilihan].nama_paket;
	};  
</script>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-cetak">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><center>
                    Rekapan Pengiriman Barang
                </center></h4>
              </div>
              <form method="post" enctype="multipart/form-data" action="cetak_laporan_pengiriman_alkes.php">
              <div class="modal-body">
              <label>Dari Tanggal</label>
              <input name="tgl1" type="date" class="form-control" placeholder="" value=""><br />
              <label>Sampai Tanggal</label>
              <input name="tgl2" type="date" class="form-control" placeholder="" value=""><br />
              
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info" name="cetak">Cetak</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>