<?php 
if (isset($_GET['simpan_barang'])==1) {
	$simpan1 = mysqli_query($koneksi, "insert into barang_dikirim values('','".$_SESSION['nama_paket']."','".$_SESSION['no_pengiriman']."','".$_SESSION['tgl_pengiriman']."','".$_SESSION['no_po']."','0000-00-00')");
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_max from barang_dikirim"));
	$jml = count($_POST['p']);
	for ($i=0; $i<$jml; $i++) {
		$simpan2 = mysqli_query($koneksi, "insert into barang_dikirim_detail values('','".$max['id_max']."','".$_POST['p'][$i]."','')");
		mysqli_query($koneksi, "update barang_dijual_detail set status_kirim=1 where id=".$_POST['p'][$i]."");
		}
		
	if ($simpan1 and $simpan2) {
	echo "<script type='text/javascript'>
	alert('Data Berhasil Di Simpan !');
	window.location='index.php?page=kirim_barang'</script>";
		}
	}

if (isset($_POST['simpan_tambah_aksesoris'])) {
	$no=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_pesan_hash"))+1;
	$simpan = mysqli_query($koneksi, "insert into barang_pesan_hash values('','".$no."','".$_POST['id_akse']."','".$_POST['qty']."','".$_POST['mata_uang']."','".$_POST['harga_perunit']."','".$_POST['diskon']."','".$_POST['total_harga']."','".$_POST['catatan_spek']."')");
	echo "<script>window.location='index.php?page=simpan_tambah_pemesanan_alkes'</script>";
	}
	
if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from barang_pesan_hash where id=".$_GET['id_hapus']."");
	}
?>
<script type="text/javascript">
function sum() {
      var txtFirstNumberValue = document.getElementById('qty').value;
      var txtSecondNumberValue = document.getElementById('harga_perunit').value;
	  var txtThirdNumberValue = document.getElementById('diskon').value;
      var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue) - (parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue) * (parseFloat(txtThirdNumberValue)/100));
      if (!isNaN(result)) {
         document.getElementById('total_harga').value = result;
      }
}
</script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Pengiriman Alkes</h1>
      <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Pengiriman Alkes</li>
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
              <div class="">
              <!--<a href="index.php?page=tambah_barang_masuk"><button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah Barang</button></a>-->
              
                <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom"><strong>Tgl Kirim</strong></th>
      <th valign="bottom">Nama Paket</th>
      <th valign="bottom"><strong>No Pengiriman</strong></th>
      <th valign="bottom">No PO</th>
      </tr>
  </thead>
  <tr>
    <td><?php echo date("d F Y",strtotime($_SESSION['tgl_pengiriman'])); ?>
    </td>
    <td><?php echo $_SESSION['nama_paket']; ?></td>
    <td><?php echo $_SESSION['no_pengiriman']; ?></td>
    <td><?php echo $_SESSION['no_po']; ?></td>
    </tr>
</table><br />
                <h3 align="left">
                  Pilih Alkes Yang Akan Dikirim
                </h3>
                <!--<font color="#FF0000">* Jika Ingin Menambah Data Aksesoris Yang Baru ! Klik Disini <a href="index.php?page=simpan_tambah_aksesoris&id=<?php //echo $_GET['id']; ?>#openAkse"><small data-toggle="tooltip" title="Tambah Aksesoris Baru" class="label bg-blue">+ New Accessories</small></a></font>-->
                <br />
                <form method="post" action="index.php?page=simpan_kirim_barang&simpan_barang=1">
                <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">No</th>
      <th valign="bottom"><strong>Nama Alkes</strong></th>
      <td align="center" valign="bottom"><strong>Tipe      
      </strong></td>
      <td align="center" valign="bottom"><strong>Merk      
      </strong></td>
      <td align="center" valign="bottom"><strong>No Seri</strong></td>
      <td align="center" valign="bottom"><strong>Harga </strong></td>      
      <td align="center" valign="bottom"><strong>Pilih (<?php echo count($_POST['p']); ?>)</strong></td>
  </thead>

  <?php
   
  $no=0;
  $q_akse2 = mysqli_query($koneksi, "select *, barang_dijual_detail.id as idd from barang_gudang,barang_gudang_detail,barang_dijual,barang_dijual_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual_detail.barang_gudang_detail_id and barang_dijual.id=barang_dijual_detail.barang_dijual_id and barang_dijual_detail.status_kirim=0 and barang_dijual.id=".$_GET['id']."");
  while ($data_akse = mysqli_fetch_array($q_akse2)) {
	  $no++;
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $data_akse['nama_brg']; ?>
    </td>
    <td align="center"><?php echo $data_akse['tipe_brg']; ?></td>
    <td align="center"><?php echo $data_akse['merk_brg']; ?></td>
    <td align="center"><?php echo $data_akse['no_seri_brg']; ?></td>
    <td align="center"><?php echo "Rp ".number_format($data_akse['harga_satuan'],2,',',',').".00"; ?></td>
    <td align="center">
    <input name="p[]" checked="checked" type="checkbox" value="<?php echo $data_akse['idd']; ?>" style="height:20px; width:20px" /></td>
    </tr>
    <?php } ?>
