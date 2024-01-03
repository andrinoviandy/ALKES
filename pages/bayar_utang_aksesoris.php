<?php
$data=mysqli_fetch_array(mysqli_query($koneksi, "select *,utang_piutang_aksesoris.id as idd from utang_piutang_aksesoris where utang_piutang_aksesoris.id=$_GET[id]"));

if (isset($_POST['tambah_header'])) {
	$cek_saldo = mysqli_fetch_array(mysqli_query($koneksi, "select * from buku_kas where id=".$_POST['akun'].""));
	if ($cek_saldo['saldo']<(str_replace(".","",$_POST['nominal']))) {
		echo "<script type='text/javascript'>
		alert('Gagal Disimpan , Saldo Pada Buku Kas Ini Kurang Dari Nominal Yang Di Masukkan ! Silakan Tambah Saldo Atau Gunakan Buku Kas Lain !');
		window.location='index.php?page=bayar_utang_aksesoris&id=$_GET[id]'
		</script>";
		}
	else {
		$simpan1 = mysqli_query($koneksi,"insert into keuangan values('','".$_POST['tgl_input']."','Pembayaran Hutang Aksesoris','".$_POST['deskripsi']."','".str_replace(".","",$_POST['nominal'])."')");
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_max from keuangan"));
	$Result = mysqli_query($koneksi, "insert into utang_piutang_aksesoris_bayar values('','$max[id_max]','Hutang','$_GET[id]','".$_POST['tgl_input']."','".str_replace(".","",$_POST['nominal'])."','".$_POST['deskripsi']."','".$_POST['akun']."')");
	$simpan2 = mysqli_query($koneksi,"insert into keuangan_detail values('','$max[id_max]','2','9','45','db')");
	$simpan3 = mysqli_query($koneksi,"insert into keuangan_detail values('','$max[id_max]','3','31','','cr')");
	if ($Result) {
		$sel = mysqli_fetch_array(mysqli_query($koneksi, "select sum(nominal) as jumlah from utang_piutang_aksesoris_bayar where utang_piutang_aksesoris_id=$_GET[id]"));
		//$up=mysqli_query($koneksi, "update buku_kas set saldo=saldo-".str_replace(".","",$_POST['nominal'])." where id=$_POST[akun]");
		if ($sel['jumlah']>=$data['nominal']) {
			mysqli_query($koneksi, "update utang_piutang_aksesoris,barang_pesan_akse set utang_piutang_aksesoris.status_lunas='1',barang_pesan_akse.status_lunas='1' where barang_pesan_akse.no_po_pesan=utang_piutang_aksesoris.no_faktur_no_po_akse and utang_piutang_aksesoris.id=$_GET[id]");
			
			}
			echo "<script type='text/javascript'>
		alert('Pembayaran Berhasil Disimpan !');
		window.location='index.php?page=bayar_utang_aksesoris&id=$_GET[id]'
		</script>";
		}
	}
}
if (isset($_GET['id_hapus'])) {
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from utang_piutang_aksesoris_bayar where id=$_GET[id_hapus]"));
	$up = mysqli_query($koneksi, "update utang_piutang_aksesoris_bayar,buku_kas,utang_piutang_aksesoris set saldo=saldo+$sel[nominal] where utang_piutang_aksesoris.id=utang_piutang_aksesoris_bayar.utang_piutang_aksesoris_id and buku_kas.id=utang_piutang_aksesoris_bayar.buku_kas_id and utang_piutang_aksesoris_bayar.buku_kas_id=".$sel['buku_kas_id']."");
	$de2 = mysqli_query($koneksi, "delete from keuangan_detail where keuangan_id=$sel[keuangan_id]");
	$de3 = mysqli_query($koneksi, "delete from keuangan where id=$sel[keuangan_id]");
	if ($up) { 
	$de = mysqli_query($koneksi, "delete from utang_piutang_aksesoris_bayar where id=$_GET[id_hapus]");
	if ($de and $de2 and $de3) {
		$c = mysqli_fetch_array(mysqli_query($koneksi, "select sum(nominal) as jumlah from utang_piutang_aksesoris_bayar where utang_piutang_aksesoris_id=$_GET[id]"));
		if ($c['jumlah']<$data['nominal']) {
	$up = mysqli_query($koneksi, "update utang_piutang_aksesoris set status_lunas='0' where id=".$_GET['id']."");
		}
		}
	}
	echo "<script>window.location='index.php?page=bayar_utang_aksesoris&id=$_GET[id]'</script>";
	
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="active">Bayar Hutang</span></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Hutang</li>
        <li class="active">Bayar Hutang</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
      <section class="col-lg-4 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
              <div class="box-body">
              <a href="index.php?page=utang_aksesoris"><button name="tambah_header" class="btn btn-success" type="button"> Kembali Ke Halaman Sebelumnya </button></a>
<center>
  <h3 class="box-title">Pembayaran</h3></center>
<script type="text/javascript">
function yesnoCheck() {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('ifYes').style.display = 'block';
    }
    else document.getElementById('ifYes').style.display = 'none';
}
</script>
              <form method="post">
              <label>Tanggal</label>
              <input name="tgl_input" class="form-control" type="date" placeholder="" required="required" value="<?php echo date('Y-m-d'); ?>"><br />
              <?php 
			  if ($data['jatuh_tempo']==0000-00-00) {
				  $ac ="checked";
				  $n="none";
				  }
				else {
					$ac2 ="checked";
					$n="";
					}
			  ?>
              
              <label>Nominal</label>
              <input name="nominal" class="form-control" type="text" placeholder="" required="required" value="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"><br />
              <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4" required="required"></textarea>
                <br />
              
              <label>Buku Kas</label>
              <select name="akun" id="akun" class="form-control" required>
              <option value="">-- Pilih --</option>
              <?php
              $q = mysqli_query($koneksi, "select * from buku_kas order by no_akun ASC");
			  while ($d=mysqli_fetch_array($q)) {
			  ?>
              <option value="<?php echo $d['id']; ?>"><?php echo $d['no_akun']." | &nbsp;&nbsp;".$d['nama_akun']; ?></option>
              <?php } ?>
              </select><br />
       <button name="tambah_header" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan </button>
        </form>
       
              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        <!-- Left col -->
        <section class="col-lg-8 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Detail Utang</h3></div>
              <div class="box-body">
              <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td width="12%" align="center"><strong>Status</strong>
        </th>
        
        <th width="15%" valign="top">No PO</th>
        <th width="15%" valign="top"><strong>Tanggal</strong></th>
        <th width="10%" valign="top">Klien</th>
      <th width="18%" valign="top"><strong>Deskripsi</strong></th>
      <th width="16%" valign="top">Kategori</th>
      <th width="23%" valign="top">Nominal</th>
      <th width="" valign="top">Detail</th>
      <!--<th valign="top">NIE</th>
      <th valign="top">No. Bath</th>
      <th valign="top">No. Lot</th>-->
      </tr>
  </thead>
  
