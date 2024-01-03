<?php 
$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from aksesoris_jual where id=".$_GET['id'].""));
if (isset($_POST['tambah_header'])) {
	
	//$insert_pembeli=mysqli_query($koneksi, "insert into pembeli values('','".$_SESSION['pembeli']."','".$_SESSION['provinsi']."','".$_SESSION['kabupaten']."','".$_SESSION['kecamatan']."','".$_SESSION['kelurahan']."','".$_SESSION['alamat']."','".$_SESSION['kontak_rs']."')");
	
	//$insert_pemakai=mysqli_query($koneksi, "insert into pemakai values('','".$_SESSION['pemakai']."','".$_SESSION['kontak1']."','".$_SESSION['kontak2']."','".$_SESSION['email']."')");
	
	//$pembeli=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_pembeli from pembeli"));
	$id_pembeli=$_SESSION['pembeli'];
	//$pemakai=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_pemakai from pemakai"));
	//$id_pemakai=$pemakai['id_pemakai'];
	//simpan barang dijual
	$total = mysqli_num_rows(mysqli_query($koneksi, "select * from aksesoris_jual_hash"));
	$simpan1=mysqli_query($koneksi, "insert into aksesoris_jual values('','".$_SESSION['tgl_jual']."','".$_SESSION['no_faktur']."','$id_pembeli','".$_SESSION['marketing']."','".$_SESSION['subdis']."','".$_SESSION['diskon']."','".$_SESSION['ppn']."','".$_POST['nominal']."')");
	
	$d1=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_jual from aksesoris_jual"));
	$id_jual=$d1['id_jual'];
	//simpan barang pesan detail
	$q2=mysqli_query($koneksi, "select * from aksesoris_jual_hash where akun_id=".$_SESSION['id']."");
	while ($d2 = mysqli_fetch_array($q2)) {
		$simpan2=mysqli_query($koneksi, "insert into aksesoris_jual_qty values('','$id_jual','".$d2['aksesoris_id']."','".$d2['harga_jual_saat_itu']."','".$d2['qty_jual_akse']."','')");
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

if (isset($_POST['ubah_harga'])) {
	$up = mysqli_query($koneksi, "update aksesoris set harga_akse='".str_replace(".","",$_POST['nominal'])."' where id=".$_POST['barang_id']."");
	if ($up) {
		echo "<script>
		window.location='index.php?page=ubah_jual_akse_uang&id=$_GET[id]';
		alert('Harga Berhasil Di Ubah');
		</script>";
		}
	}

if (isset($_POST['simpan_tambah_aksesoris'])) {
	$cek_harga = mysqli_fetch_array(mysqli_query($koneksi, "select * from aksesoris where id=".$_POST['id_akse'].""));
	if ($cek_harga['harga_akse']!=0) {
	$stok = mysqli_fetch_array(mysqli_query($koneksi, "select stok_total_akse from aksesoris where id=".$_POST['id_akse'].""));
	$stok_po1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual_akse) as stok_po from aksesoris_jual_qty where aksesoris_id=".$_POST['id_akse'].""));
	$stok_po2 = mysqli_num_rows(mysqli_query($koneksi, "select * from aksesoris_kirim_detail,aksesoris_detail,aksesoris_jual_qty where aksesoris_detail.id=aksesoris_kirim_detail.aksesoris_detail_id and aksesoris_jual_qty.id=aksesoris_kirim_detail.aksesoris_jual_qty_id and aksesoris_jual_qty.aksesoris_id=".$_POST['id_akse'].""));
	$go=$stok['stok_total_akse']-($stok_po1['stok_po']-$stok_po2);
	if ($go>=$_POST['qty']) {
		$sel_hrg_jual=mysqli_fetch_array(mysqli_query($koneksi, "select harga_akse from aksesoris where id=".$_POST['id_akse'].""));
	$simpan = mysqli_query($koneksi, "insert into aksesoris_jual_qty values('','".$_GET['id']."','".$_POST['id_akse']."','".$sel_hrg_jual['harga_akse']."','".$_POST['qty']."','".$_POST['diskon']."','')");
	if ($simpan) {
		$jml = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual_akse*harga_jual_saat_itu-((qty_jual_akse*harga_jual_saat_itu)*diskon_jual_akse/100)) as total from aksesoris_jual_qty where aksesoris_jual_id=".$_GET['id'].""));
		  mysqli_query($koneksi, "update aksesoris_jual set total_harga=".($jml['total']-($jml['total']*$data['diskon_akse']/100)+(($jml['total']-($jml['total']*$data['diskon_akse']/100))*$data['ppn_akse']/100))+$data['biaya_kirim']." where id=".$_GET['id']."");
		  $update_piutang = mysqli_query($koneksi, "update utang_piutang_aksesoris set nominal=".($jml['total']-($jml['total']*$data['diskon_akse']/100)+(($jml['total']-($jml['total']*$data['diskon_akse']/100))*$data['ppn_akse']/100))+$data['biaya_kirim']." where no_faktur_no_po_akse='".$data['no_po_jual_akse']."'");
		echo "<script>window.location='index.php?page=ubah_jual_akse_uang&id=$_GET[id]'</script>";
		}
	}
	else {
		echo "<script>alert('Maaf , Stok Tidak Mencukupi !');
		</script>";
		}
	} else {
		echo "<script>alert('Harga jual alat tidak boleh 0 , update harga jual nya terlebih dahulu !');
		</script>";
		}
}
	
