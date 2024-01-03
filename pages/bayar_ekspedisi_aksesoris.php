<?php
$data=mysqli_fetch_array(mysqli_query($koneksi, "select *,aksesoris_kirim.id as idd from aksesoris_kirim where id=$_GET[id]"));

if (isset($_POST['tambah_header'])) {
	$cek_saldo = mysqli_fetch_array(mysqli_query($koneksi, "select * from buku_kas where id=".$_POST['akun'].""));
	if ($cek_saldo['saldo']<$_POST['nominal']) {
		echo "<script type='text/javascript'>
		alert('Gagal Disimpan , Saldo Pada Buku Kas Ini Kurang Dari Nominal Yang Di Masukkan ! Silakan Tambah Saldo Atau Gunakan Buku Kas Lain !');
		history.back();
		</script>";
		}
	else {
		$simpan_keuangan = mysqli_query($koneksi,"insert into keuangan values('','".$_POST['tgl_input']."','Biaya Ekspedisi Aksesoris','".$_POST['deskripsi']."','".$_POST['nominal']."')");
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_max from keuangan"));
	$simpan_keuangan_detail1 = mysqli_query($koneksi,"insert into keuangan_detail values('','$max[id_max]','5','28','96','cr')");
	$simpan_keuangan_detail3 = mysqli_query($koneksi,"insert into keuangan_detail values('','$max[id_max]','3','32','','cr')");
	
	$Result = mysqli_query($koneksi, "insert into bayar_ekspedisi_aksesoris values('','$max[id_max]','$_GET[id]','".$_POST['tgl_input']."','".$_POST['nominal']."','".$_POST['deskripsi']."','".$_POST['akun']."')");
	if ($Result) {
		$up=mysqli_query($koneksi, "update buku_kas set saldo=saldo-$_POST[nominal] where id=$_POST[akun]");
			echo "<script type='text/javascript'>
		alert('Pembayaran Berhasil Disimpan !');
		history.back();</script>";
		}
	}
}
if (isset($_GET['id_hapus'])) {
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from bayar_ekspedisi_aksesoris where id=$_GET[id_hapus]"));
	$up = mysqli_query($koneksi, "update bayar_ekspedisi_aksesoris,buku_kas set saldo=saldo+$sel[nominal] where buku_kas.id=bayar_ekspedisi_aksesoris.buku_kas_id and bayar_ekspedisi_aksesoris.buku_kas_id=".$sel['buku_kas_id']."");
	if ($up) { 
	$de1 = mysqli_query($koneksi, "delete from keuangan_detail where keuangan_id=$sel[keuangan_id]");
	$de2 = mysqli_query($koneksi, "delete from keuangan where id=$sel[keuangan_id]");
	$de = mysqli_query($koneksi, "delete from bayar_ekspedisi_aksesoris where id=$_GET[id_hapus]");
	}
	echo "<script>history.back();</script>";
	
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="active">Bayar Biaya Ekspedisi Aksesoris</span></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Hutang</li>
        <li class="active">Bayar Ekspedisi Inventory</li>
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
              <a href="index.php?page=utang_ekspedisi_aksesoris"><button name="tambah_header" class="btn btn-success" type="button"> Kembali Ke Halaman Sebelumnya </button></a>
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
              <input name="nominal" class="form-control" type="text" placeholder="" required="required" value=""><br />
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
              <h3 class="box-title">Detail Hutang</h3></div>
              <div class="box-body">
              <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td width="" align="center"><strong>Status</strong>
        </th>
        
        <th width="" valign="top">No PO</th>
        <th width="" valign="top"><strong>Tgl Kirim</strong></th>
        <th width="" valign="top">Nama Paket </th>
      <th width="" valign="top"><strong>Ekspedisi</strong></th>
      <th width="" valign="top"><strong>Via Pengiriman</strong></th>
      <th width="" valign="top">Biaya Pengiriman</th>
      <!--<th valign="top">NIE</th>
      <th valign="top">No. Bath</th>
      <th valign="top">No. Lot</th>-->
      </tr>
  </thead>
  <tr>
  <?php
    $jumlah_bayar = mysqli_fetch_array(mysqli_query($koneksi, "select sum(nominal) as total from bayar_ekspedisi_aksesoris where aksesoris_kirim_id=$_GET[id]"));
	if ($jumlah_bayar['total']>=$data['biaya_pengiriman']) {
		$bg="#00FF00";
		$status="Sudah Lunas Dibayar";
		}
	else {
		$bg="#FF0000";
		$status="Belum Lunas Dibayar";
		}
	?>
    <td bgcolor="<?php echo $bg; ?>"><?php
    echo $status;
	?></td>
    <td><?php echo $data['po_no_akse']; ?></td>
    
    <td>
    <?php echo date("d M Y",strtotime($data['tgl_kirim_akse']));  ?>
  </td>
    <td><?php echo $data['nama_paket_akse']; ?></td>
    
      <td><?php echo $data['ekspedisi']; ?></td>
      <td><?php echo $data['via_pengiriman']; ?></td>
      <td><?php echo "Rp ".number_format($data['biaya_pengiriman'],2,',','.'); ?><br />
    <font style="font-size:11px"><?php 
	echo "Sisa Utang : Rp ".number_format($data['biaya_pengiriman']-$jumlah_bayar['total'],2,',','.'); ?></font></td>
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
  $q2=mysqli_query($koneksi, "select *,bayar_ekspedisi_aksesoris.id as idd from bayar_ekspedisi_aksesoris,buku_kas where buku_kas.id=bayar_ekspedisi_aksesoris.buku_kas_id and aksesoris_kirim_id=$_GET[id]");
  while ($d = mysqli_fetch_array($q2)) {
  ?>
  <tr>
    <td>
      <?php echo date("d M Y",strtotime($d['tgl_bayar']));  ?></td>
    <td><?php echo "Rp ".number_format($d['nominal'],2,',','.'); ?>
    </td>
    
      <td><?php echo $d['deskripsi']; ?></td>
      <td><?php echo $d['nama_akun']; ?></td>
      <td><a href="index.php?page=bayar_ekspedisi_aksesoris&id_hapus=<?php echo $d['idd']; ?>&id=<?php echo $_GET['id']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Riwayat Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a></td>
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
  
  <script src="jquery-1.10.2.min.js"></script>
        <script src="jquery.chained.min.js"></script>
        <script>
            $("#jenis_akun").chained("#akun");
        	$("#jenis_akun2").chained("#akun2");
        </script>