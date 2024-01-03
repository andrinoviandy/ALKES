<?php 
$query = mysqli_query($koneksi, "select *,principle.id as id_principle,barang_pesan_akse.id as id_barang_pesan_akse from barang_pesan_akse,principle where principle.id=barang_pesan_akse.principle_id and barang_pesan_akse.id='".$_GET['id']."'");
$data = mysqli_fetch_array($query);

if (isset($_POST['simpan_barang'])) {
	$s=mysqli_query($koneksi, "update utang_piutang_aksesoris set nominal=".$_POST['dalam_rupiah']." where no_faktur_no_po_akse='".$data['no_po_pesan']."'");
	$simpan = mysqli_query($koneksi, "update barang_pesan_akse set total_price='".$_POST['total_price']."', total_price_ppn='".$_POST['total_price_ppn']."', cost_byair='".$_POST['cost_byair']."', cost_cf='".$_POST['cost_cf']."',nilai_tukar='".$_POST['nilai_tukar']."' where id=$_GET[id]");		
	if ($simpan) {
	echo "<script type='text/javascript'>
	alert('Data Berhasil Di Simpan !');
	window.location='index.php?page=ubah_pembelian_akse&id=$_GET[id]'</script>";
		}
	}

if (isset($_POST['simpan_tambah_aksesoris'])) {
	
	$simpan = mysqli_query($koneksi, "insert into barang_pesan_akse_detail values('','".$_GET['id']."','".$_POST['id_akse']."','".$_POST['qty']."','".$data['mata_uang_id']."','".$_POST['harga_perunit']."','".$_POST['diskon']."','".$_POST['total_harga']."','".$_POST['catatan_spek']."','')");
	mysqli_query($koneksi, "update barang_pesan_akse set cost_byair=0, cost_cf=0 where id=$_GET[id]");
	echo "<script>
alert('Berhasil Di Simpan ! Harap isi kembali Ongkir nya !');	window.location='index.php?page=tambah_po_akse&id=$_GET[id]'</script>";
	}
	
if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from barang_pesan_akse_detail where id=".$_GET['id_hapus']."");
	mysqli_query($koneksi, "update barang_pesan_akse set cost_byair=0, cost_cf=0 where id=$_GET[id]");
	echo "<script type='text/javascript'>
	alert('Harap isi kembali Ongkir nya !');	window.location='index.php?page=tambah_po_akse&id=$_GET[id]';
		</script>";
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
      <h1>Tambah Data <strong>Aksesoris</strong></h1>
      <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Pesanan <strong>Aksesoris</strong></li>
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
      <th valign="bottom">Estimasi Pengiriman</th>
      <th valign="bottom">Catatan</th>
      </tr>
  </thead>
  <tr>
    <td><?php echo date("d F Y",strtotime($data['tgl_po_pesan'])); ?>
    </td>
    <td><?php echo $data['no_po_pesan']; ?></td>
    <td><?php echo $data['nama_principle']; ?></td>
    <td><?php echo str_replace("\n","<br>",$data['alamat_principle']); ?></td>
    <td><?php echo $data['ppn']." %"; ?></td>
    <td><?php echo $data['cara_pembayaran']; ?></td>
    <td><?php echo str_replace("\n","<br>",$data['alamat_pengiriman']); ?></td>
    <td><?php echo $data['jalur_pengiriman']; ?></td>
    <td><?php 
	if ($data['estimasi_pengiriman']==0000-00-00) {
		echo "-";
		}
	else {
	echo date("d F Y",strtotime($data['estimasi_pengiriman']));} ?></td>
    <td><?php echo $data['catatan']; ?></td>
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
      <th valign="bottom"><strong>Nama Aksesoris</strong></th>
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
    	<option value="">-- Pilih Aksesoris --</option>
        <?php 
		$q = mysqli_query($koneksi, "select * from aksesoris order by nama_akse ASC");
		$jsArray = "var dtBrg = new Array();
