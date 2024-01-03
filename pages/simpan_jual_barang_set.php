<?php 
if (isset($_POST['tambah_header'])) {
	$cek = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_qty_set_hash where akun_id=".$_SESSION['id'].""));
	if ($cek!=0) {
	$insert_pembeli=mysqli_query($koneksi, "insert into pembeli values('','".$_SESSION['pembeli']."','".$_SESSION['provinsi']."','".$_SESSION['kabupaten']."','".$_SESSION['kecamatan']."','".$_SESSION['kelurahan']."','".$_SESSION['alamat']."','".$_SESSION['kontak_rs']."')");
	
	$insert_pemakai=mysqli_query($koneksi, "insert into pemakai values('','".$_SESSION['pemakai']."','".$_SESSION['kontak1']."','".$_SESSION['kontak2']."','".$_SESSION['email']."')");
	
	$pembeli=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_pembeli from pembeli"));
	$id_pembeli=$pembeli['id_pembeli'];
	$pemakai=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_pemakai from pemakai"));
	$id_pemakai=$pemakai['id_pemakai'];
	//simpan barang dijual
	$total = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_qty_set_hash where akun_id=".$_SESSION['id'].""));
	
	$simpan1=mysqli_query($koneksi, "insert into barang_dijual_set values('','".$_SESSION['tgl_jual']."','".$_SESSION['no_faktur']."','$id_pembeli','$id_pemakai','".$_SESSION['marketing']."','".$_SESSION['subdis']."','".$_SESSION['diskon']."','".$_SESSION['ppn']."','".$_POST['nominal']."')");
	
	$d1=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_jual from barang_dijual_set"));
	$id_jual=$d1['id_jual'];
	//simpan barang pesan detail
	$q2=mysqli_query($koneksi, "select * from barang_dijual_qty_set_hash where akun_id=".$_SESSION['id']."");
	while ($d2 = mysqli_fetch_array($q2)) {
		$simpan2=mysqli_query($koneksi, "insert into barang_dijual_qty_set values('','$id_jual','".$d2['barang_gudang_set2_id']."','".$d2['qty']."','0')");
		//$up=mysqli_query($koneksi, "update barang_gudang_detail set status_terjual=1 where id=".$d2['barang_gudang_detail_id']."");
		//$up2=mysqli_query($koneksi, "update barang_gudang_set_2 set qty=qty-$d2[qty] where id=".$d2['barang_gudang_set2_id']."");
		}
		if ($simpan1 and $simpan2) {
			$Result = mysqli_query($koneksi, "insert into utang_piutang values('','Piutang','".$_SESSION['no_faktur']."','".$_POST['tgl_input']."','".$_POST['jatuh_tempo']."','".$_POST['nominal']."','".$_POST['klien']."','".$_POST['deskripsi']."','0')");
			mysqli_query($koneksi, "delete from barang_dijual_qty_hash where akun_id=".$_SESSION['id']."");
	echo "<script type='text/javascript'>
	alert('Data Berhasil Di Simpan !');
	window.location='index.php?page=penjualan_barang_set'</script>";
		}
	}
	else {
		echo "<script type='text/javascript'>
	alert('Data tidak boleh kosong , silakan tambah terlebih dahulu ! !');
	window.location='index.php?page=simpan_jual_barang_set'</script>";
		}
}


