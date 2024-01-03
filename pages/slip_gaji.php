<?php 
if (isset($_GET['id_hapus'])) {
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from slip_gaji where id=$_GET[id_hapus]"));
	$de2 = mysqli_query($koneksi, "delete from keuangan_detail where keuangan_id=$sel[keuangan_id]");
	$de3 = mysqli_query($koneksi, "delete from keuangan where id=$sel[keuangan_id]");
	$del2 = mysqli_query($koneksi, "delete from slip_gaji where id=".$_GET['id_hapus']."");
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Slip Gaji</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Slip Gaji</li>
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
              <div class="box-body">
              <div class="input-group pull pull-left col-xs-1" style="padding-right:10px">
              <a href="index.php?page=tambah_slip_gaji">
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah</button></a></div>
              
              <!--<form method="post" action="cetak_stok_alkes.php">--><!--<a href="cetak_stok_alkes.php">
              <button name="tambah_laporan" class="btn btn-warning" type="submit"><span class="fa fa-print"></span> Cetak Stok Alkes</button></a>
              <span class="pull pull-right"><font color="#FF0000">Keterangan :</font> Klik Nama Alkes Untuk Melihat Proses Penjualan</span>
              --><br /><br />
              <!--
              <form method="post">
              <div class="input-group pull pull-left col-xs-1">
                
                <select class="form-control" name="limiterr" style="margin-right:40px">
                <option <?php if ($limiter['limiter']==10) {echo "selected";} ?> value="10">10</option>
                <option <?php if ($limiter['limiter']==50) {echo "selected";} ?> value="50">50</option>
                <option <?php if ($limiter['limiter']==100) {echo "selected";} ?> value="100">100</option>
                <option <?php if ($limiter['limiter']==500) {echo "selected";} ?> value="500">500</option>
                <option <?php if ($limiter['limiter']==1000) {echo "selected";} ?> value="1000">1000</option>
                <?php 
				$total=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang"));
				?>
                <option <?php if ($limiter['limiter']==$total) {echo "selected";} ?> <?php if ($_POST['cari']!='') {echo "selected";} ?> value="<?php echo $total; ?>">All</option>
                </select>
                
                <span class="input-group-btn">
                      <button type="submit" name="button_limit" class="btn btn-default btn-flat"><i class="fa fa-check"></i></button>
                    </span>
                
              </div>
              </form>
              
              <form method="post">
              <div class="input-group pull pull-left col-xs-2">
                
                <select class="form-control" name="urutt" style="margin-right:40px">
                <option <?php if ($limiter['urut']=='ASC') {echo "selected";} ?> value="ASC">Ascending</option>
                <option <?php if ($limiter['urut']=='DESC') {echo "selected";} ?> value="DESC">Descending</option>
                
                </select>
                
                <span class="input-group-btn">
                      <button type="submit" name="button_urut" class="btn btn-default btn-flat"><i class="fa fa-check"></i></button>
                    </span>
                
              </div>
              </form>
              
              <form method="post" class="">
              <div class="input-group input-group-md col-xs-4 pull pull-right">
                <input type="text" name="cari" placeholder="Keyword .. (Not ; Stok, Harga, Pengecekan)" class="form-control">
                    <span class="input-group-btn">
                      <button type="submit" name="button_cari" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari </button>
                    </span>
              </div>
              </form>-->
              <br />
              <div class="table-responsive">
              <table width="100%" id="example1" class="table table-bordered table-hover">
                <thead>
    <tr>
      <th width="" align="center" valign="top">No</th>
        <th width="" valign="top">Tanggal</th>
        <th width="" valign="top"><strong>Nama Karyawan</strong></th>
        <th width=""  valign="top">Gaji Kotor</th>
        <th width=""  valign="top">Pengurangan</th>
      <th width="" valign="top"><strong>Gaji Bersih</strong></th>
      <th width="" valign="top">Keterangan</th>
      <td width="" align="center" valign="top"><strong>Aksi</strong></td>
          </tr>
  </thead>
  <?php
 
// membuka file JSON
if (isset($_GET['id_keuangan'])) {
$file = file_get_contents("http://localhost/ALKES/json/slip_gaji.php?id_keuangan=$_GET[id_keuangan]");
} else {
$file = file_get_contents("http://localhost/ALKES/json/slip_gaji.php");
}
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
#C33 
?>

  <tr>
    <td align="center" valign="center"><?php echo $i+1; ?></td>
    <td valign="center"><?php echo date("d M Y",strtotime($json[$i]['tgl_slip']));?></td>
    <td><?php echo $json[$i]['nama_karyawan']; ?></td>
    
    <td>
    <?php echo "Rp ".number_format($json[$i]['gaji_kotor'],2,',','.');  ?></td>
    <td><?php echo "Rp ".number_format($json[$i]['pengurangan'],2,',','.'); ?></td>
    <td><?php echo "Rp ".number_format($json[$i]['gaji_bersih'],2,',','.'); ?></td>
    <td><?php echo $json[$i]['keterangan']; ?></td>
    <td align="center">
      <a href="index.php?page=slip_gaji&id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;&nbsp;
      <a href="index.php?page=ubah_slip_gaji&id_ubah=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp;&nbsp;
      <a href="cetak_slip_gaji.php?id=<?php echo $json[$i]['idd']; ?>" target="_blank"><span data-toggle="tooltip" title="Print" class="fa fa-print"></span></a><br />
      <!--<a href="#" onclick="return confirm('Belum berfungsi')"><small class="label bg-green">Bayar</small></a>-->
    </td>
  </tr>
  <?php } ?>
