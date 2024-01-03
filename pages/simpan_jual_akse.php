<?php 
if (isset($_POST['tambah_header'])) {
	
	//$insert_pembeli=mysqli_query($koneksi, "insert into pembeli values('','".$_SESSION['pembeli']."','".$_SESSION['provinsi']."','".$_SESSION['kabupaten']."','".$_SESSION['kecamatan']."','".$_SESSION['kelurahan']."','".$_SESSION['alamat']."','".$_SESSION['kontak_rs']."')");
	
	//$insert_pemakai=mysqli_query($koneksi, "insert into pemakai values('','".$_SESSION['pemakai']."','".$_SESSION['kontak1']."','".$_SESSION['kontak2']."','".$_SESSION['email']."')");
	
	//$pembeli=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_pembeli from pembeli"));
	$id_pembeli=$_SESSION['pembeli'];
	//$pemakai=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_pemakai from pemakai"));
	//$id_pemakai=$pemakai['id_pemakai'];
	//simpan barang dijual
	$total = mysqli_num_rows(mysqli_query($koneksi, "select * from aksesoris_jual_hash"));
	$simpan1=mysqli_query($koneksi, "insert into aksesoris_jual values('','".$_SESSION['tgl_jual']."','".$_SESSION['no_faktur']."','$id_pembeli','".$_SESSION['marketing']."','".$_SESSION['subdis']."','".$_SESSION['diskon']."','".$_SESSION['ppn']."','".str_replace(".","",$_SESSION['biaya_pengiriman'])."','".$_POST['nominal']."')");
	
	$d1=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_jual from aksesoris_jual"));
	$id_jual=$d1['id_jual'];
	//simpan barang pesan detail
	$q2=mysqli_query($koneksi, "select * from aksesoris_jual_hash where akun_id=".$_SESSION['id']."");
	while ($d2 = mysqli_fetch_array($q2)) {
		$sel_hrg_jual=mysqli_fetch_array(mysqli_query($koneksi, "select harga_akse from aksesoris where id=".$d2['aksesoris_id'].""));
		$simpan2=mysqli_query($koneksi, "insert into aksesoris_jual_qty values('','$id_jual','".$d2['aksesoris_id']."','".$sel_hrg_jual['harga_akse']."','".$d2['qty_jual_akse']."','".$d2['diskon_jual_akse']."','')");
		//$up=mysqli_query($koneksi, "update aksesoris_detail set status_terjual_akse=1 where id=".$d2['aksesoris_detail_id']."");
		//$up2=mysqli_query($koneksi, "update aksesoris,aksesoris_detail set stok_total_akse=stok_total_akse-1 where aksesoris.id=aksesoris_detail.aksesoris_id and aksesoris_detail.id=".$d2['aksesoris_detail_id']."");
	}
		if ($simpan1 and $simpan2) {
			$Result = mysqli_query($koneksi, "insert into utang_piutang_aksesoris values('','Piutang','".$_SESSION['no_faktur']."','".$_POST['tgl_input']."','".$_POST['jatuh_tempo']."','".$_POST['nominal']."','".$_POST['klien']."','".$_POST['deskripsi']."','0')");
			mysqli_query($koneksi, "delete from aksesoris_jual_hash where akun_id=".$_SESSION['id']."");
	echo "<script type='text/javascript'>
	alert('Data Berhasil Di Simpan !');	
	window.location='index.php?page=penjualan_aksesoris_uang'</script>";
		}
	}


