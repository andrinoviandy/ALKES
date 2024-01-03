<?php
if (isset($_POST['pencarian'])) {
		if ($_POST['pilihan']=='tgl_jual') {
		echo "<script>window.location='index.php?page=$_GET[page]&tgl1=$_POST[tgl1]&tgl2=$_POST[tgl2]&tampil=$_POST[tampil]'</script>";
		}
		elseif ($_POST['pilihan']=='status') {
		echo "<script>window.location='index.php?page=$_GET[page]&status_barang=$_POST[status_barang]&tampil=$_POST[tampil]'</script>";
		}
		 else {
		echo "<script>window.location='index.php?page=$_GET[page]&pilihan=$_POST[pilihan]&kunci=$_POST[kata_kunci]&tampil=$_POST[tampil]'</script>";
		}
	}

if (isset($_POST['kirim_barang'])) {
	mysqli_query($koneksi, "delete from barang_dikirim_detail_hash where akun_id=".$_SESSION['id']."");
	
	$_SESSION['nama_paket']=$_POST['nama_paket'];
	$_SESSION['no_pengiriman']=$_POST['no_peng'];
	$_SESSION['ekspedisi']=$_POST['ekspedisi'];
	$_SESSION['tgl_pengiriman']=$_POST['tgl_kirim'];
	$_SESSION['via_pengiriman']=$_POST['via_kirim'];
	$_SESSION['estimasi']=$_POST['estimasi_brg_sampai'];
	$_SESSION['biaya_kirim']=str_replace(".","",$_POST['biaya_kirim']);
	$_SESSION['no_po']=$_POST['no_po'];
	
	echo "<script type='text/javascript'>
		window.location='index.php?page=pilih_no_seri&id=".$_POST['id_kirim']."';
		</script>";
} 
 
