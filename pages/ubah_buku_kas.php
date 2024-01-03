<?php
if (isset($_POST['pencarian'])) {
		if ($_POST['pilihan']=='tgl_bayar') {
		echo "<script>window.location='index.php?page=ubah_buku_kas&id=$_GET[id]&tgl1=$_POST[tgl1]&tgl2=$_POST[tgl2]'</script>";
		} else {
		echo "<script>window.location='index.php?page=ubah_buku_kas&id=$_GET[id]&pilihan=$_POST[pilihan]&kunci=$_POST[kata_kunci]'</script>";
		}
	}

if (isset($_POST['pencarian2'])) {
		if ($_POST['pilihan']=='tgl') {
		echo "<script>window.location='index.php?page=ubah_buku_kas&id=$_GET[id]&tgl_awal=$_POST[tgl1]&tgl_akhir=$_POST[tgl2]'</script>";
		} else {
		echo "<script>window.location='index.php?page=ubah_buku_kas&id=$_GET[id]&pilihan2=$_POST[pilihan]&kunci2=$_POST[kata_kunci]'</script>";
		}
	}

if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "update buku_kas set no_akun='".$_POST['no_akun']."',nama_akun='".$_POST['nama_akun']."', tipe_akun='".$_POST['akun_tipe']."' where id=".$_GET['id']."");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Buku Kas Berhasil Di Ubah !');
		window.location='index.php?page=ubah_buku_kas&id=$_GET[id]'
		</script>";
		}
	}

$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from buku_kas where id=".$_GET['id'].""));
?>

