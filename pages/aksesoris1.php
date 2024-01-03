<?php
if (isset($_POST['pencarian'])) {
		if ($_POST['pilihan']=='tgl_po_pesan') {
		echo "<script>window.location='index.php?page=$_GET[page]&tgl1=$_POST[tgl_awal]&tgl2=$_POST[tgl_akhir]&tampil=$_POST[tampil]'</script>";
		} else {
		echo "<script>window.location='index.php?page=$_GET[page]&pilihan=$_POST[pilihan]&kunci=$_POST[kata_kunci]&tampil=$_POST[tampil]'</script>";
		}
		
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <?php if (isset($_SESSION['user_admin_gudang']) or isset($_SESSION['user_manajer_gudang'])){ ?>
      Pemesanan Aksesoris
      <?php } else if (isset($_SESSION['user_admin_keuangan']) or isset($_SESSION['user_manajer_keuangan'])) { echo "Pembelian";} else {
		  echo "Gudang 1 / Pembelian";
		  } ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Alkes</li>
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
              
              <span class="pull pull-right">
              <table>
  <tr>
    <td><strong style="color:#F00">Keterangan</strong> : &nbsp;&nbsp;&nbsp;</td>
    <td valign="top">1. </td>
    <td valign="top">Tanda "<span class="fa fa-share"></span>" Menandakan Sudah Di Mutasi</td>
  </tr>
</table>
             </span>
              <br /><br />
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
      <th align="center">#</th>
      <th valign="top">Tgl PO</th>
        <th valign="top">No PO</th>
        <th valign="top">Jenis PO</th>
        <th valign="top">Nama Principle</th>
      <th valign="top"><table width="100%">
        <tr>
          <td>Nama Aksesoris</td>
          <td>Tipe Aksesoris</td>
          <td>Qty</td>
        </tr>
      </table></th>
      <?php if (!isset($_SESSION['user_admin_gudang'])) { ?>
      
      <th align="center" valign="top"><strong>PPN</strong></th>
        <th align="center" valign="top"><strong>Total Price</strong>        </th>
        <th align="center" valign="top">Total Keseluruhan</th>
         <?php } ?>
        <th align="center" valign="top">Estimasi Pengiriman</th>
        <th align="center" valign="top">Tgl Masuk</th>
        <th align="center" valign="top"><strong>Aksi</strong></th>
          </tr>
  </thead>
  <?php
 
// membuka file JSON
if (isset($_GET['pilihan']) and isset($_GET['kunci'])) {
	$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]&pilihan=$_GET[pilihan]&kunci=".str_replace(" ","%20",$_GET['kunci'])."");
}
elseif (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
	$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]&tgl_awal=".$_GET['tgl1']."&tgl_akhir=".$_GET['tgl2']."");
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
    <td><?php echo date("d-m-Y",strtotime($json[$i]['tgl_po_pesan'])); ?></td>
    <td><?php echo $json[$i]['no_po_pesan']; ?></td>
    <td><?php echo $json[$i]['jenis_po']; ?></td>
    <td><?php echo $json[$i]['nama_principle']; ?></td>
    
      <td><table width="100%" border="0">
        <?php 
	  $q=mysqli_query($koneksi, "select * from barang_pesan_akse_detail,aksesoris where aksesoris.id=barang_pesan_akse_detail.aksesoris_id and barang_pesan_akse_detail.barang_pesan_akse_id=".$json[$i]['idd']."");
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
          <td style="padding-left:5px"><?php echo $d1['nama_akse'] ?>&nbsp;&nbsp;</td>
          <td style="padding-left:5px"><?php echo $d1['tipe_akse'] ?>&nbsp;&nbsp;</td>
          <td style="padding-left:1px; padding-right:1px" align="right"><?php echo $d1['qty']; ?>
            <?php if ($d1['status_ke_stok']==1) { ?>
            <span class="fa fa-share"></span>
            <?php } ?>
            </td>
          </tr>
        <?php } ?>
      </table></td>
      <?php if (!isset($_SESSION['user_admin_gudang'])) { ?>
      
    <td><?php echo $json[$i]['ppn']."%"; ?></td>
    <td><?php
  echo $json[$i]['simbol']." ".number_format($json[$i]['total_price'],0,',',',').".00";
	?></td>
    <td><?php echo $json[$i]['simbol']." ".number_format($json[$i]['cost_cf'],0,',',',').".00"; ?></td>
    <?php } ?>
	<td>
    <?php if ($json[$i]['estimasi_pengiriman']==0000-00-00) {
		echo "-";
		} else {
			echo date("d/m/Y", strtotime($json[$i]['estimasi_pengiriman']));
			} ?>
    </td>
    <td><?php if ($json[$i]['tgl_masuk_gudang']==0000-00-00) {
		echo "-";
		} else {
			echo date("d/m/Y", strtotime($json[$i]['tgl_masuk_gudang']));
			} ?></td>
    <td align="center">
    <?php if (isset($_SESSION['user_administrator']) or isset($_SESSION['user_admin_gudang'])){ ?>
      <a href="index.php?page=aksesoris1&id=<?php echo $json[$i]['idd']; ?>#openLunas"><small data-toggle="tooltip" title="Tgl Masuk Gudang" class="label bg-green">Tgl Masuk Gudang</small></a><br />
      <?php if ($json[$i]['status_lunas']==1 or $json[$i]['tgl_masuk_gudang']!='0000-00-00') { ?>
      <a href="index.php?page=mutasi_akse&id=<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Mutasi" class="label bg-yellow">Mutasi</small></a><br /><?php }} ?>
      <a href="index.php?page=ubah_pembelian_akse&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Detail" class="fa fa-caret-square-o-right"></span></a>
      <?php /*if (isset($_SESSION['user_admin_keuangan']) or isset($_SESSION['user_administrator'])) { ?>
	  <a href="index.php?page=barang_gudang1&id=<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Pelunasan" class="label bg-red">Pelunasan</small></a>
      <?php }*/ ?>
      <!--<a href="cetak_invoice.php?id=<?php echo $data['idd']; ?>" target="_blank"><span data-toggle="tooltip" title="Cetak Invoice" class="fa fa-print"></span></a>-->
      <?php } ?>
    </td>
  </tr>
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
	if (isset($_GET['tgl_awal']) and isset($_GET['tgl_akhir'])) {
$queryy = mysqli_query($koneksi, "select *,barang_pesan_akse.id as idd from barang_pesan_akse,barang_pesan_akse_detail,aksesoris,principle where barang_pesan_akse.id=barang_pesan_akse_detail.barang_pesan_akse_id and aksesoris.id=barang_pesan_akse_detail.aksesoris_id and principle.id=barang_pesan_akse.principle_id and tgl_po_pesan between '$_GET[tgl_awal]' and '$_GET[tgl_akhir]' group by barang_pesan_akse.id order by tgl_po_pesan DESC, barang_pesan_akse.id DESC");
}
elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
$queryy = mysqli_query($koneksi, "select *,barang_pesan_akse.id as idd from barang_pesan_akse,barang_pesan_akse_detail,aksesoris,principle where barang_pesan_akse.id=barang_pesan_akse_detail.barang_pesan_akse_id and aksesoris.id=barang_pesan_akse_detail.aksesoris_id and principle.id=barang_pesan_akse.principle_id and $_GET[pilihan] like '%$_GET[kunci]%' group by barang_pesan_akse.id order by tgl_po_pesan DESC, barang_pesan_akse.id DESC");
}
 else {
$queryy = mysqli_query($koneksi, "select *,barang_pesan_akse.id as idd from barang_pesan_akse,mata_uang,principle where mata_uang.id=barang_pesan_akse.mata_uang_id and principle.id=barang_pesan_akse.principle_id order by tgl_po_pesan DESC, barang_pesan_akse.id DESC");
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
 

<div id="openPilihan" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <br />
        <a href="index.php?page=jual_barang2&id=<?php echo $_GET['id']; ?>"><button id="buttonn">Data Dinas/RS/Puskesmas/Klinik Baru</button></a>
        <a href="index.php?page=jual_barang3&id=<?php echo $_GET['id']; ?>"><button id="buttonn">Dari Data Dinas/RS/Puskesmas/Klinik<br />Yang Sudah Terinput</button></a>
    </div>
</div>

<?php 
if (isset($_POST['lunasin'])) {
	$q_lunas=mysqli_query($koneksi, "update barang_pesan_akse set tgl_masuk_gudang='".$_POST['tgl_lunas']."' where id=$_GET[id]");
	if ($q_lunas) {
		echo "<script type='text/javascript'>
		window.location='index.php?page=aksesoris1';
		</script>";
		}
	}
?>
<div id="openLunas" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Tgl Masuk Gudang</h3> 
     <form method="post">
     
     <input id="input" value="<?php echo $q2['tgl_masuk_gudang']; ?>" type="date" placeholder="" name="tgl_lunas" >
        <button id="buttonn" name="lunasin" type="submit">Simpan</button>
    </form>
    </div>
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
                <option value="nama_akse">Berdasarkan Nama Barang</option>
                <option value="merk_akse">Berdasarkan Merk Barang</option>
                </select>
                <br /><br />
                <div id="kata_kunci" style="display:block">
                <input type="text" class="form-control" name="kata_kunci" placeholder="Kata Kunci"/>
                </div>
                <div id="ifYes" style="display:none">
              <label>Dari Tanggal</label>
              <input name="tgl_awal" type="date" class="form-control" placeholder="" value=""><br />
              <label>Sampai Tanggal</label>
              <input name="tgl_akhir" type="date" class="form-control" placeholder="" value="">
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