if (isset($_POST['simpan_tambah_aksesoris'])) {
	$cek_harga = mysqli_fetch_array(mysqli_query($koneksi, "select * from aksesoris where id=".$_POST['id_akse'].""));
	if ($cek_harga['harga_akse']!=0) {
	/*$stok = mysqli_fetch_array(mysqli_query($koneksi, "select stok_total_akse from aksesoris where id=".$_POST['id_akse'].""));
	$stok_po1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual_akse) as stok_po from aksesoris_jual_qty where aksesoris_id=".$_POST['id_akse'].""));
	$stok_po2 = mysqli_num_rows(mysqli_query($koneksi, "select * from aksesoris_kirim_detail,aksesoris_detail,aksesoris_jual_qty where aksesoris_detail.id=aksesoris_kirim_detail.aksesoris_detail_id and aksesoris_jual_qty.id=aksesoris_kirim_detail.aksesoris_jual_qty_id and aksesoris_jual_qty.aksesoris_id=".$_POST['id_akse'].""));
	$go=$stok['stok_total_akse']-($stok_po1['stok_po']-$stok_po2);
	if ($go>=$_POST['qty']) {*/
		$sel_hrg_jual=mysqli_fetch_array(mysqli_query($koneksi, "select harga_akse from aksesoris where id=".$_POST['id_akse'].""));
	$simpan = mysqli_query($koneksi, "insert into aksesoris_jual_hash values('','".$_SESSION['id']."','".$_POST['id_akse']."','".$sel_hrg_jual['harga_akse']."','".$_POST['qty']."','".$_POST['diskon']."')");
	if ($simpan) {
		echo "<script>window.location='index.php?page=simpan_jual_akse'</script>";
		}
	/*}
	else {
		echo "<script>alert('Maaf , Stok Tidak Mencukupi !');
		</script>";
		}*/
	} else {
		echo "<script>alert('Harga jual alat tidak boleh 0 , update harga jual nya terlebih dahulu !');
		</script>";;
		}
}

if (isset($_POST['ubah_harga'])) {
	$up = mysqli_query($koneksi, "update aksesoris set harga_akse='".str_replace(".","",$_POST['nominal'])."' where id=".$_POST['barang_id']."");
	if ($up) {
		echo "<script>
		window.location='index.php?page=simpan_jual_akse';
		alert('Harga Berhasil Di Ubah');
		</script>";
		}
	}

if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from aksesoris_jual_hash where id=".$_GET['id_hapus']."");
	}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Jual Aksesoris</h1><ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Jual Aksesoris</li>
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
      <th valign="bottom"><strong>Tgl Jual</strong></th>
      <th valign="bottom">No PO</th>
      <th valign="bottom">Nama RS/Dinas/Klinik/dll</th>
      <th valign="bottom"><strong>Kelurahan</strong></th>
      <th valign="bottom">Alamat</th>
      <th valign="bottom"><strong>Kontak RS/Dinas/dll</strong></th>
      <th valign="bottom">Diskon</th>
      <th valign="bottom">PPn</th>
      <th valign="bottom">Biaya Pengiriman</th>
      </tr>
  </thead>
  <tr>
    <td><?php echo date("d-m-Y",strtotime($_SESSION['tgl_jual'])); ?>
    </td>
    <td><?php echo $_SESSION['no_faktur']; ?></td>
    <td><?php 
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select nama_pembeli from pembeli where id=".$_SESSION['pembeli'].""));
	echo $sel['nama_pembeli']; ?></td>
    <td><?php echo $_SESSION['kelurahan']; ?></td>
    <td><?php echo $_SESSION['alamat']; ?></td>
    <td><?php echo $_SESSION['kontak_rs']; ?></td>
    <td><?php echo $_SESSION['diskon']."%"; ?></td>
    <td><?php echo $_SESSION['ppn']."%"; ?></td>
    <td><?php echo $_SESSION['biaya_pengiriman']; ?></td>
    </tr>