<?php 
if (isset($_GET['id_hapus'])) {
	$s=mysqli_fetch_array(mysqli_query($koneksi, "select saldo from coa_detail where id=".$_GET['id_hapus'].""));
	mysqli_query($koneksi, "update coa set saldo_total=saldo_total-$s[saldo] where id=$_GET[id]");
	$del = mysqli_query($koneksi, "delete from coa_detail where id=".$_GET['id_hapus']."");
	if ($del) {
		echo "<script>
		window.location='index.php?page=ubah_buku_kas&id=$_GET[id]';
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Riwayat Buku Kas/Bank <center>(<?php echo $data['nama_akun']; ?>)</center></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Buku Kas/Bank</li>
        <li class="active">Riwayat Buku Kas/Bank</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
          <?php 
		  $cek1 = mysqli_num_rows(mysqli_query($koneksi, "select * from utang_piutang_bayar where buku_kas_id=".$_GET['id'].""));
		  if ($cek1!=0) { ?>
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Riwayat  Pembayaran Hutang &amp; Piutang Dagang (No Seri)</h3>
              
              </div><div class="box-body">
              <a href="cetak_buku_kas.php?id=<?php echo $_GET['id']; ?>"><button class="btn btn-warning pull pull-left"><span class="fa fa-print"></span> &nbsp;Print Excel</button></a>
			  <?php if (isset($_GET['kunci']) or isset($_GET['tgl1'])) { ?>
              <a href="?page=ubah_buku_kas&id=<?php echo $_GET['id'] ?>"><button class="btn btn-info pull pull-right"><span class="fa fa-refresh"></span> Reset</button></a>&nbsp;&nbsp;
              <?php } ?>
              <button class="btn btn-success pull pull-right" data-toggle="modal" data-target="#modal-pencarian"><span class="fa fa-search"></span> Pencarian</button>
              <?php if (isset($_GET['kunci']) or isset($_GET['tgl1'])) { ?>
              <div align="center">Data Berdasarkan : <?php 
			  if ($_GET['pilihan']=='no_po_pesan') {echo "<u><em>Nomor PO</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='tgl_po_pesan') {echo "<u><em>Rentang Tanggal</em></u>";}
			  elseif ($_GET['pilihan']=='nama_principle') {echo "<u><em>Nama Principle</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='nama_brg') {echo "<u><em>Nama Barang</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='merk_brg') {echo "<u><em>Merk Barang</em></u>, Kata Kunci : ";}
			  else {
				  $tgl11=date("d/m/Y",strtotime($_GET['tgl1']));
				  $tgl22=date("d/m/Y",strtotime($_GET['tgl2']));
				  echo "<u><em>Rentang Tanggal : $tgl11 - $tgl22</em></u>";}
			  echo "<u><em>".$_GET['kunci']."</em></u>"; ?></div>
              <?php } ?>
              <hr />
              <div class="table-responsive">
              <table width="100%" id="<?php if (isset($_GET['pilihan'])){echo "example1";} else {echo "example3";} ?>" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td width="" align="center" valign="bottom"><strong>-/+</strong></th>
        <th width="" valign="top">ID</th>
        <th width="" valign="top"><strong>Kategori</strong></th>
        <th width="" valign="top">No_PO</th>
        <th width="" valign="top">Barang</th>
        <th width="" valign="top">Klien</th>
      <th width="" valign="top"><strong>Deskripsi</strong></th>
      <th width="" valign="top">Nominal</th>
      <th width="" valign="top"><strong>Pembayaran_Terakhir</strong></th>
      <th width="" align="center" valign="top">Status</th>
      <!--<th valign="top">NIE</th>
      <th valign="top">No. Bath</th>
      <th valign="top">No. Lot</th>-->
      <th width="" align="center" valign="top"><strong>Aksi</strong></th>
          </tr>
  </thead>
  <?php
  if (isset($_GET['pilihan']) and isset($_GET['kunci'])) {
	$file = file_get_contents("http://localhost/ALKES/json/riwayat_hutang_piutang.php?id=$_GET[id]&pilihan=$_GET[pilihan]&kunci=".str_replace(" ","%20",$_GET['kunci'])."");
}
elseif (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
	$file = file_get_contents("http://localhost/ALKES/json/riwayat_hutang_piutang.php?id=$_GET[id]&tgl1=".$_GET['tgl1']."&tgl2=".$_GET['tgl2']."");
}
else {
$file = file_get_contents("http://localhost/ALKES/json/riwayat_hutang_piutang.php?id=$_GET[id]");
}
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
  ?>
  <tr>
    <td align="center"><?php
    if ($json[$i]['u_p']=='Hutang') {
		echo "<span class='fa fa-minus'></span>";
		}
	else {
		echo "<span class='fa fa-plus'></span>";
		} ?></td>
    <td><?php if($json[$i]['u_p']=='Hutang'){
		echo "HU".$json[$i]['id_up'];
		} else { echo "PI".$json[$i]['id_up']; }  ?></td>
    
    <td>
      <?php echo $json[$i]['u_p'];;  ?>
    </td>
    <td><?php echo $json[$i]['no_faktur_no_po']; ?></td>
    <td>
    <?php if ($json[$i]['u_p']=='Hutang') { ?>
    <a href="#" data-toggle="modal" data-target="#modal-detailhutang<?php echo $json[$i]['id_up']; ?>"><small data-toggle="tooltip" title="Detail Barang" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a>
    <?php } else { ?>
    <a href="#" data-toggle="modal" data-target="#modal-detailpiutang<?php echo $json[$i]['id_up']; ?>"><small data-toggle="tooltip" title="Detail Barang" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a>
    <?php } ?>
    </td>
    <td><?php echo $json[$i]['klien']; ?></td>
    
      <td><?php echo $json[$i]['deskripsi']; ?></td>
      <td><?php echo "Rp".number_format($json[$i]['nominal_up'],2,',','.'); ?></td>
      <td>
      <?php
      $dd = mysqli_fetch_array(mysqli_query($koneksi, "select * from utang_piutang_bayar where buku_kas_id=$_GET[id] and utang_piutang_id=".$json[$i]['id_up']." order by tgl_bayar DESC LIMIT 1"));
	  echo "<b>".date("d/m/Y",strtotime($dd['tgl_bayar']))." : </b><br>Rp".number_format($dd['nominal'],2,',','.');
	  ?>
      <hr style="margin:0px"/>
      <font style="font-size:11px"><?php 
	$ddd = mysqli_fetch_array(mysqli_query($koneksi, "select sum(nominal) as nominal_bayar from utang_piutang_bayar where utang_piutang_id=".$json[$i]['id_up'].""));
	echo "Total Pembayaran : Rp".number_format($ddd['nominal_bayar'],2,',','.'); ?></font></td>
      <td><?php if ($json[$i]['status_lunas']==0){echo "Belum Lunas";}else {echo "Sudah Lunas";} ?></td>
    
    <?php if ($json[$i]['stok_total']==0) { $color="red"; } else { $color=""; } ?>
    <td>
    <a href="index.php?page=detail_buku_kas&id=<?php echo $_GET['id']; ?>&id_up=<?php echo $json[$i]['id_up']; ?>" class="label label-info"><span data-toggle="tooltip" title="Detail" class="fa fa-toggle-right"></span> Detail</a>
    </td>
  </tr>
  <div class="modal fade" id="modal-detailhutang<?php echo $json[$i]['id_up']; ?>">
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
	  $q=mysqli_query($koneksi, "select nama_brg,tipe_brg,qty,status_ke_stok from barang_pesan_detail,barang_gudang,barang_pesan where barang_gudang.id=barang_pesan_detail.barang_gudang_id and barang_pesan.id=barang_pesan_detail.barang_pesan_id and barang_pesan.no_po_pesan='".$json[$i]['no_faktur_no_po']."'");
	  $n=0;
	  while ($d1=mysqli_fetch_array($q)) {
	  $n++;
	  ?>
      <?php if ($d1['status_ke_stok']==1) { ?>
        <font class="pull pull-right" size="+1"><span class="fa fa-share"></span></font>
        <?php } ?>
      <?php echo $n.". ".$d1['nama_brg']."     |    "; ?></td>
      <?php echo $d1['tipe_brg']."  |  " ?></td>
      <?php echo $d1['qty']; ?>
      
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
        
        <div class="modal fade" id="modal-detailpiutang<?php echo $json[$i]['id_up']; ?>">
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
	  $q2=mysqli_query($koneksi, "select *,barang_dijual_qty.id as id_det_jual from barang_dijual_qty,barang_dijual,barang_gudang where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual.no_po_jual='".$json[$i]['no_faktur_no_po']."'");
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
  <?php } ?>
</table>
              </div>
              
              </div>
            </div>
            <?php
		  }
		  $cek2 = mysqli_num_rows(mysqli_query($koneksi, "select * from utang_piutang_set_bayar where buku_kas_id=".$_GET['id'].""));
		  if ($cek2!=0) { ?>
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Riwayat  Pembayaran Hutang &amp; Piutang Dagang (Alkes Ber Set)</h3>
              
              </div><div class="box-body">
              <a href="cetak_buku_kas.php?id=<?php echo $_GET['id']; ?>"><button class="btn btn-warning pull pull-left"><span class="fa fa-print"></span> &nbsp;Print Excel</button></a>
			  <?php if (isset($_GET['kunci']) or isset($_GET['tgl1'])) { ?>
              <a href="?page=ubah_buku_kas&id=<?php echo $_GET['id'] ?>"><button class="btn btn-info pull pull-right"><span class="fa fa-refresh"></span> Reset</button></a>&nbsp;&nbsp;
              <?php } ?>
              <button class="btn btn-success pull pull-right" data-toggle="modal" data-target="#modal-pencarian"><span class="fa fa-search"></span> Pencarian</button>
              <?php if (isset($_GET['kunci']) or isset($_GET['tgl1'])) { ?>
              <div align="center">Data Berdasarkan : <?php 
			  if ($_GET['pilihan']=='no_po_pesan') {echo "<u><em>Nomor PO</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='tgl_po_pesan') {echo "<u><em>Rentang Tanggal</em></u>";}
			  elseif ($_GET['pilihan']=='nama_principle') {echo "<u><em>Nama Principle</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='nama_brg') {echo "<u><em>Nama Barang</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='merk_brg') {echo "<u><em>Merk Barang</em></u>, Kata Kunci : ";}
			  else {
				  $tgl11=date("d/m/Y",strtotime($_GET['tgl1']));
				  $tgl22=date("d/m/Y",strtotime($_GET['tgl2']));
				  echo "<u><em>Rentang Tanggal : $tgl11 - $tgl22</em></u>";}
			  echo "<u><em>".$_GET['kunci']."</em></u>"; ?></div>
              <?php } ?>
              <hr />
              <div class="table-responsive">
              <table width="100%" id="<?php if (isset($_GET['pilihan'])){echo "example1";} else {echo "example3";} ?>" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td width="" align="center" valign="bottom"><strong>-/+</strong></th>
        <th width="" valign="top">ID</th>
        <th width="" valign="top"><strong>Kategori</strong></th>
        <th width="" valign="top">No_PO</th>
        <th width="" valign="top">Barang</th>
        <th width="" valign="top">Klien</th>
      <th width="" valign="top"><strong>Deskripsi</strong></th>
      <th width="" valign="top">Nominal</th>
      <th width="" valign="top"><strong>Pembayaran_Terakhir</strong></th>
      <th width="" align="center" valign="top">Status</th>
      <!--<th valign="top">NIE</th>
      <th valign="top">No. Bath</th>
      <th valign="top">No. Lot</th>-->
      <th width="" align="center" valign="top"><strong>Aksi</strong></th>
          </tr>
  </thead>
  <?php
  if (isset($_GET['pilihan']) and isset($_GET['kunci'])) {
	$file = file_get_contents("http://localhost/ALKES/json/riwayat_hutang_piutang.php?id=$_GET[id]&pilihan=$_GET[pilihan]&kunci=".str_replace(" ","%20",$_GET['kunci'])."");
}
elseif (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
	$file = file_get_contents("http://localhost/ALKES/json/riwayat_hutang_piutang.php?id=$_GET[id]&tgl1=".$_GET['tgl1']."&tgl2=".$_GET['tgl2']."");
}
else {
$file = file_get_contents("http://localhost/ALKES/json/riwayat_hutang_piutang.php?id=$_GET[id]");
}
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
  ?>
  <tr>
    <td align="center"><?php
    if ($json[$i]['u_p']=='Hutang') {
		echo "<span class='fa fa-minus'></span>";
		}
	else {
		echo "<span class='fa fa-plus'></span>";
		} ?></td>
    <td><?php if($json[$i]['u_p']=='Hutang'){
		echo "HU".$json[$i]['id_up'];
		} else { echo "PI".$json[$i]['id_up']; }  ?></td>
    
    <td>
      <?php echo $json[$i]['u_p'];;  ?>
    </td>
    <td><?php echo $json[$i]['no_faktur_no_po']; ?></td>
    <td>
    <?php if ($json[$i]['u_p']=='Hutang') { ?>
    <a href="#" data-toggle="modal" data-target="#modal-detailhutang<?php echo $json[$i]['id_up']; ?>"><small data-toggle="tooltip" title="Detail Barang" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a>
    <?php } else { ?>
    <a href="#" data-toggle="modal" data-target="#modal-detailpiutang<?php echo $json[$i]['id_up']; ?>"><small data-toggle="tooltip" title="Detail Barang" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a>
    <?php } ?>
    </td>
    <td><?php echo $json[$i]['klien']; ?></td>
    
      <td><?php echo $json[$i]['deskripsi']; ?></td>
      <td><?php echo "Rp".number_format($json[$i]['nominal_up'],2,',','.'); ?></td>
      <td>
      <?php
      $dd = mysqli_fetch_array(mysqli_query($koneksi, "select * from utang_piutang_bayar where buku_kas_id=$_GET[id] and utang_piutang_id=".$json[$i]['id_up']." order by tgl_bayar DESC LIMIT 1"));
	  echo "<b>".date("d/m/Y",strtotime($dd['tgl_bayar']))." : </b><br>Rp".number_format($dd['nominal'],2,',','.');
	  ?>
      <hr style="margin:0px"/>
      <font style="font-size:11px"><?php 
	$ddd = mysqli_fetch_array(mysqli_query($koneksi, "select sum(nominal) as nominal_bayar from utang_piutang_bayar where utang_piutang_id=".$json[$i]['id_up'].""));
	echo "Total Pembayaran : Rp".number_format($ddd['nominal_bayar'],2,',','.'); ?></font></td>
      <td><?php if ($json[$i]['status_lunas']==0){echo "Belum Lunas";}else {echo "Sudah Lunas";} ?></td>
    
    <?php if ($json[$i]['stok_total']==0) { $color="red"; } else { $color=""; } ?>
    <td>
    <a href="index.php?page=detail_buku_kas&id=<?php echo $_GET['id']; ?>&id_up=<?php echo $json[$i]['id_up']; ?>" class="label label-info"><span data-toggle="tooltip" title="Detail" class="fa fa-toggle-right"></span> Detail</a>
    </td>
  </tr>
  <div class="modal fade" id="modal-detailhutang<?php echo $json[$i]['id_up']; ?>">
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
	  $q=mysqli_query($koneksi, "select nama_brg,tipe_brg,qty,status_ke_stok from barang_pesan_detail,barang_gudang,barang_pesan where barang_gudang.id=barang_pesan_detail.barang_gudang_id and barang_pesan.id=barang_pesan_detail.barang_pesan_id and barang_pesan.no_po_pesan='".$json[$i]['no_faktur_no_po']."'");
	  $n=0;
	  while ($d1=mysqli_fetch_array($q)) {
	  $n++;
	  ?>
      <?php if ($d1['status_ke_stok']==1) { ?>
        <font class="pull pull-right" size="+1"><span class="fa fa-share"></span></font>
        <?php } ?>
      <?php echo $n.". ".$d1['nama_brg']."     |    "; ?></td>
      <?php echo $d1['tipe_brg']."  |  " ?></td>
      <?php echo $d1['qty']; ?>
      
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
        
        <div class="modal fade" id="modal-detailpiutang<?php echo $json[$i]['id_up']; ?>">
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
	  $q2=mysqli_query($koneksi, "select *,barang_dijual_qty.id as id_det_jual from barang_dijual_qty,barang_dijual,barang_gudang where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual.no_po_jual='".$json[$i]['no_faktur_no_po']."'");
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
  <?php } ?>
</table>
              </div>              
              </div>
            </div>
			<?php } ?>
            <?php 
			$cek3 = mysqli_num_rows(mysqli_query($koneksi, "select * from utang_piutang_aksesoris_bayar where buku_kas_id=".$_GET['id'].""));
		  if ($cek3!=0) {
			?>
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Riwayat  Pembayaran Hutang &amp; Piutang Dagang (Aksesoris)</h3>
              
              </div><div class="box-body">
              <a href="cetak_buku_kas.php?id=<?php echo $_GET['id']; ?>"><button class="btn btn-warning pull pull-left"><span class="fa fa-print"></span> &nbsp;Print Excel</button></a>
			  <?php if (isset($_GET['kunci']) or isset($_GET['tgl1'])) { ?>
              <a href="?page=ubah_buku_kas&id=<?php echo $_GET['id'] ?>"><button class="btn btn-info pull pull-right"><span class="fa fa-refresh"></span> Reset</button></a>&nbsp;&nbsp;
              <?php } ?>
              <button class="btn btn-success pull pull-right" data-toggle="modal" data-target="#modal-pencarian"><span class="fa fa-search"></span> Pencarian</button>
              <?php if (isset($_GET['kunci']) or isset($_GET['tgl1'])) { ?>
              <div class="pull pull-left">Data Berdasarkan : <?php 
			  if ($_GET['pilihan']=='no_po_pesan') {echo "<u><em>Nomor PO</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='tgl_po_pesan') {echo "<u><em>Rentang Tanggal</em></u>";}
			  elseif ($_GET['pilihan']=='nama_principle') {echo "<u><em>Nama Principle</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='nama_brg') {echo "<u><em>Nama Barang</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='merk_brg') {echo "<u><em>Merk Barang</em></u>, Kata Kunci : ";}
			  else {
				  $tgl11=date("d/m/Y",strtotime($_GET['tgl1']));
				  $tgl22=date("d/m/Y",strtotime($_GET['tgl2']));
				  echo "<u><em>Rentang Tanggal : $tgl11 - $tgl22</em></u>";}
			  echo "<u><em>".$_GET['kunci']."</em></u>"; ?></div>
              <?php } ?>
              <hr />
              <div class="table-responsive">
              <table width="100%" id="<?php if (isset($_GET['pilihan'])){echo "example1";} else {echo "example3";} ?>" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td width="" align="center" valign="bottom"><strong>-/+</strong></th>
        <th width="" valign="top">ID</th>
        <th width="" valign="top"><strong>Kategori</strong></th>
        <th width="" valign="top">No_PO</th>
        <th width="" valign="top">Barang</th>
        <th width="" valign="top">Klien</th>
      <th width="" valign="top"><strong>Deskripsi</strong></th>
      <th width="" valign="top">Nominal</th>
      <th width="" valign="top"><strong>Pembayaran_Terakhir</strong></th>
      <th width="" align="center" valign="top">Status</th>
      <!--<th valign="top">NIE</th>
      <th valign="top">No. Bath</th>
      <th valign="top">No. Lot</th>-->
      <th width="" align="center" valign="top"><strong>Aksi</strong></th>
          </tr>
  </thead>
  <?php
  if (isset($_GET['pilihan']) and isset($_GET['kunci'])) {
	$file = file_get_contents("http://localhost/ALKES/json/riwayat_hutang_piutang.php?id=$_GET[id]&pilihan=$_GET[pilihan]&kunci=".str_replace(" ","%20",$_GET['kunci'])."");
}
elseif (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
	$file = file_get_contents("http://localhost/ALKES/json/riwayat_hutang_piutang.php?id=$_GET[id]&tgl1=".$_GET['tgl1']."&tgl2=".$_GET['tgl2']."");
}
else {
$file = file_get_contents("http://localhost/ALKES/json/riwayat_hutang_piutang.php?id=$_GET[id]");
}
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
  ?>
  <tr>
    <td align="center"><?php
    if ($json[$i]['u_p']=='Hutang') {
		echo "<span class='fa fa-minus'></span>";
		}
	else {
		echo "<span class='fa fa-plus'></span>";
		} ?></td>
    <td><?php if($json[$i]['u_p']=='Hutang'){
		echo "HU".$json[$i]['id_up'];
		} else { echo "PI".$json[$i]['id_up']; }  ?></td>
    
    <td>
      <?php echo $json[$i]['u_p'];;  ?>
    </td>
    <td><?php echo $json[$i]['no_faktur_no_po']; ?></td>
    <td>
    <?php if ($json[$i]['u_p']=='Hutang') { ?>
    <a href="#" data-toggle="modal" data-target="#modal-detailhutang<?php echo $json[$i]['id_up']; ?>"><small data-toggle="tooltip" title="Detail Barang" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a>
    <?php } else { ?>
    <a href="#" data-toggle="modal" data-target="#modal-detailpiutang<?php echo $json[$i]['id_up']; ?>"><small data-toggle="tooltip" title="Detail Barang" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a>
    <?php } ?>
    </td>
    <td><?php echo $json[$i]['klien']; ?></td>
    
      <td><?php echo $json[$i]['deskripsi']; ?></td>
      <td><?php echo "Rp".number_format($json[$i]['nominal_up'],2,',','.'); ?></td>
      <td>
      <?php
      $dd = mysqli_fetch_array(mysqli_query($koneksi, "select * from utang_piutang_bayar where buku_kas_id=$_GET[id] and utang_piutang_id=".$json[$i]['id_up']." order by tgl_bayar DESC LIMIT 1"));
	  echo "<b>".date("d/m/Y",strtotime($dd['tgl_bayar']))." : </b><br>Rp".number_format($dd['nominal'],2,',','.');
	  ?>
      <hr style="margin:0px"/>
      <font style="font-size:11px"><?php 
	$ddd = mysqli_fetch_array(mysqli_query($koneksi, "select sum(nominal) as nominal_bayar from utang_piutang_bayar where utang_piutang_id=".$json[$i]['id_up'].""));
	echo "Total Pembayaran : Rp".number_format($ddd['nominal_bayar'],2,',','.'); ?></font></td>
      <td><?php if ($json[$i]['status_lunas']==0){echo "Belum Lunas";}else {echo "Sudah Lunas";} ?></td>
    
    <?php if ($json[$i]['stok_total']==0) { $color="red"; } else { $color=""; } ?>
    <td>
    <a href="index.php?page=detail_buku_kas&id=<?php echo $_GET['id']; ?>&id_up=<?php echo $json[$i]['id_up']; ?>" class="label label-info"><span data-toggle="tooltip" title="Detail" class="fa fa-toggle-right"></span> Detail</a>
    </td>
  </tr>
  <div class="modal fade" id="modal-detailhutang<?php echo $json[$i]['id_up']; ?>">
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
	  $q=mysqli_query($koneksi, "select nama_brg,tipe_brg,qty,status_ke_stok from barang_pesan_detail,barang_gudang,barang_pesan where barang_gudang.id=barang_pesan_detail.barang_gudang_id and barang_pesan.id=barang_pesan_detail.barang_pesan_id and barang_pesan.no_po_pesan='".$json[$i]['no_faktur_no_po']."'");
	  $n=0;
	  while ($d1=mysqli_fetch_array($q)) {
	  $n++;
	  ?>
      <?php if ($d1['status_ke_stok']==1) { ?>
        <font class="pull pull-right" size="+1"><span class="fa fa-share"></span></font>
        <?php } ?>
      <?php echo $n.". ".$d1['nama_brg']."     |    "; ?></td>
      <?php echo $d1['tipe_brg']."  |  " ?></td>
      <?php echo $d1['qty']; ?>
      
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
        
        <div class="modal fade" id="modal-detailpiutang<?php echo $json[$i]['id_up']; ?>">
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
	  $q2=mysqli_query($koneksi, "select *,barang_dijual_qty.id as id_det_jual from barang_dijual_qty,barang_dijual,barang_gudang where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual.no_po_jual='".$json[$i]['no_faktur_no_po']."'");
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
  <?php } ?>
</table>
              </div>              
              </div>
            </div>
			<?php } ?>
            <?php
            $cek4 = mysqli_num_rows(mysqli_query($koneksi, "select * from utang_piutang_inventory_bayar where buku_kas_id=".$_GET['id'].""));
		  if ($cek4!=0) {
			?>
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Riwayat  Pembayaran Hutang &amp; Piutang Dagang (Inventory)</h3>
              
              </div><div class="box-body">
              <a href="cetak_buku_kas.php?id=<?php echo $_GET['id']; ?>"><button class="btn btn-warning pull pull-left"><span class="fa fa-print"></span> &nbsp;Print Excel</button></a>
			  <?php if (isset($_GET['kunci']) or isset($_GET['tgl1'])) { ?>
              <a href="?page=ubah_buku_kas&id=<?php echo $_GET['id'] ?>"><button class="btn btn-info pull pull-right"><span class="fa fa-refresh"></span> Reset</button></a>&nbsp;&nbsp;
              <?php } ?>
              <button class="btn btn-success pull pull-right" data-toggle="modal" data-target="#modal-pencarian"><span class="fa fa-search"></span> Pencarian</button>
              <?php if (isset($_GET['kunci']) or isset($_GET['tgl1'])) { ?>
              <div class="pull pull-left">Data Berdasarkan : <?php 
			  if ($_GET['pilihan']=='no_po_pesan') {echo "<u><em>Nomor PO</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='tgl_po_pesan') {echo "<u><em>Rentang Tanggal</em></u>";}
			  elseif ($_GET['pilihan']=='nama_principle') {echo "<u><em>Nama Principle</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='nama_brg') {echo "<u><em>Nama Barang</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='merk_brg') {echo "<u><em>Merk Barang</em></u>, Kata Kunci : ";}
			  else {
				  $tgl11=date("d/m/Y",strtotime($_GET['tgl1']));
				  $tgl22=date("d/m/Y",strtotime($_GET['tgl2']));
				  echo "<u><em>Rentang Tanggal : $tgl11 - $tgl22</em></u>";}
			  echo "<u><em>".$_GET['kunci']."</em></u>"; ?></div>
              <?php } ?>
              <hr />
              <div class="table-responsive">
              <table width="100%" id="<?php if (isset($_GET['pilihan'])){echo "example1";} else {echo "example3";} ?>" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td width="" align="center" valign="bottom"><strong>-/+</strong></th>
        <th width="" valign="top">ID</th>
        <th width="" valign="top"><strong>Kategori</strong></th>
        <th width="" valign="top">No_PO</th>
        <th width="" valign="top">Barang</th>
        <th width="" valign="top">Klien</th>
      <th width="" valign="top"><strong>Deskripsi</strong></th>
      <th width="" valign="top">Nominal</th>
      <th width="" valign="top"><strong>Pembayaran_Terakhir</strong></th>
      <th width="" align="center" valign="top">Status</th>
      <!--<th valign="top">NIE</th>
      <th valign="top">No. Bath</th>
      <th valign="top">No. Lot</th>-->
      <th width="" align="center" valign="top"><strong>Aksi</strong></th>
          </tr>
  </thead>
  <?php
  if (isset($_GET['pilihan']) and isset($_GET['kunci'])) {
	$file = file_get_contents("http://localhost/ALKES/json/riwayat_hutang_piutang.php?id=$_GET[id]&pilihan=$_GET[pilihan]&kunci=".str_replace(" ","%20",$_GET['kunci'])."");
}
elseif (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
	$file = file_get_contents("http://localhost/ALKES/json/riwayat_hutang_piutang.php?id=$_GET[id]&tgl1=".$_GET['tgl1']."&tgl2=".$_GET['tgl2']."");
}
else {
$file = file_get_contents("http://localhost/ALKES/json/riwayat_hutang_piutang.php?id=$_GET[id]");
}
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
  ?>
  <tr>
    <td align="center"><?php
    if ($json[$i]['u_p']=='Hutang') {
		echo "<span class='fa fa-minus'></span>";
		}
	else {
		echo "<span class='fa fa-plus'></span>";
		} ?></td>
    <td><?php if($json[$i]['u_p']=='Hutang'){
		echo "HU".$json[$i]['id_up'];
		} else { echo "PI".$json[$i]['id_up']; }  ?></td>
    
    <td>
      <?php echo $json[$i]['u_p'];;  ?>
    </td>
    <td><?php echo $json[$i]['no_faktur_no_po']; ?></td>
    <td>
    <?php if ($json[$i]['u_p']=='Hutang') { ?>
    <a href="#" data-toggle="modal" data-target="#modal-detailhutang<?php echo $json[$i]['id_up']; ?>"><small data-toggle="tooltip" title="Detail Barang" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a>
    <?php } else { ?>
    <a href="#" data-toggle="modal" data-target="#modal-detailpiutang<?php echo $json[$i]['id_up']; ?>"><small data-toggle="tooltip" title="Detail Barang" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a>
    <?php } ?>
    </td>
    <td><?php echo $json[$i]['klien']; ?></td>
    
      <td><?php echo $json[$i]['deskripsi']; ?></td>
      <td><?php echo "Rp".number_format($json[$i]['nominal_up'],2,',','.'); ?></td>
      <td>
      <?php
      $dd = mysqli_fetch_array(mysqli_query($koneksi, "select * from utang_piutang_bayar where buku_kas_id=$_GET[id] and utang_piutang_id=".$json[$i]['id_up']." order by tgl_bayar DESC LIMIT 1"));
	  echo "<b>".date("d/m/Y",strtotime($dd['tgl_bayar']))." : </b><br>Rp".number_format($dd['nominal'],2,',','.');
	  ?>
      <hr style="margin:0px"/>
      <font style="font-size:11px"><?php 
	$ddd = mysqli_fetch_array(mysqli_query($koneksi, "select sum(nominal) as nominal_bayar from utang_piutang_bayar where utang_piutang_id=".$json[$i]['id_up'].""));
	echo "Total Pembayaran : Rp".number_format($ddd['nominal_bayar'],2,',','.'); ?></font></td>
      <td><?php if ($json[$i]['status_lunas']==0){echo "Belum Lunas";}else {echo "Sudah Lunas";} ?></td>
    
    <?php if ($json[$i]['stok_total']==0) { $color="red"; } else { $color=""; } ?>
    <td>
    <a href="index.php?page=detail_buku_kas&id=<?php echo $_GET['id']; ?>&id_up=<?php echo $json[$i]['id_up']; ?>" class="label label-info"><span data-toggle="tooltip" title="Detail" class="fa fa-toggle-right"></span> Detail</a>
    </td>
  </tr>
  <div class="modal fade" id="modal-detailhutang<?php echo $json[$i]['id_up']; ?>">
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
	  $q=mysqli_query($koneksi, "select nama_brg,tipe_brg,qty,status_ke_stok from barang_pesan_detail,barang_gudang,barang_pesan where barang_gudang.id=barang_pesan_detail.barang_gudang_id and barang_pesan.id=barang_pesan_detail.barang_pesan_id and barang_pesan.no_po_pesan='".$json[$i]['no_faktur_no_po']."'");
	  $n=0;
	  while ($d1=mysqli_fetch_array($q)) {
	  $n++;
	  ?>
      <?php if ($d1['status_ke_stok']==1) { ?>
        <font class="pull pull-right" size="+1"><span class="fa fa-share"></span></font>
        <?php } ?>
      <?php echo $n.". ".$d1['nama_brg']."     |    "; ?></td>
      <?php echo $d1['tipe_brg']."  |  " ?></td>
      <?php echo $d1['qty']; ?>
      
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
        
        <div class="modal fade" id="modal-detailpiutang<?php echo $json[$i]['id_up']; ?>">
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
	  $q2=mysqli_query($koneksi, "select *,barang_dijual_qty.id as id_det_jual from barang_dijual_qty,barang_dijual,barang_gudang where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual.no_po_jual='".$json[$i]['no_faktur_no_po']."'");
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
  <?php } ?>
</table>
              </div>              
              </div>
            </div>
			<?php } ?>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->
          <?php
          $cek5 = mysqli_num_rows(mysqli_query($koneksi, "select * from biaya_lain where buku_kas_id=".$_GET['id'].""));
		  if ($cek5!=0) {
		  ?>
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Riwayat Penerimaan &amp; Pembayaran </h3>
              <!--<a href="cetak_buku_kas.php?id=<?php echo $_GET['id']; ?>"><button class="btn btn-success pull pull-right"><span class="fa fa-print"></span> &nbsp;Print Excel</button></a>-->
              </div><div class="box-body">
              <a href="cetak_buku_kas.php?id=<?php echo $_GET['id']; ?>"><button class="btn btn-warning pull pull-left"><span class="fa fa-print"></span> &nbsp;Print Excel</button></a>
              <?php if (isset($_GET['kunci2']) or isset($_GET['tgl_awal'])) { ?>
              <a href="?page=ubah_buku_kas&id=<?php echo $_GET['id'] ?>"><button class="btn btn-info pull pull-right"><span class="fa fa-refresh"></span> Reset</button></a>&nbsp;&nbsp;
              <?php } ?>
              <button class="btn btn-success pull pull-right" data-toggle="modal" data-target="#modal-pencarian2"><span class="fa fa-search"></span> Pencarian</button>
              <?php if (isset($_GET['kunci2']) or isset($_GET['tgl_awal'])) { ?>
              <div class="pull pull-left">Data Berdasarkan : <?php 
			  if ($_GET['pilihan2']=='penerima') {echo "<u><em>Penerima/Pembeli</em></u>, Kata Kunci : ";}
			  else {
				  $tgl11=date("d/m/Y",strtotime($_GET['tgl_awal']));
				  $tgl22=date("d/m/Y",strtotime($_GET['tgl_akhir']));
				  echo "<u><em>Rentang Tanggal : $tgl11 - $tgl22</em></u>";}
			  echo "<u><em>".$_GET['kunci2']."</em></u>"; ?></div>
              <?php } ?>
              <hr />
              <div class="table-responsive">
              <table width="100%" id="<?php if (isset($_GET['pilihan2']) or isset($_GET['tgl_awal'])){echo "example1";} else {echo "example3";} ?>" class="table table-bordered table-hover">
                <thead>
    <tr>
      <th align="center" valign="top">No</th>
      <th valign="top">Jenis Transaksi</th>
        <th valign="top">Tanggal</th>
        <th valign="top">Akun Kas &amp; Bank</th>
        <th valign="top"><strong>Diterima Oleh / Diterima Dari</strong></th>
        <th  valign="top">Deskripsi</th>
        <th valign="top"><strong>Harga</strong></th>
      
          </tr>
  </thead>
  <tbody>
  <?php
 
// membuka file JSON
if (isset($_GET['id_keuangan'])) {
	if (isset($_GET['pilihan2']) and isset($_GET['kunci2'])) {
	$file = file_get_contents("http://localhost/ALKES/json/biaya_lain.php?id_keuangan=$_GET[id_keuangan]&id=$_GET[id]&pilihan=$_GET[pilihan2]&kunci=".str_replace(" ","%20",$_GET['kunci2'])."");
}
	elseif (isset($_GET['tgl_awal']) and isset($_GET['tgl_akhir'])) {
	$file = file_get_contents("http://localhost/ALKES/json/biaya_lain.php?id_keuangan=$_GET[id_keuangan]&id=$_GET[id]&tgl1=".$_GET['tgl_awal']."&tgl2=".$_GET['tgl_akhir']."");
}
	else {
$file = file_get_contents("http://localhost/ALKES/json/biaya_lain.php?id_keuangan=$_GET[id_keuangan]&id=$_GET[id]");
}
} else {
	if (isset($_GET['pilihan2']) and isset($_GET['kunci2'])) {
	$file = file_get_contents("http://localhost/ALKES/json/biaya_lain.php?id=$_GET[id]&pilihan=$_GET[pilihan2]&kunci=".str_replace(" ","%20",$_GET['kunci2'])."");
}
	elseif (isset($_GET['tgl_awal']) and isset($_GET['tgl_akhir'])) {
	$file = file_get_contents("http://localhost/ALKES/json/biaya_lain.php?id=$_GET[id]&tgl1=".$_GET['tgl_awal']."&tgl2=".$_GET['tgl_akhir']."");
}
	else {
$file = file_get_contents("http://localhost/ALKES/json/biaya_lain.php?id=$_GET[id]");
}
}
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
#C33 
$tambahan = $json[$i]['harga'] * $json[$i]['jumlah'];
?>

  <tr>
    <td align="center" valign="center"><?php echo $i+1; ?></td>
    <td valign="center"><?php echo $json[$i]['jenis_transaksi']; ?></td>
    <td valign="center"><?php echo date("d M Y",strtotime($json[$i]['tgl']));?></td>
    <td>
    <?php 
	$akun = mysqli_fetch_array(mysqli_query($koneksi, "select * from buku_kas where id=".$json[$i]['buku_kas_id'].""));
	echo $akun['nama_akun'];
	?>
    </td>
    <td><?php echo $json[$i]['penerima']; ?></td>
    
    <td>
      <?php echo $json[$i]['deskripsi'];  ?></td>
    <td><?php echo "Rp ".number_format($json[$i]['harga'],2,',','.'); ?></td>
    
  </tr>
  <?php } ?>
  </tbody>
</table>
              </div>
<br /><br />
              
              </div>
            </div>
          </div>
          <?php } ?>
          <?php
          $cek6 = mysqli_num_rows(mysqli_query($koneksi, "select * from reimburse where buku_kas_id=".$_GET['id'].""));
		  if ($cek6!=0) {
		  ?>
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Riwayat Reimburse </h3>
              <!--<a href="cetak_buku_kas.php?id=<?php echo $_GET['id']; ?>"><button class="btn btn-success pull pull-right"><span class="fa fa-print"></span> &nbsp;Print Excel</button></a>-->
              </div><div class="box-body">
              <a href="cetak_buku_kas.php?id=<?php echo $_GET['id']; ?>"><button class="btn btn-warning pull pull-left"><span class="fa fa-print"></span> &nbsp;Print Excel</button></a>
              <?php if (isset($_GET['kunci2']) or isset($_GET['tgl_awal'])) { ?>
              <a href="?page=ubah_buku_kas&id=<?php echo $_GET['id'] ?>"><button class="btn btn-info pull pull-right"><span class="fa fa-refresh"></span> Reset</button></a>&nbsp;&nbsp;
              <?php } ?>
              <button class="btn btn-success pull pull-right" data-toggle="modal" data-target="#modal-pencarian2"><span class="fa fa-search"></span> Pencarian</button>
              <?php if (isset($_GET['kunci2']) or isset($_GET['tgl_awal'])) { ?>
              <div class="pull pull-left">Data Berdasarkan : <?php 
			  if ($_GET['pilihan2']=='penerima') {echo "<u><em>Penerima/Pembeli</em></u>, Kata Kunci : ";}
			  else {
				  $tgl11=date("d/m/Y",strtotime($_GET['tgl_awal']));
				  $tgl22=date("d/m/Y",strtotime($_GET['tgl_akhir']));
				  echo "<u><em>Rentang Tanggal : $tgl11 - $tgl22</em></u>";}
			  echo "<u><em>".$_GET['kunci2']."</em></u>"; ?></div>
              <?php } ?>
              <hr />
              <div class="table-responsive">
              <table width="100%" id="example1" class="table table-bordered table-hover">
                <thead>
    <tr>
      <th width="" valign="top">ID</th>
      <th width="" valign="top">Tanggal</th>
      <th width="" valign="top"><strong>Nama Akun</strong></th>
      <th width="" valign="top">Keterangan</th>
      <th width="" valign="top">Buku Kas</th>
      <th width="" valign="top"><strong>Nominal</strong></th>
      <th width="" align="center" valign="top">Deskripsi</th>
    </tr>
  </thead>
  <?php
 
// membuka file JSON
$file = file_get_contents("http://localhost/ALKES/json/reimburse.php");
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
#C33
?>
<?php if ($json[$i]['status_lunas']==0){$b="#FF0000";} else {$b="#00CC66";} ?>
  <tr>
    <td><?php echo "RE".$json[$i]['idd']; ?></td>
    <td><?php echo date("d/m/Y", strtotime($json[$i]['tgl_reimburse']));  ?></td>
    
    <td>
    <?php echo $json[$i]['nama_akun_reimburse'];  ?>
    </td>
    <td><?php echo $json[$i]['keterangan']; ?></td>
    <td><?php echo $json[$i]['nama_akun']; ?></td>
    <td><?php echo "Rp ".number_format($json[$i]['nominal'],2,',','.'); ?></td>
    <td>Di kantor di tambah</td>
  </tr>
  <?php } ?>
</table>
              </div>
<br /><br />
              
              </div>
            </div>
          </div>
          <?php } ?>
        <!-- quick email widget --></section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

  </section>
  
    <!-- /.content -->
  </div>
  
  <?php 
  if (isset($_POST['tambah_detail'])) {
	  $in = mysqli_query($koneksi,"insert into coa_detail values('','".$_GET['id']."','".$_POST['no_akun']."','".$_POST['nama_akun']."','".$_POST['akun_tipe']."','".$_POST['header']."','".$_POST['saldo_detail']."')");
	  if ($in) {
		  mysqli_query($koneksi, "update coa set saldo_total=saldo_total+$_POST[saldo_detail] where id=$_GET[id]");
		  echo "<script>
		  alert('Berhasil di simpan !');
		  window.location='index.php?page=ubah_buku_kas&id=$_GET[id]';
		  </script>";
		  }
	  }
  ?>
  <div id="openTambah" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <center><h3>Tambah Detail</h3></center>
        <br />
        <?php 
		$sel = mysqli_fetch_array(mysqli_query($koneksi, "select max(no_akun)+1 as maks from coa_detail where coa_id=$_GET[id]"));
		?>
        <form method="post">
        	
              <label>No. Akun</label>
              <input name="no_akun" class="form-control" type="text" placeholder="" value=""><br />
              <label>Nama Akun</label>
              <input name="nama_akun" class="form-control" type="text" placeholder="" value=""><br />
              <label>Tipe Akun</label>
              <input name="akun_tipe" class="form-control" type="text" placeholder="" value=""><br />
              <label>Header</label>
              <input name="header" class="form-control" type="text" placeholder="" value="Detail" readonly="readonly"><br />
              <label>Saldo</label>
              <input name="saldo_detail" class="form-control" type="text" placeholder="" value=""><br />
              <input id="buttonn" name="tambah_detail" type="submit" value="Tambah" />
        </form>
    </div>
</div>

<?php 
if (isset($_POST['ubah_detail'])) {
	$se=mysqli_fetch_array(mysqli_query($koneksi, "select * from coa_detail where id=$_GET[id_ubah]"));
	$u = mysqli_query($koneksi, "update coa set saldo_total=saldo_total-$se[saldo] where id=$_GET[id]");
	if ($u) {
	$q = mysqli_query($koneksi, "update coa_detail set no_akun='".$_POST['no_akun']."',nama_akun='".$_POST['nama_akun']."', akun_tipe='".$_POST['akun_tipe']."',saldo='".$_POST['saldo_detail']."' where id=".$_GET['id_ubah']."");
	if ($q) {
		mysqli_query($koneksi, "update coa set saldo_total=saldo_total+$_POST[saldo_detail] where id=$_GET[id]");
		echo "<script>
		alert('Berhasil diubah');
		window.location='index.php?page=ubah_buku_kas&id=$_GET[id]'
		</script>";
		}
	}
	}
?>
<div id="openUbah" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <center><h3>Ubah Detail</h3></center>
        <br />
        <?php 
		$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from coa_detail where id=$_GET[id_ubah]"));
		?>
        <form method="post">
        	
              <label>No. Akun</label>
              <input name="no_akun" class="form-control" type="text" placeholder="" value="<?php echo $sel['no_akun']; ?>"><br />
              <label>Nama Akun</label>
              <input name="nama_akun" class="form-control" type="text" placeholder="" value="<?php echo $sel['nama_akun']; ?>"><br />
              <label>Tipe Akun</label>
              <input name="akun_tipe" class="form-control" type="text" placeholder="" value="<?php echo $sel['akun_tipe']; ?>"><br />
              <label>Header</label>
              <input name="header" class="form-control" type="text" placeholder="" value="Detail" readonly="readonly"><br />
              <label>Saldo</label>
              <input name="saldo_detail" class="form-control" type="text" placeholder="" value="<?php echo $sel['saldo']; ?>"><br />
              <input id="buttonn" name="ubah_detail" type="submit" value="Simpan Perubahan" />
        </form>
    </div>
</div>

<div class="modal fade" id="modal-pencarian">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              <script type="text/javascript">
			  function yesnoCheck() {
				  if (document.getElementById('yesCheck').value=='tgl_bayar') {
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
                <option value="tgl_bayar">Berdasarkan Rentang Tanggal Pembayaran</option>
                <option value="no_faktur_no_po">Berdasarkan Nomor PO</option>
                <option value="klien">Berdasarkan Nama Klien</option>
                <option value="nama_brg">Berdasarkan Nama Barang</option>
                <option value="tipe_brg">Berdasarkan Tipe Barang</option>
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
  
  
  <div class="modal fade" id="modal-pencarian2">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              <script type="text/javascript">
			  function yesnoCheck2() {
				  if (document.getElementById('yesCheck2').value=='tgl') {
					  document.getElementById('ifYes2').style.display = 'block';
					  document.getElementById('kata_kunci2').style.display = 'none';
					  }
					  else 
					  { document.getElementById('ifYes2').style.display = 'none';
					  document.getElementById('kata_kunci2').style.display = 'block';
					  }
					  }

 

</script>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pencarian</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <select class="form-control select2" name="pilihan" required style="width:100%" onchange="javascript:yesnoCheck2();" id="yesCheck2">
                <option value="">...</option>
                <option value="tgl">Berdasarkan Rentang Tanggal</option>
                <option value="penerima">Berdasarkan Penerima/Pemberi</option>
                
                </select>
                <br /><br />
                <div id="kata_kunci2" style="display:block">
                <input type="text" class="form-control" name="kata_kunci" placeholder="Kata Kunci"/>
                </div>
                <div id="ifYes2" style="display:none">
              <label>Dari Tanggal</label>
              <input name="tgl1" type="date" class="form-control" placeholder="" value=""><br />
              <label>Sampai Tanggal</label>
              <input name="tgl2" type="date" class="form-control" placeholder="" value="">
              </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" name="pencarian2">Cari</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>