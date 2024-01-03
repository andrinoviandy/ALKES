<?php
if (isset($_POST['tambah_laporan'])) {
	$jml1 = mysqli_fetch_array(mysqli_query($koneksi, "select * from master_barang where id=".$_POST['nama_barang'].""));
	  if ($_POST['qty']<=$jml1['stok']) {
	$Result = mysqli_query($koneksi, "insert into jual_barang values('','".$_POST['nama_barang']."','".$_POST['pembeli']."','".$_POST['alamat']."','".$_POST['telp_pembeli']."','".$_POST['qty']."','".$_POST['tgl_beli']."','','','','','','','','','','')");
	if ($Result) {
		mysqli_query($koneksi, "update master_barang set stok=stok-".$_POST['qty']." where id=".$_POST['nama_barang']."");
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Simpan !');
		window.location='index.php?page=tambah_barang_jual';
		</script>";
		}} else {
			echo "<script type='text/javascript'>
		alert('Data Stok Kurang !');
		</script>";
			}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Jual Alkes
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="index.php?page=jual_barang">Alkes</a></li>
        <li class="active">Jual Alkes</li></ol></section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-info"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Jual Alkes</h3>
            </div>
              
              <div class="box-body">
              <a href="index.php?page=tambah_barang_jual#openTambah1">
              <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h4><strong>Hanya 1 Jenis Alkes</strong></h4>

              <p>Klik Disini</p>
            </div>
          </div>
        </div>
            </a>
            <a href="index.php?page=tambah_barang_jual_banyak">
              <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h4><strong>Lebih Dari 1 Jenis Alkes</strong></h4>

              <p>Klik Disini</p>
            </div>
          </div>
        </div>
            </a>
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
  
  <div id="openTambah1" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Jual Alkes</h3>
  <form method="post">
              Nama Alkes
              <select name="nama_barang" class="form-control" required>
              <option>-- Pilih Alkes --</option>
              <?php $q = mysqli_query($koneksi, "select * from master_barang where stok!=0 order by nama_brg ASC"); 
			  while ($d = mysqli_fetch_array($q)) { ?>
              <option value="<?php echo $d['id']; ?>"><?php echo $d['nama_brg']; ?></option>
              <?php } ?>
              </select>
              
             Tanggal Jual
              <input id="input" name="tgl_beli" class="form-control" type="date" placeholder="" required>
              Pembeli
              <input id="input" name="pembeli" class="form-control" type="text" placeholder="Pembeli" required>
              Alamat Pembeli
              <input id="input" name="alamat" class="form-control" type="text" placeholder="Alamat Pembeli" required>
              Kontak Pembeli
              <input id="input" name="telp_pembeli" class="form-control" type="text" placeholder="Kontak Pembeli" required>
              Quantity
              <input id="input" name="qty" class="form-control" type="text" placeholder="Quantity" required>
              <br /><br />
              <button name="tambah_laporan" class="btn btn-info form-control" type="submit"><span class="fa fa-plus"></span> Jual Alkes</button>
             
              </form>
              </div></div>
  