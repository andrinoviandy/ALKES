<?php
if (isset($_POST['lapor'])) {
	$simpan_laporan = mysqli_query($koneksi, "insert into tb_laporan_kerusakan values('','".$_POST['tgl_lapor']."','".$_GET['id']."','".$_POST['garansi']."','".$_POST['kerusakan']."','".$_POST['lokasi']."','".$_POST['kontak']."','0')");
	if ($simpan_laporan) {
		mysqli_query($koneksi, "update barang set status_lapor=1 where id=".$_GET['id']."");
		echo "<script type='text/javascript'>
		alert('Laporan Kerusakan Berhasil Di Simpan !');
		window.location='index.php?page=laporan_kerusakan'
		</script>";
		}
	}?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Lapor Kerusakan Alkes</h1><ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="index.php?page=barang">Kerusakan Alkes</a></li>
        <li class="active">Lapor Kerusakan Alkes</li></ol></section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
<div class="row">
      <div class="col-md-6">

        <div class="box box-success">
          <div class="box-header with-border">
              <h3 class="box-title">Data Alkes</h3>
          </div>
          	<div class="box-body">
            <?php 
			$data = mysqli_fetch_array(mysqli_query($koneksi,"select * from barang where id=".$_GET['id'].""));
			?>
          	<pre style="font-family:'Arial Black', Gadget, sans-serif">
            
            Akun				: <?php 
			$dataa=mysqli_fetch_array(mysqli_query($koneksi ,"select * from akun where id=".$data['id_akun'].""));
			echo $dataa['nama']; ?>
            
            
            Nama Alkes		: <?php echo $data['nama_barang']; ?>
            
            
            Merk				: <?php echo $data['merk']; ?>
            
            
            Tipe				: <?php echo $data['tipe']; ?>
            
            
            Nomor Seri			: <?php echo $data['no_seri']; ?>
            
            
            Kepemilikan		: <?php echo $data['kepemilikan']; ?>
            
            
            Deskripsi			: <?php echo $data['deskripsi']; ?>
            
          	</pre>
          	</div>
          </div>
          <!-- /.box --><!-- /.box -->

        </div>
        <div class="col-md-6"><!-- /.box -->

          <!-- iCheck -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Lapor Kerusakan</h3>
            </div>
          <div class="box-body">
          	<form method="post">
            <div class="input-group">
              <span class="input-group-addon"><span class="fa fa-calendar"></span></span><input name="tgl_lapor" type="date" class="form-control" required/></div><br />
            <textarea rows="6" name="kerusakan" class="form-control" placeholder="Deskripsi Kerusakan" required></textarea><br />
            <input name="garansi" type="text" class="form-control" placeholder="Garansi" required/>
            <br />
            <input name="lokasi" type="text" class="form-control" placeholder="Lokasi" required/><br />
            <input name="kontak" type="text" class="form-control" placeholder="Kontak" required/>
            <br /><input name="lapor" type="submit" value="Laporkan" class="form-control btn btn-success"/>
            </form>
          </div>
          </div>
          <!-- /.box -->
        </div>
    <!-- /.content -->
  </div>
  </section>
  </div>