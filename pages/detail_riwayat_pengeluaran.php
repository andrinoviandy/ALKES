<?php
if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "update buku_kas set no_akun='".$_POST['no_akun']."',nama_akun='".$_POST['nama_akun']."', tipe_akun='".$_POST['akun_tipe']."', saldo='".$_POST['saldo']."' where id=".$_GET['id']."");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Buku Kas Berhasil Di Ubah !');
		window.location='index.php?page=ubah_buku_kas&id=$_GET[id]'
		</script>";
		}
	}

$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from buku_kas where id=".$_GET['id'].""));
?>

<?php 
if (isset($_GET['id_hapus'])) {
	$s=mysqli_fetch_array(mysqli_query($koneksi, "select saldo from coa_detail where id=".$_GET['id_hapus'].""));
	mysqli_query($koneksi, "update coa set saldo_total=saldo_total-$s[saldo] where id=$_GET[id]");
	$del = mysqli_query($koneksi, "delete from coa_detail where id=".$_GET['id_hapus']."");
	if ($del) {
		echo "<script>
		window.location='index.php?page=ubah_buku_kas&id=$_GET[id]';
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Detail Riwayat</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Buku Kas</li>
        <li class="active">Ubah Buku Kas</li>
        <li class="active">Detail Riwayat</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <a href="index.php?page=riwayat_pengeluaran"><button class="btn btn-success">Kembali</button></a><a href="cetak_detail_riwayat_pengeluaran.php?id_up=<?php echo $_GET['id']; ?>"><button class="btn btn-success pull pull-right"><span class="fa fa-print"></span> &nbsp;Print Excel</button></a>
            <div class="box-header with-border">
              <h3 class="box-title">Detail Hutang/Piutang</h3></div><div class="box-body">
              <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td width="5%" align="center"><strong>-/+</strong></th>
        <th width="10%" valign="top"><strong>Hutang/Piutang</strong></th>
        <th width="10%" valign="top">Klien</th>
      <th width="15%" valign="top"><strong>Deskripsi</strong></th>
      <th width="15%" valign="top">Nominal</th>
      <th width="20%" valign="top"><strong>Pembayaran Terakhir</strong></th>
      <th width="5%" align="center" valign="top">Status</th>
      <!--<th valign="top">NIE</th>
      <th valign="top">No. Bath</th>
      <th valign="top">No. Lot</th>-->      </tr>
  </thead>
  <?php
	  $query = mysqli_query($koneksi, "select *,utang_piutang.nominal as nominal_up,utang_piutang.id as id_up from utang_piutang_bayar,buku_kas,utang_piutang where utang_piutang.id=utang_piutang_bayar.utang_piutang_id and buku_kas.id=utang_piutang_bayar.buku_kas_id and utang_piutang.id=$_GET[id] group by utang_piutang_id order by utang_piutang.tgl_input DESC");

  $no=0;
  while ($data = mysqli_fetch_array($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center"><?php
    if ($data['u_p']=='Hutang') {
		echo "<span class='fa fa-minus'></span>";
		}
	else {
		echo "<span class='fa fa-plus'></span>";
		} ?></td>
    
    <td>
      <?php echo $data['u_p'];;  ?>
    </td>
    <td><?php echo $data['klien']; ?></td>
    
      <td><?php echo $data['deskripsi']; ?></td>
      <td><?php echo "Rp ".number_format($data['nominal_up'],2,',','.'); ?></td>
      <td>
      <?php
      $dd = mysqli_fetch_array(mysqli_query($koneksi, "select * from utang_piutang_bayar where utang_piutang_id=$_GET[id] order by tgl_bayar DESC LIMIT 1"));
	  echo date("d/m/y",strtotime($dd['tgl_bayar']))." : Rp".number_format($dd['nominal'],2,',','.');
	  ?>
      <br />
      <font style="font-size:11px"><?php 
	$ddd = mysqli_fetch_array(mysqli_query($koneksi, "select sum(nominal) as nominal_bayar from utang_piutang_bayar where utang_piutang_id=$data[id_up]"));
	echo "Total Pembayaran : Rp".number_format($ddd['nominal_bayar'],2,',','.'); ?></font></td>
      <td><?php if ($data['status_lunas']==0){echo "Belum Lunas";}else {echo "Sudah Lunas";} ?></td>
    <!--<td></td>
    <td><?php echo $data['no_bath']; ?></td>
    <td><?php echo $data['no_lot']; ?></td>-->
    <?php if ($data['stok_total']==0) { $color="red"; } else { $color=""; } ?>
    </tr>
  <?php } ?>
</table>

              
              </div>
              <div class="box-header with-border">
              <h3 class="box-title"><br />Detail Pembayaran</h3></div>
              <div class="box-body">
              <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th width="15%" valign="top"><strong>Tanggal</strong></th>
        <th width="18%" valign="top">Nominal</th>
      <th width="22%" valign="top"><strong>Deskripsi</strong></th>
      <th width="15%" valign="top"> Akun</th>
      <!--<th valign="top">NIE</th>
      <th valign="top">No. Bath</th>
      <th valign="top">No. Lot</th>-->
      </tr>
  </thead>
  <?php 
  $q2=mysqli_query($koneksi, "select *,utang_piutang_bayar.id as idd from utang_piutang_bayar,buku_kas where buku_kas.id=utang_piutang_bayar.buku_kas_id and utang_piutang_id=$_GET[id]");
  while ($d = mysqli_fetch_array($q2)) {
  ?>
  <tr>
    <td>
      <?php echo date("d M Y",strtotime($d['tgl_bayar']));  ?></td>
    <td><?php echo "Rp ".number_format($d['nominal'],2,',','.'); ?>
    </td>
    
      <td><?php echo $d['deskripsi']; ?></td>
      <td><?php echo $d['nama_akun']; ?></td>
      </tr>
 <?php } ?>
</table>
              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

  </section>
    <!-- /.content -->
  </div>
  
  <?php 
  if (isset($_POST['tambah_detail'])) {
	  $in = mysqli_query($koneksi,"insert into coa_detail values('','".$_GET['id']."','".$_POST['no_akun']."','".$_POST['nama_akun']."','".$_POST['akun_tipe']."','".$_POST['header']."','".$_POST['saldo_detail']."')");
	  if ($in) {
		  mysqli_query($koneksi, "update coa set saldo_total=saldo_total+$_POST[saldo_detail] where id=$_GET[id]");
		  echo "<script>
		  alert('Berhasil di simpan !');
		  window.location='index.php?page=ubah_buku_kas&id=$_GET[id]';
		  </script>";
		  }
	  }
  ?>
  <div id="openTambah" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <center><h3>Tambah Detail</h3></center>
        <br />
        <?php 
		$sel = mysqli_fetch_array(mysqli_query($koneksi, "select max(no_akun)+1 as maks from coa_detail where coa_id=$_GET[id]"));
		?>
        <form method="post">
        	
              <label>No. Akun</label>
              <input name="no_akun" class="form-control" type="text" placeholder="" value=""><br />
              <label>Nama Akun</label>
              <input name="nama_akun" class="form-control" type="text" placeholder="" value=""><br />
              <label>Tipe Akun</label>
              <input name="akun_tipe" class="form-control" type="text" placeholder="" value=""><br />
              <label>Header</label>
              <input name="header" class="form-control" type="text" placeholder="" value="Detail" readonly="readonly"><br />
              <label>Saldo</label>
              <input name="saldo_detail" class="form-control" type="text" placeholder="" value=""><br />
              <input id="buttonn" name="tambah_detail" type="submit" value="Tambah" />
        </form>
    </div>
</div>

<?php 
if (isset($_POST['ubah_detail'])) {
	$se=mysqli_fetch_array(mysqli_query($koneksi, "select * from coa_detail where id=$_GET[id_ubah]"));
	$u = mysqli_query($koneksi, "update coa set saldo_total=saldo_total-$se[saldo] where id=$_GET[id]");
	if ($u) {
	$q = mysqli_query($koneksi, "update coa_detail set no_akun='".$_POST['no_akun']."',nama_akun='".$_POST['nama_akun']."', akun_tipe='".$_POST['akun_tipe']."',saldo='".$_POST['saldo_detail']."' where id=".$_GET['id_ubah']."");
	if ($q) {
		mysqli_query($koneksi, "update coa set saldo_total=saldo_total+$_POST[saldo_detail] where id=$_GET[id]");
		echo "<script>
		alert('Berhasil diubah');
		window.location='index.php?page=ubah_buku_kas&id=$_GET[id]'
		</script>";
		}
	}
	}
?>
<div id="openUbah" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <center><h3>Ubah Detail</h3></center>
        <br />
        <?php 
		$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from coa_detail where id=$_GET[id_ubah]"));
		?>
        <form method="post">
        	
              <label>No. Akun</label>
              <input name="no_akun" class="form-control" type="text" placeholder="" value="<?php echo $sel['no_akun']; ?>"><br />
              <label>Nama Akun</label>
              <input name="nama_akun" class="form-control" type="text" placeholder="" value="<?php echo $sel['nama_akun']; ?>"><br />
              <label>Tipe Akun</label>
              <input name="akun_tipe" class="form-control" type="text" placeholder="" value="<?php echo $sel['akun_tipe']; ?>"><br />
              <label>Header</label>
              <input name="header" class="form-control" type="text" placeholder="" value="Detail" readonly="readonly"><br />
              <label>Saldo</label>
              <input name="saldo_detail" class="form-control" type="text" placeholder="" value="<?php echo $sel['saldo']; ?>"><br />
              <input id="buttonn" name="ubah_detail" type="submit" value="Simpan Perubahan" />
        </form>
    </div>
</div>
  