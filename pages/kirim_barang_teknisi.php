<?php
if (isset($_POST['sampai_barang'])) {
	  $tgl_k = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dikirim where id=".$_POST['id_status'].""));
	  if ($_POST['tgl_sampai']>=$tgl_k['tgl_kirim']) {
	  $que = mysqli_query($koneksi, "update barang_dikirim set tgl_sampai='".$_POST['tgl_sampai']."' where id=".$_POST['id_status']."");
	  if ($que) {
		  //mysqli_query($koneksi, "insert into uji_f_i values('','".$_GET['id']."','0','0','')");
		  echo "<script type='text/javascript'>
		  window.location='index.php?page=kirim_barang_teknisi'
		  </script>";
		  }
	  	} else {
			echo "<script type='text/javascript'>alert('Tanggal Sampai Tidak Boleh Kurang Dari Tanggal Pengiriman !');
		  </script>";
			}
	  }

if (isset($_POST['pencarian'])) {
		if ($_POST['pilihan']=='tgl_kirim') {
		echo "<script>window.location='index.php?page=kirim_barang_teknisi&tgl1=$_POST[tgl1]&tgl2=$_POST[tgl2]&tampil=$_POST[tampil]'</script>";
		} else {
		echo "<script>window.location='index.php?page=kirim_barang_teknisi&pilihan=$_POST[pilihan]&kunci=$_POST[kata_kunci]&tampil=$_POST[tampil]'</script>";
		}
	}