</table><br />
                <h3 align="left">
                  Tambah Data Aksesoris Yang Akan Dijual
                </h3>
                <!--<font color="#FF0000">* Jika Ingin Menambah Data Aksesoris Yang Baru ! Klik Disini <a href="index.php?page=simpan_tambah_aksesoris&id=<?php //echo $_GET['id']; ?>#openAkse"><small data-toggle="tooltip" title="Tambah Aksesoris Baru" class="label bg-blue">+ New Accessories</small></a></font>-->
                <br />
                <button name="tambah" class="btn btn-success" type="submit" data-toggle="modal" data-target="#modal-tambah"><span class="fa fa-plus"></span> Tambah</button>
                <button class="btn btn-info pull pull-right" data-toggle="modal" data-target="#modal-ubah-harga"><i class="fa fa-edit"></i> Perubahan Harga Jual</button>
                <br />
                <br />
                <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">No</th>
      <th valign="bottom"><strong>Nama Aksesoris</strong></th>
      <td align="center" valign="bottom"><strong>Stok_Gudang - Stok_PO</strong></td>      
      <td align="center" valign="bottom"><strong>Harga Jual</strong><br /><font size="-2" color="#FF0000">Harga tidak boleh 0</font></td>      
      <td align="center" valign="bottom"><strong>Tipe      
      </strong></td>
      <td align="center" valign="bottom"><strong>Merk      
      </strong></td>
      <td align="center" valign="bottom"><strong>Qty</strong></td>
      <td align="center" valign="bottom"><strong>Diskon</strong></td>
      <td align="center" valign="bottom"><strong>Total</strong></td>      
      <td align="center" valign="bottom"><strong>Aksi</strong></td>
     </tr>
  </thead>
  
  
  <?php
   
  $no=0;
  $q_akse = mysqli_query($koneksi, "select *,aksesoris_jual_hash.id as idd from aksesoris_jual_hash,aksesoris where aksesoris.id=aksesoris_jual_hash.aksesoris_id");
  $jm = mysqli_num_rows($q_akse);
  if ($jm!=0) { 
  while ($data_akse = mysqli_fetch_array($q_akse)) {
	  $no++;
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $data_akse['nama_akse']; ?>
    </td>
    <td align="center">&nbsp;</td>
    <td align="center"><?php echo "Rp".number_format($data_akse['harga_jual_saat_itu'],2,',','.'); ?></td>
    <td align="center"><?php echo $data_akse['tipe_akse']; ?></td>
    <td align="center"><?php echo $data_akse['merk_akse']; ?></td>
    <td align="center"><?php echo $data_akse['qty_jual_akse']; ?></td>
    <td align="center"><?php echo $data_akse['diskon_jual_akse']."%"; ?></td>
    <td align="center"><?php echo "Rp".number_format(($data_akse['qty_jual_akse']*$data_akse['harga_akse'])-(($data_akse['qty_jual_akse']*$data_akse['harga_akse'])*$data_akse['diskon_jual_akse']/100),2,',','.'); ?></td>
    <td align="center"><a href="index.php?page=simpan_jual_akse&id_hapus=<?php echo $data_akse['idd']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a></td>
    </tr>
  <?php }} else {
	  echo "<tr><td colspan='10' align='center'>Tidak Ada Data</td></tr>";
	  } ?>
    <tr>
      <td colspan="8" align="right"><strong>Sub Total</strong></td>
      <td align="center">
      <?php 
	$se = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual_akse*harga_akse-((qty_jual_akse*harga_akse)*diskon_jual_akse/100)) as sub_total from aksesoris,aksesoris_jual_hash where aksesoris.id=aksesoris_jual_hash.aksesoris_id and akun_id=".$_SESSION['id'].""));
	$sub_total=$se['sub_total'];
	echo number_format($sub_total,2,',','.');
	?>
      </td>
      <td align="center"></td>
    </tr>
    <tr>
      <td colspan="8" align="right">Diskon (<?php echo $_SESSION['diskon']."%"; ?>)</td>
      <td align="center"><?php 
	  $diskon=$sub_total*$_SESSION['diskon']/100;
	  echo number_format($diskon,2,',','.'); ?></td>
      <td align="center"></td>
    </tr>
    <tr>
      <td colspan="8" align="right">&nbsp;</td>
      <td align="center"><?php echo number_format(($sub_total-$diskon),2,',','.') ?></td>
      <td align="center"></td>
    </tr>
    <tr>
      <td colspan="8" align="right">PPn (<?php echo $_SESSION['ppn']."%"; ?>)</td>
      <td align="center"><?php 
	  $ppn=($sub_total-$diskon)*$_SESSION['ppn']/100;
	  echo number_format($ppn,2,',','.'); ?></td>
      <td align="center"></td>
    </tr>
    <tr>
      <td colspan="8" align="right">Biaya Pengiriman</td>
      <td align="center"><?php 
	  echo number_format(str_replace(".","",$_SESSION['biaya_pengiriman']),2,',','.'); ?></td>
      <td align="center"></td>
    </tr>
    <tr>
      <td colspan="8" align="right"><strong>Total Keseluruhan</strong></td>
      <td align="center"><?php 
	  $total2=$sub_total+$ppn-$diskon;
	  echo "Rp".number_format($total2+(str_replace(".","",$_SESSION['biaya_pengiriman'])),2,',','.'); ?></td>
      <td align="center"></td>
    </tr>
