<?php
if (isset($_POST['simpan_1'])) {
	$id=$_POST['id_lamp1'];
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id)+1 as maks from alat_pelatihan"));
	$ext = explode(".",$_FILES['lamp1']['name']);
	//$ext2 = explode(".",$_FILES['lamp2']['name']);
	if ($_FILES['lamp1']['name']!='') { 
	$lamp1="Lampiran1_".$max['maks'].".".$ext[1];
	} else {
		$lamp1="";
		}
	//$lamp2="Lampiran2_".$max['maks'].".".$ext2[1];
	  $R = mysqli_query($koneksi, "update alat_pelatihan set lamp1='$lamp1' where id=$id");
	  if ($R) {
		  copy($_FILES['lamp1']['tmp_name'], "gambar_pelatihan/lampiran1/$lamp1");
		  echo "<script type='text/javascript'>
		  window.location='index.php?page=pelatihan_alat_lama&id_rumkit=$_GET[id_rumkit]';
		</script>";
		  }
	  }

if (isset($_POST['simpan_2'])) {
	$id=$_POST['id_lamp2'];
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id)+1 as maks from alat_pelatihan"));
	//$ext = explode(".",$_FILES['lamp1']['name']);
	$ext2 = explode(".",$_FILES['lamp2']['name']);
	//$lamp1="Lampiran1_".$max['maks'].".".$ext[1];
	if ($_FILES['lamp2']['name']!='') {
	$lamp2="Lampiran2_".$max['maks'].".".$ext2[1];
	} else {
		$lamp2="";
		}
	  $R = mysqli_query($koneksi, "update alat_pelatihan set lamp2='$lamp2' where id=$id");
	  if ($R) {
		  copy($_FILES['lamp2']['tmp_name'], "gambar_pelatihan/lampiran2/$lamp2");
		  echo "<script type='text/javascript'>
		  window.location='index.php?page=pelatihan_alat_lama&id_rumkit=$_GET[id_rumkit]';
		</script>";
		  }
	  }
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pelatihan Penggunaan
     Alkes</h1><ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pelatihan Penggunaan Alkes</li>
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
              <!--<a href="index.php?page=tambah_barang_masuk"><button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah Barang</button></a>-->
              <!--<form method="post">
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
              </form>-->
              <div class="table-responsive">
              <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">Nama RS/Dinas/Klinik/dll</th>
      <th valign="bottom">Alamat</th>
      <th valign="bottom"><strong>Kontak RS/Dinas/dll</strong></th>
      </tr>
  </thead>
  <tr>
    <td><?php 
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from pembeli where id=$_GET[id_rumkit]"));
	echo $sel['nama_pembeli']; ?></td>
    <td><?php echo $sel['jalan']; ?></td>
    <td><?php echo $sel['kontak_rs']; ?></td>
    </tr>
</table>
              </div>
              <br />
              <h3 align="center">
                  Detail Alkes
                </h3>
                <span class="pull pull-right">
              <table>
  <tr>
    <td valign="top"><strong style="color:#F00">Keterangan</strong> : &nbsp;&nbsp;&nbsp;</td>
    <td valign="top">1. </td>
    <td valign="top">Jika <strong>Box</strong> Di <strong>No Seri</strong> Berwarna <strong style="color:#F00">Merah</strong> , Itu menandakan<br />
barang telah dikembalikan karena mengalami kerusakan</td>
  </tr>
</table>
              </span><br /><br /><br />
                <div class="table-responsive">
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td align="center"><strong>No</strong>
        </th>
        
        <th valign="bottom"><strong>Nama Alkes</strong></th>
      <th valign="bottom"><strong>No Seri</strong></th>
      
      <th valign="bottom"><strong>Jumlah Peserta</strong></th>
      <th valign="bottom"><strong>Pelatih</strong></th>
      <th valign="bottom"><strong>Tgl Pelatihan</strong></th>
      <td align="center" valign="bottom"><strong>Pelatihan Oleh</strong>      
      <td align="center" valign="bottom"><strong>Lamp. 1   
        </strong>
        <td align="center" valign="bottom"><strong>Lamp. 2    
          </strong>
          <td align="center" valign="bottom"><strong>Aksi</strong></th>
            </tr>
  </thead>
  <?php
 
