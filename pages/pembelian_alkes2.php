<?php
if (isset($_POST['pencarian'])) {
		if ($_POST['pilihan']=='tgl_jual') {
		echo "<script>window.location='index.php?page=$_GET[page]&tgl1=$_POST[tgl1]&tgl2=$_POST[tgl2]&tampil=$_POST[tampil]'</script>";
		} else {
		echo "<script>window.location='index.php?page=$_GET[page]&pilihan=$_POST[pilihan]&kunci=$_POST[kata_kunci]&tampil=$_POST[tampil]'</script>";
		}
		
	}

if (isset($_POST['batal'])) {
	$up=mysqli_query($koneksi, "update barang_pesan set status_po_batal=1,deskripsi_batal='".$_POST['deskripsi']."' where id=".$_POST['id_batal']."");
	if ($up) {
		echo "<script>window.location='index.php?page=pembelian_alkes2'</script>";
		} 
	}
	 
if (isset($_GET['id_hapus'])) {
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select no_po_pesan from barang_pesan where id=".$_GET['id_hapus'].""));
	$del0 = mysqli_query($koneksi, "delete from utang_piutang where no_faktur_no_po='".$sel['no_po_pesan']."'");
	$del2 = mysqli_query($koneksi, "delete from barang_pesan_detail where barang_pesan_id=".$_GET['id_hapus']."");
	$del = mysqli_query($koneksi, "delete from barang_pesan where id=".$_GET['id_hapus']."");
	if ($del0 and $del and $del2){
		echo "<script>
		alert('Berhasil Di Hapus');
		window.location='index.php?page=pembelian_alkes2'</script>";
		}
	else {
		echo "<script>
		alert('Gagal Di Hapus');
		window.location='index.php?page=pembelian_alkes'</script>";
		}
	}
