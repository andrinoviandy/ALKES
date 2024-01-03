<?php
  if (isset($_POST['jual'])) {
	  $q = mysqli_query($koneksi, "update barang_teknisi set tgl_spk='".$_POST['tgl_spk']."', no_spk='".$_POST['no_spk']."', keterangan_spk='".$_POST['keterangan_spk']."' where id=".$_POST['id_spk']."");
	  if ($q) {
		  echo "<script type='text/javascript'>
		  alert('Berhasil Di Ubah !');
		  window.location='index.php?page=spi';
		  </script>";
		  }
  }

if (isset($_POST['pencarian'])) {
		if ($_POST['pilihan']=='tgl_spk') {
		echo "<script>window.location='index.php?page=$_GET[page]&tgl1=$_POST[tgl1]&tgl2=$_POST[tgl2]&tampil=$_POST[tampil]'</script>";
		} else {
		echo "<script>window.location='index.php?page=$_GET[page]&pilihan=$_POST[pilihan]&kunci=$_POST[kata_kunci]&tampil=$_POST[tampil]'</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Surat Perintah Instalasi</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Surat Perintah Instalasi</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-default"><!-- /.chat -->
            <div class="box-footer">
              <div class="box-body table-responsive no-padding">
              <div class="">
              <?php if (!isset($_SESSION['id_b'])) { ?>
              <a href="index.php?page=tambah_spk_masuk">
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah </button></a>
              <?php } ?>
              <span class="pull pull-right">
              <table>
  <tr>
    <td valign="top"><strong style="color:#F00">Keterangan</strong> : &nbsp;&nbsp;&nbsp;</td>
    <td valign="top">1. </td>
    <td valign="top">Jika <strong>Box</strong> Di <strong>Nama Alkes</strong> Berwarna <strong style="color:#F00">Merah</strong> , Itu menandakan<br />
barang telah dikembalikan karena mengalami kerusakan</td>
  </tr>
</table>
              </span>
              <br /><br />
              <div class="pull pull-left">
              <button class="btn btn-info" data-toggle="modal" data-target="#modal-cetak"><span class="fa fa-print"></span> Rekap</button>
              </div>
             <div class="pull pull-right">
              <button class="btn btn-success" data-toggle="modal" data-target="#modal-pencarian"><span class="fa fa-search"></span> Pencarian</button>&nbsp;&nbsp;
              <?php if (isset($_GET['kunci']) or isset($_GET['tgl1'])) { ?>
              <a href="?page=<?php echo $_GET['page'] ?>"><button class="btn btn-info"><span class="fa fa-refresh"></span> Reset</button></a>&nbsp;&nbsp;
              <?php } ?>
              <a data-toggle="tooltip" data-title="Jumlah Data Yang Ditampilkan Per Halaman"><button data-toggle="modal" data-target="#modal-atur" name="limit" class="btn btn-default" type="button"><span class="fa fa-cog"></span></button></a>
              </div>
             
                
</div>
              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        <?php include "header_pencarian.php"; ?>
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
              <div class="box-body">
              <div class="">
              
                <div class="table-responsive">
                <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="top">No</th>
        
        <th valign="top">Tanggal_SPI</th>
        <th valign="top">No SPI</th>
        <th valign="top">No Surat Jalan</th>
        <th valign="top">No PO</th>
        <th valign="top">Barang</th>
      
      <th valign="top"><strong>RS/Dinas/Puskesmas/Dll</strong></th>
      <th valign="top">Kontak </th>
      <th valign="top">Deskripsi</th>
      <!--<th valign="top"><strong>Teknisi</strong></th>-->
      <th valign="top"><strong>Aksi</strong></th>
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
    <td><?php echo date("d-m-Y", strtotime($json[$i]['tgl_spk'])); ?>
    </td>
    <td><?php 
	echo $json[$i]['no_spk']; ?></td>
  <td>
    <span class="label bg-info" style="color:#000; font-size:12px"><?php echo $json[$i]['no_pengiriman'];
	 ?></span>
     <?php if ($spi['status_pengganti']==1) {echo "<br><marquee><em>(Barang Pengganti)</em></marquee>";}
	 ?>
     </td>
    <td>
    <?php
	echo $json[$i]['no_po_jual'];
	?>
    </td>
    <td>
    <?php if ($_GET['tampil']==1) { ?>
    <?php 
	  $q23=mysqli_query($koneksi, "select nama_brg,no_seri_brg,status_spi,status_kerusakan,status_batal,tipe_brg from barang_gudang,barang_gudang_detail,barang_dikirim_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_id=".$json[$i]['barang_dikirim_id']."");
	  $n2=0;
	  while ($d1=mysqli_fetch_array($q23)) {
	  $n2++;
	  $d2 = mysqli_fetch_array(mysqli_query($koneksi, "select status_teknisi,status_uji from barang_teknisi_detail where barang_dikirim_detail_id = ".$d1['barang_dikirim_detail.id'].""));
	  ?>
      <?php if ($d2['status_teknisi']==1) { ?>
        <font class="pull pull-right" size="">(<span class='fa fa-user'></span>)</font>
        <?php } ?>
        <font class="pull pull-right" size="">
        <?php
		if($d2['status_uji']==1) {
			echo "(<span class='fa fa-wrench'></span>)";
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
	echo $json[$i]['nama_pembeli']; ?>
    <!--<a href="index.php?page=spk_masuk&id_spk=<?php //echo $data['idd']; ?>#open_detail"><span data-toggle="tooltip" title="Detail Rumah Sakit/Dinas/Puskemas/Klinik" class="fa fa-eye pull pull-left"></span></a>-->
    </td>
    <td><?php echo $json[$i]['kontak_rs']; ?></td>
    <td align="center"><?php 
	echo $json[$i]['keterangan_spk']; ?></td>
    <!--<td><?php 
	$data_tek=mysqli_fetch_array(mysqli_query($koneksi, "select * from tb_teknisi where id=".$json[$i]['teknisi_id'].""));
	echo $data_tek['nama_teknisi']; ?>
    <a href="index.php?page=spi&id_tek=<?php echo $json[$i]['teknisi_id']; ?>#open_teknisi"><span data-toggle="tooltip" title="Detail Teknisi" class="fa fa-eye pull pull-left"></span></a>
    </td>-->
    <td align="center">
      <?php if (!isset($_SESSION['id_b'])) { ?>
        <a href="pages/delete_spk_masuk.php?id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#modal-ubah<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a><?php } ?>
        <?php 
		if ($ada==0) { ?><br /><a data-toggle="modal" data-target="#modal-cetak-spi<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Cetak SPI" class="glyphicon glyphicon-print"></span></a>
          <?php } ?>
    </td>
  </tr>
  <div class="modal fade" id="modal-cetak-spi<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cetak Surat Perintah Instalasi</h4>
              </div>
              <div class="modal-body">
              <a href="cetak_surat_perintah_instalasi.php?id=<?php echo $json[$i]['idd']; ?>&id_kirim=<?php echo $json[$i]['barang_dikirim_id'] ?>" target="_blank" class="btn btn-app"><i class="fa fa-print"></i> Print</a> 
              <a href="cetak_surat_perintah_instalasi_word.php?id=<?php echo $json[$i]['idd']; ?>&id_kirim=<?php echo $json[$i]['barang_dikirim_id'] ?>" class="btn btn-app"><i class="fa fa-file-word-o"></i> Word</a>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                
              </div>
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
	  $q2=mysqli_query($koneksi, "select * from barang_gudang,barang_gudang_detail,barang_dikirim_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_id=".$json[$i]['barang_dikirim_id']."");
	  $n=0;
	  while ($d1=mysqli_fetch_array($q2)) {
	  $n++;
	  $d2 = mysqli_fetch_array(mysqli_query($koneksi, "select status_teknisi,status_uji from barang_teknisi_detail where barang_dikirim_detail_id = ".$d1['barang_dikirim_detail.id'].""));
	  ?>
      <?php if ($d2['status_teknisi']==1) { ?>
        <font class="pull pull-right" size="+1">(<span class='fa fa-user'></span>)</font>
        <?php } ?>
        <font class="pull pull-right" size="+1">
        <?php
		if($d2['status_uji']==1) {
			echo "(<span class='fa fa-wrench'></span>)";
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
        
        <div class="modal fade" id="modal-ubah<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Ubah SPI</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <p align="justify">
              <input type="hidden" value="<?php echo $json[$i]['idd']; ?>" name="id_spk"/>
              <label>Tanggal SPI</label>
              <input id="input" type="date" placeholder="" name="tgl_spk" value="<?php echo $json[$i]['tgl_spk']; ?>" required>
              <label>Nomor SPI</label>
     <input id="input" type="text" value="<?php echo $json[$i]['no_spk']; ?>" placeholder="No SPI" name="no_spk" required>
     <label>Deskripsi</label>
     <textarea rows="4" class="form-control" name="keterangan_spk"><?php echo $json[$i]['keterangan_spk']; ?></textarea>
              </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button class="btn btn-success" name="jual" type="submit">Simpan Perubahan</button>
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
	if (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
$queryy = mysqli_query($koneksi, "select *,barang_teknisi.id as idd from barang_dikirim,barang_teknisi,barang_teknisi_detail,barang_dikirim_detail,barang_gudang,barang_gudang_detail,barang_dijual,barang_dijual_qty,pembeli where barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_dijual_qty.id=barang_dikirim_detail.barang_dijual_qty_id and barang_dijual.id=barang_dijual_qty.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and tgl_spk between '$_GET[tgl1]' and '$_GET[tgl2]' group by barang_teknisi.id order by tgl_spk DESC,no_spk DESC");
	}
	elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
$queryy = mysqli_query($koneksi, "select *,barang_teknisi.id as idd from barang_dikirim,barang_teknisi,barang_teknisi_detail,barang_dikirim_detail,barang_gudang,barang_gudang_detail,barang_dijual,barang_dijual_qty,pembeli where barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_dijual_qty.id=barang_dikirim_detail.barang_dijual_qty_id and barang_dijual.id=barang_dijual_qty.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and $_GET[pilihan] like '%$_GET[kunci]%' group by barang_teknisi.id order by tgl_spk DESC,no_spk DESC");
	}
	else {
	$queryy = mysqli_query($koneksi, "select *,barang_teknisi.id as idd from barang_teknisi order by tgl_spk DESC,no_spk DESC");
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
$d_t=mysqli_fetch_array(mysqli_query($koneksi, "select * from tb_teknisi where id=$_GET[id_tek]"));
?>
<div id="open_teknisi" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Detail Teknisi</h3> 
     <form method="post">
     <strong>Nama</strong>
     <input id="input" type="text" readonly="readonly" value="<?php echo $d_t['nama_teknisi']; ?>"/>
     <strong>Kompetensi</strong>
     <input id="input" type="text" readonly="readonly" value="<?php echo $d_t['bidang']; ?>"/>
     <strong>No HP</strong>
     <input id="input" type="text" readonly="readonly" value="<?php echo $d_t['no_hp']; ?>"/>
     <strong>No STR</strong>
     <input id="input" type="text" readonly="readonly" value="<?php echo $d_t['no_str']; ?>"/>
     <table width="100%">
  <tr>
    <td align="center"><strong>Ijazah</strong></td>
    <td align="center"><strong>Sertifikat</strong></td>
  </tr>
  <tr>
    <td align="center"><a href="ijazah_teknisi/<?php echo $d_t['ijazah']; ?>" target="_blank"><img src="ijazah_teknisi/<?php echo $d_t['ijazah']; ?>" width="50px" /></a></td>
    <td align="center"><a href="ijazah_teknisi/sertifikat/<?php echo $d_t['sertifikat']; ?>" target="_blank"><img src="ijazah_teknisi/sertifikat/<?php echo $d_t['sertifikat']; ?>" width="50px" /></a></td>
  </tr>
</table>

     </form>
    </div>
</div>

<div id="openUji" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Uji Fungsi & Instalasi</h3> 
     <form method="post">
     <input name="nama_teknisi" id="input" type="text" required placeholder="Nama Teknisi"><br />
              
              <input name="bidang" id="input" type="text" placeholder="Bidang" required><br />
              <input name="no_str" id="input" placeholder="No STR" required><br />
              <input name="no_hp" id="input" type="text" placeholder="No HP" required><br />
              <input name="username" id="input" type="text" placeholder="Username" required><br />
              <input name="password" id="input" type="password" placeholder="Password" required><br />
              Ijazah
              <input name="ijazah" style="background-color:#FFF" id="input" type="file" /><br />
              Sertifikat
              <input name="sertifikat" id="input" type="file" style="background-color:#FFF"/><br />
        <button id="buttonn" name="tambahteknisibaru" type="submit">Jual Alkes</button>
    </form>
    </div>
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
                <option value="no_spk">Berdasarkan Nomor SPI</option>
                <option value="no_pengiriman">Berdasarkan Nomor Surat Jalan</option>
                <option value="barang_dijual.no_po_jual">Berdasarkan Nomor PO</option>
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

<div class="modal fade" id="modal-cetak">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><center>
                    Rekapan SPI
                </center></h4>
              </div>
              <form method="post" enctype="multipart/form-data" action="cetak_laporan_spi.php">
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

