<?php require("config/koneksi.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Print</title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body onload="window.print();">
<div class="wrapper">
<section class="invoice">
<div class="row">
        <!-- Left col -->
        <div class="col-xs-12">
          <div class="box"><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
            <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-cube"></i> 
            <?php 
			$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,tb_spk.id as idd from tb_spk,tb_laporan_kerusakan,tb_teknisi,barang,akun where barang.id=tb_laporan_kerusakan.id_barang and tb_laporan_kerusakan.id=tb_spk.id_lapor and tb_teknisi.id=tb_spk.id_teknisi and akun.id=barang.id_akun and tb_spk.id=".$_GET['id'].""));
			echo $data['nama_barang']." / No.Seri : ".$data['no_seri'];
			?>
            <div class="pull pull-right">
            <?php
			if (isset($_POST['simpan_status'])) {
			$Result = mysqli_query($koneksi, "update tb_spk set status_proses=".$_POST['status_proses']." where id=".$_GET['id']."");
			if ($Result) {
				echo "<script type='text/javascript'>
				alert('Status Proses Berhasil Diperbarui');
				window.location='index.php?page=detail_progress&id=$_GET[id]'
				</script>";
				}}
			?>
            <?php if ($data['status_proses']==2) { ?>
            
            <form method="post">
            Status :
            <select name="status_proses" class="btn btn-success">
            <option value="2">Selesai</option>
            <option value="1">Sedang Dikerjakan</option>
            </select>&nbsp;<input name="simpan_status" type="submit" value="OK" class="btn btn-success"/>
            </form>
            <?php } else if ($data['status_proses']==1) { ?>
            
            <form method="post">
            Status :
            <select name="status_proses" class="btn btn-warning">
            <option value="1">Sedang Dikerjakan</option>
            <option value="2">Selesai</option>
            </select>&nbsp;<input name="simpan_status" type="submit" value="OK" class="btn btn-warning"/>
            </form>
            <?php } else {
				echo "Status : Belum Dikerjakan";
				} ?>
                
            </div>
            </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <p>Teknisi</p>
            <address>
            <strong><?php echo $data['nama_teknisi']; ?></strong><br>
            <?php echo "Bidang : ".$data['bidang']; ?><br>
            <?php echo "No HP : ".$data['no_hp']; ?><br>
            
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <p>Detail Barang</p>
          <address>
            <strong><?php echo $data['nama_barang']; ?></strong><br>
            <?php echo "Merk : ".$data['merk']; ?><br>
            <?php echo "Tipe : ".$data['tipe']; ?><br>
            <?php echo "No Seri : ".$data['no_seri']; ?><br>
            <?php echo "Pelapor : ".$data['nama']; ?><br />
            <?php echo "Kepemilikan : ".$data['kepemilikan']; ?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <p>Kerusakan</p>
          <address style="text-align:justify">
            <?php echo $data['kerusakan']; ?>
          </address>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      
      <div class="row">
        <div class="col-xs-12 table-responsive">
        
          <table id="" class="table table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Tanggal</th>
              <th>Deskripsi Kerusakan</th>
              <th>Deskripsi Perbaikan</th>
              <?php if ($data['status_proses']!=2) { ?>
              <th>#</th>
              <?php } ?>
              </tr>
            </thead>
            <tbody>
            <?php
			 
			$query = mysqli_query($koneksi, "select * from progress where id_spk=".$_GET['id']." order by tgl_progress DESC");
			$no=0;
			while ($d = mysqli_fetch_assoc($query)) {
			$no++;
			?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo date("d-m-Y", strtotime($d['tgl_progress'])); ?></td>
              <td><?php echo $d['deskripsi_kerusakan']; ?></td>
              <td><?php echo $d['deskripsi_perbaikan']; ?></td>
              <?php if ($data['status_proses']!=2) { ?>
              <td><a href="index.php?page=detail_progress&id=<?php echo $_GET['id']; ?>&hapus=<?php echo $d['id']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Progress Ini ?')"><span class="ion-android-delete"></span></a></td>
              <?php } ?>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row --><!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          
        </div>
      </div>
    </section>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        </div>
        </section>
        </div>
</body>
</html>