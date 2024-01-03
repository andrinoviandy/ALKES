<?php
if (isset($_GET['hapus'])) {
				$R=mysqli_query($koneksi, "delete from replacement_part where id=".$_GET['hapus']."");
				if ($R) {
					echo "<script>window.location='index.php?page=replacement&id=$_GET[id]'</script>";
					}
				}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Replacement Part
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="index.php?page=progress_pengerjaan">Progress Pengerjaan</a></li>
        <li class="active">Replacement Part</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
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
			$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,tb_maintenance.id as idd from tb_laporan_kerusakan,akun_customer,kategori_job,barang_dikirim,barang_dijual,barang_gudang,tb_maintenance,tb_teknisi,pembeli,barang_gudang_detail where akun_customer.id=tb_laporan_kerusakan.akun_customer_id and barang_dikirim.id=tb_laporan_kerusakan.barang_dikirim_id and kategori_job.id=tb_laporan_kerusakan.kategori_job_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual.barang_gudang_detail_id and tb_laporan_kerusakan.id=tb_maintenance.laporan_kerusakan_id and tb_teknisi.id=tb_maintenance.teknisi_id and pembeli.id=barang_dijual.pembeli_id and tb_maintenance.id=".$_GET['id'].""));
			echo $data['nama_brg']." / ".$data['no_seri_brg'];
			?>
            
            <div class="pull pull-right">
            <?php
			if (isset($_POST['simpan_status'])) {
			$Result = mysqli_query($koneksi, "update tb_maintenance set status_proses=".$_POST['status_proses']." where id=".$_GET['id']."");
			if ($Result) {
				echo "<script type='text/javascript'>
				alert('Status Proses Berhasil Diperbarui');
				window.location='index.php?page=replacement&id=$_GET[id]'
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
            <?php echo "Kategori Kerusakan : ".$data['nama_job']; ?><br />
			<?php echo "Problem : ".$data['problem']; ?>
          </address>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <?php if ($data['status_proses']!=2) { ?>
      
          <a href="index.php?page=replacement&id=<?php echo $_GET['id']; ?>#tambahOrder"><button type="button" class="btn btn-success pull-left" style="margin-right: 5px;"><i class="fa fa-plus"></i> Tambah Part
          </button></a>
          <?php } ?>
          <a href="index.php?page=detail_progress&id=<?php echo $_GET['id']; ?>"><button type="button" class="btn btn-success pull-right" style="margin-right: 5px;">
            &nbsp;Kembali Ke Detail Progress</button></a>
      <div class="row">
        <div class="col-xs-12 table-responsive">
        <br />
          <table id="example1" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th><p align="">Order No</p></th>
              <th><p align="center">Deskripsi</p></th>
              <th align="center"><p align="center">Qty</p></th>
              <th align="center"><p align="center">Price</p></th>
              <th align="center"><p align="center">Amount</p></th>
              <?php if ($data['status_proses']!=2) { ?>
              <th>Aksi</th>
              <?php } ?>
              </tr>
            </thead>
            <tbody>
            <?php
			 
			$query = mysqli_query($koneksi, "select * from replacement_part where maintenance_id=".$_GET['id']." order by order_no ASC");
			$no=0;
			while ($d = mysqli_fetch_assoc($query)) {
			$no++;
			?>
            <tr>
              <td><?php echo $d['order_no']; ?></td>
              <td><?php echo $d['deskripsi_order']; ?></td>
              <td align="center"><?php echo $d['qty_order']; ?></td>
              <td align="center"><?php echo "Rp ".number_format($d['harga_order'],0,',','.'); ?></td>
              <td align="center">
              <?php echo "Rp ".number_format(($d['qty_order']*$d['harga_order']),0,',','.'); ?>
              </td>
              <?php if ($data['status_proses']!=2) { ?>
              <td><a href="index.php?page=replacement&id=<?php echo $_GET['id']; ?>&hapus=<?php echo $d['id']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Part Ini ?')"><span class="ion-android-delete"></span></a></td>
              <?php } ?>
              </tr>
              <?php } ?>
              <tr>
              <th colspan="4" align="right"><p align="right">Total</p></th>
              <th align="center"><?php 
			  $da=mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_order*harga_order) as total from replacement_part where maintenance_id=".$_GET['id'].""));
			  echo "<p align='center'> Rp ".number_format($da['total'],0,',','.')."</p>";
			  ?></th>
              
              <th>#</th>
              
              </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row --><!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="print_replacement_part.php?id=<?php echo $_GET['id']; ?>" target="_blank"><button type="button" class="btn btn-success pull-left" style="margin-right: 5px;">
            <i class="fa fa-print"></i> Print
          </button></a>
          <a href="cetak_excel_replacement.php?id=<?php echo $_GET['id']; ?>">	
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate Excel
          </button>
          </a>
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
    <!-- /.content -->
  </div>
  <?php
  if (isset($_POST['simpan_order'])) {
	  $no_query=mysqli_fetch_array(mysqli_query($koneksi, "select max(order_no) as maks from replacement_part where maintenance_id=".$_GET['id'].""));
	  $order_no=$no_query['maks']+1;
	  $Q=mysqli_query($koneksi, "insert into replacement_part VALUES('','".$_GET['id']."','".$order_no."','".$_POST['deskripsi']."','".$_POST['qty']."','".$_POST['harga']."')");
	  if ($Q) {
		  echo "<script type='text/javascript'>
		  window.location='index.php?page=replacement&id=$_GET[id]'</script>";
		  }
	  }
	  $no_query=mysqli_fetch_array(mysqli_query($koneksi, "select max(order_no) as maks from replacement_part where maintenance_id=".$_GET['id'].""));
	  $order_no=$no_query['maks']+1;
  ?>
  <div id="tambahOrder" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Tambah Order</h3>
        <form method="post">
        Order No.
       <input id="input" name="order_no" type="text" value="<?php echo $order_no; ?>" disabled="disabled"/> 
       Deskripsi
       <textarea id="input" cols="" rows="4" name="deskripsi"></textarea> 
       Quantity
       <input id="input" name="qty" type="text" /> 
       Harga Per Order
       <input id="input" name="harga" type="text" /> 
       
       <button id="buttonn" type="submit" name="simpan_order">Simpan</button> 
       </form>
     
    </div>
</div>