if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from aksesoris_jual_qty where id=".$_GET['id_hapus']."");
	$jml = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual_akse*harga_jual_saat_itu-((qty_jual_akse*harga_jual_saat_itu)*diskon_jual_akse/100)) as total from aksesoris_jual_qty where aksesoris_jual_id=".$_GET['id'].""));
		  mysqli_query($koneksi, "update aksesoris_jual set total_harga=".($jml['total']-($jml['total']*$data['diskon_akse']/100)+(($jml['total']-($jml['total']*$data['diskon_akse']/100))*$data['ppn_akse']/100))+$data['biaya_kirim']." where id=".$_GET['id']."");
		  $update_piutang = mysqli_query($koneksi, "update utang_piutang_aksesoris set nominal=".($jml['total']-($jml['total']*$data['diskon_akse']/100)+(($jml['total']-($jml['total']*$data['diskon_akse']/100))*$data['ppn_akse']/100))+$data['biaya_kirim']." where no_faktur_no_po_akse='".$data['no_po_jual_akse']."'");
	}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Ubah Data Jual Aksesoris</h1><ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Ubah Data Jual Aksesoris</li>
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
    <td><?php echo date("d-m-Y",strtotime($data['tgl_jual_akse'])); ?>
    </td>
    <td><?php echo $data['no_po_jual_akse']; ?></td>
    <td><?php 
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from pembeli where id=".$data['pembeli_id'].""));
	echo $sel['nama_pembeli']; ?></td>
    <td><?php echo $sel['kelurahan_id']; ?></td>
    <td><?php echo $sel['jalan']; ?></td>
    <td><?php echo $sel['kontak_rs']; ?></td>
    <td><?php echo $data['diskon_akse']."%"; ?></td>
    <td><?php echo $data['ppn_akse']."%"; ?></td>
    <td><?php echo number_format($data['biaya_kirim'],0,',','.'); ?></td>
    </tr>
