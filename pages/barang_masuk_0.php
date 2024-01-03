
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Alkes
     Masuk / Data Gudang</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Alkes</li>
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
              
              <a href="index.php?page=tambah_barang_masuk">
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah Alkes</button></a>
              <span class="pull pull-right"><font color="#FF0000">Keterangan :</font> Klik Nama Alkes Untuk Melihat Proses Penjualan</span>
              <br /><br />
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
              </form>
              <br /><br />
              
              <?php
              if ($_POST['cari']!='') {
                echo "Results  Of  '".$_POST['cari']."'";
			  	}
				?>
                <table width="100%" id="example2" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td align="center">&nbsp;</th>
        <th valign="top"><strong>Nama Alkes</strong></th>
        <th valign="top">NIE</th>
      <th valign="top"><strong>Merk</strong></th>
      <th valign="top"><strong>Tipe</strong></th>
      <!--<th valign="top">NIE</th>
      <th valign="top">No. Bath</th>
      <th valign="top">No. Lot</th>-->
      <th valign="top"><strong>Negara Asal</strong></th>
      <th align="center" valign="top"><strong>Stok    
        
        </strong></th>
        <th align="center" valign="top"><strong>Deskripsi Alat        
        </strong></th>
        <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator'])) { ?>
        <th align="center" valign="top"><strong>Harga Beli        
        </strong></th>
        <th align="center" valign="top"><strong>Harga Jual        
        </strong></th>
        <?php } ?>
        <th align="center" valign="top"><strong>Pengecekan Teknisi</strong>        </th>
        <th align="center" valign="top"><strong>Aksi</strong></th>
          </tr>
  </thead>
  <?php
  if (isset($_POST['button_cari'])) {
	  if ($_POST['cari']!='') {
	  $query = mysqli_query($koneksi, "select *,barang_gudang.id as idd from barang_gudang where nama_brg like '%".$_POST['cari']."%' or merk_brg like '%".$_POST['cari']."%' or tipe_brg like '%".$_POST['cari']."%' or nie_brg like '%".$_POST['cari']."%' or negara_asal like '%".$_POST['cari']."%' or deskripsi_alat like '%".$_POST['cari']."%' order by barang_gudang.id ".$limiter['urut'].""); }
	  else {
		$query = mysqli_query($koneksi, "select *,barang_gudang.id as idd from barang_gudang order by id ".$limiter['urut']." LIMIT ".$limiter['limiter']."");  
		  }
	  }
  else {
	  $query = mysqli_query($koneksi, "select *,barang_gudang.id as idd from barang_gudang order by id ".$limiter['urut']." LIMIT ".$limiter['limiter']."");
  }
  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    
    <td>
    <?php $jml=mysqli_num_rows(mysqli_query($koneksi, "select barang_gudang_detail_id from barang_dijual,barang_gudang,barang_gudang_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual.barang_gudang_detail_id and barang_gudang_id=".$data['idd'].""));
	if ($jml!=0) {
	?>
    <a href="index.php?page=jual_barang&id_lihat_jual=<?php echo $data['idd']; ?>" data-toggle="tooltip" title="Lihat Proses Penjualan"><?php echo $data['nama_brg']; ?></a>
    <span class="label label-primary pull-right"><?php echo $jml; ?></span>
    <?php } else { echo $data['nama_brg']; } ?>
  </td>
    <td><?php echo $data['nie_brg']; ?></td>
    
      <td><?php echo $data['merk_brg']; ?></td>
    <td><?php echo $data['tipe_brg']; ?></td>
    <!--<td><?php echo $data['nie_brg']; ?></td>
    <td><?php echo $data['no_bath']; ?></td>
    <td><?php echo $data['no_lot']; ?></td>-->
    <td><?php echo $data['negara_asal']; ?></td>
    <?php if ($data['stok_total']==0) { $color="red"; } else { $color=""; } ?>
    <td align="center" style="background-color:<?php echo $color; ?>"><?php echo $data['stok_total']; ?></td>
    <td align="center"><?php echo $data['deskripsi_alat']; ?></td>
    <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator'])) { ?>
    <td align="center"><?php echo "Rp ".number_format($data['harga_beli'],0,',','.').",-"; ?></td>
    <td align="center"><?php echo "Rp ".number_format($data['harga_satuan'],0,',','.').",-"; ?></td>
    <?php } ?>
    <td align="center"><?php if ($data['status_cek']==0) {
		echo "<img src='img/x.png' width='14'/>";
		} else {
			echo "<img src='img/y.png' width='14'/>";
			} ?></td>
    <td align="center">
    <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator'])) { ?>
    <a href="index.php?page=simpan_tambah_aksesoris&id=<?php echo $data['idd']; ?>"><small data-toggle="tooltip" title="Kelola Aksesoris" class="label bg-green"><span class="fa fa-cogs"></span>&nbsp; Akse</small></a>&nbsp;<a href="index.php?page=simpan_tambah_spesifikasi&id=<?php echo $data['idd']; ?>"><small data-toggle="tooltip" title="Kelola Spesifikasi" class="label bg-blue"><span class="fa fa-cogs"></span>&nbsp; Spes</small></a>&nbsp;<a href="cetak_rekapan_alkes.php?id=<?php echo $data['idd']; ?>"><small data-toggle="tooltip" title="Rekap Alkes" class="label bg-yellow">Excel</small></a><br />
    <a href="pages/delete_barang_masuk.php?id_hapus=<?php echo $data['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a> &nbsp;<a href="index.php?page=ubah_barang_masuk&id=<?php echo $data['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>
      <?php } ?>
<?php if (isset($_SESSION['user_admin_gudang']) && isset($_SESSION['pass_admin_gudang'])) { ?>
<a href="index.php?page=simpan_tambah_aksesoris&id=<?php echo $data['idd']; ?>"><small data-toggle="tooltip" title="Kelola Aksesoris" class="label bg-green"><span class="fa fa-cogs"></span>&nbsp; Akse</small></a>&nbsp;<a href="index.php?page=simpan_tambah_spesifikasi&id=<?php echo $data['idd']; ?>"><small data-toggle="tooltip" title="Kelola Spesifikasi" class="label bg-blue"><span class="fa fa-cogs"></span>&nbsp; Spes</small></a>&nbsp;<a href="cetak_rekapan_alkes.php?id=<?php echo $data['idd']; ?>"><small data-toggle="tooltip" title="Rekap Alkes" class="label bg-yellow">Excel</small></a><br />
<a href="index.php?page=ubah_barang_masuk&id=<?php echo $data['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>
<?php } ?>
      <!-- Tombol Jual -->
	  
	  <?php /* if ($data['stok_total']!=0 and $data['status_cek']!=0) { ?>
      &nbsp;<a href="index.php?page=barang_masuk&id=<?php echo $data['idd']; ?>#openPilihan"><small data-toggle="tooltip" title="Jual Alkes" class="label bg-blue">Jual</small></a>
      <!--&nbsp;<a href="index.php?page=jual_barang2&id=<?php //echo $data['idd']; ?>"><small data-toggle="tooltip" title="Jual Alkes" class="label bg-blue">Jual</small>-->
      <?php } */ ?>
      
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
 

<div id="openPilihan" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <br />
        <a href="index.php?page=jual_barang2&id=<?php echo $_GET['id']; ?>"><button id="buttonn">Data Dinas/RS/Puskesmas/Klinik Baru</button></a>
        <a href="index.php?page=jual_barang3&id=<?php echo $_GET['id']; ?>"><button id="buttonn">Dari Data Dinas/RS/Puskesmas/Klinik<br />Yang Sudah Terinput</button></a>
    </div>
</div>