<?php if ($data['status_lunas']==0){$b="#FF0000";} else {$b="#00CC66";} ?>
  <tr>
    <td style="background-color:<?php echo $b; ?>;"><?php if ($data['status_lunas']==0){echo "Belum Dibayar";} else {echo "Sudah Dibayar";} ?></td>
    <td><?php echo $data['no_faktur_no_po_akse']; ?></td>
    
    <td>
    <?php echo date("d M Y",strtotime($data['tgl_input']));  ?><br />
    <font style="font-size:11px"><?php if($data['jatuh_tempo']!=0000-00-00) { echo "Jatuh Tempo : ".date("d M Y",strtotime($data['jatuh_tempo']));}  ?></font>
  </td>
    <td><?php echo $data['klien']; ?></td>
    
      <td><?php echo $data['deskripsi']; ?></td>
      <td><?php echo $data['nama_kategori']; ?></td>
      <td><?php echo "Rp".number_format($data['nominal'],2,',','.'); ?><br />
    <font style="font-size:11px"><?php 
	$to = mysqli_fetch_array(mysqli_query($koneksi, "select sum(nominal) as jumlah from utang_piutang_aksesoris_bayar where utang_piutang_aksesoris_id=".$_GET['id'].""));
	echo "Sisa Utang : Rp".number_format($data['nominal']-$to['jumlah'],2,',','.'); ?></font></td>
      <td><a href="#" data-toggle="modal" data-target="#modal-detail<?php echo $data['idd']; ?>"><small data-toggle="tooltip" title="Detail Hutang" class="label label-warning"><span class="fa fa-folder-open"></span></small></a></td>
    <!--<td></td>
    <td><?php //echo $data['no_bath']; ?></td>
    <td><?php //echo $data['no_lot']; ?></td>-->
    <?php if ($data['stok_total']==0) { $color="red"; } else { $color=""; } ?>
    </tr>
 