</table>
<br />
<center><a href="index.php?page=simpan_kirim_barang&simpan_barang=1"><button name="simpan_barang" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button></a>&nbsp;&nbsp;<a href="index.php?page=jual_barang"><button name="batal" class="btn btn-success" type="button"><span class="fa  fa-times-circle"></span> Batal</button></a></center>
</form>
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
  if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "insert into mata_uang values('','".$_POST['nama_uang']."','".$_GET['simbol']."')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Mata Uang Berhasil Di Tambah !');
		window.location='index.php?page=simpan_tambah_pemesanan_alkes';
		</script>";
		}
	}
		?>
  <div id="openUang" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Tambah Mata Uang Baru</h3> 
     <form method="post">
     <?php if (!isset($_GET['simbol'])) { ?>
     <a href="index.php?page=simpan_tambah_pemesanan_alkes#pilihSimbol"><button class="form-control col-lg-2" type="button">Pilih Simbol</button></a>
     <?php } else { echo "<a href='index.php?page=simpan_tambah_pemesanan_alkes#pilihSimbol'><center>".$_GET['simbol']."</center></a>"; } ?>
              <input name="nama_uang" id="input" class="form-control" type="text" required placeholder="Nama Mata Uang" autofocus>
               <textarea name="simbol"><?php echo $_GET['simbol']; ?></textarea>
              
              <button id="buttonn" name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button>
              <br /><br />
              </form>
              
    </div>
</div>

<div id="pilihSimbol" class="modalDialog">
<div>
<table border="1" class="table table-bordered table-hover" align="center">
  <tr align="center">
    <td><a href="index.php?page=simpan_tambah_pemesanan_alkes&simbol=<i class='fa fa-fw fa-bitcoin'></i>#openUang"><i class="fa fa-fw fa-bitcoin"></i></a></td>
    <td><a href="index.php?page=simpan_tambah_pemesanan_alkes&simbol=<i class='fa fa-fw fa-cny'></i>#openUang"><i class="fa fa-fw fa-cny"></i></a></td>
    <td><a href="index.php?page=simpan_tambah_pemesanan_alkes&simbol=<i class='fa fa-fw fa-dollar'></i>#openUang"><i class="fa fa-fw fa-dollar"></i></a></td>
    <td><a href="index.php?page=simpan_tambah_pemesanan_alkes&simbol=<i class='fa fa-fw fa-euro'></i>#openUang"><i class="fa fa-fw fa-euro"></i></a></td>
    <td><a href="index.php?page=simpan_tambah_pemesanan_alkes&simbol=<i class='fa fa-fw fa-gbp'></i>#openUang"><i class="fa fa-fw fa-gbp"></i></a></td>
    </tr>
  <tr align="center">
    <td><a href="index.php?page=simpan_tambah_pemesanan_alkes&simbol=<i class='fa fa-fw fa-gg-circle'></i>#openUang"><i class="fa fa-fw fa-gg-circle"></i></a></td>
    <td><a href="index.php?page=simpan_tambah_pemesanan_alkes&simbol=<i class='fa fa-fw fa-gg'></i>#openUang"><i class="fa fa-fw fa-gg"></i></a></td>
    <td><a href="index.php?page=simpan_tambah_pemesanan_alkes&simbol=<i class='fa fa-fw fa-ils'></i>#openUang"><i class="fa fa-fw fa-ils"></i></a></td>
    <td><a href="index.php?page=simpan_tambah_pemesanan_alkes&simbol=<i class='fa fa-fw fa-inr'></i>#openUang"><i class="fa fa-fw fa-inr"></i></a></td>
    <td><a href="index.php?page=simpan_tambah_pemesanan_alkes&simbol=<i class='fa fa-fw fa-turkish-lira'></i>#openUang"><i class="fa fa-fw fa-turkish-lira"></i></a></td>
    </tr>
  <tr align="center">
    <td><a href="index.php?page=simpan_tambah_pemesanan_alkes&simbol=<i class='fa fa-fw fa-krw'></i>#openUang"><i class="fa fa-fw fa-krw"></i></a></td>
    <td><a href="index.php?page=simpan_tambah_pemesanan_alkes&simbol=<i class='fa fa-fw fa-money'></i>#openUang"><i class="fa fa-fw fa-money"></i></a></td>
    <td><a href="index.php?page=simpan_tambah_pemesanan_alkes&simbol=<i class='fa fa-fw fa-ruble'></i>#openUang"><i class="fa fa-fw fa-ruble"></i></a></td>
    <td><a href="index.php?page=simpan_tambah_pemesanan_alkes&simbol=Rp#openUang"><i>Rp</i></a></td>
    <td></td>
    </tr>
  <tr align="center">
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
  <tr align="center">
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
</table>
</div>
</div>