if (isset($_GET['id_batal'])) {
	$se = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_detail where status_kirim=1 and barang_dijual_id=".$_GET['id_batal'].""));
	if ($se!=0) {
		echo "<script>alert('Data tidak dapat dibatalkan karena sudah dikirim ! Silakan batalkan proses kirim terlebih dahulu !');
		window.location='index.php?page=jual_barang';
		</script>";
		}
	else {
		$sd = mysqli_query($koneksi, "select * from barang_dijual_detail where status_kirim=0 and barang_dijual_id=".$_GET['id_batal']."");
		while ($da = mysqli_fetch_array($sd)) {
			$upp=mysqli_query($koneksi, "update barang_gudang_detail,barang_gudang set stok_total=stok_total+1, status_terjual=0 where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=".$da['barang_gudang_detail_id']."");
			}
		if ($upp) {
			mysqli_query($koneksi, "delete from barang_dijual_detail where barang_dijual_id=".$_GET['id_batal']."");
			mysqli_query($koneksi, "delete from barang_dijual where id=".$_GET['id_batal']."");
			echo "<script>alert('Pembatalan berhasil !');
		window.location='index.php?page=jual_barang';
		</script>";
			}
			else {
				echo "<script>alert('Pembatalan Gagal !');
		window.location='index.php?page=jual_barang';
		</script>";
				}
		}
	}

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pengiriman Alkes
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Jual Alkes</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
      <section class="col-lg-12">
        <div class="box box-body">
          <form method="post" action="cetak_marketing.php">
              <div class="input-group pull pull-left col-xs-3">  
                <select class="form-control select2" name="marketing" style="margin-right:40px">
                <option value="all">All Marketing</option>
                <?php 
				$q = mysqli_query($koneksi, "select marketing,subdis from barang_dijual group by marketing order by marketing ASC");
				while ($d = mysqli_fetch_array($q)) {
				?>
                <option value="<?php echo $d['marketing']; ?>"><?php echo $d['marketing']; ?></option>
                <?php } ?>
                </select><br />
                <select class="form-control select2" name="tahun" style="margin-right:40px">
                <?php
                $t1 = mysqli_fetch_array(mysqli_query($koneksi, "select min(tgl_jual) as tgl_min from barang_dijual"));
				$t2 = mysqli_fetch_array(mysqli_query($koneksi, "select max(tgl_jual) as tgl_max from barang_dijual"));
				$thn1 = date("Y",strtotime($t1['tgl_min']));
				$thn2 = date("Y",strtotime($t2['tgl_max']));
				for ($i=$thn1; $i<=$thn2; $i++) {
				?>
                <option <?php if (date("Y")==$i) {echo "selected";} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
                </select>
                <span class="input-group-btn">
                      <button type="submit" name="button_urut" class="btn btn-warning" style="padding-top:22px; padding-bottom:22px">Cetak</button>
                </span>
                
              </div>
              </form>
              <?php //} ?>
              <br /><br /><br /><br />
              <div class="pull pull-left">
              <button class="btn btn-info" data-toggle="modal" data-target="#modal-cetak"><span class="fa fa-print"></span> Cetak</button>
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
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-info"><!-- /.chat -->
            <div class="box-footer">
              <div class="box-body">
              <div class="">
              
               <div class="table-responsive no-padding">
               <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th align="center">No</th>
      <th align="center"><strong>Tanggal Jual</strong></th>
      <th align="center">No PO</th>
      <th align="center">Barang</th>
      <th align="center">Sisa Kirim</th>
      <th align="center"><strong>Dinas/RS/Puskemas/Klinik</strong></th>
      <th align="center">Marketing</th>
      <th align="center">SubDis</th>
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
elseif (isset($_GET['status_barang'])) {
	$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]&status_barang=$_GET[status_barang]");
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
    <td>
    <?php if ($json[$i]['tgl_jual']!='0000-00-00') { echo date("d/M/Y",strtotime($json[$i]['tgl_jual']));}	
	?>
    </td>
    <td><?php echo $json[$i]['no_po_jual'];
	?></td>
    <td>
    <?php if ($_GET['tampil']==1) { ?>
    <?php 
	  $q23=mysqli_query($koneksi, "select *,barang_dijual_qty.id as id_det_jual from barang_dijual_qty,barang_dijual,barang_gudang where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual_qty.barang_dijual_id=".$json[$i]['idd']."");
	  $n2=0;
	  while ($d1=mysqli_fetch_array($q23)) {
	  $n2++;
	  ?>
      <?php if ($d1['status_kembali_ke_gudang']==1) { ?>
        <font class="pull pull-right" size="1px" color="#FF0000">(Kembali Ke Gudang)</font>
        <?php } ?>
      <?php echo $n2.".[".$d1['nama_brg']."]-[".$d1['tipe_brg']."]-[".$d1['qty_jual']."]"; ?>
      <hr style="margin:0px; border-top:1px double; width:100%"/>
      <?php } ?>
    <?php } else { ?>
    <a href="#" data-toggle="modal" data-target="#modal-detailbarang<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Detail Barang" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a>
    <?php } ?>
    </td>
    <td>
    <?php if ($_GET['tampil']==1) { ?>
    <?php 
	  $q24=mysqli_query($koneksi, "select *,barang_dijual_qty.id as id_det_jual from barang_dijual_qty,barang_dijual,barang_gudang where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual_qty.barang_dijual_id=".$json[$i]['idd']."");
	  $nn2=0;
	  while ($d1=mysqli_fetch_array($q24)) {
	  $nn2++;
	  $q4 = mysqli_num_rows(mysqli_query($koneksi , "select * from barang_dikirim_detail where barang_dijual_qty_id=".$d1['id_det_jual'].""));
	  ?>
      <?php if ($d1['status_kembali_ke_gudang']==1) { ?>
        <font class="pull pull-right" size="1px" color="#FF0000">(Kembali Ke Gudang)</font>
        <?php } ?>
        <font class="pull pull-right" size="2px">
        <?php
		if ($d1['qty_jual']-$q4==0) {
			echo "<span class='fa fa-check'></span>";
			} ?>
            </font>
      <?php if ($d1['qty_jual']-$q4!=0) {echo "<div class='btn-danger'>";} ?>
      <?php echo $nn2.".[".$d1['nama_brg']."]-["; ?>
      <?php echo $d1['qty_jual']-$q4."]"; ?>
      <?php if ($d1['qty_jual']-$q4!=0) {echo "</div>";} ?>
      <hr style="margin:0px; border-top:1px double"/>
      <?php } ?>
    <?php } else { ?>
    <a href="#" data-toggle="modal" data-target="#modal-sisakirim<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Detail Barang" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a>
    <?php } ?>
    </td>
    <td><a href="#" data-toggle="modal" data-target="#modal-pembeli<?php echo $json[$i]['idd']; ?>" style="color:#060" title="Klik Untuk Lebih Lengkap"><u><?php 
	$data_pem=mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dijual,pembeli,pemakai where pembeli.id=barang_dijual.pembeli_id and pemakai.id=barang_dijual.pemakai_id and barang_dijual.id=".$json[$i]['idd'].""));
	echo $data_pem['nama_pembeli']; ?></u></a></td>
    <td><?php echo $json[$i]['marketing'];
	?></td>
    <td><?php echo $json[$i]['subdis'];
	?></td>
    
    <td align="center">
    <?php /*if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator']) or isset($_SESSION['user_admin_keuangan']) && isset($_SESSION['pass_admin_keuangan'])) { ?>
    <!--<a href="pages/delete_barang_jual.php?id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;-->
    <a href="index.php?page=ubah_barang_jual2&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp;<a href="index.php?page=jual_barang&id_batal=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Yakin Akan Membatalkan Semua Penjualan Item Ini ?')"><span data-toggle="tooltip" title="Batalkan Penjualan" class="fa fa-close"></span></a><br /><?php } ?><?php 
	if (!isset($_SESSION['user_admin_keuangan'])) { ?><a href="index.php?page=kartu_garansi&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Cetak Kartu Garansi" class="fa fa-print"></span></a>&nbsp;&nbsp;<?php } ?><?php if (!isset($_SESSION['user_admin_gudang'])) { ?><a target="blank" href="cetak_faktur_penjualan.php?id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Cetak Faktur Penjualan" class="glyphicon glyphicon-print"></span></a><?php } */?>
      <?php 
	if (!isset($_SESSION['user_admin_keuangan'])) { ?> 
      <!--<a href="index.php?page=jual_barang&id=<?php echo $json[$i]['idd']; ?>#openKirim"><small data-toggle="tooltip" title="Kirim Alkes" class="label bg-blue">Kirim</small></a>-->
      <a href="#" data-toggle="modal" data-target="#modal-kirim<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Kirim Alkes" class="label bg-blue">Kirim</small></a><br />
      <a href="index.php?page=detail_jual_barang&id=<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Detail Kirim" class="label bg-yellow">Detail</small></a>
      <?php } ?>
    </td>
  </tr>
  <div class="modal fade" id="modal-pembeli<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Data RS/Dinas/Klinik/Dll</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <p align="justify">
              <?php 
	  echo "<b>Nama RS/Dinas/Klinik/Dll :</b> <br/>".$data_pem['nama_pembeli']; ?>
      <hr />
      <?php echo "<b>Alamat :</b> <br/>".str_replace("<br>","",$data_pem['jalan']); ?>
      <hr />
      <?php echo "<b>Kontak :</b> <br/>".$data_pem['kontak_rs']; ?>
      
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
                <h4 class="modal-title">Kirim Barang</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <input type="hidden" name="id_kirim" value="<?php echo $json[$i]['idd']; ?>" />
              <label>No. PO</label>
     <input id="input" type="text" placeholder="" readonly="readonly" name="no_po" value="<?php
	 echo $json[$i]['no_po_jual'];
	 ?>">
     <label>Nama Paket</label>
     <input id="input" type="text" placeholder="" name="nama_paket" required autofocus="autofocus">
     <label>No. Surat Jalan</label>
     <input id="input" type="text" placeholder="" name="no_peng" required>
     <label>Ekspedisi</label>
     <input id="input" type="text" placeholder="" name="ekspedisi" required>
     <label>Tanggal Pengiriman</label>
     <input id="input" type="date" placeholder="" name="tgl_kirim" required>
     <label>Via Pengiriman</label>
     <input id="input" type="text" placeholder="" name="via_kirim" required>
     <label>Estimasi Barang Sampai</label>
     <input id="input" type="date" placeholder="" name="estimasi_brg_sampai" >
     <label>Biaya Jasa</label>
     <input id="input" type="text" placeholder="" name="biaya_kirim" required="required" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
     
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button name="kirim_barang" type="submit" class="btn btn-success">Next</button>
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
	  $q2=mysqli_query($koneksi, "select *,barang_dijual_qty.id as id_det_jual from barang_dijual_qty,barang_dijual,barang_gudang where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual_qty.barang_dijual_id=".$json[$i]['idd']."");
	  $n=0;
	  while ($d1=mysqli_fetch_array($q2)) {
	  $n++;
	  ?>
      <?php if ($d1['status_kembali_ke_gudang']==1) { ?>
        <font class="pull pull-right" size="+1">Kembali Ke Gudang</font>
        <?php } ?>
      <?php echo $n.". ".$d1['nama_brg']."     |    "; ?></td>
      <?php echo $d1['tipe_brg']."  |  " ?></td>
      <?php echo $d1['qty_jual']."  |  "; ?>
      
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
        
        <div class="modal fade" id="modal-sisakirim<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Sisa Belum Di Kirim</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <p align="justify">
              
      <?php 
	  $q22=mysqli_query($koneksi, "select *,barang_dijual_qty.id as id_det_jual from barang_dijual_qty,barang_dijual,barang_gudang where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual_qty.barang_dijual_id=".$json[$i]['idd']."");
	  $nn=0;
	  while ($d1=mysqli_fetch_array($q22)) {
	  $nn++;
	  $q4 = mysqli_num_rows(mysqli_query($koneksi , "select * from barang_dikirim_detail where barang_dijual_qty_id=".$d1['id_det_jual'].""));
	  ?>
      <?php if ($d1['status_kembali_ke_gudang']==1) { ?>
        <font class="pull pull-right" size="+1">Kembali Ke Gudang</font>
        <?php } ?>
        <font class="pull pull-right" size="+1">
        <?php
		if ($d1['qty_jual']-$q4==0) {
			echo "<span class='fa fa-check'></span>";
			} ?>
            </font>
      <?php if ($d1['qty_jual']-$q4!=0) {echo "<div class='btn-danger'>";} ?>
      <?php echo $nn.". ".$d1['nama_brg']."     |    "; ?>
      <?php echo $d1['qty_jual']-$q4; ?>
      <?php if ($d1['qty_jual']-$q4!=0) {echo "</div>";} ?>
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
$queryy = mysqli_query($koneksi, "select *,barang_dijual.id as idd from barang_dijual,barang_dijual_qty,barang_gudang,pembeli where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and pembeli.id=barang_dijual.pembeli_id and status_deal=1 and tgl_jual between '$_GET[tgl1]' and '$_GET[tgl2]' group by no_po_jual order by tgl_jual DESC, barang_dijual.id DESC");
	}
	elseif (isset($_GET['status_barang'])) {
	if ($_GET['status_barang']=='Belum') {
	$sel = mysqli_query($koneksi, "select * from barang_dijual_qty");
	while ($d = mysqli_fetch_array($sel)) {
	$ss = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim_detail where barang_dijual_qty_id=$d[id]"));
	if ($ss==0) {
			$queryy = mysqli_query($koneksi, "select *,barang_dijual.id as idd from barang_dijual,barang_dijual_qty,barang_gudang,pembeli where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and pembeli.id=barang_dijual.pembeli_id and status_deal=1 and barang_dijual_qty.id=$d[id] group by no_po_jual order by tgl_jual DESC, barang_dijual.id DESC");
			}
		}	
	}
	elseif ($_GET['status_barang']=='Sudah') {
	$queryy = mysqli_query($koneksi, "select *,barang_dijual.id as idd from barang_dijual,barang_dijual_qty,barang_gudang,pembeli,barang_dikirim_detail where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and pembeli.id=barang_dijual.pembeli_id and status_deal=1 and barang_dijual_qty.id=barang_dikirim_detail.barang_dijual_qty_id group by no_po_jual order by tgl_jual DESC, barang_dijual.id DESC");
	}
	}
	elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
$queryy = mysqli_query($koneksi, "select *,barang_dijual.id as idd from barang_dijual,barang_dijual_qty,barang_gudang,pembeli where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and pembeli.id=barang_dijual.pembeli_id and status_deal=1 and $_GET[pilihan] like '%$_GET[kunci]%' group by no_po_jual order by tgl_jual DESC, barang_dijual.id DESC");
	}
	else {
	$queryy = mysqli_query($koneksi, "select *,barang_dijual.id as idd from barang_dijual where status_deal=1 group by no_po_jual order by tgl_jual DESC, barang_dijual.id DESC");
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
				  if (document.getElementById('yesCheck').value=='tgl_jual') {
					  document.getElementById('ifYes').style.display = 'block';
					  document.getElementById('kata_kunci').style.display = 'none';
					  document.getElementById('status').style.display = 'none';
					  }
					  else if (document.getElementById('yesCheck').value=='status')
					  { document.getElementById('ifYes').style.display = 'none';
					  document.getElementById('kata_kunci').style.display = 'none';
					  document.getElementById('status').style.display = 'block';
					  }
					  else 
					  { document.getElementById('ifYes').style.display = 'none';
					  document.getElementById('kata_kunci').style.display = 'block';
					  document.getElementById('status').style.display = 'none';
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
                <option value="tgl_jual">Berdasarkan Rentang Tanggal Jual</option>
                <option value="no_po_jual">Berdasarkan Nomor PO</option>
                <option value="nama_pembeli">Berdasarkan Nama RS/Dinas/Klink/Dll</option>
                <option value="nama_brg">Berdasarkan Nama Barang</option>
                <option value="tipe_brg">Berdasarkan Tipe Barang</option>
                <option value="marketing">Berdasarkan Marketing</option>
                <option value="status">Status Terkirim / Belum Terkirim</option>
                </select>
                <br /><br />
                <div id="kata_kunci" style="display:block">
                <input type="text" class="form-control" name="kata_kunci" placeholder="Kata Kunci"/>
                </div>
                <div id="status" style="display:none">
                <select name="status_barang" class="form-control select2" style="width:100%">
                <option value="">...</option>
                <option value="Belum">Belum Terkirim</option>
                <option value="Sudah">Sudah Terkirim</option>
                </select>
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
     <br />
     <br />
    </form>
    </div>
</div>

<div id="openPilihan" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <br />
        <a href="index.php?page=jual_alkes"><button id="buttonn">Data Dinas/RS/Puskesmas/Klinik Baru</button></a>
        <a href="index.php?page=jual_alkes2"><button id="buttonn">Dari Data Dinas/RS/Puskesmas/Klinik<br />Yang Sudah Terinput</button></a>
    </div>
</div>