</table>
			<h3 class="box-title" align="center">Riwayat Pembayaran</h3>
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th width="15%" valign="top"><strong>Tanggal</strong></th>
        <th width="18%" valign="top">Nominal</th>
      <th width="22%" valign="top"><strong>Deskripsi</strong></th>
      <th width="15%" valign="top"> Akun</th>
      <th width="9%" valign="top">Aksi</th>
      <!--<th valign="top">NIE</th>
      <th valign="top">No. Bath</th>
      <th valign="top">No. Lot</th>-->
      </tr>
  </thead>
  <?php 
  $q2=mysqli_query($koneksi, "select *,utang_piutang_aksesoris_bayar.id as idd from utang_piutang_aksesoris_bayar,buku_kas where buku_kas.id=utang_piutang_aksesoris_bayar.buku_kas_id and u_p='Hutang' and utang_piutang_aksesoris_id=$_GET[id]");
  while ($d = mysqli_fetch_array($q2)) {
  ?>
  <tr>
    <td>
      <?php echo date("d M Y",strtotime($d['tgl_bayar']));  ?></td>
    <td><?php echo "Rp ".number_format($d['nominal'],2,',','.'); ?>
    </td>
    
      <td><?php echo $d['deskripsi']; ?></td>
      <td><?php echo $d['nama_akun']; ?></td>
      <td><a href="index.php?page=bayar_utang_aksesoris&id_hapus=<?php echo $d['idd']; ?>&id=<?php echo $_GET['id']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Riwayat Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;&nbsp;
        <!--<a href="index.php?page=bayar_utang_aksesoris&id_ubah=<?php echo $d['idd']; ?>&id=<?php echo $_GET['id']; ?>#openUbah"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>--></td>
    </tr>
 <?php } ?>
</table>  
			  <script type="text/javascript">