if (isset($_POST['simpan_tambah_aksesoris'])) {
	if ($_POST['nama_set']=='') {
		$cek = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_set_2 where $_POST[qty]>qty and barang_gudang_set1_id=".$_POST['pilih_set'].""));
	if ($cek==0) {
		$s = mysqli_query($koneksi, "select * from barang_gudang_set_2 where barang_gudang_set1_id=".$_POST['pilih_set']."");
		while ($da = mysqli_fetch_array($s)) {
			if ($_POST['input_qty']=="Manual") {
				$qty = $_POST['qty'];
				}
			else {
				$qty = $da['qty'];
				}
			mysqli_query($koneksi, "insert into barang_dijual_qty_set_hash values('','".$_SESSION['id']."','".$da['id']."','$qty')");
			}
			echo "<script>window.location='index.php?page=simpan_jual_barang_set'</script>";
		}
		else {
			echo "<script>alert('Maaf , Stok Ada Yang Tidak Mencukupi !');</script>";
			}
		}
	else {
	$stok = mysqli_fetch_array(mysqli_query($koneksi, "select qty from barang_gudang_set_2 where id=".$_POST['nama_set'].""));
	if ($stok['qty']>=$_POST['qty']) {
	$simpan = mysqli_query($koneksi, "insert into barang_dijual_qty_set_hash values('','".$_SESSION['id']."','".$_POST['nama_set']."','".$_POST['qty']."')");
	if ($simpan) {
		echo "<script>window.location='index.php?page=simpan_jual_barang_set'</script>";
		}
	} else {
		echo "<script>alert('Maaf , Stok Tidak Mencukupi !');
		</script>";
		}
	}
}
	
if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from barang_dijual_qty_set_hash where id=".$_GET['id_hapus']."");
	}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Jual Barang Set</h1><ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Jual Barang Set</li>
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
      <th colspan="9" align="left">Marketing : <?php echo $_SESSION['marketing']; ?>&nbsp;&nbsp;&nbsp;&nbsp; , Sub Distributor : <?php echo $_SESSION['subdis']; ?>&nbsp;&nbsp;&nbsp;&nbsp; , Diskon : <?php echo $_SESSION['diskon']." %"; ?>&nbsp;&nbsp;&nbsp;&nbsp; , PPN : <?php echo $_SESSION['ppn']." %"; ?></th>
      </tr>
    <tr>
      <th colspan="3" valign="bottom">&nbsp;</th>
      <th valign="bottom">&nbsp;</th>
      <th valign="bottom">&nbsp;</th>
      <th valign="bottom">&nbsp;</th>
      <th valign="bottom">&nbsp;</th>
      <th valign="bottom">&nbsp;</th>
      <th valign="bottom">&nbsp;</th>
    </tr>
    <tr>
      <th valign="bottom"><strong>Tgl Jual</strong></th>
      <th valign="bottom">NO Faktur</th>
      <th valign="bottom">Nama RS/Dinas/Klinik/dll</th>
      <th valign="bottom"><strong>Kelurahan</strong></th>
      <th valign="bottom">Alamat</th>
      <th valign="bottom"><strong>Kontak RS/Dinas/dll</strong></th>
      <th valign="bottom"><strong>Nama Pemakai</strong></th>
      <th valign="bottom">Kontak Pemakai</th>
      <th valign="bottom">Email</th>
      </tr>
  </thead>
  <tr>
    <td><?php echo date("d-m-Y",strtotime($_SESSION['tgl_jual'])); ?>
    </td>
    <td><?php echo $_SESSION['no_faktur']; ?></td>
    <td><?php 
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select nama_pembeli from pembeli where id=".$_SESSION['pembeli'].""));
	echo $_SESSION['pembeli']; ?></td>
    <td><?php echo $_SESSION['kelurahan']; ?></td>
    <td><?php echo $_SESSION['alamat']; ?></td>
    <td><?php echo $_SESSION['kontak_rs']; ?></td>
    <td><?php echo $_SESSION['pemakai']; ?></td>
    <td><?php echo $_SESSION['kontak1']." / ".$_SESSION['kontak2']; ?></td>
    <td><?php echo $_SESSION['email']; ?></td>
    </tr>
