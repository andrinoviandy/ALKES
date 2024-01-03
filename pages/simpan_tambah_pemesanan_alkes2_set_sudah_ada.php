<?php 
if (isset($_POST['tambah_header'])) {
	//simpan barang pesan

	$max_id_princ = $_SESSION['id_princ'];
	$almat_peng = str_replace("\n","<br>",$_SESSION['alamat_pengiriman']);
	$simpan1=mysqli_query($koneksi, "insert into barang_pesan_set values('','".$_SESSION['tgl_po']."','".$_SESSION['no_po']."','Luar Negeri','$max_id_princ','".$_SESSION['ppn']."','".$_SESSION['cara_pembayaran']."','".$_SESSION['mata_uang']."','".$almat_peng."','".$_SESSION['jalur_pengiriman']."','".$_SESSION['estimasi_pengiriman']."','".$_SESSION['catatan']."','0','','".$_POST['total_price']."','".$_POST['total_price_ppn']."','".$_POST['cost_byair']."','".$_POST['cost_cf']."','','','')");
	$d1=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_pesan from barang_pesan_set"));
	$id_pesan=$d1['id_pesan'];
	//simpan barang pesan detail
	$q2=mysqli_query($koneksi, "select * from barang_pesan_set_detail_hash where akun_id=".$_SESSION['id']."");
	while ($d2 = mysqli_fetch_array($q2)) {
		
		$simpan2=mysqli_query($koneksi, "insert into barang_pesan_set_detail values('','$id_pesan','".$d2['barang_gudang_set_id']."','".$d2['qty']."','".$d2['mata_uang_id']."','".$d2['harga_perunit']."','".$d2['diskon']."','".$d2['harga_total']."','".$d2['catatan_spek']."','0')");
			
		}
		
	if ($simpan1 and $simpan2) {
		$Result = mysqli_query($koneksi, "insert into utang_piutang_set values('','Hutang','".$_SESSION['no_po']."','".$_POST['tgl_input']."','".$_POST['jatuh_tempo']."','".$_POST['nominal']."','".$_POST['klien']."','".$_POST['deskripsi']."','0')");
		mysqli_query($koneksi, "delete from barang_pesan_set_detail_hash where akun_id=".$_SESSION['id']."");
	echo "<script type='text/javascript'>
	alert('Data Berhasil Di Simpan !');
	window.location='index.php?page=pembelian_alkes2_set'</script>";
		}
	}

if (isset($_POST['simpan_tambah_aksesoris'])) {
	//$no=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_pesan_hash"))+1;
	$simpan = mysqli_query($koneksi, "insert into barang_pesan_set_detail_hash values('','".$_SESSION['id']."','".$_POST['id_akse']."','".$_POST['qty']."','".$_SESSION['mata_uang']."','".$_POST['harga_perunit']."','".$_POST['diskon']."','".$_POST['total_harga']."','".$_POST['catatan_spek']."')");
	echo "<script>window.location='index.php?page=simpan_tambah_pemesanan_alkes2_set_sudah_ada'</script>";
	}
	
