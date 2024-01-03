<?php
if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "insert into pembeli values('','".$_POST['nama_pembeli']."','".$_POST['provinsi']."','".$_POST['kabupaten']."','".$_POST['kecamatan']."','".$_POST['kelurahan']."','".$_POST['alamat']."','".$_POST['kontak_rs']."')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Customer Berhasil Di Tambah !');
		window.location='index.php?page=akun_user'
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="active">Customer</span></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Customer</li>
        <li class="active">Tambah Customer</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah <span class="active">Customer</span></h3>
            </div>
              <div class="box-body">
              <form method="post">
              Nama Customer
              <input name="nama_pembeli" class="form-control" type="text" required placeholder="Nama Customer"><br />
              Provinsi
     <select class="form-control" name="provinsi" id="provinsi">
     <option value="">-- Pilih Provinsi --</option>
	 <?php $q1=mysqli_query($koneksi, "select * from alamat_provinsi order by nama_provinsi ASC"); 
	 while ($row1=mysqli_fetch_array($q1)){
	 ?>
     <option value="<?php echo $row1['id']; ?>"><?php echo $row1['nama_provinsi']; ?></option>
     <?php 
	 } ?>
     </select><br />
    
     Kabupaten
     <select class="form-control" name="kabupaten" id="kabupaten">
     <option value="">-- Pilih Kabupaten/Kota --</option>
     <?php $q2=mysqli_query($koneksi, "select *,alamat_kabupaten.id as idd from alamat_kabupaten INNER JOIN alamat_provinsi ON alamat_provinsi.id=alamat_kabupaten.provinsi_id order by nama_kabupaten ASC"); 
	 while ($row2=mysqli_fetch_array($q2)){
	 ?>
     <option id="kabupaten" class="<?php echo $row2['provinsi_id']; ?>" value="<?php echo $row2['idd']; ?>"><?php echo $row2['nama_kabupaten']; ?></option>
     <?php } ?>
     </select><br />
     
     Kecamatan
     <select class="form-control" name="kecamatan" id="kecamatan">
     <option value="">-- Pilih Kecamatan --</option>
     <?php $q3=mysqli_query($koneksi, "select *,alamat_kecamatan.id as idd from alamat_kecamatan INNER JOIN alamat_kabupaten ON alamat_kabupaten.id=alamat_kecamatan.kabupaten_id order by nama_kecamatan ASC"); 
	 while ($row3=mysqli_fetch_array($q3)){
	 ?>
     <option id="kecamatan" class="<?php echo $row3['kabupaten_id']; ?>" value="<?php echo $row3['idd']; ?>"><?php echo $row3['nama_kecamatan']; ?></option>
     <?php } ?>
     </select><br />
     <script src="jquery-1.10.2.min.js"></script>
        <script src="jquery.chained.min.js"></script>
        <script>
            $("#kabupaten").chained("#provinsi");
			$("#kecamatan").chained("#kabupaten");
			$("#kelurahan").chained("#kecamatan");
            //$("#kecamatan").chained("#kota");
        </script>
     Kelurahan
     <input class="form-control" type="text" placeholder="Kelurahan" name="kelurahan" required><br />
     Alamat Jalan
     <input class="form-control" type="text" placeholder="Jl.Xxx" name="alamat" required><br />
     Kontak RS/Dinas/Dll
     <input class="form-control" type="text" placeholder="" name="kontak_rs" required><br />
     
    
              
              <input type="submit" name="tambah_laporan" id="button" value="Tambah Customer" class="btn btn-success"/><br /><br />
              </form>
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
  