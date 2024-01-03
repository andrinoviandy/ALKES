<?php 
if (isset($_GET['id_hapus'])) {
    $del2 = mysqli_query($koneksi, "delete from nota_debit where id=".$_GET['id_hapus']."");
    if ($del2) {
        echo "<script type='text/javascript'>
		alert('Data Berhasil Di hapus !');
		window.location='index.php?page=nota_debit'
		</script>";
    }
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Nota Debet</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Nota Debet</li>
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
              <div class="input-group pull pull-left col-xs-1" style="padding-right:10px">
              <a href="index.php?page=tambah_nota_debit">
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
              
              <table width="100%" id="example1" class="table table-bordered table-hover">
                <thead>
    <tr>
      <th valign="top">No</th>
        <th valign="top"><strong>Tanggal</strong></th>
        <th  valign="top">Nama Pemasok</th>
        <th  valign="top">Deskripsi</th>
        <th  valign="top">Pilihan Biaya</th>
        <th  valign="top">Harga</th>
      <th width="16%" align="center" valign="top"><strong>Aksi</strong></th>
          </tr>
  </thead>
  <?php
 
// membuka file JSON
$file = file_get_contents("http://localhost/ALKES/json/nota_debit.php");
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
#C33 
?>

  <tr>
    <td><?php echo $i+1; ?></td>
    <td><?php echo date("d M Y",strtotime($json[$i]['tanggal'])); ?></td>
    <td><?php echo $json[$i]['nama_pemasok'];?></td>
    <td><?php echo $json[$i]['deskripsi'];  ?></td>
    <td><?php echo $json[$i]['nama_biaya'];?></td>
    <td><?php echo $json[$i]['harga'];?></td>
    <td>
      <a href="index.php?page=nota_debit&id_hapus=<?php echo $json[$i]['id']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;&nbsp;
      <a href="index.php?page=nota_debit&id_ubah=<?php echo $json[$i]['id']; ?>#openUbah"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp;&nbsp;
    </td>
  </tr>
  <?php } ?>
</table><br />

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
  $da = mysqli_fetch_array(mysqli_query($koneksi, "select * from nota_debit where id =$_GET[id_ubah]"));
  if (isset($_POST['ubah_riwayat'])) {
    $query = mysqli_query($koneksi,"UPDATE nota_debit set tanggal='$_POST[tanggal2]',pemasok_id='$_POST[pemasok_id2]',deskripsi='$_POST[deskripsi2]',pilihan_biaya_id='$_POST[pilihan_biaya_id2]',harga='$_POST[harga2]' where id=$da[id]");
    if ($query) {
        echo "<script type='text/javascript'>
		alert('Perubahan Berhasil Disimpan !');
		window.location='index.php?page=nota_debit'
		</script>";
    }else{
        echo "<script type='text/javascript'>
		alert('Perubahan Gagal Disimpan !');
		window.location='index.php?page=nota_debit'
		</script>";
    }
}
  ?>
  <div id="openUbah" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Ubah Nota Debit</h3>  
     <form method="post">
              <label>Tanggal</label>
              <input name="tanggal2" class="form-control" type="date" placeholder="" required="required" value="<?php echo $da['tanggal']; ?>"><br />
              <label>Nama Pemasok</label>
              <select name="pemasok_id2" class="form-control">
              <?php
              $query1 = mysqli_query($koneksi,"SELECT * FROM pemasok");
              while ($row1 = mysqli_fetch_array($query1)){?>
              <option value="<?php echo $row1['id'];?>" <?php if ($row1['id'] == $da['pemasok_id']) {echo "selected";}?>><?php echo $row1['nama_pemasok'];?></option>
              <?php }?>
              </select>
              
              <br />
              <label>Deskripsi</label>
              <textarea name="deskripsi2" class="form-control"><?php echo $da['deskripsi'];?></textarea>
                <br />
              <label>Pilihan Biaya</label>
              <select name="pilihan_biaya_id2" class="form-control">
              <?php
              $query2 = mysqli_query($koneksi,"SELECT * FROM pilihan_biaya");
              while ($row2 = mysqli_fetch_array($query2)){?>
              <option value="<?php echo $row2['id'];?>" <?php if ($row2['id'] == $da['pilihan_biaya_id']) {echo "selected";}?>><?php echo $row2['nama_biaya'];?></option>
              <?php }?>
              </select><br>
              <label>Harga</label>
              <input type="number" name="harga2" value="<?php echo $da['harga'];?>" class="form-control">
       <button name="ubah_riwayat" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan </button>
        </form>

              
    </div>
</div>