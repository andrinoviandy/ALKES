<?php 
if (isset($_GET['simpan_barang'])==1) {
	//simpan barang pesan
	//$almat_princ = str_replace("\n","<br>",$_SESSION['alamat_princ']);
	$insert_princ = mysqli_query($koneksi, "insert into principle values('','".$_SESSION['nama_princ']."','".$_SESSION['alamat_princ']."','".$_SESSION['telp_princ']."','".$_SESSION['fax_princ']."','".$_SESSION['attn_princ']."')");
	$sel_max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_princ from principle"));
	$max_id_princ = $sel_max['id_princ'];
	$almat_peng = str_replace("\n","<br>",$_SESSION['alamat_pengiriman']);
	$simpan1=mysqli_query($koneksi, "insert into barang_pesan values('','".$_SESSION['tgl_po']."','".$_SESSION['no_po']."','Dalam Negeri','$max_id_princ','".$_SESSION['ppn']."','".$_SESSION['cara_pembayaran']."','".$almat_peng."','".$_SESSION['jalur_pengiriman']."','".$_SESSION['catatan']."')");
	$d1=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_pesan from barang_pesan"));
	$id_pesan=$d1['id_pesan'];
	//simpan barang pesan detail
	$q2=mysqli_query($koneksi, "select max(no) as m_no from barang_pesan_hash");
	$jml_baris = mysqli_fetch_array($q2);
	for ($i=1; $i<=$jml_baris['m_no']; $i++) {
		$d2 = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_pesan_hash where no=$i"));
		$jml = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_pesan_hash where no=$i"));
		if ($jml!=0) {
		$simpan2=mysqli_query($koneksi, "insert into barang_pesan_detail values('','$id_pesan','".$d2['barang_gudang_id']."','".$d2['qty']."','".$d2['mata_uang_id']."','".$d2['harga_perunit']."','".$d2['diskon']."','".$d2['harga_total']."','".$d2['catatan_spek']."','0')");
			}
		}
		
	if ($simpan1 and $simpan2) {
	echo "<script type='text/javascript'>
	alert('Data Berhasil Di Simpan !');
	window.location='index.php?page=pembelian_alkes'</script>";
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
      <h1>Pengiriman Aksesoris</h1>
      <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Pesanan Alkes</li>
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
                  Tambah Barang
                </h3>
                <!--<font color="#FF0000">* Jika Ingin Menambah Data Aksesoris Yang Baru ! Klik Disini <a href="index.php?page=simpan_tambah_aksesoris&id=<?php //echo $_GET['id']; ?>#openAkse"><small data-toggle="tooltip" title="Tambah Aksesoris Baru" class="label bg-blue">+ New Accessories</small></a></font>-->
                <br />
                <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">No</th>
      <th valign="bottom"><strong>Nama Alkes</strong></th>
      <td align="center" valign="bottom"><strong>Tipe      
      </strong>
      <td align="center" valign="bottom"><strong>Merk      
      </strong>
      <td align="center" valign="bottom"><strong>Qty</strong>
      <td align="center" valign="bottom"><strong>Mata Uang     
      </strong>
      <td align="center" valign="bottom"><strong>Harga Per Unit </strong>      
      <td align="center" valign="bottom"><strong>Diskon (%)</strong>      
      <td align="center" valign="bottom"><strong>Total Harga
      </strong>
      <td align="center" valign="bottom"><strong>Catatan Spek</strong>      
      <td align="center" valign="bottom"><strong>Aksi</strong></tr>
  </thead>
  
  <tr>
    <td>#</td>
    <form method="post" enctype="multipart/form-data">
    <td>
    <select name="id_akse" id="id_akse" class="form-control" autofocus="autofocus" required onchange="changeValue(this.value)">
    	<option>-- Pilih Alkes</option>
        <?php 
		$q = mysqli_query($koneksi, "select * from barang_gudang order by nama_brg ASC");
		$jsArray = "var dtBrg = new Array();
";
		while ($d = mysqli_fetch_array($q)) { ?>
        <option value="<?php echo $d['id']; ?>"><?php echo $d['nama_brg']; ?></option>
        <?php 
		$jsArray .= "dtBrg['" . $d['id'] . "'] = {tipe_akse:'".addslashes($d['tipe_brg'])."',
						merk_akse:'".addslashes($d['merk_brg'])."'
						};";
		} ?>
    </select>
    </td>
    <td align="center"><input id="tipe_akse" name="tipe_akse" class="form-control" type="text" placeholder="Tipe" disabled="disabled"/></td>
    <td align="center"><input id="merk_akse" name="merk_akse" class="form-control" type="text"  placeholder="Merk" disabled="disabled"/></td>
    <td align="center"><input id="qty" required="required" name="qty" class="form-control" type="text" placeholder="Qty" onkeyup="sum();" size="2"/></td>
    <td align="center"><select class="form-control" name="mata_uang">
    <?php 
	$q_uang=mysqli_query($koneksi, "select * from mata_uang where id=4 order by id ASC");
	while ($d_mu=mysqli_fetch_array($q_uang)) {
	?>
    <option value="<?php echo $d_mu['id']; ?>"><?php echo $d_mu['jenis_mu']; ?></option>
    <?php } ?>
    </select><!--<a href="index.php?page=simpan_tambah_pemesanan_alkes#openUang"><small data-toggle="tooltip" title="Tambah Mata Uang" class="label bg-green pull pull-right">+</small></a>--></td>
    <td align="center"><input id="harga_perunit" name="harga_perunit" class="form-control" type="text" placeholder="" size="10"/></td>
    <td align="center"><input id="diskon" name="diskon" onkeyup="sum();" class="form-control" type="text" placeholder="" size="5"/></td>
    <td align="center">
    
    <input id="total_harga" name="total_harga" class="form-control" type="text" placeholder="" readonly="readonly" size="10"/></td>
    <td align="center"><textarea name="catatan_spek" class="form-control" placeholder="Catatan Spek"></textarea></td>
    <td align="center"><button name="simpan_tambah_aksesoris" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah</button></td>
    </form>
  </tr>
  
  <script type="text/javascript">    
	<?php 
	echo $jsArray; 
	?>  
	function changeValue(id_akse){  
		document.getElementById('tipe_akse').value = dtBrg[id_akse].tipe_akse; 
		document.getElementById('merk_akse').value = dtBrg[id_akse].merk_akse;
		
	};  
</script>
  <?php
   
  $no=0;
  $q_akse = mysqli_query($koneksi, "select *,barang_pesan_hash.id as idd,barang_gudang.id as id_gudang from barang_pesan_hash,barang_gudang,mata_uang where barang_gudang.id=barang_pesan_hash.barang_gudang_id and mata_uang.id=barang_pesan_hash.mata_uang_id");
  $jm = mysqli_num_rows($q_akse);
  if ($jm!=0) { 
  while ($data_akse = mysqli_fetch_array($q_akse)) {
	  $no++;
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $data_akse['nama_brg']; ?>
    </td>
    <td align="center"><?php echo $data_akse['tipe_brg']; ?></td>
    <td align="center"><?php echo $data_akse['merk_brg']; ?></td>
    <td align="center"><?php echo $data_akse['qty']; ?></td>
    <td align="center"><?php echo $data_akse['jenis_mu']; ?></td>
    <td align="center"><?php echo $data_akse['simbol']." ".number_format($data_akse['harga_perunit'],0,',','.'); ?></td>
    <td align="center"><?php 
	if ($data_akse['diskon']!=0) {
	echo $data_akse['diskon']." %";
	} else {
		echo "-";
		} ?></td>
    <td align="center"><?php echo $data_akse['simbol']." ".number_format($data_akse['harga_total'],0,',','.'); ?></td>
    <td align="center"><?php echo $data_akse['catatan_spek']; ?></td>
    <td align="center"><a href="index.php?page=simpan_tambah_pemesanan_alkes&id_hapus=<?php echo $data_akse['idd']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;&nbsp;&nbsp;<a href="index.php?page=simpan_tambah_aksesoris_pesan&id=<?php echo $data_akse['id_gudang']; ?>"><small data-toggle="tooltip" title="Kelola Aksesoris" class="label bg-green"><span class="fa fa-cogs"></span>&nbsp Akse</small></a></td>
    </tr>
  <?php }} else {
	  echo "<tr><td colspan='8' align='center'>Tidak Ada Data</td></tr>";
	  } ?>
</table>

<center><a href="index.php?page=simpan_tambah_pemesanan_alkes&simpan_barang=1"><button name="simpan_barang" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button></a>&nbsp;&nbsp;<a href="index.php?page=pembelian_alkes"><button name="batal" class="btn btn-success" type="submit"><span class="fa  fa-times-circle"></span> Batal</button></a></center>
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
