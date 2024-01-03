<?php
$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dijual where id=".$_GET['id'].""));
			   
if (isset($_POST['tambah_header'])) {
	$cek = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_qty_hash where akun_id=".$_SESSION['id'].""));
	if ($cek!=0) {
	//$insert_pembeli=mysqli_query($koneksi, "insert into pembeli values('','".$_SESSION['pembeli']."','".$_SESSION['provinsi']."','".$_SESSION['kabupaten']."','".$_SESSION['kecamatan']."','".$_SESSION['kelurahan']."','".$_SESSION['alamat']."','".$_SESSION['kontak_rs']."')");
	
	$insert_pemakai=mysqli_query($koneksi, "insert into pemakai values('','".$_SESSION['pemakai']."','".$_SESSION['kontak1']."','".$_SESSION['kontak2']."','".$_SESSION['email']."')");
	
	//$pembeli=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_pembeli from pembeli"));
	$id_pembeli=$_SESSION['pembeli'];
	$pemakai=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_pemakai from pemakai"));
	$id_pemakai=$pemakai['id_pemakai'];
	//simpan barang dijual
	$total = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_qty_hash where akun_id=".$_SESSION['id'].""));
	
	$simpan1=mysqli_query($koneksi, "insert into barang_dijual values('','".$_SESSION['tgl_jual']."','".$_SESSION['no_faktur']."','$id_pembeli','$id_pemakai','".$_SESSION['marketing']."','".$_SESSION['subdis']."','".$_SESSION['diskon']."','".$_SESSION['ppn']."','".$_POST['nominal']."')");
	
	$d1=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_jual from barang_dijual"));
	$id_jual=$d1['id_jual'];
	//simpan barang pesan detail
	$q2=mysqli_query($koneksi, "select * from barang_dijual_qty_hash where akun_id=".$_SESSION['id']."");
	while ($d2 = mysqli_fetch_array($q2)) {
		$simpan2=mysqli_query($koneksi, "insert into barang_dijual_qty values('','$id_jual','".$d2['barang_gudang_id']."','".$d2['harga_jual_saat_itu']."','".$d2['qty']."','0')");
		//$up=mysqli_query($koneksi, "update barang_gudang_detail set status_terjual=1 where id=".$d2['barang_gudang_detail_id']."");
		//$up2=mysqli_query($koneksi, "update barang_gudang,barang_gudang_detail set stok_total=stok_total-1 where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=".$d2['barang_gudang_detail_id']."");
		}
		if ($simpan1 and $simpan2) {
			$Result = mysqli_query($koneksi, "insert into utang_piutang values('','Piutang','".$_SESSION['no_faktur']."','".$_POST['tgl_input']."','".$_POST['jatuh_tempo']."','".$_POST['nominal']."','".$_POST['klien']."','".$_POST['deskripsi']."','0')");
			mysqli_query($koneksi, "delete from barang_dijual_qty_hash where akun_id=".$_SESSION['id']."");
	echo "<script type='text/javascript'>
	alert('Data Berhasil Di Simpan !');
	window.location='index.php?page=jual_barang_uang'</script>";
		}
	}
	else {
		echo "<script type='text/javascript'>
	alert('Data tidak boleh kosong , silakan tambah terlebih dahulu ! !');
	window.location='index.php?page=simpan_jual_alkes2'</script>";
		}
}


if (isset($_POST['simpan_tambah_aksesoris'])) {
	$cek_harga = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang where id=".$_POST['id_akse'].""));
	if ($cek_harga['harga_satuan']!=0) {
	//$stok = mysqli_fetch_array(mysqli_query($koneksi, "select stok_total from barang_gudang where id=".$_POST['id_akse'].""));
	//$stok_po1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual) as stok_po from barang_dijual_qty where barang_gudang_id=".$_POST['id_akse'].""));
	//$stok_po2 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim_detail,barang_gudang_detail,barang_dijual_qty where barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual_qty.id=barang_dikirim_detail.barang_dijual_qty_id and barang_dijual_qty.barang_gudang_id=".$_POST['id_akse'].""));
	//$go=$stok['stok_total']-($stok_po1['stok_po']-$stok_po2);
	//if ($go>=$_POST['qty']) {
	$sel_hrg_jual=mysqli_fetch_array(mysqli_query($koneksi, "select harga_satuan from barang_gudang where id=".$_POST['id_akse'].""));
	$simpan = mysqli_query($koneksi, "insert into barang_dijual_qty values('','".$_GET['id']."','".$_POST['id_akse']."','".$sel_hrg_jual['harga_satuan']."','".$_POST['qty']."','')");
	if ($simpan) {
		$jml = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual*harga_jual_saat_itu) as total from barang_dijual_qty where barang_dijual_id=".$_GET['id'].""));
		  mysqli_query($koneksi, "update barang_dijual set total_harga=$jml[total]+($jml[total]*ppn_jual/100)-($jml[total]*diskon_jual/100) where id=".$_GET['id']."");
		$update_piutang = mysqli_query($koneksi, "update utang_piutang set nominal=$jml[total] where no_faktur_no_po='".$data['no_po_jual']."'");
		echo "<script>window.location='index.php?page=ubah_jual_barang_uang&id=$_GET[id]'</script>";
		}
	/*} else {
		echo "<script>alert('Maaf , Stok Tidak Mencukupi !');
		</script>";
		}*/
	} else {
		echo "<script>alert('Harga jual alat tidak boleh 0 , update harga jual nya terlebih dahulu !');
		</script>";;
		}
	}
	