</table><br />
                <h3 align="left">
                  Data Aksesoris Yang  Dijual
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
      <td align="center" valign="bottom"><strong>Harga Jual      
      </strong>
      <td align="center" valign="bottom"><strong>Tipe      
      </strong>
      <td align="center" valign="bottom"><strong>Merk      
      </strong>
      <td align="center" valign="bottom"><strong>Qty</strong>
      <td align="center" valign="bottom"><strong>Diskon</strong>      
      <td align="center" valign="bottom"><strong>Total</strong>      
      <td align="center" valign="bottom"><strong>Aksi</strong></tr>
  </thead>
  
  
  <?php
   
  $no=0;
  $q_akse = mysqli_query($koneksi, "select *,aksesoris_jual_qty.id as idd from aksesoris_jual_qty,aksesoris where aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual_id=".$_GET['id']."");
  $jm = mysqli_num_rows($q_akse);
  if ($jm!=0) { 
  while ($data_akse = mysqli_fetch_array($q_akse)) {
	  $no++;
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $data_akse['nama_akse']; ?>
    </td>
    <td align="center"><?php echo "Rp".number_format($data_akse['harga_jual_saat_itu'],2,',','.'); ?></td>
    <td align="center"><?php echo $data_akse['tipe_akse']; ?></td>
    <td align="center"><?php echo $data_akse['merk_akse']; ?></td>
    <td align="center"><?php echo $data_akse['qty_jual_akse']; ?></td>
    <td align="center"><?php echo $data_akse['diskon_jual_akse']."%"; ?></td>
    <td align="center"><?php echo "Rp".number_format($data_akse['qty_jual_akse']*$data_akse['harga_jual_saat_itu']-(($data_akse['qty_jual_akse']*$data_akse['harga_jual_saat_itu'])*$data_akse['diskon_jual_akse']/100),2,',','.'); ?></td>
    <td align="center"><a href="index.php?page=ubah_jual_akse_uang&id_hapus=<?php echo $data_akse['idd']; ?>&id=<?php echo $_GET['id']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a></td>
    </tr>
  <?php }} else {
	  echo "<tr><td colspan='9' align='center'>Tidak Ada Data</td></tr>";
	  } ?>
    <tr>
      <td colspan="7" align="right"><strong>Sub Total</strong></td>
      <td align="center">
        <?php 
	$se = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual_akse*harga_jual_saat_itu-((qty_jual_akse*harga_jual_saat_itu)*diskon_jual_akse/100)) as sub_total from aksesoris,aksesoris_jual_qty where aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual_id=".$_GET['id'].""));
	$sub_total=$se['sub_total'];
	echo number_format($sub_total,2,',','.');
	?>
      </td>
      <td align="center"></td>
    </tr>
    <tr>
      <td colspan="7" align="right">Diskon (<?php echo $data['diskon_akse']."%"; ?>)</td>
      <td align="center"><?php 
	  $diskon=$sub_total*$data['diskon_akse']/100;
	  echo number_format($diskon,2,',','.'); ?></td>
      <td align="center"></td>
    </tr>
    <tr>
      <td colspan="7" align="right">&nbsp;</td>
      <td align="center"><?php echo number_format(($sub_total-$diskon),2,',','.') ?></td>
      <td align="center"></td>
    </tr>
    <tr>
      <td colspan="7" align="right">PPn (<?php echo $data['ppn_akse']."%"; ?>)</td>
      <td align="center"><?php 
	  $ppn=($sub_total-$diskon)*$data['ppn_akse']/100;
	  echo number_format($ppn,2,',','.'); ?></td>
      <td align="center"></td>
    </tr>
    <tr>
      <td colspan="7" align="right">Biaya Pengiriman</td>
      <td align="center"><?php echo number_format($data['biaya_kirim'],2,',','.'); ?></td>
      <td align="center"></td>
    </tr>
    <tr>
    <td colspan="7" align="right"><strong>Total Keseluruhan</strong></td>
    <td align="center"><?php 
	  $total2=$sub_total+$ppn-$diskon;
	  echo "Rp".number_format($total2+$data['biaya_kirim'],2,',','.'); ?></td>
    <td align="center"></td>
    </tr>
</table>
<center><a href="index.php?page=penjualan_aksesoris_uang"><button name="batal" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Kembali ke halaman sebelumnya</button></a></center>
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