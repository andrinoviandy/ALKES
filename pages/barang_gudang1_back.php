<?php 
if (isset($_POST['lihat'])) {
	echo "<script>
	window.location='index.php?page=barang_gudang1&tgl1=$_POST[tgl1]&tgl2=$_POST[tgl2]&mutasi=$_POST[mutasi]';
	</script>";
	}
if (isset($_POST['print'])) {
	echo "<script>
	window.open('print_barang_gudang1.php&tgl1=$_POST[tgl1]&tgl2=$_POST[tgl2]&mutasi=$_POST[mutasi]', '_blank');
	</script>";
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <?php if (isset($_SESSION['user_admin_gudang']) or isset($_SESSION['user_manajer_gudang'])){ ?>
      Gudang 1
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
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
              <div class="box-body table-responsive no-padding">
              
             
              <!--
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
              </form>
              
              <form method="post" class="">
              <div class="input-group input-group-md col-xs-4 pull pull-right">
                <input type="text" name="cari" placeholder="Keyword .. (Not ; Stok, Harga, Pengecekan)" class="form-control">
                    <span class="input-group-btn">
                      <button type="submit" name="button_cari" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari </button>
                    </span>
              </div>
              </form>-->
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-eye"></i> Lihat
              </button>
              <?php if (isset($_GET['mutasi'])) { ?>
              <a href="index.php?page=barang_gudang1"><button class="btn btn-warning">Reset</button></a>
              <?php } ?>
              <span class="pull pull-right">
              <table>
  <tr>
    <td><strong style="color:#F00">Keterangan</strong> : &nbsp;&nbsp;&nbsp;</td>
    <td valign="top">1. </td>
    <td valign="top">Tanda "<span class="fa fa-share"></span>" Menandakan Sudah Di Mutasi ke Gudang Utama / Gudang 2</td>
  </tr>
</table>
             </span>
              <br />
              <br />
              <?php if (isset($_GET['mutasi'])) { ?>
              <center>Data <?php echo $_GET['mutasi'] ?> Mutasi</center>
              <?php } ?>
              <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th align="center">#</th>
      <th valign="top">Tgl PO</th>
        <th valign="top">No PO</th>
        <th valign="top">Jenis PO</th>
        <th valign="top">Nama Principle</th>
      <th valign="top"><table width="100%">
        <tr>
          <td>Nama Alkes</td>
          <td>Tipe Brg</td>
          <td>Belum Mutasi</td>
          <td>Sudah Mutasi</td>
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
if (!isset($_GET['tgl1']) and !isset($_GET['tgl2']) and !isset($_GET['mutasi'])){
$file = file_get_contents("http://localhost/ALKES/json/barang_gudang1.php");	
}
else {
	if ($_GET['tgl1']!='' and $_GET['tgl2']!='' and $_GET['mutasi']!='') {
$file = file_get_contents("http://localhost/ALKES/json/barang_gudang1.php?tgl1=$_GET[tgl1]&tgl2=$_GET[tgl2]&mutasi1=$_GET[mutasi]");
}
elseif ($_GET['tgl1']=='' and $_GET['tgl2']=='' and $_GET['mutasi']!='') {
$file = file_get_contents("http://localhost/ALKES/json/barang_gudang1.php?mutasi2=$_GET[mutasi]");
}
	}
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
?>
  <tr>
    <td align="center"><?php echo $i+1; ?></td>
    <td><?php echo date("d-m-Y",strtotime($json[$i]['tgl_po_pesan'])); ?></td>
    <td><?php echo $json[$i]['no_po_pesan']; ?></td>
    <td><?php echo $json[$i]['jenis_po']; ?></td>
    <td><?php echo $json[$i]['nama_principle']; ?></td>
    
      <td><table width="100%" border="0">
        <?php 
	  $q=mysqli_query($koneksi, "select * from barang_pesan_detail,barang_gudang where barang_gudang.id=barang_pesan_detail.barang_gudang_id and barang_pesan_detail.barang_pesan_id=".$json[$i]['idd']."");
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
          <td style="padding-left:5px"><?php echo $d1['nama_brg'] ?>&nbsp;&nbsp;</td>
          <td style="padding-left:5px"><?php echo $d1['tipe_brg'] ?>&nbsp;&nbsp;</td>
          <td style="padding-left:1px; padding-right:1px" align="right"><?php 
		  $stok_sudah_mutasi = mysqli_fetch_array(mysqli_query($koneksi,"select stok as stok_sudah from barang_gudang_po where no_po_gudang='".$json[$i]['no_po_pesan']."' and barang_gudang_id=".$d1['barang_gudang_id'].""));
		  echo $d1['qty']-$stok_sudah_mutasi['stok_sudah']; ?>
            <?php if ($d1['qty']-$stok_sudah_mutasi['stok_sudah']==0) { ?>
            <span class="fa fa-share"></span>
            <?php } ?>
            </td>
          <td style="padding-left:1px; padding-right:1px" align="right">
		  <?php echo $stok_sudah_mutasi['stok_sudah']; ?>
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
    <?php if ($json[$i]['status_po_batal']==0) { ?>
    <?php if (isset($_SESSION['user_administrator']) or isset($_SESSION['user_admin_gudang'])){ ?>
      <a href="index.php?page=barang_gudang1&id=<?php echo $json[$i]['idd']; ?>#openLunas"><small data-toggle="tooltip" title="Tgl Masuk Gudang" class="label bg-green">Tgl Masuk Gudang</small></a><br />
      <?php if ($json[$i]['status_lunas']==1 or $json[$i]['tgl_masuk_gudang']!='0000-00-00') { ?>
      <a href="index.php?page=mutasi&id=<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Mutasi Ke Gudang" class="label bg-yellow">Mutasi</small></a><br /><?php }} ?>
      <a href="index.php?page=ubah_pembelian_alkes&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Detail" class="fa fa-caret-square-o-right"></span></a>
      
      <?php } else {echo "DIBATALKAN";}} ?>
    </td>
  </tr>
</table><br />

              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
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
	$q_lunas=mysqli_query($koneksi, "update barang_pesan set tgl_masuk_gudang='".$_POST['tgl_lunas']."' where id=$_GET[id]");
	if ($q_lunas) {
		echo "<script type='text/javascript'>
		window.location='index.php?page=barang_gudang1';
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

<section class="col-lg-2">
        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lihat / Print</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
              <label>Dari Tanggal</label>
                <input type="date" name="tgl1" class="form-control" />
                <br />
              <label>Sampai Tanggal</label>
                <input type="date" name="tgl2" class="form-control" />
                <br />
              <label>Mutasi</label>
                <select name="mutasi" class="form-control select2" style="width:100%" required>
                <option value="">...</option>
                <option value="Belum">Belum Mutasi</option>
                <option value="Sudah">Sudah Mutasi</option>
                </select>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" name="lihat" class="btn btn-primary">Lihat</button>
                <!--<button type="submit" name="print" class="btn btn-info">Print</button>-->
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
</section>