if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from barang_pesan_set_detail_hash where id=".$_GET['id_hapus']."");
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
<script type="text/javascript">
function sum_total_keseluruhan() {
      var txtFirstNumberValue = document.getElementById('total_price_ppn').value;
      var txtSecondNumberValue = document.getElementById('cost_byair').value;
      var result = parseFloat(txtFirstNumberValue) + parseFloat(txtSecondNumberValue);
      if (!isNaN(result)) {
         document.getElementById('cost_cf').value = result;
		 document.getElementById('nominal').value = result;
      }
}
</script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Tambah PO Luar Negeri</h1>
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
    <td><?php echo date("d F Y",strtotime($_SESSION['tgl_po'])); ?>
    </td>
    <td><?php echo $_SESSION['no_po']; ?></td>
    <td><?php 
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from principle where id=".$_SESSION['id_princ'].""));
	echo $sel['nama_principle']; ?></td>
    <td><?php echo $sel['alamat_principle']."<br>Telp : ".$sel['telp_principle']."<br>Fax : ".$sel['fax_principle']."<br>Attn : ".$sel['attn_principle']; ?></td>
    <td><?php echo $_SESSION['ppn']; ?></td>
    <td><?php echo $_SESSION['cara_pembayaran']; ?></td>
    <td><?php echo str_replace("\n","<br>",$_SESSION['alamat_pengiriman']); ?></td>
    <td><?php echo $_SESSION['jalur_pengiriman']; ?></td>
    <td><?php echo $_SESSION['catatan']; ?></td>
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
      <td align="center" valign="bottom"><strong>Qty Set</strong>
      <td align="center" valign="bottom"><strong>Mata Uang     
      </strong>
      <td align="center" valign="bottom"><strong>Harga Per Set </strong>      
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
    <select name="id_akse" id="id_akse" class="form-control select2" autofocus="autofocus" required="required" onchange="changeValue(this.value)">
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
    <td align="center"><input id="tipe_akse" name="tipe_akse" class="form-control" type="text" placeholder="Tipe" disabled="disabled"/></td>
    <td align="center"><input id="merk_akse" name="merk_akse" class="form-control" type="text"  placeholder="Merk" disabled="disabled"/></td>
    <td align="center"><input id="qty" required="required" name="qty" class="form-control" type="text" placeholder="Qty" onkeyup="sum();" size="5"/></td>
    <td align="center"><?php 
	$q_uang=mysqli_fetch_array(mysqli_query($koneksi, "select * from mata_uang where id=".$_SESSION['mata_uang'].""));
	echo $q_uang['jenis_mu'];
	?><!--<a href="index.php?page=simpan_tambah_pemesanan_alkes#openUang"><small data-toggle="tooltip" title="Tambah Mata Uang" class="label bg-green pull pull-right">+</small></a>--></td>
    <td align="center"><input id="harga_perunit" name="harga_perunit" class="form-control" type="text" required="required" size="10" onkeyup="sum();"/></td>
    <td align="center"><input id="diskon" name="diskon" onkeyup="sum();" class="form-control" type="text" placeholder="" required="required" size="5"/></td>
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
  $q_akse = mysqli_query($koneksi, "select *,barang_pesan_set_detail_hash.id as idd,barang_gudang_set.id as id_gudang from barang_pesan_set_detail_hash,barang_gudang_set,mata_uang where barang_gudang_set.id=barang_pesan_set_detail_hash.barang_gudang_set_id and mata_uang.id=barang_pesan_set_detail_hash.mata_uang_id and akun_id=".$_SESSION['id']."");
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
    <td align="center"><?php echo $data_akse['simbol']." ".number_format($data_akse['harga_perunit'],2,',','.'); ?></td>
    <td align="center"><?php 
	if ($data_akse['diskon']!=0) {
	echo $data_akse['diskon']." %";
	} else {
		echo "-";
		} ?></td>
    <td align="center"><?php echo $data_akse['simbol']." ".number_format($data_akse['harga_total'],2,',','.'); ?></td>
    <td align="center"><?php echo $data_akse['catatan_spek']; ?></td>
    <td align="center"><a href="index.php?page=simpan_tambah_pemesanan_alkes2_set_sudah_ada&id_hapus=<?php echo $data_akse['idd']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;&nbsp;<a href="index.php?page=detail_set1_sudah_ada&id=<?php echo $_GET['id']; ?>&detail=<?php echo $data_akse['id_gudang']; ?>"><span data-toggle="tooltip" title="Detail Set" class="fa fa-caret-square-o-right"></span></a></td>
    </tr>
  <?php }} else {
	  echo "<tr><td colspan='11' align='center'>Tidak Ada Data</td></tr>";
	  } ?>
      <form method="post">
    <tr>
    <td colspan="8" align="right" valign="bottom"><strong>Total Price =</strong></td>
    <td align="center">
    <?php
    $total = mysqli_fetch_array(mysqli_query($koneksi, "select sum(harga_total) as total from barang_pesan_set_detail_hash"));
		//$total = mysqli_query($koneksi, "select * from barang_pesan_detail where barang_pesan_id=$id");
		//echo " ".number_format($total_akse2+$total['total'],0,',',',').".00";
        ?>
        <input name="total_price" class="form-control" type="text" required="required" placeholder="" size="10" value="<?php echo number_format($total['total'],2,',',''); ?>"/>
    </td>
    <td align="center"></td>
    <td align="center"></td>
    </tr>
    <tr>
    <td colspan="8" align="right" valign="bottom"><strong>Total Price + PPN(<?php echo $_SESSION['ppn']."%"; ?>) =</strong></td>
    <td align="center">
    <input id="total_price_ppn" name="total_price_ppn" class="form-control" type="text" required="required" placeholder="" size="10" value="<?php echo number_format(($total['total'])+(($total['total'])*floatval($_SESSION['ppn'])/100),2,',',''); ?>"/>
    </td>
    <td align="center"></td>
    <td align="center"></td>
    </tr>
    <tr>
    <td colspan="8" align="right" valign="bottom"><strong>Freight Cost by Air to JAKARTA =</strong></td>
    <td align="center" valign="top"><input name="cost_byair" id="cost_byair" class="form-control" type="text" placeholder="" onkeyup="sum_total_keseluruhan();" size="10"/></td>
    <td align="center"></td>
    <td align="center"></td>
    </tr>
    <tr>
    <td colspan="8" align="right" valign="bottom"><strong>Total Keseluruhan =</strong></td>
    <td align="center" valign="top"><input id="cost_cf" name="cost_cf" class="form-control" type="text" placeholder="" size="10"/></td>
    <td align="center"></td>
    <td align="center"></td>
    </tr>
