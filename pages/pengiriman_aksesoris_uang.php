<?php 
if (isset($_GET['id_b_s'])) {
	$q=mysqli_query($koneksi, "update aksesoris_kirim set tgl_sampai_akse='' where id=".$_GET['id_b_s']."");
	if ($q) {
		echo "<script>window.location='index.php?page=pengiriman_aksesoris'</script>";
		}
	}
	
if (isset($_GET['id_hapus'])) {
	$sel = mysqli_query($koneksi, "select * from aksesoris_kirim_detail where aksesoris_kirim_id=".$_GET['id_hapus']."");
		while ($da = mysqli_fetch_array($sel)) {
			mysqli_query($koneksi, "update aksesoris_detail set status_kirim_akse=0 where id=".$da['aksesoris_detail_id']."");
			}
	$jml_sel = mysqli_num_rows(mysqli_query($koneksi, "select * from aksesoris_kirim_detail where aksesoris_kirim_id=".$_GET['id_hapus'].""));
	$up = mysqli_query($koneksi, "update aksesoris,aksesoris_detail,aksesoris_kirim_detail set stok_total_akse=stok_total_akse+$jml_sel where aksesoris.id=aksesoris_detail.aksesoris_id and aksesoris_detail.id=aksesoris_kirim_detail.aksesoris_detail_id and aksesoris_kirim_id=".$_GET['id_hapus']."");
	$hapus = mysqli_query($koneksi, "delete from aksesoris_kirim_detail where aksesoris_kirim_id=".$_GET['id_hapus']."");
	$hapus2 = mysqli_query($koneksi, "delete from aksesoris_kirim where id=".$_GET['id_hapus']."");
	if ($hapus and $hapus2) {
		echo "<script>window.location='index.php?page=pengiriman_aksesoris'</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pengiriman Aksesoris
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kirim Aksesoris</li>
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
              <div class="box-body table-responsive no-padding">
              <div class="">
              <!--<a href="index.php?page=tambah_barang_kirim">
              <button name="tambah_laporan" class="btn btn-warning" type="submit"><span class="fa fa-plus"></span> Kirim Alkes</button></a><br /><br />
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
              -->
             <br />
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th align="center">#</th>
        
        <th bgcolor="#99FFCC">Tanggal Kirim</th>
        <th>Nama Paket</th>
        
        <th>No Pengiriman</th>
        <th>No PO</th>
      <th><strong>Detail Alkes</strong></th>
      <th><strong>Tempat Tujuan</strong></th>
      
      <th bgcolor="#99FFCC"><strong>Tanggal Sampai</strong></th>
     
      </tr>
  </thead>
  <?php
 
// membuka file JSON
$file = file_get_contents("http://localhost/ALKES/json/pengiriman_aksesoris.php");
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
?>
  <tr>
    <td align="center"><?php echo $i+1; ?></td>
    <td bgcolor="#99FFCC"><?php echo date("d M Y",strtotime($json[$i]['tgl_kirim_akse'])); ?></td>
    <td><?php echo $json[$i]['nama_paket_akse']; ?></td>
    
    <td><?php echo $json[$i]['no_pengiriman_akse']; ?></td>
    <td><?php echo $json[$i]['po_no_akse']; ?></td>
    <td>
    <table width="100%" border="0">
      <?php 
	  $q=mysqli_query($koneksi, "select *,aksesoris_kirim.id as idd from aksesoris,aksesoris_detail,aksesoris_kirim,aksesoris_kirim_detail where aksesoris.id=aksesoris_detail.aksesoris_id and aksesoris_detail.id=aksesoris_kirim_detail.aksesoris_detail_id and aksesoris_kirim.id=aksesoris_kirim_detail.aksesoris_kirim_id and aksesoris_kirim.id=".$json[$i]['idd']."");
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
        <td align="left"><?php echo $d1['nama_akse']."|"; ?></td>
        <td align="right"><?php echo $d1['no_seri_akse']." ".$d1['nama_set_akse']; ?></td>
        </tr>
      <?php } ?>
    </table>
    </td>
    <td><?php 
	$data3=mysqli_fetch_array(mysqli_query($koneksi, "select nama_pembeli,aksesoris_kirim.id as idd from aksesoris,aksesoris_detail,aksesoris_jual,aksesoris_jual_qty,pembeli,aksesoris_kirim,aksesoris_kirim_detail where aksesoris.id=aksesoris_detail.aksesoris_id and aksesoris_detail.id=aksesoris_kirim_detail.aksesoris_detail_id and aksesoris_jual.id=aksesoris_jual_qty.aksesoris_jual_id and aksesoris_jual_qty.id=aksesoris_kirim_detail.aksesoris_jual_qty_id and pembeli.id=aksesoris_jual.pembeli_id and aksesoris_kirim.id=aksesoris_kirim_detail.aksesoris_kirim_id and aksesoris_kirim.id=".$json[$i]['idd'].""));
	echo $data3['nama_pembeli']; ?></td>
    
    <?php 
	if ($json[$i]['tgl_sampai_akse']!=0000-00-00) {
		$bg="#99FFCC";
		}
		else {
			$bg="red";
			}
	?>
    <td bgcolor=<?php echo $bg; ?>>
      <?php
		if ($json[$i]['tgl_sampai_akse']!=0000-00-00) {
	echo date("d M Y", strtotime($json[$i]['tgl_sampai_akse'])); } else {
		echo "-";
		} ?>
    </td>
    
    </tr>
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
	  $tgl_k = mysqli_fetch_array(mysqli_query($koneksi, "select * from aksesoris_kirim where id=".$_GET['id'].""));
	  if ($_POST['tgl_sampai']>=$tgl_k['tgl_kirim_akse']) {
	  $que = mysqli_query($koneksi, "update aksesoris_kirim set tgl_sampai_akse='".$_POST['tgl_sampai']."' where id=".$_GET['id']."");
	  if ($que) {
		  //mysqli_query($koneksi, "insert into uji_f_i values('','".$_GET['id']."','0','0','')");
		  echo "<script type='text/javascript'>
		  window.location='index.php?page=pengiriman_aksesoris'
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
        <h3 align="center">Status Pengiriman Aksesoris</h3>
        <?php $d=mysqli_fetch_array(mysqli_query($koneksi, "select * from aksesoris_kirim where id=".$_GET['id']."")); ?> 
     <form method="post">
     <label>Tanggal Sampai</label>
     <input id="input" type="date" placeholder="" name="tgl_sampai" required value="<?php echo $d['tgl_sampai_akse']; ?>">
     <!--<label>Keterangan</label>
     <textarea rows="4" id="input" type="text" placeholder="Keterangan" name="keterangan"><?php echo $d['ket_brg']; ?></textarea>-->
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