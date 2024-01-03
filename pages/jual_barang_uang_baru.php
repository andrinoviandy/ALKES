<?php
if (isset($_POST['pencarian'])) {
		if ($_POST['pilihan']=='tgl_jual') {
		echo "<script>window.location='index.php?page=jual_barang_uang&tgl1=$_POST[tgl1]&tgl2=$_POST[tgl2]&tampil=$_POST[tampil]'</script>";
		} else {
		echo "<script>window.location='index.php?page=jual_barang_uang&pilihan=$_POST[pilihan]&kunci=$_POST[kata_kunci]&tampil=$_POST[tampil]'</script>";
		}
	}

if (isset($_POST['cetak'])) {
		echo "<script>window.location='cetak_penjualan_barang.php?tgl1=$_POST[tgl_a]&tgl2=$_POST[tgl_b]'</script>";
		echo "";
	}
 
if (isset($_GET['id_batal'])) {
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dijual where id=".$_GET['id_batal'].""));
	$cek=mysqli_num_rows(mysqli_query($koneksi, "select * from utang_piutang,utang_piutang_bayar where utang_piutang.id=utang_piutang_bayar.utang_piutang_id and no_faktur_no_po='".$sel['no_po_jual']."'"));
	if ($cek==0) {
	$del1=mysqli_query($koneksi, "delete from barang_dijual_qty where barang_dijual_id=".$_GET['id_batal']."");
	$del2=mysqli_query($koneksi, "delete from barang_dijual where id=".$_GET['id_batal']."");
	
	if ($del1 and $del2) {
echo "<script type='text/javascript'>
alert('Berhasil di Dibatalkan !');
window.location='index.php?page=jual_barang_uang;</script>";
		}
	else {
			echo "<script type='text/javascript'>alert('Maaf Data Tidak Dapat Di Hapus , Karena Sudah Ada Pengiriman atau Sudah Ada Pembayaran! Silakan Cek Data Pengiriman atau Data Piutang');
		history.back();
		</script>";
		
			}
	} else {
		echo "<script type='text/javascript'>alert('Maaf Data Tidak Dapat Di Hapus , Karena Sudah Ada Pengiriman atau Sudah Ada Pembayaran! Silakan Cek Data Pengiriman atau Data Piutang');
		history.back();
		</script>";
		}
	/*$se = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_detail where status_kirim=1 and barang_dijual_id=".$_GET['id_batal'].""));
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
		}*/
	}
