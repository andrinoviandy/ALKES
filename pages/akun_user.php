<?php
if (isset($_GET['id_hapus'])) {
	$delete = mysqli_query($koneksi, "delete from akun_customer where id=".$_GET['id_hapus']."");
	if ($delete) {
		echo "<script>window.location='index.php?page=akun_user'</script>";
		}
	else {
		echo "<script type='text/javascript'>alert('Tidak Dapat Dihapus !');
		window.location='index.php?page=akun_user';
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Customer
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pengaturan</li>
        <li class="active">Akun</li>
        <li class="active">Customer</li>
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
          <div class="box box-success">
          <div class="box-footer">
            <div class="box-body table-responsive no-padding">
              <div class="">
              <?php if (!isset($_SESSION['user_cs'])) { ?>
              <a href="index.php?page=tambah_user"><input type="submit" name="button" id="button" value="Tambah Customer" class="btn btn-success"/></a><br />
              <?php } ?>
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
                <input type="text" name="cari" placeholder="Keyword....." class="form-control">
                    <span class="input-group-btn">
                      <button type="submit" name="button_cari" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari </button>
                    </span>
              </div>
              </form>
              -->
              <br />
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th align="center">&nbsp;</th>
        
       
        <th valign="top"><strong>Nama Pembeli</strong></th>
      <th valign="top"><strong>Provinsi</strong></th>
      <th valign="top"><strong>Kabupaten</strong></th>
      <th valign="top">Kecamatan</th>
      <th align="center" valign="top"><strong>Kelurahan</strong></th>
        <th align="center" valign="top"><strong>Jalan</strong></th>        
       
        <th align="center" valign="top"><strong>Kontak</strong></th>
       
       
        <th align="center" valign="top"><strong>Aksi</strong></th>
        
          </tr>
  </thead>
  <?php
 
// membuka file JSON
$file = file_get_contents("http://localhost/ALKES/json/pembeli.php");
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
?>
  <tr>
    <td align="center"><?php echo $i+1; ?></td>
    
    <td>
    <?php echo $json[$i]['nama_pembeli']; ?>
  </td>
    
      <td><?php echo $json[$i]['nama_provinsi']; ?></td>
    <td><?php echo $json[$i]['nama_kabupaten']; ?></td>
    <td><?php echo $json[$i]['nama_kecamatan']; ?></td>
    <td align=""><?php echo $json[$i]['kelurahan_id']; ?></td>
    <td align=""><?php echo $json[$i]['jalan']; ?></td>
   
    <td align=""><?php echo $json[$i]['kontak_rs']; ?></td>
    <td align="">
      <form method="post">
        
		<?php if (isset($_SESSION['user_administrator']) or isset($_SESSION['user_admin_gudang'])) { ?>
			<a href="index.php?page=ubah_pembeli&nama_pembeli=<?php echo $json[$i]['nama_pembeli']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp;<!--<a href="index.php?page=barang_masuk&id=<?php echo $json[$i]['idd']; ?>#openPilihan"><small data-toggle="tooltip" title="Jual Alkes" class="label bg-blue">Jual</small></a>-->
            
			<?php } ?>
          
          <input type="hidden" name="id" value="<?php echo $json[$i]['idd']; ?>"/>
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