</table><br />
                <font align="left" size="+2">
                  Tambah Data Alkes Yang Akan Dijual</font><font class="pull pull-right" color="#FF0000">(* Yang tidak bisa di pilih menandakan barang sudah dijual)</font>
                <!--<font color="#FF0000">* Jika Ingin Menambah Data Aksesoris Yang Baru ! Klik Disini <a href="index.php?page=simpan_tambah_aksesoris&id=<?php //echo $_GET['id']; ?>#openAkse"><small data-toggle="tooltip" title="Tambah Aksesoris Baru" class="label bg-blue">+ New Accessories</small></a></font>-->
                <br />
                <table width="100%" id="example3" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">No</th>
      <th valign="bottom"><strong>Nama Barang</strong></th>
      <td align="center" valign="bottom"><strong>Pilih Set</strong>      
      <td align="center" valign="bottom"><strong>Nama Set</strong>      
      <td align="center" valign="bottom"><strong>Stok Set</strong>      
      <td align="center" valign="bottom"><strong>Harga Satuan      
      </strong>
      <td align="center" valign="bottom"><strong>Input Qty</strong>      
      <td align="center" valign="bottom"><strong>Qty Jual</strong>
      <td align="center" valign="bottom"><strong>Total Harga</strong>      
      <td align="center" valign="bottom"><strong>Aksi</strong></tr>
  </thead>
  
  <tr>
    <td>#</td>
    <form method="post" name="form1" enctype="multipart/form-data">
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
    <td align="center"><select name="pilih_set" id="pilih_set" class="form-control" required="required">
      <option value="">-- Pilih --</option>
      <?php
	$q_seri = mysqli_query($koneksi, "select *,barang_gudang_set.id as idd, barang_gudang_set_1.id as id_set1 from barang_gudang_set,barang_gudang_po_set,barang_gudang_set_1 where barang_gudang_set.id=barang_gudang_po_set.barang_gudang_set_id and barang_gudang_po_set.id=barang_gudang_set_1.barang_gudang_po_set_id group by barang_gudang_set_1.id order by barang_gudang_set_1.id ASC");
	while ($d_seri=mysqli_fetch_array($q_seri)) {
	?>
      <option id="pilih_set" value="<?php echo $d_seri['id_set1']; ?>" class="<?php echo $d_seri['idd']; ?>"><?php echo "ID ".$d_seri['id_set1']; ?></option>
      <?php } ?>
    </select></td>
    <td align="center"><select name="nama_set" id="nama_set" class="form-control" onchange="changeValue(this.value)">
      <option value="">-- Semua Nya --</option>
      <?php
	$q_seri2 = mysqli_query($koneksi, "select *,barang_gudang_set.id as idd, barang_gudang_set_1.id as id_set1, barang_gudang_set_2.id as id_set2 from barang_gudang_set,barang_gudang_po_set,barang_gudang_set_1,barang_gudang_set_2 where barang_gudang_set.id=barang_gudang_po_set.barang_gudang_set_id and barang_gudang_po_set.id=barang_gudang_set_1.barang_gudang_po_set_id and barang_gudang_set_1.id=barang_gudang_set_2.barang_gudang_set1_id and qty!=0 order by barang_gudang_set_2.nama_set ASC");
	$jsArray2 = "var dtBrg2 = new Array();
";
	while ($d_seri=mysqli_fetch_array($q_seri2)) {
	?>
      <option id="nama_set" value="<?php echo $d_seri['id_set2']; ?>" class="<?php echo $d_seri['id_set1']; ?>"><?php echo $d_seri['nama_set']; ?></option>
      <?php 
	  $jsArray2 .= "dtBrg2['" . $d_seri['id_set2'] . "'] = {qty:'".addslashes($d_seri['qty'])."',
	  harga_satuan:'".addslashes(number_format($d_seri['harga_jual'],2,'.',','))."'
						};";
	  } ?>
      </select>
      <script src="jquery-1.10.2.min.js"></script>
      <script src="jquery.chained.min.js"></script>
      <script>
            $("#pilih_set").chained("#id_akse");
			$("#nama_set").chained("#pilih_set");
        </script>
    </td>
    <td align="center"><input id="stok_set" name="stok_set" class="form-control" type="text" placeholder="Stok Set" disabled="disabled" size="2"/></td>
    <td align="center"><input id="harga_satuan" name="harga_satuan" class="form-control" type="text" placeholder="Harga Satuan" disabled="disabled" size="12"/></td>
    <td align="center"><select class="form-control" name="input_qty" id="input_qty" onchange="changetextbox();">
      <option value="Manual">Manual</option>
      <option value="Auto">Auto</option>
    </select></td>
    <td align="center">
      <input id="qty" name="qty" class="form-control" type="text" placeholder="" size="2" required="required"/>
      <script type="text/javascript">
