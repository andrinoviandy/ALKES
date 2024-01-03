<?php 
if (isset($_POST['pencarian'])) {
		if ($_POST['pilihan']=='tgl_kirim') {
		echo "<script>window.location='index.php?page=kirim_pinjam_barang&pilihan=$_POST[pilihan]&tgl1=$_POST[tgl1]&tgl2=$_POST[tgl2]&tampil=$_POST[tampil]'</script>";
		}
		elseif ($_POST['pilihan']=='tgl_sampai') {
		echo "<script>window.location='index.php?page=kirim_pinjam_barang&pilihan=$_POST[pilihan]&tgl1=$_POST[tgl1]&tgl2=$_POST[tgl2]&tampil=$_POST[tampil]'</script>";
		}
		 else {
		echo "<script>window.location='index.php?page=kirim_pinjam_barang&pilihan=$_POST[pilihan]&kunci=$_POST[kata_kunci]&tampil=$_POST[tampil]'</script>";
		}
		
	}

if (isset($_GET['id_b_s'])) {
	$q=mysqli_query($koneksi, "update barang_pinjam_kirim set tgl_sampai='' where id=".$_GET['id_b_s']."");
	if ($q) {
		echo "<script>window.location='index.php?page=kirim_barang_pinjam'</script>";
		}
	}