</table>
<center><a href="#" data-toggle="modal" data-target="#modal-piutang"><button name="simpan_barang" class="btn btn-success" type="submit" <?php if ($jm==0) {echo "disabled"; } ?>><span class="fa fa-plus"></span> Simpan</button></a>&nbsp;&nbsp;<a href="index.php?page=penjualan_aksesoris_uang"><button name="batal" class="btn btn-success" type="submit"><span class="fa fa-times-circle"></span> Batal</button></a></center>
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
<div class="modal fade" id="modal-piutang">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              <script type="text/javascript">
function yesnoCheck() {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('ifYes').style.display = 'block';
    }
    else document.getElementById('ifYes').style.display = 'none';
}
</script>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Masukkan Piutang Baru</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
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
              <input name="nominal22" class="form-control" type="text" placeholder="" value="<?php echo number_format($total2+(str_replace(".","",$_SESSION['biaya_pengiriman'])),2,',','.'); ?>" readonly="readonly">
              <input name="nominal" class="form-control" type="hidden" placeholder="" value="<?php echo $total2+(str_replace(".","",$_SESSION['biaya_pengiriman'])) ?>" required="required" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" readonly="readonly"><br />
              <label>Klien</label>
              <input name="klien" class="form-control" type="text" placeholder="" value="<?php echo $sel['nama_pembeli'];  ?>" required="required"><br />
              <label>Deskripsi</label>
              <textarea name="deskripsi" class="form-control" rows="4" ></textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button name="tambah_header" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
  </div>
          <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-tambah">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center"><strong>Tambah Data</strong></h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
              <label>Nama Aksesoris</label>
              <select name="id_akse" id="id_aksepp" class="form-control select2" style="width:100%" autofocus="autofocus" required onchange="changeValuepp(this.value)">
    	<option>...</option>
        <?php 
		$qtt = mysqli_query($koneksi, "select * from aksesoris order by nama_akse ASC");
		$jsArraypp = "var dtBrgpp = new Array();
