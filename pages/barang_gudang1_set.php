
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Barang Set</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Barang Set</li>
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
              <span class="pull pull-right">
              <table>
  <tr>
    <td><strong style="color:#F00">Keterangan</strong> : &nbsp;&nbsp;&nbsp;</td>
    <td valign="top">1. </td>
    <td valign="top">Tanda "<span class="fa fa-share"></span>" Menandakan Sudah Di Mutasi ke Gudang Utama / Gudang 2</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td valign="top">2. </td>
    <td valign="top">Isi <strong>Status Lunas</strong> Atau <strong>Tanggal Masuk</strong> dengan tekan tombol <strong>Pelunasan</strong> untuk memunculkan tombol &quot;<span class="fa fa-sign-out"></span>&quot;(Mutasi ke Gudang Utama)</td>
  </tr>
</table>
             </span>
              <br />
              <br />             
              <br />
              <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th align="center">#</th>
      <th valign="top">Tgl PO</th>
        <th valign="top">No PO</th>
        <th valign="top">Jenis PO</th>
      <th valign="top"><strong>Nama Barang</strong><strong class="pull pull-right">Qty Set</strong></th>
      <?php if (!isset($_SESSION['user_admin_gudang'])) { ?>
      
      <th align="center" valign="top"><strong>PPN</strong></th>
        <th align="center" valign="top"><strong>Total Price</strong>        </th>
        <th align="center" valign="top">Total Keseluruhan</th>
        <th align="center" valign="top">Status Lunas</th>
        <?php } ?>
        <th align="center" valign="top">Tgl Masuk</th>
        <th align="center" valign="top"><strong>Aksi</strong></th>
          </tr>
  </thead>
  <?php
 
// membuka file JSON
$file = file_get_contents("http://localhost/ALKES/json/barang_gudang1_set.php");
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
    
      <td><table width="100%" border="0">
        <?php 
	  $q=mysqli_query($koneksi, "select * from barang_pesan_detail_set,barang_gudang_set where barang_gudang_set.id=barang_pesan_detail_set.barang_gudang_set_id and barang_pesan_detail_set.barang_pesan_set_id=".$json[$i]['idd']."");
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
          <td style="padding-left:5px"><?php echo $d1['nama_brg'] ?></td>
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
    /*$q = mysqli_query($koneksi, "select * from barang_pesan_detail where barang_pesan_id=".$data['idd']."");
  $n=0;
  $total_akse2=0;
  while ($d = mysqli_fetch_array($q)) {
  	$q_akse = mysqli_query($koneksi, "select * from aksesoris_alkes,aksesoris where aksesoris.id=aksesoris_alkes.aksesoris_id and aksesoris_alkes.barang_gudang_id=".$d['barang_gudang_id']."");
  $no=0;
  $total_akse=0;
  	while ($d_akse = mysqli_fetch_array($q_akse)) {
		$total_akse = $total_akse+($d_akse['qty']*$d_akse['harga_akse'])-(($d_akse['qty']*$d_akse['harga_akse'])*$d['diskon']/100); 
  	}
	$total_akse2 = $total_akse2 + $total_akse;
  }
  $total = mysqli_fetch_array(mysqli_query($koneksi, "select sum(harga_total) as total from barang_pesan_detail where barang_pesan_id=".$data['idd'].""));*/
  echo $json[$i]['simbol']." ".number_format($json[$i]['total_price'],0,',',',').".00";
	?></td>
    <td><?php echo $json[$i]['simbol']." ".number_format($json[$i]['cost_cf'],0,',',',').".00"; ?></td>
    <td><?php if ($json[$i]['status_lunas']==0) {
		echo "Belum";
		}
		else {echo "Sudah";} ?></td>
        <?php } ?>
    <td><?php if ($json[$i]['tgl_masuk_gudang']==0000-00-00) {
		echo "-";
		} else {
			echo date("d/m/Y", strtotime($json[$i]['tgl_masuk_gudang']));
			} ?></td>
    <td align="center">
    <?php { ?>
      <a href="index.php?page=barang_gudang1_set&id=<?php echo $json[$i]['idd']; ?>#openLunas"><small data-toggle="tooltip" title="Tgl Masuk Gudang" class="label bg-green">Tgl Masuk Gudang</small></a><br />
      <?php } ?>
      <?php if ($json[$i]['status_lunas']==1 or $json[$i]['tgl_masuk_gudang']!='0000-00-00') { ?>
      <a href="index.php?page=mutasi_set&id=<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Mutasi Ke Gudang" class="label bg-yellow">Mutasi</small></a><br /><?php } ?>
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
	$q_lunas=mysqli_query($koneksi, "update barang_pesan_set set tgl_masuk_gudang='".$_POST['tgl_lunas']."' where id=$_GET[id]");
	if ($q_lunas) {
		echo "<script type='text/javascript'>
		window.location='index.php?page=barang_gudang1_set';
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