if (isset($_POST['pos'])) {
	$q = mysqli_query($koneksi, "select * from barang_dijual where id=".$_GET['id']."");
	if ($q) {
		echo "<script>
		window.location='index.php?page=tambah_pembelian';
		alert('Berhasil di Simpan !');
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Penjualan Alkes
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
          <div class="input-group pull pull-left col-xs-1" style="padding-right:10px">
            <a href="?page=jual_alkes2">
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah</button></a>
              
          </div>
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
              <span class="pull pull-right">
              <table>
  <tr>
    <td><strong style="color:#F00">Keterangan</strong> : &nbsp;&nbsp;&nbsp;</td>
    <td valign="top">1. </td>
    <td valign="top">Tanda &quot;<span class="fa fa-plane"></span>&quot; menandakan barang sudah di kirim</td>
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
              <div class="pull pull-left">
              <button class="btn btn-info" data-toggle="modal" data-target="#modal-cetak"><span class="fa fa-print"></span> Cetak</button>
              </div>
              <div class="pull pull-right">
              <button class="btn btn-success" data-toggle="modal" data-target="#modal-pencarian"><span class="fa fa-search"></span> Pencarian</button>&nbsp;&nbsp;
              <?php if (isset($_GET['kunci']) or isset($_GET['tgl1'])) { ?>
              <a href="?page=jual_barang_uang"><button class="btn btn-info"><span class="fa fa-refresh"></span> Reset</button></a>&nbsp;&nbsp;
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
              <!--<a href="index.php?page=tambah_barang_jual">
              <button name="tambah_laporan" class="btn btn-info" type="submit"><span class="fa fa-plus"></span> Jual Alkes</button>
              </a>-->
              <?php //if (isset($_SESSION['user_administrator']) or isset($_SESSION['user_admin_keuangan']) or isset($_SESSION['user_admin_gudang']) or isset($_SESSION['user_manajer_gudang'])) { ?>
              
              
              <div class="table-responsive">
              <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th align="center">#</th>
      <th align="center"><strong>Tanggal_Jual</strong></th>
      <th align="center">No PO</th>
      <th align="center">No_Kontrak</th>
      <!--<th align="center">No_PO</th>-->
      <th align="center">Barang</th>
      <th align="center"><strong>Dinas/RS/Puskemas/Klinik</strong></th>
      <th align="center">Nama Pemakai</th>
      <th align="center">Marketing</th>
      <th align="center">Subdis</th>
      
      <th align="center">Total Harga</th>
      <th align="center">Ongkir</th>
      <th align="center">DPP</th>
      <th align="center">Diskon</th>
      <th align="center">PPN</th>
      <th align="center">PPh</th>
      <th align="center">Zakat</th>
      <th align="center">Biaya Bank</th>
      <th align="center">Neto</th>
      <th align="center">Fee Subdis</th>
      
      <th align="center">Status Kirim</th>
      <th align="center">Instalasi<br />Uji_Fungsi</th>
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
    <td>
    <?php if ($json[$i]['tgl_jual']!='0000-00-00') { echo date("d F Y",strtotime($json[$i]['tgl_jual']));}	
	?>
    </td>
    <td><?php echo $json[$i]['no_po_jual'];
	?></td>
    <td><?php echo $json[$i]['no_kontrak'];
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
    <td><a href="#" data-toggle="modal" data-target="#modal-pembeli<?php echo $json[$i]['idd']; ?>" style="color:#060" title="Klik Untuk Lebih Lengkap"><u><?php 
	$data_pem=mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dijual,pembeli,pemakai where pembeli.id=barang_dijual.pembeli_id and pemakai.id=barang_dijual.pemakai_id and barang_dijual.id=".$json[$i]['idd'].""));
	echo $data_pem['nama_pembeli']; ?></u></a></td>
    <td><?php echo $data_pem['nama_pemakai']; ?></td>
    <td align="center"><?php echo $json[$i]['marketing']; ?></td>
    <td align="center"><?php echo $json[$i]['subdis']; ?></td>
    
    <td><?php echo number_format($json[$i]['total_harga'],0,',','.'); ?></td>
    <td><?php echo number_format($json[$i]['ongkir'],0,',','.'); ?></td>
    <td><?php $dpp = ($json[$i]['total_harga']+$json[$i]['ongkir'])/1.1; echo number_format(($json[$i]['total_harga']+$json[$i]['ongkir'])/1.1,2,',','.'); ?></td>
    <td><?php echo $json[$i]['diskon_jual']." %"; ?>
    </td>
    <td><?php echo $json[$i]['ppn_jual']." %"; ?><br />
    <?php echo "(".number_format(($json[$i]['ppn_jual']/100)*($dpp),2,',','.').")"; ?>
    </td>
    <td><?php echo $json[$i]['pph']." %"; ?><br />
    <?php echo "(".number_format($json[$i]['pph']/100*$dpp,2,',','.').")"; ?>
    </td>
    <td>
	<?php echo $json[$i]['zakat']." %"; ?><br />
	<?php echo "(".number_format($json[$i]['zakat']/100*$dpp,2,',','.').")"; ?></td>
    <td><?php echo number_format($json[$i]['biaya_bank'],0,',','.'); ?></td>
    <td><strong><?php echo number_format($json[$i]['neto'],0,',','.'); ?></strong></td>
    <td><?php 
	$dpp_m = $json[$i]['total_harga']/1.1;
	//$ppn_m = $dpp_m * $json[$i]['ppn_jual']/100;
	$pph_m = $dpp_m * $json[$i]['pph']/100;
	$zakat_m = $dpp_m * $json[$i]['zakat']/100;
	$biaya_bank_m = $json[$i]['biaya_bank'];
	$fee = ($dpp_m - ($pph_m+$zakat_m+$biaya_bank_m)) * $json[$i]['diskon_jual']/100;
	echo number_format($fee,0,',','.'); ?></td>
    
    <td align="center"><?php
    $ttl = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim where barang_dijual_id=".$json[$i]['idd'].""));
	$brg_sm = mysqli_fetch_array(mysqli_query($koneksi, "select tgl_sampai from barang_dikirim where barang_dijual_id=".$json[$i]['idd'].""));
	if ($ttl>0) {
	if ($brg_sm['tgl_sampai']!='0000-00-00') {
		echo "<span class='label bg-green'>Sudah Sampai</span><br>";
		echo date("d/m/Y",strtotime($brg_sm['tgl_sampai']));
		}
	else {
		echo "<span class='label bg-yellow'>Belum Sampai</span>";
		}
	} else {
		echo "<span class='label bg-red'>Proses</span>";
		}
	?></td>
    <td align="center"><a href="#" data-toggle="modal" data-target="#modal-detailuji<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Detail" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a></td>
    <td align="center">
    <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator']) or isset($_SESSION['user_admin_keuangan']) && isset($_SESSION['pass_admin_keuangan'])) { ?>
    <!--<a href="pages/delete_barang_jual.php?id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;-->
    <a href="index.php?page=ubah_jual_barang_uang&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp;<a href="index.php?page=jual_barang_uang&id_batal=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Yakin Akan Membatalkan Penjualan Item Ini ? . Proses ini akan berhasil jika bagian gudang belum memilih no seri atau belum ada pembayaran di keuangan !')"><span data-toggle="tooltip" title="Batalkan Penjualan" class="fa fa-close"></span></a><br /><?php } ?><?php if (!isset($_SESSION['user_admin_gudang'])) { ?><a target="blank" href="cetak_faktur_penjualan_uang.php?id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Cetak Faktur Penjualan" class="glyphicon glyphicon-print"></span></a><?php } ?>
      
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
        
        
        <div class="modal fade" id="modal-detailuji<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Instalasi & Uji Fungsi</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <p align="justify">
              
      <?php 
	  $qq2=mysqli_query($koneksi, "select *,barang_dijual_qty.id as id_det_jual from barang_dijual_qty,barang_dijual,barang_gudang where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual_qty.barang_dijual_id=".$json[$i]['idd']."");
	  $nn=0;
	  while ($d1=mysqli_fetch_array($qq2)) {
	  $nn++;
	  ?>
      
      <?php echo $nn.". ".$d1['nama_brg']."     |    "; ?></td>
      <?php echo $d1['tipe_brg']."  |  " ?></td>
      <?php echo $d1['qty_jual']."<br>"; ?>
      <div class="right" style="margin-left:20px">
	  <?php
      $qq = mysqli_query($koneksi, "select *,barang_teknisi_detail.id as id_dt from barang_gudang_detail,barang_dikirim_detail,barang_teknisi_detail where barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_dikirim_detail.barang_dijual_qty_id=".$d1['id_det_jual']."");
	  $m=0;
	  while ($dd = mysqli_fetch_array($qq)) {
		  $m++;
		  $ds = mysqli_num_rows(mysqli_query($koneksi, "select * from alat_uji_detail where barang_teknisi_detail_id=".$dd['id_dt'].""));
		  $dt = mysqli_fetch_array(mysqli_query($koneksi, "select tgl_i,tgl_f from alat_uji_detail where barang_teknisi_detail_id=".$dd['id_dt'].""));
		  if ($ds!=0) {
		  if ($dt['tgl_i']!='0000-00-00') {
			  $tgl_i=date("d/m/Y",strtotime($dt['tgl_i']));
			  }
			  else {$tgl_i="";}
			if ($dt['tgl_f']!='0000-00-00') {
			  $tgl_f=date("d/m/Y",strtotime($dt['tgl_f']));
			  }
			  else {$tgl_f="";}
		  } else {
			  $tgl_i="-";
			  $tgl_f="-";
			  }
		  echo $nn.".".$m.") &nbsp;".$dd['no_seri_brg']." | Instalasi : ".$tgl_i." | Uji Fungsi : ".$tgl_f."<br>";
		  }
	  ?>
      </div>
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
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        
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
$queryy = "select *,barang_dijual.id as idd from barang_dijual,barang_dijual_qty,barang_gudang,pembeli where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and pembeli.id=barang_dijual.pembeli_id and tgl_jual between '$_GET[tgl1]' and '$_GET[tgl2]' group by barang_dijual.id order by tgl_jual DESC, barang_dijual.id DESC";
	}
	elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
$queryy = "select *,barang_dijual.id as idd from barang_dijual,barang_dijual_qty,barang_gudang,pembeli where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and pembeli.id=barang_dijual.pembeli_id and $_GET[pilihan] like '%$_GET[kunci]%' group by barang_dijual.id order by tgl_jual DESC, barang_dijual.id DESC";
	}
	else {
	$queryy = mysqli_query($koneksi, "SELECT * FROM barang_dijual");
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
                <option value="tgl_jual">Berdasarkan Rentang Tanggal Jual</option>
                <option value="no_po_jual">Berdasarkan Nomor PO</option>
                <option value="nama_pembeli">Berdasarkan Nama RS/Dinas/Klink/Dll</option>
                <option value="nama_brg">Berdasarkan Nama Barang</option>
                <option value="tipe_brg">Berdasarkan Tipe Barang</option>
                <option value="marketing">Berdasarkan Marketing</option>
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
<?php
if (isset($_POST['kirim_barang'])) {
	$_SESSION['nama_paket']=$_POST['nama_paket'];
	$_SESSION['no_pengiriman']=$_POST['no_peng'];
	$_SESSION['tgl_pengiriman']=$_POST['tgl_kirim'];
	$_SESSION['no_po']=$_POST['no_po'];
	echo "<script type='text/javascript'>
		window.location='index.php?page=simpan_kirim_barang&id=".$_GET['id']."';
		</script>";
} 
if (isset($_POST['kirim2_barang'])) {
	if ($_POST['id_alkes']=='all') { 
	$update = mysqli_query($koneksi, "insert into barang_dikirim values('','".$_POST['nama_paket']."','".$_POST['no_peng']."','".$_POST['tgl_kirim']."','".$_POST['no_po']."','0000-00-00')");
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_kirim from barang_dikirim"));
	$sel = mysqli_query($koneksi, "select * from barang_dijual_detail where barang_dijual_id=".$_GET['id']."");
	$tot_sel = mysqli_num_rows($sel);
	while ($data_sel = mysqli_fetch_array($sel)) {
		$ins = mysqli_query($koneksi, "insert into barang_dikirim_detail values('','".$max['id_kirim']."','".$data_sel['id']."')");	
		}
	
	if ($update and $ins) {
		mysqli_query($koneksi, "update barang_dijual_detail set status_kirim=1 where barang_dijual_id=".$_GET['id']."");	
		
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Simpan !');
		window.location='index.php?page=kirim_barang&id_krm=".$_GET['id']."';
		</script>";
		}
	else {
		echo "<script type='text/javascript'>
		alert('Gagal Disimpan');
		</script>";
		}
	}
	else {
	$update = mysqli_query($koneksi, "insert into barang_dikirim values('','".$_POST['nama_paket']."','".$_POST['no_peng']."','".$_POST['tgl_kirim']."','".$_POST['no_po']."','0000-00-00')");
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_kirim from barang_dikirim"));
	$ins = mysqli_query($koneksi, "insert into barang_dikirim_detail values('','".$max['id_kirim']."','".$_POST['id_alkes']."')");
	if ($update and $ins) {
		mysqli_query($koneksi, "update barang_dijual_detail set status_kirim=1 where id=".$_POST['id_alkes']."");
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Simpan !');
		window.location='index.php?page=kirim_barang&id_krm=".$_GET['id']."';
		</script>";
		}
	else {
		echo "<script type='text/javascript'>
		alert('Gagal Disimpan');
		</script>";
		}
	}}
?>
  <div id="openKirim" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Kirim Alkes</h3> 
     <form method="post">
     <!--<label>Pilih Alkes</label>
     <select id="input" name="id_alkes" required>
     	<?php 
		$q3 = mysqli_query($koneksi, "select *,barang_dijual_detail.id as idd from barang_dijual_detail,barang_gudang,barang_gudang_detail where barang_gudang_detail.id=barang_dijual_detail.barang_gudang_detail_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and status_kirim=0 and barang_dijual_id=".$_GET['id']."");
		$q4 = mysqli_query($koneksi, "select *,barang_dijual_detail.id as idd from barang_dijual_detail,barang_gudang,barang_gudang_detail where barang_gudang_detail.id=barang_dijual_detail.barang_gudang_detail_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and status_kirim=1 and barang_dijual_id=".$_GET['id']."");
		$q5 = mysqli_query($koneksi, "select * from barang_dijual where id=".$_GET['id'].""); 
		$d4 = mysqli_num_rows($q4);
		if ($d4==0) {
		?>
        <option value="all">All</option>
        <?php } ?>
        <?php
		while ($d3 = mysqli_fetch_array($q3)) { ?>
		<option value="<?php echo $d3['idd']; ?>"><?php echo $d3['nama_brg']." - No Seri : ".$d3['no_seri_brg']; ?></option>
		<?php } ?>
     </select>
     -->
     <label>Nama Paket</label>
     <input id="input" type="text" placeholder="" name="nama_paket" required>
     <label>No. Pengiriman</label>
     <input id="input" type="text" placeholder="" name="no_peng" required>
     <label>Tanggal Pengiriman</label>
     <input id="input" type="date" placeholder="" name="tgl_kirim" required>
     <label>No. Faktur</label>
     <input id="input" type="text" placeholder="" readonly="readonly" name="no_po" value="<?php
     $d5 = mysqli_fetch_array($q5);
	 echo $d5['no_faktur_jual'];
	 ?>">
     
        <button id="buttonn" name="kirim_barang" type="submit">Next</button>
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


        
<div class="modal fade" id="modal-pilihan">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pilih Principle</h4>
              </div>
              <div class="modal-body">
                <a href="index.php?page=jual_alkes"><button id="buttonn">Data Principle Baru</button></a>
                <a href="index.php?page=jual_alkes2">
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
        
        <div class="modal fade" id="modal-cetak">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><center>Cetak Penjualan Barang</center></h4>
              </div>
              <form method="post" enctype="multipart/form-data" target="_blank">
              <div class="modal-body">
              <label>Dari Tanggal</label>
              <input name="tgl_a" type="date" class="form-control" placeholder="" value=""><br />
              <label>Sampai Tanggal</label>
              <input name="tgl_b" type="date" class="form-control" placeholder="" value="">
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