// membuka file JSON
 if (isset($_SESSION['id_b'])) {
$file = file_get_contents("http://localhost/ALKES/json/pelatihan_alat_lama.php?id_rumkit=$_GET[id_rumkit]&id_b=$_SESSION[id_b]");	 
	 }
 else {
$file = file_get_contents("http://localhost/ALKES/json/pelatihan_alat_lama.php?id_rumkit=$_GET[id_rumkit]");
 }
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
?>
  <tr>
    <td align="center"><?php echo $i+1; ?></td>
    <td <?php if ($json[$i]['status_batal']==1){echo "bgcolor='red'";} ?>><?php echo $json[$i]['nama_brg']; ?>
    </td>
    <td><?php echo $json[$i]['no_seri_brg']." ".$json[$i]['nama_set']; ?></td>
    <td><?php echo $json[$i]['banyak_peserta']." Orang"; ?></td>
    <td><?php echo $json[$i]['pelatih']; ?></td>
    <td><?php echo date("d F Y",strtotime($json[$i]['tgl_pelatihan'])); ?></td>
    <td align="center"><?php echo $json[$i]['pelatihan_oleh']; ?></td>
    <td align="center">
    <a href="#" data-toggle="modal" data-target="#modal-ubahlamp1<?php echo $json[$i]['idd'] ?>"><small data-toggle="tooltip" title="Ubah Lampiran" class="label bg-blue pull pull-right pull-top">Ubah</small></a>
    <?php if ($json[$i]['lamp1']!="") { ?>
    <a href="#" data-toggle="modal" data-target="#modal-lampiran1<?php echo $json[$i]['idd']; ?>"><img src="gambar_pelatihan/lampiran1/<?php echo $json[$i]['lamp1']; ?>" width="50px" /></a>
    <?php } ?>
    </td>
    <td align="center">
    <a href="#" data-toggle="modal" data-target="#modal-ubahlamp2<?php echo $json[$i]['idd'] ?>"><small data-toggle="tooltip" title="Ubah Lampiran" class="label bg-blue pull pull-right pull-top">Ubah</small></a>
    <?php if ($json[$i]['lamp2']!="") { ?>
    <a href="#" data-toggle="modal" data-target="#modal-lampiran2<?php echo $json[$i]['idd']; ?>"><img src="gambar_pelatihan/lampiran2/<?php echo $json[$i]['lamp2']; ?>" width="50px" /></a>
    <?php } ?>
    </td>
    <td align="center">
    <?php if (!isset($_SESSION['id_b'])) { ?>
    <a href="pages/delete_pelatihan.php?id_rumkit=<?php echo $_GET['id_rumkit']; ?>&id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a> &nbsp;&nbsp;<?php } ?><a href="index.php?page=ubah_latih&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp;&nbsp;<a href="index.php?page=sertifikat&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Cetak Sertifikat Pelatiihan" class="fa fa-print"></span></a>&nbsp;&nbsp;<a href="cetak_report_training.php?id=<?php echo $json[$i]['idd'] ?>&alkes=<?php echo $json[$i]['nama_brg'] ?>&no_seri=<?php echo $json[$i]['no_seri_brg'] ?>"><span data-toggle="tooltip" title="Download Report" class="glyphicon glyphicon-print"></span>
      </a>   
    </td>
  </tr>
  <div class="modal fade" id="modal-ubahlamp1<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" align="center">Ubah Lampiran 1</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
              <input type="hidden" name="id_lamp1" value="<?php echo $json[$i]['idd'] ?>" />
              <input name="lamp1" type="file" class="form-control"/>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button name="simpan_1" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        
        <div class="modal fade" id="modal-ubahlamp2<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" align="center">Ubah Lampiran 2</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
              <input type="hidden" name="id_lamp2" value="<?php echo $json[$i]['idd'] ?>" />
              <input name="lamp2" type="file" class="form-control"/>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button name="simpan_2" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
  
  <div class="modal fade" id="modal-lampiran1<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              </div>
              <form method="post">
              <div class="modal-body">
              <img src="gambar_pelatihan/lampiran1/<?php echo $json[$i]['lamp1']; ?>" width="100%" height="auto"/>
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
        
        <div class="modal fade" id="modal-lampiran2<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              </div>
              <form method="post">
              <div class="modal-body">
              <img src="gambar_pelatihan/lampiran2/<?php echo $json[$i]['lamp2']; ?>" width="100%" height="auto"/>
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
  if (isset($_POST['jual'])) {
	  $jml1 = mysqli_fetch_array(mysqli_query($koneksi, "select * from master_barang where id=".$_GET['id'].""));
	  if ($_POST['qty']<=$jml1['stok']) {
	  $q = mysqli_query($koneksi, "insert into jual_barang values('','".$_GET['id']."','".$_POST['pembeli']."','".$_POST['qty']."','".$_POST['tgl_beli']."','','','')");
	  if ($q) {
		  mysqli_query($koneksi, "update master_barang set stok=stok-".$_POST['qty']." where id=".$_GET['id']."");
		  echo "<script type='text/javascript'>
		  window.location='index.php?page=jual_barang';
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
        <h3 align="center">Jual Barang</h3> 
     <form method="post">
     <input id="input" type="date" placeholder="" name="tgl_beli" required>
     <input id="input" type="text" placeholder="Pembeli" name="pembeli" required>
        <input id="input" type="text" placeholder="Quantity" name="qty" required>
        <button id="buttonn" name="jual" type="submit">Jual Barang</button>
    </form>
    </div>
</div>