";
		while ($d = mysqli_fetch_array($q)) { ?>
        <option value="<?php echo $d['id']; ?>"><?php echo $d['nama_akse']." - ".$d['tipe_akse']; ?></option>
        <?php 
		$jsArray .= "dtBrg['" . $d['id'] . "'] = {tipe_akse:'".addslashes($d['tipe_akse'])."',
						merk_akse:'".addslashes($d['merk_akse'])."'
						};";
		} ?>
        
    </select>
    </td>
    <td align="center"><input id="tipe_akse" name="tipe_akse" class="form-control" type="text" placeholder="Tipe" disabled="disabled"/></td>
    <td align="center"><input id="merk_akse" name="merk_akse" class="form-control" type="text"  placeholder="Merk" disabled="disabled"/></td>
    <td align="center"><input id="qty" required="required" name="qty" class="form-control" type="text" placeholder="Qty" onkeyup="sum();" size="2"/></td>
    <td align="center"><?php 
	$q_uang=mysqli_fetch_array(mysqli_query($koneksi, "select * from mata_uang where id=".$data['mata_uang_id'].""));
	echo $q_uang['jenis_mu'];
	?>      <!--<a href="index.php?page=simpan_tambah_pemesanan_alkes#openUang"><small data-toggle="tooltip" title="Tambah Mata Uang" class="label bg-green pull pull-right">+</small></a>--></td>
    <td align="center"><input id="harga_perunit" name="harga_perunit" class="form-control" type="text" required="required" size="10"/></td>
    <td align="center"><input id="diskon" name="diskon" onkeyup="sum();" class="form-control" type="text" placeholder="" required="required" size="5"/></td>
    <td align="center">
    
    <input id="total_harga" name="total_harga" class="form-control" type="text" placeholder="" readonly="readonly" size="10"/></td>
    <td align="center"><textarea name="catatan_spek" class="form-control" placeholder="Catatan Spek"></textarea></td>
    <td align="center"><?php if (isset($_SESSION['user_administrator']) or isset($_SESSION['adminpodalam'])) { ?><button name="simpan_tambah_aksesoris" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button><?php } ?></td>
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
  $q_akse = mysqli_query($koneksi, "select *,barang_pesan_akse_detail.id as idd,aksesoris.id as id_gudang from barang_pesan_akse_detail,aksesoris,mata_uang where aksesoris.id=barang_pesan_akse_detail.aksesoris_id and mata_uang.id=barang_pesan_akse_detail.mata_uang_id and barang_pesan_akse_detail.barang_pesan_akse_id=$_GET[id]");
  $jm = mysqli_num_rows($q_akse);
  if ($jm!=0) { 
  while ($data_akse = mysqli_fetch_array($q_akse)) {
	  $no++;
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $data_akse['nama_akse']; ?>
    </td>
    <td align="center"><?php echo $data_akse['tipe_akse']; ?></td>
    <td align="center"><?php echo $data_akse['merk_akse']; ?></td>
    <td align="center"><?php echo $data_akse['qty']; ?></td>
    <td align="center"><?php echo $data_akse['jenis_mu']; ?></td>
    <td align="center"><?php echo $data_akse['simbol']." ".number_format($data_akse['harga_perunit'],2,',','.'); ?></td>
    <td align="center"><?php 
	if ($data_akse['diskon']!=0) {
	echo $data_akse['diskon']." %";
	} else {
		echo "0 %";
		} ?></td>
    <td align="center"><?php echo $data_akse['simbol']." ".number_format($data_akse['harga_total'],2,',','.'); ?></td>
    <td align="center"><?php echo $data_akse['catatan_spek']; ?></td>
    <td align="center"><?php if (isset($_SESSION['user_administrator']) or isset($_SESSION['adminpodalam'])) { ?>
    <a href="index.php?page=tambah_po_akse&id_ubah=<?php echo $data_akse['idd']; ?>&id=<?php echo $_GET['id']; ?>#open_ubah" ><span data-toggle="tooltip" title="Hapus" class="fa fa-edit"></span></a>&nbsp;&nbsp;<a href="index.php?page=tambah_po_akse&id_hapus=<?php echo $data_akse['idd']; ?>&id=<?php echo $_GET['id']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>
    <?php } ?>
    </td>
    </tr>
  <?php }} else {
	  echo "<tr><td colspan='11' align='center'>Tidak Ada Data</td></tr>";
	  } ?>
      <form method="post">
    <tr>
    <td colspan="8" align="right" valign="bottom"><strong>Total Price =</strong></td>
    <td colspan="2" align="left">
      <?php
    $total = mysqli_fetch_array(mysqli_query($koneksi, "select *,sum(harga_total) as total from barang_pesan_akse_detail where barang_pesan_akse_id=$_GET[id]"));
		//$total = mysqli_query($koneksi, "select * from barang_pesan_detail where barang_pesan_id=$id");
		//echo " ".number_format($total_akse2+$total['total'],0,',',',').".00";
        ?>
      <input name="total_price" class="form-control" type="text" required="required" placeholder="" size="20" value="<?php echo number_format($total['total'],2,',',''); ?>"/>
    </td>
    <td align="center"></td>
    </tr>
    <tr>
    <td colspan="8" align="right" valign="bottom"><strong>Total Price + PPN(<?php echo $data['ppn']."%"; ?>) =</strong></td>
    <td colspan="2" align="left">
      <input name="total_price_ppn" id="total_price_ppn" class="form-control" type="text" required="required" placeholder="" size="20" value="<?php echo number_format(($total['total'])+(($total['total'])*floatval($data['ppn'])/100),2,',',''); ?>"/>
    </td>
    <td align="center"></td>
    </tr>
    <tr>
    <td colspan="8" align="right" valign="bottom"><strong>Freight Cost by Air to JAKARTA =</strong></td>
    <td colspan="2" align="left" valign="top"><input name="cost_byair" id="cost_byair" class="form-control" type="text" required="required" value="<?php 
	if ($data['cost_byair']!=0) {
	echo $data['cost_byair'];} ?>" placeholder="" size="20" onkeyup="sum_total_keseluruhan();"/></td>
    <td align="center"></td>
    </tr>
    <tr>
    <td height="24" colspan="8" align="right" valign="bottom"><strong>Total Keseluruhan =</strong></td>
    <td colspan="2" align="left" valign="top"><input name="cost_cf" id="cost_cf" class="form-control" type="text" required="required" value="<?php echo $data['cost_cf']; ?>" placeholder="" size="20"/></td>
    <td align="center"></td>
    </tr>
    <tr>
      <td height="24" colspan="8" align="right" valign="bottom">Nilai Tukar (satuan dalam rupiah) =</td>
      <td colspan="2" align="left" valign="top"><input id="nilai_tukar" name="nilai_tukar" class="form-control" type="text" required="required" value="<?php echo $q_uang['dalam_rupiah']; ?>" placeholder="" size="20" onkeyup="sum()"/></td>
      <td align="center"></td>
    </tr>
    <tr>
      <td height="24" colspan="8" align="right" valign="bottom"><strong>Total Keseluruhan</strong> (Rupiah) =</td>
      <td colspan="2" align="left" valign="top"><?php
      $mu= mysqli_fetch_array(mysqli_query($koneksi, " select * from utang_piutang_aksesoris where no_faktur_no_po_akse='".$data['no_po_pesan']."'"));
	  if ($mu['nominal']!=0) {
		  $total_rupiah=$mu['nominal'];
		  }
	  ?>
      <input name="dalam_rupiah" id="dalam_rupiah" type="text" required class="form-control" value="<?php echo $total_rupiah; ?>" placeholder="Auto" size="20"/></td>
      <td align="center"></td>
    </tr>
                </table>

