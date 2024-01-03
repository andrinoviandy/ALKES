<?php
if (isset($_POST['ubah_deskripsi'])) {
	$s=mysqli_query($koneksi, "update barang_teknisi set keterangan_spk='".$_POST['keterangan_spk']."' where id=".$_POST['id_spk']."");
	if ($s) {
	echo "<script>window.location='index.php?page=spk_masuk'</script>";
	}}

if (isset($_POST['pencarian'])) {
		if ($_POST['pilihan']=='tgl_spk') {
		echo "<script>window.location='index.php?page=spk_masuk&tgl1=$_POST[tgl1]&tgl2=$_POST[tgl2]&tampil=$_POST[tampil]'</script>";
		} else {
		echo "<script>window.location='index.php?page=spk_masuk&pilihan=$_POST[pilihan]&kunci=$_POST[kata_kunci]&tampil=$_POST[tampil]'</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php if (isset($_SESSION['id_b'])) { echo "Alkes Yang Akan Diinstal"; } else { ?>
        SPI Masuk
     <?php } ?>
     </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">SPI Masuk</li>
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
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
              <div class="box-body">
              <div class="">
              <!--<?php if (!isset($_SESSION['id_b'])) { ?>
              <a href="index.php?page=tambah_spk_masuk">
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah </button></a><br /><br />
              <?php } ?>
                <form method="post">
              <div class="input-group pull pull-left col-xs-1">
                
                <select class="form-control" name="limiterr" style="margin-right:40px">
                <option <?php if ($limiter['limiter']==10) {echo "selected";} ?> value="10">10</option>
                <option <?php if ($limiter['limiter']==50) {echo "selected";} ?> value="50">50</option>
                <option <?php if ($limiter['limiter']==100) {echo "selected";} ?> value="100">100</option>
                <option <?php if ($limiter['limiter']==500) {echo "selected";} ?> value="500">500</option>
                <option <?php if ($limiter['limiter']==1000) {echo "selected";} ?> value="1000">1000</option>
                <?php 
				$total=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang"));
				?>
                <option <?php if ($limiter['limiter']==$total) {echo "selected";} ?> <?php if ($_POST['cari']!='') {echo "selected";} ?> value="<?php echo $total; ?>">All</option>
                </select>
                
                <span class="input-group-btn">
                      <button type="submit" name="button_limit" class="btn btn-default btn-flat"><i class="fa fa-check"></i></button>
                    </span>
                
              </div>
              </form>
              
              <form method="post">
              <div class="input-group pull pull-left col-xs-2">
                
                <select class="form-control" name="urutt" style="margin-right:40px">
                <option <?php if ($limiter['urut']=='ASC') {echo "selected";} ?> value="ASC">Ascending</option>
                <option <?php if ($limiter['urut']=='DESC') {echo "selected";} ?> value="DESC">Descending</option>
                
                </select>
                
                <span class="input-group-btn">
                      <button type="submit" name="button_urut" class="btn btn-default btn-flat"><i class="fa fa-check"></i></button>
                    </span>
                
              </div>
              </form>-->
              <!--
              <form method="post" class="">
              <div class="input-group input-group-md col-xs-4 pull pull-right">
                <input type="text" name="cari" placeholder="Keyword....." class="form-control">
                    <span class="input-group-btn">
                      <button type="submit" name="button_cari" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari </button>
                    </span>
              </div>
              </form>
              -->
              <span class="pull pull-right">
              <table>
  <tr>
    <td valign="top"><strong style="color:#F00">Keterangan</strong> : &nbsp;&nbsp;&nbsp;</td>
    <td valign="top">1. </td>
    <td valign="top">Jika <strong>Box</strong> Di <strong>Nama Alkes</strong> Berwarna <strong style="color:#F00">Merah</strong> , Itu menandakan<br />
barang telah dikembalikan karena mengalami kerusakan</td>
  </tr>
</table>
              </span><br /><br /><br />
              <?php if (isset($_GET['kunci']) or isset($_GET['tgl1'])) { ?>
              <a href="?page=spk_masuk"><button class="btn btn-info pull pull-right"><span class="fa fa-refresh"></span> Reset</button></a>&nbsp;&nbsp;
              <?php } ?>
              <button class="btn btn-success pull pull-right" data-toggle="modal" data-target="#modal-pencarian"><span class="fa fa-search"></span> Pencarian</button>
              <?php if (isset($_GET['kunci']) or isset($_GET['tgl1'])) { ?>
              <br /><br />
              <div class="pull pull-left">Data Berdasarkan : <?php 
			  if ($_GET['pilihan']=='no_spk') {echo "<u><em>Nomor SPI</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='barang_dijual.no_po_jual') {echo "<u><em>Nomor PO</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='nama_pembeli') {echo "<u><em>Nama Principle</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='nama_brg') {echo "<u><em>Nama Barang</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='tipe_brg') {echo "<u><em>Merk Barang</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='no_seri_brg') {echo "<u><em>No Seri Barang</em></u>, Kata Kunci : ";}
			  else {
				  $tgl11=date("d/m/Y",strtotime($_GET['tgl1']));
				  $tgl22=date("d/m/Y",strtotime($_GET['tgl2']));
				  echo "<u><em>Rentang Tanggal SPI : $tgl11 - $tgl22</em></u>";}
			  echo "<u><em>".$_GET['kunci']."</em></u>"; ?></div>
              <?php } ?>
              <br /><br />
                <div class="table-responsive">
                <table width="100%" id="<?php if (isset($_GET['pilihan']) or isset($_GET['tgl1'])){echo "example1";} else {echo "example3";} ?>" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="top">No</th>
        
        <th valign="top">Tanggal_SPI</th>
        <th valign="top">No SPI</th>
        <th valign="top">No PO</th>
        <th valign="top">Barang</th>
      
      <th valign="top" bgcolor="#00FFFF"><strong>RS/Dinas/Puskesmas</strong></th>
      <th valign="top"><strong>Kontak</strong></th>

<th valign="top"><strong>Deskripsi</strong></th>
      <th align="center" valign="top"><strong>Aksi</strong></th>
          </tr>
  </thead>
  <?php
 
// membuka file JSON
if (isset($_SESSION['id_b'])) {
	if (isset($_GET['pilihan']) and isset($_GET['kunci'])) {
	$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]?pilihan=$_GET[pilihan]&kunci=".str_replace(" ","%20",$_GET['kunci'])."");
}
elseif (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
	$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]?tgl1=".$_GET['tgl1']."&tgl2=".$_GET['tgl2']."");
}
else {
	$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]?id_teknisi=$_SESSION[id_b]");
	}
}
else {
	if (isset($_GET['pilihan']) and isset($_GET['kunci'])) {
	$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]?pilihan=$_GET[pilihan]&kunci=".str_replace(" ","%20",$_GET['kunci'])."");
}
elseif (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
	$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]?tgl1=".$_GET['tgl1']."&tgl2=".$_GET['tgl2']."");
}
else {
	$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]");
	}
}
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {

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
    <td><?php echo date("d/M/Y", strtotime($json[$i]['tgl_spk'])); ?>
    </td>
    <td><?php 
	echo $json[$i]['no_spk']; ?></td>
    <td><?php
    $spi=mysqli_fetch_array(mysqli_query($koneksi, "select no_po_jual from barang_teknisi,barang_teknisi_detail,barang_dikirim_detail,barang_gudang, barang_gudang_detail,barang_dikirim where barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_teknisi.id=".$json[$i]['idd'].""));
	echo $spi['no_po_jual'];
	?></td>
    <td align="">
    <?php //if ($_GET['tampil']==1) { ?>
    <?php 
	  $q23=mysqli_query($koneksi, "select nama_brg,no_seri_brg,status_batal,status_uji,status_teknisi,tipe_brg,barang_teknisi_detail.id as id_detail_teknisi from barang_teknisi,barang_teknisi_detail,barang_dikirim_detail,barang_gudang, barang_gudang_detail where barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_teknisi.id=".$json[$i]['idd']."");
	  $n2=0;
	  while ($d1=mysqli_fetch_array($q23)) {
	  $n2++;
	  ?>
      <?php if ($d1['status_teknisi']==1) { ?>
        <font class="pull pull-right" size="">(<span class='fa fa-user'></span>)</font>
        <?php } ?>
        <font class="pull pull-right" size="">
        <?php
		if($d1['status_uji']==1) {
			echo "(<span class='fa fa-wrench'></span>)";
			}
			?>
            </font>
      <?php echo $n2.".[".$d1['nama_brg']."]-[".$d1['tipe_brg']."]-[".$d1['no_seri_brg']."]"; ?>
      <hr style="margin:0px; border-top:1px double; width:100%"/>
      <?php } ?>
    <?php /*} else { ?>
    <a href="#" data-toggle="modal" data-target="#modal-detailbarang<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Detail Barang" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a>
    <?php } */ ?>
    </td>
    
    <td bgcolor="#00FFFF"><?php 
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_teknisi_detail,barang_dikirim_detail,barang_dikirim,barang_dijual,pembeli where barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dijual.id=barang_dikirim.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and barang_teknisi_id=".$json[$i]['idd'].""));
	echo $sel['nama_pembeli']; ?>
    </td>
    
        <td><?php echo $sel['kontak_rs']; ?></td>
        <td><?php echo $json[$i]['keterangan_spk']; ?></td>
    <td align="center">
    <?php if (!isset($_SESSION['id_b'])) { ?>
    <a href="index.php?page=pilih_teknisi&id=<?php echo $json[$i]['idd']; ?>"><span class="fa fa-sign-in" data-toggle="tooltip" title="Teknisi, Estimasi, Tgl Berangkat"></span></a><br /><a href="#" data-toggle="modal" data-target="#modal-ubah<?php echo $json[$i]['idd'] ?>" class="label label-warning"><span class="fa fa-edit" data-toggle="tooltip" title="Ubah Deskripsi"> Desk.</span></a>
    <br />
	<?php } ?>
    
        <?php 
		//if ($json[$i]['status_uji']==0 and $json[$i]['status_teknisi']==1) {
		{ ?><a href="index.php?page=simpan_tambah_uji&id=<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Instalasi & Uji Fungsi" class="label bg-blue">Instalasi</small>
          </a>
          <?php } ?>
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
	  $q2=mysqli_query($koneksi, "select nama_brg,no_seri_brg,status_batal,status_uji,status_teknisi,tipe_brg,barang_teknisi_detail.id as id_detail_teknisi from barang_teknisi,barang_teknisi_detail,barang_dikirim_detail,barang_gudang, barang_gudang_detail where barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_teknisi.id=".$json[$i]['idd']."");
	  $n=0;
	  while ($d1=mysqli_fetch_array($q2)) {
	  $n++;
	  ?>
      <?php if ($d1['status_teknisi']==1) { ?>
        <font class="pull pull-right" size="+1">(<span class='fa fa-user'></span>)</font>
        <?php } ?>
        <font class="pull pull-right" size="+1">
        <?php
		if($d1['status_uji']==1) {
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
                <h4 class="modal-title" align="center">Ubah Deskripsi</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <p align="justify">
              <input type="hidden" value="<?php echo $json[$i]['idd']; ?>" name="id_spk"/>
     <label>Deskripsi</label>
     <textarea rows="4" class="form-control" name="keterangan_spk"><?php echo $json[$i]['keterangan_spk']; ?></textarea>
              </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button class="btn btn-success" name="ubah_deskripsi" type="submit">Simpan Perubahan</button>
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
      <section class="col-lg-12">      
<center>
	<ul class="pagination btn-success">
    <?php
	if (isset($_GET['paging'])) {
		if ($_GET['paging']==1) {
		$first = "disabled";
		$first_2 = "disabled";
		}
		else {
		$first = "enabled";
		$first_2 = "enabled";
			}
	} else {
		$first = "disabled";
		$first_2 = "disabled";
		}
	?>
    <li class="<?php echo $first; ?>"><a href="
    <?php 
	if (isset($_GET['paging'])) {
		if ($_GET['paging']==1) {
		echo "#";
		}
		else {
			if (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
			echo "?page=$_GET[page]&tgl1=$_GET[tgl1]&tgl2=$_GET[tgl2]&paging=1";
			} elseif (isset($_GET['kunci'])) {
			echo "?page=$_GET[page]&kunci=$_GET[kunci]&paging=1";
			} else {
			echo "?page=$_GET[page]&paging=1";
			}
		}
	} else {
		echo "#";
		}
	?>
    "><i class="fa fa-angle-double-left"></i></a></li>
    <li class="<?php echo $first_2; ?>"><a href="
    <?php 
	if (isset($_GET['paging'])) {
		if ($_GET['paging']==1) {
		echo "#";
		}
		else {
		$pg = $_GET['paging']-1;
			if (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
			echo "?page=$_GET[page]&tgl1=$_GET[tgl1]&tgl2=$_GET[tgl2]&paging=$pg";
			} elseif (isset($_GET['kunci'])) {
			echo "?page=$_GET[page]&kunci=$_GET[kunci]&paging=$pg";
			} else {
			echo "?page=$_GET[page]&paging=$pg";
			}
		}
	} else {
		echo "#";
		}
	?>
    "><i class="fa fa-angle-left"></i></a></li>
    <?php
	$query12 = mysqli_query($koneksi, "SELECT jumlah_limit FROM limiter");
    list($surat_masuk) = mysqli_fetch_array($query12);
	//pagging
    $limit = $surat_masuk;
	if (isset($_GET['id_teknisi'])!='' or isset($_GET['id_teknisi'])!=0) {
	if (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
$queryy = "select *,barang_teknisi.id as idd from barang_dikirim,barang_teknisi,barang_teknisi_detail,barang_dikirim_detail,barang_gudang,barang_gudang_detail,barang_dijual,barang_dijual_qty,pembeli where barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_dijual_qty.id=barang_dikirim_detail.barang_dijual_qty_id and barang_dijual.id=barang_dijual_qty.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and tgl_spk between '$_GET[tgl1]' and '$_GET[tgl2]' group by barang_teknisi.id order by tgl_spk DESC,no_spk DESC";
}
elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
$queryy = "select *,barang_teknisi.id as idd from barang_dikirim,barang_teknisi,barang_teknisi_detail,barang_dikirim_detail,barang_gudang,barang_gudang_detail,barang_dijual,barang_dijual_qty,pembeli where barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_dijual_qty.id=barang_dikirim_detail.barang_dijual_qty_id and barang_dijual.id=barang_dijual_qty.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and $_GET[pilihan] like '%$_GET[kunci]%' group by barang_teknisi.id order by tgl_spk DESC,no_spk DESC";
} else {
	$queryy = "select *,barang_teknisi.id as idd from barang_teknisi where teknisi_id=$_GET[id_teknisi] and teknisi_id!=0 order by tgl_spk DESC,no_spk DESC";
	}
}
else {
	if (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
$queryy = "select *,barang_teknisi.id as idd from barang_dikirim,barang_teknisi,barang_teknisi_detail,barang_dikirim_detail,barang_gudang,barang_gudang_detail,barang_dijual,barang_dijual_qty,pembeli where barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_dijual_qty.id=barang_dikirim_detail.barang_dijual_qty_id and barang_dijual.id=barang_dijual_qty.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and tgl_spk between '$_GET[tgl1]' and '$_GET[tgl2]' group by barang_teknisi.id order by tgl_spk DESC,no_spk DESC";
}
elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
$queryy = "select *,barang_teknisi.id as idd from barang_dikirim,barang_teknisi,barang_teknisi_detail,barang_dikirim_detail,barang_gudang,barang_gudang_detail,barang_dijual,barang_dijual_qty,pembeli where barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_dijual_qty.id=barang_dikirim_detail.barang_dijual_qty_id and barang_dijual.id=barang_dijual_qty.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and $_GET[pilihan] like '%$_GET[kunci]%' group by barang_teknisi.id order by tgl_spk DESC,no_spk DESC";
} else {
	$queryy = "select *,barang_teknisi.id as idd from barang_teknisi order by tgl_spk DESC, no_spk DESC";
	}
}
	$cdata = mysqli_num_rows($queryy);
    $j = ceil($cdata/$limit);
	for ($i=1; $i<=$j; $i++) {
		?>
        <li>
        <?php
        if (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
		?>
        <a class="<?php if ($_GET['paging']==$i){echo "btn bg-olive";} ?>" href="?page=<?php echo $_GET['page'] ?>&tgl1=<?php echo $_GET['tgl1']; ?>&tgl2=<?php echo $_GET['tgl2']; ?>&paging=<?php echo $i ?>"><?php echo $i; ?></a>
        <?php
		} elseif (isset($_GET['kunci'])) {
		?>
        <a class="<?php if ($_GET['paging']==$i){echo "btn bg-olive";} ?>" href="?page=<?php echo $_GET['page'] ?>&kunci=<?php echo $_GET['kunci']; ?>&paging=<?php echo $i ?>"><?php echo $i; ?></a>
        <?php
		} else { 
		?>
        <a class="<?php if ($_GET['paging']==$i){echo "btn bg-olive";} ?>" href="?page=<?php echo $_GET['page'] ?>&paging=<?php echo $i ?>"><?php echo $i; ?></a>
        <?php
		}
		?>
        </li>
        <?php
		}
	?>
    <?php
    if (isset($_GET['paging'])) {
		if ($_GET['paging']==$j) {
		$end = "disabled";
		$end_2 = "disabled";
		}
		else {
		$end = "enabled";
		$end_2 = "enabled";
			}
	} else {
		$end = "enabled";
		$end_2 = "enabled";
		}
	?>
    <li class="<?php echo $end; ?>"><a href="
    <?php 
	if (isset($_GET['paging'])) {
		if ($_GET['paging']==$j) {
		echo "#";
		}
		else {
		$pg = $_GET['paging']+1;
			if (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
			echo "?page=$_GET[page]&tgl1=$_GET[tgl1]&tgl2=$_GET[tgl2]&paging=$pg";
			} elseif (isset($_GET['kunci'])) {
			echo "?page=$_GET[page]&kunci=$_GET[kunci]&paging=$pg";
			} else {
			echo "?page=$_GET[page]&paging=$pg";
			}
		}
	} else {
		echo "#";
		}
	?>
    "><i class="fa fa-angle-right"></i></a></li>
    <li class="<?php echo $end_2; ?>"><a href="
    <?php 
	if (isset($_GET['paging'])) {
		if ($_GET['paging']==$j) {
		echo "#";
		}
		else {
			if (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
			echo "?page=$_GET[page]&tgl1=$_GET[tgl1]&tgl2=$_GET[tgl2]&paging=$j";
			} elseif (isset($_GET['kunci'])) {
			echo "?page=$_GET[page]&kunci=$_GET[kunci]&paging=$j";
			} else {
			echo "?page=$_GET[page]&paging=$j";
			}
		}
	} else {
		echo "#";
		}
	?>
    "><i class="fa fa-angle-double-right"></i></a></li>
    </ul>
</center>
<center>
<?php 
	if (isset($_GET['paging'])) {
		if ($_GET['paging']==1) {
			echo "Ditampilkan 1 Sampai ".$akh." dari ".$cdata." Data";
			}
		else {
			$sel = mysqli_fetch_array(mysqli_query($koneksi, "select jumlah_limit from limiter"));
			echo "Ditampilkan ".((($_GET['paging']-1)*$sel['jumlah_limit'])+1)." Sampai ".$akh." dari ".$cdata." Data";
			}
	} else {
		echo "Ditampilkan 1 Sampai ".$akh." dari ".$cdata." Data";
		}
	?>
</center>

  </section>
    <!-- /.content -->
  </div>
  <?php include "atur_halaman.php"; ?>
      <!-- /.row (main row) -->

  </section>
    <!-- /.content -->
  </div>
  <?php 
  if (isset($_POST['jual'])) {
	  $jml1 = mysqli_fetch_array(mysqli_query($koneksi, "select * from master_barang where id=".$_GET['id'].""));
	  if ($_POST['qty']<=$jml1['stok']) {
	  $q = mysqli_query($koneksi, "insert into jual_barang values('','".$_GET['id']."','".$_POST['pembeli']."','".$_POST['alamat']."','".$_POST['qty']."','".$_POST['tgl_beli']."','','','','','','','','','','','')");
	  if ($q) {
		  mysqli_query($koneksi, "update master_barang set stok=stok-".$_POST['qty']." where id=".$_GET['id']."");
		  echo "<script type='text/javascript'>
		  window.location='index.php?page=jual_barang&id_lihat_jual=".$_GET['id']."';
		  </script>";
		  }
		//$d = mysqli_fetch_array(mysqli_query($koneksi, "select * from master barang where id=".$_GET['id'].""));
  } else {
  echo "<script type='text/javascript'>
		  alert('Data Stok Kurang !');
		  </script>"; }
  }
		?>
  <div id="openQuantity" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Jual Alkes</h3> 
     <form method="post">
     <input id="input" type="date" placeholder="" name="tgl_beli" required>
     <input id="input" type="text" placeholder="Pembeli (RS/Dinas/Puskesmas/Klinik" name="pembeli" required>
     <input id="input" type="text" placeholder="Alamat" name="alamat" required>
        <input id="input" type="text" placeholder="Quantity" name="qty" required>
        <button id="buttonn" name="jual" type="submit">Jual Alkes</button>
    </form>
    </div>
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

<?php 
$d_tek = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_teknisi where id=$_GET[id]"));
if (isset($_POST['simpan_teknisi'])) {
	$sim = mysqli_query($koneksi, "update barang_teknisi set teknisi_id='".$_POST['id_teknisi']."', estimasi='".$_POST['estimasi']."', tgl_berangkat_teknisi='".$_POST['tgl_berangkat']."' where id=$_GET[id]");
	if ($sim){
		echo "<script>window.location='index.php?page=spk_masuk'</script>";
		}
	}

?>
<div id="openTeknisi" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center"></h3> 
     <form method="post">
     <label>Teknisi</label>
     <select name="id_teknisi" class="form-control" <?php echo $dis; ?>>
              <option value="">--Pilih Teknisi--</option>
              <?php 
			  $query_teknisi = mysqli_query($koneksi, "select * from tb_teknisi order by nama_teknisi ASC");
			  while ($data_t = mysqli_fetch_array($query_teknisi)) {
			  ?>
              <option <?php if($d_tek['teknisi_id']==$data_t['id']) {echo "selected";} ?> value="<?php echo $data_t['id']; ?>"><?php echo $data_t['nama_teknisi']." - ".$data_t['bidang']; ?></option>
              <?php } ?>
              </select><br />
     <label>Estimasi</label>
     <input id="input" type="date" placeholder="" value="<?php echo $d_tek['estimasi']; ?>" name="estimasi"><br /><br />
     <label>Tgl Berangkat</label>
     <input id="input" type="date" placeholder="" name="tgl_berangkat" value="<?php echo $d_tek['tgl_berangkat_teknisi']; ?>">
        <button id="buttonn" name="simpan_teknisi" type="submit">Simpan</button>
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
                <option value="barang_dijual.no_po_jual">Berdasarkan Nomor PO</option>
                <option value="no_spk">Berdasarkan Nomor SPI</option>
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


