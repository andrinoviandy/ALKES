
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Daftar akun (C0A)</h1>
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
              
             
              <!--
              <form method="post">
              <div class="input-group pull pull-left col-xs-1">
                
                <select class="form-control" name="limiterr" style="margin-right:40px">
                <option <?php if ($limiter['limiter']==10) {echo "selected";} ?> value="10">10</option>
                <option <?php if ($limiter['limiter']==50) {echo "selected";} ?> value="50">50</option>
                <option <?php if ($limiter['limiter']==100) {echo "selected";} ?> value="100">100</option>
                <option <?php if ($limiter['limiter']==500) {echo "selected";} ?> value="500">500</option>
                <option <?php if ($limiter['limiter']==1000) {echo "selected";} ?> value="1000">1000</option>
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
              <?php 
                if (isset($_GET['id_hapus'])) {
                    $query = mysqli_query($koneksi,"delete from daftar_akun where id=$_GET[id_hapus]") or die();
                    echo "<script type='text/javascript'>
                    alert('Data Berhasil Di Hapus !');
                    window.location='index.php?page=daftar_akun'
                    </script>";
                }
              ?>
              <a href="index.php?page=tambah_daftar_akun" class='btn btn-success'>Buat</a>
              <br>
              <br>             
              
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th align="center">#</th>
      <th align="top">No Akun</th>
        <th align="top">Nama</th>
        <th align="top">Tipe</th>
        <th align="top">Saldo</th>
      <th align="center" valign="top"><strong>Aksi</strong></th>
          </tr>
  </thead>
  <?php
  
	  $query = mysqli_query($koneksi, "select * from daftar_akun inner join tipe_akun on daftar_akun.tipe=tipe_akun.id");
  
  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td><?php echo $data['no_akun']; ?></td>
    <td><?php echo $data['nama']; ?></td>
    <td><?php echo $data['tipe_akun']; ?></td>
    <td><?php echo $data['saldo'];?></td>
    
      <td align="center"><a href="index.php?page=edit_daftar_akun&id=<?php echo $data['id'];?>" class='btn btn-primary'>Edit</a>  <a href="index.php?page=daftar_akun&id_hapus=<?php echo $data['id'];?>" class="btn btn-danger" onclick="return confirm('Apakah Ingin di Hapus');">Hapus</a></td>
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
if (isset($_POST['lunasin'])) {
	$q_lunas=mysqli_query($koneksi, "update barang_pesan set status_lunas='".$_POST['status_lunas']."', tgl_lunas='".$_POST['tgl_lunas']."' where id=$_GET[id]");
	if ($q_lunas) {
		echo "<script type='text/javascript'>
		window.location='index.php?page=barang_gudang1';
		</script>";
		}
	}
?>
<div id="openLunas" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Pelunasan Alkes</h3> 
     <form method="post">
     <label>Status Lunas</label>
     <select id="input" name="status_lunas" required>
     	<?php 
		$q2 = mysqli_fetch_array(mysqli_query($koneksi, "select status_lunas,tgl_lunas from barang_pesan where id=$_GET[id]"));
		?>
        <?php
		if ($q2['status_lunas']==0) {
		?>
        <option value="0">Belum</option>
        <option value="1">Sudah</option>
        <?php } else { ?>
        <option value="1">Sudah</option>
        <option value="0">Belum</option>
        <?php } ?>
     </select>
     <br /><br />
     <label>Tanggal</label>
     <input id="input" value="<?php echo $q2['tgl_lunas']; ?>" type="date" placeholder="" name="tgl_lunas" required>
     
     
        <button id="buttonn" name="lunasin" type="submit">Simpan</button>
    </form>
    </div>
</div>


