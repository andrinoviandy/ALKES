<?php 
$query = mysqli_query($koneksi, "select * from barang_gudang_set where id='".$_GET['detail']."'");
$data = mysqli_fetch_array($query);

if (isset($_POST['simpan_barang'])) {
	$s=mysqli_query($koneksi, "update utang_piutang_set set nominal=".$_POST['dalam_rupiah']." where no_faktur_no_po_set='".$data['no_po_pesan']."'");
	$simpan = mysqli_query($koneksi, "update barang_pesan_set set total_price='".$_POST['total_price']."', total_price_ppn='".$_POST['total_price_ppn']."', cost_byair='".$_POST['cost_byair']."', cost_cf='".$_POST['cost_cf']."' where id=$_GET[id]");		
	if ($simpan) {
	echo "<script type='text/javascript'>
	alert('Data Berhasil Di Simpan !');
	window.location='index.php?page=ubah_pembelian_alkes2_set&id=$_GET[id]'</script>";
		}
	}

if (isset($_POST['simpan_tambah_aksesoris'])) {
	
	$simpan = mysqli_query($koneksi, "insert into barang_pesan_set_detail values('','".$_GET['id']."','".$_POST['id_akse']."','".$_POST['qty']."','".$data['mata_uang_id']."','".$_POST['harga_perunit']."','".$_POST['diskon']."','".$_POST['total_harga']."','".$_POST['catatan_spek']."','')");
	
	echo "<script>window.location='index.php?page=tambah_po_alkes2_set&id=$_GET[id]'</script>";
	}
	
if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from barang_pesan_set_detail where id=".$_GET['id_hapus']."");
	}
?>
<script type="text/javascript">
function sum2() {
      var txtFirstNumberValue = document.getElementById('qty2').value;
      var txtSecondNumberValue = document.getElementById('harga_perunit2').value;
	  var txtThirdNumberValue = document.getElementById('diskon2').value;
      var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue) - (parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue) * (parseFloat(txtThirdNumberValue)/100));
      if (!isNaN(result)) {
         document.getElementById('total_harga2').value = result;
      }
}


function sum() {
      var txtFirstNumberValue = document.getElementById('qty').value;
      var txtSecondNumberValue = document.getElementById('harga_perunit').value;
	  var txtThirdNumberValue = document.getElementById('diskon').value;
	  
      var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue) - (parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue) * (parseFloat(txtThirdNumberValue)/100));
	  if (!isNaN(result)) {
         document.getElementById('total_harga').value = result;
      }
}

function sum_total_keseluruhan() {
      var txtFirstNumberValue = document.getElementById('total_price_ppn').value;
      var txtSecondNumberValue = document.getElementById('cost_byair').value;
      var txtFourNumberValue = document.getElementById('nilai_tukar').value;
	  var result = parseFloat(txtFirstNumberValue) + parseFloat(txtSecondNumberValue);
	  var total_rupiah = parseFloat(result) * parseFloat(txtFourNumberValue);
      if (!isNaN(result)) {
         document.getElementById('cost_cf').value = result;
		 document.getElementById('dalam_rupiah').value = total_rupiah;
		 document.getElementById('nominal').value = total_rupiah;
      }
}

function sum_total_rupiah() {
      var txtFirstNumberValue = document.getElementById('nilai_tukar').value;
      var txtSecondNumberValue = document.getElementById('cost_cf').value;
      var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue);
      if (!isNaN(result)) {
         document.getElementById('dalam_rupiah').value = result;
      }
}
</script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Detail Data Set</h1>
      <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Detail Data Set</li>
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
      <th width="20%" valign="bottom"><strong>Nama Alat</strong></th>
      <th width="14%" valign="bottom">Merk</th>
      <th width="10%" valign="bottom"><strong>Tipe</strong></th>
      <th width="25%" valign="bottom">Negara Asal</th>
      <th width="31%" valign="bottom"><strong>Deskripsi</strong></th>
      </tr>
  </thead>
  <tr>
    <td><?php echo $data['nama_brg']; ?></td>
    <td><?php echo $data['merk_brg']; ?></td>
    <td><?php echo $data['tipe_brg']; ?></td>
    <td><?php echo $data['negara_asal']; ?></td>
    <td><?php echo $data['deskripsi_alat']; ?></td>
    </tr>
</table><br /><h3 align="center">Detail Set Barang</h3><br />
<table width="100%" id="example3" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th width="6%" valign="bottom">No</th>
      <th width="31%" valign="bottom"><strong>Nama Set</strong></th>
      <th width="21%" valign="bottom">Quantity</th>
      <th width="21%" valign="bottom"><strong>Harga Beli</strong></th>
      <th width="21%" valign="bottom">Harga Jual</th>
      </tr>
  </thead>
  <?php 
  $q = mysqli_query($koneksi, "select * from barang_gudang_set,barang_gudang_po_set,barang_gudang_set_1,barang_gudang_set_2 where barang_gudang_set.id=barang_gudang_po_set.barang_gudang_set_id and barang_gudang_po_set.id=barang_gudang_set_1.barang_gudang_po_set_id and barang_gudang_set_1.id=barang_gudang_set_2.barang_gudang_set1_id and barang_gudang_set.id=".$_GET['detail']." group by nama_set order by nama_set ASC");
  $no=0;
  while ($data = mysqli_fetch_array($q)) {
	  $no++;
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $data['nama_set']; ?></td>
    <td><?php echo $data['qty']; ?></td>
    <td><?php echo $data['harga_beli']; ?></td>
    <td><?php echo $data['harga_jual']; ?></td>
    </tr>
    <?php } ?>
</table>
<br />
                <center>
                <a href="index.php?page=simpan_tambah_pemesanan_alkes2_set"><button name="simpan_barang" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Kembali ke halaman sebelumnya</button></a></center>
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