function changetextbox() {
	if (document.getElementById("input_qty").value === "Manual") {
		document.getElementById("qty").disabled='';
		}
	if (document.getElementById("input_qty").value === "Auto") {
		document.getElementById("qty").disabled='true';
		}
	}
</script>
      </td>
    <td align="center" valign="bottom">Auto</td>
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
		document.getElementById('no_akse').value = dtBrg[id_akse].no_akse;
		
	};  
</script>
<script type="text/javascript">    
	<?php 
	echo $jsArray2; 
	?>  
	function changeValue(nama_set){  
		document.getElementById('stok_set').value = dtBrg2[nama_set].qty;
		document.getElementById('harga_satuan').value = dtBrg2[nama_set].harga_satuan;
	};  
</script>
  <?php
   
  $no=0;
  $q_akse = mysqli_query($koneksi, "select *,barang_gudang_set_1.id as id_set1,barang_dijual_qty_set_hash.id as id_hash from barang_gudang_set_2,barang_gudang_set_1,barang_gudang_po_set,barang_dijual_qty_set_hash,barang_gudang_set where barang_gudang_set_2.id=barang_dijual_qty_set_hash.barang_gudang_set2_id and barang_gudang_set_1.id=barang_gudang_set_2.barang_gudang_set1_id and barang_gudang_po_set.id=barang_gudang_set_1.barang_gudang_po_set_id and barang_gudang_set.id=barang_gudang_po_set.barang_gudang_set_id and akun_id=".$_SESSION['id']."");
  $jm = mysqli_num_rows($q_akse);
  if ($jm!=0) { 
  while ($data_akse = mysqli_fetch_array($q_akse)) {
	  $no++;
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $data_akse['nama_brg']; ?>
    </td>
    <td align="center"><?php echo "ID ".$data_akse['id_set1']; ?></td>
    <td><?php echo $data_akse['nama_set']; ?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><?php echo number_format($data_akse['harga_jual'],2,',','.') ?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><?php echo $data_akse['qty_jual']; ?></td>
    <td align="center"><?php echo number_format($data_akse['harga_jual']*$data_akse['qty_jual'],2,',','.') ?></td>
    <td align="center"><a href="index.php?page=simpan_jual_barang_set&id_ubah=<?php echo $data_akse['id_hash']; ?>#openUbah"><span data-toggle="tooltip" title="Ubah Qty" class="fa fa-edit"></span></a>&nbsp;&nbsp;<a href="index.php?page=simpan_jual_barang_set&id_hapus=<?php echo $data_akse['id_hash']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a></td>
    </tr>
  <?php }} else {
	  echo "<tr><td colspan='10' align='center'>Tidak Ada Data</td></tr>";
	  } ?>
     <tr>
       <td colspan="10" align="right" bgcolor="#00CC66"></td>
       </tr>
     <tr>
    <td colspan="8" align="right"><strong>Sub Total</strong></td>
    <td align="center">
    <?php 
	$se = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual*harga_jual) as sub_total from barang_gudang_set_2,barang_dijual_qty_set_hash where barang_gudang_set_2.id=barang_dijual_qty_set_hash.barang_gudang_set2_id and akun_id=".$_SESSION['id'].""));
	?>
    <?php 
	$total=$se['sub_total'];
	echo number_format($se['sub_total'],2,',','.'); ?></td>
    <td align="center">&nbsp;</td>
    </tr>
     <tr>
       <td colspan="8" align="right">PPn (<?php echo $_SESSION['ppn']." %"; ?>)</td>
       <td align="center"><?php 
	   $total3=$se['sub_total']*$_SESSION['ppn']/100;
	   echo number_format($se['sub_total']*$_SESSION['ppn']/100,2,',','.')."  (+)"; ?></td>
       <td align="center">&nbsp;</td>
     </tr>
     <tr>
       <td colspan="8" align="right">Disc (<?php echo $_SESSION['diskon']." %"; ?>)</td>
       <td align="center"><?php 
	   $total2=$se['sub_total']*$_SESSION['diskon']/100;
	   echo number_format($se['sub_total']*$_SESSION['diskon']/100,2,',','.')."  (-)"; ?></td>
       <td align="center">&nbsp;</td>
     </tr>
     <tr>
       <td colspan="8" align="right" valign="bottom"><strong>Total Keseluruhan</strong></td>
       <td align="center">
       <?php echo number_format($total-$total2+$total3,2,',','.'); ?></td>
       <td align="center"></td>
     </tr>
     <tr>
       <td colspan="10" align="right" valign="bottom">
         <center><a href="index.php?page=simpan_jual_barang_set#open_piutang"><button name="simpan_barang" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button></a>&nbsp;&nbsp;<a href="index.php?page=penjualan_barang_set"><button name="batal" class="btn btn-success" type="button"><span class="fa fa-times-circle"></span> Batal</button></a></center>
         </td>
     </tr>
     
                </table>