";
		while ($d = mysqli_fetch_array($qtt)) { ?>
        <option value="<?php echo $d['id']; ?>"><?php echo $d['nama_akse']; ?></option>
        <?php
        $stok_po1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual_akse) as stok_po from aksesoris_jual_qty where aksesoris_id=".$d['id'].""));
	$stok_po2 = mysqli_num_rows(mysqli_query($koneksi, "select * from aksesoris_kirim_detail,aksesoris_detail,aksesoris_jual_qty where aksesoris_detail.id=aksesoris_kirim_detail.aksesoris_detail_id and aksesoris_jual_qty.id=aksesoris_kirim_detail.aksesoris_jual_qty_id and aksesoris_jual_qty.aksesoris_id=".$d['id'].""));
		?>
        <?php 
		$jsArraypp .= "dtBrgpp['" . $d['id'] . "'] = {tipe_akse:'".addslashes($d['tipe_akse'])."',
						merk_akse:'".addslashes($d['merk_akse'])."',
						stok_total:'".addslashes($d['stok_total_akse']-($stok_po1['stok_po']-$stok_po2))."',
						harga:'".addslashes("Rp ".number_format($d['harga_akse'],2,',','.'))."',
						no_akse:'".addslashes($d['nie_akse'])."'
						};";
		} ?>
    </select>
    <br /><br />
    <label>Stok Gudang - Stok PO</label>
    <input id="stok_total" name="stok_total" class="form-control" type="text" placeholder="Stok" disabled="disabled" size="4"/>
    <br />
    <label>Harga Satuan</label>
    <input id="harga" name="harga" class="form-control" type="text" placeholder="Harga" disabled="disabled" size="8"/>
    <br />
    <label>Tipe</label>
    <input id="tipe_akse" name="tipe_akse" class="form-control" type="text" placeholder="Tipe" disabled="disabled" size="12"/>
    <br />
    <label>Merk</label>
    <input id="merk_akse" name="merk_akse" class="form-control" type="text"  placeholder="Merk" disabled="disabled" size="12"/>
    <br />
    <label>Kuantitas</label>
    <input id="" name="qty" class="form-control" type="text" placeholder="Qty" size="3"/>
    <br />
    <label>Diskon</label>
    <input id="" name="diskon" class="form-control" type="text" placeholder="Dalam %" size="3"/>
              </div>
              
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button name="simpan_tambah_aksesoris" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah</button>
              </div>
              <script type="text/javascript">    
	<?php 
	echo $jsArraypp; 
	?>  
	function changeValuepp(id_akse2){  
		document.getElementById('harga').value = dtBrgpp[id_akse2].harga;
		document.getElementById('stok_total').value = dtBrgpp[id_akse2].stok_total;
		document.getElementById('tipe_akse').value = dtBrgpp[id_akse2].tipe_akse; 
		document.getElementById('merk_akse').value = dtBrgpp[id_akse2].merk_akse;
		document.getElementById('no_akse').value = dtBrgpp[id_akse2].no_akse;
		
	};  
</script>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        
        <div class="modal fade" id="modal-ubah-harga">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubah Harga Barang</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
              <label>Nama Barang</label>
              <select name="barang_id" id="barang_id" class="form-control select2" autofocus="autofocus" required onchange="ubahHarga(this.value)" style="width:100%">
    	<option value="">...</option>
        <?php 
		$qq22 = mysqli_query($koneksi, "select * from aksesoris order by nama_akse ASC");
		$jsArray5 = "var dtBrg5 = new Array();
";
		while ($d = mysqli_fetch_array($qq22)) { ?>
        <option value="<?php echo $d['id']; ?>"><?php echo $d['nama_akse']." - ".$d['tipe_akse']; ?></option>
        <?php
		$stok_po1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual_akse) as stok_po from aksesoris_jual_qty where aksesoris_id=".$d['id'].""));
	$stok_po2 = mysqli_num_rows(mysqli_query($koneksi, "select * from aksesoris_kirim_detail,aksesoris_detail,aksesoris_jual_qty where aksesoris_detail.id=aksesoris_kirim_detail.aksesoris_detail_id and aksesoris_jual_qty.id=aksesoris_kirim_detail.aksesoris_jual_qty_id and aksesoris_jual_qty.aksesoris_id=".$d['id'].""));
		 
		$jsArray5 .= "dtBrg5['" . $d['id'] . "'] = {harga:'".addslashes(number_format($d['harga_akse'],0,',','.'))."'
						};";
		} ?>
    </select>
    <br /><br />
    <label>Harga Barang</label>
    <input id="nominal" name="nominal" class="form-control" type="text" placeholder="" value="" required="required" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"><br />
              
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button name="ubah_harga" class="btn btn-info" type="submit"><span class="fa fa-check"></span> Simpan Perubahan</button>
              </div>
              </form>
              <script type="text/javascript">    
	<?php 
	echo $jsArray5; 
	?>  
	function ubahHarga(barang_id){  
		document.getElementById('nominal').value = dtBrg5[barang_id].harga;
	};  
</script>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