if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from barang_dijual_qty where id=".$_GET['id_hapus']."");
	$jml = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual*harga_jual_saat_itu) as total from barang_dijual_qty where barang_dijual_id=".$_GET['id'].""));
		  mysqli_query($koneksi, "update barang_dijual set total_harga=".$jml['total']." where id=".$_GET['id']."");
		  $update_piutang = mysqli_query($koneksi, "update utang_piutang set nominal=$jml[total] where no_faktur_no_po='".$data['no_po_jual']."'");
	}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Ubah Penjualan Alkes</h1><ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Ubah Penjualan Alkes</li>
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
      <th colspan="9" align="left">Marketing : <?php echo $data['marketing']; ?>&nbsp;&nbsp;&nbsp;&nbsp; , Sub Distributor : <?php echo $data['subdis']; ?>&nbsp;&nbsp;&nbsp;&nbsp; , Diskon : <?php echo $data['diskon_jual']." %"; ?>&nbsp;&nbsp;&nbsp;&nbsp; , PPN : <?php echo $data['ppn_jual']." %"; ?></th>
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
      <th valign="bottom">No PO</th>
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
    <td><?php echo date("d-m-Y",strtotime($data['tgl_jual'])); ?>
    </td>
    <td><?php echo $data['no_po_jual']; ?></td>
    <td><?php 
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from pembeli where id=".$data['pembeli_id'].""));
	echo $sel['nama_pembeli']; ?></td>
    <td><?php echo $sel['kelurahan_id']; ?></td>
    <td><?php echo $sel['jalan']; ?></td>
    <td><?php echo $sel['kontak_rs']; ?></td>
    <td><?php 
	$sel_pemakai = mysqli_fetch_array(mysqli_query($koneksi, "select * from pemakai where id=".$data['pemakai_id'].""));
	echo $sel_pemakai['nama_pemakai']; ?></td>
    <td><?php echo $sel_pemakai['kontak1_pemakai']." / ".$_SESSION['kontak2_pemakai']; ?></td>
    <td><?php echo $sel_pemakai['email_pemakai']; ?></td>
    </tr>
</table><br />
                
                <!--<font color="#FF0000">* Jika Ingin Menambah Data Aksesoris Yang Baru ! Klik Disini <a href="index.php?page=simpan_tambah_aksesoris&id=<?php //echo $_GET['id']; ?>#openAkse"><small data-toggle="tooltip" title="Tambah Aksesoris Baru" class="label bg-blue">+ New Accessories</small></a></font>-->
                <br />
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">No</th>
      <th valign="bottom"><strong>Nama Alkes</strong></th>
      <td align="center" valign="bottom"><strong>Stok_Gudang - Stok_PO</strong></td>
      <td align="center" valign="bottom"><strong>Harga      
      Jual</strong><br /><font size="-2" color="#FF0000">Harga tidak boleh 0</font></td>
      <td align="center" valign="bottom"><strong>Tipe      
      </strong></td>
      <td align="center" valign="bottom"><strong>Merk      
      </strong></td>
      <td align="center" valign="bottom"><strong>Qty</strong></td>
      <td valign="bottom"><strong>Total</strong></td>      
      <td align="center" valign="bottom"><strong>Aksi</strong></td>
     </tr>
  </thead>
  
  <tr>
    <td>#</td>
    <form method="post" name="form1" enctype="multipart/form-data">
    <td>
    
    <select name="id_akse" id="id_akse" class="form-control select2" autofocus="autofocus" required onchange="changeValue(this.value)">
    	<option value="">-- Pilih Alkes --</option>
        <?php 
		$q = mysqli_query($koneksi, "select * from barang_gudang order by nama_brg ASC");
		$jsArray = "var dtBrg = new Array();
