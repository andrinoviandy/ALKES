<?php
if (isset($_POST['pencarian'])) {
		if ($_POST['pilihan']=='tgl_input') {
		echo "<script>window.location='index.php?page=utang_aksesoris&tgl1=$_POST[tgl1]&tgl2=$_POST[tgl2]'</script>";
		} else {
		echo "<script>window.location='index.php?page=utang_aksesoris&pilihan=$_POST[pilihan]&kunci=$_POST[kata_kunci]'</script>";
		}
	}

if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from utang_piutang_aksesoris where id=".$_GET['id_hapus']."");
	if (!$del) {
		echo "<script>
		alert('Maaf , Data Tidak Dapat Di Hapus Karena Masih Ada Detail Pembayaran');
		</script>";
		}
	}
	
if (isset($_GET['id_batal'])) {
	$sel=mysqli_fetch_array(mysqli_query($koneksi, "select * from utang_piutang_bayar where utang_id=$_GET[id_batal]"));
	
	$del = mysqli_query($koneksi, "delete from utang where id=".$_GET['id_hapus']."");
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Hutang</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Utang</li>
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
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
              <div class="box-body table-responsive no-padding">
              
              <table width="100%" id="" class="table table-bordered table-hover">
                <thead>
    <tr>
      <td width="2%" align="center"><strong>No</strong>      
      <td width="9%" align="center"><strong>Status</strong>
        </th>
        <th width="5%" valign="top">ID</th>
        <th width="14%" valign="top"><strong>Tanggal</strong></th>
        <th width="16%" valign="top">No PO</th>
        <th width="16%" valign="top">Klien</th>
      <th width="16%" valign="top"><strong>Deskripsi</strong></th>
      <th width="12%" valign="top">Nominal</th>
      <!--<th valign="top">NIE</th>
      <th valign="top">No. Bath</th>
      <th valign="top">No. Lot</th>-->
      <th width="16%" align="center" valign="top"><strong>Aksi</strong></th>
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
#C33
?>
<?php if ($json[$i]['status_lunas']==0){$b="#FF0000";} else {$b="#00CC66";} ?>
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
    <td style="background-color:<?php echo $b; ?>;" align="center"><?php if ($json[$i]['status_lunas']==0){echo "Belum Dibayar";} else {echo "Sudah Dibayar";} ?></td>
    <td><?php echo "HU".$json[$i]['idd']; ?></td>
    
    <td>
    <?php echo date("d M Y",strtotime($json[$i]['tgl_input']));  ?><br />
    <font style="font-size:11px"><?php if($json[$i]['jatuh_tempo']!=0000-00-00) { echo "Jatuh Tempo : ".date("d M Y",strtotime($json[$i]['jatuh_tempo']));}  ?></font>
  </td>
    <td><?php echo $json[$i]['no_faktur_no_po_akse']; ?></td>
    <td><?php echo $json[$i]['klien']; ?></td>
    
      <td><?php echo $json[$i]['deskripsi']; ?></td>
      <td><?php echo "Rp ".number_format($json[$i]['nominal'],2,',','.'); ?></td>
      <!--<td></td>
    <td><?php //echo $data['no_bath']; ?></td>
    <td><?php //echo $data['no_lot']; ?></td>-->
    <?php if ($data['stok_total']==0) { $color="red"; } else { $color=""; } ?>
    <td>
      <?php /*if ($json[$i]['status_lunas']==0) { ?>
      <a href="index.php?page=utang_aksesoris&id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;&nbsp;
      <a href="index.php?page=ubah_utang_aksesoris&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a><br />
      <?php }*/ ?>
	  <?php if ($json[$i]['status_lunas']==0) { ?>
      <a href="index.php?page=bayar_utang_aksesoris&id=<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Bayar" class="label bg-green">Bayar</small></a>
      <?php } else { ?>
      <a href="index.php?page=bayar_utang_aksesoris&id=<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Riwayat Pembayaran" class="label bg-yellow"> Riwayat Pembayaran </small></a>
      <?php } ?>
      
    </td>
  </tr>
  <?php } ?>
</table><br />

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
	$queryy = mysqli_query($koneksi, "select *,utang_piutang_aksesoris.id as idd from barang_pesan_akse,barang_pesan_akse_detail,aksesoris,principle,utang_piutang_aksesoris where barang_pesan_akse.id=barang_pesan_akse_detail.barang_pesan_akse_id and aksesoris.id=barang_pesan_akse_detail.aksesoris_id and principle.id=barang_pesan_akse.principle_id and barang_pesan_akse.no_po_pesan=utang_piutang_aksesoris.no_faktur_no_po_akse and u_p='Hutang' and tgl_input between '$_GET[tgl1]' and '$_GET[tgl2]' and utang_piutang_aksesoris.nominal!=0 and status_po_batal=0 group by utang_piutang_aksesoris.id order by tgl_input DESC, utang_piutang_aksesoris.id DESC");

}
elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
	$queryy = mysqli_query($koneksi, "select *,utang_piutang_aksesoris.id as idd from barang_pesan_akse,barang_pesan_akse_detail,aksesoris,principle,utang_piutang_aksesoris where barang_pesan_akse.id=barang_pesan_akse_detail.barang_pesan_akse_id and aksesoris.id=barang_pesan_akse_detail.aksesoris_id and principle.id=barang_pesan_akse.principle_id and barang_pesan_akse.no_po_pesan=utang_piutang_aksesoris.no_faktur_no_po_akse and u_p='Hutang' and $_GET[pilihan] like '%$_GET[kunci]%' and utang_piutang_aksesoris.nominal!=0 and status_po_batal=0 group by utang_piutang_akse.id order by tgl_input DESC, utang_piutang_akse.id DESC");

} else {
	$queryy = mysqli_query($koneksi, "select *,utang_piutang_aksesoris.id as idd from utang_piutang_aksesoris where u_p='Hutang' and nominal!=0 order by tgl_input DESC, utang_piutang_aksesoris.id DESC");
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
 
<div class="modal fade" id="modal-pencarian">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              <script type="text/javascript">
			  function yesnoCheck() {
				  if (document.getElementById('yesCheck').value=='tgl_input') {
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
                <option value="tgl_input">Berdasarkan Rentang Tanggal</option>
                <option value="no_faktur_no_po_akse">Berdasarkan Nomor PO</option>
                <option value="nama_principle">Berdasarkan Nama Klien</option>
                <option value="nama_akse">Berdasarkan Nama Barang</option>
                <option value="tipe_akse">Berdasarkan Tipe Barang</option>
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
<div id="openPilihan" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <br />
        <a href="index.php?page=jual_barang2&id=<?php echo $_GET['id']; ?>"><button id="buttonn">Data Dinas/RS/Puskesmas/Klinik Baru</button></a>
        <a href="index.php?page=jual_barang3&id=<?php echo $_GET['id']; ?>"><button id="buttonn">Dari Data Dinas/RS/Puskesmas/Klinik<br />Yang Sudah Terinput</button></a>
    </div>
</div>