function yesnoCheck() {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('ifYes').style.display = 'block';
    }
    else document.getElementById('ifYes').style.display = 'none';
}
</script><br /><br />
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
  $da = mysqli_fetch_array(mysqli_query($koneksi, "select *,buku_kas.id as idd from utang_piutang_aksesoris_bayar,buku_kas where buku_kas.id=utang_piutang_aksesoris_bayar.buku_kas_id and utang_piutang_aksesoris_bayar.id=$_GET[id_ubah]"));
  
  if (isset($_POST['ubah_riwayat'])) {
		$up=mysqli_query($koneksi, "update buku_kas set saldo=saldo+$da[nominal] where buku_kas.id=$da[idd]");
		if ($up) {
			$up2=mysqli_query($koneksi, "update buku_kas set saldo=saldo-$_POST[nominal2] where buku_kas.id=$_POST[akun2]");
			
			$up3=mysqli_query($koneksi, "update utang_piutang_aksesoris_bayar set tgl_bayar='".$_POST['tgl_input2']."', nominal='".$_POST['nominal2']."', deskripsi='".$_POST['deskripsi2']."', buku_kas_id=".$_POST['akun2']." where id=$_GET[id_ubah]");
			if ($up3) {
			$sel = mysqli_fetch_array(mysqli_query($koneksi, "select sum(nominal) as jumlah from utang_piutang_aksesoris_bayar where utang_piutang_aksesoris_id=$_GET[id]"));
			if ($sel['jumlah']>=$data['nominal']) {
			mysqli_query($koneksi, "update utang_piutang_aksesoris set status_lunas='1' where id=$_GET[id]");
			} else {
				mysqli_query($koneksi, "update utang_piutang_aksesoris set status_lunas='0' where id=$_GET[id]");
				}
		}
	if ($up and $up2 and $up3) {
	echo "<script type='text/javascript'>
		alert('Perubahan Berhasil Disimpan !');
		window.location='index.php?page=bayar_utang_aksesoris&id=$_GET[id]'
		</script>";
	}
	}
  }
  ?>
  <div id="openUbah" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Ubah Riwayat Pembayaran</h3>
         
     <form method="post">
              <label>Tanggal</label>
              <input name="tgl_input2" class="form-control" type="date" placeholder="" required="required" value="<?php echo $da['tgl_bayar']; ?>"><br />
              <label>Nominal</label>
              <input name="nominal2" class="form-control" type="text" placeholder="" required="required" value="<?php echo $da['nominal']; ?>"><br />
              <label>Deskripsi</label>
                <textarea name="deskripsi2" class="form-control" rows="4" required="required"><?php echo $da['deskripsi']; ?></textarea>
                <br />
              
              <label>Akun</label>
              <select name="akun2" id="akun2" class="form-control" required>
              <option value="">-- Pilih --</option>
              <?php
              $q = mysqli_query($koneksi, "select * from buku_kas order by no_akun ASC");
			  while ($d=mysqli_fetch_array($q)) {
			  ?>
              <option <?php if ($da['idd']==$d['id']) {echo "selected";} ?> value="<?php echo $d['id']; ?>"><?php echo $d['no_akun']." | &nbsp;&nbsp;".$d['nama_akun']; ?></option>
              <?php } ?>
              </select><br />
              
       <button name="ubah_riwayat" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan </button>
        </form>
              
    </div>
</div>
  <script src="jquery-1.10.2.min.js"></script>
        <script src="jquery.chained.min.js"></script>
        <script>
            $("#jenis_akun").chained("#akun");
        	$("#jenis_akun2").chained("#akun2");
        </script>
        
<div class="modal fade" id="modal-detail<?php echo $data['idd']; ?>">
          <div class="modal-header">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Detail Hutang</h4>
              </div>
              <div class="modal-body">
              <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-warning"><!-- /.chat -->
            <div class="box-footer">
              <div class="box-body table-responsive no-padding">
              <div class="">
              <!--<a href="index.php?page=tambah_barang_masuk"><button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah Barang</button></a>-->
              <?php
              $dataa = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_pesan_akse.id as idd from barang_pesan_akse,principle,mata_uang where mata_uang.id=barang_pesan_akse.mata_uang_id and principle.id=barang_pesan_akse.principle_id and no_po_pesan='".$data['no_faktur_no_po_akse']."'"));
			  ?>
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
    <td><?php echo date("d F Y",strtotime($dataa['tgl_po_pesan'])); ?>
    </td>
    <td><?php echo $dataa['no_po_pesan']; ?></td>
    <td><?php echo $dataa['nama_principle']; ?></td>
    <td><?php echo str_replace("\n","<br>",$dataa['alamat_principle']); ?></td>
    <td><?php echo $dataa['ppn']." %"; ?></td>
    <td><?php echo $dataa['cara_pembayaran']; ?></td>
    <td><?php echo str_replace("\n","<br>",$dataa['alamat_pengiriman']); ?></td>
    <td><?php echo $dataa['jalur_pengiriman']; ?></td>
    <td><?php 
	if ($dataa['estimasi_pengiriman']==0000-00-00) {
		echo "-";
		}
	else {
	echo date("d F Y",strtotime($dataa['estimasi_pengiriman']));} ?></td>
    <td><?php echo $dataa['catatan']; ?></td>
    </tr>