";
		while ($d = mysqli_fetch_array($q)) { ?>
        <option value="<?php echo $d['id']; ?>"><?php echo $d['nama_brg']." - ".$d['tipe_brg']; ?></option>
        <?php
		$stok_po1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual) as stok_po from barang_dijual_qty where barang_gudang_id=".$d['id'].""));
	$stok_po2 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim_detail,barang_gudang_detail,barang_dijual_qty where barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual_qty.id=barang_dikirim_detail.barang_dijual_qty_id and barang_dijual_qty.barang_gudang_id=".$d['id'].""));
		 
		$jsArray .= "dtBrg['" . $d['id'] . "'] = {tipe_akse:'".addslashes($d['tipe_brg'])."',
						merk_akse:'".addslashes($d['merk_brg'])."',
						stok_total:'".addslashes($d['stok_total']-($stok_po1['stok_po']-$stok_po2))."',
						harga:'".addslashes("Rp ".number_format($d['harga_satuan'],2,',','.'))."',
						no_akse:'".addslashes($d['nie_brg'])."'
						};";
		} ?>
    </select>
    
    </td>
    <td align="center"><input id="stok_total" name="stok_total" class="form-control" type="text" placeholder="Stok" disabled="disabled" size="4"/></td>
    <td align="center"><input id="harga" name="harga" class="form-control" type="text" placeholder="Harga" disabled="disabled" size="8"/></td>
    <td align="center"><input id="tipe_akse" name="tipe_akse" class="form-control" type="text" placeholder="Tipe" disabled="disabled" size="15"/></td>
    <td align="center"><input id="merk_akse" name="merk_akse" class="form-control" type="text"  placeholder="Merk" disabled="disabled" size="15"/></td>
    <td align="center">
      <input id="qty" name="qty" class="form-control" type="text" placeholder="" size="2"/></td>
    <td>Auto</td>
    <td align="center"><button name="simpan_tambah_aksesoris" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah</button></td>
    </form>
  </tr>
  
  <script type="text/javascript">    
	<?php 
	echo $jsArray; 
	?>  
	function changeValue(id_akse){  
		document.getElementById('harga').value = dtBrg[id_akse].harga;
		document.getElementById('stok_total').value = dtBrg[id_akse].stok_total;
		document.getElementById('tipe_akse').value = dtBrg[id_akse].tipe_akse; 
		document.getElementById('merk_akse').value = dtBrg[id_akse].merk_akse;
		document.getElementById('no_akse').value = dtBrg[id_akse].no_akse;
		
	};  
</script>
  <?php
   
  $no=0;
  $q_akse = mysqli_query($koneksi, "select *,barang_dijual_qty.id as idd from barang_dijual_qty,barang_gudang where barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual_id=".$_GET['id']."");
  $jm = mysqli_num_rows($q_akse);
  if ($jm!=0) { 
  while ($data_akse = mysqli_fetch_array($q_akse)) {
	  $no++;
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $data_akse['nama_brg']; ?>
    </td>
    <td align="center">&nbsp;</td>
    <td align="center"><?php echo "Rp".number_format($data_akse['harga_jual_saat_itu'],2,',','.'); ?></td>
    <td align="center"><?php echo $data_akse['tipe_brg']; ?></td>
    <td align="center"><?php echo $data_akse['merk_brg']; ?></td>
    <td align="center"><?php echo $data_akse['qty_jual']; ?></td>
    <td><?php echo "Rp".number_format($data_akse['harga_jual_saat_itu']*$data_akse['qty_jual'],2,',','.'); ?></td>
    <td align="center"><a href="index.php?page=ubah_jual_barang_uang&id=<?php echo $_GET['id']; ?>&id_hapus=<?php echo $data_akse['idd']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;&nbsp;<a href="index.php?page=ubah_jual_barang_uang&id=<?php echo $_GET['id']; ?>&id_ubah=<?php echo $data_akse['idd']; ?>#openUbah"><span data-toggle="tooltip" title="Ubah Qty" class="fa fa-edit"></span></a></td>
    </tr>
  <?php }} else {
	  echo "<tr><td colspan='9' align='center'>Tidak Ada Data</td></tr>";
	  } ?>
    <tr bgcolor="#009900">
    <td colspan="9"></td>
    </tr>
    <tr>
      <td colspan="7" align="right"><strong>Sub Total</strong></td>
      <td><?php
      $total1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual*harga_satuan) as total1 from barang_gudang,barang_dijual_qty where barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual_id=".$_GET['id'].""));
	  echo "Rp".number_format($total1['total1'],2,',','.');
	  ?></td>
      <td align="center"></td>
    </tr>
    <tr>
      <td colspan="7" align="right">PPn (<?php echo $_SESSION['ppn']."%"; ?>)</td>
      <td>
      <?php 
	  $ppn = $total1['total1']*$data['ppn_jual']/100;
	  echo "Rp".number_format($ppn,2,',','.')." (+)";
	  ?>
      </td>
      <td align="center"></td>
    </tr>
    <tr>
      <td colspan="7" align="right">Diskon (<?php echo $_SESSION['diskon']."%"; ?>)</td>
      <td><?php 
	  $diskon = $total1['total1']*$data['diskon_jual']/100;
	  echo "Rp".number_format($diskon,2,',','.')." (-)";
	  ?></td>
      <td align="center"></td>
    </tr>
    
    <tr>
    <td colspan="7" align="right"><strong>Total Keseluruhan</strong></td>
    <td><?php 
	$total2=$total1['total1']+$ppn-$diskon;
	echo "Rp".number_format($total2,2,',','.'); ?></td>
    <td align="center"></td>
    </tr>
    <tr>
      <td colspan="9" align="right">
        <center><!--<a href="index.php?page=simpan_jual_alkes2&simpan_barang=1"><button name="simpan_barang" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button></a><a href="index.php?page=ubah_jual_barang_uang#open_piutang"><button name="simpa" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button></a>&nbsp;&nbsp;--><a href="index.php?page=jual_barang_uang">
        <button name="batal" class="btn btn-success" type="button"><span class="fa  fa-check"></span> Kembali Ke Halaman Sebelumnya</button></a></center>
        </td>
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
	$Result = mysqli_query($koneksi, "insert into aksesoris values('','".$_POST['nama_akse']."','".$_POST['merk']."','".$_POST['tipe']."','".$_POST['no_seri']."','".$_POST['stok']."', '".$_POST['deskripsi']."','".$_POST['harga_satuan']."')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Tambah !');
		window.location='index.php?page=simpan_tambah_aksesoris&id=$_GET[id]';
		</script>";
		}
	}
		?>
  <div id="open_piutang" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Ubah Piutang</h3> 