</table>

<center><a href="index.php?page=simpan_tambah_pemesanan_alkes2_set_sudah_ada#open_utang"><button name="simpan_barang" class="btn btn-success" type="button"><span class="fa fa-plus"></span> Simpan</button></a>&nbsp;&nbsp;<a href="index.php?page=pembelian_alkes2_set"><button name="batal" class="btn btn-success" type="button"><span class="fa  fa-times-circle"></span> Batal</button></a></center>
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
<div id="open_utang" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Tambah Hutang Baru</h3> 
<script type="text/javascript">
function yesnoCheck() {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('ifYes').style.display = 'block';
    }
    else document.getElementById('ifYes').style.display = 'none';
}
</script>
 
              <label>No PO</label>
              <input name="no_faktur" class="form-control" type="text" placeholder="" disabled="disabled" value="<?php echo $_SESSION['no_po']; ?>"><br />
              <label>Tanggal</label>
              <input name="tgl_input" class="form-control" type="date" placeholder="" required="required" value="<?php echo $_SESSION['tgl_po']; ?>"><br />
              <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="noCheck" style="height:20px; width:20px" checked="checked"><label>Tidak Ada Jatuh Tempo</label><br /><input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="yesCheck" style="height:20px; width:20px"><label>Jatuh Tempo</label>
              <br />
              <div id="ifYes" style="display:none">
              <label>Tanggal Jatuh Tempo</label>
              <input name="jatuh_tempo" type="date" class="form-control" placeholder="" value=""><br />
              </div>
               
              <label>Nominal</label>
              <input id="" name="nominal" class="form-control" type="text" placeholder="Dalam Rupiah" value=""><br />
              <label>Klien</label>
              <input name="klien" class="form-control" type="text" placeholder="" value="<?php echo $sel['nama_principle'];  ?>" required="required"><br />
              <label>Deskripsi</label>
              <textarea name="deskripsi" class="form-control" rows="4"></textarea>
              <br />
             <br />
              <!--
              <label>Akun</label>
              <select name="akun" id="akun" class="form-control" required>
              <option value="">-- Pilih --</option>
              <?php
              $q = mysqli_query($koneksi, "select * from coa order by nama_akun ASC");
			  while ($d=mysqli_fetch_array($q)) {
			  ?>
              <option value="<?php echo $d['id']; ?>"><?php echo $d['nama_akun']; ?></option>
              <?php } ?>
              </select><br />
              <label>Jenis</label>
              <select name="jenis_akun" id="jenis_akun" class="form-control" required>
    <option value="">--Jenis--</option>
    <?php 
	$q_seri = mysqli_query($koneksi, "select *,coa_detail.id as idd,coa_detail.nama_akun as nama from coa_detail INNER JOIN coa ON coa.id=coa_detail.coa_id order by coa_detail.nama_akun ASC");
	while ($d_seri=mysqli_fetch_array($q_seri)) {
	?>
    <option id="jenis_akun" value="<?php echo $d_seri['idd']; ?>" class="<?php echo $d_seri['coa_id']; ?>"><?php echo $d_seri['nama']; ?></option>
    <?php } ?>
    </select>
              <script src="jquery-1.10.2.min.js"></script>
        <script src="jquery.chained.min.js"></script>
        <script>
            $("#jenis_akun").chained("#akun");
        </script>
        -->
              
              <button name="tambah_header" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan</button>
              
    </div>
</div>
</form>