if (isset($_GET['id_b_s'])) {
	$q=mysqli_query($koneksi, "update barang_dikirim set tgl_sampai='' where id=".$_GET['id_b_s']."");
	if ($q) {
		echo "<script>window.location='index.php?page=kirim_barang_teknisi'</script>";
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
		window.location='index.php?page=kirim_barang_teknisi'</script>";
		}
	else {
		echo "<script>
		alert('Data tidak dapat di hapus karena sudah dibuat SPI');
		window.location='index.php?page=kirim_barang_teknisi'</script>";
		}
	}
	else {
		echo "<script>
		alert('Data tidak dapat di hapus karena sudah dibuat SPI');
		window.location='index.php?page=kirim_barang_teknisi'</script>";
		}
	//$q2 = mysqli_query($koneksi, "select * from barang_dikirim,barang_dikirm_detail,barang_gudang_detail,barang_gudang where barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim.id=".$_GET['id_hapus']."");
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Lokasi Alkes
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
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-warning"><!-- /.chat -->
            <div class="box-footer">
              <div class="box-body">
              <div class="">
              <!--<a href="index.php?page=tambah_barang_kirim">
              <button name="tambah_laporan" class="btn btn-warning" type="submit"><span class="fa fa-plus"></span> Kirim Alkes</button></a><br /><br />--><span class="pull pull-right"><table>
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
</span>
             <br /><br /><br /><br />
             <?php if (isset($_GET['kunci']) or isset($_GET['tgl1'])) { ?>
              <a href="?page=kirim_barang_teknisi"><button class="btn btn-info pull pull-right"><span class="fa fa-refresh"></span> Reset</button></a>&nbsp;&nbsp;
              <?php } ?>
              <button class="btn btn-success pull pull-right" data-toggle="modal" data-target="#modal-pencarian"><span class="fa fa-search"></span> Pencarian</button>
              <?php if (isset($_GET['kunci']) or isset($_GET['tgl1'])) { ?>
              <br /><br />
              <div class="pull pull-left">Data Berdasarkan : <?php 
			  if ($_GET['pilihan']=='no_pengiriman') {echo "<u><em>Nomor PO</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='barang_dijual.no_po_jual') {echo "<u><em>Nomor PO</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='nama_pembeli') {echo "<u><em>Nama Principle</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='nama_brg') {echo "<u><em>Nama Barang</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='tipe_brg') {echo "<u><em>Merk Barang</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='no_seri_brg') {echo "<u><em>No Seri Barang</em></u>, Kata Kunci : ";}
			  else {
				  $tgl11=date("d/m/Y",strtotime($_GET['tgl1']));
				  $tgl22=date("d/m/Y",strtotime($_GET['tgl2']));
				  echo "<u><em>Rentang Tanggal Kirim : $tgl11 - $tgl22</em></u>";}
			  echo "<u><em>".$_GET['kunci']."</em></u>"; ?></div>
              <?php } ?>
              <br /><br />
                <div class="table-responsive no-padding">
                <table width="100%" id="<?php if (isset($_GET['pilihan']) or isset($_GET['tgl1'])){echo "example1";} else {echo "example3";} ?>" class="table table-bordered table-hover">
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
	$file = file_get_contents("http://localhost/ALKES/json/kirim_barang.php?pilihan=$_GET[pilihan]&kunci=".str_replace(" ","%20",$_GET['kunci'])."");
}
elseif (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
	$file = file_get_contents("http://localhost/ALKES/json/kirim_barang.php?tgl1=".$_GET['tgl1']."&tgl2=".$_GET['tgl2']."");
}
else {
$file = file_get_contents("http://localhost/ALKES/json/kirim_barang.php");
}
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
?>
  <tr>
    <td align="center"><?php echo $i+1; ?></td>
    <td bgcolor="#99FFCC"><?php echo date("d M Y",strtotime($json[$i]['tgl_kirim'])); ?></td>
    <td><?php echo $json[$i]['nama_paket']; ?></td>
    
    <td><?php echo $json[$i]['no_pengiriman']; ?></td>
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
        <font class="pull pull-right" size="" color="#FF0000">(Batal)</font>
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
	echo $data3['nama_pembeli']; ?></td>
    <td><?php echo $data3['kontak_rs']; ?></td>
    <td><a href="#" data-toggle="modal" data-target="#modal-kirim<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Detail Barang" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a></td>
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
    <td align="center">
    <?php if (!isset($_SESSION['user_cs'])) { ?>
    <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator']) or isset($_SESSION['user_admin_gudang'])) { ?>
    <a href="index.php?page=kirim_barang_teknisi&id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;<a href="index.php?page=riwayat_panggilan&id=<?php echo $json[$i]['idd']; ?>">
      <span data-toggle="tooltip" title="Riwayat Panggilan CS" class="fa fa-phone-square"></span>
	  </a>&nbsp;
    <?php } ?>
    <a href="index.php?page=ubah_barang_kirim&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a><!--<a target="blank" href="cetak_surat_perintah_instalasi.php?id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Cetak Surat Perintah Instalasi" class="glyphicon glyphicon-print"></span></a><a href="cetak_surat_perintah_instalasi.php?id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Buat Surat Perintah Instalasi" class="fa fa-file-pdf-o"></span></a>--><br />
    
      <a href="#" data-toggle="modal" data-target="#modal-status<?php echo $json[$i]['idd']; ?>">
      <span data-toggle="tooltip" title="Status : Sudah Sampai" class="fa fa-calendar-check-o"></span>
      </a>&nbsp;&nbsp;
      <a href="index.php?page=kirim_barang_teknisi&id_b_s=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Yakin Akan Membatalkan Tanggal Sampai Barang !')">
      <span data-toggle="tooltip" title="Status : Belum Sampai" class="fa fa-calendar-times-o"></span>
      </a><br />
      <a href="index.php?page=kartu_garansi&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Cetak Kartu Garansi" class="fa fa-print"></span></a>&nbsp;&nbsp;<a href="cetak_surat_jalan.php?id=<?php echo $json[$i]['idd']; ?>" target="_blank"><span data-toggle="tooltip" title="Cetak Surat Jalan" class="fa fa-print"></span></a><?php if (isset($_SESSION['user_admin_keuangan']) or isset($_SESSION['user_manajer_keuangan']) or isset($_SESSION['user_administrator'])){ ?>&nbsp;&nbsp;<a target="blank" href="cetak_faktur_penjualan.php?id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Cetak Faktur Penjualan" class="glyphicon glyphicon-print"></span></a><?php } ?>
      <?php } else { ?>
      <a href="index.php?page=riwayat_panggilan&id=<?php echo $json[$i]['idd']; ?>">
      <span class="fa fa-phone-square"></span>
	  </a>
	  <?php } ?>
    </td>
  </tr>
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