<script type="text/javascript">
function yesnoCheck() {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('ifYes').style.display = 'block';
    }
    else document.getElementById('ifYes').style.display = 'none';
}
</script>
     <form method="post">
              <label>No PO</label>
              <input name="no_faktur" class="form-control" type="text" placeholder="" disabled="disabled" value="<?php echo $_SESSION['no_faktur']; ?>"><br />
              <label>Tanggal</label>
              <input name="tgl_input" class="form-control" type="date" placeholder="" required="required" value="<?php echo $_SESSION['tgl_jual']; ?>"><br />
              <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="noCheck" style="height:20px; width:20px" checked="checked"><label>Tidak Ada Jatuh Tempo</label><br /><input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="yesCheck" style="height:20px; width:20px"><label>Jatuh Tempo</label>
              <br />
              <div id="ifYes" style="display:none">
              <label>Tanggal Jatuh Tempo</label>
              <input name="jatuh_tempo" type="date" class="form-control" placeholder="" value=""><br />
              </div>
               
              <label>Nominal</label>
              <input name="nominal" class="form-control" type="text" placeholder="" value="<?php echo $total2; ?>" required="required"><br />
              <label>Klien</label>
              <input name="klien" class="form-control" type="text" placeholder="" value="<?php echo $sel['nama_pembeli'];  ?>" required="required"><br />
              <label>Deskripsi</label>
              <textarea name="deskripsi" class="form-control" rows="4" ></textarea>
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
        </form>
              
    </div>
</div>

<?php 
  if (isset($_POST['ubah_qty'])) {
	$Result = mysqli_query($koneksi, "update barang_dijual_qty set qty_jual=".$_POST['qty']." where id=".$_GET['id_ubah']."");
	if ($Result) {
		$jml = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual*harga_jual_saat_itu) as total from barang_dijual_qty where barang_dijual_id=".$_GET['id'].""));
		  mysqli_query($koneksi, "update barang_dijual set total_harga=$jml[total]+($jml[total]*ppn_jual/100)-($jml[total]*diskon_jual/100) where id=".$_GET['id']."");
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Ubah !');
		window.location='index.php?page=ubah_jual_barang_uang&id=$_GET[id]';
		</script>";
		}
	}
		?>
  <div id="openUbah" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Ubah Qty</h3> 
<?php 
$qty = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dijual_qty where id=".$_GET['id_ubah'].""));
?>
     <form method="post">
              <label>Qty</label>
              <input name="qty" class="form-control" type="text" placeholder="" value="<?php echo $qty['qty_jual']; ?>"><br />
              <button name="ubah_qty" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Ubah</button>
        </form>
              
    </div>
</div>


