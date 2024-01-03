
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Spare Part Alkes
     / Data Gudang</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Spare Part Alkes</li>
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
              <a href="index.php?page=tambah_aksesoris">
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah Spare Part</button></a>
             
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
                <input type="text" name="cari" placeholder="Keyword....." class="form-control">
                    <span class="input-group-btn">
                      <button type="submit" name="button_cari" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari </button>
                    </span>
              </div>
              </form><br /><br />
              <?php
              if ($_POST['cari']!='') {
                echo "Results  Of  '".$_POST['cari']."'";
			  	}
				?>
                <br />
                <table width="100%" id="example2" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td align="center">&nbsp;</th>
        
        <th valign="top"><strong>Nama Spare Part</strong></th>
      <th valign="top"><strong>Merk</strong></th>
      <th valign="top"><strong>Tipe</strong></th>
      <th valign="top">No Seri</th>
      <th align="center" valign="top"><strong>Deskripsi        
        </strong></th>
        <th align="center" valign="top"><strong>Stok</strong></th>        
        <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator'])) { ?>
        <th align="center" valign="top"><strong>Harga Satuan        
        </strong></th>
        <?php } ?>
        <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator']) or isset($_SESSION['user_admin_gudang']) && isset($_SESSION['pass_admin_gudang'])) { ?>
        <th align="center" valign="top"><strong>Aksi</strong></th>
        <?php } ?>
          </tr>
  </thead>
  <?php
  if (isset($_POST['button_cari'])) {
	  if ($_POST['cari']!='') {
	   $query = mysqli_query($koneksi, "select *,space_part.id as idd from space_part where id!=1 and nama_sp like '%".$_POST['cari']."%' or merk_sp like '%".$_POST['cari']."%' or tipe_sp like '%".$_POST['cari']."%' or no_sp like '%".$_POST['cari']."%' or deskripsi_sp like '%".$_POST['cari']."%' order by id ".$limiter['urut']." LIMIT ".$limiter['limiter'].""); }
	  else {
		$query = mysqli_query($koneksi, "select *,space_part.id as idd from space_part where id!=1 order by id ".$limiter['urut']." LIMIT ".$limiter['limiter']."");  
		  }
	  }
  else {
	  $query = mysqli_query($koneksi, "select *,space_part.id as idd from space_part where id!=1 order by id ".$limiter['urut']." LIMIT ".$limiter['limiter']."");
  }
  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td>
    <?php echo $data['nama_sp']; ?>
  </td>
    
      <td><?php echo $data['merk_sp']; ?></td>
    <td><?php echo $data['tipe_sp']; ?></td>
    <td><?php echo $data['no_sp']; ?></td>
    <?php if ($data['stok_sp']==0) { $color="red"; } else { $color=""; } ?>
    <td align=""><?php echo $data['deskripsi_sp']; ?></td>
    <td align="" style="background-color:<?php echo $color; ?>"><?php echo $data['stok_sp']; ?></td>
    <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator'])) { ?>
    <td align=""><?php echo "Rp ".number_format($data['harga_sp'],0,',','.').",-"; ?></td>
    <?php } ?>
    
    <td align="">
      <form method="post">
      <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator'])) { ?>
        <a href="pages/delete_aksesoris.php?id_hapus=<?php echo $data['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a> &nbsp;<a href="index.php?page=ubah_aksesoris&id=<?php echo $data['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>
        <!-- Tombol Jual -->
        <?php } ?>
          <?php if (isset($_SESSION['user_admin_gudang']) && isset($_SESSION['pass_admin_gudang'])) { ?>
          <a href="index.php?page=ubah_aksesoris&id=<?php echo $data['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>
          <?php } ?>
          <input type="hidden" name="id" value="<?php echo $data['idd']; ?>"/>
          </a>
        </form>
    </td>
    
  </tr>
  <?php } ?>
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
  if (isset($_POST['jual'])) {
	  $jml1 = mysqli_fetch_array(mysqli_query($koneksi, "select * from master_barang where id=".$_GET['id'].""));
	  if ($_POST['qty']<=$jml1['stok']) {
	  $q = mysqli_query($koneksi, "insert into jual_barang values('','".$_GET['id']."','".$_POST['pembeli']."','".$_POST['alamat']."','".$_POST['qty']."','".$_POST['tgl_beli']."','','','','','','','','','','','')");
	  if ($q) {
		  mysqli_query($koneksi, "update master_barang set stok=stok-".$_POST['qty']." where id=".$_GET['id']."");
		  echo "<script type='text/javascript'>
		  window.location='index.php?page=jual_barang&id_lihat_jual=".$_GET['id']."';
		  </script>";
		  }
		//$d = mysqli_fetch_array(mysqli_query($koneksi, "select * from master barang where id=".$_GET['id'].""));
  } else {
  echo "<script type='text/javascript'>
		  alert('Data Stok Kurang !');
		  </script>"; }
  }
		?>
  <div id="openQuantity" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Jual Alkes</h3> 
     <form method="post">
     Tgl Dijual
     <input id="input" type="date" placeholder="" name="tgl_beli" required>
     Pembeli
     <input id="input" type="text" placeholder="Pembeli (RS/Dinas/Puskesmas/Klinik" name="pembeli" required>
     Provinsi
     <select id="input">
     <option>-- Pilih --</option>
	 <?php $q1=mysqli_query($koneksi, "select * from alamat_provinsi order by nama_provinsi ASC"); 
	 while ($row1=mysqli_fetch_array($q1)){
	 ?>
     <option value="<?php echo $row1['id']; ?>"><?php echo $row1['nama_provinsi']; ?></option>
     <?php } ?>
     </select>
     Kabupaten
     <select id="input">
     <option>-- Pilih --</option>
     <?php $q2=mysqli_query($koneksi, "select * from alamat_kabupaten order by nama_kabupaten ASC"); 
	 while ($row2=mysqli_fetch_array($q2)){
	 ?>
     <option value="<?php echo $row2['id']; ?>"><?php echo $row2['nama_kabupaten']; ?></option>
     <?php } ?>
     </select>
     Kecamatan
     <select id="input">
     <option>-- Pilih --</option>
     <?php $q3=mysqli_query($koneksi, "select * from alamat_kecamatan order by nama_kecamatan ASC"); 
	 while ($row3=mysqli_fetch_array($q3)){
	 ?>
     <option value="<?php echo $row3['id']; ?>"><?php echo $row3['nama_kecamatan']; ?></option>
     <?php } ?>
     </select>
     Alamat Jalan
     <input id="input" type="text" placeholder="Jl.Xxx" name="alamat" required>
     Quantity
        <input id="input" type="text" placeholder="Quantity" name="qty" required>
        <button id="buttonn" name="jual" type="submit">Jual Alkes</button>
    </form>
    </div>
</div>

<div id="openPilihan" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <br />
        <a href="index.php?page=jual_barang2&id=<?php echo $_GET['id']; ?>"><button id="buttonn">Data Dinas/RS/Puskesmas/Klinik Baru</button></a>
        <a href="index.php?page=jual_barang3&id=<?php echo $_GET['id']; ?>"><button id="buttonn">Dari Data Dinas/RS/Puskesmas/Klinik<br />Yang Sudah Terinput</button></a>
    </div>
</div>