</center>
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
  $data=mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dijual_qty_set_hash where id=".$_GET['id_ubah'].""));
  if (isset($_POST['ubah_qty'])) {
	$sell=mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang_set_2 where id=".$data['barang_gudang_set2_id'].""));
	if ($sell['qty']>=$_POST['qty']) {  
	$Result = mysqli_query($koneksi, "update barang_dijual_qty_set_hash set qty_jual=".$_POST['qty']." where id=".$_GET['id_ubah']."");
	if ($Result) {
		echo "<script type='text/javascript'>	window.location='index.php?page=simpan_jual_barang_set';
		</script>";
		}
	} else {
		echo "<script type='text/javascript'>
		alert('Stok tidak cukup !');
		
		</script>";
		}
}
		?>
  <div id="openUbah" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Ubah Qty</h3> 
     <form method="post">
              <label>Qty</label>
              <input name="qty" class="form-control" type="text" placeholder="" value="<?php echo $data['qty_jual']; ?>"><br />
             <button name="ubah_qty" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan</button>
        </form> 
    </div>
</div>
<div id="open_piutang" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Tambah Piutang Baru</h3> 
<script type="text/javascript">
function yesnoCheck() {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('ifYes').style.display = 'block';
    }
    else document.getElementById('ifYes').style.display = 'none';
}
</script>
     <form method="post">
              <label>No Faktur</label>
              <input name="no_faktur" class="form-control" type="text" placeholder="" value="<?php echo $_SESSION['no_faktur']; ?>" disabled="disabled"><br />
              <label>Tanggal</label>
              <input name="tgl_input" class="form-control" type="date" placeholder="" required="required" value="<?php echo $_SESSION['tgl_jual']; ?>"><br />
              <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="noCheck" style="height:20px; width:20px" checked="checked"><label>Tidak Ada Jatuh Tempo</label><br /><input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="yesCheck" style="height:20px; width:20px"><label>Jatuh Tempo</label>
              <br />
              <div id="ifYes" style="display:none">
              <label>Tanggal Jatuh Tempo</label>
              <input name="jatuh_tempo" type="date" class="form-control" placeholder="" value=""><br />
              </div>
               
              <label>Nominal</label>
              <input name="nominal" class="form-control" type="text" placeholder="" value="<?php echo $total-$total2+$total3; ?>" required="required"><br />
              <label>Klien</label>
              <input name="klien" class="form-control" type="text" placeholder="" value="<?php echo $_SESSION['pembeli'];  ?>" required="required"><br />
              <label>Deskripsi</label>
              <textarea name="deskripsi" class="form-control" rows="4" required="required"></textarea>
              <br />
             <br />
             <button name="tambah_header" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan</button>
        </form>
              
    </div>
</div>