</table><br />
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
      
  </thead>
  
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
  $q_akse = mysqli_query($koneksi, "select *,barang_pesan_akse_detail.id as idd,aksesoris.id as id_gudang from barang_pesan_akse_detail,aksesoris,mata_uang where aksesoris.id=barang_pesan_akse_detail.aksesoris_id and mata_uang.id=barang_pesan_akse_detail.mata_uang_id and barang_pesan_akse_detail.barang_pesan_akse_id=$dataa[idd]");
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
    <td align="right"><?php echo $data_akse['simbol']." ".number_format($data_akse['harga_total'],2,',','.'); ?></td>
    <td align="center"><?php echo $data_akse['catatan_spek']; ?></td>
    
    </tr>
  <?php }} ?>
      
    <tr>
    <td colspan="8" align="right" valign="bottom"><strong>Total Price =</strong></td>
    <td align="right">
      <?php
    $total = mysqli_fetch_array(mysqli_query($koneksi, "select *,sum(harga_total) as total from barang_pesan_akse_detail where barang_pesan_akse_id=$dataa[idd]"));
		//$total = mysqli_query($koneksi, "select * from barang_pesan_detail where barang_pesan_id=$id");
		//echo " ".number_format($total_akse2+$total['total'],0,',',',').".00";
        ?>
        <?php echo $dataa['simbol']." ".number_format($total['total'],2,',','.'); ?>
      
    </td>
    <td></td>
    </tr>
    <tr>
    <td colspan="8" align="right" valign="bottom"><strong>Total Price + PPN(<?php echo $dataa['ppn']."%"; ?>) =</strong></td>
    <td align="right">
    <?php echo $dataa['simbol']." ".number_format(($total['total'])+(($total['total'])*floatval($dataa['ppn'])/100),2,',','.'); ?>
    </td>
    <td></td>
    </tr>
    <tr>
    <td colspan="8" align="right" valign="bottom"><strong>Freight Cost by Air to JAKARTA =</strong></td>
    <td align="right" valign="top"><?php 
	if ($dataa['cost_byair']!=0) {
	echo $dataa['simbol']." ".number_format($dataa['cost_byair'],2,',','.');} ?></td>
    <td></td>
    </tr>
    <tr>
    <td height="24" colspan="8" align="right" valign="bottom"><strong>Total Keseluruhan =</strong></td>
    <td align="right" valign="top"><?php echo $dataa['simbol']." ".number_format($dataa['cost_cf'],2,',','.'); ?></td>
    <td></td>
    </tr>
    <tr>
      <td height="24" colspan="8" align="right" valign="bottom">Nilai Tukar (satuan dalam rupiah) =</td>
      <td align="right" valign="top"><?php echo $dataa['simbol']." ".number_format($q_uang['dalam_rupiah'],2,',','.'); ?></td>
      <td></td>
    </tr>
    <tr>
      <td height="24" colspan="8" align="right" valign="bottom"><strong>Total Keseluruhan</strong> (Rupiah) =</td>
      <td align="right" valign="top"><?php
      $mu= mysqli_fetch_array(mysqli_query($koneksi, " select * from utang_piutang_aksesoris where no_faktur_no_po_akse='".$dataa['no_po_pesan']."'"));
	  if ($mu['nominal']!=0) {
		  $total_rupiah=$mu['nominal'];
		  }
	  ?>
      <?php echo $dataa['simbol']." ".number_format($total_rupiah,2,',','.'); ?>
      </td>
      <td></td>
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
        
        <!-- right col -->
      </div>
              </div>
              <div class="modal-footer">
                <center><button type="button" class="btn btn-warning" data-dismiss="modal">Close</button></center>
                
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>