if (isset($_GET['id_pulih'])) {
	$up=mysqli_query($koneksi, "update barang_pesan set status_po_batal=0,deskripsi_batal='' where id=".$_GET['id_pulih']."");
	if ($up) {
		echo "<script>window.location='index.php?page=pembelian_alkes2'</script>";
		} 
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      PO Luar Negeri</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pemesanan Alkes</li>
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
              <a href="?page=tambah_pembelian_alkes2_sudah_ada"><button name="tambah_laporan" class="btn btn-success" type="button"><span class="fa fa-plus"></span> Tambah</button>
              </a>
             <span class="pull pull-right">
              <table>
  <tr>
    <td><strong style="color:#F00">Keterangan</strong> : &nbsp;&nbsp;&nbsp;</td>
    <td valign="top">1. </td>
    <td valign="top">Jika Baris Berwarna <strong>Merah</strong> , menandakan PO Sudah Dibatalkan</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td valign="top">2. </td>
    <td valign="top"><strong>Status Batal</strong> Hanya Berlaku Jika :<br />
    1. Belum Dilakukan Pembayaran Oleh Keuangan<br />
    2. Belum Di Mutasi Oleh Gudang</td>
  </tr>
</table>
             </span>
              <br /><br /><br /><br />
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
                           
             <div class="table-responsive no-padding">
             <table width="100%" id="" class="table table-bordered">
  <thead>
    <tr>
      <td align="center">#</td>
        <th valign="top"><strong>Tgl PO</strong></th>
        <th valign="top">No PO</th>
      <th valign="top"><strong>Principle</strong></th>
      <th valign="top">Barang</th>
      <th align="center" valign="top"><strong>PPN</strong></th>
        
        <th align="center" valign="top"><strong>Cara Pembayaran (COD/Tempo)</strong></th>
        <th align="center" valign="top"><strong> Pengiriman</strong></th>
        <th align="center" valign="top">Keuangan</th>
        <th align="center" valign="top"><strong>Aksi</strong></th>
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
if ($json[$i]['status_po_batal']==1) {
	$bg="#FF3333";
	}
	else {
		$bg="";
		}
?>
  <tr bgcolor="<?php echo $bg; ?>">
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
    <td><?php echo date("d/m/Y",strtotime($json[$i]['tgl_po_pesan'])); ?>
    </td>
    <td><?php echo $json[$i]['no_po_pesan']; ?></td>
    
      <td><a href="#" data-toggle="modal" data-target="#modal-principle<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Detail Principle" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a></td>
    <td>
    <?php if ($_GET['tampil']==1) { ?>
    <?php 
	  $q23=mysqli_query($koneksi, "select nama_brg,tipe_brg,qty,status_ke_stok from barang_pesan_detail,barang_gudang where barang_gudang.id=barang_pesan_detail.barang_gudang_id and barang_pesan_detail.barang_pesan_id=".$json[$i]['idd']."");
	  $n2=0;
	  while ($d1=mysqli_fetch_array($q23)) {
	  $n2++;
	  ?>
      <?php if ($d1['status_ke_stok']==1) { ?>
        <font class="pull pull-right" size="+1"><span class="fa fa-share"></span></font>
        <?php } ?>
      <?php echo $n2.".[".$d1['nama_brg']."]-[".$d1['tipe_brg']."]-[".$d1['qty']; ?>
      <hr style="margin:0px; border-top:1px double; width:100%"/>
      <?php } ?>
    <?php } else { ?>
    <a href="#" data-toggle="modal" data-target="#modal-detailbarang<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Detail Barang" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a>
    <?php } ?>
    </td>
    <td align="center"><?php echo $json[$i]['ppn']."%"; ?></td>
    <td align="center"><?php echo $json[$i]['cara_pembayaran']; ?></td>
    <td><a href="#" data-toggle="modal" data-target="#modal-pengiriman<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Detail Barang" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a></td>
    <td align="center"><?php if ($json[$i]['nilai_tukar']!=0) {echo "<i class='fa fa-check'></i>";} ?></td>
    <td align="center">
    <?php if ($json[$i]['status_po_batal']==0) { ?>
	<?php if (isset($_SESSION['pass_administrator'])) { ?>
    <a href="index.php?page=pembelian_alkes2&id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;<?php } ?>
    <?php
    $cek_uang = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_pesan,utang_piutang,utang_piutang_bayar where barang_pesan.no_po_pesan=utang_piutang.no_faktur_no_po and utang_piutang.id=utang_piutang_bayar.utang_piutang_id and no_po_pesan='".$json[$i]['no_po_pesan']."'"));
	if ($cek_uang==0 and isset($_SESSION['adminpoluar']) or isset($_SESSION['user_administrator'])) {
	?>
    <a href="index.php?page=ubah_pembelian_alkes2&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>
    <?php } ?>
    <br />
    <a href="cetak_surat_po_pemesanan.php?id=<?php echo $json[$i]['idd']; ?>" target="_blank"><span data-toggle="tooltip" title="Cetak PO" class="fa fa-print"></span></a>
    <?php 
	$j_cek=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_pesan_detail,barang_gudang where barang_gudang.id=barang_pesan_detail.barang_gudang_id and barang_pesan_detail.barang_pesan_id=".$json[$i]['idd']." and status_ke_stok=1"));
	if ($cek_uang==0 and $j_cek==0) { ?>
    <br />
    <!--<a href="index.php?page=pembelian_alkes2&id=<?php echo $json[$i]['idd']; ?>#openBatal"><small data-toggle="tooltip" title="Batalkan PO" class="label bg-red">Batalkan</small></a>-->
    <a href="#" data-toggle="modal" data-target="#modal-batalpo<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Batalkan PO" class="label bg-red">Batalkan</small></a>
    <?php } } else { ?>
    <a href="index.php?page=pembelian_alkes2&id_pulih=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda yakin akan memulihkan PO ini ?')"><small data-toggle="tooltip" title="Pulihkan PO" class="label bg-green">Pulihkan PO</small></a>
	<?php if ($json[$i]['deskripsi_batal']!='') {
		?><br /><a href="#" data-toggle="modal" data-target="#modal-pesanbatal<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Lihat Alasan" class="label bg-primary"><span class="fa fa-envelope"></span></small></a><?php
		} } ?>
    </td>
  </tr>
  <div class="modal fade" id="modal-pesanbatal<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Alasan Pembatalan</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <p align="justify">
              <?php echo $json[$i]['deskripsi_batal']; ?>
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
  
  <div class="modal fade" id="modal-batalpo<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pembatalan PO Pembelian</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <input type="hidden" name="id_batal" value="<?php echo $json[$i]['idd'] ?>"/>
              <textarea class="form-control" rows="4" name="deskripsi" style="width:100%"></textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button name="batal" type="submit" class="btn btn-success">Simpan</button>
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
	  $q=mysqli_query($koneksi, "select nama_brg,tipe_brg,qty,status_ke_stok from barang_pesan_detail,barang_gudang where barang_gudang.id=barang_pesan_detail.barang_gudang_id and barang_pesan_detail.barang_pesan_id=".$json[$i]['idd']."");
	  $n=0;
	  while ($d1=mysqli_fetch_array($q)) {
	  $n++;
	  ?>
      <?php if ($d1['status_ke_stok']==1) { ?>
        <font class="pull pull-right" size="+1"><span class="fa fa-share"></span></font>
        <?php } ?>
      <?php echo $n.". ".$d1['nama_brg']."     |    "; ?>
      <?php echo $d1['tipe_brg']."  |  " ?>
      <?php echo $d1['qty']."  |  "; ?>
      
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
        
        <div class="modal fade" id="modal-principle<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Data Principle</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <p align="justify">
              <?php 
	  $sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from principle where id=".$json[$i]['principle_id'].""));
	  echo "<b>Nama Principle :</b> <br/>".$sel['nama_principle']; ?>
      <hr />
      <?php echo "<b>Alamat Principle :</b> <br/>".$sel['alamat_principle']; ?>
      <hr />
      <?php echo "<b>Telepon Principle :</b> <br/>".$sel['telp_principle']; ?>
      <hr />
      <?php echo "<b>Fax Principle :</b> <br/>".$sel['fax_principle']; ?>
      <hr />
      <?php echo "<b>Attn Principle :</b> <br/>".$sel['attn_principle']; ?>
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
	  echo "<b>Alamat Pengiriman :</b> <br/>".$json[$i]['alamat_pengiriman']; ?>
      <hr />
      <?php echo "<b>Jalur Pengiriman :</b> <br/>".$json[$i]['jalur_pengiriman']; ?>
      <hr />
      <?php echo "<b>Estimasi Pengiriman :</b> <br/>"; ?>
      <?php 
	if ($json[$i]['estimasi_pengiriman']!=0000-00-00) {
	echo date("d/m/Y",strtotime($json[$i]['estimasi_pengiriman'])); } ?>
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
                <br />

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
$queryy = mysqli_query($koneksi, "select *,barang_pesan.id as idd from barang_pesan,barang_pesan_detail,barang_gudang,principle where barang_pesan.id=barang_pesan_detail.barang_pesan_id and barang_gudang.id=barang_pesan_detail.barang_gudang_id and principle.id=barang_pesan.principle_id and barang_pesan.jenis_po='Luar Negeri' and tgl_po_pesan between '$_GET[tgl1]' and '$_GET[tgl2]' group by barang_pesan.id order by tgl_po_pesan DESC, barang_pesan.id DESC");
	}
	elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
$queryy = mysqli_query($koneksi, "select *,barang_pesan.id as idd from barang_pesan,barang_pesan_detail,barang_gudang,principle where barang_pesan.id=barang_pesan_detail.barang_pesan_id and barang_gudang.id=barang_pesan_detail.barang_gudang_id and principle.id=barang_pesan.principle_id and barang_pesan.jenis_po='Luar Negeri' and $_GET[pilihan] like '%$_GET[kunci]%' group by barang_pesan.id order by tgl_po_pesan DESC, barang_pesan.id DESC");
	}
	else {
	$queryy = mysqli_query($koneksi, "select *,barang_pesan.id as idd from barang_pesan where jenis_po='Luar Negeri' order by tgl_po_pesan DESC, barang_pesan.id DESC");
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
        
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

  </section>
    <!-- /.content -->
  </div>
 

<div class="modal fade" id="modal-pilihan">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pilih Principle</h4>
              </div>
              <div class="modal-body">
                <a href="index.php?page=tambah_pembelian_alkes2"><button id="buttonn">Data Principle Baru</button></a>
                <a href="index.php?page=tambah_pembelian_alkes2_sudah_ada">
                <button id="buttonn">Dari Data Principle<br />Yang Sudah Terinput</button></a>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        
        <div class="modal fade" id="modal-pencarian">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              <script type="text/javascript">
			  function yesnoCheck() {
				  if (document.getElementById('yesCheck').value=='tgl_po_pesan') {
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
                <option value="tgl_po_pesan">Berdasarkan Rentang Tanggal PO</option>
                <option value="no_po_pesan">Berdasarkan Nomor PO</option>
                <option value="nama_principle">Berdasarkan Nama Principle</option>
                <option value="nama_brg">Berdasarkan Nama Barang</option>
                <option value="merk_brg">Berdasarkan Merk Barang</option>
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