</table>
              </div>
              <br />

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
      <!-- /.row (main row) -->

  </section>
    <!-- /.content -->
  </div>
  <?php
  $da = mysqli_fetch_array(mysqli_query($koneksi, "select * from slip_gaji where id =$_GET[id_ubah]"));
  if (isset($_POST['ubah_riwayat'])) {
    $query = mysqli_query($koneksi,"UPDATE slip_gaji set tanggal='$_POST[tanggal2]',karyawan_id='$_POST[karyawan_id2]',gaji_kotor='$_POST[gaji_kotor2]',kurang_gaji='$_POST[kurang_gaji2]',iuran='$_POST[iuran2]' where id=$da[id]");
    if ($query) {
        echo "<script type='text/javascript'>
		alert('Perubahan Berhasil Disimpan !');
		window.location='index.php?page=slip_gaji'
		</script>";
    }else{
        echo "<script type='text/javascript'>
		alert('Perubahan Gagal Disimpan !');
		window.location='index.php?page=slip_gaji'
		</script>";
    }
}
  ?>
  <script type="text/javascript">
function sum() {
      var txtFirstNumberValue = document.getElementById('gaji_kotor').value;
      var txtSecondNumberValue = document.getElementById('kurang_gaji').value;
	  var txtThirdNumberValue = document.getElementById('gaji_bersih').value;
	  
      var result = parseFloat(txtFirstNumberValue) - parseFloat(txtSecondNumberValue);
	  if (!isNaN(result)) {
         document.getElementById('gaji_bersih').value = result;
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
  <div id="openUbah" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Ubah Slip Gaji</h3>  
     <form method="post">
              <label>Tanggal</label>
              <input name="tanggal2" class="form-control" type="date" placeholder="" required="required" value="<?php echo $da['tanggal']; ?>"><br />
              <label>Nama Karyawan</label>
              <select name="karyawan_id2" class="form-control">
              <?php 
              $query1 = mysqli_query($koneksi,"SELECT id,nama_karyawan FROM karyawan"); 
              while($row1 = mysqli_fetch_array($query1)){
              ?>
              <option value="<?php echo $row1['id'];?>" <?php if($row1['id'] == $da['id']){echo "selected";}?>><?php echo $row1['nama_karyawan'];?></option>
            <?php }?>
              </select>
              <br />
              <label>Gaji Kotor</label>
                <input type="number" name="gaji_kotor" id="gaji_kotor" class="form-control" value="<?php echo $da['gaji_kotor'];?>" onkeyup="sum();">
                <br />
                <label>Pengurangan</label>
                <input type="number" name="kurang_gaji" id="kurang_gaji" class="form-control" value="<?php echo $da['pengurangan'];?>" onkeyup="sum();">
                <br />
                <label>Gaji Bersih</label>
                <input type="number" name="gaji_bersih" id="gaji_bersih" class="form-control" value="<?php echo $da['gaji_bersih'];?>" readonly="readonly">
                <br />
                <label>Keterangan</label>
              <textarea class="form-control" rows="3" name="keterangan"><?php echo str_replace("<br>","\n",$da['keterangan']);?></textarea><br />
       <button name="ubah_riwayat" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan </button>
        </form>

              
    </div>
</div>

<div id="openBayar" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Bayar Gaji</h3>  
     <form method="post">
              <label>Tanggal</label>
              <input name="tanggal2" class="form-control" type="date" placeholder="" required="required" value="<?php echo $da['tanggal']; ?>"><br />
              <label>Akun</label>
              <select name="karyawan_id2" class="form-control">
              <?php 
              $query1 = mysqli_query($koneksi,"SELECT * FROM buku_kas"); 
              while($row1 = mysqli_fetch_array($query1)){
              ?>
              <option value="<?php echo $row1['id'];?>" <?php if($row1['id'] == $da['id']){echo "selected";}?>><?php echo $row1['nama_akun'];?></option>
            <?php }?>
              </select>
              <br />
                <label>Keterangan</label>
              <textarea class="form-control" rows="3" name="keterangan"><?php echo str_replace("<br>","\n",$da['keterangan']);?></textarea><br />
       <button name="ubah_riwayat" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan </button>
        </form>

              
    </div>
</div>