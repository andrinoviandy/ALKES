<?php 
$query = mysqli_query($koneksi, "select *,principle.id as id_principle from barang_pesan_set,principle where principle.id=barang_pesan_set.principle_id and barang_pesan_set.id='".$_GET['id']."'");
$data = mysqli_fetch_array($query);

if (isset($_POST['simpan_barang'])) {
	$simpan = mysqli_query($koneksi, "update barang_pesan_set set total_price='".$_POST['total_price']."', total_price_ppn='".$_POST['total_price_ppn']."', cost_byair='".$_POST['cost_byair']."', cost_cf='".$_POST['cost_cf']."' where id=$_GET[id]");		
	if ($simpan) {
	echo "<script type='text/javascript'>
	alert('Data Berhasil Di Simpan !');
	window.location='index.php?page=ubah_pembelian_alkes_set&id=$_GET[id]'</script>";
		}
	}

if (isset($_POST['simpan_tambah_aksesoris'])) {
	
	$simpan = mysqli_query($koneksi, "update barang_pesan_detail_set set barang_gudang_set_id='".$_POST['id_akse']."', qty='".$_POST['qty']."', mata_uang_id='".$_POST['mata_uang']."',harga_perunit='".$_POST['harga_perunit']."', diskon='".$_POST['diskon']."', harga_total='".$_POST['total_harga']."',catatan_spek='".$_POST['catatan_spek']."' where id=$_GET[id_ubah]");
	if ($simpan) {
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select *, sum(harga_total) as total from barang_pesan_detail_set where barang_pesan_set_id=".$_GET['id'].""));
	if ($sel) {
		$tpp=$sel['total']+($sel['total']*$data['ppn']/100);
	mysqli_query($koneksi, "update barang_pesan_set set total_price=".$sel['total'].", total_price_ppn=".$tpp." where id=".$_GET['id']."");
	echo "<script type='text/javascript'>
	alert('Item Berhasil Di Ubah');
	window.location='index.php?page=ubah_pembelian_alkes_set&id=$_GET[id]'</script>";
	}}}
	
if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from barang_pesan_detail_set where id=".$_GET['id_hapus']."");
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
      <h1>Ubah Data Alkes</h1>
      <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Ubah Pesanan Alkes</li>
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
      <th valign="bottom"><strong>Tgl PO</strong></th>
      <th valign="bottom">No. PO</th>
      <th valign="bottom"><strong>Nama Principle</strong></th>
      <th valign="bottom">Alamat Principle</th>
      <th valign="bottom"><strong>PPN</strong></th>
      <th valign="bottom"><strong>Cara Pembayaran</strong></th>
      <th valign="bottom">Alamat Pengiriman</th>
      <th valign="bottom">Jalur Pengiriman</th>
      <th valign="bottom">Catatan</th>
      </tr>
  </thead>
  <tr>
    <td><?php echo date("d F Y",strtotime($data['tgl_po'])); ?>
    </td>
    <td><?php echo $data['no_po_pesan']; ?></td>
    <td><?php echo $data['nama_principle']; ?></td>
    <td><?php echo str_replace("\n","<br>",$data['alamat_principle']); ?></td>
    <td><?php echo $data['ppn']." %"; ?></td>
    <td><?php echo $data['cara_pembayaran']; ?></td>
    <td><?php echo str_replace("\n","<br>",$data['alamat_pengiriman']); ?></td>
    <td><?php echo $data['jalur_pengiriman']; ?></td>
    <td><?php echo $data['catatan']; ?></td>
    </tr>
