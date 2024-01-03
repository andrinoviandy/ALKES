<?php require("config/koneksi.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Progress Pengerjaan</title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

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
			$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,tb_maintenance.id as idd from tb_laporan_kerusakan,akun_customer,kategori_job,barang_dikirim,barang_dijual,barang_gudang,tb_maintenance,tb_teknisi,pembeli where pembeli.id=barang_dijual.pembeli_id and akun_customer.id=tb_laporan_kerusakan.akun_customer_id and barang_dikirim.id=tb_laporan_kerusakan.barang_dikirim_id and kategori_job.id=tb_laporan_kerusakan.kategori_job_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_gudang.id=barang_dijual.barang_gudang_id and tb_laporan_kerusakan.id=tb_maintenance.laporan_kerusakan_id and tb_teknisi.id=tb_maintenance.teknisi_id and tb_maintenance.id=".$_GET['id'].""));
			echo $data['nama_brg']." / No.Seri : ".$data['no_seri_brg'];
			?>
            <div class="pull pull-right"><h5>
            
            <?php if ($data['status_proses']==2) { ?>
            Status : Selesai
            <?php } else if ($data['status_proses']==1) { ?>
            Status : Sedang Dikerjakan
            <?php } else {
				echo "Status : Belum Dikerjakan";
				} ?>
                </h5>
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
            <strong><?php echo $data['nama_brg']; ?></strong><br>
            <?php echo "Merk : ".$data['merk_brg']; ?><br>
            <?php echo "Tipe : ".$data['tipe_brg']; ?><br>
            <?php echo "No Seri : ".$data['no_seri_brg']; ?><br>
            <?php echo "Pelapor : ".$data['nama_user']; ?><br />
            <?php echo "Kepemilikan : ".$data['nama_pembeli']; ?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <p>Kerusakan</p>
          <address style="text-align:justify">
            <?php echo $data['problem']; ?>
          </address>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      
      <div class="row">
        <div class="col-xs-12 table-responsive">
        
          <table class="table table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Tanggal</th>
              <th>Deskripsi Kerusakan</th>
              <th>Deskripsi Perbaikan</th>
              <?php if ($data['status_proses']!=2) { ?>
              <?php } ?>
              </tr>
            </thead>
            <tbody>
            <?php
			 
			$query = mysqli_query($koneksi, "select * from progress_maintenance where maintenance_id=".$_GET['id']." order by tgl_progress DESC");
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
        </section></div>
</body>
</html>