if (isset($_GET['id_hapus'])) {
	$sel = mysqli_query($koneksi, "update barang_pinjam_kirim_detail,barang_pinjam_detail set barang_pinjam_detail.status_kirim=0 where barang_pinjam_detail.barang_gudang_detail_id and barang_pinjam_kirim_detail.barang_gudang_detail_id and barang_pinjam_kirim_id=".$_GET['id_hapus']."");
	
	if ($sel) {
		$del1=mysqli_query($koneksi, "delete from barang_pinjam_kirim_detail where barang_pinjam_kirim_id=".$_GET['id_hapus']."");
	$del2=mysqli_query($koneksi, "delete from barang_pinjam_kirim where id=".$_GET['id_hapus']."");
		echo "<script>
		alert('Data berhasil di hapus !');
		window.location='index.php?page=kirim_pinjam_barang'</script>";
		}
	else {
		echo "<script>
		alert('Data tidak dapat di hapus !');
		window.location='index.php?page=kirim_pinjam_barang'</script>";
		}
	
	//$q2 = mysqli_query($koneksi, "select * from barang_dikirim,barang_dikirm_detail,barang_gudang_detail,barang_gudang where barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim.id=".$_GET['id_hapus']."");
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pengiriman Barang Pinjaman
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kirim Barang Pinjaman</li>
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
              <?php if (isset($_GET['kunci']) or isset($_GET['tgl1'])) { ?>
              <a href="?page=kirim_pinjam_barang"><button class="btn btn-info pull pull-right"><span class="fa fa-refresh"></span> Reset</button></a>&nbsp;&nbsp;
              <?php } ?>
              <button class="btn btn-success pull pull-right" data-toggle="modal" data-target="#modal-pencarian"><span class="fa fa-search"></span> Pencarian</button>
              <?php if (isset($_GET['kunci']) or isset($_GET['tgl1'])) { ?>
              <div class="pull pull-left">Data Berdasarkan : <?php 
			  if ($_GET['pilihan']=='no_pengiriman') {echo "<u><em>Nomor Surat Jalan</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='nama_pembeli') {echo "<u><em>Lokasi Tujuan</em></u>";}
			  elseif ($_GET['pilihan']=='nama_brg') {echo "<u><em>Nama Barang</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='tipe_brg') {echo "<u><em>Tipe Barang</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='no_seri_brg') {echo "<u><em>No. Seri Barang</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='tgl_kirim') {
				  $tgl11=date("d/m/Y",strtotime($_GET['tgl1']));
				  $tgl22=date("d/m/Y",strtotime($_GET['tgl2']));
				  echo "<u><em>Rentang Tanggal Kirim : $tgl11 - $tgl22</em></u>";
				  }
			  else {
				  $tgl11=date("d/m/Y",strtotime($_GET['tgl1']));
				  $tgl22=date("d/m/Y",strtotime($_GET['tgl2']));
				  echo "<u><em>Rentang Tanggal Sampai : $tgl11 - $tgl22</em></u>";}
			  echo "<u><em>".$_GET['kunci']."</em></u>"; ?></div>
              <?php } ?>
              <br />
              <br />
              <div class="box-body table-responsive no-padding">
              <div class="">
              <!--<a href="index.php?page=tambah_barang_kirim">
              <button name="tambah_laporan" class="btn btn-warning" type="submit"><span class="fa fa-plus"></span> Kirim Alkes</button></a><br /><br />-->
              <table width="100%" id="<?php if (isset($_GET['pilihan']) or isset($_GET['tgl1'])){echo "example1";} else {echo "example3";} ?>" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th align="center">No</th>
        
        <th bgcolor="#99FFCC">Tanggal Kirim</th>
        <th>Nama Paket</th>
        <th>No_Surat_Jalan</th>
        <th>Barang</th>
      <th><strong>Lokasi Tujuan</strong></th>
      <th>Kontak</th>
      <th>Pengiriman</th>
      <th bgcolor="#99FFCC"><strong>Tanggal Sampai</strong></th>
      <th align="center">Keterangan</th>
      <th align="center"><strong>Aksi</strong></th>
        </tr>
  </thead>
  <?php
// membuka file JSON
if (isset($_GET['pilihan']) and isset($_GET['kunci'])) {
	$file = file_get_contents("http://localhost/ALKES/json/kirim_barang_pinjam.php?pilihan=$_GET[pilihan]&kunci=".str_replace(" ","%20",$_GET['kunci'])."");
}
elseif (isset($_GET['pilihan']) and isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
	$file = file_get_contents("http://localhost/ALKES/json/kirim_barang_pinjam.php?pilihan=$_GET[pilihan]&tgl1=".$_GET['tgl1']."&tgl2=".$_GET['tgl2']."");
}
else {
$file = file_get_contents("http://localhost/ALKES/json/kirim_barang_pinjam.php");
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
    <?php if ($_GET['tampil']==1) { ?>
    <?php 
	  $q23=mysqli_query($koneksi, "select nama_brg,no_seri_brg,status_kembali,tipe_brg from barang_gudang,barang_gudang_detail,barang_pinjam_kirim_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_pinjam_kirim_detail.barang_gudang_detail_id and barang_pinjam_kirim_id=".$json[$i]['idd']."");
	  $n2=0;
	  while ($d1=mysqli_fetch_array($q23)) {
	  $n2++;
	  ?>
      <?php if ($d1['status_batal']==1) { ?>
        <font class="pull pull-right" size="" color="#FF0000">(Batal)</font>
        <?php } ?>
      <?php echo $n2.".[".$d1['nama_brg']."]-[".$d1['tipe_brg']."]-[".$d1['no_seri_brg']."]"; ?>
      <hr style="margin:0px; border-top:1px double; width:100%"/>
      <?php } ?>
    <?php } else { ?>
    <a href="#" data-toggle="modal" data-target="#modal-detailbarang<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Detail Barang" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a>
    <?php } ?>
    </td>
    <td><?php 
	$data3=mysqli_fetch_array(mysqli_query($koneksi, "select nama_pembeli,kontak_rs from pembeli,barang_pinjam_kirim where pembeli.id=barang_pinjam_kirim.pembeli_id and barang_pinjam_kirim.id=".$json[$i]['idd'].""));
	echo $data3['nama_pembeli']; ?></td>
    <td><?php echo $data3['kontak_rs']; ?></td>
    <td>
    <a href="#" data-toggle="modal" data-target="#modal-pengiriman<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Detail Barang" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a>
    </td>
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
    <td><?php echo $json[$i]['keterangan']; ?></td>
    <td align="center">
    <?php if (!isset($_SESSION['user_cs'])) { ?>
    <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator']) or isset($_SESSION['user_admin_gudang'])) { ?>
    <a href="index.php?page=kirim_pinjam_barang&id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;&nbsp;
    <?php } ?>
    <a href="index.php?page=ubah_kirim_pinjam_barang&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a><br />
    
      <?php /* if (isset($_GET['id_krm'])) { ?>
      <a href="index.php?page=kirim_barang_pinjam&id=<?php echo $json[$i]['idd']; ?>&id_krm=<?php echo $_GET['id_krm']; ?>#openSampai"><span data-toggle="tooltip" title="Status : Sudah Sampai" class="fa fa-calendar-check-o"></span></a>&nbsp;&nbsp;
      <?php } else { ?>
      <a href="index.php?page=kirim_barang_pinjam&id=<?php echo $json[$i]['idd']; ?>#openSampai">
      <span data-toggle="tooltip" title="Status : Sudah Sampai" class="fa fa-calendar-check-o"></span>
      </a>&nbsp;&nbsp;
      <?php } */?>
      <!--<a href="index.php?page=kirim_barang_pinjam&id_b_s=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Yakin Akan Membatalkan Tanggal Sampai Barang !')">
      <span data-toggle="tooltip" title="Status : Belum Sampai" class="fa fa-calendar-times-o"></span>
      </a><br />-->
      <a href="cetak_surat_jalan_pinjam.php?id=<?php echo $json[$i]['idd']; ?>" target="_blank"><span data-toggle="tooltip" title="Cetak Surat Jalan" class="fa fa-print"></span></a><br />
      <?php	if ($json[$i]['tgl_sampai']!=0000-00-00) { ?>
      <a href="index.php?page=pilih_barang_pinjam_kembali&id=<?php echo $json[$i]['idd']; ?>&hapus_all=1"><small data-toggle="tooltip" title="" class="label bg-green"> Kembali</small></a>
      <?php } } ?>
    </td>
  </tr>
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
	  $q=mysqli_query($koneksi, "select nama_brg,no_seri_brg,status_kembali,tipe_brg from barang_gudang,barang_gudang_detail,barang_pinjam_kirim_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_pinjam_kirim_detail.barang_gudang_detail_id and barang_pinjam_kirim_id=".$json[$i]['idd']."");
	  $n=0;
	  while ($d1=mysqli_fetch_array($q)) {
	  $n++;
	  ?>
      <?php if ($d1['status_kembali']==1) { ?>
        <font class="pull pull-right">Sudah Kembali</font>
        <?php } ?>
      <?php echo $n.". ".$d1['nama_brg']."     |    "; ?></td>
      <?php echo $d1['tipe_brg']."  |  " ?></td>
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
        
        <div class="modal fade" id="modal-pengiriman<?php echo $json[$i]['idd']; ?>">
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
              <?php echo "<b>Biaya Pengiriman :</b> <br/>".number_format($json[$i]['biaya_pengiriman'],0,',','.'); ?>
      
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
  if (isset($_POST['sampai_barang'])) {
	  $tgl_k = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_pinjam_kirim where id=".$_GET['id'].""));
	  if ($_POST['tgl_sampai']>=$tgl_k['tgl_kirim']) {
	  $que = mysqli_query($koneksi, "update barang_pinjam_kirim set tgl_sampai='".$_POST['tgl_sampai']."' where id=".$_GET['id']."");
	  if ($que) {
		  //mysqli_query($koneksi, "insert into uji_f_i values('','".$_GET['id']."','0','0','')");
		  echo "<script type='text/javascript'>
		  window.location='index.php?page=kirim_barang_pinjam'
		  </script>";
		  }
	  	} else {
			echo "<script type='text/javascript'>alert('Tanggal Sampai Tidak Boleh Kurang Dari Tanggal Pengiriman !');
		  </script>";
			}
	  }
  ?>
  <div id="openSampai" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Status Alkes</h3>
        <?php $d=mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_pinjam_kirim where id=".$_GET['id']."")); ?> 
     <form method="post">
     <label>Tanggal Sampai</label>
     <input id="input" type="date" placeholder="" name="tgl_sampai" required value="<?php echo $d['tgl_sampai']; ?>">
     
        <button id="buttonn" name="sampai_barang" type="submit">Simpan</button>
    </form>
    </div>
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
				  if (document.getElementById('yesCheck').value=='tgl_kirim' || document.getElementById('yesCheck').value=='tgl_sampai') {
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
                <option value="tgl_sampai">Berdasarkan Rentang Tanggal Sampai</option>
                <option value="no_pengiriman">Berdasarkan Nomor Surat Jalan</option>
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
                <option value="0">Tidak Tampilkan Detail Barang</option>
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