<center>
<?php if (isset($_SESSION['user_administrator']) or isset($_SESSION['adminpodalam'])) { ?>
<a href="index.php?page=tambah_po_akse&simpan_barang=1&id=<?php echo $_GET['id']; ?>"><button name="simpan_barang" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan</button></a><?php } ?></center>
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
	$Result = mysqli_query($koneksi, "update barang_pesan_akse_detail set qty=".$_POST['qty2'].", harga_perunit=".$_POST['harga_perunit2'].", diskon=".$_POST['diskon2'].", harga_total=".$_POST['total_harga2']." where id=".$_GET['id_ubah']."");
	if ($Result) {
		mysqli_query($koneksi, "update barang_pesan_akse set cost_byair=0, cost_cf=0 where id=$_GET[id]");
		echo "<script type='text/javascript'>
	alert('Harap isi kembali Ongkir nya !');	window.location='index.php?page=tambah_po_akse&id=$_GET[id]';
		</script>";
		}
	}
		?>
  <div id="open_ubah" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Ubah Data</h3>
        <?php
        $da = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_pesan_akse_detail where id=".$_GET['id_ubah'].""));
		?>
     <form method="post">
     <label>Qty</label>
     <input name="qty2" id="qty2" class="form-control" type="text" required placeholder="" value="<?php echo $da['qty']; ?>" onkeyup="sum2();" autofocus>
     <br />
     <label>Harga Per Unit</label>
     <input name="harga_perunit2" id="harga_perunit2" class="form-control" type="text" required value="<?php echo $da['harga_perunit']; ?>" onkeyup="sum2();" placeholder="">
     <br />
     <label>Diskon</label>
     <input name="diskon2" id="diskon2" class="form-control" type="text" required value="<?php echo $da['diskon']; ?>" onkeyup="sum2();" placeholder="">
     <br />
     <label>Total Harga</label>
     <input name="total_harga2" id="total_harga2" class="form-control" type="text" required placeholder="" value="<?php echo $da['harga_total']; ?>">
     <br />
     <button id="buttonn" name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button>
              <br /><br />
       </form>
              
    </div>
</div>
