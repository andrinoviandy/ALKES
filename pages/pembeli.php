<?php 
if (isset($_GET['id_hapus'])) {
	$hapus2 = mysqli_query($koneksi, "delete from aksesoris_detail where aksesoris_id=".$_GET['id_hapus']."");
	$hapus1 = mysqli_query($koneksi, "delete from aksesoris_po where aksesoris_id=".$_GET['id_hapus']."");
	$hapus = mysqli_query($koneksi, "delete from aksesoris where id=".$_GET['id_hapus']."");
if ($hapus and $hapus1 and $hapus2) {
		echo "<script type='text/javascript'>
		window.location='index.php?page=aksesoris'
		</script>";
		}
else {
		echo "<script type='text/javascript'>
	alert('Maaf Data Tidak Dapat Dihapus !');	window.location='index.php?page=aksesoris'
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Pembeli</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pembeli</li>
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
              <a href="index.php?page=tambah_user"><input type="submit" name="button" id="button" value="Tambah Customer" class="btn btn-success"/></a>
              <br /><br />
                <div class="table-responsive">
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th align="center">&nbsp;</th>
        
       
        <th valign="top"><strong>Nama Pembeli</strong></th>
      <th valign="top"><strong>Provinsi</strong></th>
      <th valign="top"><strong>Kabupaten</strong></th>
      <th valign="top">Kecamatan</th>
      <th align="center" valign="top"><strong>Kelurahan</strong></th>
        <th align="center" valign="top"><strong>Jalan</strong></th>        
       
        <th align="center" valign="top"><strong>Kontak</strong></th>
       
       
        <th align="center" valign="top"><strong>Aksi</strong></th>
        
          </tr>
  </thead>
  <?php
 
// membuka file JSON
$file = file_get_contents("http://localhost/ALKES/json/pembeli.php");
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
?>
  <tr>
    <td align="center"><?php echo $i+1; ?></td>
    
    <td>
    <?php echo $json[$i]['nama_pembeli']; ?>
  </td>
    
      <td><?php echo $json[$i]['nama_provinsi']; ?></td>
    <td><?php echo $json[$i]['nama_kabupaten']; ?></td>
    <td><?php echo $json[$i]['nama_kecamatan']; ?></td>
    <td align=""><?php echo $json[$i]['kelurahan_id']; ?></td>
    <td align=""><?php echo $json[$i]['jalan']; ?></td>
   
    <td align=""><?php echo $json[$i]['kontak_rs']; ?></td>
    <td align="">
      <form method="post">
        
		<?php if (isset($_SESSION['user_administrator']) or isset($_SESSION['user_admin_gudang']) or isset($_SESSION['user_admin_keuangan'])) { ?>
			<a href="index.php?page=ubah_pembeli&nama_pembeli=<?php echo $json[$i]['nama_pembeli']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp;<!--<a href="index.php?page=barang_masuk&id=<?php echo $json[$i]['idd']; ?>#openPilihan"><small data-toggle="tooltip" title="Jual Alkes" class="label bg-blue">Jual</small></a>-->
            
			<?php } ?>
          
          <input type="hidden" name="id" value="<?php echo $json[$i]['idd']; ?>"/>
          </a>
        </form>
    </td>
    
  </tr>
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
     Tgl Dijual
     <input id="input" type="date" placeholder="" name="tgl_beli" required>
     Pembeli
     <input id="input" type="text" placeholder="Pembeli (RS/Dinas/Puskesmas/Klinik" name="pembeli" required>
     Provinsi
     <select id="input">
     <option>-- Pilih --</option>
	 <?php $q1=mysqli_query($koneksi, "select * from alamat_provinsi order by nama_provinsi ASC"); 
	 while ($row1=mysqli_fetch_array($q1)){
	 ?>
     <option value="<?php echo $row1['id']; ?>"><?php echo $row1['nama_provinsi']; ?></option>
     <?php } ?>
     </select>
     Kabupaten
     <select id="input">
     <option>-- Pilih --</option>
     <?php $q2=mysqli_query($koneksi, "select * from alamat_kabupaten order by nama_kabupaten ASC"); 
	 while ($row2=mysqli_fetch_array($q2)){
	 ?>
     <option value="<?php echo $row2['id']; ?>"><?php echo $row2['nama_kabupaten']; ?></option>
     <?php } ?>
     </select>
     Kecamatan
     <select id="input">
     <option>-- Pilih --</option>
     <?php $q3=mysqli_query($koneksi, "select * from alamat_kecamatan order by nama_kecamatan ASC"); 
	 while ($row3=mysqli_fetch_array($q3)){
	 ?>
     <option value="<?php echo $row3['id']; ?>"><?php echo $row3['nama_kecamatan']; ?></option>
     <?php } ?>
     </select>
     Alamat Jalan
     <input id="input" type="text" placeholder="Jl.Xxx" name="alamat" required>
     Quantity
        <input id="input" type="text" placeholder="Quantity" name="qty" required>
        <button id="buttonn" name="jual" type="submit">Jual Alkes</button>
    </form>
    </div>
</div>

<div id="openPilihan" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <br />
        <a href="index.php?page=aksesoris_jual&id=<?php echo $_GET['id']; ?>"><button id="buttonn">Data Dinas/RS/Puskesmas/Klinik Baru</button></a>
        <a href="index.php?page=aksesoris_jual2&id=<?php echo $_GET['id']; ?>"><button id="buttonn">Dari Data Dinas/RS/Puskesmas/Klinik<br />Yang Sudah Terinput</button></a>
    </div>
</div>