</table><br />
                <h3 align="left">
                  Ubah Barang &nbsp;&nbsp;(Yang di ubah adalah yang berwarna)
                </h3>
                <!--<font color="#FF0000">* Jika Ingin Menambah Data Aksesoris Yang Baru ! Klik Disini <a href="index.php?page=simpan_tambah_aksesoris&id=<?php //echo $_GET['id']; ?>#openAkse"><small data-toggle="tooltip" title="Tambah Aksesoris Baru" class="label bg-blue">+ New Accessories</small></a></font>-->
                <br />
                <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">&nbsp;</th>
      <th valign="bottom"><strong>Nama Alkes</strong></th>
      <td align="center" valign="bottom"><strong>Tipe      
      </strong></td>
      <td align="center" valign="bottom"><strong>Merk      
      </strong></td>
      <td align="center" valign="bottom"><strong>Qty</strong></td>
      <td align="center" valign="bottom"><strong>Mata Uang     
      </strong></td>
      <td align="center" valign="bottom"><strong>Harga Per Unit </strong></td>      
      <td align="center" valign="bottom"><strong>Diskon (%)</strong></td>      
      <td align="center" valign="bottom"><strong>Total Harga
      </strong></td>
      <td colspan="2" align="center" valign="bottom"><strong>Catatan Spek</strong></td>      
      </tr>
  </thead>
  <?php
   
  $no=0;
  $q_akse = mysqli_query($koneksi, "select *,barang_pesan_detail_set.id as idd,barang_gudang_set.id as id_gudang from barang_pesan_detail_set,barang_gudang_set,mata_uang where barang_gudang_set.id=barang_pesan_detail_set.barang_gudang_set_id and mata_uang.id=barang_pesan_detail_set.mata_uang_id and barang_pesan_detail_set.id=$_GET[id_ubah]");
 $data_akse = mysqli_fetch_array($q_akse);
	
  ?>
  <tr <?php if ($id==$_GET['id_ubah']) { echo "bgcolor='#00CCCC'"; }?>>
    <td>&nbsp;</td>
    <td><?php echo $data_akse['nama_brg']; ?></td>
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
    <td colspan="2" align="center"><?php echo $data_akse['catatan_spek']; ?></td>
    </tr>
  
  <tr>
    <td colspan="11" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="11" align="center"><strong>Ubah Alkes Menjadi</strong></td>
    </tr>
  <tr>
    <td>#</td>
    <form method="post" enctype="multipart/form-data">
    <td>
    <select name="id_akse" id="id_akse" class="form-control" autofocus="autofocus" required="required" onchange="changeValue(this.value)">
    	<option>-- Pilih Barang --</option>
        <?php 
		$q = mysqli_query($koneksi, "select * from barang_gudang_set order by nama_brg ASC");
		$jsArray = "var dtBrg = new Array();
";
		while ($d = mysqli_fetch_array($q)) { ?>
        <option value="<?php echo $d['id']; ?>"><?php echo $d['nama_brg']; ?></option>
        <?php 
		$jsArray .= "dtBrg['" . $d['id'] . "'] = {tipe_akse:'".addslashes($d['tipe_brg'])."',
						merk_akse:'".addslashes($d['merk_brg'])."',
						no_akse:'".addslashes($d['nie_brg'])."'
						};";
		} ?>
    </select>
    </td>
    <td align="center"><input id="tipe_akse" name="tipe_akse" class="form-control" type="text" placeholder="Tipe" disabled="disabled" value=""/></td>
    <td align="center"><input id="merk_akse" name="merk_akse" class="form-control" type="text" placeholder="Merk" disabled="disabled" value=""/></td>
    <td align="center"><input id="qty" required="required" name="qty" class="form-control" type="text" placeholder="Qty Set" onkeyup="sum();" size="5"/></td>
    <td align="center"><select class="form-control" name="mata_uang">
    <?php 
	$q_uang=mysqli_query($koneksi, "select * from mata_uang where id=".$data['mata_uang_id']." order by id ASC");
	while ($d_mu=mysqli_fetch_array($q_uang)) {
	?>
    <option value="<?php echo $d_mu['id']; ?>"><?php echo $d_mu['jenis_mu']; ?></option>
    <?php } ?>
    </select><!--<a href="index.php?page=simpan_tambah_pemesanan_alkes#openUang"><small data-toggle="tooltip" title="Tambah Mata Uang" class="label bg-green pull pull-right">+</small></a>--></td>
    <td align="center"><input id="harga_perunit" name="harga_perunit" class="form-control" type="text" required="required" size="10"/></td>
    <td align="center"><input id="diskon" name="diskon" onkeyup="sum();" class="form-control" type="text" placeholder="" required="required" size="5"/></td>
    <td align="center">
    
    <input id="total_harga" name="total_harga" class="form-control" type="text" placeholder="" readonly="readonly" size="10"/></td>
    <td align="center"><textarea name="catatan_spek" class="form-control" placeholder="Catatan Spek"></textarea></td>
    <td align="center"><button name="simpan_tambah_aksesoris" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan</button></td>
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
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"></td>
    </tr>
 
      
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
